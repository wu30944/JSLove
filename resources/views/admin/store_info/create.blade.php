<div id="create_modal" class="modal fade bd-example-modal-lg" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                @lang("default.create")
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal m-t-md" id="form_create">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('default.branch_store_name')：</label>
                        <div class="col-sm-10">
                            <input type="text" id="create_store_name" name="store_name" value="{{old('name')}}" class="form-control" required data-msg-required="{{trans('message.err_flavor_name')}}">
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('default.post_number')：</label>
                        <div class="col-sm-10">
                            <input type="text" id="create_local" name="local" value="{{old('name')}}" class="form-control" >
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('default.telephone')：</label>
                        <div class="col-sm-10">
                            <input type="text" id="create_telephone" name="telephone" value="{{old('name')}}" class="form-control" >
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('default.address')：</label>
                        <div class="col-sm-10">
                            <input type="text" id="create_address" name="address" value="{{old('name')}}" class="form-control" >
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('default.open_time')：</label>
                        <div class="col-sm-10">
                            <input type="text" id="create_open_time" name="open_time" value="{{old('name')}}" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('default.close_time')：</label>
                        <div class="col-sm-10">
                            <input type="text" id="create_close_time" name="close_time" value="{{old('name')}}" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('default.is_hide')：</label>
                        <div class="col-sm-10">
                            <select name="create_is_hidden" class="form-control" id="create_is_hidden">
                                <option value="0" @if(old('is_hidden') == 0) selected="selected" @endif>@lang('default.show')</option>
                                <option value="1" @if(old('is_hidden') == 1) selected="selected" @endif>@lang('default.hide')</option>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('default.status')：</label>
                        <div class="col-sm-10">
                            <select name="create_status" class="form-control" id="create_status">
                                <option value="1" @if(old('status') == 1) selected="selected" @endif>啟用</option>
                                <option value="0" @if(old('status') == 0) selected="selected" @endif>禁用</option>
                            </select>
                        </div>
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
