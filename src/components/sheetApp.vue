<template>
    <div class="sheetApp">
        <!--列表-->
        <table class="t">
            <tbody class="tbodyO">
            <tr>
                <td width="24px">序</td>
                <td width="36px">头</td>
                <td>惯称</td>
                <td>加入时间</td>
                <td>QQ</td>
                <td>UID</td>
                <td>群内昵称</td>
                <td>游戏昵称</td>
            </tr>
            <tr v-for="item in list">
                <td v-text="item[1]"></td>
                <td><img :src="'http://q.qlogo.cn/g?b=qq&nk='+item[2]+'&s=640&mType=friendlist'" width="36px" height="36px"></td>
                <td v-text="item[6]"></td>
                <td v-text="crop(item[0])"></td>
                <td v-text="item[2]"></td>
                <td v-text="item[4]"></td>
                <td v-text="item[3]"></td>
                <td v-text="item[5]"></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "pcrApp",
        props:{
            "game_name":{
                type:String,
                default: "pcr"
            }
        },
        data(){
            return{
                public__public:[],
                private__private:[],//用于存放私人数据
                list:[["2019-02-03 00:00:00","1","1658548955","加载中...","加载中...","加载中...","加载中...","加载中..."]],
                gameName:this.game_name,
            }
        },
        methods:{
            crop(text){
                return text.substring(0,10)
            },
            getData(name){
                axios.get('../php/api/public/int_mysql_get_data_sheet.php?game_name='+name).then(response => {this.list = response.data;}).catch(function (error) { // 请求失败处理
                    console.log(error);
                });
            }
        },
        mounted() {
            this.getData(this.gameName)
        },
        watch:{
            game_name(val,oldVal){
                this.gameName=val;
                this.getData(val);
            }
        }
    }
</script>

<style scoped>
    .sheetApp{
        width:calc(140%);
        min-width:740px ;
        height: auto;
        max-width: 980px;
        /*background: red;*/
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: row;
        flex-wrap: wrap;
    }
    table{table-layout:fixed;word-break:break-all;}
    tbody{width: 100%}
    .t {border: 1px solid #e4e4e4;border-right: 0;margin-top: 0;width: 100%}
    .t tr {background-color: rgba(240, 240, 240, 0.8);width: 100%}
    .tbodyO tr:nth-child(even){background-color: rgba(249, 249, 249, 0.8);}
    .tbodyO tr:nth-child(odd){background-color: rgba(235, 235, 235, 0.8);}
    .tbodyO tr:nth-child(1){background: #d3d3d3;font-size: 16px;font-weight: 600}
    th, td {border-right: 1px solid #dbdbdb;border-bottom: 1px solid #dbdbdb;text-align: left;line-height: 24px;padding-left: 4px;padding-right: 4px;vertical-align: middle;word-wrap: break-word;}
    pre{font-size: 16px}
    hr{height:2px;width: 80%;border:none;border-top:2px dotted #185598;}
</style>