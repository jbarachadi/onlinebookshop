
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

			<?php
					$DATABASE_HOST = 'localhost';
					$DATABASE_USER = 'root';
					$DATABASE_PASS = '';
					$DATABASE_NAME = 'pfa';

					$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

					if ( mysqli_connect_errno() ) {

						die ('Failed to connect to MySQL: ' . mysqli_connect_error());
					
					}
					if ($stmt = $con->prepare('SELECT COUNT(id) FROM users ')) {
						
						$stmt->execute();
						$stmt->store_result();
						$stmt->bind_result($nbr_visits);
						$stmt->fetch();

					}

					if ($stmtt = $con->prepare('SELECT COUNT(book_id) FROM books ')) {
						
						$stmtt->execute();
						$stmtt->store_result();
						$stmtt->bind_result($nbr_books);
						$stmtt->fetch();

					}

					if ($stmttt = $con->prepare('SELECT COUNT(offer_id) FROM offers ')) {
						
						$stmttt->execute();
						$stmttt->store_result();
						$stmttt->bind_result($nbr_offers);
						$stmttt->fetch();

					}
				?>

			<div class="fh5co-narrow-content">
				<div class="row">
					<div class="col-md-5">
						<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft" style="display:inline;">A propos</h2>
						<p class="fh5co-lead animate-box" data-animate-effect="fadeInLeft" style="padding-top: 50px;">Nous sommes deux élèves ingénieurs de l'ENSIAS qui ont décidé de faire d'une pierre, notre PFA, deux coups et aider leurs camarades CPGEistes à trouver plus facilement les ouvrages nécessaires à leurs études.</p>
						<p class="animate-box" data-animate-effect="fadeInLeft">Etant passés par les classes préparatoires, nous savons combien il peut être frustrant de ne pas trouver les livres recommandés par les profs ou les amis, sachant qu'il est assez dur de trouver la motivation de les chercher en premier lieu. Par conséquent, nous avons fait de notre projet de fin d'année un projet dont la communauté CPGEiste peut profiter. Ce site est encore en cours de test, n'hésitez pas à nous contacter au moindre problème survenu. Bonne chance à vous tous et bon courage avec votre préparation.</p>
					</div>
					<div class="col-md-6 col-md-push-1 animate-box" data-animate-effect="fadeInLeft">
						<img src="images/logo_ensias.jpg" alt=" " class="img-responsive"> 
					</div>
				</div>
			</div>

			<div class="fh5co-narrow-content">
				<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft" style="display:inline;">The Team</span></h2>
				<div class="row">
					<div class="col-md-4 fh5co-staff animate-box" data-animate-effect="fadeInLeft" style="padding-top: 50px;">
						<img src="images/person3.jpg" alt="" class="img-responsive">
						<h3>JBARA Chadi</h3>
						<h4>Co-Founder</h4>
						<p>1ère année, IWIM</p><br/>
						<ul class="fh5co-social">
							<li><a href="#"><i class="icon-google"></i></a></li>
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-instagram"></i></a></li>
						</ul>
					</div>
					<div class="col-md-4 fh5co-staff animate-box" data-animate-effect="fadeInLeft" style="padding-top: 50px;">
						<img src="images/person2.jpg" alt="" class="img-responsive">
						<h3>BAHRANI Imane</h3>
						<h4>Co-Founder</h4>
						<p>1ère année, IWIM</p>
						<ul class="fh5co-social" style="position:absolute;top:109%;left:25%;">
							<li><a href="#"><i class="icon-google"></i></a></li>
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-instagram"></i></a></li>
						</ul>
					</div>
					<div class="col-md-4 fh5co-staff animate-box" data-animate-effect="fadeInLeft" style="padding-top: 50px;">
						<img src="images/person4.jpg" alt="" class="img-responsive">
						<h3>M.SENHADJI</h3>
						<h4>Encadrant</h4>
						<p>Professeur</p><br/>
						<ul class="fh5co-social">
							<li><a href="#"><i class="icon-google"></i></a></li>
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-instagram"></i></a></li>
						</ul>
					</div>
				</div>
			</div>

			<div class="fh5co-counters" style="background-image: url(images/hero.jpg);" data-stellar-background-ratio="0.5" id="counter-animate">
				<div class="fh5co-narrow-content animate-box">
					<div class="row" >
						<div class="col-md-4 text-center animate-box">
							<span class="fh5co-counter js-counter" data-from="0" data-to=<?php echo $nbr_visits; ?> data-speed="3000" data-refresh-interval="50"></span>
							<span class="fh5co-counter-label">Utilisateurs</span>
						</div>
						<div class="col-md-4 text-center animate-box">
							<span class="fh5co-counter js-counter" data-from="0" data-to=<?php echo $nbr_books; ?> data-speed="3000" data-refresh-interval="50"></span>
							<span class="fh5co-counter-label">Livres</span>
						</div>
						<div class="col-md-4 text-center animate-box">
							<span class="fh5co-counter js-counter" data-from="0" data-to=<?php echo $nbr_offers; ?> data-speed="3000" data-refresh-interval="50"></span>
							<span class="fh5co-counter-label">Offres</span>
						</div>
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

