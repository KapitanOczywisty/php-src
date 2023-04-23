--TEST--
Testing Closure self-reference external references
--FILE--
<?php

$closure = null;
$external_reference = null;
$external_value = null;

$fibbonaci = function($number) as $fn {
    global $external_reference;
    global $external_value;

    $external_reference = &$fn;
    $external_value = $fn;

    if ($number == 1) {
        return 1;
    }

    return $number + $fn($number - 1);
};

function call_fn($fn, $number) {
    echo $fn($number) . "\n";
}

echo $fibbonaci(5) . "\n";
echo $fibbonaci(2) . "\n";

echo "external value\n";
call_fn($external_value, 5);
call_fn($external_value, 2);

echo "external reference\n";
call_fn($external_reference, 5);
call_fn($external_reference, 2);

echo "setting null\n";
$fibbonaci = null;

echo "external value\n";
call_fn($external_value, 5);
call_fn($external_value, 2);
echo "external reference\n";
call_fn($external_reference, 5);
call_fn($external_reference, 2);

?>
--EXPECTF--
15
3
external value
15
3
external reference
15
3
setting null
external value
15
3
external reference
15
3
