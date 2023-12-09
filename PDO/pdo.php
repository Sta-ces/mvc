<?php
namespace Staces\mvc\model;

/**
 * PDO Class
 */
class DBPDO
{
	private $dbbase;
	private $dbname;
	private $dblogin;
	private $dbpassword;
	private $connect;
	private $error;

	public function __construct(string $name, string $login = "root", string $password = "", string $base = "localhost"){
		$this->dbbase = $base;
		$this->dbname = $name;
		$this->dblogin = $login;
		$this->dbpassword = $password;
		$this->connexion();
	}

	private function connexion(){
		try{
			$dns = "mysql:host={$this->dbbase};dbname={$this->dbname}";
			$bdd = new \PDO($dns, $this->dblogin, $this->dbpassword);
			$bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
			$bdd->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
			$this->connect = $bdd;
			$this->error = "Aucune erreur";
		}
		catch(\PDOException $e){
			$this->error = '<br>ERREUR PDO dans '.$e->getFile().' L.'.$e->getLine().' : '.$e->getMessage()."<br>";
			echo '<br>ERREUR PDO : vérifié la connexion à la base de donnée.<br>';
		}
	}

	public function q(string $sql, Array $vars = []){
		$cps = $this->connect->prepare($sql);
		$cps->execute($vars);

		if(preg_match("/^(SELECT)/", $sql)) return $cps->fetchAll();
		
		$cps->closeCursor();
		$cps = null;
	}

	public function getError(bool $echo = true){
		if($echo) echo $this->error;
		return $this->error;
	}
}