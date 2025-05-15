<?php
include 'db.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Vérifie si le token est valide
    $query = "SELECT * FROM users WHERE reset_token = ? AND reset_token_expiry > NOW()";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$token]);

    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch();
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['password'])) {
            $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

         
            $update = "UPDATE users SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE id = ?";
            $stmt = $pdo->prepare($update);
            $stmt->execute([$new_password, $user['id']]);

            echo "Mot de passe modifié avec succès. <a href='connexion.php'>Se connecter</a>";
        } else {
            ?>
            <form method="POST"style="  display: flex;
    flex-direction: column;
    gap: 15px;
    max-width: 400px;
    margin: 30px auto;
    padding: 20px;
    border: 2px solid #007bff;
    border-radius: 10px;
    background-color: #f0f8ff;">
                <label style="font-size: 18px; 
    color: #007bff;
    font-weight: bold;">Nouveau mot de passe :</label>
          <input style=" padding: 10px; 
    border: 1px solid #007bff;
    border-radius: 5px;
    font-size: 16px;"  type="password" name="password" required>
                <button style="  padding: 12px;
    background-color: #007bff;
    color: white;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;" type="submit">Réinitialiser</button>
            </form>
            <?php
        }
    } else {
        echo "Lien invalide ou expiré.";
    }
} else {
    echo "Token manquant.";
}
?>
