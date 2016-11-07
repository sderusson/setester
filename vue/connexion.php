<?php
	session_start(); // On démarre la session AVANT toute chose
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title><?php echo $titre ?></title>
		<link rel="shortcut icon" href="images/mon_icon.ico">
		<link rel="stylesheet" type="text/css" href="/css/global.css" />
	</head>

	<body>
		<div id="header">
		</div>

		<div class="login_container, global">
			<h2><?php echo 	htmlentities("La connexion est nécessaire pour accéder aux débats"); ?></h2>
			<div id="message">
				<?php
						echo $_SESSION['message'];
						$_SESSION['message'] = "";
				?>
			</div>
			<form method="post" id="connexion" action="../controller/connexion.php">
				</br>
				<label>Mail :</label>
				</br>
				<input type="email" name="user_mail" id="user_mail" required="required">
				</br>
				<label>Mot de passe :</label>
				</br>
				<input type="password" name="pwd" id="pwd" >
				</br></br>
				<input class="bouton" type="submit" value="Se connecter"/>
			</form>
			<br>
			<a href="../vue/creation_cpt.php">Creer un compte</a><br><br>
		</div>
		<?php  include("Explication_content.php"); ?>
	</body>
</html>
