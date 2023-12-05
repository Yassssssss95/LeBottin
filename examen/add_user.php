<?php require("partials/header.php"); ?>
<main>
<div class="container small-container">
<h1>Ajouter un nouvel utilisateur</h1>
</div>
<div class=add>
<form action="add_user.php" method="POST">

    <label for="lastname">Nom<small>*</small></label>
    <input type="text" id="lastname" name="lastname" required>

    <label for="firstname">Prénom <small>*</small></label>
    <input type="text" id="firstname" name="firstname" required>

    <label for="email">Email <small>*</small></label>
    <input type="text" id="email" name="email" required>

    <label for="password">Mot de passe <small>*</small></label>
    <input type="password" id="password" name="password" required>
    <br>
    <button type="submit" id="bAjouteru" name="bAjouteru" value="bAjouter">Ajouter</button>


</form>
</div>
</main>

<small>(* Champ requis)</small>

<?php
if (isset($_POST['bAjouteru'])) {
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $mysqli = mysqli_connect("localhost", "root", "", "e_commerce");

    if (mysqli_connect_errno()) {
        echo "La connexion a échoué : " . mysqli_connect_error();
        exit();
    }

    $stmt = $mysqli->prepare("INSERT INTO utilisateur (lastname, firstname, email, password) VALUES (?, ?, ?, ?)");

    if ($stmt) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bind_param("ssss", $lastname, $firstname, $email, $hashed_password);
        $stmt->execute();

        if ($stmt->errno) {
            echo "Erreur lors de l'ajout de l'utilisateur : " . $stmt->error;
        } else {
            echo "Utilisateur ajouté avec succès!";
        }

        $stmt->close();
    } else {
        echo "Erreur de préparation de la requête.";
    }

    $mysqli->close();
}
?>
<?php require_once("partials/footer.php"); ?>