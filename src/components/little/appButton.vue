<template>
    <!--单个APP-->
    <div class="appButton">
        <img alt="加载失败惹" :src="appHeadImgProp"/>
        <slot></slot>
    </div>
</template>

<script>
    export default {
        name: "appButton",
        props:{
          "appHeadImgProp":{
              type:String,
              default:''
          },
        },
        data(){
            return{
                public__public:[],
                private__private:[],//用于存放私人数据
                appName:'施工中',
                appHeadImg:'./static/img/icon/dairy.png',
            }
        },
        watch:{
            getAppHeadImg:{
                handler(){
                    //console.log('get app img data');
                    this.appHeadImg=this.$parent.AppHeadImg
                },
                immediate:true,
                deep:true
            }
        }
    }
</script>

<style scoped>
    .appButton{width: 100px;height: 100px;display: flex;justify-content: center;align-items: center;flex-direction: column}
    .appButton img{box-shadow: 4px 4px 8px rgba(190, 190, 190, 0.86);width: 64px;height: 64px;border-radius: 14px}
</style>