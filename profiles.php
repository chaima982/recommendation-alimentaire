<?php
require_once 'connexion.php';
require_once 'db.php';
require_once 'profile.php';

// Vérifier si l'utilisateur est connecté
if (!isLoggedIn()) {
    header("Location: connexion.php");
    exit();
}

// Récupérer les infos de l'utilisateur
$user = getCurrentUser();
$imc = calculateIMC($user['poids'], $user['taille']);
$diagnostic = getIMCDiagnostic($imc);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de <?= htmlspecialchars($user['firstname']) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/profile.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Bienvenue, <?= htmlspecialchars($user['firstname']) ?> !</h2>

        <div class="card mx-auto" style="max-width: 700px;">
            <div class="row g-0">
                <div class="col-md-4 bg-success text-white d-flex flex-column justify-content-center align-items-center p-3">
                    <img src="<?= !empty($user['photo']) ? htmlspecialchars($user['photo']) : 'img/default-user.png' ?>" 
                         class="img-fluid rounded-circle mb-3" 
                         alt="Photo de profil" 
                         style="width: 120px; height: 120px;">
                    <h5 class="text-center"><?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname']) ?></h5>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Informations personnelles</h4>
                        <div class="mb-3">
                            <p><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></p>
                            <p><strong>Taille :</strong> <?= htmlspecialchars($user['taille']) ?> cm</p>
                            <p><strong>Poids :</strong> <?= htmlspecialchars($user['poids']) ?> kg</p>
                            <p><strong>IMC :</strong> <span class="badge bg-<?= getIMCBadgeColor($imc) ?>"><?= $imc ?></span> 
                            (<?= $diagnostic ?>)</p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="recommandation.php" class="btn btn-success">
                                <i class="bi bi-utensils"></i> Repas recommandés
                            </a>
                            <a href="edit_profile.php" class="btn btn-outline-secondary">
                                <i class="bi bi-pencil"></i> Modifier mon profil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
function calculateIMC($poids, $taille) {
    if ($taille <= 0) return 0;
    $taille_m = $taille / 100;
    return round($poids / ($taille_m * $taille_m), 2);
}

function getIMCDiagnostic($imc) {
    if ($imc < 18.5) return "Maigreur";
    elseif ($imc < 25) return "Normal";
    elseif ($imc < 30) return "Surpoids";
    else return "Obésité";
}

function getIMCBadgeColor($imc) {
    if ($imc < 18.5) return "warning";
    elseif ($imc < 25) return "success";
    elseif ($imc < 30) return "warning";
    else return "danger";
}

function getCurrentUser() {
    global $pdo;
    if (!isset($_SESSION['user_id'])) return null;
    
    $stmt = $pdo->prepare("SELECT * FROM patients WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch();
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}