<template>
    <div class="">
        <el-row>
            <el-col :span="24">
                <div class="grid-content bg-purple-dark operation-header"
                     style="background: #EBEEF5;padding-bottom: 10px">
                    <el-button size="medium" type="primary" @click="showCreate">添加</el-button>
                    <el-button size="medium" type="danger" @click.native="deleteSelected('multi',{})">删除</el-button>
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
                    <el-button @click="handleEdit(scope.$index, scope.row)" type="text" size="small">编辑</el-button>
                    <el-button @click="deleteSelected('one', scope.row)" type="text" size="small">删除</el-button>
                </template>
            </el-table-column>
        </el-table>
        <div class="block" style="margin-top: 20px">
            <el-pagination
                    background
                    layout="prev, pager, next"
                    :total="total"
                    :page-size="pageSize"
                    :currentPage="currentPage"
                    :page-sizes="[2, 5]"
                    @size-change="handleSizeChange"
                    @current-change="handleCurrentChange">
            </el-pagination>
        </div>


        <el-dialog :title="myFormTitle" :visible.sync="categoryFormVisible" width="30%">
            <el-form :model="categoryForm" :rules="rules" ref="categoryForm" v-loading="categoryFormLoading">
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
                        <el-option :label="item.category_name" :value="item.id" v-for="(item,index) in categorys"
                                   :key="index"></el-option>
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
                checkedAll: [],
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
                categoryFormVisible: false,
                categoryFormLoading: false,
                myFormTitle: '编辑',
                pageSize: 5,
                total: 0,
                currentPage: 1
            }
        },
        methods: {
            handleSelectionChange(val) {
                this.checkedAll = val;
            },
            handleSizeChange(val) {
                console.log(`每页 ${val} 条`);
                this.pageSize = val;
                this.getCategoryData();
            },
            handleCurrentChange(val) {
                this.currentPage = val;
                console.log(`当前页: ${val}`);
                this.getCategoryData();
            },
            showCreate: function () {
                this.myFormTitle = '新增';
                this.categoryFormVisible = true;
                this.setTopCategorys();
                this.categoryForm = {
                    id: 0,
                    category_name: '',
                    category_alias: '',
                    category_description: '',
                    category_parent: 0,
                };
            },
            handleEdit: function (index, row) {
                let _this = this;
                _this.myFormTitle = '编辑';
                _this.setTopCategorys();
                _this.categoryFormVisible = true;
                _this.categoryFormLoading = true;
                _this.axios.get('admin/category/' + row.id).then(function (res) {
                    if(res.data){
                        _this.categoryForm = res.data;
                        _this.categoryFormLoading = false;
                    }
                    console.log(res.data);
                });
            },
            deleteSelected: function (type, row) {
                let _this = this, idsParam = {};
                switch (type) {
                    case 'one':
                        idsParam = {ids: [row.id]};
                        break;
                    case 'multi':
                        var ids = _this.util.getIdByArr(_this.checkedAll);
                        if (this.checkedAll.length <= 0) {
                            this.$message({
                                message: '请选择要删除的数据',
                                type: 'warning'
                            });
                            return false;
                        }
                        idsParam = {ids: ids};
                        break;
                    default:
                        break;
                }

                _this.$confirm('此操作将永久删除, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    _this.axios.delete('admin/category/destroy', {data: idsParam}).then(function (res) {
                        if (res.data.status === 'success') {
                            _this.$message({
                                type: 'success',
                                message: '删除成功!'
                            });
                            if (type === 'multi') {
                                for (var index in ids) {
                                    _this.util.removeByValue(_this.categoryData, ids[index]);
                                }
                            } else {
                                _this.util.removeByValue(_this.categoryData, row.id);
                            }
                        }
                    });
                }).catch(() => {

                });

            },
            categoryFormCreate: function (categoryForm) {
                let _this = this;
                this.$refs.categoryForm.validate((valid) => {
                    if (valid) {
                        console.log(_this.categoryForm.id);
                        if(_this.categoryForm.id > 0 ){
                            this.axios.put('admin/category/'+ _this.categoryForm.id, this.categoryForm).then(function (res) {
                                if (res.data.status === 'success') {
                                    _this.closeForm('categoryForm');
                                    _this.getCategoryData();
                                }
                                _this.$message({
                                    message: res.data.status === 'success' ? '更新成功' : '更新失败',
                                    type: res.data.status
                                });
                            });
                        }else{
                            this.axios.post('admin/category', this.categoryForm).then(function (res) {
                                if (res.data.status === 'success') {
                                    _this.closeForm('categoryForm');
                                    _this.getCategoryData();
                                }
                                _this.$message({
                                    message: res.data.status === 'success' ? '新增成功' : '新增失败',
                                    type: res.data.status
                                });
                            });
                        }

                    } else {
                        return false;
                    }
                });

            },
            getCategoryData: function () {
                let _this = this;
                this.axios.get('admin/category',{params:{rows:_this.pageSize,page:_this.currentPage}}).then(function (res) {
                    _this.categoryData = res.data.data;
                    _this.total = res.data.total;
                    _this.currentPage = res.data.current_page;
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
        mounted() {
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