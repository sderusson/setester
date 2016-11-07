<?php

Class Prop extends Model {

	public $table = 'prop';

	public function getList() {
		$sql = "SELECT prop_id, prop_link_id, prop_lib_fr, prop_type, prop_rank  FROM prop ";
		$data = $this->executeQuery($sql);
		return $data;
	}
	public function getListByType($prop_type) {
		if(isset($_SESSION["ip"])  ){
			$ip = $_SESSION["ip"];
		}
		$sql = "SELECT prop_id, prop_link_id, prop_lib_fr, prop_type, prop_rank  FROM prop "
				."WHERE prop_type = '".$prop_type."'"
				." ORDER BY prop_rank DESC ";
//		$data = $this->executeInsert("INSERT INTO log (log_lib, log_ip) VALUES ('".str_replace("'","''", $sql)."','".$ip."')");
		$data = $this->executeQuery($sql);
		return $data;
	}
	public function getListByDebat($prop_type,$prop_link_id) {
		if(isset($_SESSION["ip"])  ){
			$ip = $_SESSION["ip"];
		}
		$sql = "SELECT prop_id, prop_link_id, prop_lib_fr, prop_type, prop_rank  FROM prop "
				." WHERE prop_type = '".$prop_type."' AND prop_link_id = '".$prop_link_id."'"
				." ORDER BY prop_rank DESC ";
//		$data = $this->executeInsert("INSERT INTO log (log_lib, log_ip) VALUES ('".str_replace("'","''", $sql)."','".$ip."')");
		$data = $this->executeQuery($sql);
		return $data;
	}

	public function getPropById($prop_id) {
		if(isset($_SESSION["ip"])  ){
			$ip = $_SESSION["ip"];
		}
		$sql = "SELECT prop_id, prop_link_id, prop_lib_fr, prop_type, prop_rank  FROM prop "
					."WHERE prop_id= '".$prop_id."'";
//		$data = $this->executeInsert("INSERT INTO log (log_lib, log_ip) VALUES ('".str_replace("'","''", $sql)."','".$ip."')");
		$data = $this->executeQuery($sql);
		return $data;
	}

	public function setNewProp( $id, $content, $type, $ip, $user_mail, $prop_rank) {
		if(isset($_SESSION["ip"])  ){
			$ip = $_SESSION["ip"];
		}
		$content = htmlentities($content,ENT_QUOTES); //Convertit tous les caractères éligibles en entités HTML.
		$sql = "INSERT INTO prop (prop_link_id, prop_lib_fr, prop_type, prop_ip, prop_user_mail, prop_rank) "
		      ."VALUES ('".$id."','".$content."','".$type."','".$ip."','".$user_mail."','".$prop_rank."')";
//		$data = $this->executeInsert("INSERT INTO log (log_lib, log_ip) VALUES ('".str_replace("'","''", $sql)."','".$ip."')");
		$data = $this->executeInsert($sql);
		return $data;
	}

	public function setProp( $prop_id, $prop_rank) {
		if(isset($_SESSION["ip"])  ){
			$ip = $_SESSION["ip"];
		}
		$sql = "UPDATE prop SET prop_rank = '".$prop_rank."' where prop_id = '".$prop_id."'";
//		$data = $this->executeInsert("INSERT INTO log (log_lib, log_ip) VALUES ('".str_replace("'","''", $sql)."','".$ip."')");
		$resultUp = $this->executeUpdate($sql);
		return $resultUp;
	}

	public function deletePropById($prop_id) {
		if(isset($_SESSION["ip"])  ){
			$ip = $_SESSION["ip"];
		}
		$sql = "DELETE FROM prop WHERE prop_id = '".$prop_id."'";
//		$data = $this->executeInsert("INSERT INTO log (log_lib, log_ip) VALUES ('".str_replace("'","''", $sql)."','".$ip."')");
		$data = $this->executeUpdate($sql);
		return $data;
	}

}
