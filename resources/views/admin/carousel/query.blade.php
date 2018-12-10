<div id="query_content">
    <table class="table  table-bordered m-t-md">
        <thead>
        <tr>
            <th width="100" class="text-center">@lang("default.photo")</th>
            <th class="text-center">@lang("default.title")</th>
            <th class="text-center" width="100">@lang("default.is_show")</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data["data"] as $key => $item)
            <tr class="divbox" id="{{$item->id}}">
                <td>
                    <div class="col-md-3">
                        <div class="img-div">
                            @if($item->photo_url!="")
                                <img src="{{$item->photo_url}}" id="photo_url"/>
                            @else
                                <img src="http://placehold.it/900x300"  id="photo_url"/>
                            @endif
                        </div>
                    </div>
                </td>
                <td>{{$item->title}}</td>
                <td class="text-center">
                    @if($item->is_show == 1)
                        <span class="text-navy">@lang("default.show")</span>
                    @else
                        <span class="text-danger">@lang("default.hide")</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('admin.commons.pagination_new')
</div>