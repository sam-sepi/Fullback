<?php

class MyClass 
{
    static function myCallbackMethod() 
    {
        echo 'Hello World!';
    }

    public function __invoke($name) 
    {
        echo 'Hello ', $name, "\n";
    }
}

call_user_func(array('MyClass', 'myCallbackMethod'));

$obj = new MyClass();
call_user_func(array($obj, 'myCallbackMethod'));

call_user_func('MyClass::myCallbackMethod');

//invoke
$obj('John');
//alias
call_user_func($obj, 'John');

//specify callback
class MySecondClass 
{
    public $property = 'Hello World!';

    public function MyMethod()
    {
        call_user_func(array($this, 'myCallbackMethod'));
    }

    public function MyCallbackMethod()
    {
        echo $this->property;
    }
}

$cl = new MySecondClass();
$cl->MyMethod();
