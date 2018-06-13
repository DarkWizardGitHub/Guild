<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="css/style.css" rel="stylesheet" type="text/css" />
  <title>モーダルウィンドウのデモ</title>
  <link href="./css/modalform.css" rel="stylesheet">

</head>
<body>
  <div>
    <div>
      <div>
        <p>リンクテキストをクリックするとモーダルウィンドウを表示させます。モーダルウィンドウ周りのオーバーレイをクリックすると終了します。</p>
        <a id="openmodalformbutton">クリックするとモーダルウィンドウを開きます。</a>
       <!-- <a id="openmodalformbutton" class="button-link">クリックするとモーダルウィンドウを開きます。</a> -->
      </div> <!-- contents end -->
    </div> <!-- wrap end -->
  </div> <!-- orver end -->



  <!-- ここからモーダルウィンドウ -->
  <div id="modalcontent">
    <div id="modalcontentinnar">
      <!-- モーダルウィンドウのコンテンツ開始 -->
      <p class="red bold">
        <!-- モーダルウィンドウに表示するメッセージ -->
      </p>
      <p>
        <a id="closemodalformbutton" class="buttonlink">閉じる</a>
      </p>
    </div>
  <!-- モーダルウィンドウのコンテンツ終了 -->
  </div>

  <!-- JQuery読み込み -->
  <script src="./js/jquery-3.3.1.js"></script>
  <script src="./js/modalform.js"></script>

</body>
</html>