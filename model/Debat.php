<?php
Class Debat extends Model {

	public $table = 'debat';

	public function getList() {
		$sql = "SELECT debat_id, debat_lib_fr, debat_rank "
					."FROM debat ORDER BY debat_rank desc " ;
		$data = $this->executeQuery($sql);

		return $data;
	}

	public function setDebat( $content, $debat_rank) {
		$sql = "INSERT INTO debat (debat_lib_fr, debat_rank) "
		      ."VALUES ('".$content."','".$debat_rank."')";
		//echo htmlentities($sql);
//		$data = $this->executeInsert("INSERT INTO log (log_lib, log_ip) VALUES ('".str_replace("'","''", $sql)."','".$ip."')");
		$data = $this->executeInsert($sql);
		return $data;
	}

	public function setDebatById( $debat_id, $debat_rank) {
		$sql = "UPDATE debat SET debat_rank = '".$debat_rank."' where debat_id = '".$debat_id."'";
//		$data = $this->executeInsert("INSERT INTO log (log_lib, log_ip) VALUES ('".str_replace("'","''", $sql)."','".$ip."')");
		$resultUp = $this->executeUpdate($sql);
		return $resultUp;
	}

	public function getDebatById($debat_id) {
		$sql = "SELECT debat_id, debat_lib_fr, debat_rank "
			." FROM debat "
			." WHERE debat_id = '".$debat_id."'";
		$data = $this->executeQuery($sql);
/*		if ($data != null && count($data) > 0) {
			$data = $this->executeInsert("INSERT INTO log (log_lib, log_ip) VALUES ('".str_replace("'","''", $sql)."','".$ip."')");
			return $data[0];
		}
		return null;*/
		return $data;
	}

	public function getListArgByDebatId($debat_id) {
		$sql = "SELECT arg.arg_id, arg.arg_lib_fr, arg.debat_id, debat.debat_lib_fr, arg.arg_rank "
			."FROM arg, debat "
			."WHERE debat.debat_id = arg.debat_id "
			."  AND debat.debat_id = '".$debat_id."' "
			."ORDER BY arg.arg_rank desc ";
		$data = $this->executeQuery($sql);
		return $data;
	}

	public function getListDebatArgFromLibFr($texteAChercher) {
		$sql = "SELECT  debat.debat_lib_fr, arg.arg_lib_fr, arg.arg_id, debat.debat_id, count(*) as number"
					."FROM arg, justif, debat "
					."WHERE arg.debat_id = debat.debat_id "
					."  AND justif.arg_id = arg.arg_id "
					."  AND debat.debat_lib_fr LIKE '%".$texteAChercher."%'"
					." Group by debat.debat_lib_fr, arg.arg_lib_fr,  arg.arg_id,  debat.debat_id";

		$data = $this->executeQuery($sql);

		return $data;
	}

}
?>
