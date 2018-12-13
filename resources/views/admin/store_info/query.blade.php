<div id="query_content">
    <table class="table  table-bordered m-t-md">
        <thead>
        <tr>
            <th class="text-center" width="100">@lang('default.store_info')</th>
            <th class="text-center" width="100">@lang("default.address")</th>
            <th class="text-center" width="100">@lang("default.telephone")</th>
            <th class="text-center" width="100">@lang("default.open_time")</th>
            <th class="text-center" width="100">@lang("default.close_time")</th>
            <th class="text-center" width="100">@lang("default.status")</th>
            {{--@if(Auth::guard('admin')->user()->hasRule('admin.about.edit'))--}}
                {{--<th class="text-center">Actions</th>--}}
            {{--@endif--}}
        </tr>
        </thead>
        <tbody>
        @if(isset($data['data']))
            @foreach($data['data'] as $index => $item)
                <tr class="divbox" id="{{$item->id}}">
                    <td align="center" ><p>{{$item->store_name}}</p></td>
                    <td align="center" ><p>{{$item->address}}</p></td>
                    <td align="center" ><p>{{$item->telephone}}</p></td>
                    <td align="center" ><p>{{$item->open_time}}</p></td>
                    <td align="center" ><p>{{$item->close_time}}</p></td>
                    <td class="text-center">
                        @if($item->status == 1)
                            <span class="text-navy">@lang("default.show")</span>
                        @else
                            <span class="text-danger">@lang("default.hide")</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    @include('admin.commons.pagination_new')
</div>