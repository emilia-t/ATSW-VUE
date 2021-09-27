<template>
  <div class="contentPage">
    <app-button-page></app-button-page>
    <stars-page></stars-page>
  </div>
</template>

<script>
  import appButtonPage from "./appButtonPage";
  import starsPage from "./starsPage";
export default {
  name: "contentPage",
  data(){
    return{
      public__public:[],
      private__private:[],//用于存放私人数据
      test:"22"
    }
  },
  watch:{
    getFatherDat:{
      handler(){
        //console.log(this.$parent.fatherTest);
        this.test=this.$parent.fatherTest;
        //console.log(this.test)
      },
      immediate:true,
      deep:true
    }
  },
  components:{
    appButtonPage,
    starsPage
  }
}
</script>

<style scoped>
  .contentPage{
    margin:60px 0px 0px 0px;
    width: 100%;
    height: auto;
    background: rgba(245, 245, 245, 0.89);
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-direction: column;
  }
</style>