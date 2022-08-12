--TEST--
filter_var() and FILTER_VALIDATE_REGEX_PATTERN
--EXTENSIONS--
filter
--FILE--
<?php

$patterns = [
  123,
  true,
  false,
  null,
  "",

  '/^[hH]ello,\s/',
  '/l^o,\s\w{5}/',
  '{FooBar}iu',
  '//i',
  '()',

  '/FooBar',
  '/FooBa[r/',
  '/[a-z]/e',
  "@multi\nline@",
];
foreach($patterns as $pattern){
  var_dump(filter_var($pattern, FILTER_VALIDATE_REGEXP_PATTERN));
}

echo "Done\n";
?>
--EXPECT--
bool(false)
bool(false)
bool(false)
bool(false)
bool(false)
string(14) "/^[hH]ello,\s/"
string(13) "/l^o,\s\w{5}/"
string(10) "{FooBar}iu"
string(3) "//i"
string(2) "()"
bool(false)
bool(false)
bool(false)
string(12) "@multi
line@"
Done
