<form class="form-horizontal" id="form_edit" role="form">
    <div class="form-group hidden">
        <div class="col-sm-10">
            <input type="text" class="form-control" id="id" disabled value="{{$StoreInfo->id}}">
        </div>
    </div>
    <div class="form-group">
        <input type="text" id="edit_id" style="display:none;">
        <label class="control-label col-sm-2" for="store_name">@lang('default.branch_store_name'):</label>
        <div class="col-sm-10">
            <input type="text" id="store_name" name="store_name" value="{{$StoreInfo->store_name}}" class="form-control" required data-msg-required="{{trans('message.err_flavor_name')}}">
        </div>
    </div>
    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="local">@lang('default.post_number'):</label>
        <div class="col-sm-10">
            <input type="text" id="local" name="local" value="{{$StoreInfo->local}}" class="form-control" >
        </div>
    </div>
    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="telephone">@lang('default.telephone'):</label>
        <div class="col-sm-10">
            <input type="text" id="telephone" name="telephone" value="{{$StoreInfo->telephone}}" class="form-control" >
        </div>
    </div>
    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="address">@lang('default.address'):</label>
        <div class="col-sm-10">
            <input type="text" id="address" name="address" value="{{$StoreInfo->address}}" class="form-control" >
        </div>
    </div>
    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="open_time">@lang('default.open_time'):</label>
        <div class="col-sm-10">
            <input type="text" id="open_time" name="open_time" value="{{$StoreInfo->open_time}}" class="form-control" >
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="close_time">@lang('default.close_time'):</label>
        <div class="col-sm-10">
            <input type="text" id="close_time" name="close_time" value="{{$StoreInfo->close_time}}" class="form-control">
        </div>
    </div>
    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
    <div class="form-group">
        <label class="control-label col-sm-2">@lang('default.is_hide'):</label>
        <div class="col-sm-10">
            <select name="is_hidden" class="form-control" id="is_hidden">
                <option value="1" @if($StoreInfo->is_hidden==1) selected @endif>@lang('default.show')</option>
                <option value="0" @if($StoreInfo->is_hidden==0) selected @endif>@lang('default.hide')</option>
            </select>
        </div>
    </div>
    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
    <div class="form-group">
        <label class="control-label col-sm-2">@lang('default.status'):</label>
        <div class="col-sm-10">
            <select name="status" class="form-control" id="status">
                <option value="1" @if($StoreInfo->status==1) selected @endif>@lang('default.use')</option>
                <option value="0" @if($StoreInfo->status==0) selected @endif>@lang('default.not_use')</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <p class="error text-center alert alert-danger hidden"></p>

        <button type="submit" class="btn btn-success" id="btn-edit" >
            <span id="footer_action_button" class='glyphicon glyphicon-ok'> </span> @lang('default.store')
        </button>
        <button type="button" class="btn btn-warning" data-dismiss="modal">
            <span class='glyphicon glyphicon-remove'></span> @lang('default.cancel')
        </button>
    </div>
</form>