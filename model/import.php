<?php
Class Import extends Model {


	/******************************************************************/
	/**                       Init des données                       **/
	/******************************************************************/

	public function initDebat($debat_id, $debat_lib_fr){
		$id = str_replace("'", "''", $debat_id);
		$nom = str_replace("'","''", $debat_lib_fr);

		$sql = "INSERT INTO Debat(debat_id, debat_lib_fr) "
		      ."VALUES ('".$id."','".$nom."')";

		$data = $this->executeInsert($sql);

		return $data;
	}

	public function initArg($arg_id, $arg_lib_fr, $arg_lib_en, $debat_id){
		$id = str_replace("'", "''", $arg_id);
		$arg_lib_fr = str_replace("'","''", $arg_lib_en);
		$arg_lib_en = str_replace("'","''", $arg_lib_en);
		$refC = str_replace("'","''", $debat_id);

		$sql = "INSERT INTO Arg(arg_id, arg_lib_fr,arg_lib_en,debat_id) "
		      ."VALUES ('".$id."','".$arg_lib_fr."','".$arg_lib_en."','".$refC."')";

		$data = $this->executeInsert($sql);

		return $data;
	}

	public function initJustif($justif_id, $arg_id, $justif_lib_fr, $justif_lib_en){
		$id = str_replace("'", "''", $justif_id);
		$refS = str_replace("'","''", $arg_id);
		$texteO = str_replace("'","''", $justif_lib_fr);
		$texte1 = str_replace("'","''", $justif_lib_en);


		$resultTFR = $this->executeInsert($sql);


		// Insérer le justif ($justif_id, $justif_lib_fr, #arg_id)

		$sql = "INSERT INTO Justif(justif_id, justif_lib_fr, arg_id) "
		      ."VALUES ('".$justif_id."','".$justif_lib_fr."','".$arg_id.")";

		$data = $this->executeInsert($sql);

		return $data;
	}

}
