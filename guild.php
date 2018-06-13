<?php
session_start();
require('./php/header.php');
require('./php/footer.php');

require_once('./class/database_class.php');
$objDatabase = new Database();

// echo('<pre>');
// var_dump($_POST);
// echo('</pre>');
// echo('<pre>');
// var_dump($_FILES);
// echo('</pre>');

if (!empty($_POST['message'])):
  $objDatabase->mysqlquery('INSERT INTO `test4` SET `user_id`=?, `message`=?, `created`=NOW()', $data=array($_SESSION['user_parameter']['user_id'], $_POST['message']));
elseif (!empty($_FILES['image']['name'])):
  move_uploaded_file($_FILES['image']['tmp_name'], "./data/picture/chatimage/{$_FILES['image']['name']}");
  $objDatabase->mysqlquery('INSERT INTO `test4` SET `user_id`=?, `image`=?, `created`=NOW()', $data=array($_SESSION['user_parameter']['user_id'], $_FILES['image']['name']));
endif;

// ユーザー所属ギルド情報取得
$arrMyGuild = $objDatabase->mysqlquery('SELECT `test5`.* FROM `test5` WHERE `guild_id`=?', $data=array($_SESSION['user_parameter']['guild_id']));

// ギルドマスター名
$arrGuildMasterInformation = $objDatabase->mysqlquery('SELECT `username`, `profilepicture` FROM `test2` WHERE `guild_id`=? AND `guildtitle`=1', $data=array($_SESSION['user_parameter']['guild_id']));

// サブギルドマスター名
$arrGuildSubMasterInformation = $objDatabase->mysqlquery('SELECT `username`, `profilepicture` FROM `test2` WHERE `guild_id`=? AND `guildtitle`=2', $data=array($_SESSION['user_parameter']['guild_id']));

// ギルドメンバー名
$arrGuildMemberInformation = $objDatabase->mysqlquery('SELECT `username`, `profilepicture` FROM `test2` WHERE `guild_id`=? AND `guildtitle`=0', $data=array($_SESSION['user_parameter']['guild_id']));

// echo('<pre>');
// var_dump($arrGuildMasterInformation);
// echo('</pre>');
// echo('<pre>');
// var_dump($arrMyGuild);
// echo('</pre>');
// メッセージ全件投稿
// $arrPostedItems = $objDatabase->mysqlquery('SELECT * FROM `test4` ORDER BY `created` ASC');
$arrPostedItems = $objDatabase->mysqlquery('SELECT `test2`.`username`, `test2`.`profilepicture`, `test4`.* FROM `test2` LEFT JOIN `test4` ON `test2`.`user_id`=`test4`.`user_id` ORDER BY `test4`.`created` ASC');

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>guild</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="assets/favicon/favicon.png">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="./css/bootstrap.css">

  <!-- CSS -->
  <link rel="stylesheet" href="./css/guild.css">
  <link rel="stylesheet" href="./css/header.css">
  <link rel="stylesheet" href="./css/footer.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css">
</head>

<body>
  <?php require('./html/header.html'); ?>
  <div id="guildbar" class="container-fulid">
    <div class="row killallmarging">
      <div class="col-lg-1 col-lg-offset-3 col-md-1 col-md-offset-3 col-sm-1 col-sm-offset-3 col-xs-1 col-xs-offset-3 guildbarbutton">
        <form action="">
          <div>
            <button type="submit">
              &nbsp
            </button>
          </div>
        </form>
      </div>
      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 guildbarbutton">
        <form action="">
          <div>
            <button type="submit">
              Assignment
            </button>
          </div>
        </form>
      </div>
      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 guildbarbutton">
        <form action="">
          <div>
            <button type="submit">
              &nbsp
            </button>
          </div>
        </form>
      </div>
      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 guildbarbutton">
        <form action="">
          <div>
            <button type="submit">
              &nbsp
            </button>
          </div>
        </form>
      </div>
      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 guildbarbutton">
        <form action="">
          <div>
            <button type="submit">
              &nbsp
            </button>
          </div>
        </form>
      </div>
      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 guildbarbutton">
        <form action="">
          <div>
            <button type="submit">
              &nbsp
            </button>
          </div>
        </form>
      </div>
      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 guildbarbutton">
        <form action="">
          <div>
            <!-- 招待 -->
            <button type="submit">
              Invitation
            </button>
          </div>
        </form>
      </div>
      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 guildbarbutton">
        <form action="">
          <div>
            <!-- 除名 -->
            <button type="submit">
              Expulsion
            </button>
          </div>
        </form>
      </div>
      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 guildbarbutton">
        <form action="">
          <div>
            <!-- 脱退 -->
            <button type="submit">
              Secession
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="container-fulid">
    <div class="row killallmarging">
      <div id="leftsidebar" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
        <div class="container-fulid">
          <div class="row">
            <div id="guildrogo" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <img src="assets//img/rogo.jpg">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <div class="container-fulid">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <p><?php echo $arrMyGuild[0]['guildname']; ?></p>
                    <p><?php echo $arrMyGuild[0]['guildrank']; ?></p>
                    <p><?php echo $arrMyGuild[0]['guildpoint']; ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div id="guildmaster" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 guildtitle">
              Guild Master
            </div>
          </div>
          <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 guildmemberpicture">
              <img src="./data/picture/<?php echo($arrGuildMasterInformation[0]['profilepicture']); ?>">
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 guildmembername">
              <?php echo($arrGuildMasterInformation[0]['username']); ?>
            </div>
          </div>
          <div class="row">
            <div id="assistantguildmaster" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 guildtitle">
              Assistant Guild Master
            </div>
          </div>
          <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 guildmemberpicture">
              <img src="./data/picture/<?php echo($arrGuildSubMasterInformation[0]['profilepicture']); ?>">
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 guildmembername">
              <?php echo($arrGuildSubMasterInformation[0]['username']); ?>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 guildmemberpicture">
              <img src="./data/picture/<?php echo($arrGuildSubMasterInformation[1]['profilepicture']); ?>">
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 guildmembername">
              <?php echo($arrGuildSubMasterInformation[1]['username']); ?>
            </div>
          </div>
          <div class="row">
            <div id="guildmember" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 guildtitle">
              Guild Member
            </div>
          </div>
          <?php for ($i=0; $i<count($arrGuildMemberInformation) ; $i++): ?>
            <div class="row">
              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 guildmemberpicture">
                <img src="./data/picture/<?php echo($arrGuildMemberInformation[$i]['profilepicture']); ?>">
              </div>
              <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 guildmembername">
                <?php echo($arrGuildMemberInformation[$i]['username']); ?>
              </div>
            </div>
          <?php endfor; ?>
        </div>
      </div>
      <div id="chatarea" class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
        <div class="row killallmarging">
          <?php foreach($arrPostedItems as $strBuffer): ?>
            <?php if($_SESSION['user_parameter']['user_id'] != $strBuffer['user_id']): ?>
            <!-- 左側表示 -->
              <?php if($strBuffer['message']!=null): ?>
                <div class="leftmessage" >
                  <img class="profilepicture" src="./data/picture/<?php echo $strBuffer['profilepicture'];?>">
                  <div class="leftusername">
                    <?php echo $strBuffer['username'];?>
                  </div>
                  <span class="leftmessagebox">
                    <?php echo $strBuffer['message'];?>
                  </span>
                  <div class="leftdate golden-ratio-font__smaller1">
                    <?php echo date("n/d H:i",strtotime($strBuffer['created'])); ?>
                  </div>
                </div>
              <?php elseif($strBuffer['image']!=null): ?>
                <div class="leftmessage">
                  <img class="profilepicture" src="./data/picture/<?php echo $strBuffer['profilepicture'];?>">
                  <div class="leftusername">
                    <?php echo $strBuffer['username'];?>
                  </div>
                  <span class="leftmessagebox">
                    <img class="uploadedimage" src="./data/picture/chatimage/<?php echo $strBuffer['image'];?>">
                  </span>
                  <div class="leftdate golden-ratio-font__smaller1">
                    <?php echo date("n/d H:i",strtotime($strBuffer['created'])); ?>
                  </div>
                </div>
              <?php endif; ?>
            <?php else: ?>
            <!-- 右側表示 -->
              <?php if($strBuffer['message']!=null): ?>
                <div class="rightmessage">
                  <img class="profilepicture" src="./data/picture/<?php echo $strBuffer['profilepicture'];?>">
                  <div class="rightusername">
                    <?php echo $strBuffer['username'];?>
                  </div>
                  <span class="rightmessagebox">
                    <?php echo $strBuffer['message'];?>
                  </span>
                  <div class="rightdate golden-ratio-font__smaller1">
                    <?php echo date("n/d H:i",strtotime($strBuffer['created'])); ?>
                  </div>
                </div>
              <?php elseif($strBuffer['image']!=null): ?>
                <div class="rightmessage">
                  <img class="profilepicture" src="./data/picture/<?php echo $strBuffer['profilepicture'];?>">
                  <div class="rightusername">
                    <?php echo $strBuffer['username'];?>
                  </div>
                  <span class="rightmessagebox">
                    <img class="uploadedimage" src="./data/picture/chatimage/<?php echo $strBuffer['image'];?>">
                  </span>
                  <div class="rightdate golden-ratio-font__smaller1">
                    <?php echo date("n/d H:i", strtotime($strBuffer['created'])); ?>
                  </div>
                </div>
              <?php endif; ?>
            <?php endif; ?>
          <?php endforeach; ?>
          <div id="latest-message-position"></div>
        <div id="inputform" class="container-fulid">
          <div class="row">
            <form method="post" action="#latest-message-position" enctype="multipart/form-data">
              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                <div class="container-fulid">
                  <div class="row">
                    <div id="pictureicon" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                      <label for="pictureiconarea">
                        <input id="pictureiconarea" type="file" name="image">
                        <i class="fas fa-file-image fa-2x fa-fw"></i>
                      </label>
                    </div>
                    <div id="emojiicon" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                      <label for="emojiiconarea">
                        <input id="emojiiconarea" type="file" name="emoji">
                        <i class="fas fa-smile fa-2x fa-fw"></i>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div id="inputbox" class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                <input type="text" name="message" placeholder="&nbsp Enter any message...">
              </div>
              <div id="sendicon" class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                <button type="submit">
                  <i class="fas fa-paper-plane fa-2x fa-fw"></i>
                </button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
  <?php require('./html/footer.html') ?>
  <script src="./js/jquery-3.3.1.js"></script>
  <?php require('./js/header.js') ?>
  <?php require('./js/footer.js') ?>
</body>
</html>