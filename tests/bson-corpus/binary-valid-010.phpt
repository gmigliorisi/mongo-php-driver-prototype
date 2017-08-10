--TEST--
Binary type: $type query operator (conflicts with legacy $binary form with $type field)
--DESCRIPTION--
Generated by scripts/convert-bson-corpus-tests.php

DO NOT EDIT THIS FILE
--FILE--
<?php

require_once __DIR__ . '/../utils/tools.php';

$canonicalBson = hex2bin('1F000000037800170000000224747970650007000000737472696E67000000');
$canonicalExtJson = '{"x" : { "$type" : "string"}}';

// Canonical BSON -> Native -> Canonical BSON 
echo bin2hex(fromPHP(toPHP($canonicalBson))), "\n";

// Canonical BSON -> Canonical extJSON 
echo json_canonicalize(toCanonicalExtendedJSON($canonicalBson)), "\n";

// Canonical extJSON -> Canonical BSON 
echo bin2hex(fromJSON($canonicalExtJson)), "\n";

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
1f000000037800170000000224747970650007000000737472696e67000000
{"x":{"$type":"string"}}
1f000000037800170000000224747970650007000000737472696e67000000
===DONE===