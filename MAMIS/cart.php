<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>My Cart | MAMIS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f4f4f4;
      font-family: 'Segoe UI', sans-serif;
    }
    .cart-container {
      margin-top: 3rem;
      background: white;
      padding: 2rem;
      border-radius: 10px;
      max-width: 800px;
      margin-left: auto;
      margin-right: auto;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .empty-cart {
      text-align: center;
      padding: 2rem;
      color: #777;
    }
  </style>
</head>
<body>
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

<div class="cart-container">
  <h2>My Shopping Cart</h2>
  <div id="cartItems"></div>
  <div id="cartTotal" class="mt-3 fs-5 fw-bold"></div>
  <button id="clearCartBtn" class="btn btn-danger mt-3">Clear Cart</button>
</div>

<script>
  function renderCart() {
    const cartItemsDiv = document.getElementById('cartItems');
    const cartTotalDiv = document.getElementById('cartTotal');
    const cart = JSON.parse(localStorage.getItem('cart')) || [];

    if (cart.length === 0) {
      cartItemsDiv.innerHTML = `<p class="empty-cart">Your cart is empty.</p>`;
      cartTotalDiv.textContent = '';
      return;
    }

    let totalPrice = 0;
    cartItemsDiv.innerHTML = '';

    cart.forEach((item, index) => {
      totalPrice += item.total;
      const itemDiv = document.createElement('div');
      itemDiv.className = 'd-flex justify-content-between align-items-center border-bottom py-2';

      itemDiv.innerHTML = `
        <div>
          <strong>${item.name}</strong> - ${item.bottles} bottle(s) (${item.quantity} ${item.unit})
        </div>
        <div>
          $${item.total.toFixed(2)}
          <button class="btn btn-sm btn-outline-danger ms-3" onclick="removeItem(${index})">Remove</button>
        </div>
      `;
      cartItemsDiv.appendChild(itemDiv);
    });

    cartTotalDiv.textContent = `Total: $${totalPrice.toFixed(2)}`;
  }

  function removeItem(index) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart));
    renderCart();
  }

  document.getElementById('clearCartBtn').addEventListener('click', () => {
    if (confirm("Are you sure you want to clear the cart?")) {
      localStorage.removeItem('cart');
      renderCart();
    }
  });

  renderCart();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
