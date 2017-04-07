--TEST--
Javascript Code with Scope: Empty code string, empty scope
--DESCRIPTION--
Generated by scripts/convert-bson-corpus-tests.php

DO NOT EDIT THIS FILE
--FILE--
<?php

require_once __DIR__ . '/../utils/tools.php';

$bson = hex2bin('160000000F61000E0000000100000000050000000000');

// BSON to Canonical BSON
echo bin2hex(fromPHP(toPHP($bson))), "\n";

// BSON to Canonical extJSON
echo json_canonicalize(toExtendedJSON($bson)), "\n";

$json = '{"a" : {"$code" : "", "$scope" : {}}}';

// extJSON to Canonical extJSON
echo json_canonicalize(toExtendedJSON(fromJSON($json))), "\n";

// extJSON to Canonical BSON
echo bin2hex(fromJSON($json)), "\n";

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
160000000f61000e0000000100000000050000000000
{"a":{"$code":"","$scope":{}}}
{"a":{"$code":"","$scope":{}}}
160000000f61000e0000000100000000050000000000
===DONE===