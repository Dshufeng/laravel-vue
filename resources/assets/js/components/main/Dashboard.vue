<template>
    <el-container style="height: 960px; border: 1px solid #eee">
        <el-aside style="background-color: #545c64">
            <div class="logo">
                <h2>LOGO</h2>
            </div>
            <el-menu
                 :default-active="currentPath"
                 background-color="#545c64"
                 text-color="#fff"
                 active-text-color="#ffd04b"
                 unique-opened
                 router >
            <template v-for="(item,index) in $router.options.routes" v-if="!item.hidden">
                <el-submenu :index="index +''">
                    <template slot="title"><i :class="item.iconCls"></i>{{item.name}}</template>
                    <template v-if="item.children.length > 0" v-for="(v,k) in item.children">
                        <el-menu-item :index="v.path">{{v.name}}</el-menu-item>
                    </template>
                </el-submenu>
            </template>
            </el-menu>
        </el-aside>
        <el-container>
            <el-header style="text-align: right; font-size: 12px;color: #fff">
                <el-dropdown>
                    <i class="el-icon-setting" style="margin-right: 15px">  {{userName}}</i>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item @click.native="logout">退出</el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
                <span class="avatar">
                    <img src="https://secure.gravatar.com/avatar/aa9bef27d4edb438c7d6dea0c252dd17.jpg?s=80&r=g&d=mm"
                         alt="" width="50px">
                </span>
            </el-header>
            <el-main class="">
                <el-col :span="24" style="margin-bottom:15px;font-size: 18px;padding: 5px">
                    <span class="pit-current-route">{{currentPathName}}</span>
                </el-col>
                <router-view></router-view>
            </el-main>
        </el-container>
    </el-container>
</template>

<script type="text/ecmascript-6">
    export default {
        name: "dashboard",
        methods: {
            logout: function () {
                let _this = this;
                this.$confirm('确认退出?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    _this.axios.get('/login/logout').then(function (res) {
                        if (res.data.status) {
                            sessionStorage.removeItem('mySession');
                            setTimeout(function () {
                                _this.$router.push('/login');
                            }, 1000);
                        }
                    });
                }).catch(() => {

                });
            }
        },
        data() {
            return {
                userName: '',
                currentPathName:'首页',
                currentPath:'/dashboard'
            }
        },
        mounted() {
            this.currentPath = this.$route.path;
            this.currentPathName = this.$route.name;
            let user = sessionStorage.getItem('mySession');
            if (user) {
                user = JSON.parse(user);
                this.userName = user.name;
            }

        },
        watch:{
            '$route'(to,from){
                this.currentPath = to.path;
                this.currentPathName = to.name;
            }
        }
    }
</script>

<style type="text/css" scoped>
    .el-header {
        background-color: #B3C0D1;
        color: #333;
        line-height: 60px;
        background: #545c64;
    }
    .el-main{
        background: #ffffff;
    }
    .el-aside {
        color: #333;
    }
    .el-menu{
        border-right:solid 1px #545c64;
    }
    .el-dropdown{
        color:#fff;
    }
    .logo {
        widows: 100%;
        height: 60px;
        line-height: 60px;
        padding-left: 30px;
    }

    .avatar img {
        border-radius: 50px;
    }
    .pit-current-route {
        width: 200px;
        float: left;
        color: #475669;
        font-weight: bold;
    }

</style>