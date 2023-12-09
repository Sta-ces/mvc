<?php
namespace Staces\mvc\config;

/**
 * Name : Importer
 * Author : Cedric Staces
 * Uri : https://staces.be/
**/
class Importer{
	public static function importFromFolders(Array $folders = [], Array $notimport = []){
		$notimport = array_merge($notimport, ["databases.db", "index.php", "config.php"]);
		if(count($folders) <= 0) $folders = scandir(__DIR__);
		foreach ($folders as $key => $folder){
			if(is_dir($folder) && !in_array($folder, [".", ".."])){
				$scripts = scandir($folder);
				foreach ($scripts as $script)
					if(!in_array($script, $notimport))
						self::import("./$folder/$script");
			}
		}
	}

	public static function importFromFolder(string $folder, Array $notimport = []){ self::importFromFolders([$folder], $notimport); }

	public static function import(string $file){
		$path = "./$file";
		if(is_file($path) && file_exists($path)) require_once $path;
	}
}

// Change name, login, password and database for connexion
trait Database{
	public $name = "";
	public $login = "root";
	public $password = "";
	public $database = "localhost";
}

// List all name tables in a variable
trait TableDatabase{}