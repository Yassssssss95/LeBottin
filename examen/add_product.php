<?php require("partials/header.php"); ?>

<div class="container small-container">
<h1>Ajouter un nouveau produit</h1>
</div>

<main>

<form action="add_product.php" method="POST">


    <label for="product_name">Nom du produit<small>*</small></label>
    <input type="text" id="product_name" name="product_name" required>

    <label for="brand_name">Marque<small>*</small></label>
    <input type="text" id="brand_name" name="brand_name" required>

    <label for="price">Prix<small>*</small></label>
    <input type="text" id="price" name="price" required>

    <label for="category">Catégorie<small>*</small></label>
    <select id="category" name="category" required>
        <option value="">Choisissez une catégorie</option>
        <option>chère</option>
        <option>moyen chère</option>
        <option>offert</option>

    </select>

    <label for="weight">Poids</label>
    <input type="number" id="weight" name="weight">

    <label for="description">Description</label>
    <textarea name="description" id="description" cols="30" rows="10"></textarea>
        <br>
    <button type="submit" name="bAjouterp" id="bAjouterp" value="bAjouter" class="create-profile-btn">Ajouter</button>
</form>
<small>* Champs requis</small>
</div>
</main>



<?php
if (isset($_POST['bAjouterp'])) {
    $product_name = $_POST['product_name'];
    $brand_name = $_POST['brand_name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $weight = $_POST['weight'];
    $description = $_POST['description'];

    // Connexion à la base de données
    $mysqli = mysqli_connect('localhost', 'root', '', 'e_commerce');

    // Vérification de la connexion
    if (mysqli_connect_errno()) {
        echo "Erreur de connexion à la base de données: " . mysqli_connect_error();
        exit();
    }

    // Requête préparée pour éviter les injections SQL
    $stmt = $mysqli->prepare("INSERT INTO produits (product_name, brand_name, price, category, weight, description) VALUES (?, ?, ?, ?, ?, ?)");
    
    // Liaison des paramètres et exécution de la requête
    $stmt->bind_param("ssdsss", $product_name, $brand_name, $price, $category, $weight, $description);
    $stmt->execute();

    // Vérification des erreurs d'exécution de la requête
    if ($stmt->errno) {
        echo "Erreur lors de l'ajout du produit: " . $stmt->error;
    } else {
        echo "Produit ajouté avec succès!";
    }

    // Fermeture de la connexion et du statement
    $stmt->close();
    $mysqli->close();
}
?>

<?php require_once("partials/footer.php"); ?>