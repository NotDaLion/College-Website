<?php
session_start();
require "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $pass  = trim($_POST["password"] ?? "");

    if ($email === "" || $pass === "") {
        die("All fields required");
    }

    // Prepare SQL
    $stmt = $pdo->prepare(
        "SELECT id, full_name, password 
         FROM users 
         WHERE email = :email"
    );

    // Execute with named parameter
    $stmt->execute([
        ":email" => $email
    ]);

    $user = $stmt->fetch();

    if ($user) {
        if (password_verify($pass, $user["password"])) {

            // Login success
            $_SESSION["user_id"]   = $user["id"];
            $_SESSION["user_name"] = $user["full_name"];

            header("Location: ../Pages/account.php");
            exit;

        } else {
            echo "Wrong password";
        }

    } else {
        echo "Email not found";
    }
}
