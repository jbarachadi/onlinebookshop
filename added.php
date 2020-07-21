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
					<div class="animate-box" data-animate-effect="fadeInLeft" class="col-md-0 col-md-push-0">
						
						<p>
							<br/><br/><br/><br/>

								<?php
									$DATABASE_HOST = 'localhost';
									$DATABASE_USER = 'root';
									$DATABASE_PASS = '';
									$DATABASE_NAME = 'pfa';

									$add = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
									if (mysqli_connect_errno()) {

										die ('Failed to connect to MySQL: ' . mysqli_connect_error());
									}

									if ($stmtt = $con->prepare('SELECT email,phone FROM users WHERE id = ?')) {
											
											$stmtt->bind_param('i', $_SESSION['id']);
											$stmtt->execute();
											$stmtt->store_result();
											$stmtt->bind_result($email,$user_phone);
											$stmtt->fetch();

										}

									if($_POST['other_title'] != NULL)
									{
											$bt = $_POST['other_title'];

											if($stmttt= $add->prepare('INSERT INTO books (title,subject,branch,level) VALUES (?,?,?,?)'))
											{
												$title=$_POST['other_title'];
												$subject=$_POST['subject'];
												$branch=$_POST['filiere'];
												$level=$_POST['level'];

												$stmttt->bind_param('ssss', $title, $subject, $branch, $level);
												$stmttt->execute();
											}
									}

									else{
										
											$bt = $_POST['title'];
									}

									if ($stmt = $add->prepare('INSERT INTO offers (seller_id, seller,book_title,book_subject,book_branch,book_state,book_price,phone,city) VALUES (?,?,?,?,?,?,?,?,?)')) {
											$id = $_SESSION['id'];
											$bsu=$_POST['subject'];
											$bb=$_POST['filiere'];
											$bst=$_POST['state'];
											$bp=$_POST['price'];
											$se=$email;
											if($_POST['phone'] != NULL){
												$sp=$_POST['phone'];
											}
											else {
												$sp=$user_phone;
											}
											$c=$_POST['city'];

																			
											$stmt->bind_param('sssssssss', $id, $se, $bt, $bsu, $bb, $bst, $bp, $sp, $c);
											$stmt->execute();

											echo "<script>location='bibliotheque.php'</script>";
										
										}
										else {
											echo 'Il semblerait qu\'une erreur soit survenue... Veuillez réessayer plus tard. Si le problème persiste,' ; ?> <a href="contact.html" > contactez nous </a><?php
											echo '.';
										}
									$add->close();
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