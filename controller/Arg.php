<?php
require_once "../config/conf.php";
require_once ('../model/Model.php');
require_once ('../model/Debat.php');
$debatClass = new Debat();
	if(isset($_POST['id'])  ){
		$debat_id 	= $_POST['id'];
		$debatsArg = $debatClass->getListArgByDebatId($debat_id);
		echo json_encode($debatsArg);
	}

?>
