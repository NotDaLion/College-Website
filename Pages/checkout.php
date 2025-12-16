<?php
session_start();
require "../Backend/db.php";

$session_id = session_id();

$stmt = $pdo->prepare("
    SELECT p.name, p.price, c.quantity
    FROM cart c
    JOIN products p ON c.product_id = p.id
    WHERE c.session_id = ?
");
$stmt->execute([$session_id]);
$items = $stmt->fetchAll();

if (!$items) {
    header("Location: cart.php");
    exit;
}

$total = 0;
foreach ($items as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Checkout</title>
<style>
body{
  font-family:system-ui;
  background:#e4eef4;
  padding:5vh;
}
.box{
  max-width:38rem;
  margin:auto;
  background:#fff;
  padding:4vh;
  border-radius:1rem;
}
button{
  background:#ff8c42;
  color:#fff;
  border:none;
  padding:0.8em 1.4em;
  border-radius:0.6em;
  font-weight:600;
}
</style>
</head>
<body>

<div class="box">
<h2>Checkout</h2>

<ul>
<?php foreach ($items as $item): ?>
  <li><?= htmlspecialchars($item['name']) ?> × <?= $item['quantity'] ?></li>
<?php endforeach; ?>
</ul>

<h3>Total: $<?= number_format($total, 2) ?></h3>

<form method="POST" action="../Backend/place_order.php">
  <button type="submit">Confirm Order</button>
</form>
</div>

</body>
</html>

