<?php
	require_once ('config/conf.php');
	require_once ('model/Model.php');
	require_once ('model/Debat.php');
	require_once ('model/Arg.php');

	session_start(); // On démarre la session AVANT toute chose
	require_once('controller/authcheck.php');

	if(!isset($_SESSION["ip"])) {
		$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	$titre= "Testoi"; //initialisation des donnée
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title><?php echo $titre ?></title>

		<link rel="shortcut icon" href="images/mon_icon.ico">
		<link rel="stylesheet" type="text/css" href="css/global.css" />
		<script type="text/javascript" src="js/jquery-1.11.3.min.js" ></script>
