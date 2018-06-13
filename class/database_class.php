<?php

class Database
{
 private $data_source_name;
 private $host;
 private $user;
 private $password;
 private $databasehandler;

 public function __construct()
 {
// 外部textからDatabase接続に必要な情報を読み込む
  $filepath = './parameter/database parameter.txt';
  $readvalue = file($filepath);

  $this->data_source_name = trim($readvalue[0]);
  $this->host = trim($readvalue[1]);
  $this->user = trim($readvalue[2]);
  $this->password = trim($readvalue[3]);

  $this->databasehandler = new PDO("{$this->data_source_name};{$this->host}", $this->user, $this->password);
  $this->databasehandler->query('SET NAMES utf8');
 }

// $data引数がなければデフォルト値として=array()で空の配列とする
 public function mysqlquery($sql_statement, $data = array())
 {
  $statement = $this->databasehandler->prepare($sql_statement);

// $dataの有無によってタプル処理するか判断
  if (!empty($data)) {
   $statement->execute($data);
  } else {
   $statement->execute();
  }

// sql文の先頭６文字がSELECTだった場合のみ返り値を返す
  if (strtoupper(mb_substr($sql_statement, 0, 6)) == "SELECT") {
   $returnvalues = array();

// fetchAllで書き換え可
   while (true) {
    $buffer = $statement->fetch(PDO::FETCH_ASSOC);
    if ($buffer == false) {
     break;
    }

    $returnvalues[] = $buffer;
   }

   return $returnvalues;
  } else {
   return;//SELECT文以外は返り値はnull
  }
 }

// インスタンス後のテスト用関数
 function test()
 {
  echo "Hello";
 }
}

?>