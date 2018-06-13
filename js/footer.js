$(function(){
  // hide()はdisplayプロパティを「none」にする
  $("#action_menu li").hide();
  $("#action_icon>i").click(function(){
    var intDisplayTime=100;
    var intDelayTime=200;
    if ($('#action_menu li').css('display') == 'none') {
        // 表示されている場合の処理
        // 蛇腹式のため各liを下から遅延表示
        $("#action_content3").slideToggle(intDisplayTime)
        $("#action_content2").slideToggle(intDisplayTime+intDelayTime)
        $("#action_content1").slideToggle(intDisplayTime+intDelayTime*2)
    } else {
        // 非表示の場合の処理
        // 蛇腹式のため各liを上から遅延非表示
        $("#action_content1").slideToggle(intDisplayTime)
        $("#action_content2").slideToggle(intDisplayTime+intDelayTime)
        $("#action_content3").slideToggle(intDisplayTime+intDelayTime*2)
    }
  });
})
// 普通にslideさせる場合
// $(function(){
//   $("#action_menu").hide();
//   $("#test>i").click(function(){
//     $("#action_menu").slideToggle()
//   });
// })
$(function(){
  // hide()はdisplayプロパティを「none」にする
  $("#settings_menu li").hide();
  $("#settings_icon>i").click(function(){
    var intDisplayTime=100;
    var intDelayTime=200;
    if ($('#settings_menu li').css('display') == 'none') {
        // 表示されている場合の処理
        // 蛇腹式のため各liを下から遅延表示
        $("#settings_content5").slideToggle(intDisplayTime)
        $("#settings_content4").slideToggle(intDisplayTime+intDelayTime)
        $("#settings_content3").slideToggle(intDisplayTime+intDelayTime*2)
        $("#settings_content2").slideToggle(intDisplayTime+intDelayTime*3)
        $("#settings_content1").slideToggle(intDisplayTime+intDelayTime*4)
    } else {
        // 非表示の場合の処理
        // 蛇腹式のため各liを上から遅延非表示
        $("#settings_content1").slideToggle(intDisplayTime)
        $("#settings_content2").slideToggle(intDisplayTime+intDelayTime)
        $("#settings_content3").slideToggle(intDisplayTime+intDelayTime*2)
        $("#settings_content4").slideToggle(intDisplayTime+intDelayTime*3)
        $("#settings_content5").slideToggle(intDisplayTime+intDelayTime*4)
    }
  });
})