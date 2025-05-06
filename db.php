<?php
$host = 'localhost';
$dbname = 'recommendation';
$username = 'root';
$password = '';     

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
   
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$height = $_POST['height'];
$weight = $_POST['weight'];
$bmi = $_POST['bmi'];
$status = $_POST['status'];

// Insertion dans la base de données
$stmt = $pdo->prepare("INSERT INTO imc_results (height, weight, bmi, status) VALUES (?, ?, ?, ?)");
$stmt->execute([$height, $weight, $bmi, $status]);

echo "success";

}catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
