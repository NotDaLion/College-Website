<?php
session_start();
require "db.php";

if (!isset($_GET['id'], $_GET['action'])) {
    header("Location: ../Pages/cart.php");
    exit;
}

$product_id = (int)$_GET['id'];
$action = $_GET['action'];
$session_id = session_id();

$stmt = $pdo->prepare("
    SELECT quantity FROM cart
    WHERE session_id = ? AND product_id = ?
");
$stmt->execute([$session_id, $product_id]);
$item = $stmt->fetch();

if (!$item) {
    header("Location: ../Pages/cart.php");
    exit;
}

$quantity = $item['quantity'];

if ($action === "increase") {
    $quantity++;
} else {
    $quantity--;
}


if ($quantity <= 0) {
    $pdo->prepare("
        DELETE FROM cart
        WHERE session_id = ? AND product_id = ?
    ")->execute([$session_id, $product_id]);
} else {
    $pdo->prepare("
        UPDATE cart
        SET quantity = ?
        WHERE session_id = ? AND product_id = ?
    ")->execute([$quantity, $session_id, $product_id]);
}

header("Location: ../Pages/cart.php");
exit;
