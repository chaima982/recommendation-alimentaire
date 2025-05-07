<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}
include 'header.php';

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Recettes pour l'obésité (repas équilibrés, modérés en calories)
$recipes = [
    [
        "title" => "Salade de Quinoa & Légumes Grillés",
        "desc" => "Riche en fibres, faible en calories.",
        "img" => "img/11.png",
        "calories" => 300
    ],
    [
        "title" => "Soupe de Lentilles & Carottes",
        "desc" => "Idéale pour un repas léger et nourrissant.",
        "img" => "img/12.png",
        "calories" => 250
    ],
    [
        "title" => "Poisson Grillé & Brocoli Vapeur",
        "desc" => "Faible en gras, riche en protéines.",
        "img" => "img/13.png",
        "calories" => 350
    ],
    [
        "title" => "Wraps de Laitue au Poulet",
        "desc" => "Alternative légère aux sandwichs classiques.",
        "img" => "img/14.png",
        "calories" => 280
    ],
    [
        "title" => "Bowl Végétarien au Tofu",
        "desc" => "Repas équilibré avec légumes variés.",
        "img" => "img/15.png",
        "calories" => 320
    ],
    [
        "title" => "Yaourt Grec aux Fruits Rouges",
        "desc" => "Snack riche en protéines et peu sucré.",
        "img" => "img/16.png",
        "calories" => 200
    ],
    
];


$perPage = 6;
$totalPages = ceil(count($recipes) / $perPage);
$start = ($page - 1) * $perPage;
$currentRecipes = array_slice($recipes, $start, $perPage);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Recettes - Alimentation Équilibrée</title>
  <link rel="stylesheet" href="css/recipes.css" />
</head>
<body>

<div style="min-height:100vh; margin-top:70px;" class="container">
  <h1>Recettes pour une Alimentation Équilibrée</h1>
  <p class="calories-info">Besoins caloriques recommandés : <strong>1800 - 2200 kcal/jour</strong></p>

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
