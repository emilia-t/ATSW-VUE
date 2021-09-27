<template>
  <!--顶部区域-->
  <div class="topPage" >
    <div class="logBox">
      <img alt="LOG" src="../../static/img/icon/ATSW.png" class="log"/>
    </div>
    <div id="search">
      <input title="" placeholder="按QQ输入QQ号 | 按UID输入UID并加上前缀uid" type="text" name="word" id="input_text" >
      <img alt="搜索" style="width: 36px;height:36px;background-repeat:no-repeat;" src="../../static/img/icon/sousuo.png" @click="find_qq(getQQ())">
    </div>
    <div class="userAttributeBox">
    <!--@click="openLinkPage()"-->
      <img :src="'http://q.qlogo.cn/g?b=qq&nk='+userFaceDate.user_qq+'&s=640&mType=friendlist'" class="userHeadImgForTopPage"/>
      <p v-text="userFaceDate.user_name"></p>
      <p>我的星空</p>
    </div>
    <!--悬浮展示搜索道德数据-->
    <div class="floatSearchView" v-show="haveSearchData()">
      <div class="searchTitle">为您找到以下信息：<button @click="clearSearchData()">关闭</button></div>
      <!--小卡片-->
      <div class="searchCard" v-show="searchBh3()">
        <!--头像-->
        <div class="searchCardImg">
          <img :src="'http://q.qlogo.cn/g?b=qq&nk='+searchData.bh3[2]+'&s=640&mType=friendlist'">
        </div>
        <!--信息-->
        <div class="searchText">
          <div>Nick-name&#9;{{searchData.bh3[3]}}</div>
          <div>GameType&#9;BH3</div>
          <div>UID&#9;{{searchData.bh3[4]}}&nbsp;&#9;QQ&#9;{{searchData.bh3[2]}}</div>
        </div>
      </div>
      <div class="searchCard" v-show="searchYs()">
        <!--头像-->
        <div class="searchCardImg">
          <img :src="'http://q.qlogo.cn/g?b=qq&nk='+searchData.ys[2]+'&s=640&mType=friendlist'">
        </div>
        <!--信息-->
        <div class="searchText">
          <div>Nick-name&#9;{{searchData.ys[3]}}</div>
          <div>GameType&#9;YS</div>
          <div>UID&#9;{{searchData.ys[4]}}&nbsp;&#9;QQ&#9;{{searchData.ys[2]}}</div>
        </div>
      </div>
      <div class="searchCard" v-show="searchPcr()">
        <!--头像-->
        <div class="searchCardImg">
          <img :src="'http://q.qlogo.cn/g?b=qq&nk='+searchData.pcr[2]+'&s=640&mType=friendlist'">
        </div>
        <!--信息-->
        <div class="searchText">
          <div>Nick-name&#9;{{searchData.pcr[3]}}</div>
          <div>GameType&#9;PCR</div>
          <div>UID&#9;{{searchData.pcr[4]}}&nbsp;&#9;QQ&#9;{{searchData.pcr[2]}}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: "topPage",
  props:{
    "face_data":{
      type:Object,
      default: undefined
    }
  },
  data(){
    return{
      public__public:[],
      private__private:[],//用于存放私人数据
      childTest:null,
      userFaceDate:{

      },
      searchData:{
        bh3:[],
        pcr:[],
        ys:[]
      },
    }
  },
  methods:{
      clearSearchData(){
        this.searchData={bh3:[],
          pcr:[],
          ys:[]}
      }
      ,
      getQQ(){
          return  document.getElementById('input_text').value
      },
      find_qq(qq){
          try{
              if(qq==''){
                  //console.log(this.$root);
                  this.$root.general_script.alert_tips("请输入后再点击");
                  return false
              }
              let clock=false;
              if(qq.substring(0,3)=='uid' || qq.substring(0,3)=='UID'){
                  axios.get('../php/api/public/int_mysql_get_data_sheet.php?game_name=bh3&search_uid='+qq.substring(3))
                      .then(response => {
                        if(response.data!==''){
                          this.searchData.bh3 = response.data[0];
                          console.log(response);
                          clock=true;
                        }
                      })
                      .catch(function (error) { // 请求失败处理
                      console.log(error);
                  });
                  axios.get('../php/api/public/int_mysql_get_data_sheet.php?game_name=pcr&search_uid='+qq.substring(3))
                      .then(response => {
                        if(response.data!==''){
                          this.searchData.pcr = response.data[0];
                          clock=true;
                        }
                      })
                      .catch(function (error) { // 请求失败处理
                      console.log(error);
                  });
                  axios.get('../php/api/public/int_mysql_get_data_sheet.php?game_name=ys&search_uid='+qq.substring(3))
                      .then(response => {
                        if(response.data!=='') {
                          this.searchData.ys = response.data[0];
                          clock=true;
                        }
                      })
                      .catch(function (error) { // 请求失败处理
                      console.log(error);
                  });
              }else {
                  axios.get('../php/api/public/int_mysql_get_data_sheet.php?game_name=bh3&search_qq='+qq)
                      .then(response => {
                        if(response.data!=='') {
                          this.searchData.bh3 = response.data[0];
                          console.log(response);
                          clock=true;
                        }
                      })
                      .catch(function (error) { // 请求失败处理
                      console.log(error);
                  });
                  axios.get('../php/api/public/int_mysql_get_data_sheet.php?game_name=pcr&search_qq='+qq)
                      .then(response => {
                        if(response.data!=='') {
                          this.searchData.pcr = response.data[0];
                          clock=true;
                        }
                      })
                      .catch(function (error) { // 请求失败处理
                      console.log(error);
                  });
                  axios.get('../php/api/public/int_mysql_get_data_sheet.php?game_name=ys&search_qq='+qq)
                      .then(response => {
                        if(response.data!=='') {
                          this.searchData.ys = response.data[0];
                          clock=true;
                        }
                      })
                      .catch(function (error) { // 请求失败处理
                      console.log(error);
                  });
              }
              if(clock){
                this.$root.general_script.alert_tips("找到了惹~");
              }else{
                this.$root.general_script.alert_tips("没有查找到有关信息惹~");
              }
          }catch (e) {
              console.log(e)
          }
      },
      searchBh3(){
        return this.searchData.bh3.length!==0 ? true:false;
      },
      searchPcr(){
        return this.searchData.pcr.length!==0 ? true:false;
      },
      searchYs(){
        return this.searchData.ys.length!==0 ? true:false;
      },
      haveSearchData(){
        if(this.searchBh3() || this.searchPcr() || this.searchYs()){return true}
        else {return false}
      }
  },
  ///监听由父组件的变化值
  watch:{
    face_data:{
      handler(val,oldVal){
        //console.log(this.$parent.user_face_data);
        this.userFaceDate=val;
        //console.log(this.test)
      },
      immediate:true,
      deep:true
    }
  },
  created(){
    this.$on("call",(message)=>{
        let getUser=message.getUser;
        switch (getUser) {
            case 'any':{
                this.$emit('call',message);
                break;
            }
            default :{
                this.$emit('call',message);
            }
        }
        console.log(message)
    }
    )
  }
}
</script>

<style scoped>
.searchCardImg{width: 80px;height: 80px;display: flex;justify-content: center;align-items: center;}
.searchCardImg img{width: 68px;height: 68px;border-radius: 10px}
.searchText{width: calc(100% - 80px);height: auto;font-weight: 200;font-size:14px;display: flex;align-items: center;justify-content: center}
.floatSearchView{width: 400px;height: auto;border-radius: 14px;overflow:hidden;position: fixed;top:calc(50% - 150px);left: calc(50% - 200px);background:rgba(249,249,249,0.85);display: flex;flex-direction: column;justify-content: center;align-content: center}
.searchTitle{width: 100%;height: 30px;font-size:18px;font-weight: 800;display: flex;justify-content: space-around;align-content: center}
.searchTitle button{border-radius: 4px;padding: 2px;font-weight: 100;font-size: 13px;display: flex;justify-content: center;align-items: center;outline: none;background: #f5f5f5
}
.searchCard{width: 100%;height: 80px;display: flex;justify-content: space-between;align-items: center}
.searchCard:nth-child(even){background: rgba(237,251,247,0.45);}
.searchText {width: calc(100% - 80px);height: 80px;display: flex;justify-content: space-evenly;align-items: center;flex-direction: column}
.searchText div{width: 100%;height: auto;display: flex;justify-content:flex-start;align-items: center}
#search {width: 100%;height: 30px;display: flex;justify-content: center;margin: 10px 0 10px 0;}
#input_text {width: 71%;height: 100%;margin: 0;padding: 0;border: #FFC6D0 solid;border-radius: 20px;background: #ffa6ca;color: white;outline: none;}
.topPage{position: fixed;top:0;left:0;width: 100%;height: 60px;display: flex;justify-content: space-around;align-items: center;background: rgba(255,255,255,0.96);box-shadow: 2px 2px 10px rgba(201, 201, 201, 0.86)}
.logBox{width: 230px;height: 60px;display: flex;justify-content: center;align-items: center}
.log{width:auto;height: 50px;margin: 0 10px}
.userHeadImgForTopPage{width: 34px;height: 34px;border-radius: 6px}
.userAttributeBox{width: auto;min-width: 250px;height: 60px;display: flex;justify-content: center;align-items: center}
.userAttributeBox p{margin: 0 10px;padding: 0;font-size: 16px;width: auto}
</style>