<?php
session_start();
require('./php/header.php');
require('./php/footer.php');

require_once('./class/database_class.php');
$objDatabase = new Database();
$displaytype=0;

// ポートフォリオ取得
$arrMyPortfolios = $objDatabase->mysqlquery('SELECT `test6`.* FROM `test6` WHERE `user_id`=?', $data=array($_SESSION['user_parameter']['user_id']));

// ポートフォリオ表示形式
if(!empty($_GET)):
  $displaytype=$_GET['displaytype'];
endif;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>mypage</title>
     <!-- Favicon -->
  <link rel="shortcut icon" href="assets/favicon/favicon.png">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="./css/bootstrap.css">

  <!-- CSS -->
  <link rel="stylesheet" href="./css/mypage.css">
  <link rel="stylesheet" href="./css/header.css">
  <link rel="stylesheet" href="./css/footer.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css">

</head>
<body>
  <?php require('./html/header.html'); ?>
  <div class="container-fulid">
    <div class="row killallmarging">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div><!-- EMPTY COL -->
    </div>
  </div>
  <div class="container-fulid">
    <div class="row killallmarging userbar">
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div><!-- EMPTY COL -->
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 profilepicture">
        <img src="./data/picture/<?php echo $_SESSION['user_parameter']['profilepicture'] ?>">
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <div class="container-fulid">
          <div class="row">
            <div id="point" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
              <p><?php echo $_SESSION['user_parameter']['point'] ?></p>
              <a href="">
                <i class="fas fa-piggy-bank fa-lg fa-fw"></i>
              </a>
            </div>
            <div id="jobrank" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
              <p><?php echo $_SESSION['user_parameter']['jobrank'] ?></p>
              <a href="">
                <i class="fas fa-trophy fa-lg fa-fw"></i>
              </a>
            </div>
            <div id="influence" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
              <p><?php echo $_SESSION['user_parameter']['influence'] ?></p>
              <a href="">
                <i class="fas fa-hand-holding-heart fa-lg fa-fw"></i>
              </a>
            </div>
            <div id="renown" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
              <p><?php echo $_SESSION['user_parameter']['renown'] ?></p>
              <a href="">
                <i class="fas fa-diagnoses fa-lg fa-fw"></i>
              </a>
            </div>
            <div id="achievement" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
              <p><?php echo $_SESSION['user_parameter']['achievement'] ?></p>
              <a href="">
                <i class="fas fas fa-cubes fa-lg fa-fw"></i>
              </a>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
            <div id="settings" class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
              <a href="">
                <i class="fas fa-cog fa-lg fa-fw"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div><!-- EMPTY COL -->
    </div>
  </div>
  <div id="body2" class="container-fulid">
<!--     <div class="row killallmarging">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      </div>
    </div> -->
  </div>
  <div id="body3" class="container-fulid">
    <div class="row killallmarging">
      <div class="col-lg-1 col-lg-offset-2 col-md-1 col-md-offset-2 col-sm-1 col-sm-offset-2 col-xs-1 col-xs-offset-2 killallpadding">
        <div class="container-fulid">
          <div class="row killallmarging">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 jobrank">
              <div class="row">
                <p>3</p>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 jobclass">
              <div class="row">
                <p>エンジニア</p>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 jobmedal">
              <div class="row">
                <p>★★★</p>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 jobrank">
              <div class="row">
                <p>2</p>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 jobclass">
              <div class="row">
                <p>言語</p>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 jobmedal">
              <div class="row">
                <p>★</p>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 jobrank">
              <div class="row">
                <p>7</p>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 jobclass">
              <div class="row">
                <p>DJ</p>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 jobmedal">
              <div class="row">
                <p>★★</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
        <div class="container-fulid">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 subjobclass">
              工程管理者
            </div>
            <!-- <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 subjobclass"></div> -->
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 subjobclass">
              プログラマー(VBA/.NET)
            </div>
            <!-- <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 subjobclass"></div> -->
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 subjobclass">
              IT管理者
            </div>
            <!-- <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 subjobclass"></div> -->
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 subjobclass">
              英語
            </div>
            <!-- <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 subjobclass"></div> -->
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 subjobclass">
              タイ語
            </div>
            <!-- <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 subjobclass"></div> -->
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 subjobclass">
              --
            </div>
            <!-- <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 subjobclass"></div> -->
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 subjobclass">
              EDM
            </div>
            <!-- <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 subjobclass"></div> -->
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 subjobclass">
              TRANCE
            </div>
            <!-- <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 subjobclass"></div> -->
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 subjobclass">
              HOUSE
            </div>
            <!-- <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 subjobclass"></div> -->
          </div>
        </div>
      </div>
      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
        <div class="container-fulid">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 profilecomment">
              <?php echo $_SESSION['user_parameter']['profilecomment'];?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
    </div>
  </div>
  <div id="body4" class="container-fulid">
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 portfoiloicon">
        <a href="mypage.php?displaytype=0#body4">
          <i class="fas fa-th fa-lg fa-fw"></i>
        </a>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 portfoiloicon">
        <a href="mypage.php?displaytype=1#body4">
          <i class="fas fa-list fa-lg fa-fw"></i>
        </a>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 portfoiloicon">
        <a href="mypage.php?displaytype=2#body4">
          <i class="fas fa-square fa-lg fa-fw"></i>
        </a>
      </div>
    </div>
  </div>
  <div class="container">
    <div id="test" class="row">
      <?php foreach($arrMyPortfolios as $strBuffer): ?>
        <?php if ($displaytype==0): ?>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 frametype0 thumbnail_picturetype0">
            <img src="./data/picture/portfoliothumbnail/<?php echo $strBuffer['thumbnail'];?>">
          </div>
        <?php elseif ($displaytype==1): ?>
          <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 frametype1 thumbnail_picturetype1">
              <img src="./data/picture/portfoliothumbnail/<?php echo $strBuffer['thumbnail'];?>">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 portfoliocontent ">
              <div class="container-fulid"><!-- ここfulidじゃないと崩れる -->
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 golden-ratio-font__larger3">
                    <?php echo $strBuffer['title'];?>
                  </div>
                </div>
              </div>
              <div class="container-fulid"><!-- ここfulidじゃないと崩れる -->
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php echo $strBuffer['content'];?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
          </div>
        <?php elseif ($displaytype==2): ?>
          <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
              <div class="container-fulid"><!-- ここfulidじゃないと崩れる -->
                <div class="row">
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 portfoliocontent golden-ratio-font__larger3">
                    <?php echo $strBuffer['title'];?>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                </div>
              </div>
              <div class="container-fulid"><!-- ここfulidじゃないと崩れる -->
                <div class="row">
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 frametype2 thumbnail_picturetype2">
                    <img src="./data/picture/portfoliothumbnail/<?php echo $strBuffer['thumbnail'];?>">
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                </div>
              </div>
              <div class="container-fulid"><!-- ここfulidじゃないと崩れる -->
                <div class="row">
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <?php echo $strBuffer['content'];?>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                </div>
              </div>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
  <div id="body5" class="container-fulid">
  </div>
  <?php require('./html/footer.html'); ?>
    <!-- Jquery -->
  <script src="./js/jquery-3.3.1.js"></script>
  <script src="./js/header.js"></script>
  <script src="./js/footer.js"></script>
</body>
</html>