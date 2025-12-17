<?php
session_start();
require "../Backend/db.php";

/* Protect page */
if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit;
}

$userId = $_SESSION["user_id"];
$message = "";

/* Fetch user data */
$stmt = $pdo->prepare(
    "SELECT full_name, email FROM users WHERE id = ?"
);
$stmt->execute([$userId]);
$user = $stmt->fetch();

/* Update profile */
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update"])) {
    $name  = trim($_POST["name"]);
    $email = trim($_POST["email"]);

    if ($name && $email) {
        $update = $pdo->prepare(
            "UPDATE users SET full_name = ?, email = ? WHERE id = ?"
        );
        $update->execute([$name, $email, $userId]);

        $_SESSION["user_name"] = $name;
        $message = "Profile updated successfully ✅";
    }
}

/* Delete account */
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete"])) {
    $delete = $pdo->prepare(
        "DELETE FROM users WHERE id = ?"
    );
    $delete->execute([$userId]);

    session_destroy();
    header("Location: ../Pages/index.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Profile — La Cucina Del Mare</title>

  <link rel="stylesheet" href="../Stylesheets/Menu.css">
  <link rel="stylesheet" href="../Stylesheets/account.css">
</head>

<body>

<header class="alt-header">
  <div class="alt-container">
    <a class="alt-logo" href="../Pages/index.html">La Cucina Del Mare</a>
    <nav class="alt-nav">
      <ul>
        <li><a href="../Pages/index.html">Home</a></li>
        <li><a href="../Pages/Menu.html">Menu</a></li>
        <li><a href="../Pages/about-alt.html">About</a></li>
        <li><a href="../Pages/contact.html">Contact</a></li>
        <li><a href="account.php" class="active">Account</a></li>
        <li><a href="../Backend/logout.php">Logout</a></li>
      </ul>
    </nav>
  </div>
</header>

<main class="account-page">
  <div class="account-card">

    <h2>Profile</h2>
    <p class="account-sub">Manage your personal information</p>

    <?php if ($message): ?>
      <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="POST" class="password-form">
      <input
        type="text"
        name="name"
        value="<?= htmlspecialchars($user["full_name"]) ?>"
        required
      >

      <input
        type="email"
        name="email"
        value="<?= htmlspecialchars($user["email"]) ?>"
        required
      >

      <button type="submit" name="update" class="account-btn">
        Save Changes
      </button>
    </form>

    <hr style="margin: 30px 0;">

    <form method="POST">
      <button
        type="submit"
        name="delete"
        class="account-btn"
        style="background:#c0392b"
        onclick="return confirm('Are you sure you want to delete your account?')"
      >
        Delete Account
      </button>
    </form>

    <a href="account.php" class="back-link">
      ← Back to Account
    </a>

  </div>
</main>

<footer class="alt-footer">
  <div class="alt-container">
    <p>© <span id="alt-year"></span> La Cucina Del Mare</p>
  </div>
</footer>

<script>
  document.getElementById("alt-year").textContent = new Date().getFullYear();
</script>

</body>
</html>
