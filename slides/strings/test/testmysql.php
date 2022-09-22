<?php

header("Content-type: text/plain; charset=utf-8");

$db = new PDO(
  'mysql:host=localhost;dbname=strangestrings;charset=utf8',
  'root', 'kens3ntme');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec("delete from words where 1=1");

$db->exec("insert into words values ('rope'), ('résumé'), ('resume')");
//$db->exec("insert into words values ('rope'), ('resume'), ('résumé')");

$stmt = $db->query("select word from words");
$rows = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
echo implode($rows, ",") . PHP_EOL;

$stmt = $db->query("select word from words order by word");
$rows = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
echo implode($rows, ",") . PHP_EOL;

$stmt = $db->query("select * from words where word = 'Resume'");
$rows = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
echo implode($rows, ",") . PHP_EOL;

$stmt = $db->query("select * from words where word = 'resume' collate utf8_bin");
$rows = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
echo implode($rows, ",") . PHP_EOL;

$stmt = $db->query("select * from words order by convert(word using latin1) collate latin1_general_ci");
$rows = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
echo implode($rows, ",") . PHP_EOL;
