<?php

class a
{
    function a($x = 1)
    {
        $this->myvar = $x;
    }
}

class b extends a
{
    private $myvar;

    function b($x = 2)
    {
        $this->myvar = $x;
        parent::a();
    }
}

$obj = new b;
echo $obj->myvar;
/*
PHP Fatal error:  Cannot access private property b::$myvar
*/
