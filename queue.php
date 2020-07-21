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
			<div class="fh5co-narrow-content">
				<div class="row">
					<div class="col-md-4">

						<?php
							$DATABASE_HOST = 'localhost';
							$DATABASE_USER = 'root';
							$DATABASE_PASS = '';
							$DATABASE_NAME = 'pfa';

							$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
							if ( mysqli_connect_errno() ) {

								die ('Failed to connect to MySQL: ' . mysqli_connect_error());
							}

							if ($stmtt = $con->prepare("SELECT COUNT(DISTINCT offer_id) FROM offers WHERE book_title NOT IN (SELECT title FROM books)")) {
						
								$stmtt->execute();
								$stmtt->store_result();
								$stmtt->bind_result($availability);
								$stmtt->fetch();

							}

							if ($stmttt = $con->prepare('SELECT DISTINCT offer_id,seller,book_title,book_branch,book_subject,book_state,book_price FROM offers WHERE book_title NOT IN (SELECT title FROM books)')) {
						
								$stmttt->execute();
								$stmttt->store_result();
								$stmttt->bind_result($id,$vendeur,$titrelivre,$filiere,$matiere,$etat,$prix);

							}

						?>

						<h2 class="animate-box" data-animate-effect="fadeInLeft">Autres offres</h2>
						
						<div class="animate-box" data-animate-effect="fadeInLeft" style="width:300%;">
							<table style="border-collapse: collapse;">
								<tr style="border: 2px solid black;padding: 10px 15px;background-color:#BBB;font-weight:bold;">
									<td style="border: 2px solid black;padding: 10px 15px;">Nom du livre</td>
									<td style="border: 2px solid black;padding: 10px 15px;">Matiere</td>
									<td style="border: 2px solid black;padding: 10px 15px;">Filiere</td>
									<td style="border: 2px solid black;padding: 10px 15px;">Etat du livre</td>
									<td style="border: 2px solid black;padding: 10px 15px;">Prix</td>
									<td style="border: 2px solid black;padding: 10px 15px;">Contact du vendeur</td>
								</tr>
								<tr style="border: 2px solid black;padding: 10px 15px;">
									<?php while($row=$stmttt->fetch()){ ?>
										<td style="border: 2px solid black;padding: 10px 15px;"><?php echo $titrelivre; ?></td>
										<td style="border: 2px solid black;padding: 10px 15px;"><?php echo $matiere; ?></td>
										<td style="border: 2px solid black;padding: 10px 15px;"><?php echo $filiere; ?></td>
										<td style="border: 2px solid black;padding: 10px 15px;"><?php echo $etat; ?></td>
										<td style="border: 2px solid black;padding: 10px 15px;"><?php if($prix == 0){echo 'Gratuit';}else{echo $prix;' Dh';} ?></td>
										<td style="border: 2px solid black;padding: 10px 15px;"><?php echo $vendeur; ?></td>
								</tr>
									<?php } ?>
							</table>
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