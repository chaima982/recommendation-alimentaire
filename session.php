<?php
session_start();

// ⚠️ Simule un utilisateur connecté (à remplacer plus tard par un vrai login)
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1; // Par exemple, l'utilisateur avec ID 1
}
?>
