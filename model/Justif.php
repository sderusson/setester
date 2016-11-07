<?php
Class Justif extends Model {

	public $table = 'justif';

	public function getList() {
		$sql = "SELECT  arg_id, justif_lib_fr, justif_lib_en, arg_id, justif_url, justif_rank "
					."FROM justif ";
		$data = $this->executeQuery($sql);

		return $data;
	}

	public function getJustifById($justif_id) {
		$sql = "SELECT  arg_id, justif_lib_fr, justif_lib_en, arg_id, justif_url, justif_rank "
					."FROM justif "
					."WHERE justif_id = '".$justif_id."'";

		$data = $this->executeQuery($sql);

		if ($data != null && count($data) > 0) {
			return $data[0];
		}

		return null;
	}


	public function updateJustifById($justif_MAJ,$justif_id){
		$sql = "UPDATE justif SET justif_lib_fr = '".$justif_MAJ.
			   "' WHERE justif_id = '".$justif_id."'";

		$result = $this->executeUpdate($sql);

		return $result;
	}

}
?>
