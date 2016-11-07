<?php
include("header.php");
require_once('model/Administrateur.php');
require_once('authcheck.php');
if(session_id() == '')
	require_once('../controller/connexion.php');
?>
	<link rel="stylesheet" type="text/css" href="css/admin.css" />
	<link rel="stylesheet" type="text/css" href="css/onglets.css" />
	<link rel="stylesheet" type="text/css" href="css/combo.select.css">
	<script type="text/javascript" src="js/admin.js" ></script>
	<script type="text/javascript" src="js/jquery-ui.min.js" ></script>
	<script type="text/javascript" src="js/jquery.combo.select.js"></script>
	<script>
		jQuery(function() {
			jQuery( "#tabs" ).tabs({
				active: <?php if (isset ($_SESSION['tab'])) {echo $_SESSION['tab'];}else{echo 4;} ?>
			});
		});
		$.validate({
			modules : 'file'
		});
	</script>
	</head>

	<body>
		<div id="header">
		</div>

		<div class="container">
		<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Importer des justifications</a></li>
				<li><a href="#tabs-2">Modifier une justification</a></li>
				<li><a href="#tabs-3">Modifier une justification en anglais</a></li>
				<li><a href="#tabs-4">Modifier son profil</a></li>
				<li><a href="#tabs-5" onclick="javascript:window.location.href='deconnexion.php'; return false;">Se déconnecter</a></li>
			</ul>

			<div id="tabs-1">
				<?php include("vue/import.php"); ?>
			</div>
			<div id="tabs-2">
				<?php include("/vue/justifUpdateFr.php") ?>
			</div>
			<div id="tabs-3">
				<?php include("/vue/justifUpdateEn.php") ?>
			</div>
			<div id="tabs-4">
				<?php include("vue/profil.php"); ?>
			</div>
			<div id="tabs-5">
				<h2><?php  echo 'Bienvenue '.$_SESSION['username'].'<br>'; ?></h2>
			</div>
		</div>
	</body>
</html>
