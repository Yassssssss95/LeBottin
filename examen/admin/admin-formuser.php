<?php
if (isset($_POST['bAjouteru'])) {
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    

    var_dump($lastname, $firstname, $email, $password);

     $mysqli = mysqli_connect('localhost', 'root', '', 'e_commerce');
     mysqli_query($mysqli, "INSERT INTO utilisateur VALUES (NULL, '$lastname', '$firstname', '$email', '$password')") or die(mysqli_error($mysqli));
     mysqli_close($mysqli);
}

?>