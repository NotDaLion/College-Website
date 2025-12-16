<?php
session_start();
require "../Backend/db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit;
}

$message = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $current = $_POST["current_password"];
    $new     = $_POST["new_password"];
    $confirm = $_POST["confirm_password"];

    if (empty($current) || empty($new) || empty($confirm)) {
        $message = "All fields are required";
    } elseif ($new !== $confirm) {
        $message = "New passwords do not match";
    } else {
        $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->execute([$_SESSION["user_id"]]);
        $user = $stmt->fetch();

        if (!password_verify($current, $user["password"])) {
            $message = "Current password is incorrect";
        } else {
            $newHash = password_hash($new, PASSWORD_DEFAULT);
            $update = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $update->execute([$newHash, $_SESSION["user_id"]]);

            $success = true;
            $message = "Password updated successfully ✅";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Change Password — La Cucina Del Mare</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <h2>Security</h2>
    <p class="account-sub">Change your password</p>

    <?php if ($message): ?>
      <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="POST" class="password-form">
      <input type="password" name="current_password" placeholder="Current password" required>
      <input type="password" name="new_password" placeholder="New password" required>
      <input type="password" name="confirm_password" placeholder="Confirm new password" required>

      <button type="submit" class="account-btn">Update Password</button>
    </form>

    <a href="account.php" class="back-link">← Back to Account</a>
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
