<?php
session_start();
require('./debug/dbconnect.php');

require('./php/header.php');
require('./php/footer.php');
require_once('./class/database_class.php');
$objDatabase = new Database();

$login_sql = 'SELECT * FROM `user_infos` WHERE `user_id`=?';
$login_data = array($_SESSION['user_parameter']['user_id']);
$login_stmt = $dbh->prepare($login_sql);
$login_stmt->execute($login_data);

$login_member = $login_stmt->fetch(PDO::FETCH_ASSOC);

if(!empty($_POST)){
  switch ($_POST["formtype"]) {
    case 'post':

    if ($_POST['job_title'] == '') {
      $strError['job_title'] = 'blank';
    }

    if ($_POST['job_description'] == '') {
      $strError['job_description'] = 'blank';
    }

    if (!isset($error)) {

      $sql = 'INSERT INTO `jobs` SET `poster_id`=?, `job_title`=?, `job_description`=?';
      $data = array($_SESSION['user_parameter']['user_id'],$_POST['job_title'],$_POST['job_description']);
      $stmt = $dbh->prepare($sql);
      $stmt->execute($data);
    }

    break;

    case 'join':

    break;
    default:
    break;
  }
}


//仕事内容表示
$job_sql  = 'SELECT * FROM `user_infos` LEFT JOIN `jobs` ON `user_infos`.`user_id` = `jobs`.`poster_id` 
             ORDER BY `job_created` DESC';
$job_stmt = $dbh->prepare($job_sql);
$job_stmt->execute();

$arrJobList = array();

while(true){
  $job = $job_stmt->fetch(PDO::FETCH_ASSOC);
  if($job == false){
    break;
  }

  $interest_sql  = 'SELECT COUNT(*) AS `interest_count` FROM `guild_interest` WHERE `job_id`=?';
  $interest_data = array($job['job_id']);
  $interest_stmt = $dbh->prepare($interest_sql);
  $interest_stmt->execute($interest_data);

  $intInterestCount = $interest_stmt->fetch(PDO::FETCH_ASSOC);

    // 一行分のデータに新しいキーを用意し、$interest_countを代入
  $job['interest_count'] = $intInterestCount['interest_count'];

    // ログインしている人がinterestしているかどうかのデータを取得
  $login_interest_sql  = 'SELECT COUNT(*) as `login_count` FROM `guild_interest` WHERE `user_id`=? AND `job_id`=?';
  $login_interest_data = array($_SESSION['user_parameter']['user_id'], $job['job_id']);
  $login_interest_stmt = $dbh->prepare($login_interest_sql);
  $login_interest_stmt->execute($login_interest_data);

    // フェッチで取得
  $intLoginInterestNumber = $login_interest_stmt->fetch(PDO::FETCH_ASSOC);

    // ログインしているユーザーがいいねしているかどうかの判定
  $job['login_interest_flag'] = $intLoginInterestNumber['login_count'];

  $join_sql = 'SELECT COUNT(*) AS `join_count` FROM `guild_join` WHERE `job_id`=?';
  $join_data = array($job['job_id']);
  $join_stmt = $dbh->prepare($join_sql);
  $join_stmt->execute($join_data);

  $intJoinCount = $join_stmt->fetch(PDO::FETCH_ASSOC);

    // 一行分のデータに新しいキーを用意し、$join_countを代入
  $job['join_count'] = $intJoinCount['join_count'];

    // ログインしている人がjoinしているかどうかのデータを取得
  $login_join_sql  = 'SELECT COUNT(*) as `login_count` FROM `guild_join` WHERE `user_id`=? AND `job_id`=?';
  $login_join_data = array($_SESSION['user_parameter']['user_id'], $job['job_id']);
  $login_join_stmt = $dbh->prepare($login_join_sql);
  $login_join_stmt->execute($login_join_data);

    // フェッチで取得
  $intLoginJoinNumber = $login_join_stmt->fetch(PDO::FETCH_ASSOC);

    // ログインしているユーザーがいいねしているかどうかの判定
  $job['login_join_flag'] = $intLoginJoinNumber['login_count'];
  $job_a['user_id'] = $login_member['user_id'];

  $arrJobList[]=$job;

}


if(isset($_POST['hidden'])){
  header('Location:matching.php');
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap Sample</title>
  <!-- BootstrapのCSS読み込み -->
  <link href="./css/bootstrap.css" rel="stylesheet">
  <!-- index_users.phpのcssの読み込み -->
  <link rel="stylesheet" href="./css/matching.css">
  <link rel="stylesheet" href="./css/header.css">
  <link rel="stylesheet" href="./css/footer.css">

  <!-- font-awesomeの読み込み -->
  <link href="bootstrap/font-awesome/css/font-awesome.css" rel="stylesheet">
</head>
<body>
  <?php require('./html/header.html') ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12" id="postWork">
        <!-- 仕事内容入力 -->
        <div>
          <form method="post" action="" class="form-horizontal" role="form">

            <div class="form-group">
              <h3 style="font-family: 'arial narrow'; color:#323232;">案件掲載</h3>
              <hr style="width:300px; background-color:#323232;">

              <div class="col-lg-3">
              </div>

              <div class="col-lg-6" style=" padding-bottom:font-size: 15px;">
                <p style="font-family: 'arial narrow'; color:white;">仕事</p>
                <input name="job_title" class="ipt width" placeholder="job title"></input> <br><br>

                <?php if(!empty($strError) && $strError['job_title'] = 'blank'):?>
                  <p class="error">* 案件を入力してください</p>
                <?php endif;?>

                <p style="font-family: 'arial narrow'; color:white;">仕事内容</p>
                <textarea name="job_description" cols="50" rows="5" class="form-control ipt" placeholder="please post your projects"></textarea><br>

                <?php if(isset($strError) && $strError['job_description'] = 'blank'):?>
                  <p class="error">* 案件内容を入力してください</p>
                <?php endif;?>

                <input type="hidden" name="formtype" value="post">
                <input type="submit" class="buttonA" value="SUBMIT" name="submit">

              </div>

              <div class="col-lg-3">
                <table class="table">
                  <thead>

                    <tr>
                      <th>menu</th>
                    </tr>

                  </thead>
                  <tbody>

                   <!-- 行全体を灰色に -->
                    <tr  class="active">
                      <th>
                        <a href="approval.php?post_id=<?php echo $job_a['user_id']?>">マッチングの承認待ち
                        </a>
                      </th>
                    </tr>

                    <tr  class="active">
                      <th>
                        <a href="" style="color:#323232">過去の投稿案件一覧</a>
                      </th>
                    </tr>

                    <tr  class="active">
                      <th>
                        <a href="" style="color:#323232">こなした案件一覧</a>
                      </th>
                    </tr>

                  </tbody>
                </table>

              </div>
              <!-- <div class="col-sm-3">の終わり -->
            </div>
            <!-- <div class="form-group">の終わり -->
          </form>
        </div>
      </div>
      <!-- <div class="col-md-12 " id="postWork">の終わり -->
    </div>
    <!-- <div class="row">の終わり -->
  </div>
  <!--  <div class="container-fluid">の終わり -->

  <!-- 案件掲載場所  -->
  <div class="container-fluid">
    <div class="row" style="background-color:#323232;">
      <?php foreach($arrJobList as $strOneJob):?>
        <?php if(strval($strOneJob["job_flag"]) == 0): ?>
          <div class="col-lg-3">
            <div class="box box-margin" style="color:#323232;">
              <div>
              <label style="background-color:#323232;
                color:#fff ;padding:5px 10px; border-radius:4px">仕事&nbsp;NO.<?php echo $strOneJob['job_id']?>
              </label><br>
              </div>
              <div>
              依頼人:<?php echo $strOneJob['nickname']?>さん
              <label color:white;>仕事
              </label>
              </div>
              <div>
              <?php echo $strOneJob['job_title']?>
              <label color:white;>仕事内容
              </label>
              </div>
              <div>
              <a href="job_content.php?job_id=<?php echo $strOneJob['job_id']?>">
              <input type="submit" class="buttonAB" value="仕事内容を見る" name="interest">
              </a>
              </div>

              <!-- 自分が「興味あり」を押していない時 且つ 誰も「興味あり」を押していない -->
              <!-- 自分が「興味あり」を押していない時 且つ 誰かが「興味あり」を押していない -->
              <?php if ($_SESSION['user_parameter']['user_id'] == $strOneJob['user_id']) { ?>
              <div>
              <a href="look_interest.php?interest_job_id=<?php echo $strOneJob['job_id']?>">
              <input type="submit" class="buttonAB" value="興味ある人をチラ見">
              </a>
              </div>

              <?php }else{?>

              <?php if($strOneJob['login_interest_flag'] == 0){ ?>
              <div>
              <a href="interest_test.php?interest_job_id=<?php echo $strOneJob['job_id']?>">
                <input type="submit" class="buttonAB" value="興味あり">
              </a>
              </div>
              <? } else {?>
              <div>
              <a>
                <input class="buttonABC" value="興味あり">
              </a>
              </div>
              <?php }?>

              <?php if($strOneJob['login_join_flag'] == 0){?>

              <a href="join.php?join_id=<?php echo $strOneJob['job_id']?>"><input type="submit" class="buttonAB" value="参加希望"></a>
              <? } else {?>
              <input class="buttonABC" value="結果を待とうね">
              <?php }?>

              <?php }?>

            </div>
          </div>
        <?php endif; ?>
      <?php endforeach;?>
    </div>
  </div>

  <?php require('./html/footer.html'); ?>
  <!-- jQuery読み込み -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- BootstrapのJS読み込み -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>