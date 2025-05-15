<?php
require 'db.php';
require 'session.php';

// Vérification que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Récupérer la dernière entrée IMC de l'utilisateur
$stmt = $pdo->prepare("SELECT * FROM imc_results WHERE user_id = ? ORDER BY created_at DESC LIMIT 1");
$stmt->execute([$user_id]);
$latest = $stmt->fetch(PDO::FETCH_ASSOC); // Assure que ce soit un tableau associatif ou false

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
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            padding: 40px;
            margin: 0;
        }

        .cards {
            background: #ffffff;
            padding: 30px;
            margin-bottom: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        h2, h3 {
            font-size: 26px;
            margin-top: 0;
            color: blue;
        }

        p {
            font-size: 18px;
            color: #555;
            margin: 8px 0;
        }

        form {
            margin-top: 25px;
        }

        label {
            font-weight: 600;
            display: block;
            margin: 10px 0 5px;
            font-size: 16px;
        }

        input[type="text"], input[type="number"] {
            padding: 12px;
            margin-bottom: 20px;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            background-color: #fdfdfd;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus, input[type="number"]:focus {
            border-color: #4CAF50;
            outline: none;
        }

        button {
            padding: 12px 24px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            font-size: 17px;
            background-color: #fff;
        }

        th, td {
            padding: 14px 12px;
            border: 1px solid #e0e0e0;
            text-align: left;
        }

        th {
            background-color: #f8f8f8;
            font-weight: 600;
            color: #333;
        }

        strong {
            color: #333;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>

<div style="height:100%;width:100%;background-color:white">
    <div class="cards">
        <h2>Bonjour <?= isset($latest['nom']) ? htmlspecialchars($latest['nom']) : 'Utilisateur' ?></h2>
        <p>Poids actuel : <?= isset($latest['weight']) ? $latest['weight'] . ' kg' : 'N/A' ?></p>
        <p>Taille : <?= isset($latest['height']) ? $latest['height'] . ' m' : 'N/A' ?></p>
        <p>IMC : 
            <?= isset($latest['bmi']) ? $latest['bmi'] : 'N/A' ?>
            <?= isset($latest['status']) ? '(' . $latest['status'] . ')' : '' ?>
        </p>

        <form method="POST">
            <label>Nom du repas :</label>
            <input type="text" name="nom_repas" required>
            <label>Calories :</label>
            <input type="number" name="calories" required>
            <button type="submit">Ajouter</button>
        </form>
    </div>

    <div class="cards">
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

<div style="position: absolute; top:130px ; right:50px">
    <form action="logout.php" method="POST">
        <button type="submit" style="background-color:rgb(64, 53, 220); color: white; border: none; padding: 10px 15px; font-size: 14px; border-radius: 5px; cursor: pointer;">
            🔒 Déconnexion
        </button>
    </form>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
