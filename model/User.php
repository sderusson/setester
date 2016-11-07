<?php

Class User extends Model {

	public $table = 'user';

	public function getList() {

// user_mail, user_pseudo, user_mail, user_pasw, user_actif, user_rank
		$sql = "SELECT user_mail, user_pseudo, user_mail, user_pasw, user_actif, user_rank FROM user ";
		$data = $this->executeQuery($sql);
		return $data;
	}

	public function setUser( $user_mail, $user_pasw, $user_actif, $user_rank) {
		$user_mail = str_replace("'","''", $user_mail); //Echappement des ' pour éviter toute erreur SQL.
		$user_pasw = password_hash($user_pasw, PASSWORD_DEFAULT);
		$sql = "INSERT INTO user ( user_mail, user_pasw, user_actif, user_rank) "
		      ."VALUES ('".$user_mail."','".$user_pasw."','".$user_actif."','".$user_rank."')";
		//$data = $this->executeInsert("INSERT INTO log (log_lib, log_ip) VALUES ('".str_replace("'","''", $sql)."','".$ip."')");
		$data = $this->executeInsert($sql);
		return $data;
	}

	public function isLogin($user_mail){
		$sql = "SELECT 1 as result  FROM user where user_mail = '".$user_mail."' ";;
		//$data = $this->executeInsert("INSERT INTO log (log_lib, log_ip) VALUES ('".str_replace("'","''", $sql)."','".$ip."')");
		$data = $this->executeQuery($sql);
		if ($data != null && count($data) > 0) {
			return $data;
		}
		return null;
	}

	public function getPasswordByLogin($user_mail) {
		$sql = "SELECT user_pasw FROM user where user_mail = '".$user_mail."' ";;
//		$data = $this->executeInsert("INSERT INTO log (log_lib, log_ip) VALUES ('".str_replace("'","''", $sql)."','".$ip."')");
		$user_pasw = $this->executeQuery($sql);
		return $user_pasw;
	}
}
