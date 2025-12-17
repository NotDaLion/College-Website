<?php
session_start();

// protect page
if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit;
}

$userName = $_SESSION["user_name"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Account — La Cucina Del Mare</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../Stylesheets/Menu.css" />
  <link rel="stylesheet" href="../Stylesheets/account.css" />
</head>

<body>

<!-- Header -->
<header class="alt-header">
  <div class="alt-container">
    <a class="alt-logo" href="/">La Cucina Del Mare</a>
    <nav class="alt-nav">
      <ul>
        <li><a href="../Pages/index.html">Home</a></li>
        <li><a href="../Pages/Menu.php">Menu</a></li>
        <li><a href="../Pages/about-alt.html">About</a></li>
        <li><a href="../Pages/contact.html">Contact</a></li>
        <li><a href="account.php" class="active">Account</a></li>
        <li><a href="../Backend/logout.php">Logout</a></li>
      </ul>
    </nav>
  </div>
</header>

<!-- Main -->
<main class="account-page">
  <div class="account-card">
    <h2>Hello, <?= htmlspecialchars($userName) ?> 👋</h2>
    <p class="account-sub">Welcome to your account</p>

    <div class="account-info">
  <a href="orders.php" class="info-box info-link">
  <h4>Orders</h4>
  <p>View your past orders</p>
</a>


  <a href="profile.php" class="info-box info-link">
  <h4>Profile</h4>
  <p>Manage your personal info</p>
</a>

  <a href="change_password.php" class="info-box info-link">
    <h4>Security</h4>
    <p>Change password</p>
  </a>
</div>

     

    <a href="../Pages/Menu.html" class="account-btn">
      Browse Menu
    </a>
  </div>
</main>

<!-- Footer -->
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
