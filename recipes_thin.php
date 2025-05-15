<?php
session_start();
require 'db.php';
include 'header.php';
$type = 'thin';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 6;

// Compter le nombre total de recettes
$stmt = $pdo->prepare("SELECT COUNT(*) FROM recettes WHERE type = ?");
$stmt->execute([$type]);
$totalRecipes = $stmt->fetchColumn();

// Calcul de pagination
$totalPages = ceil($totalRecipes / $perPage);
$start = ($page - 1) * $perPage;

// Récupération des recettes paginées
$stmt = $pdo->prepare("SELECT * FROM recettes WHERE type = ? LIMIT ?, ?");
$stmt->bindValue(1, $type);
$stmt->bindValue(2, $start, PDO::PARAM_INT);
$stmt->bindValue(3, $perPage, PDO::PARAM_INT);
$stmt->execute();
$recipes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Recettes - Prise de poids</title>
  <link rel="stylesheet" href="css/recipes.css" />
</head>
<body>

<div style="min-height:100vh; margin-top:70px;" class="container">
  <h1>Recettes pour Prendre du Poids</h1>
  <p class="calories-info">Besoins caloriques recommandés : <strong>2500 - 3000 kcal/jour</strong></p>

  <div class="recipes-grid">
    <?php foreach ($recipes as $recipe): ?>
      <div class="card">
        <img src="<?= $recipe['image'] ?>" alt="<?= htmlspecialchars($recipe['title']) ?>" />
        <h2><?= htmlspecialchars($recipe['title']) ?></h2>
        <p><?= htmlspecialchars($recipe['description']) ?></p>
        <p><strong>Calories : <?= $recipe['calories'] ?> kcal</strong></p>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Pagination -->
  <div class="pagination">
    <?php if ($page > 1): ?>
      <a href="?page=<?= $page - 1 ?>">«</a>
    <?php endif; ?>
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
      <a href="?page=<?= $i ?>" <?= $i === $page ? 'class="active"' : '' ?>><?= $i ?></a>
    <?php endfor; ?>
    <?php if ($page < $totalPages): ?>
      <a href="?page=<?= $page + 1 ?>">»</a>
    <?php endif; ?>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
