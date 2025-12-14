<?php
require "db.php";

$product_id = $_POST['id'];
$session_id = session_id();

/* Check if item already in cart */
$stmt = $pdo->prepare(
    "SELECT id FROM cart 
     WHERE session_id = ? AND product_id = ?"
);
$stmt->execute([$session_id, $product_id]);

if ($stmt->rowCount() > 0) {
    // Increase quantity
    $update = $pdo->prepare(
        "UPDATE cart 
         SET quantity = quantity + 1 
         WHERE session_id = ? AND product_id = ?"
    );
    $update->execute([$session_id, $product_id]);
} else {
    // Insert new item
    $insert = $pdo->prepare(
        "INSERT INTO cart (session_id, product_id, quantity)
         VALUES (?, ?, 1)"
    );
    $insert->execute([$session_id, $product_id]);
}

header("Location: ../Pages/cart.php");
exit;
