<?php
session_start();


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
            <li><a href="../Pages/Menu.php">Menu</a></li>
            <li><a href="../Pages/about-alt.html">About</a></li>
            <li><a href="" class="active">Admin Page</a></li>
            <li><a href="../Pages/cart.php">Cart</a></li>
            <li><a href="../Pages/account.php">Account</a></li>
          </ul>
        </nav>
      </div>
    </header>

    <main class="alt-main">
      <section class="alt-about alt-container" id="contact">
        <div class="contact-card">
          <div>
            <h2>EDIT</h2>
            <p class="alt-note">
                Admin Panel
            </p>

            <form id="contactForm" class="contact-form" method="POST" action="db-edit.php">
                <label for="opType">Select Operation Type:</label>
                <select name="opType" id="cars">
                  <option value="create">Create</option>
                  <option value="read">Read</option>
                  <option value="update">Update</option>
                  <option value="delete">Delete</option>
                </select> 

              <label for="name">Product Name</label>
              <input
                id="name"
                name="name"
                type="text"
                required
                placeholder="Product Name"
              />

              <label for="price">Product Price</label>
              <input
                id="price"
                name="price"
                type="number"
                required
                placeholder="Product Price"
              />

              <label for="image">Image Link</label>
              <input
                id="image"
                name="image"
                type="text"
                required
                placeholder="Link to image"
              />

              <label for="category">Category</label>
              <input
                id="category"
                name="category"
                type="text"
                required
                placeholder="starters/seafood/pasta/dessert"
              />    

              <label for="desc">Description</label>
              <textarea
                id="desc"
                name="desc"
                placeholder="Enter new description..."
              ></textarea>


              <div style="display: flex; gap: 0.5rem; align-items: center">
                <button type="submit" class="alt-btn">Submit</button>
                <button type="reset" class="alt-btn alt-outline">Reset</button>
              </div>
            </form>
          </div>
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

  </body>
</html>
