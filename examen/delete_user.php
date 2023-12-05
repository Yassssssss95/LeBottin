<?php require("partials/header.php"); ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_user'])) {
    if (isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];

        // Connexion à la base de données
        $mysqli = new mysqli("localhost", "root", "", "e_commerce");

        // Vérification de la connexion
        if ($mysqli->connect_error) {
            die("La connexion a échoué : " . $mysqli->connect_error);
        }

        // Requête pour supprimer le produit
        $delete_query = "DELETE FROM utilisateur WHERE id = ?";

        // Préparation de la requête
        $stmt = $mysqli->prepare($delete_query);
        if ($stmt) {
            // Liaison des paramètres et exécution de la requête
            $stmt->bind_param("i", $user_id);
            $stmt->execute();

            // Vérification si la suppression a été effectuée avec succès
            if ($stmt->affected_rows > 0) {
                echo "L'utilisateur a été supprimé avec succès.";
                header("Location: list_user.php"); 
                exit();
            } else {
                echo "La suppression de l'utilisateur a échoué.";
            }

            // Fermeture de la requête préparée
            $stmt->close();
        } else {
            echo "Erreur lors de la préparation de la requête : " . $mysqli->error;
        }

        // Fermeture de la connexion à la base de données
        $mysqli->close();
    } else {
        echo "L'identifiant de l'utilisateur à supprimer n'est pas spécifié.";
    }
} else {
    echo "Requête invalide pour la suppression de l'utilisateur.";
}
?>

<?php require_once("partials/footer.php"); ?>