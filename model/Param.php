<?php

Class Param extends Model {

	public $table = 'param';

	public function getList() {
		$sql = "SELECT param_lib, param_value FROM param ";
		$data = $this->executeQuery($sql);
		return $data;
	}

}

