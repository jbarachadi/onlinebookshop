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

									if ($stmt = $con->prepare('SELECT password,f_name,name,centre,phone,email,branch,image FROM users WHERE id=?')) {
											
											$id=$_SESSION['id'];										
											mysqli_stmt_bind_param($stmt,'s',$id);
											$stmt->execute();
											$stmt->store_result();
									}

									if ($stmt->num_rows > 0) {
											$stmt->bind_result($pw, $nom, $prenom, $centre, $tel, $email, $filiere,$image);
											$stmt->fetch();
									}

									if ($stmt = $con->prepare('UPDATE users SET password=?,f_name=?,name=?,centre=?,phone=?,email=?,branch=?,image=? WHERE id=?')) {
											
											if(isset($_FILES['pic'])){
														$file_type = $_FILES['pic']['type'];
														$file_tmp_name = $_FILES['pic']['tmp_name'];
														$file_name = "id".$id;
														$target_dir = "users/";
       													move_uploaded_file($file_tmp_name, $target_dir.$file_name.".jpeg");
														$image=$target_dir.$file_name.".jpeg";			
											}
											
											if($_POST['pw']!=NULL){$pw = password_hash($_POST['pw'], PASSWORD_DEFAULT);}											
											if($_POST['nom']!=NULL){$nom=$_POST['nom'];}
											if($_POST['prenom']!=NULL){$prenom=$_POST['prenom'];}
											if($_POST['centre']!=NULL){$centre=$_POST['centre'];}
											if($_POST['filiere']!=NULL){$filiere=$_POST['filiere'];}
											if($_POST['tel']!=NULL){$tel=$_POST['tel'];}
											if($_POST['email']!=NULL){$email=$_POST['email'];}
											$id=$_SESSION['id'];

																		
											mysqli_stmt_bind_param($stmt,'ssssssssi', $pw, $nom, $prenom, $centre, $tel, $email, $filiere, $image, $id);
											$stmt->execute();

											header("Location: profil.php");

									} 


									else {

											include 'sidemenu.php';
											echo 'else modification';
											echo '.';

									}
									
									$con->close();
							?>
						</p>

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