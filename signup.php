<?php
session_start();
require_once('./class/database_class.php');
require_once('./class/authentication_class.php');
$objDatabase = new Database();
$objAuthentication = new Authentication();

if (!empty($_POST)):
  if ($_POST['username'] == ''):
    $error['username'] = 'blank';
  endif;

  if ($_POST['emailaddress'] == ''):
    $error['emailaddress'] = 'blank';
  endif;

  if ($_POST['password'] == ''):
    $error['password'] = 'blank';
  endif;

  if (empty($error)):
    $usernameduplicatenumber = $objDatabase->mysqlquery('SELECT COUNT(*) AS `duplicatenumber` FROM `test2` WHERE `username`=?', $data = array($_POST['username']));
    $emailaddressduplicatenumber = $objDatabase->mysqlquery('SELECT COUNT(*) AS `duplicatenumber` FROM `test2` WHERE `emailaddress`=?', $data = array($_POST['emailaddress']));
    if ($usernameduplicatenumber[0]['duplicatenumber']>=1 || $emailaddressduplicatenumber[0]['duplicatenumber']>=1):
      // 重複エラー時の処理を今後記述
      if ($usernameduplicatenumber[0]['duplicatenumber']>=1 && $emailaddressduplicatenumber[0]['duplicatenumber']>=1):
        $error['username'] = 'duplicated';
        $error['emailaddress'] = 'duplicated';
      elseif ($usernameduplicatenumber[0]['duplicatenumber']>=1 && $emailaddressduplicatenumber[0]['duplicatenumber']=0):
        $error['username'] = 'duplicated';
      elseif ($usernameduplicatenumber[0]['duplicatenumber']=0 && $emailaddressduplicatenumber[0]['duplicatenumber']>=1):
        $error['emailaddress'] = 'duplicated';
      endif;
    else:
      $extention=strtolower(mb_substr($_FILES['profilepicture']['name'],-3));
      if ($extention == 'jpg' || $extention == 'png' || $extention == 'gif'):
        // アップロード
        // move_uploaded_file = 画像を指定したディレクトリに保存(アップロード)する
        // move_uploaded_file(ファイル名, 保存先のディレクトリの位置)
        // 注意！！！ フォルダのパーミッションを確認し、StaffとEveryoneを「Read&Write」に書き換えましょう。
        // $_FILES['profilepicture']['tmp_name'] 一時的に保存される場所 = XAMPPの中の場合はxamppfiles/tempの中
        $filename=strtolower("{$_POST['username']}.$extention");
        move_uploaded_file($_FILES['profilepicture']['tmp_name'], "./data/picture/{$filename}");
        $objDatabase->mysqlquery('INSERT INTO `test2` SET `username`=?, `emailaddress`=?, `password`=?, `profilepicture`=?', $data = array($_POST['username'], $_POST['emailaddress'], $_POST['password'], $filename));
        $hoge=$objAuthentication->signin($_POST['username'], $_POST['password']);
        $_SESSION['user_parameter'] = $hoge[0];
        $_SESSION['user_parameter']['signintime'] = $hoge[1];
        header('Location: ./index.php');
        exit();
      else:
        // 指定外の拡張子だった場合の処理を今後記述
        $error['image'] = 'type';
      endif;
    endif;
  endif;
endif;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>signup</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="assets/favicon/favicon.png">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="./css/bootstrap.css">

  <!-- CSS -->
  <link rel="stylesheet" href="./css/signup.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css">
</head>
<body>
  <div class="container-fulid">
    <div class="row">
      <div id="progressbar" class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
      <div id="progressbar" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        <hr>
      </div>
      <div id="progressbar" class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
    </div>
  </div>
  <form method="post" action="" enctype="multipart/form-data">
    <div class="container-fulid">
      <div class="row">
        <div id="usernameinputbox" class="col-lg-8 col-lg-offset-4 col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-4 col-xs-8 col-xs-offset-4">
          <label>User Name</label>
          <div>
            <input type="text" name="username" placeholder="&nbsp User Name">
          </div>
        </div>
      </div>
    </div>
    <div class="container-fulid">
      <div class="row">
        <div id="passwordinputbox" class="col-lg-8 col-lg-offset-4 col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-4 col-xs-8 col-xs-offset-4">
          <label>Password</label>
          <div>
            <input type="password" name="password" placeholder="&nbsp Password">
          </div>
        </div>
      </div>
    </div>
    <div class="container-fulid">
      <div class="row">
        <div id="emailaddressinputbox" class="col-lg-8 col-lg-offset-4 col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-4 col-xs-8 col-xs-offset-4">
          <label>Email Address</label>
          <div>
            <input type="email" name="emailaddress" placeholder="&nbsp Email Address">
          </div>
        </div>
      </div>
    </div>
    <div class="container-fulid">
      <div class="row">
        <div id="profilrpictureuploadbutton" class="col-lg-8 col-lg-offset-4 col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-4 col-xs-8 col-xs-offset-4">
          <label>Profile Picture</label>
          <div>
            <input type="file" name="profilepicture">
          </div>
          <!-- ここは拡張子の種類によってエラーメッセージ出す、サイズ指定も今後検討 -->
          <?php if (isset($error['image']) && $error['image'] == 'type'): ?>
            <p class="error">* The file extention masut be .jpg, .png or .gif</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="container-fulid">
      <div class="row">
        <div id="border" class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
        <div id="backbutton" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
          <a href="index.php"><button type="button">Back</button></a>
        </div>
        <div id="sendbutton" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
          <button type="submit">Send</button>
        </div>
        <div id="border" class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
      </div>
    </div>
  </form>
</body>
</html>