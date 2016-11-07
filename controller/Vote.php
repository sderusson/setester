<?php
	require_once "../config/conf.php";
	require_once ('../model/Model.php');
	require_once ('../model/Prop.php');
	$propClass = new Prop();
	require_once ('../model/Arg.php');
	$argClass = new Arg();
	require_once ('../model/Debat.php');
	$debatClass = new Debat();
	require_once ('../model/Log.php');
	$logClass = new Log();
	require_once ('../model/User_histo.php');
	$user_histoClass = new User_histo();

	session_start(); // On démarre la session AVANT toute chose
	if(isset($_SESSION["ip"])  ){
		$user_ip = $_SESSION["ip"];
	}
	if(isset($_SESSION["user_mail"])  ){
		$user_mail = $_SESSION["user_mail"];
	}

	if(isset($_POST['vote']) AND isset($_POST['vote_id']) AND isset($_POST['vote_type']) ){
		$vote 	= $_POST['vote'];
		$vote_id = $_POST['vote_id'];
		$vote_type = $_POST['vote_type'];
		$messageUpdate = "Erreur technique lors de la mise à jour de la donnée.";
		if($vote_type == "arg"){
//			$logClass->setNewLog($vote." ".$vote_id." ".$vote_type,$user_ip);
			$args = $argClass->getArgById($vote_id);
			$arg_id = $args[0]->arg_id;
			$debat_id = $args[0]->debat_id;
			$arg_rank = $args[0]->arg_rank;
			$arg_type = $args[0]->arg_type;
			$arg_link_id = $args[0]->arg_link_id;
			$arg_lib_fr = $args[0]->arg_lib_fr;
//			$arg_lib_fr = htmlentities($arg_lib_fr,ENT_QUOTES); //Convertit tous les caractères éligibles en entités HTML.
//			$logClass->setNewLog($arg_id." ".$arg_rank." ".$arg_type." ".$arg_link_id." ".$arg_lib_fr, $user_ip);
			if(isset($args) AND $vote == "plus"  ){ //vote + pour un argument
				$nb = $argClass->setArgByIdForRank($arg_id, (intval($arg_rank)+1));//ajouter le * user_rank
				$user_histoClass->setUser_histo( $user_mail, $debat_id, $arg_id, $vote_type.$vote, $user_ip);
				$_SESSION['message'] = htmlentities("Vote + pour l'argument enregistré");
			}else if(isset($args) AND $vote == "moins" AND (intval($arg_rank) > $_SESSION['prop_arg_rank_default']) ){ //vote - pour un argument
				$nb = $argClass->setArgByIdForRank($arg_id, intval($arg_rank)-1);
				$user_histoClass->setUser_histo( $user_mail, $debat_id, $arg_id, $vote_type.$vote, $user_ip);
				$_SESSION['message'] = htmlentities("Vote - pour l'argument enregistré");
			}else if(isset($args) AND $vote == "moins" AND (intval($arg_rank) <= $_SESSION['prop_arg_rank_default']) ){ //vote - et suppression du débat ou de l'argument
				//$logClass->setNewLog($arg_id." ".$arg_rank." ".$arg_type." ".$arg_link_id." ".$arg_lib_fr, $user_ip);
				//$arg_lib_fr = $_POST['updated_arg'];
				$arg_action = "arg";
				$nb = $propClass->setNewProp($debat_id, $arg_lib_fr, $arg_action, $user_ip, $user_mail, intval($arg_rank)-1); //vote - passage de argument à proposition
				$logClass->setNewLog($debat_id.", ".$arg_rank.", ".$arg_type.", ".$arg_link_id.", ".$arg_lib_fr.", ".$arg_action, $user_ip);
				$nb = $argClass->deleteArgById($arg_id);
				$user_histoClass->setUser_histo( $user_mail, $debat_id, $arg_id, $vote_type.$vote, $user_ip);
				$_SESSION['message'] = htmlentities("Vote - pour l'argument enregistré, l'argument ayant atteint le score limite, il redevient une proposition");
			}
		}else if($vote_type == "prop"){
			$props = $propClass->getPropById($vote_id);
			$prop_id = $props[0]->prop_id;
			$prop_rank = $props[0]->prop_rank;
			$prop_type = $props[0]->prop_type;
			$prop_link_id = $props[0]->prop_link_id;
			$prop_lib_fr = $props[0]->prop_lib_fr;
//			$prop_lib_fr = htmlentities($prop_lib_fr,ENT_QUOTES); //Convertit tous les caractères éligibles en entités HTML.
			if(isset($props) AND $vote == "plus" AND (intval($prop_rank) < $_SESSION['prop_arg_rank_validation']) ){ //vote + pour une proposition
				$nb = $propClass->setProp($prop_id, (intval($prop_rank)+1));//ajouter le * user_rank
				$user_histoClass->setUser_histo( $user_mail, $prop_link_id, $prop_link_id, $vote_type.$vote, $user_ip);
				$_SESSION['message'] = htmlentities("Vote + pour la proposition enregistré");
			}else if(isset($props) AND $vote == "moins" AND (intval($prop_rank) > $_SESSION['prop_arg_rank_delete']) ){ //vote - pour une proposition
				$nb = $propClass->setProp($prop_id, intval($prop_rank)-1);
				$user_histoClass->setUser_histo( $user_mail, $prop_link_id, $prop_link_id, $vote_type.$vote, $user_ip);
				$_SESSION['message'] = htmlentities("Vote - pour la proposition enregistré");
			}else if(isset($props) AND $vote == "plus" AND (intval($prop_rank) >= $_SESSION['prop_arg_rank_validation']) AND $prop_type == "arg" ){ //vote + et validation d'un argument
				$nb = $argClass->setNewArg($prop_link_id, $prop_lib_fr, (intval($prop_rank)+1));//ajouter le * user_rank
				$nb = $propClass->deletePropById($prop_id);
				$user_histoClass->setUser_histo( $user_mail, $prop_link_id, $prop_link_id, $vote_type.$vote, $user_ip);
				$_SESSION['message'] = htmlentities("Vote + pour la proposition enregistré, la proposition ayant atteint un score suffisant, elle devient un argument");
			}else if(isset($props) AND $vote == "plus" AND (intval($prop_rank) >= $_SESSION['prop_arg_u_rank_validation']) AND $prop_type == "arg_u" ){ //vote + et validation d'une reformulation d'argument
				$nb = $argClass->setArgByIdLibFr($prop_link_id, $prop_lib_fr, (intval($prop_rank)+1));//ajouter le * user_rank, le score de la nouvelle proposition remplace le score de l'ancien argument
				$nb = $propClass->deletePropById($prop_id);
				$user_histoClass->setUser_histo( $user_mail, $prop_link_id, $prop_link_id, $vote_type.$vote, $user_ip);
				$_SESSION['message'] = htmlentities("Vote + pour la reformulation d'argument enregistré, la reformulation ayant atteint un score suffisant, elle remplace l'argument");
			}else if(isset($props) AND $vote == "plus" AND (intval($prop_rank) >= $_SESSION['prop_debat_rank_validation']) AND $prop_type == "debat" ){ //vote + et validation d'un debat
				$nb = $debatClass->setDebat($prop_lib_fr, (intval($prop_rank)+1));//ajouter le * user_rank
				$nb = $propClass->deletePropById($prop_id);
				$user_histoClass->setUser_histo( $user_mail, $prop_link_id, $prop_link_id, $vote_type.$vote, $user_ip);
				$_SESSION['message'] = htmlentities("Vote + pour la proposition enregistré, la proposition de débat ayant atteint un score suffisant, elle devient un débat");
			}else if(isset($props) AND $vote == "moins" AND (intval($prop_rank) <= $_SESSION['prop_arg_rank_delete']) ){ //vote - et suppression du débat ou de l'argument
				$nb = $propClass->deletePropById($prop_id);
				$user_histoClass->setUser_histo( $user_mail, $prop_link_id, $prop_link_id, $vote_type.$vote, $user_ip);
				$_SESSION['message'] = htmlentities("Vote - enregistré, le score atteint ayant atteint la limite, ce vote à supprimé la proposition");
			}

		}else if($vote_type == "debat"){
//			$logClass->setNewLog($vote." ".$vote_id." ".$vote_type,$user_ip);
			$debats = $debatClass->getDebatById($vote_id);
			$debat_id = $debats[0]->debat_id;
			$debat_rank = $debats[0]->debat_rank;
			$debat_lib_fr = $debats[0]->debat_lib_fr;
//			$debat_lib_fr = htmlentities($debat_lib_fr,ENT_QUOTES); //Convertit tous les caractères éligibles en entités HTML.
//			$logClass->setNewLog($debat_id." ".$debat_rank." ".$debat_lib_fr,$user_ip);
			if(isset($debats) AND $vote == "plus" ){ //vote + pour une debat
				$nb = $debatClass->setDebatById($debat_id, (intval($debat_rank)+1));//ajouter le * user_rank
				$user_histoClass->setUser_histo( $user_mail, $debat_id, $arg_id, $vote_type.$vote, $user_ip);
				$_SESSION['message'] = htmlentities("Vote + pour le débat enregistré");
			}else if(isset($debats) AND $vote == "moins" AND (intval($debat_rank) > $_SESSION['prop_debat_rank_delete']) ){ //vote - pour une debatosition
				$nb = $debatClass->setDebatById($debat_id, intval($debat_rank)-1);
				$user_histoClass->setUser_histo( $user_mail, $debat_id, $arg_id, $vote_type.$vote, $user_ip);
				$_SESSION['message'] = htmlentities("Vote - pour le débat enregistré");
			}else if(isset($debats) AND $vote == "moins" AND (intval($debat_rank) <= $_SESSION['prop_debat_rank_delete']) ){ //vote - et suppression du débat ou de l'debatument
				$debat_action = "debat_u";
				$nb = $propClass->setNewProp($debat_id, $debat_lib_fr, $debat_action, $user_ip, $user_mail, intval($debat_rank)-1); //vote - passage de debat à proposition
				$nb = $debatClass->deleteDebatById($debat_id);
				$user_histoClass->setUser_histo( $user_mail, $debat_id, $arg_id, $vote_type.$vote, $user_ip);
				$_SESSION['message'] = htmlentities("Vote - pour le débat enregistré, le débat ayant atteint un score trop faible il redevient une simple proposition");
			}
		}
		//header("Location: ../index.php");
		exit;
	}
?>
