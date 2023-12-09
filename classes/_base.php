<?php
namespace Staces\mvc\classe;

abstract class Base{
    protected $args;

    public function __construct(Array $args){ $this->args = $args; }
    protected function gets(){ return $this->args; }
    protected function get($name){ return $this->args[$name]; }
}