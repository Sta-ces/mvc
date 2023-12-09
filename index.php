<?php
namespace Staces\mvc;
use Staces\mvc\config as Config;

require_once __DIR__."/config.php";
Config\Importer::importFromFolders();

// ACTION DISPATCHER
if(isset($_POST["type"])){
    switch($_POST["type"]){
        case "home":
        default:
            break;
    }
}