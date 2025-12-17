 <?php
if (isset($_POST['full_name'], $_POST['email'], $_POST['phone'], $_POST['message'])) {


    $conn = mysqli_connect("localhost", "root", "", "restaurant_db");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];


    $sql = "INSERT INTO contact_messages (full_name, email, phone, message)
            VALUES ('$full_name', '$email', '$phone', '$message')";

    if (mysqli_query($conn, $sql)) {
        echo "Message saved successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Contact - La Cucina Del Mare</title>
    <link rel="stylesheet" href="../Stylesheets/contact.css" />
    <link rel="icon" type="image/x-icon" href="../Assets/prawn.png" />
  </head>
  <body>
    <header class="alt-header" role="banner">
      <div class="alt-container">
        <a
          class="alt-logo"
          href="../Pages/index.html"
          aria-label="La Cucina Del Mare homepage"
          >La Cucina Del Mare</a
        >
        <nav class="alt-nav" role="navigation" aria-label="Main navigation">
          <ul>
            <li><a href="../Pages/index.html">Home</a></li>
            <li><a href="../Pages/Menu.html">Menu</a></li>
            <li><a href="../Pages/about-alt.html">About</a></li>
            <li><a href="../Backend/contact.php" class="active">Contact</a></li>
            <li><a href="../Pages/cart.php">Cart</a></li>
            <li><a href="../Pages/account.php">Account</a></li>
          </ul>
        </nav>
      </div>
    </header>

    <main class="alt-main">
      <section class="alt-hero">
        <div class="alt-overlay"></div>
        <div class="alt-hero-inner alt-container">
          <h1>Get in touch</h1>
          <p class="sub">
            Questions, reservations, or special requests — we’d love to hear
            from you.
          </p>
        </div>
      </section>

      <section class="alt-about alt-container" id="contact">
        <div class="contact-card">
          <div>
            <h2>Contact Us</h2>
            <p class="alt-note">
              Fill out the form and we'll respond within 24 hours (or call us
              for urgent requests).
            </p>

           <form id="contactForm" class="contact-form" method="post" action="contact.php" novalidate>
              <label for="name">Full name</label>
              <input
                id="name"
                name="full_name"
                type="text"
                required
                placeholder="Your full name"
              />

              <label for="email">Email</label>
              <input
                id="email"
                name="email"
                type="email"
                required
                placeholder="you@example.com"
              />

              <label for="phone">Phone</label>
              <input
                id="phone"
                name="phone"
                type="tel"
                placeholder="+20 1X XXX XXXX"
              />

              <label for="message">Message</label>
              <textarea
                id="message"
                name="message"
                required
                placeholder="Tell us about your request..."
              ></textarea>

              <div style="display: flex; gap: 0.5rem; align-items: center">
                <button type="submit" class="alt-btn">Send message</button>
                <button type="reset" class="alt-btn alt-outline">Reset</button>
              </div>
            </form>
          </div>

          <aside class="contact-info" aria-label="Contact information">
            <h4>Reserve a table</h4>
            <div class="contact-meta">
              <div>
                <strong>Phone</strong>
                <div>+20 12 3456 7890</div>
              </div>
              <div>
                <strong>Email</strong>
                <div>hello@lacucinadelmare</div>
              </div>
              <div>
                <strong>Address</strong>
                <div>12 Harbor Lane, Liverpool</div>
              </div>
            </div>

            <p class="alt-note">
              Open daily 12:00 — 23:00. For large groups or private events,
              please call.
            </p>

            <div style="margin-top: 0.6rem">
              <a class="alt-btn" href="../Pages/booktabel.html" id="bookLink"
                >Book a table</a
              >
              <a
                style="margin-left: 0.5rem"
                class="alt-btn alt-outline"
                href="../Pages/Menu.html"
                >See menu</a
              >
            </div>
          </aside>
        </div>
      </section>
    </main>

    <footer class="alt-footer">
      <div class="alt-container">
        <p>&copy; <span id="alt-year">2025</span> La Cucina Del Mare</p>
        <nav>
          <a href="/privacy.html">Privacy</a>
          <a href="/terms.html">Terms</a>
        </nav>
      </div>
    </footer>

    <div id="success" class="alt-success" aria-hidden="true">
      <div
        class="box"
        role="dialog"
        aria-modal="true"
        aria-labelledby="successTitle"
      >
        <h3 id="successTitle">Message sent</h3>
        <p>Thanks! Your message has been prepared.</p>
        <button id="closeSuccess" class="alt-btn">OK</button>
      </div>
    </div>

    <!-- <script src="../Scripts/contact.js"></script> -->

   

  </body>
</html>