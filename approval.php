<?php
session_start();
require('./debug/dbconnect.php');

if (!empty($_POST)) {
  $job_sql = 'UPDATE `jobs` SET `job_flag`=1 WHERE `job_id`=?';
  $job_data = array($_POST['accept']);
  $job_stmt = $dbh->prepare($job_sql);
  $job_stmt->execute($job_data);

}

if(isset($_GET['post_id'])){

$sql = 'SELECT *
       FROM `user_infos`
       JOIN `guild_join`
       ON `user_infos`.`user_id`=`guild_join`.`user_id`
       JOIN `jobs`
       ON `jobs`.`job_id` = `guild_join`.`job_id`
       WHERE `jobs`.`job_flag`=0';
$stmt = $dbh->prepare($sql);
$stmt->execute();




$joiners = array();

while(true){
  $joining = $stmt->fetch(PDO::FETCH_ASSOC);
  if($joining == false){
    break;
  }

$joiners[] = $joining;
}





}

?>
<!DOCTYPE html>
<html lang="jp">
<head>
  <meta charset="UTF-8">
  <title>matching.php</title>
  <!-- BootstrapのCSS読み込み -->
  <link href="./css/bootstrap.css" rel="stylesheet">
  <!-- match.cssの読み込み -->
  <!-- <link rel="stylesheet" href="match.css"> -->
  <!-- index_users_test.cssの読み込み -->
  <link rel="stylesheet" href="./css/matching.css">
  <!-- push通知導入のためのjavascript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.min.js"></script>
</head>
<body style="background-color:#fff;">

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-2">
      </div>
      <!-- <div class="box"> -->
      <div class="col-lg-8" style="background-color:#fff;">
        <div class="content-margin-top">


          <h4>この人たちがあなたの依頼に携わりたいと言っています</h4>

          <table class="table">
            <thead>
              <tr>
                <th>仕事NO.</th>
                <th>仕事内容</th>
                <th>プロフィール画像</th>
                <th>名前</th>
                <th>メールアドレス</th>
                <!-- <th>連絡ボタン</th> -->
                <th>参加承認</th>
                <!-- <th>チェックボックス</th> -->
              </tr>
            </thead>

            <?php foreach($joiners as $strOneJoin):?>
            <?php if($strOneJoin['job_flag'] == 0): ?>

            <tbody>
              <tr>
                <th scope="row"><?php echo $strOneJoin['job_id']?></th>
                  <td><?php echo $strOneJoin['job_description']?></td>
                  <td><?php echo $strOneJoin['profile_picture']?></td>
                  <td><?php echo $strOneJoin['nickname']?></td>
                  <td>hoge@gmail.com</td>
                  <form method="post" action="">
                  <input type="hidden" name="accept" value="<?php echo $strOneJoin['job_id']?>">
                  <td><input type="submit" class="buttonAB" value="承認"></td>
                  </form>

              </tr>
            </tbody>
            <?php endif; ?>
            <?php endforeach;?>

          </table>

          <script type="text/javascript">
          <?php if(!empty($_POST['accept'])): ?>
          Push.Permission.request();
          Push.create('決定！',{
          body: '参加を承認しました！',
          icon: '',
          timeout: 8000, // 通知が消えるタイミング
          vibrate: [100, 100, 100], // モバイル端末でのバイブレーション秒数
          onClick: function() {
          // 通知がクリックされた場合の設定
          console.log(this);
          }
          });
          <?php endif; ?>
          </script>

          <a href="matching.php"><input type="button" class="buttonA" value="一覧へ戻る"></a>

        </div>
      </div>

      <div class="col-lg-2">
      </div>

    </div>
  </div>





  <!-- jQuery読み込み -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- BootstrapのJS読み込み -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>