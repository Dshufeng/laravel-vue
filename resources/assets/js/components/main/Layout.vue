<template>
    <el-container style="height: 960px; border: 1px solid #eee">
        <el-aside  style="background-color: #545c64">
            <div class="logo">
                <img src="https://secure.gravatar.com/avatar/aa9bef27d4edb438c7d6dea0c252dd17.jpg?s=80&r=g&d=mm" alt="" width="50px">
                <span>LOGO</span>
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
                    <el-menu-item index="message">选项3</el-menu-item>
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
            <el-header style="text-align: right; font-size: 12px;color: #fff">
                <el-dropdown>
                    <i class="el-icon-setting" style="margin-right: 15px"></i>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item>查看</el-dropdown-item>
                        <el-dropdown-item>新增</el-dropdown-item>
                        <el-dropdown-item>删除</el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
                <span>陌上</span>
            </el-header>

            <el-main>
             <router-view></router-view>
            </el-main>
        </el-container>
    </el-container>
</template>

<script type="text/ecmascript-6">
    export default {
        name: "layout",
        methods: {},
        data() {
            const item = {
                date: '2016-05-02',
                name: '王小虎',
                address: '上海市普陀区金沙江路 1518 弄'
            };
            return {
                tableData: Array(20).fill(item)
            }
        }
    }
</script>

<style scoped>
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
    .logo img{
        border-radius: 50px;
    }
    .log span{
        color: #fff;
    }
</style>