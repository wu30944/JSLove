<div id="create_modal" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                @lang("default.create")
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="form_create" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="c_title">@lang('default.title'):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="c_title" name="c_title" >
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="c_action_date">@lang('default.date'):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="c_action_date" name="c_action_date"  placeholder="請輸入活動開始日期">
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="c_action_time">@lang('default.time'):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="c_action_time" name="c_action_time" maxlength="5">
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="c_action_position">@lang('default.position'):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="c_action_position" name="c_action_position" >
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="c_show_date">@lang('default.show_date'):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="c_show_date" name="c_show_date" placeholder="請輸入消息顯示日期">
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="c_status">@lang('default.status')：</label>
                        <div class="col-sm-2">
                            <select  class="form-control" id="c_status" name="c_status">
                                <option value="1" >@lang('default.show')</option>
                                <option value="0" >@lang('default.hide')</option>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="c_content" name="c_content">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="btn-create" >
                            <span class='glyphicon glyphicon-ok'> </span> @lang('default.create')
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