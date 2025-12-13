<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name  = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $pass  = trim($_POST["password"] ?? "");

    if ($name === "" || $email === "" || $pass === "") {
        die("All fields required");
    }

    // Hash password
    $hashed = password_hash($pass, PASSWORD_DEFAULT);

    try {
        // Prepare SQL
        $stmt = $pdo->prepare(
            "INSERT INTO users (full_name, email, password)
             VALUES (:name, :email, :password)"
        );

        // Execute with named parameters
        $stmt->execute([
            ":name"     => $name,
            ":email"    => $email,
            ":password" => $hashed
        ]);

         header("Location: ../Pages/login.html?registered=1");
        exit;

    } catch (PDOException $e) {
        // Duplicate email (UNIQUE constraint)
        if ($e->getCode() == 23000) {
            echo "Email already exists";
        } else {
            echo "Something went wrong";
        }
    }
}
