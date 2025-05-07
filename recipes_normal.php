<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}
include 'header.php';

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Recettes équilibrées (tu peux les charger depuis la base plus tard)
$recipes = [
    [
        "title" => "Salade Quinoa & Pois Chiches",
        "desc" => "Riche en fibres et protéines végétales.",
        "img" => "img/1.png",
        "calories" => 400
    ],
    [
        "title" => "Filet de Poulet & Légumes grillés",
        "desc" => "Source de protéines maigres.",
        "img" => "img/2.png",
        "calories" => 480
    ],
    [
        "title" => "Soupe de Lentilles Corail",
        "desc" => "Idéale pour un dîner léger.",
        "img" => "img/3.png",
        "calories" => 350
    ],
    [
        "title" => "Pâtes Complètes aux Légumes",
        "desc" => "Énergie durable pour la journée.",
        "img" => "img/4.png",
        "calories" => 520
    ],
    [
        "title" => "Toast Avocat & Œuf Poché",
        "desc" => "Petit-déjeuner équilibré et complet.",
        "img" => "img/5.png",
        "calories" => 410
    ],
    [
        "title" => "Yaourt Grec & Fruits",
        "desc" => "Dessert nutritif et rafraîchissant.",
        "img" => "img/6.png",
        "calories" => 300
    ],
    
];

// Calcul pagination
$perPage = 6;
$totalPages = ceil(count($recipes) / $perPage);
$start = ($page - 1) * $perPage;
$currentRecipes = array_slice($recipes, $start, $perPage);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Recettes - Équilibrées</title>
  <link rel="stylesheet" href="css/recipes.css" />
</head>
<body>
<div style="min-height:100vh; margin-top:70px;" class="container">
  <h1>Recettes Équilibrées</h1>
  <p class="calories-info">Besoins caloriques recommandés : <strong>2000 - 2500 kcal/jour</strong></p>

  <div class="recipes-grid">
    <?php foreach ($currentRecipes as $recipe): ?>
      <div class="card">
        <img src="<?= $recipe['img'] ?>" alt="<?= htmlspecialchars($recipe['title']) ?>" />
        <h2><?= htmlspecialchars($recipe['title']) ?></h2>
        <p><?= htmlspecialchars($recipe['desc']) ?></p>
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
      <a href="?page=<?= $i ?>" <?= ($i === $page) ? 'class="active"' : '' ?>><?= $i ?></a>
    <?php endfor; ?>
    <?php if ($page < $totalPages): ?>
      <a href="?page=<?= $page + 1 ?>">»</a>
    <?php endif; ?>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
