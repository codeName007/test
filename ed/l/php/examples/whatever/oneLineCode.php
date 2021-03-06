<?php

/**
 * Interesting.
 */
var_export(['range' => 0.99]); // array ( 'range' => 0.98999999999999999, )
var_dump(in_array('test', array(0))); // bool(true) - Because test converts to integer.
var_dump(in_array('test', array(0), true)); // bool(false)
var_dump(0123); // int(83) - Because 0 in beginning cast number to octal.
echo (int)((0.1+0.7)*10); // echoes 7! - Unexplained...
var_dump(empty(false)); // bool(true)
var_dump(count(false)); // int(1) !!!
var_dump(count(true)); // int(1)
var_dump(count(null)); // int(0)
$b = 3; $c = 1; var_export($b+++$c); // 4

/**
 * NOT Interesting.
 */
echo sprintf('"%04d"', 1).PHP_EOL; // "0001"
var_export([
    5 % 2,
    7 % 3,
    11 % 2,
    8 % 4
]);
/*
array (
  0 => 1,
  1 => 1,
  2 => 1,
  3 => 0,
)
*/
$foo = 'boo';
var_dump($GLOBALS['foo']);
