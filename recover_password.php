<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = $_POST['email'];

    // Vérifier si l'email existe
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        // Générer un token de réinitialisation
        $token = bin2hex(random_bytes(16));
        $expiry = date("Y-m-d H:i:s", strtotime('+1 hour'));

        // ⚠️ Assurez-vous que la table 'users' a bien les colonnes 'reset_token' et 'reset_token_expiry'
        $update = "UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE email = ?";
        $stmt = $pdo->prepare($update);
        $stmt->execute([$token, $expiry, $email]);

        // Afficher le lien de réinitialisation (pas d'email)
        $reset_link = "http://localhost/recommendation-alimentaire/recommendation-alimentaire/reset_password.php?token=" . $token;
        echo "<p>Lien de réinitialisation : <a href='$reset_link'>$reset_link</a></p>";
    } else {
        echo "Aucun compte trouvé avec cet email.";
    }
}
?>
