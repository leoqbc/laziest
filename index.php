<?php

use Laziest\Core\CallCollection;
use Respect\Validation\Validator;

require dirname(__FILE__) . '/vendor/autoload.php';

class Robot
{
    public $responses='';
    
    public function __construct ()
    {
        echo 'Create';
    }
    
    public function hello ($name)
    {
        echo "Hello $name";
    }
    
    public function talk ($words)
    {
        $this->responses .= $wordrs;
        return $this;
    }

    public function hi ($name, $id)
    {
        $this->responses .= "Hi Robot:$id named:{$name}";
        return $this;
    }
}

$calls = new CallCollection(new Robot);

$calls2 = new CallCollection(new Validator);


$calls2->mountCalls([
    'string' => [],
    'length' => [5, 10],
    'validate' => ['Leonardo123123']
]);

var_dump($calls2->inlineTrigger());
