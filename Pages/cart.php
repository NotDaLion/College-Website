<?php
require "../Backend/db.php";
session_start();
$session_id = session_id();

$stmt = $pdo->prepare(
    "SELECT 
        p.id,
        p.name,
        p.price,
        p.image,
        c.quantity
     FROM cart c
     JOIN products p ON c.product_id = p.id
     WHERE c.session_id = ?"
);
$stmt->execute([$session_id]);
$items = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Your Cart</title>

<style>
:root{
    --primary: #0b5f8a;
    --accent: #ff8c42;
    --post-color: #ffffff;
    --bg: #e4eef4;
    --muted: #6a6f73;
}

body{
    margin: 0;
    font-family: system-ui, sans-serif;
    background-color: var(--bg);
    color: var(--primary);
}

.cart-container{
    max-width: 70rem;
    margin: 4vh auto;
    background: var(--post-color);
    padding: 2.5rem;
    border-radius: 1.2rem;
    box-shadow: 0 1.5rem 3rem rgba(0,0,0,.08);
}

.cart-header{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.cart-header h2{
    margin: 0;
    font-size: 2rem;
}

.cart-table{
    width: 100%;
    border-collapse: collapse;
}

.cart-table th{
    text-align: left;
    padding: 1rem;
    color: var(--muted);
    font-size: .9rem;
}

.cart-table td{
    padding: 1rem;
    border-top: .08rem solid #dde7ef;
    vertical-align: middle;
}

.cart-table img{
    width: 4.5rem;
    aspect-ratio: 1 / 1;
    object-fit: cover;
    border-radius: .6rem;
}

.qty{
    display: inline-flex;
    align-items: center;
    gap: .8rem;
    font-weight: 600;
}

.qty-btn{
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 2.2rem;
    height: 2.2rem;
    border-radius: 50%;
    background: var(--primary);
    color: white;
    font-weight: bold;
    text-decoration: none;
}

.qty-btn:hover{
    opacity: .85;
}

.btn{
    border: none;
    padding: .6rem 1.4rem;
    border-radius: .7rem;
    font-weight: 600;
    cursor: pointer;
    font-size: .9rem;
    text-decoration: none;
}

.btn-primary{
    background: var(--primary);
    color: white;
}

.btn-accent{
    background: var(--accent);
    color: white;
}

.btn-danger{
    background: transparent;
    color: var(--accent);
}

.cart-footer{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 2rem;
    border-top: .15rem dashed #d5e3ec;
    padding-top: 1.5rem;
}

.total{
    font-size: 1.4rem;
    font-weight: bold;
}

.empty{
    text-align: center;
    padding: 4rem 0;
    color: var(--muted);
}

@media (max-width: 48rem){
    .cart-table thead{
        display: none;
    }

    .cart-table tr{
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        padding: 1rem 0;
    }

    .cart-table td{
        border: none;
        padding: .3rem 0;
    }

    .cart-footer{
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
}
</style>
</head>

<body>

<div class="cart-container">

<div class="cart-header">
    <h2>🛒 Your Cart</h2>
    <a href="Menu.html" class="btn btn-primary">Continue Shopping</a>
</div>

<?php if (count($items) === 0): ?>
    <div class="empty">
        <h3>Your cart is empty</h3>
        <p>Add items from the menu to see them here.</p>
    </div>
<?php else: ?>

<table class="cart-table">
<thead>
<tr>
    <th>Item</th>
    <th>Preview</th>
    <th>Price</th>
    <th>Qty</th>
    <th>Total</th>
    <th></th>
</tr>
</thead>
<tbody>

<?php
$grand_total = 0;
foreach ($items as $item):
    $item_total = $item['price'] * $item['quantity'];
    $grand_total += $item_total;
?>
<tr>
    <td><?= htmlspecialchars($item['name']) ?></td>

    <td>
        <img src="../Assets/<?= htmlspecialchars($item['image']) ?>">
    </td>

    <td>$<?= number_format($item['price'], 2) ?></td>

    <td>
        <div class="qty">
            <a class="qty-btn"
               href="../Backend/update_quantity.php?id=<?= $item['id'] ?>&action=decrease">−</a>

            <span><?= $item['quantity'] ?></span>

            <a class="qty-btn"
               href="../Backend/update_quantity.php?id=<?= $item['id'] ?>&action=increase">+</a>
        </div>
    </td>

    <td>$<?= number_format($item_total, 2) ?></td>

    <td>
        <a class="btn btn-danger"
           href="../Backend/remove_from_cart.php?id=<?= $item['id'] ?>">
            Remove
        </a>
    </td>
</tr>
<?php endforeach; ?>

</tbody>
</table>

<div class="cart-footer">
    <div class="total">
        Total: $<?= number_format($grand_total, 2) ?>
    </div>

   <a class="btn btn-accent" href="checkout.php">
    Proceed to Checkout
</a>

</div>

<?php endif; ?>

</div>

</body>
</html>