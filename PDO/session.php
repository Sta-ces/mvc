<?php
namespace Staces\mvc\model;

class Session{
    public function __construct($lifetime = 0){
        if(!$this->checkSession(session_id())){
            session_set_cookie_params($lifetime);
            session_start();
        }
    }
    public function checkSession($session_id){ return isset($_SESSION["sessid"]) && $this->isValid($session_id) && $_SESSION["sessid"] === $session_id; }
    public function deleteSession(){
        $_SESSION["sessid"] = "";
        $_SESSION["view"] = "";
        $_SESSION["user"] = "";
        session_destroy();
    }
    public function getSessionId(){ return $_SESSION["sessid"]; }
    public function setSessionId($session_id){ if($this->isValid($session_id)) $_SESSION["sessid"] = $session_id; }
    public function getSessionView(){ return (isset($_SESSION['view'])) ? $_SESSION['view'] : 'home'; }
    public function setSessionView($view){ $_SESSION['view'] = $view; }
    public function getSessionUser(){ return $_SESSION['user']; }
    public function setSessionUser($user){ $_SESSION['user'] = $user; }
    protected function isValid($session_id){ return preg_match('/^[-,a-zA-Z0-9]{1,128}$/', $session_id) > 0 && session_status() == PHP_SESSION_ACTIVE; }
}