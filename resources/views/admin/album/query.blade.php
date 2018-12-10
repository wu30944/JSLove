<div id="query_content">
    <table class="table  table-bordered table-hover m-t-md" id="flavor_content">
        <thead>
        <tr>
            <th class="text-center">@lang('default.album_name')</th>
            <th class="text-center">@lang('default.status')</th>
            <th class="text-center">@lang('default.create_time')</th>
            @if(Auth::guard('admin')->user()->hasRule('album.edit'))
                <th class="text-center">@lang('default.action')</th>
            @endif
        </tr>
        </thead>
        <tbody class="page_content" >
        {{--<div class="page_content">--}}
        @if(isset($data["data"]))
            @foreach($data['data'] as $index => $item)
                <tr class="item{{$item->id}}">
                    <td align="center" style="width:20%"><p id = "album_name{{$item->id}}">{{$item->album_name}}</p></td>
                    <td align="center" style="width:20%" class="hide"><p id = "album_type{{$item->id}}">{{$item->album_type}}</p></td>
                    {{--<td align="center" style="width:20%"><p id = "status{{$item->id}}">{{$item->status}}</p></td>--}}
                    <td class="text-center">
                        @if($item->status == 1)
                            <span class="text-navy">@lang("default.show")</span>
                        @else
                            <span class="text-danger">@lang("default.hide")</span>
                        @endif
                    </td>
                    <td align="center" style="width:20%"><p id = "created_at{{$item->id}}">{{$item->created_at}}</p></td>
                    <td align="center" style="width:20%">
                        @if(Auth::guard('admin')->user()->hasRule('album.edit'))
                            {{--<a href="{{route('album.edit',$item->album_name)}}" style="color:white">--}}
                            <button class="edit-modal btn btn-success"
                                    data-info="{{$item->id}}">
                                <span class="glyphicon glyphicon-edit"></span>
                                @lang('default.edit')
                            </button>
                            {{--</a>--}}
                        @endif
                        @if(Auth::guard('admin')->user()->hasRule('album.destroy_album'))
                            <button class="delete-album-modal btn btn-danger"
                                    data-info="{{$item->id}}">
                                <span class="glyphicon glyphicon-trash"></span> @lang('default.delete')
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        @endif
        {{--</div>--}}
        </tbody>
    </table>
    @include('admin.commons.pagination_new')
</div>