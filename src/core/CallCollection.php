<?php
namespace Laziest\Core;
use Laziest\Core\Laziest;

class CallCollection
{
    protected $lazy;
    
    protected $calls = [];
    
    protected $returns = [];
    
    public function __construct($class)
    {
        $this->lazy = new Laziest($class);
    }
    
    public function mountCalls(array $call_list)
    {
        $this->calls = 
            array_merge($this->calls, $call_list);
    }
    
    public function getReturns()
    {
        return $this->returns;
    }
    
    public function show()
    {
        echo '<pre>';
        print_r($this->calls);
        print_r($this->returns);
        echo '</pre>';
    }
    
    public function trigger()
    {   
        foreach ($this->calls as $method => $params)
        {
            ($return = 
                $this->lazy->callMethod($method, $params))? 
                    $this->returns[$method] = $return:'';
        }
    }
    
    public function inlineTrigger(array $triggers=[])
    {
        $calls = $triggers?$triggers:$this->calls;
        foreach ($calls as $method => $params)
        {
            $method = $this->hasPostfix($method);
            $return = $this->lazy->callMethod($method, $params);
        }
        $this->clearCalls();
        return $return;
    }
    
    public function hasPostfix ($method)
    {
        $divide = explode('.', $method);
        return $divide[0];
    }
    
    public function groupTrigger()
    {
        foreach ($this->calls as $prop => $calls)
        {
            $this->$prop = $this->inlineTrigger($calls);
        }
    }
    
    public function call($method, $pars=[])
    {
        return $this->lazy->callMethod($method, $pars);
    }
    
    public function clearCalls()
    {
        $this->lazy->reset();
        $this->calls = [];
    }    
}

?>