<?php
	$messageErreur = "";
	if(isset($_POST['username']) OR isset($_POST['pwd'])){
		$adminClass = new Administrateur();
		if((!isset($_POST['username']) OR $_POST['username'] == "") AND (!isset($_POST['pwd']) OR $_POST['pwd'] == "")){
			$messageErreur = "<b class='note'>Erreur : </b> Les deux champs doivent être saisis.";
			include_once('vue/connexion.php');
		} else {
			$username = $_POST['username'];
			$password = $_POST['pwd'];
			$resultIsLogin = $adminClass->isLogin($username);
			$resultPwd = $adminClass->getPasswordByLogin($username);

			if($resultIsLogin != null AND $resultIsLogin[0]->result == 1){
				if($resultPwd->result === $password)  {
					session_start();
					$_SESSION['last_access']=time();
					$_SESSION['ipaddr']=$_SERVER['REMOTE_ADDR'];
					$_SESSION['username'] = $username;
					include_once('vue/admin.php');
				} else {
					$messageErreur = "<b class='note'>Erreur : </b> Le mot de passe n'est pas correct.";
					include_once('vue/connexion.php');
				}
			} else {
				$messageErreur = "<b class='note'>Erreur : </b> Le login n'est pas correct.";
				include_once('vue/connexion.php');
			}
		}
	} else {
		// On affiche la page (vue)
		include_once('vue/connexion.php');
	}
?>
