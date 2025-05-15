<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = 'client'; 

    $stmt = $pdo->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, ?)");
    $stmt->execute([$email, $password, $role]);

    $_SESSION['user_id'] = $pdo->lastInsertId();
    $_SESSION['role'] = $role;

    if ($role === 'admin') {
        header("Location: connexion.php");
    } else {
        header("Location: connexion.php");
    }
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
    <link rel="stylesheet" href="save_imc.php">

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

