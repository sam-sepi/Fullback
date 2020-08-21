<?php

class MyClass 
{
    static function methodAllowed(callable $callback) 
    {
        $array = ['GET', 'POST'];

        if(in_array($callback(), $array))
        {
            echo 'DO';
        }
    }
   
    static function getMethod(): string
    {
        return "GET";
    }

    static function isAllowed(string $method)
    {
        $array = ['GET', 'POST'];

        if(in_array($method, $array))
        {
            echo 'DO';
        }
        else
        {
            echo 'BIG NO';
        }
    }

    public function __invoke(string $method)
    {
        call_user_func('self::isAllowed', $method);
    }

    public function __call($name, $arg)
    {
        return self::isAllowed($name, $arg);
    }

}

//Static callable
MyClass::methodAllowed('MyClass::getMethod');
//invoke
$cl = new MyClass();
$cl('GET');

$cl->get('BLA');

class MySecondClass
{
    public $name;
    public $sayMyName;
    public $greeting;

    public function __construct(string $name, string $nickname, string $greeting)
    {
        $this->name = $name;
        $this->nickname = $nickname;
        $this->greeting = $greeting;
    }

    public function __call($name, $args)
    {
        list($this->nickname, $this->sayMyName) = $args;
        $this->greeting = $name;
    }

    public function executionCallback()
    {
        echo call_user_func_array($this->sayMyName, array($this->name, $this->nickname, $this->greeting));
    }

    public function __destruct()
    {
        $this->executionCallback();
    }
}

$cll = new MySecondClass('John', 'Doe', 'Hello');

$cll->goodMorning('Foo', function($request, $nick, $greet) 
{
    print $request . $nick . $greet;
});