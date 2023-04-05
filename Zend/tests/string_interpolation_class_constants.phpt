--TEST--
Allow class constants in string interpolation
--FILE--
<?php

class Foo {
    const Bar = 123;
}

$foo = new Foo;

var_dump("{$foo::class}-{$foo::Bar}");

?>
--EXPECT--
string(7) "Foo-123"