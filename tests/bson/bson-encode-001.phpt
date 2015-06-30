--TEST--
BSON encoding: Encoding data into BSON representation, and BSON into Extended JSON
--SKIPIF--
<?php require __DIR__ . "/../utils/basic-skipif.inc"?>
--FILE--
<?php
require_once __DIR__ . "/../utils/basic.inc";

$tests = array(
    array("hello" => "world"),
    (object)array("hello" => "world"),
    array(array("hello" => "world")),
    array((object)array("hello" => "world")),
    array(array(1, 2, 3, 4, 5, 6, 7, 8, 9)),
    array((object)array(1, 2, 3, 4, 5, 6, 7, 8, 9)),
    array(array("0" => 1, "1" => 2, "2" => 3, "3" => 4, "4" => 5, "5" => 6, "6" => 7, "7" => 8, "8" => 9)),
    array(null),
    array(123),
    array(4.23),
    array(true),
    array(false),
    array("string"),
    array("string", true),
    array('test', 'foo', 'bar'),
    array('test' => 'test', 'foo' => 'foo', 'bar' => 'bar'),
    array('foo' => 'test', 'foo', 'bar'),
    array("int" => 3, "boolean" => true, "array" => array("foo", "bar"), "object" => new stdclass, "string" => "test", 3 => "test"),
    array(array("string", true)),
    array(array('test', 'foo', 'bar')),
    array(array('test' => 'test', 'foo' => 'foo', 'bar' => 'bar')),
    array(array('foo' => 'test', 'foo', 'bar')),
    array(array("int" => 3, "boolean" => true, "array" => array("foo", "bar"), "object" => new stdclass, "string" => "test", 3 => "test")),
);

foreach($tests as $n => $test) {
    $s = MongoDB\BSON\fromArray($test);
    echo "Test#{$n} ", MongoDB\BSON\toJSON($s), "\n";
    hex_dump($s);
}
?>
===DONE===
<?php exit(0); ?>
--EXPECT--
Test#0 { "hello" : "world" }
     0 : 16 00 00 00 02 68 65 6c 6c 6f 00 06 00 00 00 77  [.....hello.....w]
    10 : 6f 72 6c 64 00 00                                [orld..]
Test#1 { "hello" : "world" }
     0 : 16 00 00 00 02 68 65 6c 6c 6f 00 06 00 00 00 77  [.....hello.....w]
    10 : 6f 72 6c 64 00 00                                [orld..]
Test#2 { "0" : { "hello" : "world" } }
     0 : 1e 00 00 00 03 30 00 16 00 00 00 02 68 65 6c 6c  [.....0......hell]
    10 : 6f 00 06 00 00 00 77 6f 72 6c 64 00 00 00        [o.....world...]
Test#3 { "0" : { "hello" : "world" } }
     0 : 1e 00 00 00 03 30 00 16 00 00 00 02 68 65 6c 6c  [.....0......hell]
    10 : 6f 00 06 00 00 00 77 6f 72 6c 64 00 00 00        [o.....world...]
Test#4 { "0" : [ 1, 2, 3, 4, 5, 6, 7, 8, 9 ] }
     0 : 4c 00 00 00 04 30 00 44 00 00 00 10 30 00 01 00  [L....0.D....0...]
    10 : 00 00 10 31 00 02 00 00 00 10 32 00 03 00 00 00  [...1......2.....]
    20 : 10 33 00 04 00 00 00 10 34 00 05 00 00 00 10 35  [.3......4......5]
    30 : 00 06 00 00 00 10 36 00 07 00 00 00 10 37 00 08  [......6......7..]
    40 : 00 00 00 10 38 00 09 00 00 00 00 00              [....8.......]
Test#5 { "0" : { "0" : 1, "1" : 2, "2" : 3, "3" : 4, "4" : 5, "5" : 6, "6" : 7, "7" : 8, "8" : 9 } }
     0 : 4c 00 00 00 03 30 00 44 00 00 00 10 30 00 01 00  [L....0.D....0...]
    10 : 00 00 10 31 00 02 00 00 00 10 32 00 03 00 00 00  [...1......2.....]
    20 : 10 33 00 04 00 00 00 10 34 00 05 00 00 00 10 35  [.3......4......5]
    30 : 00 06 00 00 00 10 36 00 07 00 00 00 10 37 00 08  [......6......7..]
    40 : 00 00 00 10 38 00 09 00 00 00 00 00              [....8.......]
Test#6 { "0" : [ 1, 2, 3, 4, 5, 6, 7, 8, 9 ] }
     0 : 4c 00 00 00 04 30 00 44 00 00 00 10 30 00 01 00  [L....0.D....0...]
    10 : 00 00 10 31 00 02 00 00 00 10 32 00 03 00 00 00  [...1......2.....]
    20 : 10 33 00 04 00 00 00 10 34 00 05 00 00 00 10 35  [.3......4......5]
    30 : 00 06 00 00 00 10 36 00 07 00 00 00 10 37 00 08  [......6......7..]
    40 : 00 00 00 10 38 00 09 00 00 00 00 00              [....8.......]
Test#7 { "0" : null }
     0 : 08 00 00 00 0a 30 00 00                          [.....0..]
Test#8 { "0" : 123 }
     0 : 0c 00 00 00 10 30 00 7b 00 00 00 00              [.....0.{....]
Test#9 { "0" : 4.230000 }
     0 : 10 00 00 00 01 30 00 ec 51 b8 1e 85 eb 10 40 00  [.....0..Q.....@.]
Test#10 { "0" : true }
     0 : 09 00 00 00 08 30 00 01 00                       [.....0...]
Test#11 { "0" : false }
     0 : 09 00 00 00 08 30 00 00 00                       [.....0...]
Test#12 { "0" : "string" }
     0 : 13 00 00 00 02 30 00 07 00 00 00 73 74 72 69 6e  [.....0.....strin]
    10 : 67 00 00                                         [g..]
Test#13 { "0" : "string", "1" : true }
     0 : 17 00 00 00 02 30 00 07 00 00 00 73 74 72 69 6e  [.....0.....strin]
    10 : 67 00 08 31 00 01 00                             [g..1...]
Test#14 { "0" : "test", "1" : "foo", "2" : "bar" }
     0 : 27 00 00 00 02 30 00 05 00 00 00 74 65 73 74 00  ['....0.....test.]
    10 : 02 31 00 04 00 00 00 66 6f 6f 00 02 32 00 04 00  [.1.....foo..2...]
    20 : 00 00 62 61 72 00 00                             [..bar..]
Test#15 { "test" : "test", "foo" : "foo", "bar" : "bar" }
     0 : 2e 00 00 00 02 74 65 73 74 00 05 00 00 00 74 65  [.....test.....te]
    10 : 73 74 00 02 66 6f 6f 00 04 00 00 00 66 6f 6f 00  [st..foo.....foo.]
    20 : 02 62 61 72 00 04 00 00 00 62 61 72 00 00        [.bar.....bar..]
Test#16 { "foo" : "test", "0" : "foo", "1" : "bar" }
     0 : 29 00 00 00 02 66 6f 6f 00 05 00 00 00 74 65 73  [)....foo.....tes]
    10 : 74 00 02 30 00 04 00 00 00 66 6f 6f 00 02 31 00  [t..0.....foo..1.]
    20 : 04 00 00 00 62 61 72 00 00                       [....bar..]
Test#17 { "int" : 3, "boolean" : true, "array" : [ "foo", "bar" ], "object" : {  }, "string" : "test", "3" : "test" }
     0 : 64 00 00 00 10 69 6e 74 00 03 00 00 00 08 62 6f  [d....int......bo]
    10 : 6f 6c 65 61 6e 00 01 04 61 72 72 61 79 00 1b 00  [olean...array...]
    20 : 00 00 02 30 00 04 00 00 00 66 6f 6f 00 02 31 00  [...0.....foo..1.]
    30 : 04 00 00 00 62 61 72 00 00 03 6f 62 6a 65 63 74  [....bar...object]
    40 : 00 05 00 00 00 00 02 73 74 72 69 6e 67 00 05 00  [.......string...]
    50 : 00 00 74 65 73 74 00 02 33 00 05 00 00 00 74 65  [..test..3.....te]
    60 : 73 74 00 00                                      [st..]
Test#18 { "0" : [ "string", true ] }
     0 : 1f 00 00 00 04 30 00 17 00 00 00 02 30 00 07 00  [.....0......0...]
    10 : 00 00 73 74 72 69 6e 67 00 08 31 00 01 00 00     [..string..1....]
Test#19 { "0" : [ "test", "foo", "bar" ] }
     0 : 2f 00 00 00 04 30 00 27 00 00 00 02 30 00 05 00  [/....0.'....0...]
    10 : 00 00 74 65 73 74 00 02 31 00 04 00 00 00 66 6f  [..test..1.....fo]
    20 : 6f 00 02 32 00 04 00 00 00 62 61 72 00 00 00     [o..2.....bar...]
Test#20 { "0" : { "test" : "test", "foo" : "foo", "bar" : "bar" } }
     0 : 36 00 00 00 03 30 00 2e 00 00 00 02 74 65 73 74  [6....0......test]
    10 : 00 05 00 00 00 74 65 73 74 00 02 66 6f 6f 00 04  [.....test..foo..]
    20 : 00 00 00 66 6f 6f 00 02 62 61 72 00 04 00 00 00  [...foo..bar.....]
    30 : 62 61 72 00 00 00                                [bar...]
Test#21 { "0" : { "foo" : "test", "0" : "foo", "1" : "bar" } }
     0 : 31 00 00 00 03 30 00 29 00 00 00 02 66 6f 6f 00  [1....0.)....foo.]
    10 : 05 00 00 00 74 65 73 74 00 02 30 00 04 00 00 00  [....test..0.....]
    20 : 66 6f 6f 00 02 31 00 04 00 00 00 62 61 72 00 00  [foo..1.....bar..]
    30 : 00                                               [.]
Test#22 { "0" : { "int" : 3, "boolean" : true, "array" : [ "foo", "bar" ], "object" : {  }, "string" : "test", "3" : "test" } }
     0 : 6c 00 00 00 03 30 00 64 00 00 00 10 69 6e 74 00  [l....0.d....int.]
    10 : 03 00 00 00 08 62 6f 6f 6c 65 61 6e 00 01 04 61  [.....boolean...a]
    20 : 72 72 61 79 00 1b 00 00 00 02 30 00 04 00 00 00  [rray......0.....]
    30 : 66 6f 6f 00 02 31 00 04 00 00 00 62 61 72 00 00  [foo..1.....bar..]
    40 : 03 6f 62 6a 65 63 74 00 05 00 00 00 00 02 73 74  [.object.......st]
    50 : 72 69 6e 67 00 05 00 00 00 74 65 73 74 00 02 33  [ring.....test..3]
    60 : 00 05 00 00 00 74 65 73 74 00 00 00              [.....test...]
===DONE===
