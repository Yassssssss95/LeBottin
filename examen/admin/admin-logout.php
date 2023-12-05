<?php
// Démarrez la session 
session_start();

// Détruisez la session
session_destroy();

// Redirigez l'utilisateur vers une autre page 
header("Location: ../connexion.php");
exit;
?>