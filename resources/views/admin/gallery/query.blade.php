<div id="query_content">
    <table class="table  table-bordered m-t-md">
        <thead>
        <tr>
            <th class="text-center" width="200">@lang("default.title")</th>
            <th class="text-center">@lang("default.content")</th>
            <th class="text-center" width="100">@lang("default.status")</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data["data"] as $key => $item)
            <tr class="divbox" id="{{$item->id}}">
                <td>{{$item->title}}</td>
                <td>{{mb_substr(strip_tags ($item->content),0,25,"utf-8")}}...</td>
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