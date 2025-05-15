<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Buy Organic Honey | MAMIS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f4f4;
    }

    .carousel img {
      height: 300px;
      object-fit: cover;
    }

    .total-price {
      font-size: 1.2rem;
      font-weight: bold;
      margin-top: 1rem;
    }

    .comment-box {
      background: white;
      padding: 1rem;
      border-radius: 10px;
      box-shadow: 0 1px 4px rgba(0,0,0,0.1);
      margin-bottom: 1rem;
    }

    footer {
      background-color: #222;
      color: #ccc;
      text-align: center;
      padding: 1rem;
      margin-top: 4rem;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">MAMIS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
      </ul>
      <div class="d-flex">
        <?php if (isset($_SESSION['id'])): ?>
          <a class="btn btn-light me-2" href="logout.php">Log Out</a>
        <?php else: ?>
          <a class="btn btn-light me-2" href="login.html">Sign In</a>
          <a class="btn btn-outline-light" href="#">Sign Up</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>

<div class="container py-5">
  <!-- Carousel -->
  <div id="productCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/honey.png" class="d-block w-100" alt="Honey 1">
      </div>
      <div class="carousel-item">
        <img src="images/honey.png" class="d-block w-100" alt="Honey 2">
      </div>
      <div class="carousel-item">
        <img src="images/honey.png" class="d-block w-100" alt="Honey 3">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>

  <!-- Product Info -->
  <h2>Organic Honey (1L Jars)</h2>
  <p class="lead">Pure, raw, and unfiltered honey from organic farms. Available in 1-liter glass jars.</p>
  <h4>$20 per jar</h4>

  <div class="mb-3">
    <label for="quantity" class="form-label">Quantity (Jars)</label>
    <input type="number" id="quantity" class="form-control" value="1" step="1" min="1" onchange="updateTotal()" />
  </div>

  <div class="total-price" id="totalPrice">Total: $20.00</div>

  <button class="btn btn-success mt-3" onclick="addToCart()">Add to Cart</button>

  <!-- Comments -->
  <div class="mt-5">
    <h3>Customer Comments</h3>
    <form onsubmit="addComment(event)">
      <div class="mb-3">
        <input type="text" id="username" class="form-control" placeholder="Your name" required>
      </div>
      <div class="mb-3">
        <textarea id="comment" class="form-control" placeholder="Leave a comment..." rows="3" required></textarea>
      </div>
      <button class="btn btn-outline-success">Post Comment</button>
    </form>
    <div id="commentsContainer" class="mt-4"></div>
  </div>
</div>

<footer>
  <p>&copy; 2025 MAMIS. All rights reserved.</p>
</footer>

<script>
  const unitPrice = 20;

  function updateTotal() {
    let qty = parseInt(document.getElementById('quantity').value);
    qty = isNaN(qty) || qty < 1 ? 1 : qty;
    document.getElementById('quantity').value = qty;
    const total = qty * unitPrice;
    document.getElementById('totalPrice').textContent = `Total: $${total.toFixed(2)}`;
  }

  function addToCart() {
    const qty = parseInt(document.getElementById('quantity').value);
    const cart = JSON.parse(localStorage.getItem('cart')) || [];

    const item = {
      id: 'honey-1l',
      name: 'Organic Honey (1L)',
      quantity: qty,
      unit: 'jar',
      pricePerJar: unitPrice,
      total: qty * unitPrice
    };

    cart.push(item);
    localStorage.setItem('cart', JSON.stringify(cart));
    alert(`${item.quantity} jar(s) added to cart.`);
  }

  function addComment(event) {
    event.preventDefault();
    const name = document.getElementById('username').value.trim();
    const text = document.getElementById('comment').value.trim();

    if (name && text) {
      const commentBox = document.createElement('div');
      commentBox.className = 'comment-box';
      commentBox.innerHTML = `<strong>${name}</strong><p>${text}</p>`;
      document.getElementById('commentsContainer').prepend(commentBox);
      document.getElementById('username').value = '';
      document.getElementById('comment').value = '';
    }
  }

  updateTotal();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
