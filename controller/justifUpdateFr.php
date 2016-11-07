<?php
	//session_start();
	$_SESSION['tab'] = 1;

	$justifClass = new Justif();

	// Récupération des variables situées dans le post
   	$justifMAJ = $_POST['formJustif'];
    $debat_id = $_POST['formIdDebat'];
    $arg_id = $_POST['formIdArg'];
    $justif_id = $_POST['formIdJustif'];

	if(isset($justifMAJ) AND isset($debat_id) AND isset($arg_id) AND isset($justif_id)){

		//Echappement des ' pour éviter toute erreur SQL.
		$justifMAJ = str_replace("'","''", $justifMAJ);

		$result = $justifClass->updateJustifById($justifMAJ,$justif_id);

		if($result) {
			$messageErreurUpdateOriginal = "Vos modifications ont bien été prises en compte.";
		} else {
			$messageErreurUpdateOriginal = "Erreur technique, veuillez recharger la page.";
		}


	} else {
		$messageErreurUpdateOriginal = "Erreur technique, veuillez recharger la page.";
	}

	include("/vue/admin.php");
?>
