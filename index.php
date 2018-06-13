<?php
session_start();
require('./php/header.php');
require('./php/footer.php');

require_once('./class/database_class.php');
$objDatabase = new Database();

// 表示件数
$intItemNumber=5;

$arrUserRanking=$objDatabase->mysqlquery('SELECT * FROM `test2` ORDER BY `jobrank` DESC LIMIT 5');
$arrNewlyArrivedMatter=$objDatabase->mysqlquery('SELECT * FROM `test3` ORDER BY `createdtime` ASC LIMIT 5');
$arrRewardRanking=$objDatabase->mysqlquery('SELECT * FROM `test3` ORDER BY `rewardpoint` DESC LIMIT 5');
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>index</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="assets/favicon/favicon.png">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="./css/bootstrap.css">

  <!-- CSS -->
  <link rel="stylesheet" href="./css/index.css">
  <link rel="stylesheet" href="./css/header.css">
  <link rel="stylesheet" href="./css/footer.css">
  <link rel="stylesheet" href="./css/modalform.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css">

</head>

<body>
  <!-- ヘッダー -->
  <?php require('./html/header.html'); ?>
  <!-- ユーザーランキング -->
  <div class="container title">
    <div class="row"><!-- ROW START -->
      <div class="col-lg-11 col-lg-offset-1 col-md-11 col-md-offset-1 col-sm-11 col-sm-offset-1 col-xs-11 col-xs-offset-1 golden-ratio-font__larger2">
        User Ranking
      </div>
    </div><!-- ROW END -->
  </div>
  <div id="userranking" class="container">
    <div class="row"><!-- ROW START -->
      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div><!-- EMPTY COL -->
      <?php for ($i=0; $i < $intItemNumber; $i++): ?>
        <!-- 池さんに相談すること１ -->
<!--         IDは任意のタグに追加できるようになったが、
        1〜5位までの異なるIDのため、それと遂になるjsが５つ必要になる方法しか思い浮かばない
        →ベタ書きを避けてループ処理などで綺麗にまとめたい

        openmodalformbuttonの親か子のタグにuser_id持たせても、jsの方がopenmodalformbuttonのクリックをトリガーとしているため、5つの同idを持つタグが発生し、１番目以外のopenmodalformbuttonが効かなくなる
        →classにするのか？ -->


        <!-- モーダルウィンドウ -->
        <div id="modalcontent<?php echo $arrUserRanking[$i]['user_id'] ?>" class="container modalcontent">
          <div class="row modalcontentinnar">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <a id="closemodalformbutton<?php echo $arrUserRanking[$i]['user_id'] ?>" class="buttonlink">閉じる</a>
              <a href="mypage.php?targetuser_id=<?php echo $arrUserRanking[$i]['user_id'] ?>">詳細</a>
            </div>
          </div>
        </div>


        <div id="openmodalformbutton<?php echo $arrUserRanking[$i]['user_id'] ?>" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 frame">
          <div class="container-fulid">
            <div class="row">
              <!-- ループ処理だと一意のエリアに任意の番号を指定できない -->
              <!-- <a id="openmodalformbutton" href="index.php?user_id=1"> -->
              <div id="profilepicture" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 textalign-center">
                <img src="./data/picture/<?php echo $arrUserRanking[$i]['profilepicture'] ?>">
              </div>
              <!-- </a> -->
            </div>
          </div>
          <div class="container-fulid">
            <div class="row">
              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
              <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 usernamebox killrightleftpadding">
                <?php echo $arrUserRanking[$i]['username'] ?>
              </div>
              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
            </div>
          </div>
          <div class="container-fulid">
            <div class="row">
              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
              <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 jobrankbox killrightleftpadding">
                <div class="container-fulid">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 killrightleftpadding simbol">
                      <i class="fas fa-trophy"></i>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 killrightleftpadding">
                      <?php echo $arrUserRanking[$i]['jobrank'] ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
            </div>
          </div>
          <div class="container-fulid">
            <div class="row">
              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
              <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 influencebox killrightleftpadding">
                <div class="container-fulid">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 killrightleftpadding simbol">
                      <i class="fas fa-hand-holding-heart simbol"></i>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 killrightleftpadding">
                      <?php echo $arrUserRanking[$i]['influence'] ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
            </div>
          </div>
          <div class="container-fulid">
            <div class="row">
              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
              <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 renownbox killrightleftpadding">
                <div class="container-fulid">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 killrightleftpadding simbol">
                      <i class="fas fa-diagnoses simbol"></i>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 killrightleftpadding">
                      <?php echo $arrUserRanking[$i]['renown'] ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
            </div>
          </div>
          <div class="container-fulid">
            <div class="row">
              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
              <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 achievementbox killrightleftpadding">
                <div class="container-fulid">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 killrightleftpadding simbol">
                      <i class="fas fa-cubes simbol"></i>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 killrightleftpadding">
                      <?php echo $arrUserRanking[$i]['achievement'] ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
            </div>
          </div>
        </div>
      <?php endfor; ?>
      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div><!-- EMPTY COL -->
    </div><!-- ROW END -->
  </div>
  <!-- 新着案件 -->
  <div class="container title">
    <div class="row"><!-- ROW START -->
      <div class="col-lg-11 col-lg-offset-1 col-md-11 col-md-offset-1 col-sm-11 col-sm-offset-1 col-xs-11 col-xs-offset-1 golden-ratio-font__larger2">
        Newly Arrived Matter
      </div>
    </div>
  </div>
  <div id="newlyarrivedmatter" class="container">
    <div class="row"><!-- ROW START -->
      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div><!-- EMPTY COL -->
        <?php for ($i=0; $i < $intItemNumber; $i++): ?>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 frame">
            <div lass="container-fulid">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 thumbnail_picture textalign-center">
                  <img src="./debug/sampleimage/<?php echo $arrNewlyArrivedMatter[$i]['thumbnail'] ?>" alt="">
                </div>
              </div>
            </div>
            <div class="container-fulid">
              <div class="row">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 titlebox killrightleftpadding">
                  <?php if (mb_strlen($arrNewlyArrivedMatter[$i]['title'])<=25): ?>
                    <?php echo mb_substr($arrNewlyArrivedMatter[$i]['title'],0,25); ?>
                  <?php else: ?>
                    <?php echo mb_substr($arrNewlyArrivedMatter[$i]['title'],0,25)."..."; ?>
                  <?php endif; ?>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
              </div>
            </div>
            <div class="container-fulid">
              <div class="row">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 requiredskillbox killrightleftpadding">
                  <?php echo $arrNewlyArrivedMatter[$i]['requiredjob'] ?>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
              </div>
            </div>
            <div class="container-fulid">
              <div class="row">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 contentbox killrightleftpadding">
                  <?php if (mb_strlen($arrNewlyArrivedMatter[$i]['content'])<=50): ?>
                    <?php echo mb_substr($arrNewlyArrivedMatter[$i]['content'],0,50); ?>
                  <?php else: ?>
                    <?php echo mb_substr($arrNewlyArrivedMatter[$i]['content'],0,50)."..."; ?>
                  <?php endif; ?>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
              </div>
            </div>
            <div class="container-fulid">
              <div class="row">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 pointbox killrightleftpadding">
                  <?php echo $arrNewlyArrivedMatter[$i]['rewardpoint'] ?>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
              </div>
            </div>
          </div>
        <?php endfor; ?>
      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div><!-- EMPTY COL -->
    </div><!-- ROW END -->
  </div>
  <!-- 報酬ランキング -->
  <div class="container title">
    <div class="row">
      <div class="col-lg-11 col-lg-offset-1 col-md-11 col-md-offset-1 col-sm-11 col-sm-offset-1 col-xs-11 col-xs-offset-1 golden-ratio-font__larger2">
        Reward Ranking
      </div>
    </div>
  </div>
  <div id="rewardranking" class="container">
    <div class="row"><!-- ROW START -->
      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div><!-- EMPTY COL -->
        <?php for ($i=0; $i < $intItemNumber; $i++): ?>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 frame">
            <div lass="container-fulid">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 thumbnail_picture textalign-center">
                  <img src="./debug/sampleimage/<?php echo $arrRewardRanking[$i]['thumbnail'] ?>" alt="">
                </div>
              </div>
            </div>
            <div class="container-fulid">
              <div class="row">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 titlebox killrightleftpadding">
                  <?php if (mb_strlen($arrRewardRanking[$i]['title'])<=25): ?>
                    <?php echo mb_substr($arrRewardRanking[$i]['title'],0,25); ?>
                  <?php else: ?>
                    <?php echo mb_substr($arrRewardRanking[$i]['title'],0,25)."..."; ?>
                  <?php endif; ?>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
              </div>
            </div>
            <div class="container-fulid">
              <div class="row">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 requiredskillbox killrightleftpadding">
                  <?php echo $arrRewardRanking[$i]['requiredjob'] ?>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
              </div>
            </div>
            <div class="container-fulid">
              <div class="row">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 contentbox killrightleftpadding">
                  <?php if (mb_strlen($arrRewardRanking[$i]['content'])<=50): ?>
                    <?php echo mb_substr($arrRewardRanking[$i]['content'],0,50); ?>
                  <?php else: ?>
                    <?php echo mb_substr($arrRewardRanking[$i]['content'],0,50)."..."; ?>
                  <?php endif; ?>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
              </div>
            </div>
            <div class="container-fulid">
              <div class="row">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 pointbox killrightleftpadding">
                  <?php echo $arrRewardRanking[$i]['rewardpoint'] ?>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 killrightleftpadding"></div><!-- EMPTY COL -->
              </div>
            </div>
          </div>
        <?php endfor; ?>
      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div><!-- EMPTY COL -->
    </div><!-- ROW END -->
  </div>
  <div class="container title">
    <div class="row"><!-- ROW START -->
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 matter"></div><!-- EMPTY COL -->
    </div><!-- ROW END -->
  </div>

  <!-- モーダルウィンドウ -->
  <div id="modalcontent" class="container">
    <div id="modalcontentinnar" class="row"><!-- ROW START -->
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <a id="closemodalformbutton" class="buttonlink">閉じる</a>
      </div>
    </div><!-- ROW END -->
  </div>

  <?php require('./html/footer.html') ?>
  <!-- jQuery -->
  <script src="./js/jquery-3.3.1.js"></script>
  <script src="./js/header.js"></script>
  <script src="./js/footer.js"></script>
  <script src="./js/modalform.js"></script>
</body>

</html>