<template>
    <div class="">
        <el-row>
            <el-col :span="24"><div class="grid-content bg-purple-dark operation-header" style="background: #EBEEF5;padding-bottom: 10px">
                <router-link to="/post">
                    <el-button size="medium" type="primary">添加</el-button>
                </router-link>
                <el-button size="medium" type="danger" @click.native="deleteSelected">删除</el-button>
            </div></el-col>
        </el-row>
        <el-table
            :data="tableData"
            @selection-change="handleSelectionChange">
            <el-table-column
                    type="selection"
                    width="55">
            </el-table-column>
            <el-table-column prop="id" label="编号" width="140">
            </el-table-column>
            <el-table-column prop="date" label="日期" width="140">
            </el-table-column>
            <el-table-column prop="name" label="姓名" width="120">
            </el-table-column>
            <el-table-column prop="address" label="地址">
            </el-table-column>
        </el-table>
    </div>
</template>

<script type="text/ecmascript-6">
    export default {
        name: "message",
        data() {
            return {
                tableData: [{
                    id: 1,
                    date: '2016-05-03',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }, {
                    id: 2,
                    date: '2016-05-02',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }, {
                    id: 3,
                    date: '2016-05-04',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }, {
                    id: 4,
                    date: '2016-05-01',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }, {
                    id: 5,
                    date: '2016-05-08',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }, {
                    id: 6,
                    date: '2016-05-06',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }, {
                    id: 7,
                    date: '2016-05-07',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }],
                checkedAll: []
            }
        },
        methods:{
            handleSelectionChange(val) {
                this.checkedAll = val;
            },
            deleteSelected () {
                let _this = this,idsParam = {};
                if(this.checkedAll.length > 0){
                    _this.$confirm('此操作将永久删除, 是否继续?', '提示', {
                        confirmButtonText: '确定',
                        cancelButtonText: '取消',
                        type: 'warning'
                    }).then(() => {
                        // _this.util.removeByValue(_this.tableData,);
                        idsParam = _this.util.getIdByArr(_this.checkedAll);
                        _this.axios.post('admin/delete/article',idsParam).then(function (res) {
                            var ids = res.data;
                            _this.$message({
                                type: 'success',
                                message: '删除成功!'
                            });
                            if(ids.length > 1){
                                for (var index in ids){
                                    _this.util.removeByValue(_this.tableData, ids[index]);
                                }
                            }else{
                                _this.util.removeByValue(_this.tableData, ids);
                            }

                        });
                    }).catch(() => {

                    });
                }else{
                    this.$message({
                        message: '请选择要删除的数据',
                        type: 'warning'
                    });
                }
            }
        }
    }
</script>

<style scoped>
    .operation-header{
        margin-bottom: 20px;
        padding-left: 20px;
        padding-top: 10px;
    }
</style>