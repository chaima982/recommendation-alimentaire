<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: connexion.php");
    exit();
}
include 'header.php';
require 'db.php';

$success = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Si c'est une suppression
    if (isset($_POST['delete_id'])) {
        $deleteId = $_POST['delete_id'];
        $stmt = $pdo->prepare("DELETE FROM recettes WHERE id = ?");
        $stmt->execute([$deleteId]);
        $success = "Recette supprimée avec succès !";
    } 
    // Si c'est une modification (vérifie si edit_id n'est pas vide)
    elseif (!empty($_POST['edit_id'])) {
        $editId = $_POST['edit_id'];
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $calories = $_POST['calories'];
        $type = $_POST['type'];

        if ($_FILES['image']['size'] > 0) {
            $imgName = $_FILES['image']['name'];
            $tmpName = $_FILES['image']['tmp_name'];
            $uploadDir = "img/";
            $imagePath = $uploadDir . uniqid() . '_' . $imgName;
            move_uploaded_file($tmpName, $imagePath);
            
            $stmt = $pdo->prepare("UPDATE recettes SET title = ?, description = ?, image = ?, calories = ?, type = ? WHERE id = ?");
            $stmt->execute([$title, $desc, $imagePath, $calories, $type, $editId]);
        } else {
            $stmt = $pdo->prepare("UPDATE recettes SET title = ?, description = ?, calories = ?, type = ? WHERE id = ?");
            $stmt->execute([$title, $desc, $calories, $type, $editId]);
        }
        
        $success = "Recette modifiée avec succès !";
    }
    // Si c'est une nouvelle recette (edit_id est vide)
    else {
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $calories = $_POST['calories'];
        $type = $_POST['type'];

        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imgName = $_FILES['image']['name'];
            $tmpName = $_FILES['image']['tmp_name'];
            $uploadDir = "img/";
            $imagePath = $uploadDir . uniqid() . '_' . $imgName;
            move_uploaded_file($tmpName, $imagePath);

            $stmt = $pdo->prepare("INSERT INTO recettes (title, description, image, calories, type) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$title, $desc, $imagePath, $calories, $type]);

            $success = "Recette ajoutée avec succès !";
        } else {
            $success = "Erreur lors de l'upload de l'image !";
        }
    }
}

// Récupérer toutes les recettes pour affichage
$recettes = $pdo->query("SELECT * FROM recettes ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Gestion des Recettes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        h1 {
            text-align: center; margin-top: 15px;
            color: blue;
        }

        label {
            display: block;
            margin-top: 15px;
            font-size: 20px;
            color: blue;
        }
        input[type="file"] {
            margin-top: 15px;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select,
        p {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }

        button {
            margin-top: 40px;
            width: 100%;
            padding: 12px;
            background: #28a745;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #218838;
        }

        .success {
            color: green;
            text-align: center;
        }

        .main-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin: 50px auto;
            padding: 20px;
            gap: 20px;
            width: 100%;
        }

        .form-box {
            max-width: 50%;
            width: 100%;
            min-height: 700px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            margin-top: 15px;
            border-radius: 8px;
        }

        .hero-img-box {
            max-width: 50%;
            width: 100%;
        }

        .hero-img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        /* Style pour la table */
        .recettes-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .recettes-table th, .recettes-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .recettes-table th {
            background-color: #f2f2f2;
            color: #333;
        }

        .recettes-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .recettes-table tr:hover {
            background-color: #f1f1f1;
        }

        .action-btn {
            padding: 5px 10px;
            margin: 0 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .edit-btn {
            background-color:rgb(7, 247, 255);
            color: #000;
        }

        .edit-btn:hover {
            background-color:rgb(7, 224, 0);
        }

        .delete-btn {
            background-color: #dc3545;
            color: #fff;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: black;
        }

        /* Style pour le bouton "Voir les recettes" */
        .view-recipes-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .view-recipes-btn:hover {
            background-color: #0069d9;
        }

        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
                align-items: center;
            }

            .form-box,
            .hero-img-box {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="main-container">
    <div class="hero-img-box">
        <picture>
            <source srcset="img/hero.webp" type="image/webp" />
            <source srcset="img/hero-min.png" type="image/png" />
            <img src="img/hero-min.png" class="hero-img" alt="Woman enjoying food" />
        </picture>
    </div>
    <div class="form-box">
        <h1>Gestion des Recettes</h1>
        <?php if ($success): ?><p class="success"><?= $success ?></p><?php endif; ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="edit_id" id="edit_id" value="">
            <label>Titre :</label>
            <input type="text" name="title" id="edit_title" required>

            <label>Description :</label>
            <textarea name="desc" id="edit_desc" required></textarea>

            <label>Calories :</label>
            <input type="number" name="calories" id="edit_calories" required>

            <label>Type :</label>
            <select name="type" id="edit_type" required>
                <option value="obese">Obèse</option>
                <option value="normal">Normal</option>
                <option value="thin">Maigre</option>
            </select>

            <label>Image :</label>
            <input type="file" name="image" accept="image/*" id="edit_image">
            <p id="current_image"></p>

            <button type="submit" id="form_submit_btn">Ajouter</button>
        </form>
        
        <button class="view-recipes-btn" onclick="toggleRecipesTable()">Voir les recettes</button>
    </div>
</div>

<!-- Tableau des recettes (caché par défaut) -->
<div id="recipes-table-container" style="display: none; width: 90%; margin: 20px auto;">
    <h2>Liste des Recettes</h2>
    <table class="recettes-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Image</th>
                <th>Calories</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recettes as $recette): ?>
            <tr>
                <td><?= $recette['id'] ?></td>
                <td><?= htmlspecialchars($recette['title']) ?></td>
                <td><?= htmlspecialchars(substr($recette['description'], 0, 50)) ?>...</td>
                <td><img src="<?= $recette['image'] ?>" alt="Image recette" style="width: 50px; height: auto;"></td>
                <td><?= $recette['calories'] ?></td>
                <td><?= ucfirst($recette['type']) ?></td>
                <td>
                    <button class="action-btn edit-btn" onclick="editRecipe(<?= $recette['id'] ?>, '<?= addslashes($recette['title']) ?>', '<?= addslashes($recette['description']) ?>', <?= $recette['calories'] ?>, '<?= $recette['type'] ?>', '<?= $recette['image'] ?>')">
                        <i class="fas fa-edit"></i> Modifier
                    </button>
                    <form action="" method="POST" style="display: inline;">
                        <input type="hidden" name="delete_id" value="<?= $recette['id'] ?>">
                        <button type="submit" class="action-btn delete-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette recette?')">
                            <i class="fas fa-trash-alt"></i> Supprimer
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>

<script>
    // Fonction pour afficher/masquer le tableau des recettes
    function toggleRecipesTable() {
        const tableContainer = document.getElementById('recipes-table-container');
        if (tableContainer.style.display === 'none') {
            tableContainer.style.display = 'block';
        } else {
            tableContainer.style.display = 'none';
        }
    }
    
    // Fonction pour éditer une recette
    function editRecipe(id, title, desc, calories, type, image) {
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_title').value = title;
        document.getElementById('edit_desc').value = desc;
        document.getElementById('edit_calories').value = calories;
        document.getElementById('edit_type').value = type;
        document.getElementById('current_image').innerHTML = 'Image actuelle: <img src="' + image + '" style="width:50px;">';
        document.getElementById('form_submit_btn').textContent = 'Modifier';
        
        // Faire défiler jusqu'au formulaire
        document.querySelector('.form-box').scrollIntoView({ behavior: 'smooth' });
    }
    
    // Réinitialiser le formulaire pour une nouvelle recette
    function resetForm() {
        document.getElementById('edit_id').value = '';
        document.getElementById('edit_title').value = '';
        document.getElementById('edit_desc').value = '';
        document.getElementById('edit_calories').value = '';
        document.getElementById('edit_type').selectedIndex = 0;
        document.getElementById('current_image').innerHTML = '';
        document.getElementById('edit_image').value = '';
        document.getElementById('form_submit_btn').textContent = 'Ajouter';
        document.querySelector('form').reset();
    }
    
    // Réinitialiser le formulaire après soumission
    <?php if ($success): ?>
        setTimeout(() => {
            resetForm();
            document.getElementById('recipes-table-container').style.display = 'block';
        }, 1500);
    <?php endif; ?>
</script>

<form action="logout.php" method="POST" style="position: absolute; top:80px; left: 20px;">
    <button type="submit" class="logout-btn">
        🔒 Déconnexion
    </button>
</form>

</body>
</html>