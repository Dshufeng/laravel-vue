<template>
    <div class="login-form">
        <el-row>
            <el-col :span="24">
                <el-form ref="loginForm" :model="loginForm" label-width="100px">
                    <el-form-item label="账户：">
                        <el-input type="text" v-model="loginForm.name" placeholder="请输入账户"></el-input>
                    </el-form-item>
                    <el-form-item label="密码：">
                        <el-input  type="password" v-model="loginForm.password" placeholder="请输入密码"></el-input>
                    </el-form-item>

                    <el-form-item>
                        <el-button type="primary" @click="loginSubmit(loginForm)">立即登录</el-button>
                    </el-form-item>
                </el-form>
            </el-col>
        </el-row>
    </div>
</template>

<script type="text/ecmascript-6">
    export default {
        name: "login",
        data() {
            return {
                loginForm: {
                    name: '',
                    password: ''
                }
            }
        },
        methods: {
            loginSubmit:function (loginForm) {
                this.axios.post('/login/index',this.loginForm).then(function (response) {
                    console.log(response);
                });

            }
        }
    }
</script>

<style >
    body {
        background: #324057;
        color: #FFF;
    }
    .login-form {
        width: 400px;
        margin: 10% auto 0 auto;
        padding: 50px 50px 50px 30px;
        background: #FFF;
        border-radius: 2px;
    }
</style>