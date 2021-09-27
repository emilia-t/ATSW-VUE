<template>
  <!--根节点-->
  <div class="app">
    <background-page></background-page>
    <top-page :face_data="my_face_data"></top-page>
    <content-page></content-page>
  </div>
</template>

<script>
//引入topPage
import TopPage from "./topPage";
import contentPage from "./contentPage";
import backgroundPage from "./backgroundPage";

export default {
  name: "app",
  data(){
    return{
        public__public:[],
        private__private:[],//用于存放私人数据
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
          "user_qq": "10",
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
    }
  },
  components:{
    TopPage,
    // eslint-disable-next-line vue/no-unused-components
    contentPage,
    backgroundPage,
  }
}
</script>

<style scoped>

  .app{width: 100%;height: auto;display: flex;justify-content: center  ;align-items: center;flex-direction: column}
  a:link {
    text-decoration: none;
    color: #ff979b;
  };
  a:-webkit-any-link {
    color: -webkit-link;
    cursor: pointer;
    text-decoration: underline;
  }
  a:link {color: blue;text-decoration: underline;} /* 未被访问的链接 蓝色 */
  a:visited {color: blue;text-decoration: underline;} /* 已被访问过的链接 蓝色 */
  a:hover {color: blue;text-decoration: underline;} /* 鼠标悬浮在上的链接 蓝色 */
  a:active {color: blue;text-decoration: underline;} /* 鼠标点中激活链接 蓝色 */
  a {
    text-decoration: none;
  }

  .router-link-active {
    text-decoration: none;
  }

</style>