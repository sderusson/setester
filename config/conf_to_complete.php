<?php

//	renommer le fichier en conf.php
// parametrer la connexion à votre base de données suivant votre usage
// modifier le fichier model/model.php variable $conf en fonction de la base de donnée choisie, default ou tests

class Conf{
	static $debug = 1;

	static $databases = array(
		'default' => array(
			'host' => 'xxx',
			'database' => 'xxx',
			'login' => 'xxx',
			'password' => 'xxx'
		),
		'tests' => array(
			'host' => 'localhost',
			'database' => 'xxx',
			'login' => 'root',
			'password' => 'xxx'
			)
	);
}
?>
