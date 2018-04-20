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
            <el-table-column prop="category_name" label="名称" width="140">
            </el-table-column>
            <el-table-column prop="category_alias" label="别名" width="120">
            </el-table-column>
            <el-table-column prop="category_description" label="描述">
            </el-table-column>
            <el-table-column prop="category_parent" label="父级">
            </el-table-column>
            <el-table-column prop="created_at" label="创建时间">
            </el-table-column>
            <el-table-column prop="updated_at" label="修改时间">
            </el-table-column>
            <el-table-column label="操作">
                <template slot-scope="scope">
                    <el-button @click="handleEdit(row)" type="text" size="small">删除</el-button>
                    <el-button @click="handleDestory('one',row)" type="text" size="small">编辑</el-button>
                </template>
            </el-table-column>
        </el-table>

        <el-dialog title="添加分类" :visible.sync="categoryFormVisible" width="30%">
            <el-form :model="categoryForm" :rules="rules" ref="categoryForm">
                <el-form-item label="分类名称" label-width="120px" prop="category_name">
                    <el-input v-model="categoryForm.category_name" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="分类别名" label-width="120px" prop="category_alias">
                    <el-input v-model="categoryForm.category_alias" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="分类描述" label-width="120px">
                    <el-input type="textarea" v-model="categoryForm.category_description" :rows="4"></el-input>
                </el-form-item>
                <el-form-item label="父级分类" label-width="120px">
                    <el-select v-model="categoryForm.category_parent" placeholder="请选择父级分类">
                        <el-option :label="item.category_name" :value="item.id" v-for="(item,index) in categorys" :key="index"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item v-if="categoryForm.id">
                    <el-input v-model="categoryForm.id" style="display: none;"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="closeForm('categoryForm')">取 消</el-button>
                <el-button type="primary" @click="categoryFormCreate('categoryForm')">提 交</el-button>
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
                categorys: [],
                categoryForm: {
                    id: 0,
                    category_name: '',
                    category_alias: '',
                    category_description: '',
                    category_parent: 0
                },
                rules: {
                    category_name: [
                        {required: true, message: '请输入分类名称', trigger: 'blur'}
                    ],
                    category_alias: [
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
                this.setTopCategorys();
            },
            handleEdit:function () {
                alert();
            },
            handleDestory:function () {
                alert();
            },
            categoryFormCreate: function (categoryForm) {
                let _this = this;

                this.$refs.categoryForm.validate((valid) => {
                    if(valid){
                        this.axios.post('admin/category/post', this.categoryForm).then(function (res) {
                           if(res.data.status == 'success'){
                               _this.closeForm('categoryForm');
                               _this.getCategoryData();
                           }
                            _this.$message({
                                message: res.data.status == 'success' ? '新增成功' : '新增失败',
                                type: res.data.status
                            });
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
            },
            closeForm: function (categoryForm) {
                this.categoryFormVisible = false;
                this.$refs[categoryForm].resetFields();
                this.categoryForm = {
                    id: 0,
                    category_name: '',
                    category_alias: '',
                    category_description: '',
                    category_parent: 0,
                };
                console.log('closeForm');
            },
            setTopCategorys: function () {
                var categorys = this.categoryData.concat();
                categorys.splice(0, 0, {id: 0, category_name: '顶级分类', hidden: true, category_parent: 0});
                this.categorys = categorys;
            }
        },
        mounted(){
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