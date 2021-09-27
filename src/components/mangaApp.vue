<template>
    <div class="mangaApp">
        漫画页面
    </div>
</template>

<script>
    export default {
        name: "mangaApp",
        data(){
            return {
                public__public:[],
                private__private:[],//用于存放私人数据
            }
        }
    }
</script>

<style scoped>
    .mangaApp{}
</style>