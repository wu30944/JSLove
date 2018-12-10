<div id="edit_modal" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                @lang("default.edit")
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="form_edit" enctype="multipart/form-data">
                    <div class="form-group hidden">
                        <label class="control-label col-sm-2 " for="id">id:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id" disabled >
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">@lang('default.title'):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" name="title" >
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="action_date">@lang('default.date'):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="action_date" name="action_date"  placeholder="請輸入活動開始日期">
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-2 datetime" for="action_time">@lang('default.time'):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="action_time" name="action_time" maxlength="5">
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="action_position">@lang('default.position'):</label>
                        <div class="col-sm-10">
                            {{--<input type="text" class="form-control" id="show_date" name="show_date">--}}
                            <input type="text" class="form-control" id="action_position" name="action_position" >
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="show_date">@lang('default.show_date'):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="show_date" name="show_date"  placeholder="請輸入消息顯示日期">
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="status">@lang('default.status')：</label>
                        <div class="col-sm-2">
                            <select name="status" class="form-control" id="status">
                                <option value="1" >@lang('default.show')</option>
                                <option value="0" >@lang('default.hide')</option>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="content" name="content">
                    </div>

                    <div class="modal-footer">
                        <p class="error text-center alert alert-danger hidden"></p>

                        <button type="submit" class="btn btn-success" id="btn-edit" >
                            <span class='glyphicon glyphicon-ok'> </span> @lang('default.store')
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> @lang('default.cancel')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>