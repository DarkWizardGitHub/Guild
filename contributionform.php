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
// var_dump($_SESSION);
// echo('</pre>');

if (!empty($_POST['thread_title']) && !empty($_POST['rewardpoint']) && !empty($_POST['thread_content'])):
  $objDatabase->mysqlquery('INSERT INTO `q_and_a` SET `thread_title`=?,`rewardpoint`=?,`thread_content`=?,`user_id`=?,`created`=NOW()',$data = array($_POST['thread_title'],$_POST['rewardpoint'],$_POST['thread_content'],$_SESSION['user_parameter']['user_id']));
  header('Location:./bbs.php');
  exit();
else:
  // 処理
endif;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>contributionform</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="assets/favicon/favicon.png">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="./css/bootstrap.css">

  <!-- CSS -->
  <link rel="stylesheet" href="./css/contributionform.css">
  <link rel="stylesheet" href="./css/header.css">
  <link rel="stylesheet" href="./css/footer.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css">
</head>

<body>
  <?php require('./html/header.html'); ?>
  <div class="container-fulid">
    <div class="row killrightleftmarging">
      <div id="progressbar" class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
      <div id="progressbar" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        <hr>
      </div>
      <div id="progressbar" class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
    </div>
  </div>
  <form method="post" action="" enctype="multipart/form-data">
    <div class="container-fulid">
      <div class="row killrightleftmarging">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div><!-- EMPTY COL -->
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
          <label>Title</label>
          <div class="titleinputbox marging-bottom">
            <input type="text" name="thread_title" placeholder="&nbsp Title" maxlength="15">
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
          <label>Content</label>
          <div class="contentinputbox marging-bottom">
            <textarea name="thread_content" rows="15" placeholder="&nbsp Content"></textarea>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div><!-- EMPTY COL -->
      </div>
    </div>
    <div class="container-fulid">
      <div class="row killrightleftmarging">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div><!-- EMPTY COL -->
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 backbutton">
          <a href="./bbs.php">
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