<?php
require 'db.php';
require 'session.php';

$user_id = $_SESSION['user_id'];

// Récupérer la dernière entrée de l'utilisateur
$stmt = $pdo->prepare("SELECT * FROM  imc_results WHERE user_id = ? ORDER BY created_at DESC LIMIT 1");
$stmt->execute([$user_id]);
$latest = $stmt->fetch();

// Insérer un nouveau repas
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom_repas = $_POST['nom_repas'];
    $calories = $_POST['calories'];
    $date = date("Y-m-d");

    $insert = $pdo->prepare("INSERT INTO repas (user_id, date, nom_repas, calories) VALUES (?, ?, ?, ?)");
    $insert->execute([$user_id, $date, $nom_repas, $calories]);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mon Dashboard</title>
    <style>
        body { font-family: Arial; background: #f0f0f0; padding: 20px; }
        .card { background: white; padding: 20px; border-radius: 10px; }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
    </style>
</head>
<body>
<?php  
      include 'header.php';
    ?>
    <div class="container"style="height:100%">
    <div class="card">
        <h2>Bonjour <?= htmlspecialchars($latest['nom']) ?? 'Utilisateur inconnu' ?></h2>
        <p>Poids actuel : <?= $latest['weight'] ?? 'N/A' ?> kg</p>
        <p>Taille : <?= $latest['height'] ?> m</p>
        <p>IMC : <?= $latest['bmi'] ?> (<?= $latest['status'] ?>)</p>

        <form method="POST">
            <label>Nom du repas :</label><br>
            <input type="text" name="nom_repas" required><br>
            <label>Calories :</label><br>
            <input type="number" name="calories" required><br>
            <button type="submit">Ajouter</button>
        </form>
    </div>

    <div class="card" >
        <h3>Historique des repas</h3>
        <table>
            <tr><th>Date</th><th>Nom du repas</th><th>Calories</th></tr>
            <?php
            $repas = $pdo->prepare("SELECT date, nom_repas, calories FROM repas WHERE user_id = ? ORDER BY date DESC");
            $repas->execute([$user_id]);
            $total = 0;
            foreach ($repas as $r) {
                echo "<tr><td>{$r['date']}</td><td>{$r['nom_repas']}</td><td>{$r['calories']}</td></tr>";
                $total += $r['calories'];
            }
            ?>
        </table>
        <p><strong>Total calories :</strong> <?= $total ?> kcal</p>
    </div>
        </div>
    <?php  
      include 'footer.php';
    ?>
</body>
</html>
