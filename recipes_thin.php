<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}
include 'header.php';


$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;


$recipes = [
    [
        "title" => "Smoothie Banane & Beurre de Cacahuète",
        "desc" => "Riche en protéines et en graisses saines.",
        "img" => "img/22.png",
        "calories" => 450
    ],
    [
        "title" => "Porridge Avoine & Fruits Secs",
        "desc" => "Parfait pour un petit-déjeuner énergétique.",
        "img" => "img/21.png",
        "calories" => 500
    ],
    [
        "title" => "Bol de Riz, Poulet & Avocat",
        "desc" => "Riche en protéines et en bons lipides.",
        "img" => "img/23.png",
        "calories" => 650
    ],
    [
        "title" => "Pâtes Carbonara Maison",
        "desc" => "Plat riche et savoureux pour le déjeuner.",
        "img" => "img/24.png",
        "calories" => 700
    ],
    [
        "title" => "Omelette aux Fromages & Légumes",
        "desc" => "Parfait pour un dîner riche en énergie.",
        "img" => "img/25.png",
        "calories" => 550
    ],
    [
        "title" => "Toast Beurre & Miel",
        "desc" => "Snack rapide à haute densité calorique.",
        "img" => "img/20.png",
        "calories" => 350
    ],
  
];

// Pagination
$perPage = 6;
$totalPages = ceil(count($recipes) / $perPage);
$start = ($page - 1) * $perPage;
$currentRecipes = array_slice($recipes, $start, $perPage);
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
    <?php foreach ($currentRecipes as $recipe): ?>
      <div class="card">
        <img src="<?= $recipe['img'] ?>" alt="<?= $recipe['title'] ?>" />
        <h2><?= $recipe['title'] ?></h2>
        <p><?= $recipe['desc'] ?></p>
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
