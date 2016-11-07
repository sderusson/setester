<?php
	session_start();	// On démarre la session AVANT d'écrire du code HTML
	require_once "../config/conf.php";
	require_once ('../model/Model.php');
	require_once ('../model/Prop.php');
	$propClass = new Prop();
	require_once ('../model/User_histo.php');
	$user_histoClass = new User_histo();
	session_start(); // On démarre la session AVANT toute chose
	if(isset($_SESSION["ip"])  ){
		$user_ip = $_SESSION["ip"];
	}
	if(isset($_SESSION["user_mail"])  ){
		$user_mail = $_SESSION["user_mail"];
	}
	$messageUpdate = "Tous les champs doivent être remplis.";
	if(isset($_POST['id']) AND isset($_POST['updated_arg']) ){
		$arg_id 	= $_POST['id'];
		$arg_action = "arg_u";
		$nb = $propClass->setNewProp($arg_id, $_POST['updated_arg'], $arg_action, $user_ip, $user_mail, $_SESSION['prop_arg_u_rank_default']); //proposition de modification pour un argument
		$user_histoClass->setUser_histo( $user_mail, $debat_id, $arg_id, $arg_action, $user_ip);
		$_SESSION['message'] = htmlentities("Reformulation enregistrée. Pour le moment il s'agit d'une proposition. Si le score de la proposition devient suffisamment élevé, la reformulation remplacera l'argument");
	} else if(isset($_POST['id']) AND isset($_POST['new_arg'])){
		$debat_id 	= $_POST['id'];
		$arg_lib_fr = $_POST['new_arg'];
		$arg_action = "arg";
		$nb = $propClass->setNewProp($debat_id, $arg_lib_fr, $arg_action, $user_ip, $user_mail, $_SESSION['prop_arg_rank_default']); //proposition d'ajout d'argument
		$user_histoClass->setUser_histo( $user_mail, $debat_id, $arg_id, $arg_action, $user_ip);
		$_SESSION['message'] = htmlentities("Proposition d'argument enregistré. Pour le moment il s'agit d'une proposition. Si le score de la proposition devient suffisamment élevé, elle deviendra un argument");
	}  else if(isset($_POST['new_debat_lib'])  ){
		$arg_lib_fr 	= $_POST['new_debat_lib'];
		$arg_action = "debat";
		$nb = $propClass->setNewProp("",$arg_lib_fr, $arg_action, $user_ip, $user_mail, $_SESSION['prop_debat_rank_default']); // ajouter d'une proposition de nouveau débat
		$user_histoClass->setUser_histo( $user_mail, $debat_id, $arg_id, $arg_action, $user_ip);
		$_SESSION['message'] = htmlentities("Proposition de débat enregistré. Pour le moment il s'agit d'une proposition. Si le score de la proposition devient suffisamment élevé, elle deviendra un débat");
	} else if(isset($_POST['prop_type'])){
		$prop_type = $_POST['prop_type'];
		if(isset($_POST['prop_link_id'])){
			$prop_link_id = $_POST['prop_link_id'];
			$props = $propClass->getListByDebat($prop_type, $prop_link_id);
			echo json_encode($props);
		} else {
			$props = $propClass->getListByType($prop_type);
			echo json_encode($props);
		}
		exit;
	}
		header("Location: ../index.php");
		exit;
?>
