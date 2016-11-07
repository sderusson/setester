<?php
	// Appelle la session
	session_start();
	// Ecrase le tableau de session
	$_SESSION = array();
	// Détruit la session
	session_destroy();
	// Revient sur page d'accueil
	header('Location: /index.php');
	die();
?>
