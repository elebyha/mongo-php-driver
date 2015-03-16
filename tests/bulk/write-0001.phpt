--TEST--
MongoDB\Driver\BulkWrite: #001 Variety Bulk
--SKIPIF--
<?php require "tests/utils/basic-skipif.inc"?>
--FILE--
<?php
require_once "tests/utils/basic.inc";

$manager = new MongoDB\Driver\Manager(MONGODB_URI);

$bulk = new MongoDB\Driver\BulkWrite;
var_dump($bulk);

$bulk->insert(array("my" => "value"));
$bulk->insert(array("my" => "value", "foo" => "bar"));
$bulk->insert(array("my" => "value", "foo" => "bar"));
var_dump($bulk);

$bulk->delete(array("my" => "value", "foo" => "bar"), array("limit" => 1));
var_dump($bulk);

$bulk->update(array("foo" => "bar"), array('$set' => array("foo" => "baz")), array("limit" => 1, "upsert" => 0));

var_dump($bulk);

$retval = $manager->executeBulkWrite(NS, $bulk);

var_dump($bulk);

printf("Inserted: %d\n", getInsertCount($retval));
printf("Deleted: %d\n", getDeletedCount($retval));
printf("Updated: %d\n", getModifiedCount($retval));
printf("Upserted: %d\n", getUpsertedCount($retval));
foreach(getWriteErrors($retval) as $error) {
    printf("WriteErrors: %", $error);
}
?>
===DONE===
<?php exit(0); ?>
--EXPECTF--
object(MongoDB\Driver\BulkWrite)#%d (%d) {
  ["database"]=>
  NULL
  ["collection"]=>
  NULL
  ["ordered"]=>
  bool(true)
  ["executed"]=>
  bool(false)
  ["hint"]=>
  int(0)
  ["write_concern"]=>
  NULL
}
object(MongoDB\Driver\BulkWrite)#%d (%d) {
  ["database"]=>
  NULL
  ["collection"]=>
  NULL
  ["ordered"]=>
  bool(true)
  ["executed"]=>
  bool(false)
  ["hint"]=>
  int(0)
  ["write_concern"]=>
  NULL
}
object(MongoDB\Driver\BulkWrite)#%d (%d) {
  ["database"]=>
  NULL
  ["collection"]=>
  NULL
  ["ordered"]=>
  bool(true)
  ["executed"]=>
  bool(false)
  ["hint"]=>
  int(0)
  ["write_concern"]=>
  NULL
}
object(MongoDB\Driver\BulkWrite)#%d (%d) {
  ["database"]=>
  NULL
  ["collection"]=>
  NULL
  ["ordered"]=>
  bool(true)
  ["executed"]=>
  bool(false)
  ["hint"]=>
  int(0)
  ["write_concern"]=>
  NULL
}
object(MongoDB\Driver\BulkWrite)#%d (%d) {
  ["database"]=>
  string(6) "phongo"
  ["collection"]=>
  string(15) "bulk_write_0001"
  ["ordered"]=>
  bool(true)
  ["executed"]=>
  bool(true)
  ["hint"]=>
  int(0)
  ["write_concern"]=>
  NULL
}
Inserted: 3
Deleted: 1
Updated: 1
Upserted: 0
===DONE===