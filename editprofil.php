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

							$id=$_SESSION['id'];

							if ($stmt = $con->prepare('SELECT password, pseudo, name, f_name, centre, email, phone, branch, image FROM users WHERE id = ?')) {
								$stmt->bind_param('i', $id);
								$stmt->execute();
								$stmt->store_result();
								$stmt->bind_result($pw, $pseudo, $nom, $prenom, $centre, $email, $tel, $filiere, $image);
								$stmt->fetch();
							}

						?>
					<form method="POST" action="save.php" enctype="multipart/form-data">
						<h2 class="animate-box" data-animate-effect="fadeInLeft" style="display:inline;">
							Profil de : <?php echo $_SESSION['name']; ?>
							<a href="save.php" class="animate-box" data-animate-effect="fadeInLeft">
								<input name="submit" type="image" src="images/save.png" style="width:25px;height:25px;">
							</a>
						</h2>
					
						<p>
							<ul class="animate-box" data-animate-effect="fadeInLeft">
								<li><strong>Mot de passe : </li></strong>
									<input name="pw" type="password" class="form-control" placeholder="Nouveau mot de passe">
									<input name="pw" type="password" class="form-control" placeholder="Confirmez votre mot de passe">
								<li><strong>Centre : </li></strong>
									<select name="centre" class="form-control">	
											<option value=""><?php echo $centre; ?></option>
											<optgroup label="Etablissements publics">
												<option value="Lycée Mohamed V (Béni Mellal)">Lycée Mohamed V (Béni Mellal)</option>
												<option value="Lycée Reda Slaoui (Agadir)">Lycée Reda Slaoui (Agadir)</option>
												<option value="Lycée Al Khansaa (Casablanca)">Lycée Al Khansaa (Casablanca)</option>
												<option value="Lycée Mohamed V (Casablanca)">Lycée Mohamed V (Casablanca)</option>
												<option value="Lycée Ibn Tahir (Errachidida)">Lycée Ibn Tahir (Errachidida)</option>
												<option value="Lycée Moulay Idriss (Fes)">Lycée Moulay Idriss (Fes)</option>
												<option value="Centre Okba Ibn Nafea (Dakhla)">Centre Okba Ibn Nafea (Dakhla)</option>
												<option value="Lycée Ibn Abdoun (Khouribga)">Lycée Ibn Abdoun (Khouribga)</option>
												<option value="Lycée Lissane Eddine Ibn Al-Khatib (Laâyoune)">Lycée Lissane Eddine Ibn Al-Khatib (Laâyoune)</option>
												<option value="Lycée Ibn Timiya (Marrakech)">Lycée Ibn Timiya (Marrakech)</option>
												<option value="Lycée Omar Ibn Al-Khattab (Meknès)">Lycée Omar Ibn Al-Khattab (Meknès)</option>
												<option value="Lycée Technique (Mohammedia)">Lycée Technique (Mohammedia)</option>
												<option value="Lycée Omar Ibn Abdelaziz (Oujda)">Lycée Omar Ibn Abdelaziz (Oujda)</option>
												<option value="Lycée Omar Al-Khayyam (Rabat)">Lycée Omar Al-Khayyam (Rabat)</option>
												<option value="Lycée Moulay Youssef (Rabat)">Lycée Moulay Youssef (Rabat)</option>
												<option value="Lycée Acharif Al Idrissi (Taza)">Lycée Acharif Al Idrissi (Taza)</option>
												<option value="Ecole Royale Navale (Casablanca)">Ecole Royale Navale (Casablanca)</option>
												<option value="Ecole Royale de l'Air (Marrakech)">Ecole Royale de l'Air (Marrakech)</option>
												<option value="Lycée Salmane Al Farissi (Salé)">Lycée Salmane Al Farissi (Salé)</option>
												<option value="Lycée Mohammed VI (Kénitra)">Lycée Mohammed VI (Kénitra)</option>
												<option value="Lycée Technique (Settat)">Lycée Technique (Settat)</option>
												<option value="Lycée Bab Essahra (Guelmim)">Lycée Bab Essahra (Guelmim)</option>
												<option value="Lycée Moulay Abdellah (Safi)">Lycée Moulay Abdellah (Safi)</option>
												<option value="Lycée Moulay Al Hassan (Tanger)">Lycée Moulay Al Hassan (Tanger)</option>
												<option value="Lycée Errazi (El Jadida)">Lycée Errazi (El Jadida)</option>
												<option value="Lycée Moulay Ismail (Meknès)">Lycée Moulay Ismail (Meknès)</option>
												<option value="Lycée Abdelkarim Al Khattabi (Nador)">Lycée Abdelkarim Al Khattabi (Nador)</option>
												<option value="Lycée qualifiant Mohammed VI (Ouarzazate)"> Lycée qualifiant Mohammed VI (Ouarzazate)</option>
												<option value="Centre CPGE Tétouan (Tétouan)">Centre CPGE Tétouan (Tétouan)</option>
											</optgroup>
											<optgroup label="Etablissements privés">
												<option value="Socrate (Agadir)">Socrate (Agadir)</option>
												<option value="Alqalam (Agadir)">Alqalam (Agadir)</option>
												<option value="El Amrani II (Marrakech)">El Amrani II (Marrakech)</option>
												<option value="Koutoubia Prépas (Marrakech)">Koutoubia Prépas (Marrakech)</option>
												<option value="Marrakech Prépas (Marrakech)">Marrakech Prépas (Marrakech)</option>
												<option value="Mansoume (Marrakech)">Mansoume (Marrakech)</option>
												<option value="Ibn Ghazi (Marrakech)">Ibn Ghazi (Marrakech)</option>
												<option value="Ibn Younes (El Jadida)">Ibn Younes (El Jadida)</option>
												<option value="Day Prépas (Béni Mellal)">Day Prépas (Béni Mellal)</option>
												<option value="ESMG Prépas (Béni Mellal)">ESMG Prépas (Béni Mellal)</option>
												<option value="Yassamine Californie (Casablanca)">Yassamine Californie (Casablanca)</option>
												<option value="ESTEM (Casablanca)">ESTEM (Casablanca)</option>
												<option value="CPGE Polyprépas (Casablanca)">CPGE Polyprépas (Casablanca)</option>
												<option value="SupGestion (Casablanca)">SupGestion (Casablanca)</option>
												<option value="Al Bilia (Casablanca)">Al Bilia (Casablanca)</option>
												<option value="Groupe Scolaire La Résidence (Casablanca)">Groupe Scolaire La Résidence (Casablanca)</option>
												<option value="Galilé (Casablanca)">Galilé (Casablanca)</option>
												<option value="ESG Prépas (Casablanca)">ESG Prépas (Casablanca)</option>
												<option value="GEM+(Casablanca)">GEM+(Casablanca)</option>
												<option value="Omar Alkhayam (Mohammedia)">Omar Alkhayam (Mohammedia)</option>
												<option value="Ibn Al Ghazi (Rabat)">Ibn Al Ghazi (Rabat)</option>
												<option value="Al Khawarizmi (Rabat)">Al Khawarizmi (Rabat)</option>
												<option value="HIGH-TECH (Rabat)">HIGH-TECH (Rabat)</option>
												<option value="Groupe Scolaire Atlas (Rabat)">Groupe Scolaire Atlas (Rabat)</option>
												<option value="Thalès Prépas (Rabat)">Thalès Prépas (Rabat)</option>
												<option value="Leonard De Vinci (Rabat)">Leonard De Vinci (Rabat)</option>
												<option value="ESCK (Kénitra)">ESCK (Kénitra)</option>
												<option value="Al Bayrouni (Tanger)">Al Bayrouni (Tanger)</option>
												<option value="Groupe Assafa (Tanger)">Groupe Assafa (Tanger)</option>
												<option value="Fermat (Errachidia)">Fermat (Errachidia)</option>
												<option value="Carnot Prépas (Meknès)">Carnot Prépas (Meknès)</option>
												<option value="Prépa-Sup Ibn Ghazi Al Meknassi (Meknès)">Prépa-Sup Ibn Ghazi Al Meknassi (Meknès)</option>
												<option value="AUDANTIA (Meknès)">AUDANTIA (Meknès)</option>
												<option value="Ibn ghazi Fassi (Fès)">Ibn ghazi Fassi (Fès)</option>
												<option value="Prépas Al Khayyam (Fès)">Prépas Al Khayyam (Fès)</option>
												<option value="Etablissement Al Cachy (Fès)">Etablissement Al Cachy (Fès)</option>
												<option value="Institution Marie Curie (Fès)">Institution Marie Curie (Fès)</option>
												<option value="Technologia (Fès)">Technologia (Fès)</option>
												<option value="Médiane Sup (Oujda)">Médiane Sup (Oujda)</option>
												<option value="Pythagore-Prépa (Oujda)">Pythagore-Prépa (Oujda)</option>
											</optgroup>
										</select>
								<li><strong>Filière : </li></strong>
									<select name="filiere" class="form-control">
												<option value=""> </option>
											    <option value="MP">MP</option>
											    <option value="PSI">PSI</option>
											    <option value="TSI">TSI</option>
											    <option value="ECS">ECS</option>
											    <option value="ECT">ECT</option>
										</select>
								<li><strong>Numéro de téléphone : </li></strong>
									<input name="tel" type="text" class="form-control" placeholder=<?php echo $tel; ?>>
								<li><strong>Email : </li></strong>
									<input name="email" type="text" class="form-control" placeholder=<?php echo $email; ?>>
							</ul>
						</p>
						</div>
						<div class="animate-box" data-animate-effect="fadeInLeft" style="position:relative;left:32.55%;">
							<img src="<?php echo $image; ?>" class="img-responsive" style="width:270px;height:270px;">
							<input name="pic" type="file">
							<input name="nom" type="text" class="form-control animate-box" data-animate-effect="fadeInLeft" style="width:133px;display:inline;" placeholder=<?php if($nom!=NULL){echo $nom;}else{echo "Nom";} ?>>
							<input name="prenom" type="text" class="form-control animate-box" data-animate-effect="fadeInLeft"  style="width:133px;display:inline;" placeholder=<?php if($prenom!=NULL){echo $prenom;}else{echo "Prénom";}; ?>>
						</div>
					</form>
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