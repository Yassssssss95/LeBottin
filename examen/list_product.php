<?php
require("partials/header.php");?>

<div class="container small-container">

<h1>Liste des produits</h1>
</div>
<?php
// Connexion à la base de données
$mysqli = new mysqli("localhost", "root", "", "e_commerce");

// Vérification de la connexion
if ($mysqli->connect_error) {
    die("La connexion a échoué : " . $mysqli->connect_error);
}

// Récupération des produits depuis la base de données
$query = "SELECT * FROM produits";
$result = $mysqli->query($query);

// Affichage des produits dans le tableau HTML
if ($result->num_rows > 0) {
    
    echo '<div class="table-container">
            <table>
            <thead>
                <tr>
                    <th>Nom du produit</th>
                    <th>Marque</th>
                    <th>Prix</th>
                    <th>Catégorie</th>
                    <th>Poids</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row["product_name"] . '</td>';
        echo '<td>' . $row["brand_name"] . '</td>';
        echo '<td>' . $row["price"] . '</td>';
        echo '<td>' . $row["category"] . '</td>';
        echo '<td>' . $row["weight"] . '</td>';
        echo '<td>' . $row["description"] . '</td>';
        echo '<td><a href="edit_product.php?id=' . $row["id"] . '">Modifier</a></td>';
       
        echo '<td>
            <form action="delete_product.php" method="POST" onsubmit="return confirm(\'Êtes-vous sûr de vouloir supprimer ce produit ?\')">
                <input type="hidden" name="product_id" value="' . $row["id"] . '">
                <button type="submit" name="delete_product">Supprimer</button>
            </form>
        </td>';
        
        echo '</tr>';
    }
    
    echo '</tbody></table></div>';
} else {
    echo "Aucun produit trouvé.";
}


$mysqli->close();

require_once("partials/footer.php");
?>