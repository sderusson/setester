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

		<div class="login_container">
			<h2>La création d'un compte est necessaire pour acceder aux debats</h2>
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
				<input type="email" name="user_mail_new" id="user_mail" required="required">
				</br>
				<label>Mot de passe :</label>
				</br>
				<input type="password" name="pwd_new" id="pwd" >
				</br></br>
				<input class="bouton" type="submit" value="Créer un compte"/>
			</form>
		</div>
	</body>
</html>
