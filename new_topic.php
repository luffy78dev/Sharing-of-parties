

<?php

 /* Contient la connexion à la $bdd */
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=forum', 'root', '');



/* Traitement du formulaire de création de Topic */
if(isset($_SESSION['id'])) {
   if(isset($_POST['tsubmit'])) {
      if(isset($_POST['tsujet'],$_POST['tcontenu'])) {
         $sujet = htmlspecialchars($_POST['tsujet']);
         $contenu = htmlspecialchars($_POST['tcontenu']);
         if(!empty($sujet) AND !empty($contenu)) {
            if(strlen($sujet) <= 70) {
               if(isset($_POST['tmail'])) {
                  $notif_mail = 1;
               } else {
                  $notif_mail = 0;
               }
               /*$ins = $bdd->prepare('INSERT INTO f_topics (id_createur,sujet,contenu,date_heure_creation,notif_createur) VALUES(?,?,?,?,NOW())');*/
              $ins = $bdd->prepare('INSERT INTO f_topics (id_createur, sujet, contenu, notif_createur, resolu, date_heure_creation) VALUES(?, ?, ?, ?, 0, NOW())');
               $ins->execute(array($_SESSION['id'],$sujet,$contenu,$notif_mail));
               /*var_dump($_POST, $sujet, $ins);*/
            } else {
               $terror = "Votre sujet ne peut pas dépasser 70 caractères";
            }
         } else {
            $terror = "Veuillez compléter tous les champs";
         }
      }
   }
} else {
   $terror = "Veuillez vous connecter pour poster un nouveau topic";
}

require('views/new_topic.view.php'); /* Appel du fichier "vue" de notre page */
?>



<!--recréer un dossier et voir ce qui va pas -->