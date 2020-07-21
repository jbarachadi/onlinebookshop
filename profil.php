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
			echo "<script>location='login.php'</script>";
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

							if ($stmt = $con->prepare('SELECT id, pseudo, name, upper(f_name), centre, email, phone, branch, image FROM users WHERE id = ?')) {
								$stmt->bind_param('i', $_SESSION['id']);
								$stmt->execute();
								$stmt->store_result();
								$stmt->bind_result($id, $pseudo, $nom, $prenom, $centre, $email, $tel, $filiere, $image);
								$stmt->fetch();
							}

							if ($stmttt = $con->prepare("SELECT COUNT(DISTINCT offer_id) FROM offers WHERE seller_id='".$id."'")) {
						
								$stmttt->execute();
								$stmttt->store_result();
								$stmttt->bind_result($nbr_offers);
								$stmttt->fetch();

							}

							if ($stmtt = $con->prepare("SELECT offer_id,book_title, book_subject, book_branch, book_state, book_price FROM offers WHERE seller_id = '".$id."'")) {
								$stmtt->execute();
								$stmtt->store_result();
								$stmtt->bind_result($offre,$titlex, $subjectx, $branchx, $statex, $pricex);
							}


						?>

						<h2 class="animate-box" data-animate-effect="fadeInLeft" style="display:inline;">
							Profil de : <br/><?php echo $_SESSION['name']; ?>
							<a href="editprofil.php">
								<img src="images/edit.png" style="width:30px;height:30px;">
							</a>
						</h2>
						<p>
							<ul class="animate-box" data-animate-effect="fadeInLeft">
								<li><strong>Centre : </li></strong> <?php echo $centre; ?>
								<li><strong>Filière : </li></strong> <?php echo $filiere; ?>
								<li><strong>Numéro de téléphone : </li></strong> <?php echo $tel; ?>
								<li><strong>Email : </li></strong> <?php echo $email; ?>
								<?php if($nbr_offers > 0){ ?><li><strong>Offres : </li></strong> <?php } ?>
							</ul>
						</p>
						<?php if($nbr_offers > 0){ ?>
						<div class="animate-box" data-animate-effect="fadeInLeft" style="width:300%;">
							<table style="border-collapse: collapse;">
								<tr style="border: 2px solid black;padding: 10px 15px;background-color:#BBB;font-weight:bold;">
									<td style="border: 2px solid black;padding: 10px 15px;">Nom du livre</td>
									<td style="border: 2px solid black;padding: 10px 15px;">Matiere</td>
									<td style="border: 2px solid black;padding: 10px 15px;">Filiere</td>
									<td style="border: 2px solid black;padding: 10px 15px;">Etat du livre</td>
									<td style="border: 2px solid black;padding: 10px 15px;">Prix</td>
									<td style="border: 2px solid black;padding: 10px 15px;">Retirer</td>
								</tr>
								<tr style="border: 2px solid black;padding: 10px 15px;">
									<?php while($row=$stmtt->fetch()){ ?>
										<td style="border: 2px solid black;padding: 10px 15px;"><?php echo $titlex; ?></td>
										<td style="border: 2px solid black;padding: 10px 15px;"><?php echo $subjectx; ?></td>
										<td style="border: 2px solid black;padding: 10px 15px;"><?php echo $branchx; ?></td>
										<td style="border: 2px solid black;padding: 10px 15px;"><?php echo $statex; ?></td>
										<td style="border: 2px solid black;padding: 10px 15px;"><?php if($pricex == 0){echo 'Gratuit';}else{echo $pricex;echo ' Dh';} ?></td>
										<td style="border: 2px solid black;padding: 10px 15px;"><a href=<?php $link = "delete.php?offer=" . $offre ; echo $link;?>><img src="images/trash.png" style="position:relative;left:25%;width:25px;height:25px;"/></a></td>
								</tr>
									<?php } ?>
							</table>
						</div>
						<?php } ?>
					</div>
					<div class="animate-box" data-animate-effect="fadeInLeft" style="position:relative;left:32.55%;">
						<img src="<?php echo $image ?>" alt=" " class="img-responsive" style="width:270px;height:270px;">
						<div style="position:relative;">
							<strong>
								<?php echo $prenom; ?>
								<?php echo $nom; ?>
							</strong>
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