<?php

Class Arg extends Model {

	public $table = 'arg';

	public function getList() {
		$sql = "SELECT arg.arg_id, debat.debat_id, arg.arg_lib_fr "
					."FROM arg, debat "
					."WHERE arg.debat_id = debat.debat_id ORDER BY arg.arg_rank desc ";

		$data = $this->executeQuery($sql);

		return $data;
	}

	public function getArgById($arg_id) {
		$sql = "SELECT arg.arg_id, debat.debat_id, arg.arg_lib_fr, arg.arg_rank "
					."FROM arg, debat "
					."WHERE arg.debat_id = debat.debat_id "
					."AND arg_id= '".$arg_id."'";

		$data = $this->executeQuery($sql);

		return $data;
	}

	public function getListJustifByArgId($arg_id) {
		$sql = "SELECT justif.justif_lib_fr,  "
					."arg.arg_lib_fr,  "
					."debat.debat_lib_fr, justif.justif_lib_en, "
					."justif.justif_id, justif.arg_id "
					."FROM justif "
					."LEFT JOIN arg ON justif.arg_id = arg.arg_id "
					."LEFT JOIN debat ON arg.debat_id = debat.debat_id "
					."WHERE justif.arg_id = '".$arg_id."'";
		$data = $this->executeQuery($sql);

		if ($data != null && count($data) > 0) {
			return $data;
		}

		return null;
	}

	public function setArgByIdLibFr( $arg_id, $content, $arg_rank) {
		$sql = "UPDATE arg SET arg_lib_fr = '".$content."', arg_rank = '".$arg_rank."'"
			." where arg.arg_id = '".$arg_id."' ";
//		$data = $this->executeInsert("INSERT INTO log (log_lib, log_ip) VALUES ('".str_replace("'","''", $sql)."','".$ip."')");
//		echo htmlentities($sql);
		$resultUp = $this->executeUpdate($sql);
		return $resultUp;
	}

	public function setArgByIdForRank( $arg_id, $arg_rank) {
		$sql = "UPDATE arg SET arg_rank = '".$arg_rank."'"
			." where arg.arg_id = '".$arg_id."' ";
//		$data = $this->executeInsert("INSERT INTO log (log_lib, log_ip) VALUES ('".str_replace("'","''", $sql)."','".$ip."')");
//		echo htmlentities($sql);
		$resultUp = $this->executeUpdate($sql);
		return $resultUp;
	}

	public function setNewArg( $debat_id, $content, $arg_rank) {
		$sql = "INSERT INTO arg (debat_id, arg_lib_fr, arg_rank) "
		      ."VALUES ('".$debat_id."','".$content."','".$arg_rank."')";
		//echo htmlentities($sql);
//		$data = $this->executeInsert("INSERT INTO log (log_lib, log_ip) VALUES ('".str_replace("'","''", $sql)."','".$ip."')");
		$data = $this->executeInsert($sql);
		return $data;
	}

	public function deleteArgById($arg_id) {
		if(isset($_SESSION["ip"])  ){
			$ip = $_SESSION["ip"];
		}
		$sql = "DELETE FROM arg WHERE arg_id = '".$arg_id."'";
//		$data = $this->executeInsert("INSERT INTO log (log_lib, log_ip) VALUES ('".str_replace("'","''", $sql)."','".$ip."')");
		$data = $this->executeUpdate($sql);
		return $data;
	}


}
