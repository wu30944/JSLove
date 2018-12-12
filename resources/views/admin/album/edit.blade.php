<div id="edit_modal" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                @lang("default.edit")
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="ibox-content panel panel-simple marginbottom0">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#UploadPart"
                                           href="#collapseOne">
                                            @lang('default.upload_photo')
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-heading success">
                                        <h3 class="panel-title"><i class="fa fa-picture-o"></i> 張貼照片 <span class="panel-under"></span></h3>
                                    </div>
                                    <form id="post-form" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="panel-body">
                                            <div class="modal-body" >
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="Album">@lang('default.album_name'):</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="AlbumName" name="AlbumName" value="{{$Album->album_name}}" placeholder="輸入相簿名稱">
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="Album">@lang('default.album_type'):</label>
                                                    <div class="col-sm-10">
                                                        <select name="album_type" class="form-control" id="album_type">
                                                            @foreach($AlbumType as $index =>$item)
                                                                <option value="{{$index}}">{{$item}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                {{--<div class="form-group">--}}
                                                    {{--<label class="control-label" for="Album">@lang('default.album_name'):</label>--}}
                                                    {{--<input type="text" class="form-control" name="AlbumName" id="AlbumName" placeholder="輸入相簿名稱" value="{{$Album->album_name}}">--}}
                                                {{--</div>--}}
                                                <input type="text" class="form-control hide" name="album_id" id="album_id"  value="{{$Album->id}}">

                                                {{--<div class="form-group">--}}
                                                    {{--<label class="control-label">@lang('default.album_type'):</label>--}}
                                                    {{--<div class="col-sm-4" align="left">--}}
                                                        {{--<select name="album_type" class="form-control" id="album_type">--}}
                                                            {{--@foreach($AlbumType as $index =>$item)--}}
                                                                {{--<option value="{{$index}}">{{$item}}</option>--}}
                                                            {{--@endforeach--}}
                                                        {{--</select>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            </div>
                                            <div style="margin-left: 0px;display:none" class="errorMessage" id="Post_image_em_"></div>
                                            <div class="row fileupload-buttonbar marginbottom10">
                                                <div class="col-sm-12 col-xs-14">
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-8 col-xs-12">
                                                            <div class="col-lg-6 col-sm-6 col-12">
                                                                <label class="btn btn-primary">
                                                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                                                    @lang('default.select_photo')&hellip; <input type="file" name="fileupload[]" multiple style="display:none;">
                                                                </label>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary start">
                                                                <i class="glyphicon glyphicon-upload"></i>
                                                                <span>@lang('default.all_upload')</span>
                                                            </button>
                                                        </div>
                                                        <div class="col-md-16 hidden-sm hidden-xs">
                                                            拖放照片
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-11 col-xs-10 fileupload-progress fade">
                                                    <!-- The global progress bar -->
                                                    <div class="progress progress-striped active" style="margin: 0;" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                        <div class="bar progress-bar" style="width:0%;">
                                                        </div>
                                                    </div>
                                                    <!-- The extended global progress information -->
                                                </div>
                                            </div>
                                            <div class="visible-sm visible-xs text-small text-muted">
                                                如果您的設備上傳了有缺陷的圖像，請釋放RAM並逐個向上。
                                            </div>
                                            <!-- The table listing the files available for upload/download -->
                                            <div id="upload-grid">
                                                <table role="presentation" class="table table-striped table-hover table-condensed">
                                                    <tbody class="files">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @include('admin.album.edit_collapse_two')
                        </div>
                    </div>

                </div>
                <input type="text" class="form-control" id="layer_current_page" disabled value="" style="display:none;">
                <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
                    <div class="slides"></div>
                    <h3 class="title"></h3>
                    <a class="prev">‹</a> <a class="next">›</a>
                    <a class="close">×</a>
                    <a class="play-pause"></a>
                    <ol class="indicator"></ol>
                </div>
            </div>
        </div>
    </div>
</div>



