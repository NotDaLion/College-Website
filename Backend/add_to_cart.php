<?php
session_start();
require "db.php";

if (!isset($_POST['id'])) {
    header("Location: ../Pages/Menu.php");
    exit;
}

$product_id = (int)$_POST['id'];
$session_id = session_id();

$stmt = $pdo->prepare("
    SELECT id FROM cart
    WHERE session_id = ? AND product_id = ?
");
$stmt->execute([$session_id, $product_id]);

if ($stmt->rowCount() > 0) {
    $pdo->prepare("
        UPDATE cart
        SET quantity = quantity + 1
        WHERE session_id = ? AND product_id = ?
    ")->execute([$session_id, $product_id]);
} else {
    $pdo->prepare("
        INSERT INTO cart (session_id, product_id, quantity)
        VALUES (?, ?, 1)
    ")->execute([$session_id, $product_id]);
}

header("Location: ../Pages/cart.php");
exit;