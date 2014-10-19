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
        $this->responses .= $words;
        return $this;
    }

    public function hi ($name, $id)
    {
        $this->responses .= "Hi Robot:$id named:{$name}";
        return $this;
    }
}

$calls = new CallCollection(new Validator);

$str_calls = [
    'string'    => [],
    'alnum'     => [],
    'length'    => [5, 20]
];

$string = $calls->inlineTrigger($str_calls);

$calls->mountCalls([
    'name' => $str_calls,
    'age' => [
        'int'       => [],
        'positive'  => [],
        'between'   => [18, 35, true]
    ],
    'toy' => [
        'arr' => [],
        'key.a' => ['name'],
        'key.b' => ['type', $string],
        'key.c' => ['wheels', $calls->inlineTrigger([
                'int' => [],
                'between' => [2, 8, true]
        ])]
    ]
]);

$toy = [
  'name'    => 'Dark Rebel',
  'type'    => 'Motorcycle',
  'wheels'  => 4
];

$calls->groupTrigger();

var_dump($calls->name->validate('Leonardo'));
var_dump($calls->age->validate(32));
var_dump($calls->toy->validate($toy));


