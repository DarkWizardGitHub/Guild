<?php

require('./function_bbs.php');


if(empty($_GET['id'])){
	header('Location:');
    exit();
}else{
	$sql ='SELECT * FROM `q_and_a` WHERE `thread_id`=?';
	$data=array($_GET['id']);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $sled=$stmt->fetch(PDO::FETCH_ASSOC);
}

reply_insert();
reply_read();


//footer 表示 on off 設定

 $_SESSION['strFooter']='on';
 if(!empty($_GET['footer'])){

  if($_GET['footer'] == 'off'){
    $_SESSION['strFooter']='off';
  }elseif($_GET['footer'] == 'on'){
    $_SESSION['strFooter'] = 'on';
  }
 }


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
	 		  <h1>Guild chat</h1>
	 	  </div>
	 	  <div class="space-m"></div>

	 	  <div id="contents">

        <h1><?php echo $sled['thread_title']; ?></h1>
        <div class='space-s'></div>
        <h3><?php echo $sled['thread_content']; ?></h3>
        <div class="space-m"></div>

        <?php if (!empty($_POST) && empty($_POST['answer'])){ ?>
          <h1 class="error">何か入力してください。</h1>
        <?php } ?>

        <?php if (!empty($_POST) && !empty($_POST['answer'])){ ?>

          <h1>この内容で書き込みしますか？</h1>
          <h2><?php echo $_POST['answer']; ?></h2>

          <form action="" method="POST" accept-charset="utf-8">
          	<button type="submit" value="<?php echo $_POST['answer']; ?>" name="reply">書き込む</button>
          </form>

          <form action="../bbs.php" method="get">
            <div class="space-s"></div>
            <button type="">スレッド一覧に戻る</button>
          </form>

        <?php	}else{ ?>

          <?php foreach($_SESSION['reply_list'] as $contents){
          echo '<h5>'.$contents['contents']."&nbsp;".$contents['created'].'</h5>'.'<br>';

          } ?>

          <h1>書き込みをする </h1>

          <form action=""  method="POST" accept-charset="utf-8">
           	<textarea name="answer" class="answer_contents"></textarea>
           	<button type="submit">確認画面へ</button>
          </form>

          <form action="../bbs.php" method="POST" accept-charset="utf-8">
           	<button type="submit">スレッド一覧に戻る</button>
          </form>

        <?php } ?>

      </div>



     </div>
	</div>
</body>
</html>