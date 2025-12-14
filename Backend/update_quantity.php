<?php
require "db.php";

if (!isset($_GET['id'], $_GET['action'])) {
    header("Location: ../Pages/cart.php");
    exit;
}

$product_id = (int) $_GET['id'];
$action = $_GET['action'];
$session_id = session_id();

$stmt = $pdo->prepare(
    "SELECT quantity FROM cart 
     WHERE product_id = ? AND session_id = ?"
);
$stmt->execute([$product_id, $session_id]);
$item = $stmt->fetch();

if (!$item) {
    header("Location: ../Pages/cart.php");
    exit;
}

$quantity = (int) $item['quantity'];

if ($action === "increase") {
    $quantity++;
} elseif ($action === "decrease") {
    $quantity--;
}

if ($quantity <= 0) {
    $stmt = $pdo->prepare(
        "DELETE FROM cart 
         WHERE product_id = ? AND session_id = ?"
    );
    $stmt->execute([$product_id, $session_id]);
} else {
    $stmt = $pdo->prepare(
        "UPDATE cart 
         SET quantity = ? 
         WHERE product_id = ? AND session_id = ?"
    );
    $stmt->execute([$quantity, $product_id, $session_id]);
}

header("Location: ../Pages/cart.php");
exit;
