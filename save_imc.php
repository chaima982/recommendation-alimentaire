<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    die("Utilisateur non connecté !");
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $height = $_POST['height'] ?? null;
    $weight = $_POST['weight'] ?? null;

    if ($height && $weight && $height > 0) {
        $bmi = round($weight / ($height * $height), 2);

        if ($bmi < 18.5) {
            $status = "Maigreur";
        } elseif ($bmi < 25) {
            $status = "Normal";
        } elseif ($bmi < 30) {
            $status = "Surpoids";
        } else {
            $status = "Obésité";
        }

        $stmt = $pdo->prepare("INSERT INTO imc_results (user_id, height, weight, bmi, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $height, $weight, $bmi, $status]);

        echo json_encode([
            "success" => true,
            "bmi" => $bmi,
            "status" => $status
        ]);
    } else {
        echo json_encode(["success" => false, "error" => "Valeurs invalides"]);
    }
} else {
    http_response_code(405);
    echo "Méthode non autorisée";
}
?>
