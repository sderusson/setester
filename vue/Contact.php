<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>
			<?php
				$titre= "Contact"; //initialisation des donnée
				echo $titre
			?>
		</title>
		<link rel="shortcut icon" href="../images/mon_icon.ico">
		<link rel="stylesheet" type="text/css" href="../css/global.css" />
	</head>
	<body>
		<?php  include("Menu.php"); ?>

		<div id="content" class="global">
			<div>
				<?php
					echo htmlentities("A l'origine de ce site se trouve une landing page:")."<br>";
				?>
				<a href="http://bourico.wordpress.com"> Blog d'initialisation du projet</a><br><br><br>
				<?php
					echo htmlentities("Vous pouvez aussi contacter l'initiateur du projet par mail à l'adresse sylvain.derusson (chez) gmail.com")."<br>";
					echo htmlentities("Remplacer (chez) par @, cette affichage évite les pourriels :o)")."<br>";
				?>

			</div>
		</div>

	</body>
</html>

