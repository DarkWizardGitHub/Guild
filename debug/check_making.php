<?php

require('./function_bbs.php');


//footer 表示 on off 設定

 $_SESSION['strFooter']='on';
 if(!empty($_GET['footer'])){

  if($_GET['footer'] == 'off'){
    $_SESSION['strFooter']='off';
  }elseif($_GET['footer'] == 'on'){
    $_SESSION['strFooter'] = 'on';
  }
 }
if(empty($_SESSION['q'])){
  header('Location:making_question.php');
  exit();
}


question_insert();

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="./question_detali.css">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
</head>
<body>
  <div class="container">
   <div class="row footer-space">
    <div class="top">
      <h1>Guild 質問スレッド確認ページ</h1>
    </div>
    <div class="space-m"></div>
     <h3>以下の内容で質問を投稿しますか？</h3>
     <div class="space-s"></div>
     <h3><?php echo $_SESSION['q']['title']; ?></h3>
     <div class="space-s"></div>
     <h3><?php echo nl2br($_SESSION['q']['contents']); ?></h3>
     <form action="" method="POST" accept-charset="utf-8">
      <input type="submit" name="insert" value="この内容で書き込む">
     </form>






     </div>
  </div>

<!-- footer -->
  <?php if($_SESSION['strFooter']=='on'){ ?>
    <div id="footer">
       <a class="close-icon footer-icon" href="?footer=off&id ?>"><i class=" fas fa-caret-down fa-3x"></i></a>
      <div class="container">
        <div class="row">
                  <div class="col-xs-3 col-md-1 col-md-offset-2">
                  <a href="#"><i class="footer-icon bottom fas fa-user-circle fa-3x"></i></a>
                  </div>
                  <div class="col-xs-3 col-md-1">
                  <a href="#"><i class="footer-icon bottom fab fa-google fa-3x"></i></a>
                  </div>
                  <div class="col-xs-3 col-md-1">
                  <a href="#"><i class="footer-icon bottom fas fa-home fa-3x"></i></a>
                  </div>
                  <div class="col-xs-3 col-md-1">
                  <a href="#"><i class="footer-icon bottom fas fa-envelope fa-3x"></i></a>
                  </div>

                  <div class="col-xs-3 col-md-1">
                  <a href="#"><i class="footer-icon bottom fas fa-info fa-3x" style="margin-left:35px;"></i></a>
                  </div>
                  <div class="col-xs-3 col-md-1">
                  <a href="#"><i class="footer-icon bottom fas fa-cogs fa-3x"></i></a>
                  </div>
                  <div class="col-xs-3 col-md-1">
                  <a href="making_question.php"><i class="footer-icon bottom fas fa-font fa-3x"></i></a>
                  </div>

<!--                   ログアウト設定１段階確認画面,,if文の中にログアウトの処理をかけばOK
 -->                  <div class="col-xs-3 col-md-1">
                  <a><i class="footer-icon bottom fas fa-sign-out-alt fa-3x"  onClick=disp()></i></a>
                  </div>
                   <script type="text/javascript">
                  function disp() {
                    var res=window.confirm("本当にログアウトしますか？");
                    if(res == true){
                      location.href = "../../mypage/assets/mypage2.php";
                     }else{
                      window.alert('キャンセルしました');
                     }
                  }

                  </script>
        </div>
      </div>
    </div>
     <?php }else{ ?>
       <a class="open-icon footer-icon" href="?footer=on"><i class="fas fa-external-link-alt fa-2x"></i></a>
      <?php } ?>

</body>
</html>