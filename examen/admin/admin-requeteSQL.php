<?php
//On récupère la connexion à la bdd
include('admin-connectdb.php');

//Fonction ajout de l' utilisateur
function insertdata($lastname, $firstname, $email, $password)
{
  //On récupère notre variable global
  global $bdd;
  // Insertion de l'utilisateur
  $sqlUser = "INSERT INTO utilisateur (email, password) VALUES (:email, :password)";
  //On prépare la requête
  $stmtUser = $bdd->prepare($sqlUser);
  //On binde les paramètres
  $stmtUser->bindParam(':email', $email, PDO::PARAM_STR);
  $stmtUser->bindParam(':password', $password, PDO::PARAM_STR);
  //On exécute la requête
  try {
    $stmtUser->execute();
  } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    $message = "Une erreur s'est produite";
  }

  // on récupère l'ID de l'utilisateur inséré
  $sqlLastUser = "SELECT id FROM utilisateur WHERE email = :email LIMIT 1";
  $stmtLastUser = $bdd->prepare($sqlLastUser);
  $stmtLastUser->bindParam(':email', $email, PDO::PARAM_STR);
  try {
    $stmtLastUser->execute();
  } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    $message = "Une erreur s'est produite";
  }
  //on récupère les données de la table sous forme de tableau
  $id = $stmtLastUser->fetchColumn();
}


//Fonction qui vérifie la connexion de l'utilisateur
function connexionUser($email, $password)
{
  //on récupère la variable global (connexion bdd)
  global $bdd;

  // Requête SQL pour vérifier les informations de l'utilisateur
  $sqlUserConnexion = "SELECT u.id, u.lastname, u.firstname, u.email, u.password FROM utilisateur  WHERE u.email = :email AND u.password = :password";
  $stmtUserConnexion = $bdd->prepare($sqlUserConnexion);
  $stmtUserConnexion->bindParam(':email', $email, PDO::PARAM_STR);
  $stmtUserConnexion->execute();

  $donnees = $stmtUserConnexion->fetch(PDO::FETCH_ASSOC);
 // var_dump($donnees);exit;
  // Vérifie si l'utilisateur existe et si le mot de passe correspond
  if ($donnees && (md5($password) == $donnees['password'])) {
    // Les informations d'identification sont correctes, connectez l'utilisateur
    session_start(); // Démarre une session 
    $_SESSION['data'] = null;
    $_SESSION['user_id'] = null;
    $_SESSION['user_id'] = $donnees['id']; // Stocke l'ID de l'utilisateur en session 
    $_SESSION['data'] = ['nom' => $donnees['nom'], 'prenom' => $donnees['prenom']];
    return true; // L'utilisateur est connecté
  } else {
    return false; // Informations d'identification incorrectes
  }
}





