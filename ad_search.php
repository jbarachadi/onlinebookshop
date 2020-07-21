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

							if ($stmt = $con->prepare('SELECT title, subject, branch, level, img FROM books WHERE book_id = ?')) {
								$stmt->bind_param('i', $_GET['page']);
								$stmt->execute();
								$stmt->store_result();
								$stmt->bind_result($titre, $matiere, $filiere, $niveau, $image);
								$stmt->fetch();
							}

							if ($stmtt = $con->prepare("SELECT COUNT(DISTINCT offer_id) FROM offers WHERE book_title='".$titre."' AND book_subject='".$matiere."' AND book_branch='".$filiere."'")) {
						
								$stmtt->execute();
								$stmtt->store_result();
								$stmtt->bind_result($availability);
								$stmtt->fetch();

							}

							if ($stmttt = $con->prepare("SELECT DISTINCT offer_id,seller,phone,book_title,book_state,book_price,city FROM offers WHERE book_title='".$titre."' AND book_subject='".$matiere."' AND book_branch='".$filiere."'")) {
						
								$stmttt->execute();
								$stmttt->store_result();
								$stmttt->bind_result($id,$vendeur,$phone,$titrelivre,$etat,$prix,$ville);

							}

							if($_POST["etat"]!="" && $_POST["ville"]!="" && $_POST["prix"]!="ASC")
							{
								if ($stm = $con->prepare("SELECT seller,phone,book_title,book_price FROM offers WHERE city=? AND book_state=? AND book_title=? AND book_subject=? AND book_branch=? ORDER BY book_price ASC")) {
									
									$etat_s=$_POST["etat"];
									$ville_s=$_POST["ville"];

									$stm->bind_param('sssss',$ville_s,$etat_s,$titre,$matiere,$filiere);
									$stm->execute();
									$stm->store_result();
									$stm->bind_result($vendeur_s,$phone_s,$titrelivre_s,$prix_s);
								}
							}
							elseif($_POST["etat"]!="" && $_POST["ville"]!="" && $_POST["prix"]!="DESC")
							{
								if ($stm = $con->prepare("SELECT seller,phone,book_title,book_price FROM offers WHERE city=? AND book_state=? AND book_title=? AND book_subject=? AND book_branch=? ORDER BY book_price DESC")) {
									
									$etat_s=$_POST["etat"];
									$ville_s=$_POST["ville"];

									$stm->bind_param('sssss',$ville_s,$etat_s,$titre,$matiere,$filiere);
									$stm->execute();
									$stm->store_result();
									$stm->bind_result($vendeur_s,$phone_s,$titrelivre_s,$prix_s);
								}
							}
							elseif($_POST["etat"]!="" && $_POST["ville"]!="")
							{
								if ($stm = $con->prepare("SELECT seller,phone,book_title,book_price FROM offers WHERE city=? AND book_state=? AND book_title='".$titre."' AND book_subject='".$matiere."' AND book_branch='".$filiere."'")) {
									
									$etat_s=$_POST["etat"];
									$ville_s=$_POST["ville"];

									$stm->bind_param('ss',$ville_s,$etat_s);
									$stm->execute();
									$stm->store_result();
									$stm->bind_result($vendeur_s,$phone_s,$titrelivre_s,$prix_s);
								}
							}
							elseif($_POST["etat"]!="" && $_POST["prix"]!="ASC")
							{
								if ($stm = $con->prepare("SELECT seller,phone,book_title,city,book_price FROM offers WHERE book_state=? AND book_title=? AND book_subject=? AND book_branch=? ORDER BY book_price ASC")) {
									
									$etat_s=$_POST["etat"];

									$stm->bind_param('ssss',$etat_s,$titre,$matiere,$filiere);
									$stm->execute();
									$stm->store_result();
									$stm->bind_result($vendeur_s,$phone_s,$titrelivre_s,$ville_s,$prix_s);
								}
							}
							elseif($_POST["etat"]!="" && $_POST["prix"]!="DESC")
							{
								if ($stm = $con->prepare("SELECT seller,phone,book_title,city,book_price FROM offers WHERE book_state=? AND book_title=? AND book_subject=? AND book_branch=? ORDER BY book_price DESC")) {
									
									$etat_s=$_POST["etat"];

									$stm->bind_param('ssss',$etat_s,$titre,$matiere,$filiere);
									$stm->execute();
									$stm->store_result();
									$stm->bind_result($vendeur_s,$phone_s,$titrelivre_s,$ville_s,$prix_s);
								}
							}
							elseif($_POST["ville"]!="" && $_POST["prix"]!="ASC")
							{
								if ($stm = $con->prepare("SELECT seller,phone,book_title,book_state,book_price FROM offers WHERE city=? AND book_title=? AND book_subject=? AND book_branch=? ORDER BY book_price ASC")) {
									
									$ville_s=$_POST["ville"];

									$stm->bind_param('ssss',$ville_s,$titre,$matiere,$filiere);
									$stm->execute();
									$stm->store_result();
									$stm->bind_result($vendeur_s,$phone_s,$titrelivre_s,$etat_s,$prix_s);
								}
							}
							elseif($_POST["ville"]!="" && $_POST["prix"]!="DESC")
							{
								if ($stm = $con->prepare("SELECT seller,phone,book_title,book_state,book_price FROM offers WHERE city=? AND book_title=? AND book_subject=? AND book_branch=? ORDER BY book_price DESC")) {
									
									$ville_s=$_POST["ville"];

									$stm->bind_param('ssss',$ville_s,$titre,$matiere,$filiere);
									$stm->execute();
									$stm->store_result();
									$stm->bind_result($vendeur_s,$phone_s,$titrelivre_s,$etat_s,$prix_s);
								}
							}
							elseif($_POST["prix"]!="ASC")
							{
								if ($stm = $con->prepare("SELECT seller,phone,book_title,book_state,city,book_price FROM offers WHERE book_title=? AND book_subject=? AND book_branch=? ORDER BY book_price ASC")) {
									

									$stm->bind_param('sss',$titre,$matiere,$filiere);
									$stm->execute();
									$stm->store_result();
									$stm->bind_result($vendeur_s,$phone_s,$titrelivre_s,$etat_s,$ville_s,$prix_s);
								}
							}
							elseif($_POST["prix"]!="DESC")
							{
								if ($stm = $con->prepare("SELECT seller,phone,book_title,book_state,city,book_price FROM offers WHERE book_title=? AND book_subject=? AND book_branch=? ORDER BY book_price DESC")) {
									

									$stm->bind_param('sss',$titre,$matiere,$filiere);
									$stm->execute();
									$stm->store_result();
									$stm->bind_result($vendeur_s,$phone_s,$titrelivre_s,$etat_s,$ville_s,$prix_s);
								}
							}
							elseif($_POST["ville"]!="")
							{
								if ($stm = $con->prepare("SELECT seller,phone,book_title,book_state,book_price FROM offers WHERE city=? AND book_title='".$titre."' AND book_subject='".$matiere."' AND book_branch='".$filiere."'")) {
									
									$ville_s=$_POST["ville"];

									$stm->bind_param('s',$ville_s);
									$stm->execute();
									$stm->store_result();
									$stm->bind_result($vendeur_s,$phone_s,$titrelivre_s,$etat_s,$prix_s);
								}
							}
							elseif($_POST["etat"]!="")
							{
								if ($stm = $con->prepare("SELECT seller,phone,book_title,book_price,city FROM offers WHERE book_state=? AND book_title='".$titre."' AND book_subject='".$matiere."' AND book_branch='".$filiere."'")) {
									
									$etat_s=$_POST["etat"];

									$stm->bind_param('s',$etat_s);
									$stm->execute();
									$stm->store_result();
									$stm->bind_result($vendeur_s,$phone_s,$titrelivre_s,$prix_s,$ville_s);
								}
							}



						?>

						<h2 class="animate-box" data-animate-effect="fadeInLeft" style="display:inline;">
							<?php echo $titre; ?>
						</h2>
						<p>
							<ul class="animate-box" data-animate-effect="fadeInLeft">
								<li><strong>Matière : </li></strong> <?php echo $matiere; ?>
								<li><strong>Filière : </li></strong> <?php echo $filiere; ?>
								<li><strong>Niveau : </li></strong> <?php echo $niveau; ?>
								<li><strong>Disponibilité : </li></strong> 
									<?php 
										if($availability > 0){ 
											echo $availability;
										}
										else{
											echo 'Aucune offre pour le moment';
										}
									?>
								<?php if($availability > 0){ ?><li><strong>Offres : </li></strong> <?php } ?>
							</ul>
						</p>
						<?php if($availability > 0){ ?>
						

						<div class="animate-box" data-animate-effect="fadeInLeft" style="width:300%;">
							<strong>Résultats de la recherche avancée:</strong>
							<table style="border-collapse: collapse;">
								<tr style="border: 2px solid black;padding: 10px 15px;background-color:#BBB;font-weight:bold;">
									<!--<td style="border: 2px solid black;padding: 10px 15px;">Nom du livre</td>
									<td style="border: 2px solid black;padding: 10px 15px;">Filiere</td>-->
									<td style="border: 2px solid black;padding: 10px 15px;">Etat du livre</td>
									<td style="border: 2px solid black;padding: 10px 15px;">Prix</td>
									<td style="border: 2px solid black;padding: 10px 15px;">Contact du vendeur</td>
									<td style="border: 2px solid black;padding: 10px 15px;">Numéro de téléphone</td>
									<td style="border: 2px solid black;padding: 10px 15px;">Ville</td>
								</tr>
								<tr style="border: 2px solid black;padding: 10px 15px;">
									<?php while($row=$stm->fetch()){ ?>
										<!--<td style="border: 2px solid black;padding: 10px 15px;"><?php echo $titrelivre; ?></td>
										<td style="border: 2px solid black;padding: 10px 15px;"><?php echo $filiere; ?></td>-->
										<td style="border: 2px solid black;padding: 10px 15px;"><?php echo $etat_s; ?></td>
										<td style="border: 2px solid black;padding: 10px 15px;"><?php if($prix_s == 0){echo 'Gratuit';}else{echo $prix_s;echo ' Dh';} ?></td>
										<td style="border: 2px solid black;padding: 10px 15px;"><a href="mailto:<?php echo $vendeur; ?>"><?php echo $vendeur_s; ?></a></td>
										<td style="border: 2px solid black;padding: 10px 15px;"><?php if($phone_s == NULL){echo 'Non renseigné';}else{echo $phone_s;} ?></td>
										<td style="border: 2px solid black;padding: 10px 15px;"><?php echo $ville_s; ?></td>
								</tr>
									<?php } ?>
							</table>
						</div>
						<?php } ?>
					</div>
					<div class="animate-box" data-animate-effect="fadeInLeft" style="position:relative;left:32.55%;">
						<img src="<?php echo $image ; ?>" style="width:230px;height:300px;/>'
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