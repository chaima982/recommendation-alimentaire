<?php
require_once 'connexion.php';
require_once 'db.php';
require_once 'profile.php';

if (!isLoggedIn()) {
    header("Location: connexion.php");
    exit();
}

$user = getCurrentUser();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validation et traitement du formulaire
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $taille = (int)$_POST['taille'];
    $poids = (float)$_POST['poids'];
    
    // Validation simple
    if (empty($firstname)) $errors[] = "Le prénom est requis";
    if (empty($lastname)) $errors[] = "Le nom est requis";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email invalide";
    if ($taille < 100 || $taille > 250) $errors[] = "Taille invalide";
    if ($poids < 30 || $poids > 300) $errors[] = "Poids invalide";
    
    // Traitement de la photo
    $photo = $user['photo'];
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/profiles/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
        
        $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $extension;
        $destination = $uploadDir . $filename;
        
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $destination)) {
            $photo = $destination;
            // Supprimer l'ancienne photo si ce n'est pas la photo par défaut
            if (!empty($user['photo']) && strpos($user['photo'], 'default-user.png') === false) {
                @unlink($user['photo']);
            }
        }
    }
    
    if (empty($errors)) {
        $stmt = $pdo->prepare("UPDATE patients SET firstname = ?, lastname = ?, email = ?, taille = ?, poids = ?, photo = ? WHERE id = ?");
        $stmt->execute([$firstname, $lastname, $email, $taille, $poids, $photo, $_SESSION['user_id']]);
        
        $_SESSION['success_message'] = "Profil mis à jour avec succès";
        header("Location: profile.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier mon profil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/profile.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0">Modifier mon profil</h3>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= htmlspecialchars($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstname" class="form-label">Prénom</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" 
                                           value="<?= htmlspecialchars($user['firstname']) ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastname" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" 
                                           value="<?= htmlspecialchars($user['lastname']) ?>" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?= htmlspecialchars($user['email']) ?>" required>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="taille" class="form-label">Taille (cm)</label>
                                    <input type="number" class="form-control" id="taille" name="taille" 
                                           value="<?= htmlspecialchars($user['taille']) ?>" min="100" max="250" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="poids" class="form-label">Poids (kg)</label>
                                    <input type