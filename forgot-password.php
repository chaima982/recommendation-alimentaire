<?php

include 'db.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de Passe Oublié</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-size: 14px;
            background: linear-gradient(120deg, #f6f9fc, #e9ecef);
        }

        .card {
            border-radius: 1.5rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 10px;
            margin-bottom:25px;
        }

        h2, .card-title {
            font-size: 16px;
            font-weight: bold;
        }

        label {
            font-size: 18px;
            font-weight: 500;
        }

        input[type="email"] {
            font-size: 14px;
            padding: 0.75rem;
        }

        button {
            font-size: 14px
            padding: 0.75rem;
        }

        .nav-link, .navbar-brand {
            font-size: 18px;
            font-weight:bold;
        }

        .text-center a {
            font-size:14px;
            text-decoration: none;
            color: #007bff;
        }

        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
   
  
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">MonSite</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="connexion.php">Connexion</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Formulaire Mot de Passe Oublié -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center">Mot de Passe Oublié</h2>
                        <p class="text-center">Veuillez entrer votre adresse email pour récupérer votre mot de passe.</p>

                        <!-- Formulaire -->
                        <form action="recover_password.php" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Adresse Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="exemple@domain.com" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Récupérer le mot de passe</button>
                        </form>

                        <div class="mt-3 text-center">
                            <a href="connexion.php">Retour à la connexion</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
