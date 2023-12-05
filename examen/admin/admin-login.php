<?php 


require("admin-requeteSQL.php");

if(isset($_POST['bconnexion'])){
    $email = ($_POST['email']);
    $password = ($_POST['password']);
    if(connexionUser($email,$password)){
        header("Location: ../index.php");
        exit; 
    }else{
        $message = "l'email et/ou le mot de passe sont/est incorrect.";
        header('Location: ../connexion.php?message='.$message);exit;
    }

}else{
    include('../connexion.php');
}

?>