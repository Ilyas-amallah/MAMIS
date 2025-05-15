<?php
session_start();
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include("connect.php");

    $nom = trim($_POST["nom"]);
    $prenom = trim($_POST["prenom"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $adresse = trim($_POST["adresse"]);
    $telephone = trim($_POST["telephone"]);

    if (empty($nom) || empty($prenom) || empty($email) || empty($password) || empty($adresse) || empty($telephone)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $statut = 1;
        $type = 0;
        $alert = 0;

        // Check for existing email
        $stmt = $connect->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "An account with this email already exists.";
        } else {
            $stmt = $connect->prepare("INSERT INTO users (nom, prenom, email, password, adresse, telephone, statut, type, alert) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssiii", $nom, $prenom, $email, $hashed_password, $adresse, $telephone, $statut, $type, $alert);
            if ($stmt->execute()) {
                $_SESSION["id"] = $stmt->insert_id;
                $_SESSION["name"] = $nom;
                header("Location: home.php");
                exit();
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Sign Up | MAMIS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f0f0f0;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding-top: 40px;
      min-height: 100vh;
      font-family: 'Segoe UI', sans-serif;
    }
    .login-box {
      background: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px;
      margin-bottom: 40px;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h2 class="text-center mb-4">Sign Up to MAMIS</h2>

    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <div class="mb-3">
        <label class="form-label">Nom</label>
        <input type="text" class="form-control" name="nom" required value="<?= isset($nom) ? htmlspecialchars($nom) : '' ?>" />
      </div>
      <div class="mb-3">
        <label class="form-label">Prénom</label>
        <input type="text" class="form-control" name="prenom" required value="<?= isset($prenom) ? htmlspecialchars($prenom) : '' ?>" />
      </div>
      <div class="mb-3">
        <label class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" required value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" />
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password" required />
      </div>
      <div class="mb-3">
        <label class="form-label">Adresse</label>
        <input type="text" class="form-control" name="adresse" required value="<?= isset($adresse) ? htmlspecialchars($adresse) : '' ?>" />
      </div>
      <div class="mb-3">
        <label class="form-label">Téléphone</label>
        <input type="text" class="form-control" name="telephone" required value="<?= isset($telephone) ? htmlspecialchars($telephone) : '' ?>" />
      </div>
      <button type="submit" class="btn btn-success w-100">Sign Up</button>
    </form>

    <p class="text-center mt-3">
      Already have an account? <a href="login.php">Login</a>
    </p>
  </div>
</body>
</html>
