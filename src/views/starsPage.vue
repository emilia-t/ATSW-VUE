<template>
    <!--星空页面-->
    <div class="starsPage">
        <!--搜索到的-->
        <div class="searchView">
          <div class="" v-show="">为您查询到以下信息</div>
        </div>
        <!--新的-->
        <div class="newJoin">

        </div>
    </div>
</template>

<script>
    export default {
        name: "starsPage",
        data(){
            return{
                public__public:[],
                private__private:[],//用于存放私人数据
                newData:{

                },

            }
        },
        methods:{
          // showPublic(){
            //     setInterval(()=>{console.log(this.public__public)},1000)
            // }
        },
        watch:{

        }
    }
</script>

<style scoped>

</style>