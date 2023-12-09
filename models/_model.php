<?php
namespace Staces\mvc\model;
use Staces\mvc\config\Database;
use Staces\mvc\config\TableDatabase;
use Staces\mvc\model\DBPDO;

abstract class Model{
    use Database;
    use TableDatabase;
    protected $pdo = null;

    abstract protected function gets();
    abstract protected function add();
    abstract protected function set();
    abstract protected function delete();

    public function __construct(){
        if(!empty($this->name)){
            $this->pdo = new DBPDO($this->name, $this->login, $this->password, $this->database);
            if(file_exists("./../databases.db")) $this->q(file_get_contents("./../databases.db"));
        }
    }

    protected function q(string $sql, Array $vars = []){
        if($this->pdo && !empty($sql)) $this->pdo->q($sql, $vars);
    }
}