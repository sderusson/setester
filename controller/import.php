<?php
	$messageErreur = "";
	$_SESSION['tab'] = 0;
	if(isset($_FILES['fileAUploader'])){
		$importClass = new Import();
		if((!isset($_FILES['fileAUploader']) OR $_FILES['fileAUploader']['name'] == "")){
			$messageErreur = "<b class='note'>Erreur : </b> Le fichir doit être sélectionné avant l'upload.";
			include_once('vue/admin.php');
		} else {
			$fileAUploader = $_FILES['fileAUploader'];
			$extension = substr($fileAUploader['name'], -3);

			if($extension != null AND $extension === "csv"){
				if($fileAUploader['size'] != 0){
					$handle = fopen($fileAUploader['tmp_name'], "r");
					$count = 0;
					$typeImport = 0; //typeImport = 0 si justif_lib_fr FR, 1 si justif_lib_en EN (à améliorer ?)
					while (($data = fgetcsv($handle, 1000, "#")) !== FALSE) {
						// Traitement de l'en-tête
						if($count == 0){

							if($data[0] === "justif_id" AND ($data[1] === "justif_lib_en" OR $data[1] === "justif_lib_fr") AND !isset($data[2])){
								if(substr($data[1], -2) === "En") {
									$typeImport = 1;
								}
							} else {
								// Cas où on a une mauvaise en-tête -> rejet du fichier
								fclose($handle);
								$messageErreur = "<b class='note'> Erreur : </b> Le fichier n'est pas correct, veuillez le vérifier.";
								include_once('vue/admin.php');
								return;
							}
						} else {
							if($typeImport == 0){
								$return = $importClass->importDataFr($data[0],$data[1]);
							} else {
								$return = $importClass->importDataEn($data[0],$data[1]);
							}
							if($return == null OR !$return){
								fclose($handle);
								$messageErreur = "<b class='note'> Erreur : </b> L'upload ne s'est pas terminé correctement (".($count-1)." ligne(s) importée(s))";
								include_once('vue/admin.php');
							}
						}
						$count++;
					}
					fclose($handle);
					$messageErreur = "<b class='note'> Succès : </b>".($count-1)." ligne(s) importée(s).";
					include_once('vue/admin.php');
				} else {
					$messageErreur = "<b class='note'>Erreur : </b> Vérifier votre fichier. Sa taille est de 0 octets.";
					include_once('vue/admin.php');
				}
			} else {
				$messageErreur = "<b class='note'>Erreur : </b> Seuls les .csv sont autorisés.";
				include_once('vue/admin.php');
			}
		}
	} else {
		// On affiche la page (vue)
		include_once('vue/admin.php');
	}
?>
