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
				if ($stmt = $con->prepare('SELECT pseudo, name, f_name, centre, email, adress, phone FROM users WHERE id = ?')) {
						
					$stmt->bind_param('i', $_SESSION['id']);
					$stmt->execute();
					$stmt->store_result();
					$stmt->bind_result($pseudo, $nom, $prenom, $centre, $email, $adresse, $tel);
					$stmt->fetch();
				}
			?>

			<div align="right">
				<h4 style="margin:15px 10px 0 0; font-weight: 550; font-size: 15px; width:145px;">
					<a href="logout.php">
						<div style="color:rgba(1,1,1,1);">
							<img src="images/logout.png" style="width:15px;height:15px;margin:0 4px 0 0;">Se déconnecter
						</div>
					</a>
				</h4>
			</div>
			<div style="position:absolute;top:0px;right:170px;">
				<h4 style="margin:15px 10px 0 0; font-weight: 550; font-size: 15px;">
					<a href="addbook.php">
						<div style="color:rgba(1,1,1,1);">
							<img src="images/plus.png" style="width:15px;height:15px;margin:0 4px 0 0;">Ajouter un livre
						</div>
					</a>
				</h4>
			</div>
			<div style="position:absolute;top:0px;right:340px;">
				<h4 style="margin:15px 10px 0 0; font-weight: 550; font-size: 15px;">
					<a href="profil.php">
						<div style="color:rgba(1,1,1,1);">
							<img src="images/login.png" style="width:15px;height:15px;margin:0 4px 0 0;"><?php echo $_SESSION['name']; ?>
						</div>
					</a>
				</h4>
			</div>
				
			<hr/>
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