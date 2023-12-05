<?php
require("partials/header.php");

$mysqli = new mysqli("localhost", "root", "", "e_commerce");

if ($mysqli->connect_error) {
    die("La connexion a échoué : " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bEditp'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $brand_name = $_POST['brand_name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $weight = $_POST['weight'];
    $description = $_POST['description'];
    
    $query = "UPDATE produits SET product_name = '$product_name', brand_name = '$brand_name', price = '$price', category = '$category', weight = '$weight', description = '$description' WHERE id = $product_id";
    
    if ($mysqli->query($query) === TRUE) {
        echo "Les informations du produit ont été mises à jour avec succès.";
        header("Location: list_product.php"); 
        exit();
    } else {
        echo "Erreur lors de la mise à jour du produit : " . $mysqli->error;
    }
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $product_id = $_GET['id'];
    
    $query = "SELECT * FROM produits WHERE id = $product_id";
    $result = $mysqli->query($query);
    
    if ($result->num_rows === 1) {
        $product = $result->fetch_assoc();
?>      
        <main>
        <div class="container small-container">
        <h2>Modifier le produit</h2>
    </div>
        <form   action=""  method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <label for="product_name">Nom du produit:</label><br>
            <input type="text" id="product_name" name="product_name" value="<?php echo $product['product_name']; ?>"><br>
            
            <label for="brand_name">Marque:</label><br>
            <input type="text" id="brand_name" name="brand_name" value="<?php echo $product['brand_name']; ?>"><br>
            
            <label for="price">Prix:</label><br>
            <input type="text" id="price" name="price" value="<?php echo $product['price']; ?>"><br>
            
            <label for="category">Catégorie:</label><br>
            <input type="text" id="category" name="category" value="<?php echo $product['category']; ?>"><br>
            
            <label for="weight">Poids:</label><br>
            <input type="text" id="weight" name="weight" value="<?php echo $product['weight']; ?>"><br>
            
            <label for="description">Description:</label><br>
            <textarea id="description" name="description"><?php echo $product['description']; ?></textarea><br>
            
            <button type="submit" name="bEditp" id="bEditp" value="bEditp">Modifier</button>
        </form>
        
</main>
<?php
    } else {
        echo "Aucun produit trouvé avec cet identifiant.";
    }
} else {
    echo "Identifiant du produit non fourni.";
}

$mysqli->close();

require_once("partials/footer.php");
?>