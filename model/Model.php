<?php
class Model {
	static $connections = array();

	//Pour tester en local
		public $conf = 'tests';

	//Pour tester sur le serveur
	//	public $conf = 'default';

	public $table = false;
	public $db;

	public function __construct()	{
		$conf = Conf::$databases[$this->conf];

		if( isset(Model::$connections[$this->conf]) ){
			$this->db = Model::$connections[$this->conf];
			return true;
		}

		try{
			$pdo = new PDO('mysql:host='.$conf['host'].';dbname='.$conf['database'].';',
			$conf['login'],
			$conf['password'],
			array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'));
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

			Model::$connections[$this->conf] = $pdo;
			$this->db = $pdo;
		}catch(PDOException $e){
			if(Conf::$debug > 1)
				die($e->getMessage());
			else
				die("Impossible de se connecter à la base de données.");
		}

		//Initialisation de la variable table.
		if($this->table === false)
		{
			$this->table = strtolower(get_class($this));
		}
	}

	//Fonction select
	public function executeQuery($sql){
		$pre = $this->db->prepare($sql);
		$pre->execute();

		return $pre->fetchAll(PDO::FETCH_OBJ);
	}

	//Fonction update
	public function executeUpdate($sql){
		$pre = $this->db->prepare($sql);
		$nb = $pre->execute();

		return $nb;
	}

	//Fonction insert
	public function executeInsert($sql){
		$pre = $this->db->prepare($sql);
		$nb = $pre->execute();

		return $nb;
	}

	public function find($req){
		$sql = "SELECT * "
					."FROM ".$this->table." AS ".get_class($this);

		//Construction de la condition
		if(isset($req['conditions'])){
			$sql .= " WHERE ";
			if(!is_array($req['conditions'])){
				$sql .= $req['conditions'];
			}else{
				$cond = array();
				foreach($req['conditions'] as $k=>$valeur){
					if(!is_numeric($valeur)){
						$valeur = '"'.mysql_real_escape_string($valeur).'"';
					}
					$cond[] = "$k=$valeur";
				}
				$sql .= implode(' AND ', $cond);
			}
		}

		$pre = $this->db->prepare($sql);
		$pre->execute();

		return $pre->fetchAll(PDO::FETCH_OBJ);
	}

	public function findFirst($req){
		return current($this->find($req));
	}
}
?>
