<?php
// Connexion à la base de données (MySQL avec XAMPP)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recommandation_alimentaire";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Inscription
if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Inscription réussie. Connectez-vous maintenant.";
    } else {
        echo "Erreur: " . $conn->error;
    }
}

// Connexion
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['user'] = $email;
            header("Location: dashboard.php");
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Email non trouvé.";
    }
}
?>

