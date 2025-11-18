<table id="table_list" class="table table-hover">
    <thead>

    <tr>
        <th colspan="10" class="text-c handle bg-fff" style="cursor: default;">
						<span class="f16 balance">
							待提现总额：
							<font class="ft-amount c-red">￥0.00</font>
						</span>
        </th>
    </tr>

    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox table-list-checkbox-all" title="全选/全不选">
        </th>
        <th class="w100" data-sortname="add_time" data-sortorder="asc" style="cursor: pointer;">申请时间<span class="sort"></span></th>
        <th class="w100" data-sortname="user_id" data-sortorder="asc" style="cursor: pointer;">会员名称<span class="sort"></span></th>
        <th class="w90" data-sortname="amount" data-sortorder="asc" style="cursor: pointer;">提现金额<span class="sort"></span></th>
        <th class="w250" data-sortname="account_id" data-sortorder="asc" style="cursor: pointer;">提现帐号<span class="sort"></span></th>
        <th class="w80" data-sortname="admin_user" data-sortorder="asc" style="cursor: pointer;">操作人<span class="sort"></span></th>
        <th class="w100" data-sortname="update_time" data-sortorder="asc" style="cursor: pointer;">操作时间<span class="sort"></span></th>
        <th class="w200" data-sortname="user_note" data-sortorder="asc" style="cursor: pointer;">用户留言<span class="sort"></span></th>
        <th class="w100 text-c" data-sortname="status" data-sortorder="asc" style="cursor: pointer;">提现状态<span class="sort"></span></th>
        <th class="handle w100">操作</th>
    </tr>
    </thead>
    <tbody><tr><td class="no-data" colspan="11"><i class="fa fa-exclamation-circle"></i>没有符合条件的记录</td></tr></tbody>
    <tfoot>
    <tr>
        <td class="text-c w10"></td>
        <td colspan="9">
            <div class="pull-left">

                <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->
            </div>
            <div class="pull-right page-box">


                <div id="pagination">
                    <script data-page-json="true" type="text">
	{"page_key":"page","page_id":"pagination","default_page_size":10,"cur_page":1,"page_size":10,"page_size_list":[10,50,500,1000],"record_count":0,"page_count":0,"offset":0,"url":null,"sql":null}
</script>


                    <div class="pagination-info">
                        共0条记录

                        ，每页显示：
                        <select class="select m-r-5" data-page-size="10">


                            <option value="10" selected="selected">10</option>



                            <option value="50">50</option>



                            <option value="500">500</option>



                            <option value="1000">1000</option>


                        </select>
                        条

                    </div>

                    <ul class="pagination">
                        <li class="disabled" style="display: none;">
                            <a class="fa fa-angle-double-left" data-go-page="1" title="第一页"></a>
                        </li>

                        <li class="disabled">
                            <a class="fa fa-angle-left" title="上一页"></a>
                        </li>













                        <li class="disabled">
                            <a class="fa fa-angle-right" title="下一页"></a>
                        </li>

                        <li class="disabled" style="display: none;">
                            <a class="fa fa-angle-double-right" data-go-page="0" title="最后一页"></a>
                        </li>
                    </ul>

                    <div class="pagination-goto">
                        <input class="ipt form-control goto-input" type="text">
                        <button class="btn btn-default goto-button" title="点击跳转到指定页面">GO</button>
                        <a class="goto-link" data-go-page="" style="display: none;"></a>
                    </div>
                    <script type="text/javascript">
                        $().ready(function() {
                            $(".pagination-goto > .goto-input").keyup(function(e) {
                                $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                                if (e.keyCode == 13) {
                                    $(".pagination-goto > .goto-link").click();
                                }
                            });
                            $(".pagination-goto > .goto-button").click(function() {
                                var page = $(".pagination-goto > .goto-link").attr("data-go-page");
                                if ($.trim(page) == '') {
                                    return false;
                                }
                                $(".pagination-goto > .goto-link").attr("data-go-page", page);
                                $(".pagination-goto > .goto-link").click();
                                return false;
                            });
                        });
                    </script>

                </div>
            </div>
        </td>
    </tr>
    </tfoot>
</table>
