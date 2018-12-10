<div class="box-header">
    <div class="box-tools">
        <div class="page">
            <!-------分页---------->
            @if($data['count'] > 5)
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

                    <li>
                        <a href="javascript:void(0)" onclick="page({{$data['next']}})"><span class="glyphicon glyphicon-chevron-right"></span></a>
                    </li>

                </ul>
            @endif
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
//        var state = {test:"test"};
//        history.pushState(state, "test", pagination_url+"/"+page);
        var layer_id ;

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

                if(data){
                    $('.page_content').html(data['page_content']);
                    $('.page').html(data['page']);
                    $('#current_page').val(page);
                }

                var state = {
                    title: "test",
                    url: pagination_url+"/"+page,
                    content: $('#pjax-container').html(),
                    selector: '#pjax-container',
                    prev: window.location.href,
                    time: (new Date()).getTime()
                };

                if(pagination_url+"/"+page != state.prev)
                    history.pushState(state, "test", pagination_url+"/"+page);
                history.replaceState(state, "test", pagination_url+"/"+page);

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

    window.onpopstate = function(event) {

        var state = history.state; // 等价于
//        var state = event.state;
        if(state && state.content) $('#pjax-container').html(state.content);
    };


</script>