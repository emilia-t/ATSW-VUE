<template>
    <div class="diaryApp">
        <div style="display: none">
            <img src="../../static/img/icon/round.png">
        </div>
        <!--预览层-->
        <transition name="frame">
            <div id="show_frame" v-show="show_show_frame"><!--显示相应的事件的框架-->
                <div id="frame_time_type"><!--时间及类型-->
                </div>
                <div id="frame_content"><!--部分内容前20个字-->
                </div>
            </div>
        </transition>
        <transition name="triangle">
            <div id="triangle" v-show="show_show_frame"><!--小三角-->
            </div>
        </transition>
        <!--时间轴层-->
        <div id="time_axis">
            <img src="../assets/img/diary/axis.png" id="axis" ref="axis" draggable="false"  style="top: 47.04px;height:666.4px;width:3px">
            <img class="round" id="round" src="../assets/img/diary/round_2.png" draggable="true" @drag.prevent="move()" @dragend.prevent="moveEnd()">
        </div>
        <!--视图层-->
        <div id="flex" draggable="false">
            <div class="outline" id="outline" v-for="diary in diaryListReverse" @mouseover="round_top_change($event.fromElement)" ><!--单个日志-->
                <div class="date"><!--时间及类型-->
                    <b>{{diary.time.year}}年{{diary.time.month}}月{{diary.time.day}}日{{diary.time.hours}}时{{diary.time.minute}}分({{diary.type}})</b>
                </div>
                <div class="content" v-for="diary_content  in diary.content"><!--内容---->
                    <div class="text" v-if="create_text(diary_content.type)">
                        <p v-html="diary_content.text"></p>
                    </div>
                    <div class="img_div" v-if="create_img(diary_content.type)">
                        <img draggable="false" class="img" :src="diary_content.text">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "diaryApp",
        data(){
            return{
                public__public:[],
                private__private:[],//用于存放私人数据
                list:[
                    {
                        "time": {
                            "year": "2020",
                            "month": "04",
                            "day": "05",
                            "hours": "10",
                            "minute": "54"
                        },
                        "type": "群科技",
                        "content": [
                            {
                                "text": "神选者添加首位聊天机器人“<b>蒂法利</b>”，功能主要为聊天，查询图片，播放音乐，舔狗日志，翻译，简单提醒。神选者添加首位聊天机器人“蒂法利”，功能主要为聊天，查询图片，播放音乐，舔狗日志，翻译，简单提醒。",
                                "type": "text"
                            },
                            {
                                "text": '0.jpg',
                                "type": "img"
                            }
                        ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "04",
                            "day": "17",
                            "hours": "16",
                            "minute": "00"
                    },
                        "type": "PCR",
                        "content": [
                        {
                            "text": "PCR简体中文版正式开服，同日「大枫树」工会成立，会长临冉，副会长正义的伙伴、玄武纪师，注：后日工会更名为「在星空枯萎之后」。",
                            "type": "text"
                        },
                        {
                            "text": "1.jpg",
                            "type": "img"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "04",
                            "day": "29",
                            "hours": "12",
                            "minute": "00"
                    },
                        "type": "PCR",
                        "content": [
                        {
                            "text": "PCR玩家正式开始流入本群。",
                            "type": "text"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "06",
                            "day": "25",
                            "hours": "10",
                            "minute": "00"
                    },
                        "type": "BH3",
                        "content": [
                        {
                            "text": "牙衣夏日零食补给投放活动开始。",
                            "type": "text"
                        },
                        {
                            "text": "2.jpg",
                            "type": "img"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "06",
                            "day": "28",
                            "hours": "17",
                            "minute": "46"
                    },
                        "type": "群科技",
                        "content": [
                        {
                            "text": "小兔添加全新抽卡模拟机器人“yami-bate”，功能主要为模拟抽卡，抽签，解签，点歌，看图(随机图片)。",
                            "type": "text"
                        },
                        {
                            "text": "3.jpg",
                            "type": "img"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "07",
                            "day": "06",
                            "hours": "11",
                            "minute": "00"
                    },
                        "type": "PCR",
                        "content": [
                        {
                            "text": "PCR版本更新至2.4.7，更新内容为：追加角色伊莉雅，等级上限升至95，剧情活动「吸血鬼猎人 With 伊莉雅」开启。",
                            "type": "text"
                        },
                        {
                            "text": "4.jpeg",
                            "type": "img"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "07",
                            "day": "09",
                            "hours": "16",
                            "minute": "00"
                    },
                        "type": "BH3",
                        "content": [
                        {
                            "text": "BH34.1版本[雷鸣彻空]发布，主要内容为新增雷之律者，人偶-贝拉，夏日活动「双子：入侵」，主线18章-凝自冰霜，新武器：「天殛之钥」、「天殛之境：裁决」新圣痕：「贝纳勒斯·觉醒」，登陆送磁暴，3rd，妖刀，雨誓其中之一。",
                            "type": "text"
                        },
                        {
                            "text": "5.jpeg",
                            "type": "img"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "07",
                            "day": "10",
                            "hours": "11",
                            "minute": "42"
                    },
                        "type": "BH3",
                        "content": [
                        {
                            "text": "雷律扩充律池子开放前备，“710追梦大赛”开始，抽卡选手：君寻、雪泣、小兔、木之川、今生缘。围观群众：临冉、叫我全保底、咲酱、正义。11点58临冉点歌好运来。抽卡结果：雪泣10连出货，围观区送出“问号风暴”。木之川声称单抽天王倒闭，未出，保底否乃后事，未知。君寻三十连未出货。小兔代抽接近保底出货。今生缘保底出货。",
                            "type": "text"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "07",
                            "day": "11",
                            "hours": "04",
                            "minute": "00"
                    },
                        "type": "PCR",
                        "content": [
                        {
                            "text": "兰德索尔杯短跑障碍运动赛开启，游戏内将开展「第1回兰德索尔杯特别登录奖励活动」。",
                            "type": "text"
                        },
                        {
                            "text": "6.jpeg",
                            "type": "img"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "07",
                            "day": "16",
                            "hours": "11",
                            "minute": "20"
                    },
                        "type": "群科技",
                        "content": [
                        {
                            "text": "临冉发布资料表全新「浪尖伏入」版本，更新内容为：全新夏至UI界面，小游戏“跑马灯”，内置夏活BGM。",
                            "type": "text"
                        },
                        {
                            "text": "7.png",
                            "type": "img"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "07",
                            "day": "16",
                            "hours": "18",
                            "minute": "00"
                    },
                        "type": "BH3",
                        "content": [
                        {
                            "text": "BH3德莉莎·暴食(上)被收回返还300水及材料。",
                            "type": "text"
                        },
                        {
                            "text": "8.jpg",
                            "type": "img"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "07",
                            "day": "28",
                            "hours": "05",
                            "minute": "00"
                    },
                        "type": "PCR",
                        "content": [
                        {
                            "text": "“巨蟹座”行会团队战开战。",
                            "type": "text"
                        },
                        {
                            "text": "9.jpg",
                            "type": "img"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "07",
                            "day": "29",
                            "hours": "19",
                            "minute": "08"
                    },
                        "type": "PCR",
                        "content": [
                        {
                            "text": "公会战(04期)一周目末，BOSS巨蟹(加尔基诺斯)，最高BOSS单刀伤害数据：总伤害：96万4854；创立者：吸血鬼德丽喵(ID:1252***0720)；配置：香织(406265)，亚里莎(244764)，日和莉(138340)，真琴(103090)，深月(72395)，另，尾刀：空条承太郎(ID:1035***2773)。",
                            "type": "text"
                        },
                        {
                            "text": "10.png",
                            "type": "img"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "07",
                            "day": "30",
                            "hours": "11",
                            "minute": "00"
                    },
                        "type": "BH3",
                        "content": [
                        {
                            "text": "★夏日偶像武斗会★活动开启。",
                            "type": "text"
                        },
                        {
                            "text": "11.jpeg",
                            "type": "img"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "08",
                            "day": "02",
                            "hours": "18",
                            "minute": "25"
                    },
                        "type": "BH3",
                        "content": [
                        {
                            "text": "「夏日偶像武斗会」中，D组小组赛，姬子vs渡鸦，芽衣vs姬子，出现异常显示胜负结果，补偿方式为不论被应援方输赢均按胜方倍率返还应援票，全服发放60水晶。",
                            "type": "text"
                        },
                        {
                            "text": "12.png",
                            "type": "img"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "08",
                            "day": "03",
                            "hours": "14",
                            "minute": "00"
                    },
                        "type": "PCR",
                        "content": [
                        {
                            "text": "PCR限定角色 ★3「佩可莉姆（夏日）」登场！剧情活动「危险假日」开启，主要掉落可可罗（夏日）以及咲恋角色碎片，游戏内将同时开启「佩可莉姆（夏日）」 PICK UP扭蛋活动。",
                            "type": "text"
                        },
                        {
                            "text": "13.png",
                            "type": "img"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "08",
                            "day": "15",
                            "hours": "19",
                            "minute": "48"
                    },
                        "type": "BH3",
                        "content": [
                        {
                            "text": "<p>4.2版本预览直播，部分玩家不满(此时4.2版本未正式发布,评价可能不够客观)</p><p>不满以下几点：</p><p><b>一，深渊改版，段位机制</b></p><p>新版深渊终极区引入了类似moba类游戏那样的段位机制（天梯、排位）。每20人一组，组内排名一人一段（就是相互背刺）。按照排名给予奖杯，每赛季（每2个版本为1个赛季）将根据舰长在当前赛季的深渊段位发放相应数量的水晶奖励，并按照以下规则决定舰长在下一赛季的初始段位。</p>",
                            "type": "text"
                        },
                        {
                            "text": "16.jpg",
                            "type": "img"
                        },
                        {
                            "text": "17.jpg",
                            "type": "img"
                        },
                        {
                            "text": "<p>1、排位段位制，需要花费更多精力在升段位上。</p><p>2、关卡内的小怪积蓄值，濒死盾，BOSS层塞被克制小怪，强推月魄，明写了投技可打断，拉长战斗时间，锁角色，且角色必须毕业才有的一战否则就是刮痧。多样的天气系统代表多样的毕业角色。</p><p>3、层次分得更细。咸鱼是不可能咸鱼了，以前摸一下就能保级或者当红莲升降机的时代过去了。继承机制下不老老实实凹分连低保都没了。</p><p><b>二，重新定义可肝</b></p><p>新加入的可肝圣痕，舰长可以通过直接锻造或者圣痕转化的方式进行获取，“肝爆”。</p>",
                            "type": "text"
                        },
                        {
                            "time": {
                                "year": "2020",
                                "month": "08",
                                "day": "16",
                                "hours": "23",
                                "minute": "00"
                            },
                            "type": "群聊",
                            "content": [
                                {
                                    "text": "14.jpg",
                                    "type": "img"
                                },
                                {
                                    "text": "15.jpg",
                                    "type": "img"
                                }
                            ]
                        },
                        {
                            "text": "18.jpg",
                            "type": "img"
                        },
                        {
                            "text": "<p><b>三，作战凭证更新，大月卡时代。</b></p>",
                            "type": "text"
                        },
                        {
                            "text": "大月卡价值128，从4.2版本开始，每4个版本的作战凭证将绑定成为一个主题，产出新的道具【迷失纯晶】（紫），可用于兑换幻夜迷迭的圣痕和角色碎片。旧版【光辉纯晶】则可以兑换返场的武器圣痕或者按比例兑换新版结晶。",
                            "type": "text"
                        },
                        {
                            "text": "19.jpg",
                            "type": "img"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "08",
                            "day": "18",
                            "hours": "09",
                            "minute": "12"
                    },
                        "type": "群聊",
                        "content": [
                        {
                            "text": "关于4.2版本的直播间发生的事情的讨论",
                            "type": "text"
                        },
                        {
                            "text": "20.jpg",
                            "type": "img"
                        },
                        {
                            "text": "21.jpg",
                            "type": "img"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "08",
                            "day": "20",
                            "hours": "01",
                            "minute": "00"
                    },
                        "type": "BH3",
                        "content": [
                        {
                            "text": "<p>BH34.2版本「失落迷迭」发布，主要内容为：</p><p>新S级女武神丽塔“失落迷迭”登陆战场</p><p>神陨剑、劫灭超限，影舞冲击增幅</p><p>新主题作战凭证</p><p>冰之律者圣痕(获取途径：装备升变系统)</p><p>黑鸭新服装</p><p>深渊终极区「超弦空间」......</p>",
                            "type": "text"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "08",
                            "day": "23",
                            "hours": "14",
                            "minute": "00"
                    },
                        "type": "PCR",
                        "content": [
                        {
                            "text": "<p>例行维护，本次维护更新内容如下：</p><p>1，开启新的地下城「沧海的孤塔」</p><p>2，第五期狮子座工会战内容。</p>",
                            "type": "text"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "08",
                            "day": "24",
                            "hours": "05",
                            "minute": "00"
                    },
                        "type": "PCR",
                        "content": [
                        {
                            "text": "05期(狮子座)工会战开始，地下城开启",
                            "type": "text"
                        },
                        {
                            "text": "22.jpg",
                            "type": "img"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "08",
                            "day": "24",
                            "hours": "13",
                            "minute": "00"
                    },
                        "type": "BH3",
                        "content": [
                        {
                            "text": "终极区深渊「超弦空间」关闭",
                            "type": "text"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "08",
                            "day": "25",
                            "hours": "21",
                            "minute": "41"
                    },
                        "type": "PCR",
                        "content": [
                        {
                            "text": "公会战(05期)一周目末，BOSS狮王(炎吼狮王)，最高BOSS单刀伤害数据：总伤害：129万3324；创立者：吸血鬼德丽喵(ID:1252***0720)；配置：香织(608687)，亚里莎(307494)，真琴(212717)，深月(121500)，可可罗夏日(42926)，另，尾刀：老公(ID:1269***4893)。",
                            "type": "text"
                        },
                        {
                            "text": "23.jpg",
                            "type": "img"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "08",
                            "day": "30",
                            "hours": "11",
                            "minute": "00"
                    },
                        "type": "PCR",
                        "content": [
                        {
                            "text": "<p>例行维护：</p><p>1. 追加新角色★1「美冬（夏日）」，★3「凯露（夏日）」</p><p>2. 开启「凯露（夏日）」PICK UP扭蛋</p><p>3. 上架豪华扭蛋券礼包</p><p>4. 开启「★3必得白金扭蛋」</p><p>5. 开启剧情活动「珠希与美冬的无人岛0金币生活」</p>",
                            "type": "text"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "08",
                            "day": "31",
                            "hours": "16",
                            "minute": "00"
                    },
                        "type": "BH3",
                        "content": [
                        {
                            "text": "由于超弦空间部分关卡敌人存在异常，临时关闭19:00开启",
                            "type": "text"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "09",
                            "day": "08",
                            "hours": "18",
                            "minute": "46"
                    },
                        "type": "群科技",
                        "content": [
                        {
                            "text": "临冉发布“群日志”，功能为：展览自2020年4月以来群内，游戏内发生的事情（主要或影响较深的）",
                            "type": "text"
                        },
                        {
                            "text": "24.jpg",
                            "type": "img"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "09",
                            "day": "10",
                            "hours": "08",
                            "minute": "01"
                    },
                        "type": "PCR",
                        "content": [
                        {
                            "text": "临冉用四张抽奖券获得了「凯露夏日」，欧气满满，特此纪念。",
                            "type": "text"
                        },
                        {
                            "text": "25.jpg",
                            "type": "img"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "09",
                            "day": "14",
                            "hours": "21",
                            "minute": "02"
                    },
                        "type": "PCR",
                        "content": [
                        {
                            "text": "<p>“正义的伙伴”副会长被卸任，2日后“吸血鬼德丽喵任职”</p><p>（仅记录事件请勿多言）</p><p>未在副会长事先向会长声明理由的情况下，按以下标准执行：</p><p>副会长连续4日未登录则自动卸任，卸任后2日内职位保留，若期间再次登陆则继续任职，否则将被开除工会，空缺的职位将由在副会长卸任期间内按活跃度、全角色战力等数据最优的成员任职。</p>",
                            "type": "text"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "09",
                            "day": "15",
                            "hours": "09",
                            "minute": "00"
                    },
                        "type": "YS",
                        "content": [
                        {
                            "text": "YSPC版技术性开放测试(不删档)开始，群内逐渐有人加入YS的世界。",
                            "type": "text"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "09",
                            "day": "22",
                            "hours": "04",
                            "minute": "00"
                    },
                        "type": "PCR",
                        "content": [
                        {
                            "text": "工会战(06期)“处女座”开始，BOSS为：双足飞龙→野性狮鹫→幽灵领主→独眼巨人→美杜莎",
                            "type": "text"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "10",
                            "day": "01",
                            "hours": "21",
                            "minute": "57"
                    },
                        "type": "PCR",
                        "content": [
                        {
                            "text": "“重装小兔05号机”副会长被开除(主动提出)，由“空条承太郎”任职。",
                            "type": "text"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "10",
                            "day": "15",
                            "hours": "00",
                            "minute": "00"
                    },
                        "type": "PCR",
                        "content": [
                        {
                            "text": "普通关卡玛那及掉落物3倍掉落开始，为期5日。",
                            "type": "text"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "10",
                            "day": "17",
                            "hours": "14",
                            "minute": "01"
                    },
                        "type": "YS",
                        "content": [
                        {
                            "text": "发现(三测似乎已出现)YS“超载施肥”bug。当使用丽莎攻击火花(烈焰花)时会产生超载现象，超载会引发范围爆炸，爆炸会使得附近草丛产生震荡(效果类似于角色挥砍草丛)，且草丛不会因此消失，从而起到刷取蜥蜴尾巴、蛋、松茸的目的，刷取地点主要为铭记之谷左侧和北风之狼的庙宇左下侧地点。",
                            "type": "text"
                        },
                        {
                            "text": "26.png",
                            "type": "img"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "10",
                            "day": "20",
                            "hours": "18",
                            "minute": "00"
                    },
                        "type": "YS",
                        "content": [
                        {
                            "text": "<p>第一届YS抽卡欧皇大赛“1020追莉大赛”</p><p>YS可莉池子开放前备，“1020追莉大赛”即将开始，离18点还差3分钟一位名叫咲酱的选手便已摩拳擦掌，让我们拭目以待，期待他的表现。几分钟后，18点这一神圣的时刻终于来临，选手们迅速的进入了量子叠加状态，毫不吝啬的开启了“单抽之力”“献祭小兔”“上上签”“金盆洗手”等各种nb的技能，观众席见状皆是一片惊呼，大喊tql！</p><p>下面我们把时间交给解说席</p><p>男解说：好的，本场比赛由临冉独家赞助，废话不多说，让我们把目光对准赛场。我们看到匿名选手【】空白，一言不语，淡淡的抛出一张截图，截图上显示——可莉,女仆,女仆,后略；ohhhh，实在是太强了！果不其然，即便是来到了三次元的世界，空白的实力也依然是傲决群雄啊！</p><p>女解说：哎，这个小兔似乎也要开始了，让我们拭目以待吧。</p><p>男解说：实话说，我就是来看小兔抽卡的。</p><p>女解说：啊，是吗，那看上去你对他很有信心呢。</p><p>男解说：那是当然！没有人比我更懂小兔了，哎，小兔给出了截图，让我们看看，啊！怎么会。。小兔选手似乎出现了一些失误，不过没关系，机会还有！</p><p>女解说：哎，我们看到，小兔选手这一波保底了一个四星弓——绝玄，不错的运气，让我们期待一下他的后续表现。</p><p>赛场上，小兔:“好”。</p><p>男解说：小兔又抛出截图了，让我们看看结果，emmm，两紫，不亏。</p><p>女解说：小兔选手这波抽到了两个已有角色，女仆和行秋，行秋这名角色在综和实力上来看是属于第一梯队的，可以增加一命，的确是不亏，但没有出可莉，也是挺遗憾的，不知道他还能否在鼓起勇气，继续抽下去呢。</p><p>男解说：这是必须的，我自认识小兔以来，就从来没有看见他轻言放弃过，这就是为什么我对小兔有信心！</p><p>女解说：哦，原来你和小兔选手是认识得嘛？</p><p>男解说：是啊！老相识了。哦！小兔动了。</p><p>女解说：欸，果不其然，小兔选手又给出了一张截图，看来他果然是一位不轻易放弃的选手。让我们看看，结果如何，额，这次看来是保底了一把西风猎弓，这运气怎  么  说  呢，不算太好吧。</p><p>观众席：\"好\"。</p><p>现场骚动起来。</p><p>女解说：“男解说，你去哪？他刚才又抛出了截图。”</p><p>男解说：“小兔吐了，我要去帮他！他不能就这么放弃！”</p><p>男解说含泪离开了解说席。</p><p>女解说：“啊这。。咳咳，让我们看看小兔选手这次的成绩如何——砂糖保底，好吧是new，已经不错了，我觉得差不多可以了，再抽下去可不妙啊。”</p><p>赛场上，男解说不顾裁判的阻拦一股脑冲了进去，扶起了瘫倒在地的小兔。</p><p>“小兔，你不能就这么倒下啊！！！(#`O′)喂！清醒一点，你要是放弃了，保底就给凝光那大胸女抢走了！！！你的萝莉意志哪去了？？喂！”</p><p>......</p><p>女解说：“额，请大家不要在意赛场，让我们继续看看其他选手的表现，哎，不对？小兔。。小兔选手竟然又站起来了，这。。他要干嘛？他难道还要继续抽卡吗？不会吧！真的抽下去了，难以置信，小兔选手再次站了起来，让我们拭目以待：哦买噶，是金色，是金色传说，可莉出了，以及一命香菱，这就是大佬吗，不服输，不轻言。实在是太厉害了！”</p><p>男解说疯了一般跑回解说席：“看到没有！这叫什么？这叫实力！哈哈哈哈.....哎，拉我干嘛？”</p><p>男解说被保安五花大绑请出了会场。</p><p>女解说：“额，请大家不要在意，让我们继续看看其他选手的表现。”</p><p>突然，裁判举起黄牌吹响了口哨：“空白选手赛前已抽79发，小兔选手赛前抽了11发，这会影响最终结果，以上。”</p><p>女解说：“好的，比赛继续，让我们看下位选手的表现，咲酱选手似乎时运不佳，仅得到了一命砂糖便放弃了比赛，留了46保底，看来这是一位稳健型选手呢。栞酱选手一凝光两砂糖，也是没有走到最后，没能抽到可莉。丹枫选手20发行秋，砂糖，不错的成绩，可惜依然没能走到最后。”</p><p>比赛结束，小兔选手荣获宝冠，空白选手荣获亚军，其余选手荣获鼓励奖。</p><p>女解说：“至此，第一届ATSWYS抽卡大赛总决赛完美结束，感谢各位嘉宾的到来，让我们下次再会！！”</p>",
                            "type": "text"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2020",
                            "month": "11",
                            "day": "11",
                            "hours": "11",
                            "minute": "00"
                    },
                        "type": "YS",
                        "content": [
                        {
                            "text": "<p>YS1.1版本正式发布，更新内容如下：</p><p>新加角色：公子、迪奥娜</p><p>新加武器：法器-尘世之锁5星、长枪-贯虹之塑5星、大剑-无工之剑5星、长枪-宗室猎枪4星</p><p>新的剧情：魔神任务第一章-第三幕 ：迫近的客星、传说任务：鲸天之章</p><p>主题活动：未归的熄星（可获得断罪皇女）</p><p>全新系统：城市声望系统，获得声望，得到声望小道具（风/岩神瞳共鸣石、便携营养带、捕风瓶、口袋锚点、浓缩树脂、寻仙的美食家、风/岩之寻宝罗盘）</p><p>其他：新的名片（蒙德-英名、蒙德-祝愿、璃月-千帆、璃月-云间）、食谱（北地苹果焖肉、冒险家蛋堡、月亮派、金丝虾球、莲花酥、天枢肉）、风翼（苍天清风之翼、金琮天行之翼）、探索度系统、图鉴系统、角色图鉴系统。</p>",
                            "type": "text"
                        }
                    ]
                    },
                    {
                        "time": {
                        "year": "2021",
                            "month": "08",
                            "day": "12",
                            "hours": "22",
                            "minute": "20"
                    },
                        "type": "日常",
                        "content": [
                        {
                            "text": "<p>（申明）</p><p>【谨言慎行，禁止向此事件的相关人物发表任何有关此事件的任何恶意评价】</p><p>（事件）</p><p>事件由B引出，原话如下：“关于拉入我黑名单还能出现(注释:指代JR)在我首页这件事。**，你什么时候死啊？”，随后M与B展开与JR相关的较激讨论，相关要素有“麦克风，梗，你**谁啊？”，两人均被临冉禁言10分钟。</p><p>（影响）</p><p>有史以来除临冉(其人是向小兔申请的禁言，用以专注于学习)以外第一次由不当言论而产生的禁言现象。</p><p>（后续）</p><p>禁言结束后M立刻承认了错误，并表述了自己的观点，原话经处理如下：“我的错是我急了，只希望对于被引流的人不要对******这么大的恶意，我以前也是被引流的，批判当然没问题，我看******，自己看也没引过流，发过一些沙雕二创，应该不算引流吧。关于*圈我没看过，也没发表过看法，莫名其妙被代表，拉出来批评就感觉挺气的。”，之后，其他管理员及成员出面安抚情绪、转移话题。</p><p>（作用）</p><p>依据本次事件，告诫各位和睦相处，避免讨论引战话题！</p>",
                            "type": "text"
                        }
                    ]
                    }
                ],
                show_show_frame:false,
                all_interval:new Array(),
                initial_time:1586055240,//初始时间
                axis_top_config:new Array(),//时间轴节点数据
                now_round_top_value:0,//当前小球的高度
                now_axis_height:0,//当前时间轴的高度
                now_round_min_top_value:0,//小球在最顶部的高度
                now_px_to_hours:0,//当前时间戳每像素对应的秒数
                window_height:0,
                window_width:0,
                //flex_scroll_max:this.flex.scrollHeight-this.flex.offsetHeight//flex的scroll最大值
            }
        },
        computed:{
            diaryListReverse(){
                this.list.reverse();
                return this.list
            },
        },
        mounted: function () {
            this.reFishDom();
        },
        methods:{
            round_top_change(diary_element) {
                this.round.style.transition='0.4s';
                for(let i=0;i<this.outline.length;i++){
                    if(diary_element==this.outline[i]){
                        this.round.style.top=(this.axis_top_config[i]+this.window_height*0.1)+'px';
                    }
                }
            },
            reFishDom: function () {
                this.round=document.getElementById('round');
                this.axis=document.getElementById('axis');
                this.flex=document.getElementById('flex');
                this.show_frame=document.getElementById('show_frame');
                this.triangle=document.getElementById('triangle');
                this.frame_time_type=document.getElementById('frame_time_type');
                this.frame_content=document.getElementById('frame_content');
                this.outline=document.getElementsByClassName('outline');
                this.getChromeSize();
                this.setAxisStyle();
                this.setAxisNode();
            },
            //初始化浏览器窗口尺寸
            getChromeSize(){
                this.window_height=window.innerHeight;
                this.window_width=window.innerWidth;
            },
            //设置轴样式（初始化和窗口改变时用）
            setAxisStyle(){
                //轴体顶部距离浏览器视窗高度为10%+10px
                //球体直径24px
                this.axis.setAttribute('style','height:'+this.window_height*0.8+'px;width:3px;top:'+(this.window_height*0.1+10)+'px');
                this.round.setAttribute('style','height:24px;width:24px;top:'+(this.window_height*0.1+10-12)+'px');
            },
            getUnixTimeStamp(year,month,day,hour,minute,second){
                return (Date.parse(new Date(year+'-'+month+'-'+day+' '+hour+':'+minute+':'+second)))/1000
            },
            //设置轴体节点数据（初始化和窗口改变时用）
            setAxisNode(){
                //1计算轴体时间抽象长度
                let firstDate=this.list[0].time;
                let lastDate=this.list[this.list.length-1].time;
                //1.2转化为时间戳单位s     (Date.parse(new Date(lastDate.year+'-'+lastDate.month+'-'+lastDate.day+' '+lastDate.hours+':'+lastDate.minute)))/1000;
                let firstDateTime=this.getUnixTimeStamp(firstDate.year,firstDate.month,firstDate.day,firstDate.hours,firstDate.minute,'00');
                let lastDateTime=this.getUnixTimeStamp(lastDate.year,lastDate.month,lastDate.day,lastDate.hours,lastDate.minute,'00');
                //2获取轴体实际高度和抽象高度
                let axisHeight=this.axis.offsetHeight;
                let axisDateHeight=firstDateTime-lastDateTime;
                //3实际像素映射为时间
                let pxToDate=Math.floor(axisDateHeight/axisHeight);
                //4循环遍历，转化为节点
                for(let i=0;i<this.list.length;i++){
                    let theDiaryDate=this.getUnixTimeStamp(this.list[i].time.year,this.list[i].time.month,this.list[i].time.day,this.list[i].time.hours,this.list[i].time.minute,'00')
                    let length=firstDateTime-theDiaryDate;
                    let pxLength=Math.floor(length/pxToDate);
                    this.axis_top_config.push(pxLength)
                }
            },
            move(){
                if(window.event.clientY===0){return}//若鼠标再顶部，不移动
                if(window.event.clientY<=(window.innerHeight*0.1)-2 || window.event.clientY>=(window.innerHeight *0.9)){return}//若鼠标移出时间轴外，不移动
                this.round.style.transition='0s';//小球立即随鼠标移动而移动
                this.round.style.top=(window.event.clientY)+'px';//修改小球的高度
                this.now_round_top_value=window.event.clientY;
                for(let z=0;z<this.axis_top_config.length;z++){//查找节点高度信息，备用作匹配
                    if(Math.floor((window.event.clientY)-this.window_height*0.1+1)===this.axis_top_config[z]){ //如果移动到了节点处则做动作
                        this.show_show_frame=!this.show_show_frame;
                        //console.log(this.show_show_frame);
                        this.frame_content.innerText=this.list[z].content[0].text.substring(0,60)+'……';//显示部分信息
                        let time_and_type=this.frame_time_type.innerText=this.list[z].time.year+'年'+this.list[z].time.month+'月'+this.list[z].time.day+'日'+this.list[z].time.hours+'时'+this.list[z].time.minute+'分('+this.list[z].type+')';//显示时间及类型信息
                        for(let k=0;k<this.outline.length;k++){
                            if(time_and_type==this.outline[k].firstElementChild.innerText){
                                this.outline[k].scrollIntoView({
                                    block: 'end',
                                    behavior: 'smooth'
                                });
                                this.outline[k].className+=' hover';
                                this.triangle.style.top=window.event.clientY-5+'px';
                                //this.show_frame.style['animation']='hide_show_frame 8s forwards ';
                                this.show_frame.style.top=window.event.clientY-25+'px';
                            }
                        }
                    }
                }
            },
            moveEnd(){

            },
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
        },
        watch:{
            //当list数据有更改时修改list build的数据
            diaryListMonitor:{
                handler(){
                    if (this.list==undefined || this.list=='' || this.list==null){
                        return false
                    }else {
                        if(this.list.length<=0){
                            return false
                        }
                        for(let i=0;i<this.list.length;i++){
                            for(let x=0;x<this.list[i].content.length;x++){
                                if(this.list[i].content[x].type==='img'){
                                    this.list[i].content[x].text=require('../assets/img/diary/'+this.list[i].content[x].text);
                                }
                            }
                        }
                    }
                },
                immediate:true,
                deep:true
            },
            printDiaryData:{
                handler(){
                    let newXml=new XMLHttpRequest();
                    let data=newXml.open('get','../../static/json/diary_data.json');
                    //console.log(data);
                    //console.log(this.diaryData);
                },
                immediate:true,
                deep:true
            },
        }
    };

</script>

<style scoped>
    .diaryApp{width: 100%;height: auto;display: flex;justify-content: center}
    /*vue动画*/
    .frame-enter-active{
        /* 设置进入时的transition属性 */
        animation: hide_show_frame 6s forwards;
    }
    .frame-leave-active{
        /* 设置离开时的transition属性 */
        animation: hide_show_frame 6s forwards;
    }
    .frame-enter {
        /* 设置以什么状态进入 */
        animation: hide_show_frame 6s forwards;
    }
    .frame-leave-to {
        /* 设置离开到什么状态 */
        animation: hide_show_frame 6s forwards;
    }

    .triangle-enter-active{
        /* 设置进入时的transition属性 */
        animation: hide_triangle 6s forwards;
    }
    .triangle-leave-active{
        /* 设置离开时的transition属性 */
        animation: hide_triangle 6s forwards;
    }
    .triangle-enter {
        /* 设置以什么状态进入 */
        animation: hide_triangle 6s forwards;
    }
    .triangle-leave-to {
        /* 设置离开到什么状态 */
        animation: hide_triangle 6s forwards;
    }
    /*pc版 triangle*/
    ::-moz-selection {background: #5f5f5f;color: #ffffff;font-weight: 900;font-size: 32px;}
    ::selection {background: #5f5f5f;color: #ffffff;font-weight: 900;font-size: 32px;}
    body,html{overflow-x:hidden;overflow-y: hidden}
    /*body::-webkit-scrollbar{display:none;}/*隐藏滚动条*/
    body{height: 100%}
    img,#show_frame,#message{-moz-user-select:none;-webkit-user-select:none;-ms-user-select:none;user-select:none;}
    /*body::-webkit-scrollbar{width: 20px}*/
    #flex{width:100%;display: flex;flex-direction:column;flex-wrap:nowrap;justify-content:center;align-items: center;
        overflow-x: hidden;
        overflow-y: hidden;
        scrollbar-face-color: #6c82ff;
        scrollbar-base-color: #6c82ff;
        scrollbar-shadow-color: #6c82ff;
        scrollbar-highlight-color: #6c82ff;
        scrollbar-track-color: #6c82ff;
        scrollbar-arrow-color: #6c82ff;
        min-width: 925px;
    }
    /*显示层*/
    .text{text-indent:2em;line-height: 30px}
    .outline{padding: 10px;width:60%;border-radius: 10px;margin-top: 10px;box-shadow:4px 4px 8px rgba(135, 135, 135, 0.94);background: #ffffff;transition:0.3s;font-size: 20px}
    .outline:hover{margin-top: 15px;margin-bottom:15px;box-shadow:13px 13px 20px rgba(126, 126, 126, 0.91);background: #ffffff}

    .img_div{width: inherit;text-align: center;}
    .img{max-height: 400px;border-radius: 10px;max-width: 90%;box-shadow: 2px 2px 6px rgba(184, 184, 184, 0.85)}
    .date{text-align: center;line-height: 45px}
    /*预览层*/
    #frame_content{width: 200px;height: auto;}
    #show_frame{width: 0px;height: auto;display: flex;flex-direction: column;justify-content: center;align-items: center;background: rgba(222, 222, 222, 0.91);position: fixed;z-index: 40;top:50px;right: 80px;border-radius: 6px;font-size: 14px;overflow: hidden;}
    #triangle{
        border-top: 0px solid  rgba(222, 222, 222, 0.91);
        border-right: 0px solid  rgba(222, 222, 222, 0.91);
        border-bottom: 0px solid  rgba(0, 0, 0, 0);
        border-left: 0px solid  rgba(0, 0, 0, 0);
        position: fixed;top:90px;right: 71px;
        transform:rotate(45deg);
    }
    /*时间轴*/
    #time_axis{height:100%;position:fixed;right:30px;z-index:10;}
    #axis{position: fixed;right:30px;}
    #round{position: fixed;right:19px;height:24px;width: 24px;transition: 0.4s;}
    /*动画*/
    @keyframes message_hide {
        0%{
            top:-60px;
        }
        25%{
            top:0px;
        }
        75%{
            top:0px;
        }
        100%{
            top:-90px;
        }
    }
    @keyframes hide_show_frame {
        0%{width: 0px;opacity: 0}
        20%{width: 240px;opacity: 1}
        90%{width: 240px;opacity: 1}
        100%{width: 0px;opacity: 0}
    }
    @keyframes hide_triangle {
        0%{border-width:0px;}
        20%{border-width:10px;}
        90%{border-width:10px;}
        100%{border-width:0px;}
    }
    /*消息层*/
    #message{position: fixed;width: 100%;height:44px;z-index: 999;animation: message_hide  2.5s forwards;
        -moz-animation: message_hide  2.5s forwards;
        -webkit-animation: message_hide 2.5s forwards;
        -o-animation: message_hide  2.5s forwards;
        background: #ffb1b8;
        line-height: 42px;
    }
    #mes_title{width: 100%;height: 44px;text-align: center;}
</style>