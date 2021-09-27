<?php ?>
<!doctype html>
<html lang="zh">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>欢迎来到ATSW</title>
  <link rel="shortcut icon" href="favicon.ico">
  <script src="js/vue.js"></script>
<!--  <script src="js/vue-router.js"></script>-->
  <script src="js/general_script_v1.1.js"></script>
  <script src="js/config_1.js"></script>
  <script src="js/diary_data_v_1.js"></script>
  <style>[v-cloak] {display: none !important;}</style>
  <script>
    function judge() {
      var userAgentInfo = navigator.userAgent;
      var Agents = ["Android", "iPhone",
        "SymbianOS", "Windows Phone",
        "iPad", "iPod"
      ];//判断是否是这些个系统
      var isPC = true;
      for (let i = 0; i < Agents.length; i++) {
        if (userAgentInfo.indexOf(Agents[i]) > 0) {
          isPC = false;
          break;
        }
      }
      return isPC;
    }
    var isPC = judge();
    if(!isPC){
      window.location.href = 'index_pe.php' //跳转到手机端页面
    }
  </script>
  <style>
    html,body{margin: 0;padding: 0;color: rgba(0,0,0,0.8);width: 100%;height: 100%}
    #ATSW{width: 100%;height: 94%;background: rgba(255,255,255,0.9);}
    #background {
      background: url("static/img/other/bj.jpg") no-repeat;
      background-size: 100% auto;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: -1;
    }
  </style>
  <style>
    #search {width: 100%;height: 30px;display: flex;justify-content: center;margin: 10px 0 10px 0;}
    #input_text {width: 48%;height: 100%;margin: 0;padding: 0;border: #FFC6D0 solid;border-radius: 20px;background: #ffa6ca;color: white;outline: none;}
    .PageTop{width: 100%;height: 60px;display: flex;justify-content: space-around;align-items: center;background: rgba(255,255,255,0.96);box-shadow: 2px 2px 10px rgb(35 35 35 / 32%)}
    .logBox{width: 230px;height: 60px;display: flex;justify-content: center;align-items: center}
    .log{width:auto;height: 50px;margin: 0 10px}
    .userHeadImgForTopPage{width: 34px;height: 34px;border-radius: 6px}
    .userAttributeBox{width: auto;min-width: 250px;height: 60px;display: flex;justify-content: center;align-items: center}
    .userAttributeBox p{margin: 0 10px;padding: 0;font-size: 16px;width: auto}
  </style>
  <style>
    .menu {width: 100%;min-height: 120px;display: flex;flex-direction: row;flex-wrap: wrap;justify-content: center;}
    .card {width: 65px;height: 60px;background: #fff5fa;margin: 15px  28px;text-align: center;border-radius: 5px;}
    .menu_img {width: 60px;height: 60px;object-fit: cover;border-radius: 5px;box-shadow: 4px 4px 4px #ceb0b5;transition: 0.2s;}
    .menu_p {margin: 4px 0;}
    a:hover {text-decoration: none;color: #ff5f67;}
    a:link {text-decoration: none;color: #ff979b;}
    user agent stylesheet a:-webkit-any-link {color: -webkit-link;cursor: pointer;}
  </style>
  <style>
    .chatBox{width: 100%;height: calc(100% - 180px);background: rgba(255,255,255,0.1);display: flex;justify-content: center;align-items: center;}
    .chatBoxOut{width: 60%;height: 90%;display: flex;justify-content: center;align-items: center;overflow: hidden;border-radius: 10px;box-shadow: 2px 2px 10px rgb(186, 186, 186)}
    .chatLeft{width: 29%;height: 100%;background: rgba(255,255,255,0.3)}
    .leftCard{width: 100%;height: 80px;background: rgba(240, 240, 240, 0.8);display: flex;justify-content: space-around;align-items: center}
    .chatRight{width: 71%;height: 100%;background:}
    .roomCardLog{width: 60px;height: 60px;border-radius: 50px}
    .roomDir{width: calc(100% - 80px);height: 100%;overflow: hidden;}
    .roomDir p:first-child{margin: 10px 0;font-size: 18px;font-weight: 800}
    .roomDir p:last-child{margin: 10px 0;font-size: 12px;font-weight: 200}
  </style>
  <style>
    :not(.editBox #chatMessage){-moz-user-select: none;-webkit-user-select: none;-ms-user-select: none;-khtml-user-select: none;user-select: none;}
    /*.menuBlur{width: 100%;height: 100%;z-index:512 ;position: fixed;top:0;left: 0;display: none;backdrop-filter: blur(2px);-webkit-backdrop-filter: blur(2px);}*/
  </style>
  <style>
    /*全局变量*/
    :root{--themeColor:#f5f6fa;--backgroundColor:#ebebeb;--menuBackgroundColor:#fc7ba2;--menuBackgroundColorBottom: #ffffff
    }
    /*水印层*/
    .watermarkO{width: 100px;height:auto;max-height: 32px;font-size: 10px;color: #9c9c9c;overflow: hidden;display: flex;justify-content: center;align-items: center;position: fixed;bottom: 0px;right: 0px;z-index: 3080}
    .watermark{width: 90px;height:auto;max-height: 32px;display: flex;justify-content: center;align-items: center}
  </style>
  <style>
    /**/
    /*外框*/
    .outline_01{width:100%;height:100%}
    .outline_02{width:100%;height:100%;/*min-height:600px*/;display: flex;justify-content: start;flex-wrap: nowrap;flex-direction: column;}
    /*中间棋盘主体*/
    .content{width: 100%;height: calc(100%);max-height: calc(100%);display: flex;justify-content: space-between;flex-direction: column;/*position: fixed*/;top:0px;right:0%;z-index: 960;transition: 0.4s ease;-o-transition: 0.4s ease;-webkit-transition: 0.4s ease;-moz-transition: 0.4s ease}
    .chatRoomAttribute{width: 100%;height: 52px;display: flex;justify-content: space-between;background: var(--themeColor);box-shadow: 4px 4px 10px #d4d4d4;z-index: 1010}
    .roomHeadImg{width: auto;min-width: 40px;max-width:100px;height:52px;display: flex;flex-direction: column;align-items: center;justify-content: center}
    .roomHeadImg img{width: 34px;height:34px;border-radius: 8px;border: 1px solid #dfdfdf;margin: 0 5px}
    .roomR{width: auto;max-width: calc(100% - 40px - 40px);height: inherit;text-align: center;display: flex;justify-content: center;align-items: center;flex-direction: column}
    .roomName{font-size:18px;font-weight: 200;}
    .roomOnlineNum{font-size: 14px;font-weight: 100;}
    /*菜单按钮*/
    /*下拉菜单--按钮--背景层*/
    .roomMenu{width: 40px;height: inherit;display: flex;justify-content: center;align-items: center;margin-right: 6px;}
    .dropDownList{background: var(--themeColor);width: 34px;height: 34px;display: flex;justify-content: center;align-items: center;flex-direction: column}
    .dropDownList div{width: 28px;height:1px;background-color: black;margin:4px 0;transition: 0.3s;-o-transition: .3s;-webkit-transition: .3s;-moz-transition: .3s}
    .dropDownList.closed .lines:nth-child(1){transform: translateY(11px) rotate(45deg);}
    .dropDownList.closed .lines:nth-child(2){opacity: 0;}
    .dropDownList.closed .lines:nth-child(3){transform: translateY(-7px) rotate(-45deg);}
  </style>
  <style>
    /*底部编辑信息框*/
    .bottomEdit{width: 100%;height: auto;max-height:64px;background: #ffffff;box-shadow: -5px -5px 15px #ececec;display: flex;justify-content: space-around;flex-direction: row;align-items: center;padding:4px 0px 4px 0px}
    .editBox{width: auto;height: auto;max-height: 44px;min-height: 22px;background: var(--backgroundColor);font-size:17px;border-radius: 5px;letter-spacing:1px;overflow: auto;font-weight: 100;padding: 3px 6px 3px 6px;outline: none;margin-left: 2px}
    .sendContent{width: 45px;height:26px;border-radius: 5px;display: flex;justify-content: space-around;align-items: center;letter-spacing:1px;background: #e1e1e1;margin-right: 3px}
  </style>
  <style>
    .chatMessage{width: 100%;height: auto;overflow-x:hidden;overflow-y: auto}
    .vueOutLine{width: 100%;height: auto}
    .mesOutLine{width: 100%;height: auto;padding: 5px;}
    .mesContent{width: 100%;height: auto;display: flex;justify-content: space-between;align-items: center}
    .userHeadImgOut{width: 48px;height:auto;display: flex;justify-content: space-between;align-items: center}
    .userHeadImg{width: 36px;height: 36px;border-radius: 36px;display: flex;justify-content: space-between;align-items: center}
    .san_jiao_2{width: 5px;height:12px;}
    .userTextMesOut{width: calc(100% - 48px);height: auto;display: flex;justify-content: flex-start;align-items: flex-start;flex-direction: column}
    .user_face_data{font-weight: 100;font-size: 9px}
    .userTextMes{width: auto;max-width:92.5%;height: auto;padding: 6px;background: white;border-radius: 4px;font-size: 14px;font-weight: 200}
    .chatMessageAndBottomEdit{width: 100%;height:auto;max-height:calc(100% - 90px);display: flex;justify-content: space-between;align-items: center;flex-direction: column}
  </style>
  <style>
    .gameCenter{width: 100%;height: 375px;background: #ffc392;}
  </style>
  <style>
    .roomListOut{width: 100%;height:100%;background: var(--backgroundColor);overflow-x: hidden;overflow-y: auto;transition: 0.4s ease;-moz-transition: 0.4s ease;-webkit-transition:  0.4s ease;-o-transition:  0.4s ease;z-index:960;}
    .roomList{width:calc(100% - 20px);height:calc(100% - 20px);padding: 10px;display: flex;justify-content: flex-start;align-items: center;flex-direction: column}
    .roomBoxOut{width: 100%;height: auto;min-height: 80px;background: white;border-radius: 10px;margin: 10px 0px;padding: 4px;display: flex;justify-content: space-around;align-items: center;box-shadow: 4px 4px 10px #d4d4d4;}
    .roomHeadAndNum{width: 72px;height: 72px;display: flex;justify-content: center;align-items: center;flex-direction: column;font-size: 10px}
    .roomHeadAndNum img{height: 85%;border-radius: 8px}
    .roomAttribute{width: calc(100% - 72px - 8px - 10px);height: auto;min-height: 72px;float: left;font-size: 12px}
    .little_icon{width:12px;height: 12px}
    .tagListOutOut{width: auto;height:auto;min-height:20px;display: flex;justify-content: flex-start;align-items: flex-start;flex-wrap: nowrap;}
    .tagListOut{width: auto;height: auto;max-height: 20px;display: flex;justify-content: flex-start;align-items: center;flex-wrap: nowrap;}
    .tagList{background: #d6e2f5;border-radius: 6px;width: auto;height: auto;margin: 0px 4px;padding: 0 3px}
    .desOut{margin: 0 5px;display: flex;justify-content: center;align-items: center;}
  </style>
  <style>
    .switchO{width: 24px;height: 24px;background: white;border-radius: 26px;margin: 2px;transition: 0.3s}
    .switchON{background: #01c8ff;}
    .selectSwitch{background: #eaedf6;width: 56px;height: 28px;border-radius: 28px;display: flex;justify-content: flex-start;transition: 0.3s}
    .menuOut{width: 100%;height: calc(100% - 52px);display: flex;justify-content: space-between;position: fixed;top:52px;right: -100%;transition: .3s ease-in-out;-o-transition: .3s ease-in-out;-webkit-transition: .3s ease-in-out;-moz-transition: .3s ease-in-out;z-index: 2100}
    .menuLeft{width: 32%;height: 100%;position: absolute;left: 0;bottom: 0}
    .menuRight{width: 100%;height: 60%;padding: 8px;position: fixed;}
    .menuR{width:240px;height:375px;box-shadow: 4px 4px 20px #8e8e8e;border-radius:10px;position: fixed;z-index: 3090;opacity:1;display: none}
    .menuMyAttr{animation: headImgMove 8s ease infinite;background-image: url("http://q.qlogo.cn/g?b=qq&nk=1658548955&s=640&mType=friendlist");background-repeat:no-repeat;background-size:100% auto;background-position:100% 0%;width: 100%;height: 90px;display: flex;justify-content: space-between;align-items: center;flex-wrap: nowrap;border-top-left-radius: 10px;border-top-right-radius: 10px}
    .menuHead{height: 80%;width: auto;border-radius: 20%;margin: 8px;padding: 0px;border: 1px rgba(255, 255, 255, 0.51) solid;box-shadow: 2px 2px 10px #848484}
    .rightAttr{width: calc(100% - 90px - 20px);height: 60px;display: flex;padding: 5px;margin-right:10px;justify-content: center;align-items: center;flex-direction: column;background: rgba(243, 243, 243, 0.5);box-shadow: 2px 2px 10px #848484;border-radius: 10px;}
    .attrT1{width: 100%;height: 40px;display: flex;justify-content: flex-start;align-items: flex-start;flex-direction: column}
    .myDisc{width: 100%;height: auto;max-height: 60px;font-size: 12px;color: #1c1c1c;display: flex;justify-content: flex-start;align-items:flex-start;flex-direction: column}
    .myDiscText{display: flex;justify-content: flex-start;align-items: center;margin-top: 2px}
    .MyAttr{width: 100%;height:20px;display: flex;justify-content: flex-start;align-items: center;flex-direction: row;font-size: 14px}
    .MyAttrIcon1{width: 15px;height: 15px;background: white;border-radius: 50%}
    .MyAttrText{font-size: 12px;display: flex;justify-content: center;align-items: center;height: 20px;max-width: 5em}
    .menuList{width: 100%;height: calc(100% - 90px);display: flex;justify-content: flex-start;align-items: flex-start;flex-direction: column;background: var(--menuBackgroundColorBottom);overflow-y: auto;border-bottom-left-radius: 10px;border-bottom-right-radius: 10px}
    .listLineOut{width: calc(100% - 8px);height: 100%;padding: 4px;min-height:20px;display: flex;flex-direction: column;justify-content: space-between;}
    .listLine{margin:0 0;font-size: 18px;height: 32px;width: calc(100%);display: flex;justify-content: space-between;align-items: center;float: left}
    .menuRightBottom{width:68%;height: 40%;position: absolute;right: 0;bottom:0;}
    .menuRightBox{width: 65%;height: 100%}
    /**animation**/
    /*头像上下移动*/
    @keyframes headImgMove { 0%{background-position: 100% 0%;} 50%{background-position: 100% 100%;} 100%{background-position: 100% 0%;}}
  </style>
  <!--登录界面-->
  <style>
    .linkPage{width:400px;height: 220px;;position: fixed;top:calc(50% - 105px);left: calc(50% - 200px);z-index: 4080;padding: 10px;opacity: 1;display: none}
    .linkPageOut{width: 100%;height: 100%;background: white;border-radius: 10px;box-shadow: 2px 2px 10px #9c9c9c}
    .linkEditBox{height: 180px;width:100%;background: ;display: flex;justify-content: space-around;align-items: center;flex-direction: column;}
    .linkButtonO{height: 40px;width:calc(100% - 20px);background: white;box-shadow: 0px 0px 10px rgba(202, 202, 202, 0.89);display: flex;justify-content: space-around;align-items: center;border-radius: 10px;position: absolute;bottom:100%;animation: linkButtonDrop 0.6s ease-in forwards}
    .linkButton{width: 60%;height: 100%;justify-content: center;align-items: center;display: flex;border-radius: 10px;z-index: 4380;background: #01c8ff;}
    .changeButton{width: 40%;height: 100%;justify-content: center;align-items: center;display: flex;border-radius: 10px;z-index: 4380}
    .linkLine{width: 100%;height: 30px;background: ;font-size: 14px;display: flex;justify-content: space-between;align-items: center}
    .linkLines{width: calc(100% - 46px - 10px - 4px);margin: 0 10px 0 0px;height:95%;font-size: 14px;background: #f4f4f4;border-radius: 8px;display: flex;justify-content: flex-start;align-items: center;padding: 0px 2px;}
    .linkLineType2{width: 100%;height: 30px;display: flex;justify-content: space-between;align-items: center;font-size: 14px}
    .linkTextType2{width: 66px;height: 100%;display: flex;justify-content: flex-start;align-items: center}
    .linkLinesType2{width: calc(100% - 66px - 90px - 14px);height: 100%;font-size: 14px;background: #f4f4f4;border-radius: 8px;display: flex;justify-content: flex-start;align-items: center;padding: 0px 2px;}
    .linkButtonType2{width: 90px;height: 100%;background: #c5b8ff;margin: 0 10px 0 4px;display: flex;justify-content: center;align-items: center;border-radius: 9px}
    .linkPageTips{font-weight: 100;font-size: 10px;padding:0 5px }
    .linkOptions{height: 30px;width:100%;display: flex;justify-content: space-around;align-content: center}
    .linkOptionSleImg{width: 15px;height: 15px;border-radius: 50%;background: #ffffff;overflow: hidden}
    .linkOption{width:40% ;height: 30px;display: flex;justify-content: center;align-content: center;font-size: 15px}

    /*animation*/
    @keyframes linkButtonDrop {
      0%{bottom:100%;}
      60%{bottom: 0%;}
      70%{bottom: -5%;}
      100%{bottom: 0%;}
    }
    @keyframes linkOptionsImg{
      0%{background: #ffffff}
      100%{background: #00cafc}
    }
    @keyframes linkOptionsImgOFF{
      0%{background: #00cafc}
      100%{background: #ffffff}
    }
    @keyframes openLinkPage {
      0%{opacity: 0}
      100%{opacity: 1}
    }
    @keyframes hideLinkPage {
      0%{opacity: 1}
      100%{opacity: 0}
    }
  </style>
  <style>
    /*PE*/
    a:link{text-decoration: none;color: #ff979b}
    a:visited{text-decoration: none;color: #ff979b}
    a:hover{text-decoration: none;color: #ff5f67}
    a:active{text-decoration: none;color: #ff979b}
    .menu_p{margin: 4px 0}
    .menu{width: 100%;min-height: 110px;display: flex;flex-direction: row;flex-wrap: wrap;justify-content:center}
    .card{width: 65px;height: 60px;background:#fff5fa;margin: 10px  28px;text-align: center;border-radius: 5px}
    .menu_img{width: 60px;height: 60px;object-fit: cover;border-radius: 5px;box-shadow: 4px 4px 4px #ceb0b5;transition: 0.2s}
    .menu_img:hover{box-shadow: 6px 6px 6px #ceb0b5}
    /*搜索层*/
    #search{width:100%;height:30px;display: flex;justify-content: center;margin: 10px 0 10px 0}
    #input_text{width: 48%;height:100%;margin: 0;padding: 0;border:#FFC6D0 solid;border-radius: 20px;background: #ffa6ca;color: white;outline: none}
    /*星星下落*/
    #special_effects_layer{}
    .stars{z-index: -10}
    /*日志*/
    .outline{width:100%;background: rgba(254, 246, 255, 0.51);border: 1px #ff97ab solid;border-radius: 5px;margin: 10px 0 10px 0;transition:0.3s;}
    .outline:hover{margin-top: 6px;width: 100%;margin-bottom:4px;border:2px solid #ff9095;box-shadow:13px 13px 20px #fab5ba;background: #ffffff}
    .hover{margin-top: 6px;width: 82.5%;margin-bottom:4px;border:2px solid #ff9095;box-shadow:13px 13px 20px #fab5ba;background: #ffffff}
    .img_div{width: inherit;text-align: center;}
    .img{max-height: 700px;border-radius: 5px;max-width: 90%}
    .date{text-align: center;line-height: 20px;font-size: 20px;margin: 10px 0 0 0}
    .text{text-indent:2em;font-size: 16px;margin: 0 6px 6px 6px;}
    /*资讯层*/
    #news_layer{width: 100%;display: flex;justify-content: center;flex-wrap: wrap;background: rgba(255,255,255,0.1);}
    .new_p{width: 50%;height: 60px;background: rgba(254, 246, 255, 0.51);border: 1px #ff97ab solid;border-radius: 5px;margin: 10px 0 10px 0;font-size: 14px}
    .new_log{width: 50%;}
    .new_head{width: 50%;height: 24px;background: rgba(254, 246, 255, 0.51);border: 1px #ff97ab solid;border-radius: 5px;margin: 10px 0 10px 0}
    .head_img{width: 50px;height:50px;margin: 5px;border-radius: 5px;float: left}
    /*悬浮按钮层*/
    #img_float{width: 30px;height: 30px;border-radius: 15px;position: fixed;top: 40%;right: 5px;border:1px solid white;transition: 0.4s}
    /*底部*/
    #foot{text-align: center;background: rgba(255,255,255,0.1);}
    /*动画*/
    @keyframes star_die {from{opacity:1;}to{opacity:0;}}
    @keyframes blur {from{-webkit-filter: blur(1px);filter: blur(1px)} to{-webkit-filter: blur(6px);filter: blur(6px)}}
  </style>
</head>
<body>
<div id="ATSW">
  <!--背景-->
  <div id="background"></div>
  <!--顶部-->
  <div class="PageTop">
    <div class="logBox">
      <img alt="LOG" src="static/img/icon/ATSW.png" class="log"/>
    </div>
    <div id="search">
      <input title="" placeholder="按QQ输入QQ号 | 按UID输入UID并加上前缀uid" type="text" name="word" id="input_text" onfocus="this.style.border='#FF8C93 solid';document.getElementById('blur').style.filter='blur(1px)';document.getElementById('blur').style.webkitFilter='blur(1px)'" onblur="this.style.border='#FFC6D0 solid';document.getElementById('blur').style.filter='blur(6)';document.getElementById('blur').style.webkitFilter='blur(6px)'">
      <img alt="搜索" style="width: 36px;height:36px;background-repeat:no-repeat;" src="static/img/icon/sousuo.png" onclick="find_qq(document.getElementById('input_text').value)">
    </div>
    <div class="userAttributeBox">
      <img :src="'http://q.qlogo.cn/g?b=qq&nk='+my_face_data.user_qq+'&s=640&mType=friendlist'" class="userHeadImgForTopPage" @click="openLinkPage()"/>
      <p v-text="my_face_data.user_name"></p>
      <p>我的星空</p>
    </div>
  </div>
  <!--APP-->
  <div class="menu">
    <div class="card">
      <a href="manga.php" target="_self">
        <img alt="加载失败" id="img1" class="menu_img" src="https://atsw.top/thumbnail/5.jpg">
        <p class="menu_p">看漫图</p>
      </a>
    </div>        <div class="card">
      <a href="bh3.html" target="_self">
        <img alt="加载失败" id="img2" class="menu_img" src="http://q.qlogo.cn/g?b=qq&amp;nk=1269317054&amp;s=640&amp;mType=friendlist">
        <p class="menu_p">崩坏三</p>
      </a>
    </div>
    <div class="card">
      <a href="ys.html" target="_self">
        <img alt="加载失败" id="img4" class="menu_img" src="http://q.qlogo.cn/g?b=qq&amp;nk=979835838&amp;s=640&amp;mType=friendlist">
        <p class="menu_p">原神</p>
      </a>
    </div>
    <div class="card">
      <a href="pcr.html" target="_self">
        <img alt="加载失败" id="img3" class="menu_img" src="http://q.qlogo.cn/g?b=qq&amp;nk=2924319834&amp;s=640&amp;mType=friendlist">
        <p class="menu_p">PCR</p>
      </a>
    </div>
    <div class="card">
      <a href="bh3_source.php" target="_self">
        <img alt="加载失败" class="menu_img" src="static/img/icon/old_ver.png">
        <p class="menu_p">崩坏三</p>
      </a>
    </div>
    <div class="card">
      <a href="diary.html" target="_self">
        <img alt="加载失败" class="menu_img" src="static/img/icon/dairy.png">
        <p class="menu_p">日志</p>
      </a>
    </div>
    <div class="card">
      <a href="about.html" target="_self">
        <img alt="加载失败" class="menu_img" src="static/img/icon/about.png">
        <p class="menu_p">关于</p>
      </a>
    </div>
  </div>
  <!--聊天框-->
  <div class="chatBox">
    <div class="chatBoxOut">
      <div class="chatLeft">
        <div class="roomListOut" id="roomListOut">
          <div class="roomList">
            <!--单个条目-->
            <div class="roomBoxOut" v-cloak v-for="room in room_datas" @click="changeRoom(room.room_id);openRoomList();">
              <div class="roomHeadAndNum">
                <img :src="room.room_head_img"/>
                {{room.online_number+'人在线'}}
              </div>
              <div class="roomAttribute">
                <!--                <div class="tagListOutOut">-->
                <!--                  <img class="little_icon" src="static/img/icon/tag.png"/>-->
                <!--                  <div class="tagListOut">-->
                <!--                    <div class="tagList">{{room.game_type}}</div>-->
                <!--                    <div class="tagList">{{room.remarks}}</div>-->
                <!--                  </div>-->
                <!--                </div>-->
                <div class="tagListOutOut">
                  <img class="little_icon" src="static/img/icon/title.png"/>
                  <div class="desOut" style="font-weight: 600;font-size: 16px">{{room.room_name}}</div>
                </div>
                <div class="tagListOutOut">
                  <img class="little_icon" src="static/img/icon/master.png"/>
                  <div class="desOut">{{room.room_master_name}}</div>
                </div>
                <!--                <div class="tagListOutOut">-->
                <!--                  <img class="little_icon" src="static/img/icon/describe.png"/>-->
                <!--                  <div class="desOut">{{room.describe}}</div>  -->
                <!--                </div>-->
                <div class="tagListOutOut">
                  <img class="little_icon" src="static/img/icon/message.png"/>
                  <div class="desOut"  v-text="getRoomNewMessage(room.room_id)" ></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="chatRight">
        <div class="outline_02" >
          <div class="outline_01" id="outline_01">
            <!--登录界面-->
            <div class="linkPage" id="linkPage">
              <div class="linkPageOut">
                <!--注册用界面--->
                <div class="linkEditBox"  v-show="linkPageChange%2===1">
                  <!--单行-->
                  <div class="linkLine">
                    &nbsp;&nbsp;账号:
                    <div class="linkLines" id="signUser" contenteditable="true"></div>
                  </div>
                  <div class="linkLine">
                    &nbsp;&nbsp;密码:
                    <div class="linkLines" id="signPass" contenteditable="true"></div>
                  </div>
                  <div class="linkLine" v-if="">
                    &nbsp;&nbsp;Q Q:
                    <div class="linkLines"  contenteditable="true" id="QQRegister">

                    </div>
                  </div>
                  <div class="linkLineType2" v-if="">
                    <div class="linkTextType2">&nbsp;&nbsp;验证码:</div>
                    <div class="linkLinesType2" contenteditable="true" id="codeRegister"></div>
                    <div class="linkButtonType2" @click="getRegisterCode()">获取验证码</div>
                  </div>
                  <div class="linkPageTips">(验证码发送至您的QQ邮箱)密码需要至少包含数字、小写字母、大写字母、特殊符号两种以上。账号可以使用汉字，注册后无法修改！</div>
                </div>
                <!--登录用界面--->
                <div class="linkEditBox" v-show="linkPageChange%2===0">
                  <!--单行-->
                  <div class="linkLine">
                    &nbsp;&nbsp;账号:
                    <div class="linkLines" id="linkUser" contenteditable="true"></div>
                  </div>
                  <div class="linkLine">
                    &nbsp;&nbsp;密码:
                    <div class="linkLines" id="linkPass" contenteditable="true"></div>
                  </div>
                  <!--小按钮自动登录和记住账号-->
                  <div class="linkOptions">
                    <div class="linkOption" @click.stop="clickLinkOptionSle($event.path[0],'autoLink','rememberUsername')"><img class="linkOptionSleImg" src="static/img/icon/selected.png"/>自动登录</div>
                    <div class="linkOption" @click.stop="clickLinkOptionSle($event.path[0],'rememberUsername')"><img class="linkOptionSleImg" src="static/img/icon/selected.png"/>记住账号</div>
                  </div>
                  <div class="linkPageTips">即使在海上，也不要忘记回家</div>
                </div>
                <!--按钮-->
                <div class="linkButtonO">
                  <div class="linkButton" id="loginBtt" @click.stop="sendLinkRequest()" v-show="changeDom.linkButtonChange">
                    登录
                  </div>
                  <div class="linkButton" id="signBtt" @click.stop="sendSignRequest()" v-show="!changeDom.linkButtonChange">
                    注册
                  </div>
                  <div class="changeButton" id="changeButton" @click.stop="changeLinkButtonType($event.path[0])">
                    切换为注册
                  </div>
                  <div class="changeButton" id="" @click.stop="openLinkPage()">
                    返回
                  </div>
                </div>
              </div>
            </div>
            <!--主体-->
            <div class="content" id="content">
              <!--顶部房间名称-->
              <div class="chatRoomAttribute" id="chatRoomAttribute">
                <div class="roomHeadImg">
                  <img  @click="openRoomList()" :src="now_room_data.room_head_img">
                </div>
                <div class="roomR" v-cloak>
                  <div class="roomName">{{now_room_data.room_name}}</div>
                  <div class="roomOnlineNum">{{connection_num}}人在线</div>
                </div>
                <div class="roomMenu">
                  <div class="dropDownList">
                    <!--线条-->
                    <div class="lines"></div>
                    <div class="lines"></div>
                    <div class="lines"></div>
                  </div>
                </div>
              </div>
              <div class="chatMessageAndBottomEdit">
                <!--聊天内容-数据-->
                <div class="chatMessage" id="chatMessage">
                  <!--用户的单条消息-->
                  <div class="vueOutLine" v-for="mes_data in now_room_mes_data" :key="mes_data.mes_id">
                    <div class="mesOutLine">
                      <div class="mesContent">
                        <div class="userHeadImgOut">
                          <img class="userHeadImg" :src="'http://q.qlogo.cn/g?b=qq&nk='+mes_data.send_user_qq+'&s=640&mType=friendlist'" alt="">
                          <img class="san_jiao_2" src="static/img/icon/san_jiao_2.png" alt="">
                        </div>
                        <div class="userTextMesOut" v-cloak>
                          <div class="user_face_data">{{mes_data.send_user_nick}} {{mes_data.mes_time.substr(-8, 8)}}</div>
                          <div class="userTextMes">{{mes_data.mes}}</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--底部编辑信息框-->
              <div class="bottomEdit" id="bottomEdit">
                <!--左侧输入框-->
                <div contenteditable="true" class="editBox" id="editBox" @keyup.enter="sendCommonMes(waitSendMessage,now_room_id)" @keyup="editBoxInnerText($event.path[0].innerText)" @keydown="editBoxInnerText($event.path[0].innerText)"></div>
                <div class="sendContent" id="sendContent" @click="sendCommonMes(waitSendMessage,now_room_id)">发送</div>
              </div>
            </div>
          </div>
          <div class="watermarkO" id="watermark" v-cloak>
            <div class="watermark">{{my_qq}}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div style="width: 100%;height: auto;background: rgba(255,255,255,0.9);">
  <!--资讯层-->
  <div id="news_layer">
    <div class="new_head" id="search_error" style="display: none">
      <b>&nbsp;未查询到任何信息</b>
    </div>
    <div class="new_head" id="search_content" style="display: none">
      <b>&nbsp;查询到以下信息：</b>
    </div>
    <div class="new_p" style="display: none" id="bh3_search">
      <img src="" class="head_img" id="bh3_search_img">
      <div id="bh3_search_div">
      </div>
    </div>
    <div class="new_p" style="display: none" id="pcr_search">
      <img src="" class="head_img" id="pcr_search_img">
      <div id="pcr_search_div">
      </div>
    </div>
    <div class="new_p" style="display: none" id="ys_search">
      <img src="" class="head_img" id="ys_search_img">
      <div id="ys_search_div">
      </div>
    </div>
    <!---->
    <div class="new_head">
      <b>&nbsp;资料表新增数据：</b>
    </div>
    <div class="new_bh3 new_p">
      <img :src="'http://q.qlogo.cn/g?b=qq&nk='+datas[0].bh3_qq_id+'&s=640&mType=friendlist'" class="head_img">
      <div>
        Nick-name : {{datas[0].bh3_group_nickname}}
        <br>
        GameType : BH3
        <br>
        UID : {{datas[0].bh3_game_id}}&nbsp;&nbsp;QQ : {{datas[0].bh3_qq_id}}
      </div>
    </div>
    <div class="new_bh3 new_p">
      <img :src="'http://q.qlogo.cn/g?b=qq&nk='+datas[0].pcr_qq_id+'&s=640&mType=friendlist'" class="head_img">
      <div>
        Nick-name : {{datas[0].pcr_group_nickname}}
        <br>
        GameType : PCR
        <br>
        UID : {{datas[0].pcr_game_id}}&nbsp;&nbsp;QQ : {{datas[0].pcr_qq_id}}
      </div>
    </div>
    <div class="new_bh3 new_p">
      <img :src="'http://q.qlogo.cn/g?b=qq&nk='+datas[0].ys_qq_id+'&s=640&mType=friendlist'" class="head_img">
      <div>
        Nick-name : {{datas[0].ys_group_nickname}}
        <br>
        GameType : 原神
        <br>
        UID : {{datas[0].ys_game_id}}&nbsp;&nbsp;QQ : {{datas[0].ys_qq_id}}
      </div>
    </div>
    <!--新的日志-->
    <div class="new_head">
      <b>&nbsp;日志新增数据：</b>
    </div>
    <div class="new_log" id="flex" draggable="false">
      <div class="outline" id="outline" v-for="(diary,i) in list" v-if="i===list.length - 1"><!--单个日志-->
        <div class="date"><!--时间及类型-->
          {{diary.time.year}}年{{diary.time.month}}月{{diary.time.day}}日{{diary.time.hours}}时{{diary.time.minute}}分({{diary.type}})
        </div>
        <div class="content" v-for="(diary_content,c) in diary.content"><!--内容---->
          <div class="text" v-if="create_text(diary_content[1])">
            <p v-html="diary_content[0]"></p>
          </div>
          <div class="img_div" v-if="create_img(diary_content[1])">
            <img draggable="false" class="img" :src="diary_content[0]">
          </div>
        </div>
      </div>
      <div class="outline"  v-for="(diary,i) in list" v-if="i===list.length - 2"><!--单个日志-->
        <div class="date"><!--时间及类型-->
          {{diary.time.year}}年{{diary.time.month}}月{{diary.time.day}}日{{diary.time.hours}}时{{diary.time.minute}}分({{diary.type}})
        </div>
        <div class="content" v-for="(diary_content,c) in diary.content"><!--内容---->
          <div class="text" v-if="create_text(diary_content[1])">
            <p v-html="diary_content[0]"></p>
          </div>
          <div class="img_div" v-if="create_img(diary_content[1])">
            <img draggable="false" class="img" :src="diary_content[0]">
          </div>
        </div>
      </div>
      <div class="outline"  v-for="(diary,i) in list" v-if="i===list.length - 3"><!--单个日志-->
        <div class="date"><!--时间及类型-->
          {{diary.time.year}}年{{diary.time.month}}月{{diary.time.day}}日{{diary.time.hours}}时{{diary.time.minute}}分({{diary.type}})
        </div>
        <div class="content" v-for="(diary_content,c) in diary.content"><!--内容---->
          <div class="text" v-if="create_text(diary_content[1])">
            <p v-html="diary_content[0]"></p>
          </div>
          <div class="img_div" v-if="create_img(diary_content[1])">
            <img draggable="false" class="img" :src="diary_content[0]">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--底部-->
  <div id="foot">
    <p>ATSW萌的日志@2020-2021 <a href="https://beian.miit.gov.cn" target="_blank" style="color: black">滇ICP备20002587号-2</a></p>
    <p>临冉 Emilia QQ镜像群:1035663153</p>
  </div>
</div>
<script>
  /**缓存层**/
    //客户的面部数据
    //临时存储接收到的消息
  let temp02=null;
  let temp03=null;
  let temp04=null;//common包
  /**缓存层结束**/
  /**其他脚本**/
    //vue-watermark
  const new_app_3=new Vue({
      el:'#ATSW',
      data:{
        editBoxHeight:null,
        waitSendMessage:null,
        alreadyAutoLogin:false,
        //页面状态管理
        windowState:{
          linkPage:false,
        },
        //双向改变类
        changeDom:{
          linkButtonChange:true,
          signButtonChange:false,
        },
        chromeConf:{"chromeWidth":undefined,"chromeHeight":undefined,"chromeNavigator":undefined},//客户的浏览器基础配置
        SC_log:{
          'getChromeConf':{'work_num':0,'error_num':0,'error_log':null,'default_config':undefined},
          'windowSizeListener':{'work_num':0,'error_num':0,'error_log':null,'default_config':undefined},
          'setRoomHeadListener':{'work_num':0,'error_num':0,'error_log':null,'default_config':undefined},
          'changeRoomTop':{'work_num':0,'error_num':0,'error_log':null,'default_config':undefined},
          'hideSelect':{'work_num':0,'error_num':0,'error_log':null,'default_config':undefined},
          'switchOn':{'work_num':0,'error_num':0,'error_log':null,'default_config':undefined},
          'openMenu':{'work_num':0,'error_num':0,'error_log':null,'default_config':undefined},
          'openLinkPage':{'work_num':0,'error_num':0,'error_log':null,'default_config':undefined},
          'setEditBoxSize':{'work_num':0,'error_num':0,'error_log':null,'default_config':undefined},
          'compatibleSoftwareDisk':{'work_num':0,'error_num':0,'error_log':null,'default_config':undefined},
          'EditBoxMutationCallback':{'work_num':0,'error_num':0,'error_log':null,'default_config':undefined},
          'reSetCentUi':{'work_num':0,'error_num':0,'error_log':null,'default_config':undefined},
          'setCentUiHeight':{'work_num':0,'error_num':0,'error_log':null,'default_config':undefined},
          'reGetDom':{'work_num':0,'error_num':0,'error_log':null,'default_config':undefined},
          'sendLinkRequest':{'work_num':0,'error_num':0,'error_log':null,'default_config':undefined},
          'sendCommonMes':{'work_num':0,'error_num':0,'error_log':null,'default_config':undefined},
          'mesScrollAutoMove':{'work_num':0,'error_num':0,'error_log':null,'default_config':undefined},
          'clearEditBox':{'work_num':0,'error_num':0,'error_log':null,'default_config':undefined},
        },
        userAccount:{
          username: null,
          password: null
        },
        my_face_data:{user_qq: '100001',user_name:'点击头像登录'},
        //自动化控制器
        scriptSwitch:{
          'chatMesAutoScroll':true,//是否启用自动上划消息框
          'slideOpenRoomList':true,//是否启用左右滑动打开房间页面
          'dbClickOpenMenu':true,//是否启用双击打开菜单界面
          'rememberUsername':false,//是否启用保存账号及密码
          'autoLinkStart':false,//是否启用自动登录
        },
        //动画特效控制器
        animationSwitch:{
          linkButtonDrop:true
        },
        linkPageChange:0,
        roomListIsOpen:false,
        my_qq:'未登录用户',
        connection_num:0,
        isLink:false,
        get_mes:false,
        now_room_id:1,
        now_room_mes_data:[],//此处存放当前房间的数据
        //所有拥有的房间的数据,其中公共的房间人数是全体
        room_datas:[
          {
            "room_id": "1",
            "belong_user_id": "0",
            "room_head_img": "http://q.qlogo.cn/g?b=qq&nk=1077365277&s=640&mType=friendlist",
            "room_name": "ATSW-交流大厅",
            "room_master_name": "临冉",
            "room_master": "1",
            "game_type": "五子棋",
            "remarks": "公共的房间",
            "describe": "这是公共的房间，由临冉管理，请勿发布恶意消息",
            "online_number": "0",
            "online_user": null,
            "new_mes": {
              "mes_id": "163",
              "mes_time": "2021-09-05 12:28:31",
              "mes_type": "common",
              "send_room_id": "1",
              "send_user_id": "1",
              "send_user_name": "临冉",
              "send_user_nick": "临冉哦",
              "send_user_qq": "1658548955",
              "mes": "测速",
              "remarks": null
            }
          },
          {
            "room_id": "4",
            "belong_user_id": "0",
            "room_head_img": "http://q.qlogo.cn/g?b=qq&nk=1763123826&s=640&mType=friendlist",
            "room_name": "ATSW-交流大厅2",
            "room_master_name": "没有梦想的咸鱼",
            "room_master": "1",
            "game_type": "象棋",
            "remarks": "公共的房间",
            "describe": "这是公共的房间，由临冉管理，请勿发布恶意消息",
            "online_number": "0",
            "online_user": null,
            "new_mes": {
              "mes_id": "1",
              "mes_time": "2021-06-07 22:26:36",
              "mes_type": "common",
              "send_room_id": "1",
              "send_user_id": "1",
              "send_user_name": "临冉",
              "send_user_nick": "临冉哦",
              "send_user_qq": "1658548955",
              "mes": "创建完成",
              "remarks": null
            }
          }
        ],
        mes_data:[
          {
            "room_id": "1",
            "mes_data": [
              {
                "mes_id": "999999999",
                "mes_time": "2021-09-05 12:28:31",
                "mes_type": "common",
                "send_room_id": "1",
                "send_user_id": "1",
                "send_user_name": "匿名",
                "send_user_nick": "匿名",
                "send_user_qq": "1658548955",
                "mes": "默认消息",
                "remarks": null
              }
            ]
          }
        ],//此处存放每所有房间的数据
        user_face_data:{
          "token": null,
          "user_id": "0",
          "user_qq": "2298127501",
          "user_name": "未登录用户",
          "user_nick": "未登录用户",
          "registration_time": "1970-01-01 00:00:00",
          "belong_room": "1",
          "my_belong_room_data": [],
          "room_mes_data": [],
          "experience": "0",
          "chess_power": "0"
        },
        //当前房间的房间数据
        now_room_data:{
          belong_user_id: "0",
          describe: "这是公共的房间，由临冉管理，请勿发布恶意消息",
          game_type: "五子棋",
          online_number: "0",
          online_user: null,
          remarks: "公共的房间",
          room_head_img: "http://q.qlogo.cn/g?b=qq&nk=1077365277&s=640&mType=friendlist",
          room_id: "1",
          room_master: "1",
          room_master_name: "临冉",
          room_name: "ATSW-交流大厅",
          new_mes:"暂无"
        }
      },
      methods:{
        //请求注册
        sendSignRequest:function sendSignRequest(){
          let username=document.querySelector('#signUser').innerText;
          let password=document.querySelector('#signPass').innerText;
          let qqreg=document.querySelector('#QQRegister').innerText;
          let codereg=document.querySelector('#codeRegister').innerText;
          if(username==''){alert_tips('请输入账号');return false;}
          if(password==''){alert_tips('请输入密码');return false;}
          if(qqreg==''){alert_tips('请输入QQ');return false;}
          if(codereg==''){alert_tips('请输入验证码');return false;}
          let data={"mestype":"register","username":username,"password":password,"qq":qqreg,"code":codereg};
          wsClient.send(JSON.stringify(data));
        },
        //请求注册验证码
        getRegisterCode:function getRegisterCode(){
          let qq=document.querySelector('#QQRegister').innerText;
          let data={'mestype':'registerCode','qq':qq};
          wsClient.send(JSON.stringify(data));
        },
        //获取当前房间的最新消息
        getRoomNewMessage:function getRoomNewMessage(room_id){
          for(let i=0;i<this.mes_data.length;i++){
            if(room_id==this.mes_data[i].room_id){
              return this.mes_data[i].mes_data[this.mes_data[i].mes_data.length-1].send_user_nick+'：'+this.mes_data[i].mes_data[this.mes_data[i].mes_data.length-1].mes;
            }
          }
        },
        //清空输入框
        clearEditBox:function clearEditBox() {
          try{
            document.querySelector('#editBox').innerHTML='';
            this.SC_log.clearEditBox.work_num++;
          }catch (e) {
            this.SC_log.clearEditBox.error_num++;
            this.SC_log.clearEditBox.error_log=e;
          }
        },
        //更新edit的信息
        editBoxInnerText:function editBoxInnerText(text){
          this.waitSendMessage=text;
          let heightPX=getComputedStyle(document.querySelector('#bottomEdit')).getPropertyValue('height');
          if(this.editBoxHeight===null){this.editBoxHeight=heightPX;return true}
          if(this.editBoxHeight!=heightPX){
            if(this.editBoxHeight<heightPX){
              document.querySelector('.chatMessageAndBottomEdit').style.maxHeight='calc(100% - 112px)';
            }else {
              document.querySelector('.chatMessageAndBottomEdit').style.maxHeight='calc(100% - 90px)';
            }
            scrollAuto();
            this.editBoxHeight=heightPX;
          }
        },
        //发送普通消息
        //用户发出{"mestype":"common","send_token":"1f8B58dd","send_room":1,"mes":"\u6d4b\u8bd5\u4fe1\u606f"}
        sendCommonMes:function sendCommonMes(mes,roomid){
          try{
            if(mes===null || mes==='' || mes==='null' || mes===' '){alert_tips('消息为空')}
            if(this.my_face_data!==null){
              if(!this.my_face_data.hasOwnProperty('token')){
                alert_tips('请登录');return false;
              }
            }else {
              alert_tips('请登录');return false;
            }
            let data={'mestype':'common','send_token':this.my_face_data['token'],'send_room':roomid,'mes':mes};
            wsClient.send(JSON.stringify(data));
            this.clearEditBox();
            this.SC_log.sendCommonMes.work_num++;
          }catch (e) {
            this.SC_log.sendCommonMes.error_num++;
            this.SC_log.sendCommonMes.error_log=e;
          }
        },
        //写入cookie
        writeUsernameToCookie:function writeUsernameToCookie(name){
          if(this.scriptSwitch.rememberUsername){this.setCookie('username',name,365)}
        },
        //写入cookie
        writePassToCookie:function writeUsernameToCookie(pass){
          if(this.scriptSwitch.autoLinkStart){this.setCookie('password',pass,365)}
        },
        //设置cookie
        setCookie:function setCookie(name,value,day){
          var date = new Date();
          date.setDate(date.getDate() + day);
          document.cookie = name + '=' + value + ';expires='+ date;
        },
        //点击勾选按钮后设置动画
        clickLinkOptionSle:function clickLinkOptionSle(el,...option) {
          status=el.getAttribute('status');
          if(status==='null' || status==='no' || status===undefined || status===null){
            el.setAttribute('status','yes');
            el.firstChild.style.animation='linkOptionsImg 0.4s ease forwards';
          }else {
            el.setAttribute('status','no');
            el.firstChild.style.animation='linkOptionsImgOFF 0.4s ease forwards';
          }
          for(let i=0;i<option.length;i++){
            switch (option[i]) {
              case 'autoLink':{
                this.scriptSwitch.autoLinkStart=!this.scriptSwitch.autoLinkStart;
                console.log(1);
                break;
              }
              case 'rememberUsername':{
                this.scriptSwitch.rememberUsername=!this.scriptSwitch.rememberUsername;
                break;
              }
              default:{return false}
            }
          }
        },
        //改变登录和注册
        changeLinkButtonType:function changeLinkButtonType(el){
          this.changeDom.linkButtonChange=!this.changeDom.linkButtonChange;
          if(el.innerText=='切换为注册'){el.innerText='切换为登录';this.linkPageChange++}else {el.innerText='切换为注册';this.linkPageChange++}
        },
        //打开登录界面
        openLinkPage:function openLinkPage() {
          try{

            let linkPage=document.querySelector('#linkPage');
            if(this.windowState.linkPage===false){
              linkPage.style.display='block';
              linkPage.setAttribute('isHide','no');
              linkPage.style.animation='openLinkPage 0.5s ease forwards';
              this.windowState.linkPage=!this.windowState.linkPage;
            }else {
              setTimeout(function (){linkPage.style.display='none'},0.5*1000);
              linkPage.setAttribute('isHide','yes');
              linkPage.style.animation='hideLinkPage 0.5s ease forwards';
              this.windowState.linkPage=!this.windowState.linkPage;
            }
            this.SC_log.openLinkPage.work_num++;

          }catch (e) {
            this.SC_log.openLinkPage.error_num++;
            this.SC_log.openLinkPage.error_log=e;
          }
        },
        //发送连接请求
        //{"mestype":"link","username":"临冉","password":"123456789"}
        sendLinkRequest:function sendLinkRequest(name,password) {
          try{
            let username=name||document.querySelector('#linkUser').innerText;
            let userpass=password||document.querySelector('#linkPass').innerText;
            if(new_app_3.isLink===true){
              if(username==this.my_face_data.user_name){
                return false;
              }
            }
            let data={'mestype':'link','username':username,'password':userpass};
            wsClient.send(JSON.stringify(data));
            this.userAccount.username=username;
            this.userAccount.password=userpass;
            this.SC_log.sendLinkRequest.work_num++;
          }catch (e) {
            this.SC_log.sendLinkRequest.error_num++;
            this.SC_log.sendLinkRequest.error_log=e;
          }
        },
        openRoomList:function (){
          try{
            let Window=document.querySelector('#roomListOut');
            let content=document.querySelector('#content');
            let isHide=Window.getAttribute('isHide');
            if(isHide==undefined || isHide=='yes'){
              content.style.right='-100%';
              Window.style.left='0px';
              Window.setAttribute('isHide','no');
            }else{
              content.style.right='0px';
              Window.style.left='-100%';
              Window.setAttribute('isHide','yes');
            }
            this.roomListIsOpen=!this.roomListIsOpen;
            this.SC_log.openMenu.work_num++;
          }catch (e) {
            this.SC_log.openMenu.error_num++;
            this.SC_log.openMenu.error_log=e;
          }
        },
        changeRoom:function (roomId) {
          this.now_room_id=roomId;
          for(let iu=0;iu<this.room_datas.length;iu++){
            if(this.room_datas[iu].room_id==roomId){
              this.now_room_data=this.room_datas[iu];
              console.log('切换为房间号:'+this.room_datas[iu].room_id);
              break;
            }
          }
          for(let iw=0;iw<this.mes_data.length;iw++){
            if(this.mes_data[iw].room_id==roomId){
              this.now_room_mes_data=this.mes_data[iw].mes_data;
              console.log('切换的房间号:'+iw);
              break;
            }
          }
        },
        changeLinkPage:function (el) {
          if(this.linkPageChange%2===0){
            this.linkPageChange++;
            console.log(el);
          }
        },
        changeSelectSwitchStatus:function (selectSwitchName) {
          this.scriptSwitch[selectSwitchName]=!this.scriptSwitch[selectSwitchName];
          console.log(this.scriptSwitch);
        },

      }
    });
  //ws
  if (!!window.WebSocket && window.WebSocket.prototype.send){}else{alert_tips("您的浏览器不支持Websocket通信协议，请使用Chrome或者Firefox浏览器！")}
  var wsClient=null;//WS客户端对象
  wsClient=new WebSocket('wss://atsw.top:9998');
  wsClient.onopen=function(){
    alert_tips('连接成功，请登录后发送消息')
  };
  //接收WS服务器返回的消息
  wsClient.onmessage = function(e){
    try{
      var mesObj=eval('('+e.data+')');
      console.log('来自服务器的消息：'+ mesObj);
      temp02=mesObj;
      if(mesObj['mestype']==null || mesObj['mestype']==undefined){
        console.log('收到异常的数据');
        return false;
      }
      switch (mesObj['mestype']) {
        //普通的文本数据
        case 'common':{
          console.log("收到一条普通文本消息");
          //处理数据
          let timeStr=mesObj['mestime'];
          let dateObj = new Date(timeStr);
          //let mesTime=dateObj.getHours()+':'+dateObj.getMinutes();
          let mesTime=timeStr;
          new_app_3.getMes=true;
          //提取房间号
          let roomId=mesObj['send_room_id'];
          let roomIsCreate=false;//默认该房间没有创建
          //检测房价有没有提前创建
          //mes_data:[{/*每个房间就是一个对象*/'room_id':'1','mes_list':[{/*每条消息也是一个对象*/'qq':'1658548955','uid':'1','mes':'你好','nick':'临冉哦','mestime':'2020-12-12 20:15:12'},{~}]},{~}]
          for (let ix=0;ix<new_app_3.mes_data.length;ix++){
            if(new_app_3.mes_data[ix].room_id==roomId){
              roomIsCreate=true;
            }
          }
          //若没有创建该房间，将会创建
          if(!roomIsCreate){
            let newRoomMesData={'room_id':roomId,'mes_data':[]};
            new_app_3.mes_data.push(newRoomMesData)
          }
          //将该条消息放入新消息属性

          //若这条消息正好是当前房间的，则放入该房间桶
          if(roomId==new_app_3.now_room_id){
            new_app_3.now_room_mes_data.push({send_user_qq:mesObj['send_user_qq'],send_user_id:mesObj['send_user_id'],mes:mesObj['mes'],send_user_nick:mesObj['send_user_nick'],mes_time:mesTime});
            temp04=mesObj;
            //new_app_3.now_room_data.
          }else {
            //将该条消息放入对应房间数据桶
            for (let ir=0;ir<new_app_3.mes_data.length;ir++){
              if(new_app_3.mes_data[ir].room_id==roomId){
                console.log('---');
                console.log(new_app_3.now_room_mes_data.length);
                new_app_3.mes_data[ir].mes_data.push({send_user_qq:mesObj['send_user_qq'],send_user_id:mesObj['send_user_id'],mes:mesObj['mes'],send_user_nick:mesObj['send_user_nick'],mes_time:mesTime});
                console.log('---');
                console.log(new_app_3.now_room_mes_data.length);
              }
            }
          }
          if(new_app_3.scriptSwitch.chatMesAutoScroll){
            scrollAuto();
          }
          for (let iq=0;iq<new_app_3.room_datas.length;iq++){
            if(new_app_3.room_datas[iq].room_id==roomId){
              new_app_3.room_datas[iq].new_mes={send_user_qq:mesObj['send_user_qq'],send_user_id:mesObj['send_user_id'],mes:mesObj['mes'],send_user_nick:mesObj['send_user_nick'],mes_time:mesTime};
              break;
            }
          }
          //
          break;
        }
        case 'linkfail':{
          alert_tips('登录失败');
          break;
        }
        case 'registerfail':{
          alert_tips('注册失败！请尝试换个账号名，以及检查验证码和QQ是否正确。')
        }
        case 'registersuccess':{
          alert_tips('注册成功！请切换到登录页面进行登录！')
        }
        case 'welcome':{
          alert_tips('登录成功');
          //new_app_3.openLinkPage();
          new_app_3.my_face_data=mesObj;
          //处理房间数据
          let sourceRoomData=temp03=mesObj.my_belong_room_data;
          let sourceMesData=temp03=mesObj.room_mes_data;
          //新增新消息属性
          for (let ic=0;ic<sourceRoomData.length;ic++){
            sourceRoomData[ic].new_mes={mes: "暂无新消息", mes_id: "100",mes_time: "2021-06-30 11:34:03", mes_type: "common", remarks: null, send_room_id: "1", send_user_id: "2", send_user_name: "emilia", send_user_nick: "新消息", send_user_qq: "3545172770"};
          }
          //当传入1号房间的数据时，仅作更新处理
          for (let iao=0;iao<sourceRoomData.length;iao++){
            if(sourceRoomData[iao].room_id=='1'){
              new_app_3.room_datas[0].describe=sourceRoomData[iao].describe;
              new_app_3.room_datas[0].game_type=sourceRoomData[iao].game_type;
              new_app_3.room_datas[0].remarks=sourceRoomData[iao].remarks;
              new_app_3.room_datas[0].room_head_img=sourceRoomData[iao].room_head_img;
              new_app_3.room_datas[0].room_name=sourceRoomData[iao].room_name;
              break;
            }
          }
          for (let ik=0;ik<sourceRoomData.length;ik++){
            for (let ikk=0;ikk<sourceMesData.length;ikk++){
              if(sourceRoomData[ik].room_id==sourceMesData[ikk].room_id){
                sourceRoomData[ik].new_mes=sourceMesData[ikk].mes_data[0];
                break;
              }
            }
          }
          //反转一下历史消息数据
          if(sourceMesData!=undefined){
            for(let iq=0;iq<sourceMesData.length;iq++){
              sourceMesData[iq].mes_data.reverse();
            }
          }
          new_app_3.room_datas=sourceRoomData;
          new_app_3.mes_data=sourceMesData;
          new_app_3.my_qq="QQ"+new_app_3.my_face_data.user_qq;
          for (let iy=0;iy<sourceMesData.length;iy++){
            if(sourceMesData[iy].room_id==new_app_3.now_room_id){
              new_app_3.now_room_mes_data=sourceMesData[iy].mes_data;
            }
          }
          new_app_3.isLink=true;
          new_app_3.writeUsernameToCookie(new_app_3.userAccount.username);
          new_app_3.writePassToCookie(new_app_3.userAccount.password);
          scrollAuto();
          break;
        }
        case 'connect':{
          new_app_3.connection_num=mesObj.connectnum;//注意这个是所有在线(包含未登录)用户总和，各房间在线人数依据room_data计算
          setTimeout(function (){new_app_3.room_datas[0].online_number=mesObj.connectnum;},15);
          break;
        }
        case 'basicData':{
          new_app_3.now_room_data=mesObj.room_data[0];
          new_app_3.now_room_mes_data=mesObj.mes_data[0].mes_data;
          new_app_3.room_datas=mesObj.room_data;
          new_app_3.mes_data=mesObj.mes_data;
          console.log(mesObj);
          break;
        }
        case 'roomUpdate':{
          //如果正好是当前房间的更新数据则更新当前房间数据
          if(new_app_3.now_room_id==mesObj.room_id){
            new_app_3.now_room_data=mesObj.room_data;
          }
          //更新房间数据
          for(let ik=0;ik<new_app_3.room_datas.length;ik++){
            if(new_app_3.room_datas[ik].room_id==mesObj.room_id){
              new_app_3.room_datas[ik]=mesObj.room_data;
            }
          }
          break;
        }
        default:{
          return false;
        }
      }
    }catch (e) {
      console.log(e)
    }

  };
  /**其他脚本结束**/
  /**应用层**/
  document.querySelector('#bottomEdit').onresize=evs=>{console.log(evs)};
  for(let i=0;i<document.querySelectorAll('.selectSwitch').length;i++){
    document.querySelectorAll('.selectSwitch')[i].addEventListener('click',function (){switchOn(this)})
  }
  getChromeConf();
  setCentUiHeight();
  setEditBoxSize(new_app_3.chromeConf.chromeWidth*0.432,40);
  window.onresize=()=>{getChromeConf();setEditBoxSize(new_app_3.chromeConf.chromeWidth*0.432,40);};
  document.querySelector('.dropDownList').onclick=evs=>{document.querySelector('.dropDownList').classList.toggle('closed');};
  document.getElementById('chatMessage').onscroll=evs=>mesScrollAutoMove(evs,26);
  //window.onbeforeunload=function(event) {event.returnValue="您要离开页面吗？";};
  document.ondblclick=evs=>{if(new_app_3.scriptSwitch.dbClickOpenMenu===true){document.querySelector('.dropDownList').classList.toggle('closed');}};
  // for (let ice=0;ice<document.querySelectorAll('.linkButton').length;ice++){
  //   document.querySelectorAll('.linkButton')[ice].addEventListener('click',function () {clickLinkButton(this)})
  // }
  /**应用层末尾**/
  /**函数层**/

  // //点击登录界面的登录按钮时的效果
  // function clickLinkButton(el) {
  //   //获取点击的元素的id
  //   let nowClickId=el.id;
  //   //获取当前蓝色浮动矩形的所处位置
  //   let linkButton=el.parentElement.lastElementChild;
  //   let linkButtonStatus=linkButton.getAttribute('status');
  //   //初始化status
  //   if(linkButtonStatus==='null' || linkButtonStatus===undefined || linkButtonStatus===null){
  //     el.parentElement.lastElementChild.setAttribute('status','loginBtt');
  //     linkButtonStatus='loginBtt';
  //   }
  //   //位置和点击位置不一致时有操作
  //   if(nowClickId!==linkButtonStatus){
  //     if(linkButtonStatus==='loginBtt'){
  //       linkButton.setAttribute('status','signBtt');
  //       linkButton.style.animation='linkButtonFlex 0.3s ease forwards';
  //       new_app_3.linkPageChange++;
  //       return true;
  //     }
  //     else {
  //       linkButton.setAttribute('status','loginBtt');
  //       linkButton.style.animation='linkButtonFlexOFF 0.3s ease forwards';
  //       console.log(el);
  //       console.log(status+'+clickLink2');
  //       new_app_3.linkPageChange++;
  //       return true;
  //     }
  //   }
  // }
  //通用的清除输入框函数
  function clearEditText(el) {
    el.innerHTML='';
  }
  //自动滚动至底部
  function scrollAuto() {
    setTimeout("document.getElementById('chatMessage').scrollTop=99999999",10);
  }
  //关闭页面时询问确定离开
  function closePage(){
    confirm('您要离开吗？')
  }
  //消息自动滚动至底部,参数1：一个事件对象，参数2：偏移量，越大越敏感
  function mesScrollAutoMove(e,offset){
    try{
      let scrHeight=e.target.scrollHeight;
      let scrTop=e.target.scrollTop;
      let clientHeight=e.target.getBoundingClientRect().height;
      if((scrTop+clientHeight+offset)>=scrHeight){//到底
        new_app_3.scriptSwitch.chatMesAutoScroll=true;
      }else {
        new_app_3.scriptSwitch.chatMesAutoScroll=false;
      }
      new_app_3.SC_log.mesScrollAutoMove.work_num++;
    }catch (e) {
      new_app_3.SC_log.mesScrollAutoMove.error_num++;
      new_app_3.SC_log.mesScrollAutoMove.error_log=e;
    }
  }
  //获取浏览器视窗尺寸
  function getChromeConf() {
    try{
      new_app_3.chromeConf.chromeHeight=document.documentElement.clientHeight;
      new_app_3.chromeConf.chromeWidth=document.documentElement.clientWidth;
      new_app_3.SC_log.getChromeConf.work_num++;
    }catch (e) {
      new_app_3.SC_log.getChromeConf.error_num++;
      new_app_3.SC_log.getChromeConf.error_log=e;
    }
  }
  //设置中部聊天区域与游戏区域的高度；
  function setCentUiHeight(){
    try{
      let chromeWidth=new_app_3.chromeConf.chromeWidth;
      let chatRoomAttributeHeight=document.querySelector(".chatRoomAttribute").offsetHeight;
      let bottomEditHeight=document.querySelector('#bottomEdit').offsetHeight;
      let sum=chromeWidth+chatRoomAttributeHeight;
      document.querySelector(".gameCenter").style.height=chromeWidth+'px';
      document.querySelector(".chatMessage").style.height='calc(100% - '+bottomEditHeight+'px)';
      document.querySelector(".chatMessageAndBottomEdit").style.height='calc(100% - '+sum+'px)';
      new_app_3.SC_log.setCentUiHeight.work_num++;
    }catch (e) {
      new_app_3.SC_log.setCentUiHeight.error_num++;
      new_app_3.SC_log.setCentUiHeight.error_log=e;
    }
  }
  //设置底部输入框与发送按钮的尺寸，参数：浏览器宽度，留白宽度
  function setEditBoxSize(winwidth,offset) {
    try{
      let editBoxW=winwidth-document.querySelector('#sendContent').offsetWidth-offset;
      document.querySelector('#editBox').style.width=editBoxW+'px';
      new_app_3.SC_log.setEditBoxSize.work_num++;
    }catch (e) {
      new_app_3.SC_log.setEditBoxSize.error_num++;
      new_app_3.SC_log.setEditBoxSize.error_log=e;
    }
  }
  //根据开关的isHide属性初始化状态
  function switchInitialization() {
    try{
      let switchButton=document.querySelectorAll('.selectSwitch');
      for(let ix=0;ix<switchButton.length;ix++){
        if(switchButton[ix].lastElementChild.getAttribute('status')=='no'){
          let swO=switchButton[ix].lastElementChild;
          swO.setAttribute('style','margin-left:30px');
          switchButton[ix].setAttribute('style','background:#01c8ff');
        }
      }
    }catch (e) {

    }
  }
  switchInitialization();
  //选择开关
  function switchOn(el) {
    try{
      //获取切换按钮名称
      let switchName=el.getAttribute('switchname');
      let swO=el.lastElementChild;
      let status=swO.getAttribute('status');
      if(status==undefined || status=='yes' || status=='null' || status==null){
        let style=window.getComputedStyle(el).background;
        swO.setAttribute('style','margin-left:30px');
        el.setAttribute('style','background:#01c8ff');
        swO.setAttribute('status','no');
        new_app_3.scriptSwitch[switchName]=!new_app_3.scriptSwitch[switchName]
      }else{
        swO.removeAttribute('style');
        el.removeAttribute('style');
        swO.setAttribute('status','yes');
        new_app_3.scriptSwitch[switchName]=!new_app_3.scriptSwitch[switchName]
      }
      new_app_3.SC_log.switchOn.work_num++;
    }catch (e) {
      new_app_3.SC_log.switchOn.error_num++;
      new_app_3.SC_log.switchOn.error_log=e;
    }
  }
  //窗口变化监听器
  function windowSizeListener(){
    try{
      if(new_app_3.chromeConf.chromeWidth!==document.documentElement.clientWidth){
        //alert_tips('窗口有变化');
        getChromeConf();
      }
      new_app_3.SC_log.windowSizeListener.work_num++;
    }catch (e) {
      new_app_3.SC_log.windowSizeListener.error_num++;
      new_app_3.SC_log.windowSizeListener.error_log=e;
    }
  }
  //获取cookie
  function getCookie(name){
    var reg = RegExp(name+'=([^;]+)');
    var arr = document.cookie.match(reg);
    if(arr){
      return arr[1];
    }else{
      return '';
    }
  }
  //自动登录
  window.onload=function () {
    let username=getCookie('username');
    let password=getCookie('password');
    if(username!=='' && password!==''){
      console.log('1333');
      new_app_3.sendLinkRequest(username,password);
      //new_app_3.alreadyAutoLogin=true;
    }
  };
  /**函数层结束**/
</script>
<script>
  /*控制层-日志*/
  let diary=new Vue({
    el:'#flex',
    data:diary_data,
    methods:{
      /*创建一个text的节点*/
      create_text:function(type){
        if(type==='text'){
          return true
        }
      },
      /*创建一个img的节点*/
      create_img:function(type){
        if(type==='img'){
          return true
        }
      }
    }
  });
  //开启
  function set_in_cookie(qq) {
    let new_ajax=new XMLHttpRequest();
    new_ajax.open('POST',ServerNetworkAddress+'/php/set_in_cookie.php');
    new_ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    new_ajax.send('in_cookie='+qq);
    new_ajax.onreadystatechange=function(){
      if(new_ajax.status===200 && new_ajax.readyState===4){
        if(new_ajax.responseText){
          window.location.href = 'index.php'
        }
      }
    };
    console.log('ok2')
  }
  //判断是否为数组
  function isArray(arr){
    return Object.prototype.toString.call(arr)== '[object Array]';
  }
  //查找QQ
  /*控制层-查找*/
  function find_qq(qq) {
    if(qq.substr(0,3)!=='UID' && qq.substr(0,3)!=='uid' && isNaN(qq.substr(0,3))){
      set_in_cookie(qq);
      console.log('ok')
    }
    else if(qq.substr(0,3)==='UID' || qq.substr(0,3)==='uid'){
      qq=qq.substr(3);
      let is_exist=false;
      let new_ajax=new XMLHttpRequest();
      new_ajax.open('GET',ServerNetworkAddress+'/php/api/public/int_mysql_get_data_sheet.php?game_name=bh3&search_uid='+qq);
      new_ajax.send();
      new_ajax.onreadystatechange=function () {
        if(new_ajax.readyState===4 && new_ajax.status===200){
          let data=(eval(new_ajax.responseText));
          if(data!==undefined){
            //显示查询结果层
            is_exist=true;
            if(document.getElementById('bh3_search').style.display==='none'){document.getElementById('bh3_search').style.display='block'}
            document.getElementById('bh3_search_img').src='http://q.qlogo.cn/g?b=qq&nk='+data[0][2]+'&s=640&mType=friendlist';
            document.getElementById('bh3_search_div').innerHTML="" +
              "Nick-name : "+data[0][3]+"\n" +
              "            <br>\n" +
              "            GameType : BH3\n" +
              "            <br>\n" +
              "            UID : "+data[0][4]+"&nbsp;&nbsp;QQ : "+data[0][2];
          }else {//显示查询无果层
            if(document.getElementById('bh3_search').style.display==='block'){document.getElementById('bh3_search').style.display='none'}
            document.getElementById('bh3_search_img').src='';
            document.getElementById('bh3_search_div').innerHTML="";
          }
        }
      };
      let new_ajax2=new XMLHttpRequest();
      new_ajax2.open('GET',ServerNetworkAddress+'/php/api/public/int_mysql_get_data_sheet.php?game_name=pcr&search_uid='+qq);
      new_ajax2.send();
      new_ajax2.onreadystatechange=function () {
        if(new_ajax2.readyState===4 && new_ajax2.status===200){
          let data=(eval(new_ajax2.responseText));
          if(data!==undefined){
            //显示查询结果层
            is_exist=true;
            if(document.getElementById('pcr_search').style.display==='none'){document.getElementById('pcr_search').style.display='block'}
            document.getElementById('pcr_search_img').src='http://q.qlogo.cn/g?b=qq&nk='+data[0][2]+'&s=640&mType=friendlist';
            document.getElementById('pcr_search_div').innerHTML="" +
              "Nick-name : "+data[0][3]+"\n" +
              "            <br>\n" +
              "            GameType : PCR\n" +
              "            <br>\n" +
              "            UID : "+data[0][4]+"&nbsp;&nbsp;QQ : "+data[0][2];
          }else {//显示查询无果层
            if(document.getElementById('pcr_search').style.display==='block'){document.getElementById('pcr_search').style.display='none'}
            document.getElementById('pcr_search_img').src='';
            document.getElementById('pcr_search_div').innerHTML="";
          }
        }
      };
      let new_ajax3=new XMLHttpRequest();
      new_ajax3.open('GET',ServerNetworkAddress+'/php/api/public/int_mysql_get_data_sheet.php?game_name=ys&search_uid='+qq);
      new_ajax3.send();
      new_ajax3.onreadystatechange=function () {
        if(new_ajax3.readyState===4 && new_ajax3.status===200){
          let data=(eval(new_ajax3.responseText));
          if(data!==undefined){
            //显示查询结果层
            is_exist=true;
            if(document.getElementById('ys_search').style.display==='none'){document.getElementById('ys_search').style.display='block'}
            document.getElementById('ys_search_img').src='http://q.qlogo.cn/g?b=qq&nk='+data[0][2]+'&s=640&mType=friendlist';
            document.getElementById('ys_search_div').innerHTML="" +
              "Nick-name : "+data[0][3]+"\n" +
              "            <br>\n" +
              "            GameType : 原神\n" +
              "            <br>\n" +
              "            UID : "+data[0][4]+"&nbsp;&nbsp;QQ : "+data[0][2];
          }else {//显示查询无果层
            if(document.getElementById('ys_search').style.display==='block'){document.getElementById('ys_search').style.display='none'}
            document.getElementById('ys_search_img').src='';
            document.getElementById('ys_search_div').innerHTML="";
          }
        }
        setTimeout(function () {
          if(is_exist){
            document.getElementById('search_content').style.display='block';
            document.getElementById('search_error').style.display='none'
          }else {
            document.getElementById('search_content').style.display='none';
            document.getElementById('search_error').style.display='block'
          }
        },100)
      };
    }else {
      let is_exist=false;
      let new_ajax=new XMLHttpRequest();
      new_ajax.open('GET',ServerNetworkAddress+'/php/api/public/int_mysql_get_data_sheet.php?game_name=bh3&search_qq='+qq);
      new_ajax.send();
      new_ajax.onreadystatechange=function () {
        if(new_ajax.readyState===4 && new_ajax.status===200){
          let data=(eval(new_ajax.responseText));
          if(data!==undefined){
            //显示查询结果层
            is_exist=true;
            if(document.getElementById('bh3_search').style.display==='none'){document.getElementById('bh3_search').style.display='block'}
            document.getElementById('bh3_search_img').src='http://q.qlogo.cn/g?b=qq&nk='+data[0][2]+'&s=640&mType=friendlist';
            document.getElementById('bh3_search_div').innerHTML="" +
              "Nick-name : "+data[0][3]+"\n" +
              "            <br>\n" +
              "            GameType : BH3\n" +
              "            <br>\n" +
              "            UID : "+data[0][4]+"&nbsp;&nbsp;QQ : "+data[0][2];
          }else {//显示查询无果层
            if(document.getElementById('bh3_search').style.display==='block'){document.getElementById('bh3_search').style.display='none'}
            document.getElementById('bh3_search_img').src='';
            document.getElementById('bh3_search_div').innerHTML="";
          }
        }
      };
      let new_ajax2=new XMLHttpRequest();
      new_ajax2.open('GET',ServerNetworkAddress+'/php/api/public/int_mysql_get_data_sheet.php?game_name=pcr&search_qq='+qq);
      new_ajax2.send();
      new_ajax2.onreadystatechange=function () {
        if(new_ajax2.readyState===4 && new_ajax2.status===200){
          let data=(eval(new_ajax2.responseText));
          if(data!==undefined){
            //显示查询结果层
            is_exist=true;
            if(document.getElementById('pcr_search').style.display==='none'){document.getElementById('pcr_search').style.display='block'}
            document.getElementById('pcr_search_img').src='http://q.qlogo.cn/g?b=qq&nk='+data[0][2]+'&s=640&mType=friendlist';
            document.getElementById('pcr_search_div').innerHTML="" +
              "Nick-name : "+data[0][3]+"\n" +
              "            <br>\n" +
              "            GameType : PCR\n" +
              "            <br>\n" +
              "            UID : "+data[0][4]+"&nbsp;&nbsp;QQ : "+data[0][2];
          }else {//显示查询无果层
            if(document.getElementById('pcr_search').style.display==='block'){document.getElementById('pcr_search').style.display='none'}
            document.getElementById('pcr_search_img').src='';
            document.getElementById('pcr_search_div').innerHTML="";
          }
        }
      };
      let new_ajax3=new XMLHttpRequest();
      new_ajax3.open('GET',ServerNetworkAddress+'/php/api/public/int_mysql_get_data_sheet.php?game_name=ys&search_qq='+qq);
      new_ajax3.send();
      new_ajax3.onreadystatechange=function () {
        if(new_ajax3.readyState===4 && new_ajax3.status===200){
          let data=(eval(new_ajax3.responseText));
          if(data!==undefined){
            //显示查询结果层
            is_exist=true;
            if(document.getElementById('ys_search').style.display==='none'){document.getElementById('ys_search').style.display='block'}
            document.getElementById('ys_search_img').src='http://q.qlogo.cn/g?b=qq&nk='+data[0][2]+'&s=640&mType=friendlist';
            document.getElementById('ys_search_div').innerHTML="" +
              "Nick-name : "+data[0][3]+"\n" +
              "            <br>\n" +
              "            GameType : 原神\n" +
              "            <br>\n" +
              "            UID : "+data[0][4]+"&nbsp;&nbsp;QQ : "+data[0][2];
          }else {//显示查询无果层
            if(document.getElementById('ys_search').style.display==='block'){document.getElementById('ys_search').style.display='none'}
            document.getElementById('ys_search_img').src='';
            document.getElementById('ys_search_div').innerHTML="";
          }
        }
        setTimeout(function () {
          if(is_exist){
            document.getElementById('search_content').style.display='block';
            document.getElementById('search_error').style.display='none'
          }else {
            document.getElementById('search_content').style.display='none';
            document.getElementById('search_error').style.display='block'
          }
        },100)
      };
    }
  }
  //星星动画
  /*特效层*/
  var star_disappear_time=1;//设定星星逐渐消失的时间秒
  var star_life_cycle_max=8;//设定星星的生命周期最大值秒
  var star_life_cycle_min=2;//设定星星的生命周期最小值秒
  var stars_id=1;
  var window_width=window.innerWidth * 2.2;//设定顶部的left最大值
  var special_effects_layer=document.getElementById('special_effects_layer');
  function creat_stars() {
    var new_img=document.createElement('img');
    new_img.src='img/stars1.png';
    new_img.style.width='20px';
    new_img.style.height='20px';
    new_img.style.position='fixed';
    //设置初始位置(random,-30px)
    var left=randomNum(40,window_width);
    var top=-30;
    new_img.style.left=left+'px';
    new_img.style.top=top+'px';
    new_img.className='stars';
    new_img.id=''+stars_id;
    special_effects_layer.appendChild(new_img);//添加星星
    stars_move(document.getElementById(""+stars_id),randomNum(star_life_cycle_min*100,star_life_cycle_max*800));//移动星星，设置在多少秒内消失，给予初始位置
    stars_id++;
  }
  //随机函数
  function randomNum(minNum,maxNum){
    switch(arguments.length){
      case 1:
        return parseInt(Math.random()*minNum+1,10);
        break;
      case 2:
        return parseInt(Math.random()*(maxNum-minNum+1)+minNum,10);
        break;
      default:
        return 0;
        break;
    }
  }
  //移动星星
  function stars_move(el,time) {
    //不断移动星星
    for(let x=0;x<=time;x++){
      setTimeout(function () {
        el.style.left=(parseInt(el.style.left)-5)+'px';
        el.style.top=(parseInt(el.style.top)+5)+'px'
      },20*x);
    }
    //设定逐渐消失
    setTimeout(function () {
      try {
        el.style.animation='star_die '+star_disappear_time+'s forwards ';
      }catch (e) {
        el.style.webkitAnimation='star_die '+star_disappear_time+'s forwards ';
      }
    },time-(star_disappear_time*1000));
    //定时删除星星
    setTimeout(function () {
      try{el.parentNode.removeChild(el);}catch (e) {
        console.log('删除错误:'+e);
      }
    },time);
  }
  //setInterval('creat_stars()',2500);禁用2021/8/12-21:33
  function randomNum(minNum,maxNum){//随机函数
    switch(arguments.length){
      case 1:
        return parseInt(Math.random()*minNum+1,10);
        break;
      case 2:
        return parseInt(Math.random()*(maxNum-minNum+1)+minNum,10);
        break;
      default:
        return 0;
        break;
    }
  }
  try{
    try {
      var number=randomNum(1,50);
      var img1=document.getElementById('img1');
      img1.src=ServerNetworkAddress+'/thumbnail/'+number+'.jpg';
    }catch (e) {

    }
    var everybody=[2120420179,848490694,3539438185,1272602352,2774767237,1612675488,1365264810,2843599260,2647910435,1753492785,2081618670,2081618670,805258120,1348479725,1961706345,1658548955,2795732614,848688381,824822765,3361577961,997509742,2192680130,2496779165,2746853534,811592290,162295994,1269317054,1763844244,2964607609,961060863,1369392718,857626943,1581182597,1743939852,3103945871,575716004,1152070902,2987594236,2393493189,1804294850,791015206,1304676898,1753563708,1763123826,1554382747,2532565023,2540965410,3225128687,1786802842,2926301302,1559244914,3536860773,1301071923,335446283,714934085];
    var qq=randomNum(1,everybody.length-1);
    var img2=document.getElementById('img2');
    img2.src='http://q.qlogo.cn/g?b=qq&nk='+everybody[qq]+'&s=640&mType=friendlist';
    var pcr_everybody=[1658548955,811592290,979835838,1348479725,2964607609,2746853534,1961706345,1418129774,568869676,2821845085,2924319834,2339711851];
    var qq2=randomNum(1,pcr_everybody.length-1);
    img3=document.getElementById('img3');
    img3.src='http://q.qlogo.cn/g?b=qq&nk='+pcr_everybody[qq2]+'&s=640&mType=friendlist';
    var ys_everybody=[1658548955,979835838,1961706345,1369392718,2339711851,2604239337,2924319834,2994792337,335446283,162295994,1348479725,1554382747,1763123826,2647910435];
    var qq3=randomNum(1,ys_everybody.length-1);
    img4=document.getElementById('img4');
    img4.src='http://q.qlogo.cn/g?b=qq&nk='+ys_everybody[qq3]+'&s=640&mType=friendlist';
  }catch (e) {

  }
</script>
<script>
  //资讯层
  var datas=[];
  var news=new Vue({
    el:'#news_layer',
    data:{datas:[
        {bh3_game_id: "加载中"},
        {bh3_group_nickname: "加载中"},
        {bh3_qq_id: "1077365277"},
        {pcr_game_id: "加载中"},
        {pcr_group_nickname: "加载中"},
        {pcr_qq_id: "1077365277"},
        {ys_game_id: "加载中"},
        {ys_group_nickname: "加载中"},
        {ys_qq_id: "1077365277"},
      ]}
  });
  //获取最新成员信息
  function get_new_player() {
    let new_ajax=new XMLHttpRequest();
    new_ajax.open('GET',ServerNetworkAddress+'/php/api/public/int_mysql_select_new_data.php?sheet_name=all',true);
    new_ajax.send();
    new_ajax.onreadystatechange=function (){
      if(new_ajax.readyState===4 && new_ajax.status===200){
        news.datas=datas=eval(new_ajax.responseText)
      }
    }
  }
  get_new_player();
</script>
</body>
</html>