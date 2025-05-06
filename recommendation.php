<?php include 'header.php'; ?>
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
?>
<div class="container">
    <h2>Vos recommandations de repas</h2>
    <p>Suggestions basées sur vos préférences alimentaires.</p>
</div>


<?php include 'footer.php'; ?>
