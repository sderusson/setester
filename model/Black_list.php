<?php

Class Black_list extends Model {

	public $table = 'black_list';

	public function getList() {

// bl_ip, bl_rank
		$sql = "SELECT bl_ip, bl_rank FROM black_list ";
		$data = $this->executeQuery($sql);
		return $data;
	}

	public function setBlack_list( $bl_ip, $bl_rank) {
		$sql = "INSERT INTO black_list ($bl_ip, $bl_rank) "
		      ."VALUES ('".$bl_ip."','".$bl_rank."')";
//		echo htmlentities($sql);
		$data = $this->executeInsert($sql);
		return $data;
	}

	public function isInBlackList($bl_ip){
		$sql = "SELECT 1 as result  FROM black_list where bl_ip = '".$$bl_ip."' ";;
//		$data = $this->executeInsert("INSERT INTO log (log_lib, log_ip) VALUES ('".str_replace("'","''", $sql)."','".$ip."')");
		$data = $this->executeQuery($sql);
		if ($data != null && count($data) > 0) {
			return $data;
		}
		return null;
	}

}
