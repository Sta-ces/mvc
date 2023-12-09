<?php
namespace Staces\mvc\controller;

abstract class Controller{
    protected $model = null;
    
    abstract protected function gets();
    abstract protected function add();
    abstract protected function set();
    abstract protected function delete();
}