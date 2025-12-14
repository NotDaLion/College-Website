<?php
require "db.php"; // adjust path if needed

$session_id = session_id();

// Check if 'id' is provided
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Delete item from cart for this session
    $stmt = $pdo->prepare("DELETE FROM cart WHERE session_id = ? AND product_id = ?");
    $stmt->execute([$session_id, $product_id]);
}

// Redirect back to cart
header("Location: ../Frontend/cart.php");
exit;
