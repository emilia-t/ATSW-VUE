<template>
  <!--content内apppage-->
  <div class="appButtonPage">
    <div class="appButtonPageOut">
      <router-link to="/components/mangaApp.vue"><app-button :app-head-img-prop="mangaHeadImg">看漫画</app-button></router-link>
      <router-link to="/components/sheetApp.vue/bh3"><app-button :app-head-img-prop="bh3HeadImg">崩坏三</app-button></router-link>
      <router-link to="/components/sheetApp.vue/ys"><app-button :app-head-img-prop="ysHeadImg">原神</app-button></router-link>
      <router-link to="/components/sheetApp.vue/pcr"><app-button :app-head-img-prop="pcrHeadImg">公主连结</app-button></router-link>
      <router-link to="/components/diaryApp.vue"><app-button :app-head-img-prop="diaryHeadImg">日志</app-button></router-link>
      <router-link to="/components/aboutApp.vue"><app-button :app-head-img-prop="aboutHeadImg">关于</app-button></router-link>
    </div>
    <router-view></router-view>
  </div>
</template>

<script>
  import appButton from "../components/little/appButton";
export default {
  name: "appButtonPage",
  data(){
    return{
      public__public:[],
      private__private:[],//用于存放私人数据
      bh3HeadImg:require('../../static/img/icon/bh3log.jpg'),
      pcrHeadImg:require('../../static/img/icon/pcrlog.jpg'),
      ysHeadImg:require('../../static/img/icon/yslog.jpg'),
      diaryHeadImg:require('../../static/img/icon/dairy.png'),
      aboutHeadImg:require('../../static/img/icon/about.png'),
      mangaHeadImg:require('../../static/img/icon/mangalog.jpg'),
    }
  },
  components:{
    appButton
  }
}
</script>

<style scoped>
.appButtonPage{width: 67%;height: auto;display: flex;justify-content: center;align-items: center;flex-direction: column}
.appButtonPageOut{margin: 0px 0px 10px 0px ;font-size: 15px;font-weight: 200;text-shadow:2px 2px 2px rgba(203, 203, 203, 0.85);width:100%;display: flex;justify-content: center;align-items: center;flex-direction: row}
a {
  text-decoration: none;
  color: rgba(15, 15, 15, 0.86);
}
.router-link-active {
  text-decoration: none;
  color: rgba(15, 15, 15, 0.86);
}

</style>