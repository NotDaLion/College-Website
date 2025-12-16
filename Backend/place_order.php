<?php
session_start();
require "db.php";

$session_id = session_id();

// Get cart items
$stmt = $pdo->prepare("
    SELECT c.product_id, p.price, c.quantity
    FROM cart c
    JOIN products p ON c.product_id = p.id
    WHERE c.session_id = ?
");
$stmt->execute([$session_id]);
$items = $stmt->fetchAll();

if (!$items) {
    header("Location: ../Pages/cart.php");
    exit;
}

// Calculate total
$total = 0;
foreach ($items as $item) {
    $total += $item['price'] * $item['quantity'];
}

// Create order
$stmt = $pdo->prepare("
    INSERT INTO orders (session_id, total)
    VALUES (?, ?)
");
$stmt->execute([$session_id, $total]);

$order_id = $pdo->lastInsertId();

// Insert order items
$stmt = $pdo->prepare("
    INSERT INTO order_items (order_id, product_id, price, quantity)
    VALUES (?, ?, ?, ?)
");

foreach ($items as $item) {
    $stmt->execute([
        $order_id,
        $item['product_id'],
        $item['price'],
        $item['quantity']
    ]);
}

// Clear cart AFTER order
$stmt = $pdo->prepare("DELETE FROM cart WHERE session_id = ?");
$stmt->execute([$session_id]);

header("Location: ../Pages/order_success.php");
exit;
