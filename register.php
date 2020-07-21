
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
		<div id="fh5co-main">
			<div class="fh5co-narrow-content">
				<div class="row">					
					<div class="animate-box" data-animate-effect="fadeInLeft" class="col-md-0 col-md-push-0">
						
						<p>
							<br/><br/><br/><br/>

								<?php
									$DATABASE_HOST = 'localhost';
									$DATABASE_USER = 'root';
									$DATABASE_PASS = '';
									$DATABASE_NAME = 'pfa';

									$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
									if (mysqli_connect_errno()) {

										die ('Failed to connect to MySQL: ' . mysqli_connect_error());
									}

									if ($stmt = $con->prepare('SELECT id, password FROM users WHERE pseudo = ?')) {
										$stmt->bind_param('s', $_POST['pseudo']);
										$stmt->execute();
										$stmt->store_result();
										
										if ($stmt->num_rows > 0) {

											echo 'Le pseudo que vous avez choisi a déjà été utilisé. Veuillez en choisir un autre';
										}
										else {
											if($_POST['pw']!=$_POST['pw2']){
												echo 'Les mots de passe saisis ne sont pas identiques! Veuillez réessayer dans 3 secondes!';
												header('Refresh:3;url=signup.php');
											}
											else{
												if ($stmt = $con->prepare("INSERT INTO users (pseudo,password,f_name,name,centre,phone,email,branch) VALUES (?,?,?,?,?,?,?,?)")) {

													$pw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
													$pseudo=$_POST['pseudo'];
													$nom=$_POST['nom'];
													$prenom=$_POST['prenom'];
													$centre=$_POST['centre'];
													$filiere=$_POST['filiere'];
													$tel=$_POST['tel'];
													$email=$_POST['email'];
																		
													mysqli_stmt_bind_param($stmt,'ssssssss', $pseudo, $pw, $nom, $prenom, $centre, $tel, $email, $filiere);
													$stmt->execute();

													echo 'Inscription réussie, vous pouvez vous connecter ! Redirection vers la page de connexion dans 3 secondes!';
													header('Refresh:3;url=login.php');
													//echo "<script>location='login.php'</script>";
													
												} else {

													echo 'Il semblerait qu\'une erreur soit survenue... Veuillez réessayer plus tard. Si le problème persiste,' ; ?> <a href="contact.html" > contactez nous </a><?php
													echo '.';
												}
											}
										}
										
									} else {

										echo 'Il semblerait qu\'une erreur soit survenue... Veuillez réessayer plus tard. Si le problème persiste,' ; ?> <a href="contact.html" > contactez nous </a> <?php
										echo '.';
									}
			
									$con->close();
							?>
						</p>
					</div>
				</div>
			</div>
		</div>
		<?php include 'sidemenu.php'; ?>
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