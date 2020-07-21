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

		<?php if ($log=isset($_SESSION['loggedin']) == TRUE) {
			include 'loggedinbar.php';
		}
		else {
			include 'logbar.php';
		}

		?>

		<div id="fh5co-main">
			<div class="fh5co-narrow-content">
				<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft" style="display:inline;">Ajout de livre</h2>
				<form action=<?php if($log=isset($_SESSION['loggedin'])==TRUE){ echo 'added.php';}else{ echo 'login.php';}?> method="POST" class="animate-box" data-animate-effect="fadeInLeft" style="padding-top:40px;">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">

									<?php
										$DATABASE_HOST = 'localhost';
										$DATABASE_USER = 'root';
										$DATABASE_PASS = '';
										$DATABASE_NAME = 'pfa';

										$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

										if ( mysqli_connect_errno() ) {

											die ('Failed to connect to MySQL: ' . mysqli_connect_error());
										
										}
										if ($stmt1 = $con->prepare('SELECT DISTINCT title FROM books ORDER BY title')) {
											
											$stmt1->execute();
											$stmt1->store_result();
											$stmt1->bind_result($titre);
											$stmt1->fetch();

										}

									?>
									
									<div class="form-group">
										<select name="title" type="text" class="form-control" required="" id="seeAnotherField">
												<option value="Titre">Titre</option>
												<?php do{ ?>
													<option value="<?php echo $titre; ?>"><?php echo $titre; ?></option>
												<?php }while($row=$stmt1->fetch()) ?>		
												<option value="Autre">Autre</option>
										</select>	
									</div>
									<div class="form-group" id="other">
										<input name="other_title" type="text" class="form-control" placeholder="Titre*" id="otherInput" required="">
									</div>

									<script>
										$("#seeAnotherField").change(function() {
											if ($(this).val() == "Autre") {
												$('#other').show();
												$('#otherInput').attr('required', '');
												$('#otherInput').attr('data-error', 'This field is required.');
											} 
											else {
												$('#other').hide();
												$('#otherInput').removeAttr('required');
												$('#otherInput').removeAttr('data-error');
											}
										});
										$("#seeAnotherField").trigger("change");
									</script>

									<div class="form-group">
										<select name="subject" class="form-control" required="">
												<option value="">Matière</option>
											    <option value="Mathematiques">Mathématiques</option>
											    <option value="Physique">Physique</option>
												<option value="Chimie">Chimie</option>
										</select>
									</div>
									<div class="form-group">
										<select name="filiere" class="form-control" required="">
												<option value="">Filière</option>
												<option value="MPSI">MPSI</option>
											    <option value="MP">MP</option>
											    <option value="PCSI">PCSI</option>
											    <option value="PC">PC</option>
											    <option value="PSI">PSI</option>
											    <option value="TSI">TSI</option>
											    <option value="ECS">ECS</option>
											    <option value="ECT">ECT</option>
										</select>
									</div>

									<div class="form-group" id="niveau">
										<label for="niveau">Niveau :</label>
										<div style="display:inline;position:relative;left:15%;">
											<input name="level" type="radio" value="Sup"> Sup
										</div>
										<div style="display:inline;position:relative;left:45%;">
											<input name="level" type="radio" value="Spe"> Spé
										</div>
									</div>
									<div class="form-group">
										<select name="state" class="form-control" required="">
												<option value="">Etat</option>
											    <option value="Photocopie">Photocopie</option>
											    <option value="Authentique">Authentique</option>
												<option value="Neuf">Neuf</option>
											    <option value="Utilise">Utilisé</option>
										</select>
									</div>
									<div class="form-group">
										<input name="price" type="text" class="form-control" placeholder="Prix">
									</div>

									<div class="form-group">
										<input name="phone" type="text" class="form-control" placeholder="Numéro de téléphone">
									</div>

									<div class="form-group">
										<input name="city" type="text" class="form-control" placeholder="Ville" required="">
									</div>

									<div class="form-group">
										<input name="submit" type="submit" class="btn btn-primary btn-md" value="Ajouter">
									</div>
								</div>								
							</div>
						</div>
						
					</div>
				</form>
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

