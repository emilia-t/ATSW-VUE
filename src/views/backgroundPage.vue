<template>
    <!---背景页面-->
    <div class="backgroundPage">

    </div>
</template>

<script>
    export default {
        name: "backgroundPage",
        data(){
            return{
                public__public:[],
                private__private:[],//用于存放私人数据
            }
        }
    }
</script>

<style scoped>
.backgroundPage{background: url("../../static/img/other/background.jpg") center center no-repeat;width: 100%;height: 100%;position: fixed;top: 0px;left: 0px;z-index: -1}
</style>