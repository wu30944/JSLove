<div id="create_modal" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                @lang("default.create")
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="form_create" enctype="multipart/form-data">
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('default.album_type')：</label>
                        <div class="col-sm-2">
                            <select name="album_type" class="form-control" id="album_type">
                                @foreach($AlbumType as $index =>$item)
                                    <option value="{{$index}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="album_name">@lang('default.album_name'):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="album_name" name="album_name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <p class="error text-center alert alert-danger hidden"></p>

                        <button type="submit" class="btn btn-success" id="btn-create" >
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