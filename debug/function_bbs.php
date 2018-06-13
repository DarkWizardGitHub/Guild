<?php

   require('dbconnect.php');
   // session_start();


// スレッド全件検索
  function topics_list(){
   require('dbconnect.php');
   $sql ='SELECT * FROM `q_and_a`';
   $stmt = $dbh->prepare($sql);
   $stmt->execute();
   $result = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
   $_SESSION['topics_list']= $result;
  }

  function reply_insert(){
    require('dbconnect.php');
    if(!empty($_POST['reply'])){
      $data=array($_POST['reply'],$_GET['id']);
      $sql ='INSERT INTO `reply` SET `contents`=?,`sled_id`=?';
      $stmt = $dbh->prepare($sql);
      $stmt->execute($data);
      header('Location:question_detail.php?id='.$_GET['id']);
      exit();
    }
  }

  function reply_read(){
    require('dbconnect.php');
      $data=array($_GET['id']);
      $sql ='SELECT * FROM `reply` WHERE `sled_id`=?';
      $stmt = $dbh->prepare($sql);
      $stmt->execute($data);
      $result = $stmt->fetchAll();
      $_SESSION['reply_list']=$result;
    }

    function count_reply($intId){
      require('dbconnect.php');
      $sql='SELECT COUNT(*) AS `reply` FROM `reply` WHERE `sled_id`=?';
      $data=array($intId);
      $stmt =$dbh->prepare($sql);
      $stmt->execute($data);
      $reply = $stmt->fetch(PDO::FETCH_ASSOC);
      return $reply['reply'];
    }

//スレッド曖昧検索された時(すべて表示される設定)
  function search_list(){
    require('dbconnect.php');
  if(!empty($_POST['search'])){
   $_POST['search']=str_replace("　"," ",$_POST['search']);
   $_POST['search']=explode(" ",$_POST['search']);
   $strSearch=array();
   for($i=0; $i<count($_POST['search']); $i++){
    $strSearch[]='(`thread_title` LIKE ? OR `thread_content` LIKE ?)';}
    global $strSearchWord;
    $strSearchWord=$_POST['search'];
   $data=array();
   foreach($_POST['search'] as $_POST['search']){
   $data[]="%".$_POST['search']."%";
   $data[]="%".$_POST['search']."%";
   }

   $strSearch=implode(' AND ', $strSearch);
   $strSearch = 'SELECT * FROM `q_and_a` WHERE '.$strSearch;
   $stmt = $dbh->prepare($strSearch);
   $stmt->execute($data);
   $result = $stmt->fetchAll();
   $_SESSION['search_list']=$result;

  }
}
?>