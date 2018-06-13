$(function(){
  // $("#openmodalformbutton").click(function(){
    $("[id^=openmodalformbutton]").click(function(){
    //キーボード操作などにより、オーバーレイが多重起動するのを防止する
    $(this).blur();//ボタンからフォーカスを外す
    //[どちらか選択]
    if($("#overlay")[0]) return false;//新しくモーダルウィンドウを起動しない(防止策1)
    //if($("#overlay")[0]) $("#overlay").remove();//現在のモーダルウィンドウを削除して新しく起動する(防止策2)

    //オーバーレイを出現
    $("body").append('<div id="overlay"></div>');
    $("#overlay").fadeIn("slow");

    //コンテンツをセンタリング
    centeringModalSyncer();

    //コンテンツをフェードイン
    //display:hiddenで非表示状態なのを、fadeInにより、じんわりと表示
    // $("#modalcontent").fadeIn("slow");


    // 池さんに聞くこと１
    // 以下を確認してもらう
    // なぜか初回の１回しかフォームが出ない
    var hoge = $(this).attr("id").substr(19);
    console.log(hoge)
    $(this).siblings("#modalcontent" + hoge).fadeIn("slow");




    //オーバーレイ(#overlay)と閉じるボタン(#closemodalformbutton)、2つの要素に同じクリックイベントを設定
    //[#overlay]、または[#closemodalformbutton]をクリックした場合の処理
    //unbind()は対象の要素にそれまで設定されていたイベントをクリア
    $("#overlay,#closemodalformbutton" + hoge).unbind().click(function(){

      //オーバーレイ(#overlay)とコンテンツ("#modalcontent")をフェードアウトで非表示
      // $("#modalcontent,#overlay").fadeOut("slow",function(){
      $("[id^=modalcontent],#overlay").fadeOut("slow",function(){

        //[#overlay]を削除する
        $('#overlay').remove();
      });
    });
  });

  //リサイズされたら再センタリングのため関数[centeringModalSyncer()]を実行
  $(window).resize(centeringModalSyncer);

  //センタリングを実行する関数
  function centeringModalSyncer() {
    //position:fixedのtop(画面上部から何ピクセル離れているか)とleft(画面左部から何ピクセル離れているか)の値を設定しコンテンツをセンタリング
    //画面(ウィンドウ)の幅、高さを取得
    var w=$(window).width();
    var h=$(window).height();
    // コンテンツ(#modalcontent)の幅、高さを取得
    // jQueryのバージョンによっては、引数[{margin:true}]を指定した時、不具合を起こす
    // var cw=$("#modalcontent").outerWidth({margin:true});
    // var ch=$("#modalcontent").outerHeight({margin:true});
    var cw=$("#modalcontent").outerWidth();
    var ch=$("#modalcontent").outerHeight();

    //センタリングを実行する
    //left(片側の余白の値)=(画面幅-コンテンツ幅)÷2
    //ウィンドウを開いた時の画面幅に合わせてtopとleftの値を設定しセンタリングを実現
    $("#modalcontent").css({"left":((w-cw)/2)+"px","top":((h-ch)/2)+"px"});
  }
});

// classはaddClassという専用関数あるがIDは無いのでattrを使う
// $(function(){
//   $("#openmodalformbutton").click($("#openmodalformbutton").attr('id',$("#openmodalformbutton>div>div>.usernamebox").val()));
// });

