<?php
session_start();
$cart = $_SESSION["cart"] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cart — La Cucina Del Mare</title>

  <link rel="stylesheet" href="../Stylesheets/Menu.css">
  <link rel="stylesheet" href="../Stylesheets/cart.css">
</head>

<body>

<header class="alt-header">
  <div class="alt-container">
    <a class="alt-logo" href="/">La Cucina Del Mare</a>
    <nav class="alt-nav">
      <ul>
        <li><a href="Menu.html">Menu</a></li>
        <li><a href="cart.php" class="active">Cart</a></li>
      </ul>
    </nav>
  </div>
</header>

<main class="cart-page">
  <div class="cart-card">
    <h2>Your Cart</h2>

    <?php if (empty($cart)): ?>
      <p>Your cart is empty.</p>
    <?php else: ?>
      <?php $total = 0; ?>
      <?php foreach ($cart as $item): ?>
        <?php $total += $item["price"] * $item["qty"]; ?>
        <div class="cart-item">
          <span><?= htmlspecialchars($item["name"]) ?></span>
          <span><?= $item["qty"] ?> × $<?= $item["price"] ?></span>
        </div>
      <?php endforeach; ?>

      <div class="cart-total">
        Total: $<?= number_format($total, 2) ?>
      </div>

      <a href="checkout.php" class="checkout-btn">Checkout</a>
    <?php endif; ?>
  </div>
</main>

</body>
</html>
