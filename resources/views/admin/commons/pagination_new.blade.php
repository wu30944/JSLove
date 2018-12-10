<div class="box-header" align="center" id="pagination">
    <div class="box-tools">
        <div class="page">
            <!-------分页---------->
{{--            @if($data['count'] > 5)--}}
                <ul class="pagination">
                    @if($data['page'] !=1)
                        <li>
                            <a href="javascript:void(0)" onclick="page({{$data['prev']}})" ><span class="glyphicon glyphicon-chevron-left"></span></a>
                        </li>
                    @else
                        <li class="disabled">
                            <a href="javascript:void(0)"  disabled="false"><span class="glyphicon glyphicon-chevron-left"></span></a>
                        </li>
                    @endif
                    @foreach($data['pages'] as $k=>$v)
                        @if($v == $data['page'])
                            <li class="active"><span>{{$v}}</span></li>
                        @else
                            <li >
                                <a href="javascript:void(0)" onclick="page({{$v}})">{{$v}}</a>
                            </li>
                        @endif

                    @endforeach

                    @if($data['page'] !=$data['sums'])
                        <li>
                            <a href="javascript:void(0)" onclick="page({{$data['next']}})"><span class="glyphicon glyphicon-chevron-right"></span></a>
                        </li>
                    @else
                        <li class="disabled">
                            <a href="javascript:void(0)"  disabled="false"><span class="glyphicon glyphicon-chevron-right"></span></a>
                        </li>

                    @endif

                </ul>
            {{--@endif--}}
        </div>
    </div>
</div>

<!-------分页---------->
<script>



    function page(page){
        //加载层
        {{--layer.msg('{{trans('message.data_loading')}}', {--}}
            {{--icon: 16,--}}
            {{--time: 1500,--}}
            {{--shade: 0.01--}}
        {{--});--}}
        // 发异步请求完成分页

        var layer_id ;

//        alert($("li[class='active'] > span").text());

        $.ajax({
            type: "GET",
            url: pagination_url+"/"+page,
            dataType: 'json',
            cache: false,
            data: { page: page,
                    _token: "{{csrf_token()}}"},
            beforeSend: function () {
                layer_id = showLoadLayer();
                NProgress.start();
            },
            complete:function(){
                NProgress.done();
                closeLoadLayer(layer_id);
                ElementClassBind();
            },
            success: function(data) {

                $('#query_content').html(data['html']);

            },error:function(requestObject, error, errorThrown)
            {
                alert(errorThrown);
                {{--var errors=e.responseJSON;--}}
                {{--if(errors.Message!=""){--}}
                    {{--alert(errors.Message);--}}
                {{--}else{--}}
                    {{--alert('{{trans('message.error')}}');--}}
                {{--}--}}

            }
        });

    }




</script>