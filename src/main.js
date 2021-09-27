import Vue from 'vue'
import App from './views/app'
import router from './router'
import general_script from './js/general_script_v1.1'
Vue.config.productionTip = true;

new Vue({
  router,
  props:{
    "public__public__props":{
      type:Object,
      default: undefined
    },
  },
  render: h => h(App),
  data(){
    return {
      public__public:[],//用接受数据
      private__private:[],//用于存放私人数据
      childMap:[],//子组件映射表"组件名"->组件索引
      general_script,//常用函数
    }
  },
  methods:{
    ReFishChildMap(){
      let dataList=[];
      function con(child){
        //1将父组件放入数组
        if(child.$el.nodeName!=="A"){
          let nodeName=child.$el.className;
          let childObj={"cpnName":nodeName,"cpn":child};
          dataList.push(childObj);
          //console.log(dataList)
        }
        //2寻找childe是否存在
        if(child.$children){
          //3获取childen的长度
          let childLength=child.$children.length;
          //循环查找是否有子组件
          if(childLength!==0){
            for (let i=0;i<childLength;i++){
              con(child.$children[i])
            }
          }
        }
      }
      con(this);
      this.childMap=dataList;
    }
  },
  mounted: function (){
      this.ReFishChildMap()
  },
  watch:{
    public__public(val,oldVal){
      for(let ik in val){
        let messType=val[ik].messageType;
        switch (messType) {
          //data 属性
          case "data":{
            let getUser=val[ik].getUser;
            switch (getUser) {
              //发给所有组件
              case "any":{
                for (let x in this.childMap) {
                  if(this.childMap[x].public__public){//检测是否有public__public属性,一般情况下,插槽是没有该属性的
                    this.childMap[x].public__public[0]=val[ik];//发送到所有人的公共邮箱
                    // console.log(this.childMap);
                    // console.log(this);
                  }
                }
                break;
              }
              //私人邮箱
              case "root":{
                break;
              }
              //其他组件，未知组件
              default:{
                let getUser=val[ik].getUser;
                let length=this.childMap.length;
                //console.log("hh");
                //console.log(length);
                for (let u=0;u<length;u++){
                  //console.log("-----");
                  //console.log(this.childMap[u].cpnName);
                  //console.log(getUser);
                  if(this.childMap[u].cpnName==getUser){
                    //console.log("ss");
                    this.childMap[u].cpn.public__public[0]=val[ik];//发送至子组件的公共邮箱中
                    console.log(this);
                    break;
                  }
                }
              }
            }
            break;
          }
          default:{
            return false
          }
        }
      }
    }
  }
}).$mount('#app');