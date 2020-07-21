<?php  
	session_start();
?>

<!DOCTYPE html>
<html class="no-js">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>CPGE BOOKS - Plateforme de vente ou don de livres</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Plateforme de vente ou don de livres" />
	<meta name="keywords" content="cpge books, cpge, livres, prepa, tout en un, python, mp, psi, tsi" />
	<meta name="author" content="2 IWIMistes d'ENSIAS" />

	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>

	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link rel="shortcut icon" href="favicon.ico">

	<link href='fonts/Roboto' rel='stylesheet' type='text/css'>
	<link href='fonts/Montserrat' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/underline.css">

	<script src="js/modernizr-2.6.2.min.js"></script>

	</head>
	<body>
		<div id="fh5co-page">

			<?php include 'sidemenu.php';?>
			<?php if (isset($_SESSION['loggedin']) == TRUE) {
				include 'loggedinbar.php';
			}
			else {
				include 'logbar.php';
			}
			?>

			<div id="fh5co-main">					
				<div class="fh5co-narrow-content" style="padding-top:20px;">
					<div class="row">
						<div class="col-md-24 animate-box">
							<figure class="text-center">
								<img src="images/cpgefam.png" alt="CPGE Family Logo" class="img-responsive">
							</figure>
						</div>
						<div class="animate-box" data-animate-effect="fadeInLeft" class="col-md-0 col-md-push-0">
							<h1>DONNEZ OU VENDEZ VOS LIVRES !</h1>
							<p>Ce site est une plateforme qui facilite la vente ou le don de livres aux élèves des CPGE toutes filières confondues. Aidez vos camarades à atteindre leur buts et accéder aux écoles de leurs rêves. Ne laissez pas traîner les vieux bouquins dont vous n'avez rien à faire.</p>

							<p>Veuillez noter que ce site est toujours en phase de développement, pour quelconque remarque, veuillez accéder à la rubrique "Nous contacter" où un administrateur sera ravi de vous répondre!</p>
						</div>
						<div class="animate-box" data-animate-effect="fadeInLeft" style="float:left;width:50%;">
							<a href="bibliotheque.php">
								<strong>J'achète</strong>
							</a>
							<ul>
								<small>
									<li>Connectez-vous si vous êtes inscrit, ou inscrivez-vous le cas échéant</li>
									<li>Recherchez le livre souhaité dans la bibliothèque, une liste des offres s'affichera</li>
									<li>Vérifiez la disponibilité, et contactez le vendeur</li>
									<li>Vous trouverez les données du vendeur dans la liste des offres</li>
								</small>
							</ul>
						</div>
						<div class="animate-box" data-animate-effect="fadeInLeft" style="float:right;width:50%;">
							<a href="addbook.php">
								<strong>J'offre</strong>
							</a>
							<ul>
								<small>
									<li>Connectez-vous si vous êtes inscrit, ou inscrivez-vous le cas échéant</li>
									<li>Entrez le nom du livre que vous offrez et décrivez l'état du livre</li>
									<li>Entrez le prix auquel vous vendez (champ vide implique Gratuit)</li>
									<li>Vous pouvez consulter votre profil pour gérer vos offres</li>
								</small>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.easing.1.3.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/owl.carousel.min.js"></script>
		<script src="js/jquery.stellar.min.js"></script>
		<script src="js/jquery.waypoints.min.js"></script>
		<script src="js/jquery.countTo.js"></script>
		<script src="js/main.js"></script>

	</body>
</html>

