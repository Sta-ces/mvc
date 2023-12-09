<?php 
namespace Staces\mvc\view;

class View{
    public static function render(string $file, bool $isecho = true, bool $isadmin = false){
        $path = ($isadmin) ? "./admin/$file.html" : "./contents/$file.html";
        if(file_exists($path) && is_file($path)){
            $content = file_get_contents($path);
            if($isecho) echo $content;
            return $content;
        }
    }
}