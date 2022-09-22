<?php

//header("Content-type: text/plain; charset=utf-8");

$db = new PDO(
  'pgsql:host=127.0.0.1;dbname=mydb', 'postgres', 'postgres');

$db->exec("delete from words where 1=1");

$db->exec("insert into words values ('rope'), ('résumé'), ('resume')");
//$db->exec("insert into words values ('rope'), ('resume'), ('résumé')");

$stmt = $db->query("select word from words");
$rows = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
echo implode($rows, ",") . PHP_EOL;

$stmt = $db->query("select word from words order by word");
$rows = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
echo implode($rows, ",") . PHP_EOL;

$stmt = $db->query("select * from words where word = 'resume'");
$rows = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
echo implode($rows, ",") . PHP_EOL;
