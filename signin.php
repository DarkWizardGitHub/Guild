<?php
session_start();
require_once('./class/authentication_class.php');
$objAuthentication = new Authentication();

if(!empty($_POST)){

  $hoge = $objAuthentication->signin($_POST['username'], $_POST['password']);
  if($hoge == false){
  // 認証失敗
    // エラーメッセージ関数処理記述
  } else {
  // 認証成功
    $_SESSION['user_parameter'] = $hoge[0];
    $_SESSION['user_parameter']['signintime'] = $hoge[1];
    // echo('<pre>');
    // var_dump($_SESSION['user_paramete']['signintime']);
    // echo('</pre>');
    header('Location: ./index.php');
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>signin</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="assets/favicon/favicon.png">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="./css/bootstrap.css">

  <!-- CSS -->
  <link rel="stylesheet" href="./css/signin.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css">
</head>

<body>
  <div class="container-fulid">
    <div class="row">
      <div id="guildrogo" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <img src="assets//img/rogo.jpg">
      </div>
    </div>
  </div>
  <form method="post" action="">
    <div class="container-fulid">
      <div class="row">
        <div id="usernameinputbox" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <input type="text" name="username" placeholder="&nbsp User Name">
        </div>
      </div>
    </div>
    <div class="container-fulid">
      <div class="row">
        <div id="passwordinputbox" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <input type="password" name="password" placeholder="&nbsp Password">
        </div>
      </div>
    </div>
    <div class="container-fulid">
      <div class="row">
        <div id="signinbutton" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <button type="submit">Sign In</button>
        </div>
      </div>
    </div>
  </form>
    <div class="container">
      <div class="row">
        <div id="border" class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
        <div id="border" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
          <hr>
        </div>
        <div id="border" class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
      </div>
    </div>
  <form action="signup.php">
    <div class="container-fulid">
      <div class="row">
        <div id="signupbutton" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <button type="submit">Sign Up</button>
        </div>
      </div>
    </div>
  </form>
</body>
</html>