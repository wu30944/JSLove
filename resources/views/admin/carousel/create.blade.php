<div id="create_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                @lang("default.create")
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="form_create" enctype="multipart/form-data">
                    <label class="btn btn-primary">
                        @lang('default.select_photo')&hellip;
                        <input type="file" name="fileupload[]" style="display:none;" class="upl" data-info="" id="fileupload">
                    </label>
                    <div class="form-group">
                        <img src="http://placehold.it/900x300" class="img-responsive" id="photo_preview"/>
                    </div>
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
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="description">@lang('default.description'):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="description" name="description" >
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="button_title">@lang('default.button_title'):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="button_title" name="button_title">
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="button_url">@lang('default.button_url'):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="button_url" name="button_url">
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="show_date">@lang('default.show_date'):</label>
                        <div class="col-sm-10">
                            {{--<input type="text" class="form-control" id="show_date" name="show_date">--}}
                            <input type="text" class="form-control" id="show_date" name="show_date" placeholder="請輸入開始日期">
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="sort">@lang('default.sort'):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sort" name="sort">
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('default.is_show')：</label>
                        <div class="col-sm-2">
                            <select name="is_show" class="form-control" id="is_show">
                                <option value="1" >@lang('default.show')</option>
                                <option value="0" >@lang('default.hide')</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <p class="error text-center alert alert-danger hidden"></p>

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