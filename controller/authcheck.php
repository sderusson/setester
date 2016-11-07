<?php
	require_once ('model/Black_list.php');
	$blClass = new Black_list();

	$isInBlackList = $blClass->isInBlackList($_SERVER['REMOTE_ADDR']);
	if($isInBlackList != null AND $isInBlackList[0]->result == 1){
		$_SESSION=array();
		session_destroy();
		$_SESSION['message'] = "<b class='note'>Vous avez aimez? : </b> Connectez vous pour continuer";
		header("Location: vue/connexion.php");
		die();
	} else {
		if(!isset($_SESSION['last_access']) || !isset($_SESSION['ip']) || !isset($_SESSION['user_mail'])){
			$_SESSION=array();
			session_destroy();
			header("Location: vue/connexion.php");
			die();
		}

		if(time()-$_SESSION['last_access']>5000)
		{
		  $_SESSION=array();
		  session_destroy();
		  header("Location: vue/connexion.php");
		  die();
		}
		if($_SERVER['REMOTE_ADDR']!=$_SESSION['ip'])
		{
		  $_SESSION=array();
		  session_destroy();
		  header("Location: vue/connexion.php");
		  die();
		}
		$_SESSION['last_access']=time();
		$user_mail = $_SESSION['user_mail'];
	}
?>
