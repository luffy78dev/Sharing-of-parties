<html>
   
	<head>
		<title></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/steels.css" />
	</head>
	<body class="right-sidebar is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<section id="header">
					<div class="container">

					
							

						<!-- Nav -->
						 <?php include("forum_menus.php"); ?>
						 <?php
						/* require('site_soirees/config.php'); */
							require("config.php"); /* Contient la connexion à la $bdd */
							session_start();
							$bdd = new PDO('mysql:host=127.0.0.1;dbname=forum', 'root', '');
							$categories = $bdd->query('SELECT * FROM f_categories ORDER BY nom');
							$subcat = $bdd->prepare('SELECT * FROM f_souscategories WHERE id_categories = ? ORDER BY nom');
							require('views/forum_view.php');
						?> 
							
					</div>
				</section>

			

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>


<!--
modifier la base de données 
-->


<!-- fichier config dans un dossier PHP-->

