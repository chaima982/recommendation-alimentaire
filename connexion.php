<?php
session_start();
include 'db.php'; // Assure-toi que ce fichier contient bien la connexion PDO à la base

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Recherche de l'utilisateur dans la base
    $stmt = $pdo->prepare("SELECT id, password, role FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Connexion réussie
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        // Redirection selon le rôle
        if ($user['role'] === 'admin') {
            header("Location: admindashboard.php");
        } else {
            header("Location: dashboard.php");
        }
        exit();
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="cnx.css">
    <link rel="stylesheet" href="save_imc.php">
</head>
<body>
<?php  
      include 'header.php';
    ?>
<div class="container-fluid">
    <div class="row vh-100">
        
        <!-- Partie image -->
        <div class="col-md-6 d-none d-md-block bg-image"></div>

        <!-- Partie formulaire -->
        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <div class="login-box p-5 shadow-lg">
                <h2 class="text-center mb-4" style="font-size:28px;">Sign In</h2>
                
                <!-- Boutons de connexion avec Facebook et Google -->
                <div class="social-login d-flex justify-content-center gap-3 mb-3">
                <a href="https://www.facebook.com/" target="_blank" class="btn btn-primary w-50">Facebook</a>

                <button onclick="window.open('https://mail.google.com/', '_blank')" class="btn btn-danger w-50">Gmail</button>

                </div>

                <p class="text-center" style="font-size:28px;padding:60px">Or sign in with your email</p>

                <!-- Formulaire -->
                <form method="POST" >
                    <input type="email" name="email" class="form-control mb-3" placeholder="Email" required  style="font-size:18px;">
                    <input type="password" name="password" class="form-control mb-3" placeholder="Mot de passe" required  style="font-size:18px;">
                    <br>
                    <br>

                    <button type="submit" name="login" class="btn btn-success w-100">Sign in</button>
                </form>

                <div class="text-center mt-3" style="padding:20px">
                <a href="forgot-password.php" style="font-size:28px;">Forgot password ?</a>

                    <br>
                    <br>

                    <a href="register.php"  style="font-size:28px;">Create an account</a>
                </div>
            </div>
        </div>

    </div>
</div>



</body>
</html>
