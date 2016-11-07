<?php

Class User_histo extends Model {

	public $table = 'user_histo';

	public function getList() {
		$sql = "SELECT user_histo_id, user_histo_link_id, user_histo_lib_fr, user_histo_type, user_histo_rank  FROM user_histo ";
		$data = $this->executeQuery($sql);
		return $data;
	}
	public function getListByType($user_histo_type) {
		$sql = "SELECT user_histo_id, user_histo_link_id, user_histo_lib_fr, user_histo_type, user_histo_rank  FROM user_histo "
				."WHERE user_histo_id= '".$user_histo_type."'";
//		echo htmlentities($sql);
		$data = $this->executeQuery($sql);
		return $data;
	}

	public function getUser_histoById($user_histo_id) {
		$sql = "SELECT user_histo_id, user_histo_link_id, user_histo_lib_fr, user_histo_type, user_histo_rank  FROM user_histo "
					."WHERE user_histo_id= '".$user_histo_id."'";
		$data = $this->executeQuery($sql);
		return $data;
	}

	public function setNewUser_histo( $content, $ip) {
		$sql = "INSERT INTO user_histo ( user_histo_lib, user_histo_ip) "
		      ."VALUES ('".$content."','".$ip."')";
		//echo htmlentities($sql);
		$data = $this->executeInsert($sql);
		return $data;

	}

}
