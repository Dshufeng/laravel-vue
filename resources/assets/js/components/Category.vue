<template>
    <div class="">
        <el-row>
            <el-col :span="24">
                <div class="grid-content bg-purple-dark operation-header"
                     style="background: #EBEEF5;padding-bottom: 10px">
                    <el-button size="medium" type="primary" @click="showCreate">添加</el-button>
                    <el-button size="medium" type="danger" @click.native="deleteSelected">删除</el-button>
                </div>
            </el-col>
        </el-row>
        <el-table
                :data="categoryData"
                @selection-change="handleSelectionChange">
            <el-table-column
                    type="selection"
                    width="55">
            </el-table-column>
            <el-table-column prop="id" label="编号" width="140">
            </el-table-column>
            <el-table-column prop="name" label="名称" width="140">
            </el-table-column>
            <el-table-column prop="alias" label="别名" width="120">
            </el-table-column>
            <el-table-column prop="desc" label="描述">
            </el-table-column>
            <el-table-column prop="parent_cate" label="父级">
            </el-table-column>
        </el-table>

        <el-dialog title="添加分类" :visible.sync="categoryFormVisible" width="30%">
            <el-form :model="categoryForm" :rules="rules" ref="categoryForm">
                <el-form-item label="分类名称" label-width="120px" prop="name">
                    <el-input v-model="categoryForm.name" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="分类别名" label-width="120px" prop="alias">
                    <el-input v-model="categoryForm.alias" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="分类描述" label-width="120px">
                    <el-input type="textarea" v-model="categoryForm.desc" :rows="4"></el-input>
                </el-form-item>
                <el-form-item label="父级分类" label-width="120px">
                    <el-select v-model="categoryForm.parent_cate" placeholder="请选择父级分类">
                        <el-option :label="item.name" :value="item.id" v-for="(item,index) in categoryData"></el-option>
                    </el-select>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="categoryFormVisible = false">取 消</el-button>
                <el-button type="primary" @click="categoryFormCreate(categoryForm)">提 交</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script type="text/ecmascript-6">
    export default {
        name: "category",
        data() {
            return {
                categoryData: [],
                categoryForm: {
                    name: '',
                    alias: '',
                    desc: '',
                    parent_cate: ''
                },
                rules: {
                    name: [
                        {required: true, message: '请输入分类名称', trigger: 'blur'}
                    ],
                    alias: [
                        {required: true, message: '请选择分类别名', trigger: 'blur'}
                    ]
                },
                categoryFormVisible: false
            }
        },
        methods: {
            handleSelectionChange(val) {
                this.checkedAll = val;
            },
            showCreate: function () {
                this.categoryFormVisible = true;
            },
            categoryFormCreate: function (categoryForm) {
                this.$refs.categoryForm.validate((valid) => {
                    if(valid){
                        this.axios.post('admin/category/post', this.categoryForm).then(function (res) {

                        });
                    }else{
                        return false;
                    }
                });

            },
            getCategoryData:function () {
                let _this = this;
                this.axios.get('/admin/category/get').then(function (res) {
                    _this.categoryData = res.data;
                })
            }
        },
        mounted(){
            var cateFrom = this.categoryForml;
            console.log(this.$refs.cateFrom);
            this.getCategoryData();
        }
    }
</script>

<style scoped>
    .operation-header {
        margin-bottom: 20px;
        padding-left: 20px;
        padding-top: 10px;
    }
</style>