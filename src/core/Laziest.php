<?php

namespace Laziest\Core;

class Laziest 
{
    protected $class;
    protected $first_state;
    
    public function __construct($class)
    {
        $this->class = $class;
        if (is_object($class))
            $this->first_state = clone $class;
    }
    
    public function callMethod($method, $params=[])
    {
        return call_user_func_array([$this->class, $method], $params); 
    }
    
    public function reset()
    {
        $this->__construct($this->first_state);
    }
}