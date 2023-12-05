<?php require("partials/header.php"); ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_product'])) {
    if (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];

        // Connexion à la base de données
        $mysqli = new mysqli("localhost", "root", "", "e_commerce");

        // Vérification de la connexion
        if ($mysqli->connect_error) {
            die("La connexion a échoué : " . $mysqli->connect_error);
        }

        // Requête pour supprimer le produit
        $delete_query = "DELETE FROM produits WHERE id = ?";
        
        // Préparation de la requête
        $stmt = $mysqli->prepare($delete_query);
        if ($stmt) {
            // Liaison des paramètres et exécution de la requête
            $stmt->bind_param("i", $product_id);
            $stmt->execute();

            // Vérification si la suppression a été effectuée avec succès
            if ($stmt->affected_rows > 0) {
                echo "Le produit a été supprimé avec succès.";
                header("Location: list_product.php"); 
                exit();
            } else {
                echo "La suppression du produit a échoué.";
            }

            // Fermeture de la requête préparée
            $stmt->close();
        } else {
            echo "Erreur lors de la préparation de la requête : " . $mysqli->error;
        }

        // Fermeture de la connexion à la base de données
        $mysqli->close();
    } else {
        echo "L'identifiant du produit à supprimer n'est pas spécifié.";
    }
} else {
    echo "Requête invalide pour la suppression du produit.";
}
?>

<?php require_once("partials/footer.php"); ?>