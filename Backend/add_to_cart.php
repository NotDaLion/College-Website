<?php
session_start();

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

$id    = $_POST["id"];
$name  = $_POST["name"];
$price = (float)$_POST["price"];

if (isset($_SESSION["cart"][$id])) {
    $_SESSION["cart"][$id]["qty"] += 1;
} else {
    $_SESSION["cart"][$id] = [
        "name"  => $name,
        "price" => $price,
        "qty"   => 1
    ];
}

echo "ok";
