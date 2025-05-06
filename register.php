<?php
session_start();

$dsn = "mysql:host=localhost;dbname=recommendation;charset=utf8";
$user = "root";
$pass = "";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['register'])) {

  
        if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['password'])) {

            $firstname = htmlspecialchars(trim($_POST['firstname']));
            $lastname = htmlspecialchars(trim($_POST['lastname']));
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Email invalide.";
                header("Location: register.php");
                exit();
            }

            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0) {
                $_SESSION['error'] = "Cet e-mail est déjà utilisé.";
                header("Location: register.php");
                exit();
            }

            // Insertion
            $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
            $stmt->execute([$firstname, $lastname, $email, $password]);

            $_SESSION['success'] = "Inscription réussie !";
            header("Location: connexion.html");
            exit();

        } else {
            $_SESSION['error'] = "Tous les champs sont requis.";
            header("Location: register.php");
            exit();
        }
    }

} catch (PDOException $e) {
    $_SESSION['error'] = "Erreur de connexion : " . $e->getMessage();
    header("Location: register.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="register.css">

</head>
<body>
<?php  
      include 'header.php';
    ?>
    
<div class="container-fluid">
    <div class="row vh-100">
        
        <!-- Left Side Image -->
        <div class="col-md-6 d-none d-md-block bg-image"></div>

        <!-- Right Side Form -->
        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <div class="register-box p-5 shadow-lg">
                <h2 class="text-center mb-4" style="font-size: 28px;">Create an Account</h2>
                <?php
if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
}
?>
<form method="POST" action="register.php " style="  padding: 60px;">
    <input type="text" name="firstname" class="form-control mb-3" placeholder="First Name" required style="height: 70px; font-size: 18px;">
    <input type="text" name="lastname" class="form-control mb-3" placeholder="Last Name" required style="height: 70px; font-size: 18px;">
    <input type="email" name="email" class="form-control mb-3" placeholder="Email" required style="height: 70px; font-size: 18px;">
    <input type="password" name="password" class="form-control mb-3" placeholder="Password" required style="height: 70px; font-size: 18px;">
    <button type="submit" name="register" class="btn btn-success w-100" style="height: 50px; font-size: 20px;margin: top 60px;">Sign Up</button>
</form>


                <div class="text-center mt-3">
                    <p style="font-size:28px ;padding: 30px;">Already have an account? <a href="connexion.php">Log in</a></p>
                </div>
            </div>
        </div>

    </div>
</div>
<?php  
      include 'footer.php';
    ?>
</body>
</html>

