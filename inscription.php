
<html>
   
   <head>
      <title></title>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
      <link rel="stylesheet" href="assets/css/style.css" />
   </head>
   <body class="right-sidebar is-preload">
      <div id="page-wrapper">

         <!-- Header -->
            <section id="header">
               <div class="container">

                  <?php include("forum_menus.php"); ?>

               </div>
            </section>

<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=forum', 'root', '');

if(isset($_POST['forminscription'])) {
   $pseudo = htmlspecialchars($_POST['pseudo']);
   $mail = htmlspecialchars($_POST['mail']);
   $mail2 = htmlspecialchars($_POST['mail2']);
   $mdp = sha1($_POST['mdp']);
   $mdp2 = sha1($_POST['mdp2']);
   if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
      $pseudolength = strlen($pseudo);
      if($pseudolength <= 255) {
         if($mail == $mail2) {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
               $reqmail = $bdd->prepare("SELECT * FROM membres WHERE mail = ?");
               $reqmail->execute(array($mail));
               $mailexist = $reqmail->rowCount();
               if($mailexist == 0) {
                  if($mdp == $mdp2) {
                     $insertmbr = $bdd->prepare("INSERT INTO membres(pseudo, mail, motdepasse) VALUES(?, ?, ?)");
                     $insertmbr->execute(array($pseudo, $mail, $mdp));
                     $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
                  } else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                  }
               } else {
                  $erreur = "Adresse mail déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse mail n'est pas valide !";
            }
         } else {
            $erreur = "Vos adresses mail ne correspondent pas !";
         }
      } else {
         $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>



<html>
   <head>
      <title>Register</title>
      <meta charset="utf-8">
   </head>
   <body>
      <div align="center">
         <h1>REGISTER</h1>
       
         <form method="POST" action="">
            
               <div class="pseudo_register">
                  <label for="pseudo">Your Pseudo :</label>
               <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" />
                 
             </div>
               <div class="mail_register">                 
               <label for="mail">Your Mail :</label>
               <input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" />
              </div>
               <div class="confirmation_register">
                  
                     <label for="mail2">Confirmation of the mail :</label>
                  
                     <input type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2; } ?>" />
               </div>
           
               <div class="password_register">
                     <label for="mdp">Password :</label>
                
                     <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" />
               </div>
                
                  <div class="password_confirmation_register">
                     <label for="mdp2">Confirmation of the password :</label>
                  
                     <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" />
                  </div>
                 
                                
                     <input type="submit" class="button_registering" name="forminscription" value="I'm registering" />
          
         
         </form>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
      </div>
   </body>
</html>


