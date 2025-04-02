<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recommandation_alimentaire";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

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

?>

