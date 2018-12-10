<div class="panel panel-default" id="collapse_two_content">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion"
               href="#collapseTwo">
                @lang('default.album_photo')
            </a>
        </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse in">
{{--        @if(Gate::forUser(auth('admin')->user())->check('admin.Album.DestoryPhoto'))--}}
            <button class="delete btn btn-danger"
                    data-info="">
                <span class="glyphicon glyphicon-trash"></span> @lang('default.batch_delete')
            </button>
        {{--@endif--}}
        <div class="panel-body">
            <table>
                <tbody class="layer_page_content" >
                @if (isset($data['data']))
                    @foreach($data['data'] as $index=>$item)
                        <div class="col-md-4 text-center" id="container">
                            <div class="thumbnail">
                                <input type="checkbox" name="delete" value="{{$item->id}}" class="toggle">
                                <hr>
                                <img class="img-responsive img-portfolio img-hover" src="{{$item->photo_path}}" style="width:650px;height:220px;">

                                <div class="" align="left">
                                    <p>
                                        @lang('default.file_name')：<input class="" type="text" value="{{$item->photo_name}}" style="border-style:none;outline:none" readonly="true" >
                                    </p>
                                    <input  type="text" id="AlbumId" value="{{$item->album_id}}" style="display:none" readonly="true" >
                                    {{--<div align="right">--}}
{{--                                        @if(Gate::forUser(auth('admin')->user())->check('admin.Album.DestoryPhoto'))--}}
                                            {{--<button class="delete btn btn-danger"--}}
                                                    {{--data-info="{{$item->id}}">--}}
                                                {{--<span class="glyphicon glyphicon-trash"></span> @lang('default.delete')--}}
                                            {{--</button>--}}
                                        {{--@endif--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                </tbody>
            </table>
            <br>
            @include('admin.commons.layer_pagination')
        </div>
    </div>
</div>