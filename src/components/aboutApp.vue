<template>
    <div class="aboutApp">
        <div id="big_font"><p>关于</p></div>
        <hr/>
        <div id="content">
            <p class="big_p">
                什么是ATSW ？
                <br>
            </p>
            <p class="p_content">
                在星空枯萎之后(<span class="sp_1">A</span>fter <span class="sp_1">T</span>ht <span class="sp_1">S</span>tars <span class="sp_1">W</span>ither)是一个由崩坏三玩家相聚在一起，逐渐形成的<span class="sp_1">玩家团体</span>(以下简称ATSW)，目前主要由Bh3(<span class="sp_1">崩坏三</span>)、YS（<span class="sp_1">原神</span>）、PCR(<span class="sp_1">公主连结</span>)等玩家组成。
                <br>
                <br>
                其中：
                <br>
                崩坏三玩家占据88%
                <br>
                原神玩家占据22%
                <br>
                PCR玩家占据8%
                <br>
                <br>
                *请注意部分玩家多款游戏都在玩，数据截至2020年11月1日，数据仅供参考，数据根据已收集到的资料整理加权所得*
            </p>
            <p class="big_p">
                ATSW的愿景是什么？
            </p>
            <p class="p_content">
                围绕二次元<span class="sp_1">文化</span>、<span class="sp_1">游戏</span>，为玩家建立<span class="sp_1">文明和谐</span>、<span class="sp_1">积极向上</span>、<span class="sp_1">团结互助</span>的虚拟社区交流场所。
            </p>
            <p class="big_p">
                ATSW对玩家的祝愿？
            </p>
            <p class="p_content">
                祝愿各位玩家们能<span class="sp_1">和平相处</span>、<span class="sp_1">求同存异</span>，在喜爱的游戏中，<span class="sp_1">寻欢作乐</span>、<span class="sp_1">互帮互助</span>、<span class="sp_1">欧气满满</span>！୧((〃•̀ꇴ•〃))૭⁺✧
            </p>
            <p class="big_p">
                ATSW的秩序是如何维护的？
            </p>
            <p class="p_content">
                ATSW是一个向往自由的团体，任何人都可以自发的、发自真心的为美好的社区而默默守护，引导成员之间和谐相处。
                <br>
                <br>
                我们都有一颗向往自由的心，但也明白没有束缚的自由并非是真正的自由，因为那样的自由太随意、太放纵、太无礼。
                <br>
                <br>
                维持着自由沟通的同时，能确保没有做出失礼的行为，懂得互相尊重彼此，这是ATSW能从始至终不出现禁言现象的重要因素，我由衷的感谢ATSW全体成员为此做出的卓越贡献!
            </p>
            <p class="big_p">
                如何加入ATSW？
            </p>
            <p class="p_content">
                崩坏三「在星空枯萎之后」舰团ID：13006368
                <br>
                公主连结 工会名：在星空枯萎之后 会长：临冉
            </p>
            <p class="big_p">
                其他
            </p>
            <p class="p_content">
                <span class="sp_2">开源代码</span>：<a href="https://github.com/emilia-t/After-the-stars-wither">https://github.com/emilia-t/After-the-stars-wither</a>
                <br>
                <span class="sp_2">版本信息</span>：WebVersion-3.0.1-Server-atsw.top-https://atsw.top-Vue-2.6.11
                <br>
                <span class="sp_2">公用API</span> ：<a href="https://atsw.top/api.html">https://atsw.top/api.html</a>
                <br>
                <span class="sp_2">YaMi-beta使用说明</span> ：<a href="https://atsw.top/yami.html">https://atsw.top/yami.html</a>
                <br>
                <span class="sp_2">鸣谢</span>： EMT、重装小兔05号机、冗談等
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "aboutApp",
        data(){
            return {
                public__public:[],
                private__private:[],//用于存放私人数据
            }
        }
    }
</script>

<style scoped>
    #big_font p {
        text-align: center;
    }
    .aboutApp{width: 95%;min-width: 575px;height: auto;}
    #big_font {
        width: 100%;
        height: auto;
        font-size: 40px;
    }
    #big_font p{margin: 5px}
    hr {
        height: 2px;
        width: 100%;
        border: none;
        border-top: 2px dotted #6464f4;
    }
    #content {
        width: 100%;
        margin: 0 auto;
    }
    .big_p {
        font-weight: bold;
        font-size: 20px;
    }
    .p_content {
        font-size: 16px;
    }
    .sp_1 {
        color: #ff5967;
        font-weight: bold;
    }
</style>