<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imc = $_POST['imc'];
    $status = $_POST['status'];
    $recommendation = $_POST['recommendation'];

    $stmt = $pdo->prepare("INSERT INTO recipes (user_id, imc, status, recommendation) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $imc, $status, $recommendation]);

    echo "Recommendation saved successfully.";
}
?>
