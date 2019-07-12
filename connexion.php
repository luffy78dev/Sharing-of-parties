<?php


 

session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_POST['formconnexion'])) {
   $mailconnect = htmlspecialchars($_POST['mailconnect']);
   $mdpconnect = sha1($_POST['mdpconnect']);
   if(!empty($mailconnect) AND !empty($mdpconnect)) {
      $requser = $bdd->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?");
      $requser->execute(array($mailconnect, $mdpconnect));
      $userexist = $requser->rowCount();
      if($userexist == 1) {
         $userinfo = $requser->fetch();
         $_SESSION['id'] = $userinfo['id'];
         $_SESSION['pseudo'] = $userinfo['pseudo'];
         $_SESSION['mail'] = $userinfo['mail'];
         header("Location: profil.php?id=".$_SESSION['id']);
      } else {
         $erreur = "Mauvais mail ou mot de passe !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>
<html>
   <head>
      <title></title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="assets/css/style.css" />
      <link rel="stylesheet" href="assets/css/main.css" />
   </head>
   <!--Include forum menus-->
   <?php include("forum_menus.php"); ?>
   <body>
      <div class="">
         <h2 class="connexion_title">Connexion</h2>
        
         <form method="POST" action="">
            <div class="button_mail_connexion">
               <input type="email" class="input_mail_connexion" name="mailconnect" placeholder="Mail" />
            </div>
               <div class="password_connexion">
                  <input type="password" class="input_password_connexion" name="mdpconnect" placeholder="Mot de passe" />
               </div>
            <input type="submit" name="formconnexion" class="button_login" value="LOGIN" />
         </form>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
      </div>
   </body>
</html>


<!--1)mise à jour de la page connexion avec le css de register
   -->


modifier design css du menu en prenant que la partie du menu main
