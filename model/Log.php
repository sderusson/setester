<?php

Class Log extends Model {

	public $table = 'log';

	public function getList() {
		$sql = "SELECT log_id, log_link_id, log_lib_fr, log_type, log_rank  FROM log ";
		$data = $this->executeQuery($sql);
		return $data;
	}
	public function getListByType($log_type) {
		$sql = "SELECT log_id, log_link_id, log_lib_fr, log_type, log_rank  FROM log "
				."WHERE log_id= '".$log_type."'";
//		echo htmlentities($sql);
		$data = $this->executeQuery($sql);
		return $data;
	}

	public function getLogById($log_id) {
		$sql = "SELECT log_id, log_link_id, log_lib_fr, log_type, log_rank  FROM log "
					."WHERE log_id= '".$log_id."'";
		$data = $this->executeQuery($sql);
		return $data;
	}

	public function setNewLog( $content, $ip) {
//		$content = htmlentities(str_replace("'","''", $content)); //Echappement des ' pour éviter toute erreur SQL.
		$sql = "INSERT INTO log ( log_lib, log_ip) "
		      ."VALUES ('".$content."','".$ip."')";
		//echo htmlentities($sql);
		$data = $this->executeInsert($sql);
		return $data;

	}

}
