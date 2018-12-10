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
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="menu_name">@lang('default.menu_name'):</label>
                        <div class="col-sm-10">
                            <select name="menu_name" id="menu_name" class="form-control">
                                @foreach($Title as $item)
                                    <option value="{{$item["menu_name"]}}">{{$item["menu_name"]}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="prod_name">@lang('default.flavor_name'):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="prod_name" name="prod_name" >
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="price">@lang('default.price'):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="price" name="price">
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="prod_intro">@lang('default.prod_intro'):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="prod_intro" name="prod_intro">
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('default.status')：</label>
                        <div class="col-sm-2">
                            <select name="status" class="form-control" id="status">
                                <option value="1" >@lang('default.use')</option>
                                <option value="0" >@lang('default.not_use')</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <p class="error text-center alert alert-danger hidden"></p>

                        <button type="submit" class="btn btn-success" id="btn-create" >
                            <span id="footer_action_button" class='glyphicon glyphicon-ok'> </span> @lang('default.create')
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