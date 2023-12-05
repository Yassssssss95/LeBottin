<?php
require("partials/header.php");?>

<div class="container small-container">
<h1>se connecter</h1>
</div>


    <form action="admin/admin-login.php" method="POST" id="connectform">
                        
        <label  for="email">email</label>
        <input name="email" type="text" id="email"  />
            
        <label class="form-label" for="password">Mot de passe</label>
        <input name="password" type="password" id="password"/>
                               
        <button type="submit" id="bconnexion" name="bconnexion" value="bconnexion">Se connecter</button>
        </form>
                        
<script>
    // Attend que le DOM soit entièrement chargé avant d'exécuter le code
        document.addEventListener("DOMContentLoaded", function () {

    // on récupère l'élément du formulaire avec l'ID 'loginForm'
    const form = document.getElementById('connectform');
    
        // on vérifie si l'élément du formulaire a été trouvé (n'est pas null)
    if (form) {
        // on ajoute un écouteur d'événement sur la soumission du formulaire
        form.addEventListener('submit', function (event) {
            
        // on récupère les éléments des champs email et password
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            
        // on crée une variable pour suivre s'il y a des erreur
            let error = false;
           
        // Vérifie si le champ email est vide (après suppression des espaces) et on ajoute la classe 'error' pour afficher une bordure rouge
            if (email.value.trim() === '') {
                
                email.classList.add('error');
        // Marque qu'il y a une erreur               
                error = true;
          // Supprime la classe 'error' s'il n'y a pas d'erreur      
            } else {
                email.classList.remove('error');
                
            }

            if (password.value.trim() === '') {
                
                password.classList.add('error');
                error = true;  

            } else {
                password.classList.remove('error');
                
            }

            if (error) {
                event.preventDefault();
                // Empêche l'envoi du formulaire si des erreurs sont détectées
            }
            
        });
    } else {
        console.error("erreur");
        // Affiche une erreur dans la console si l'élément 'connectform' est introuvable
    }
});

</script>