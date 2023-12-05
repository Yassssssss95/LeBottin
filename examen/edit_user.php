<?php require("partials/header.php");

$mysqli = new mysqli("localhost", "root", "", "e_commerce");

if ($mysqli->connect_error) {
    die("La connexion a échoué : " . $mysqli->connect_error);
}

if (isset($_POST['bEditu'])) { // Correction du nom du bouton de modification
    $user_id = $_POST['user_id']; // Récupération de l'identifiant de l'utilisateur

    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "UPDATE utilisateur SET lastname = '$lastname', firstname = '$firstname', email = '$email', password = '$password' WHERE id = $user_id";

    if ($mysqli->query($query) === TRUE) {
        echo "Les informations de l'utilisateur ont été mises à jour avec succès.";
        header("Location: list_user.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour de l'utilisateur : " . $mysqli->error;
    }
}

if (isset($_GET['id']) && !empty($_GET['id'])) { // Utilisation de $_GET pour récupérer l'identifiant
    $user_id = $_GET['id']; // Récupération de l'identifiant de l'utilisateur

    $query = "SELECT * FROM utilisateur WHERE id = $user_id";
    $result = $mysqli->query($query);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc(); // Utilisation de $user pour stocker les données de l'utilisateur
?>
        <main>
        <div class="container small-container">
        <h2>Modifier l'utilisateur</h2>
        </div>

        <form action="" method="POST">

            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">

            <label for="lastname">Nom</label><br>
            <input type="text" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>"><br>

            <label for="firstname">Prénom</label><br>
            <input type="text" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>"><br>

            <label for="email">Email</label><br>
            <input type="text" id="email" name="email" value="<?php echo $user['email']; ?>"><br>

            <label for="password">Mot de passe</label><br>
            <input type="password" id="password" name="password" value="<?php echo $user['password']; ?>"><br>

            <button type="submit" name="bEditu" id="bEditu" value="bEditu">Modifier</button>

        </form>
        </form>
        
<?php
    } else {
        echo "Aucun utilisateur trouvé avec cet identifiant.";
    }
} else {
    echo "Identifiant de l'utilisateur non fourni.";
}

$mysqli->close();

require_once("partials/footer.php");
?>