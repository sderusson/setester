<?php
	require_once "../config/conf.php";
	require_once ('../model/Model.php');
	require_once ('../model/User.php');
	$userClass = new User();
	require_once ('../model/Param.php');
	$paramClass = new Param();
	require_once ('../model/Log.php');
	$logClass = new Log();
	session_start();
	if( isset($_POST['user_mail']) ){
//			$logClass->setNewLog($_POST['user_mail']." ".$_POST['pwd']." ");
		if((!isset($_POST['user_mail']) OR $_POST['user_mail'] == "") AND (!isset($_POST['pwd']) OR $_POST['pwd'] == "")){
			$_SESSION['message'] = " Les deux champs doivent être saisis.";
			$logClass->setNewLog($_SESSION['message']);
			include_once('../vue/connexion.php');
		} else if( strpos($_POST['pwd'],"'") === FALSE AND strpos($_POST['user_mail'],"'") === FALSE){
			$user_mail = $_POST['user_mail'];
//			$user_mail = str_replace("'","''",$_POST['user_mail']);
//			$password = str_replace("'","''",$_POST['pwd']);
			$password = $_POST['pwd'];
			$resultIsLogin = $userClass->isLogin($user_mail);
			if($resultIsLogin != null AND $resultIsLogin[0]->result == 1){
				$resultPwd = $userClass->getPasswordByLogin($user_mail);
				$user_pasw = $resultPwd[0]->user_pasw;
				if (password_verify($password, $user_pasw)) {
					$_SESSION['last_access']=time();
					$_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
					$_SESSION['user_mail'] = $user_mail;
					$_SESSION['message'] = htmlentities("Vous êtes bien connecté");
			$params = $paramClass->getList();
			for( $i=0; $i<9; $i++){
				$param_lib = $params[$i]->param_lib;
				$param_value = $params[$i]->param_value;
				switch ($param_lib) {
					case 'prop_arg_rank_default':
						$_SESSION['prop_arg_rank_default'] = $param_value;
					break;
					case 'prop_arg_u_rank_default':
						$_SESSION['prop_arg_u_rank_default'] = $param_value;
					break;
					case 'prop_debat_rank_default':
						$_SESSION['prop_debat_rank_default'] = $param_value;
					break;
					case 'prop_arg_rank_validation':
						$_SESSION['prop_arg_rank_validation'] = $param_value;
					break;
					case 'prop_debat_rank_validation':
						$_SESSION['prop_debat_rank_validation'] = $param_value;
					break;
					case 'prop_arg_u_rank_validation':
						$_SESSION['prop_arg_u_rank_validation'] = $param_value;
					break;
					case 'prop_arg_rank_delete':
						$_SESSION['prop_arg_rank_delete'] = $param_value;
					break;
					case 'prop_arg_u_rank_delete':
						$_SESSION['prop_arg_u_rank_delete'] = $param_value;
					break;
					case 'prop_debat_rank_delete':
						$_SESSION['prop_debat_rank_delete'] = $param_value;
					break;
				}
			}
					header("Location: ../index.php");
					exit;
				} else {
					$_SESSION['message'] = "Le mot de passe n'est pas correct.";
					include_once('../vue/connexion.php');
				}
			} else {
				$_SESSION['message'] = "Le login n'est pas correct.";
				include_once('../vue/connexion.php');
			}
		} else {
			$_SESSION['message'] = "Le caractère  '  n'est pas accepté.";
			include_once('../vue/connexion.php');
		}

	}else if( isset($_POST['user_mail_new']) ){
		if((!isset($_POST['user_mail_new']) OR $_POST['user_mail_new'] == "") OR (!isset($_POST['pwd_new']) OR $_POST['pwd_new'] == "")){
			$_SESSION['message'] = " Les deux champs doivent être saisis.";
			$logClass->setNewLog($_SESSION['message']);
			include_once('../vue/creation_cpt.php');
		} else if( strpos($_POST['pwd_new'],"'") === FALSE AND strpos($_POST['user_mail_new'],"'") === FALSE){
			$user_mail_new = $_POST['user_mail_new'];
			$userClass->setUser( $user_mail_new, $_POST['pwd_new'], '0', '1');
			$_SESSION['last_access']=time();
			$_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
			$_SESSION['user_mail_new'] = $user_mail_new;
			$_SESSION['message'] = htmlentities("Votre compte est bien créé, veuillez vous connecter");
			header("Location: ../index.php");
			exit;
		} else {
			$_SESSION['message'] = " Le caractère  '  n'est pas accepté.";
			include_once('../vue/creation_cpt.php');
		}
	} else {
		include_once('../vue/creation_cpt.php');
	}
?>
