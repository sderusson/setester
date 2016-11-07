<?php
include("header.php");
?>
		<link rel="stylesheet" type="text/css" href="css/recherche.css" />

		<script type="text/javascript" src="js/disableSelection.js" ></script>
	</head>

	<body>
		<div id="header">
		</div>

		<!-- Appel du contenu principal de la page : Formulaire de recherche -->
		<section>
			<input type="button" name="btAllerAccueil" value="Retour" onclick="self.location.href='./index.php'" onclick>
			<!-- Cadre de recherche -->
			<div class="formulaire" align="center">
				<form method="post" name="recherche" action="recherche.php">
					<table>
						<h3><span style="text-decoration:underline;">Recherche</span></h3>
						<!-- <tr>
							<td>
								Texte Original: <input type="text" id="texteEn" name="texteEn" onChange="disableSelection(this,'texteFr');">
							</td>
						</tr> -->
						<tr>
							<td>
								Texte Fran&ccedilais: <input type="text" id="texteFr" name="texteFr" onChange="disableSelection(this,'texteEn');">
							</td>
						</tr>
						<tr>
							<td>
								<input class="bouton" type="submit" value="GO">
							</td>
						</tr>
					</table>
				</form>
			</div>

			<!-- Cadre des résultats-->
			<div id="phraseRappel">
			<?php
			if(count($infosDebat) != 0 ){
				if(isset($_POST['texteFr'])){
					echo 'Resultat de la recherche pour \''.$_POST['texteFr'].'\'';
				}else if (isset($_POST['texteEn'])){
					echo 'Resultat de la recherche pour \''.$_POST['texteEn'].'\'';
				}
			?>
			</div>
			<table id="resultats">
				<tr>
					<th>Debat</th>
					<th>Arg</th>
					<th>Nombre d'occurrences</th>
				</tr>

				<?php foreach ($infosDebat as $infoDebat) { ?>
					<tr>
						<td id="info">

								<?php echo $infoDebat->debat_lib_fr; ?>
						</td>
						<td id="info">
						<a href="index.php?arg_id=<?php echo $infoDebat->arg_id;?>&debat_id=<?php echo $infoDebat->debat_id;?>">
						<?php echo $infoDebat->arg_id. ": " .$infoDebat->arg_lib_fr. " - ".$infoDebat->arg_lib_en; ?>
						</a>
						</td>

						<td id="info">
						<?php echo $infoDebat->number; ?>
						</td>
					</tr>
				<?php } ?>
			</table>
			<?php
			} else {
				echo "Il n'y a pas de donn&eacutees dans le tableau de r&eacutesultats.";
			}
		 ?>
