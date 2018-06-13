<?php
session_start();
require('./php/header.php');
require('./php/footer.php');
require_once('./class/database_class.php');
require_once('./class/authentication_class.php');
$objDatabase = new Database();
$obj2 = new Authentication();

// echo('<pre>');
// var_dump($_POST);
// echo('</pre>');
// echo('<pre>');
// var_dump($_SESSION['user_parameter']['user_id']);
// echo('</pre>');

if (!empty($_POST['title']) && !empty($_POST['rewardpoint']) && !empty($_POST['requiredjob']) && !empty($_POST['content'])):
  $objDatabase->mysqlquery('INSERT INTO `test3` SET `title`=?,`rewardpoint`=?,`requiredjob`=?,`content`=?,`user_id`=?,`createdtime`=NOW()',$data = array($_POST['title'],$_POST['rewardpoint'],$_POST['requiredjob'],$_POST['content'],$_SESSION['user_parameter']['user_id']));
  header('Location:./matching.php');
  exit();
else:
  // 処理
endif;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>orderform</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="assets/favicon/favicon.png">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="./css/bootstrap.css">

  <!-- CSS -->
  <link rel="stylesheet" href="./css/order.css">
  <link rel="stylesheet" href="./css/header.css">
  <link rel="stylesheet" href="./css/footer.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css">
</head>
<body>
  <?php require('./html/header.html'); ?>
  <div class="container-fulid">
    <div class="row killrightleftmarging">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        <hr>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
    </div>
  </div>
  <form method="post" action="" enctype="multipart/form-data">
    <div class="container-fulid">
      <div class="row killrightleftmarging">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div><!-- EMPTY COL -->
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
          <label>Title</label>
          <div class="titleinputbox marging-bottom">
            <input type="text" name="title" placeholder="&nbsp Title" maxlength="15">
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div><!-- EMPTY COL -->
      </div>
    </div>
    <div class="container-fulid">
      <div class="row killrightleftmarging">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div><!-- EMPTY COL -->
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
          <label>Reward Point</label>
          <div class="rewardpointinputbox marging-bottom">
            <input type="text" name="rewardpoint" placeholder="&nbsp Reward Point" maxlength="4">
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div><!-- EMPTY COL -->
      </div>
    </div>
    <div class="container-fulid">
      <div class="row killrightleftmarging">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div><!-- EMPTY COL -->
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
          <label>Required Job</label>
          <div class="requiredjobinputbox marging-bottom">
            <!-- <input type="text" name="requiredjob" placeholder="&nbsp Required Job"> -->
            <select name="requiredjob">
              <option value="programer">Programer</option>
              <option value="designer">Designer</option>
              <option value="writer">Writer</option>
            </select>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div><!-- EMPTY COL -->
      </div>
    </div>
    <div class="container-fulid">
      <div class="row killrightleftmarging">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div><!-- EMPTY COL -->
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
          <label>Content</label>
          <div class="contentinputbox marging-bottom">
            <textarea name="content" rows="15" placeholder="&nbsp Content"></textarea>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div><!-- EMPTY COL -->
      </div>
    </div>
    <div class="container-fulid">
      <div class="row killrightleftmarging">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div><!-- EMPTY COL -->
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 backbutton">
          <a href="./matching.php">
            <button type="button">
              Back
            </button>
          </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 sendbutton">
          <button type="submit">
            Send
          </button>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div><!-- EMPTY COL -->
      </div>
    </div>
  </form>
  <?php require('./html/footer.html') ?>
  <!-- Jquery -->
  <script src="./js/jquery-3.3.1.js"></script>
  <?php require('./js/header.js') ?>
  <?php require('./js/footer.js') ?>
</body>
</html>