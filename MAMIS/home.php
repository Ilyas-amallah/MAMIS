<?php
$connect = mysqli_connect("localhost","root","","mamis");
session_start();
if(!isset($_SESSION["name"])){
  header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MAMIS | Nature’s Finest</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      background-color: #f8f8f8;
      color: #333;
    }

    .hero {
      position: relative;
      background: url('images/home.png') no-repeat center center/cover;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: white;
    }

    .hero::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.4);
      z-index: 1;
    }

    .hero h1 {
      z-index: 2;
      font-size: 3rem;
      text-shadow: 2px 2px 5px #000;
      padding: 0 1rem;
    }

    .product {
      background: white;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transition: transform 0.2s;
      text-align: center;
    }

    .product:hover {
      transform: scale(1.05);
    }

    .product img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .buy-button {
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      padding: 0.5rem 1rem;
      margin: 1rem 0;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .buy-button:hover {
      background-color: #45a049;
    }

    footer {
      background-color: #222;
      color: #ccc;
      text-align: center;
      padding: 1rem;
    }
    body {
      background-color: #f9f9f9;
      font-family: 'Segoe UI', sans-serif;
    }
    .product-card {
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 1rem;
      background-color: white;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .product-card h5 {
      margin-bottom: 0.5rem;
    }
    .navbar-brand {
      font-weight: bold;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">MAMIS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link active" href="home.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
        <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
      </ul>
      <span class="navbar-text me-3 text-white">Hi, <?= $_SESSION["name"]; ?>!</span>
      <a class="btn btn-light" href="logout.php">Log Out</a>
    </div>
  </div>
</nav>

  <section class="hero">
    <h1>Welcome to MAMIS — Where Nature Lives</h1>
  </section>

  <section class="container py-5">
    <h2 class="text-center">Our Products</h2>
    <div class="row justify-content-center mt-4">
      <div class="col-md-4 mb-4">
        <div class="product">
          <img src="images/olive.png" alt="Olive Oil">
          <h3>Organic Olive Oil</h3>
          <p>Cold-pressed, rich in flavor, and 100% natural. Straight from MAMIS land.</p>
          <button class="buy-button" onclick="window.location.href='olive.php'">Buy Now</button>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="product">
          <img src="images/honey.png" alt="Honey">
          <h3>Wild Honey</h3>
          <p>Golden, sweet, and harvested with love. Taste the purity of nature.</p>
          <button class="buy-button" onclick="window.location.href='honey.php'">Buy Now</button>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <p>&copy; 2025 MAMIS. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
