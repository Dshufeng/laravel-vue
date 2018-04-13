<template>
    <div class="login-form" v-loading="loading">
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
                loading:false,
                loginForm: {
                    name: '',
                    password: ''
                }
            }
        },
        methods: {
            loginSubmit:function (loginForm) {

                var _this = this;
                var _duration = 1000*2;
                _this.loading = true;
                this.axios.post('/login/index',this.loginForm).then(function (response) {
                    let data = response.data;
                    if(data.status){
                        sessionStorage.setItem('mySession',JSON.stringify(data.user));
                        setTimeout(function () {
                            _this.$message({
                                message: data.msg,
                                type:'success',
                                duration: _duration
                            });
                            _this.$router.push({path: '/dashboard'})
                        }, _duration);
                    }else{
                        _this.$message.error(data.msg);
                        _this.loading = false;
                    }

                });

            }
        }
    }
</script>

<style type="text/css">
    body {
          background: rgb(84, 92, 100);
          color: #FFF;
      }
    .login-form {
        width: 400px;
        margin: 15% auto 0 auto;
        padding: 50px 50px 50px 30px;
        background: #FFF;
        border-radius: 2px;
    }
</style>