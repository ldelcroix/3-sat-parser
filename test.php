<?php

$string = new SplString("Testing");

try {
    $string = array();
} catch (UnexpectedValueException $uve) {
    echo $uve->getMessage() . PHP_EOL;
}

var_dump($string);
echo $string; // Outputs "Testing"