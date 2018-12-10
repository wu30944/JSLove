<div id="query_content">
    <table class="table  table-bordered table-hover m-t-md" id="flavor_content">
        <thead>
        <tr>
            <th class="text-center">@lang('default.company_name')</th>
            @if(Auth::guard('admin')->user()->hasRule('admin.about.edit'))
                <th class="text-center">Actions</th>
            @endif
        </tr>
        </thead>
        <tbody class="page_content" >
        {{--<div class="page_content">--}}
        @if(isset($data["data"]))
            @foreach($data["data"] as $index => $item)
                <tr class="{{$item->id}}">
                    <td align="left" style="width:20%">{{$item->zh_company_name}}</td>
                    <td style="width:10%" align="center">
                        @if(Auth::guard('admin')->user()->hasRule('admin.about.edit'))
                            <button class="edit-modal btn btn-info"
                                    data-info="{{$item->id}}">
                                <span class="glyphicon glyphicon-edit"></span> @lang('default.edit')
                            </button>
                        @endif
                        @if(Auth::guard('admin')->user()->hasRule('admin.about.destroy'))
                            <button class="delete-modal btn btn-danger"
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
    {{--@include('admin.commons.pagination_new')--}}
</div>