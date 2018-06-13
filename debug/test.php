<?php
require('../class/database_class.php');
$obj = new Database();

// 使用例は下記
// 第一引数にsql文、タプル処理が必要な場合は第二引数に配列を指定

$hoge = $obj->mysqlquery('SELECT * FROM `one_piece` WHERE `id`=? AND `gender`=?', $data = array("4", "male"));

// $hoge = $obj->mysqlquery('INSERT INTO `one_piece` SET `nickname`=?, `gender`=?, `words`=?', $data = array("dark", "female", "ok"));

// 変数hogeにmysqlqueryの結果を格納
// ここまでくれば後は煮るなり焼くなりお好きにどうぞ

echo '<pre>';
var_dump($hoge);
echo '</pre>';



?>