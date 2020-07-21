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
			<div class="fh5co-narrow-content" style="padding-bottom:160px;">
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

							if ($stmt1 = $con->prepare("SELECT DISTINCT book_state FROM offers WHERE book_title='".$titre."' AND book_subject='".$matiere."' AND book_branch='".$filiere."' ORDER BY book_state")) {
											
											$stmt1->execute();
											$stmt1->store_result();
											$stmt1->bind_result($etat_s);
											$stmt1->fetch();
							}

							if ($stmt2 = $con->prepare("SELECT DISTINCT city FROM offers WHERE book_title='".$titre."' AND book_subject='".$matiere."' AND book_branch='".$filiere."' ORDER BY city")) {
											
											$stmt2->execute();
											$stmt2->store_result();
											$stmt2->bind_result($ville_s);
											$stmt2->fetch();
							}

							if ($stmt3 = $con->prepare("SELECT DISTINCT book_price FROM offers WHERE book_title='".$titre."' AND book_subject='".$matiere."' AND book_branch='".$filiere."' ORDER BY book_price")) {
											
											$stmt3->execute();
											$stmt3->store_result();
											$stmt3->bind_result($prix_s);
											$stmt3->fetch();
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
						<?php if($availability > 0){ ?>
								<li><strong>Offres : </li></strong>
							</ul>
							<div class="animate-box" data-animate-effect="fadeInLeft" style="position:absolute;left:240%;width:70%;">
								<div id="divsearch" style="padding-bottom:5px;">
									<strong>
										<a name="advSearch" class="on-hover-text" style="color:rgba(1,1,1,1);cursor:pointer;color:rgba(0, 0, 0, 0.5);">Recherche avancée <img src="images/down.png" style="width:20px;height:20px;"/></a>
									</strong>
								</div>
								<div id="advSearch">
									<form action='ad_search.php?page=<?php echo $_GET['page'];?>' method='POST'>
										<select name="etat" type="text" class="form-control">
											<option value="">Etat</option>
											<?php do{ ?>
												<option value=<?php echo $etat_s ?>><?php echo $etat_s ?></option>
											<?php }while($row=$stmt1->fetch()) ?>		
										</select>

										<select name="ville" type="text" class="form-control">
											<option value="">Ville</option>
											<?php do{ ?>
												<option value=<?php echo $ville_s ?>><?php echo $ville_s ?></option>
											<?php }while($row=$stmt2->fetch()) ?>		
										</select>
										
										<select name="prix" type="text" class="form-control">
											<option value="">Prix</option>
											<option value="ASC">Ordre décroissant</option>
											<option value="DESC">Ordre croissant</option>
										</select>
										<div style="padding-top:15px;">
											<a href="ad_search.php" >
												<input name="submit" type="submit" class="btn btn-primary btn-md" value="Trier">
											</a>
										</div>
									</form>
								</div>
								<script>
									$(function(){
										$('#advSearch').hide();
										$('#divsearch').click(function(){
									    	$('#advSearch').toggle()
									   });
									});
								</script>
							</div>
							<div class="animate-box" data-animate-effect="fadeInLeft" style="width:250%;">
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
										<?php while($row=$stmttt->fetch()){ ?>
											<!--<td style="border: 2px solid black;padding: 10px 15px;"><?php echo $titrelivre; ?></td>
											<td style="border: 2px solid black;padding: 10px 15px;"><?php echo $filiere; ?></td>-->
											<td style="border: 2px solid black;padding: 10px 15px;"><?php echo $etat; ?></td>
											<td style="border: 2px solid black;padding: 10px 15px;"><?php if($prix == 0){echo 'Gratuit';}else{echo $prix;echo ' Dh';} ?></td>
											<td style="border: 2px solid black;padding: 10px 15px;"><a href="mailto:<?php echo $vendeur; ?>"><?php echo $vendeur; ?></a></td>
											<td style="border: 2px solid black;padding: 10px 15px;"><?php if($phone == NULL){echo '----';}else{echo $phone;} ?></td>
											<td style="border: 2px solid black;padding: 10px 15px;"><?php echo $ville; ?></td>
									</tr>
										<?php } ?>
								</table>
							</div>
						<?php } ?>
					</li>
					</div>
					<div class="animate-box" data-animate-effect="fadeInLeft" style="position:relative;left:32.55%;">
						<?php echo '<img src="'.$image.'" style="width:230px;height:300px;/>'; ?>
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