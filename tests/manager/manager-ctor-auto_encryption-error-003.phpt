--TEST--
MongoDB\Driver\Manager::__construct(): invalid option types
--SKIPIF--
<?php require __DIR__ . "/../utils/basic-skipif.inc"; ?>
<?php skip_if_not_libmongocrypt(); ?>
--FILE--
<?php

require_once __DIR__ . '/../utils/basic.inc';

$tests = [
    ['kmsProviders' => 'string'],
    [
        'kmsProviders' => ['local' => ['key' => new MongoDB\BSON\Binary('', 0)]],
        'schemaMap' => 'string',
    ],
    [
        'kmsProviders' => ['local' => ['key' => new MongoDB\BSON\Binary('', 0)]],
        'keyVaultClient' => 'string',
    ],
];

foreach ($tests as $test) {
    echo throws(function() use ($test) {
        $autoEncryptionOptions = ['keyVaultNamespace' => 'admin.dataKeys'];

        $manager = create_test_manager(null, [], ['autoEncryption' => $autoEncryptionOptions + $test]);
    }, MongoDB\Driver\Exception\InvalidArgumentException::class), "\n\n";
}

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
OK: Got MongoDB\Driver\Exception\InvalidArgumentException
Expected "kmsProviders" encryption option to be an array or object

OK: Got MongoDB\Driver\Exception\InvalidArgumentException
Expected "schemaMap" encryption option to be an array or object

OK: Got MongoDB\Driver\Exception\InvalidArgumentException
Expected "keyVaultClient" encryption option to be MongoDB\Driver\Manager, string given

===DONE===
