<?php require("partials/header.php"); ?>

<div class="container small-container">

<h1>Liste des utilisateurs</h1>
</div>
<?php
$mysqli = new mysqli("localhost", "root", "", "e_commerce");

if ($mysqli->connect_error) {
    die("La connexion a échoué : " . $mysqli->connect_error);
}

$query = "SELECT * FROM utilisateur"; // Correction de la table utilisateur
$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    echo '<table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row["lastname"] . '</td>';
        echo '<td>' . $row["firstname"] . '</td>';
        echo '<td>' . $row["email"] . '</td>';
        echo '<td><a href="edit_user.php?id=' . $row["id"] . '">Modifier</a></td>';
        echo '<td>
                <form action="delete_user.php" method="POST" onsubmit="return confirm(\'Êtes-vous sûr de vouloir supprimer cet utilisateur ?\')">
                    <input type="hidden" name="user_id" value="' . $row["id"] . '">
                    <button type="submit" name="delete_user">Supprimer</button>
                </form>
              </td>';
        echo '</tr>';
    }

    echo '</tbody></table>';
} else {
    echo "Aucun utilisateur trouvé.";
}

$mysqli->close();

require_once("partials/footer.php");
?>