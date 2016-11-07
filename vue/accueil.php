<?php
include("header.php");
?>
	</head>

	<body>
		<div id="header">
		</div>

		<!-- Appel du menu-->
			<?php include("Menu.php"); ?>
			<div id="message">
				<?php
						echo $_SESSION["message"];
						$_SESSION["message"]="";
				?>
			</div>
			<?php include("ListeChoixDebat.php"); ?>

		<!-- Appel du contenu principal de la page -->

		<div id="content" class="global">
			<div id="listArgs_ul">
			</div>
			<div id="listProps_ul">
			</div>
			<div id="ajouterArgDiv">
			</div>
			<div id="modif_arg">
			</div>
		</div>

	</body>
</html>
