<form class="form-horizontal" role="form" id="form_edit" enctype="multipart/form-data">
    <label class="btn btn-primary">
        @lang('default.select_photo')&hellip;
        <input type="file" name="fileupload[]" style="display:none;" class="upl" data-info="" id="fileupload">
    </label>
    <div class="form-group">
        @if($Carousel->photo_url!="")
            <img src="{{$Carousel->photo_url}}" class="img-responsive" id="photo_preview"/>
        @else
            <img src="http://placehold.it/900x300" class="img-responsive" id="photo_preview"/>
        @endif
    </div>
    <div class="form-group hidden">
        <label class="control-label col-sm-2 " for="id">id:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="id" disabled value="{{$Carousel->id}}">
        </div>
    </div>
    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="title">@lang('default.title'):</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="title" name="title" value="{{$Carousel->title}}">
        </div>
    </div>
    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="description">@lang('default.description'):</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="description" name="description" value="{{$Carousel->description}}">
        </div>
    </div>
    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="button_title">@lang('default.button_title'):</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="button_title" name="button_title" value="{{$Carousel->button_title}}">
        </div>
    </div>
    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="button_url">@lang('default.button_url'):</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="button_url" name="button_url" value="{{$Carousel->button_url}}">
        </div>
    </div>
    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="show_date">@lang('default.show_date'):</label>
        <div class="col-sm-10">
            {{--<input type="text" class="form-control" id="show_date" name="show_date">--}}
            <input type="text" class="form-control" id="show_date" name="show_date" placeholder="請輸入開始日期" value="{{$Carousel->show_date}}">
        </div>
    </div>
    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="sort">@lang('default.sort'):</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="sort" name="sort" value="{{$Carousel->sort}}">
        </div>
    </div>
    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label">@lang('default.is_show')：</label>
        <div class="col-sm-2">
            <select name="is_show" class="form-control" id="is_show">
                <option value="1" @if($Carousel->is_show==1) selected @endif>@lang('default.show')</option>
                <option value="0" @if($Carousel->is_show==0) selected @endif>@lang('default.hide')</option>
            </select>
        </div>
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