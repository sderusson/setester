<?php

Class User_histo extends Model {

	public $table = 'user_histo';
// SELECT user_mail, user_histo_date, debat_id, arg_id, user_histo_action, user_ip FROM user_histo WHERE 1

	public function getList() {

		$sql = "SELECT user_mail, user_histo_date, debat_id, arg_id, user_histo_action, user_ip FROM user_histo ";
		$data = $this->executeQuery($sql);
		return $data;
	}

	public function setUser_histo( $user_mail, $debat_id, $arg_id, $user_histo_action, $user_ip) {
		$sql = "INSERT INTO user_histo (user_mail, debat_id, arg_id, user_histo_action, user_ip) "
		      ."VALUES ('".$user_mail."','".$debat_id."','".$arg_id."','".$user_histo_action."','".$user_ip."')";
		$data = $this->executeInsert($sql);
		return $data;
	}


}
