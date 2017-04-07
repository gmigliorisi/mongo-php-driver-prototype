--TEST--
DateTime: epoch
--DESCRIPTION--
Generated by scripts/convert-bson-corpus-tests.php

DO NOT EDIT THIS FILE
--FILE--
<?php

require_once __DIR__ . '/../utils/tools.php';

$bson = hex2bin('10000000096100000000000000000000');

// BSON to Canonical BSON
echo bin2hex(fromPHP(toPHP($bson))), "\n";

// BSON to Canonical extJSON
echo json_canonicalize(toExtendedJSON($bson)), "\n";

$json = '{"a" : {"$date" : "1970-01-01T00:00:00.000Z"}}';

// extJSON to Canonical extJSON
echo json_canonicalize(toExtendedJSON(fromJSON($json))), "\n";

$canonicalJson = '{"a" : {"$date" : {"$numberLong" : "0"}}}';

// Canonical extJSON to Canonical extJSON
echo json_canonicalize(toExtendedJSON(fromJSON($canonicalJson))), "\n";

// extJSON to Canonical BSON
echo bin2hex(fromJSON($json)), "\n";

// Canonical extJSON to Canonical BSON
echo bin2hex(fromJSON($canonicalJson)), "\n";

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
10000000096100000000000000000000
{"a":{"$date":{"$numberLong":"0"}}}
{"a":{"$date":{"$numberLong":"0"}}}
{"a":{"$date":{"$numberLong":"0"}}}
10000000096100000000000000000000
10000000096100000000000000000000
===DONE===