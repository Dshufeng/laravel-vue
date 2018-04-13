<template>
    <el-container style="height: 960px; border: 1px solid #eee">
        <el-aside  style="background-color: #545c64">
            <div class="logo">
                <h2>LOGO</h2>
            </div>
            <el-menu :default-openeds="['1']"
                     background-color="#545c64"
                     text-color="#fff"
                     active-text-color="#ffd04b"
                     unique-opened
                     router
            >
                <el-submenu index="1">
                    <template slot="title"><i class="el-icon-message"></i>仪表盘</template>
                    <el-menu-item index="example">选项1</el-menu-item>
                    <el-menu-item index="profile">选项2</el-menu-item>
                    <el-menu-item index="dashboard">选项3</el-menu-item>
                </el-submenu>
                <el-submenu index="2">
                    <template slot="title"><i class="el-icon-menu"></i>文章</template>
                    <el-menu-item-group>
                        <template slot="title">分组一</template>
                        <el-menu-item index="2-1">选项1</el-menu-item>
                        <el-menu-item index="2-2">选项2</el-menu-item>
                    </el-menu-item-group>
                    <el-menu-item-group title="分组2">
                        <el-menu-item index="2-3">选项3</el-menu-item>
                    </el-menu-item-group>
                    <el-submenu index="2-4">
                        <template slot="title">选项4</template>
                        <el-menu-item index="2-4-1">选项4-1</el-menu-item>
                    </el-submenu>
                </el-submenu>
                <el-submenu index="3">
                    <template slot="title"><i class="el-icon-setting"></i>扩展</template>
                    <el-menu-item-group>
                        <template slot="title">分组一</template>
                        <el-menu-item index="3-1">选项1</el-menu-item>
                        <el-menu-item index="3-2">选项2</el-menu-item>
                    </el-menu-item-group>
                    <el-menu-item-group title="分组2">
                        <el-menu-item index="3-3">选项3</el-menu-item>
                    </el-menu-item-group>
                    <el-submenu index="3-4">
                        <template slot="title">选项4</template>
                        <el-menu-item index="3-4-1">选项4-1</el-menu-item>
                    </el-submenu>
                </el-submenu>
                <el-submenu index="4">
                    <template slot="title"><i class="el-icon-setting"></i>设置</template>
                    <el-menu-item-group>
                        <template slot="title">分组一</template>
                        <el-menu-item index="3-1">选项1</el-menu-item>
                        <el-menu-item index="3-2">选项2</el-menu-item>
                    </el-menu-item-group>
                    <el-menu-item-group title="分组2">
                        <el-menu-item index="3-3">选项3</el-menu-item>
                    </el-menu-item-group>
                    <el-submenu index="3-4">
                        <template slot="title">选项4</template>
                        <el-menu-item index="3-4-1">选项4-1</el-menu-item>
                    </el-submenu>
                </el-submenu>
            </el-menu>
        </el-aside>
        <el-container>
            <el-header style="">
                <el-dropdown>
                    <i class="el-icon-setting" style="margin-right: 20px"></i>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item @click.native="logout">退出</el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
                <span class="avatar">
                    <img src="https://secure.gravatar.com/avatar/aa9bef27d4edb438c7d6dea0c252dd17.jpg?s=80&r=g&d=mm" alt="" width="50px">
                </span>
                <span>{{userName}}</span>
            </el-header>
            <el-main>
             <router-view></router-view>
            </el-main>
        </el-container>
    </el-container>
</template>

<script type="text/ecmascript-6">
    export default {
        name: "dashboard",
        methods: {
            logout:function () {
                let _this = this;
                this.$confirm('确认退出?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    _this.axios.get('/login/logout').then(function (res) {
                        if(res.data.status){
                            sessionStorage.removeItem('mySession');
                            setTimeout(function () {
                                _this.$router.push('/login');
                            },1000);
                        }
                    });
                }).catch(() => {

                });
            }
        },
        data() {
            return {
                userName:''
            }
        },
        mounted(){
            var user = sessionStorage.getItem('mySession');
            if(user){
                user = JSON.parse(user);
                this.userName = user.name;
            }

        }
    }
</script>

<style type="text/css">
    body {
        background: #f1f2f7;
        color: #FFF;
    }
    .el-header {
        background-color: #B3C0D1;
        color: #333;
        line-height: 60px;
        background: #545c64;

    }
    .el-aside {
        color: #333;
    }
    .logo{
        widows: 100%;
        height: 60px;
        line-height: 60px;
        padding-left: 30px;
    }
    .avatar img{
        border-radius: 50px;
    }
</style>