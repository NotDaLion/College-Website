<?php
    session_start();
    if ($_SESSION["role"] != "admin") {
        header("Location: ../Pages/index.html");
        exit;
    }
    require "db.php";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name  = trim($_POST["name"]);
    $price = trim($_POST["price"]);
    $img_link = trim($_POST["image"]);
    $desc  = trim($_POST["desc"] ?? '');
    $category  = trim($_POST["category"]);
    //create
    if($_POST['opType'] == 'create'){
        $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image, category)
        VALUES (:name, :desc, :price,:image,:category)");

          $stmt->bindParam(':name', $name);
          $stmt->bindParam(':price', $price);
          $stmt->bindParam(':image', $img_link);
          $stmt->bindParam(':desc', $desc);
          $stmt->bindParam(':category', $category);
          $stmt->execute();
        header('Location: admin-menu.php');
        exit;
    }
    //Update
    else if($_POST['opType'] == 'update'){
        $stmt = $pdo->prepare("UPDATE products
         SET description = :desc, price = :price,image = :image,category = :category
          WHERE name = :name");

          $stmt->bindParam(':name', $name);
          $stmt->bindParam(':price', $price);
          $stmt->bindParam(':image', $img_link);
          $stmt->bindParam(':desc', $desc);
          $stmt->bindParam(':category', $category);
          $stmt->execute();
        header('Location: admin-menu.php');
        exit;
    }
    //Delete
     else if($_POST['opType'] == 'delete') {
        $stmt = $pdo->prepare("DELETE FROM products WHERE name = :name");
    
          $stmt->bindParam(':name', $name);
          $stmt->execute();
        header('Location: admin-menu.php');
        exit;
    }
    //Read
    else if($_POST['opType'] == 'read') {
        var_dump($name);
        $stmt = $pdo->prepare("SELECT * FROM products WHERE name = :name");
        $stmt->bindParam(':name', $name);
        var_dump($row);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "id: {$row['id']} <br>
        id: {$row['name']} <br>
        price: {$row['price']} <br>
        image: {$row['image']} <br>
        description: {$row['description']} <br>
        category: {$row['category']} <br>
        ";
        }

    }

}
?>