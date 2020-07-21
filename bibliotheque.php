<?php  
	session_start();
?>

<!DOCTYPE php>
<php class="no-js">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>CPGE BOOKS - Plateforme de vente ou don de livres</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Plateforme de vente ou don de livres "/>
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

		<?php
				$DATABASE_HOST = 'localhost';
				$DATABASE_USER = 'root';
				$DATABASE_PASS = '';
				$DATABASE_NAME = 'pfa';

				$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
				if ( mysqli_connect_errno() ) {

						die ('Failed to connect to MySQL: ' . mysqli_connect_error());
				}


				if ($stmt = $con->prepare("SELECT book_id, title, subject, branch, img FROM books")) {
						$stmt->execute();
						$stmt->store_result();
						$stmt->bind_result($id, $titre, $matiere, $filiere, $image);
						$stmt->fetch();
				}
		?>

		<div id="fh5co-main">		
			<div class="fh5co-narrow-content">
				<div>
					<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft" style="display:inline;">Bibliothèque</h2>
					<form method="GET" action="search.php" class="animate-box" data-animate-effect="fadeInLeft" style="float:right;">
						<input id="mysearch" name="searchitem" class="form-control" type="search" list="headers" placeholder="Recherche" style="height:49.5px;" />
						<datalist id=" "></datalist>
						<br/>
						<br/>
					</form>
				</div>
				<div class="row" style="position:relative;float:left;width:950px;">
				<?php do{ ?>
					<div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 work-item animate-box" data-animate-effect="fadeInLeft" style="float:left;width:9em;">
						<a href=<?php $lien= "bookprofil.php?page=" . $id; echo $lien ?>>
							<img src=<?php echo $image?> image alt=" " class="img-responsive" style="width:250px;height:200px;">
							<h3 class="fh5co-work-title"><?php echo $titre ?></h3>
							<p><?php echo $matiere ?>, <?php echo $filiere ?></p>
						</a>
					</div>
				<?php }while($row=$stmt->fetch())?>
				</div>
				<div class="row">
					<div class="col-md-4 animate-box" data-animate-effect="fadeInLeft">
						<h1 class="fh5co-heading-colored">Livre manquant?</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 animate-box" data-animate-effect="fadeInLeft">
						<p class="fh5co-lead" style="font-size: 20px;">Ajoutez-le ici! Ou envoyez un <a href="contact.php">message</a> aux développeurs.</p>
						<p><a href="addbook.php" class="btn btn-primary btn-outline">Ajouter un livre</a></p>
					</div>
					<div class="col-md-7 col-md-push-1">
						<div class="row">
							<div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
								<p style="font-size: 20px;">Il est difficile de créer une base de données contenant tous les livres qui existent! Nous comptons sur vous pour nous aider à l'élargir, facilitant ainsi l'accès à plusieurs autres livres.</p>
							</div>
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
</php>

