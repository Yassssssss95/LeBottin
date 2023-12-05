<?php

if (isset($_POST['bAjouterp'])) {
    $product_name = $_POST['product_name'];
    $brand_name = $_POST['brand_name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $weight = $_POST['weight'];
    $description = $_POST['description'];

    var_dump($product_name, $brand_name, $price, $category, $weight, $description);

    $mysqli = mysqli_connect('localhost', 'root', '', 'e_commerce');
            mysqli_query($mysqli, "INSERT INTO produits VALUES (NULL, '$product_name', '$brand_name', '$price', '$category', '$weight', '$description')") or die(mysqli_error($mysqli));
            mysqli_close($mysqli);
}

?>