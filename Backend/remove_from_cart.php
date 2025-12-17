<?php
session_start();
require "db.php";

if (!isset($_GET['id'])) {
    header("Location: ../Pages/cart.php");
    exit;
}

$product_id = (int)$_GET['id'];
$session_id = session_id();

$pdo->prepare("
    DELETE FROM cart
    WHERE session_id = ? AND product_id = ?
")->execute([$session_id, $product_id]);

header("Location: ../Pages/cart.php");
exit;
