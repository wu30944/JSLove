<div class="box-header" align="center" id="layer_page">
    <div class="box-tools">
        <div class="layer_page">
            <!-------分页---------->
            <ul class="pagination">
                @if($data['page'] !=1)
                    <li>
                        <a href="javascript:void(0)" onclick="layer_page({{$data['prev']}})" ><span class="glyphicon glyphicon-chevron-left"></span></a>
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
                            <a href="javascript:void(0)" onclick="layer_page({{$v}})">{{$v}}</a>
                        </li>
                    @endif
                @endforeach
                @if($data['page'] !=$data['sums'])
                    <li>
                        <a href="javascript:void(0)" onclick="layer_page({{$data['next']}})"><span class="glyphicon glyphicon-chevron-right"></span></a>
                    </li>
                @else
                    <li class="disabled">
                        <a href="javascript:void(0)"  disabled="false"><span class="glyphicon glyphicon-chevron-right"></span></a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-------分页---------->
<script>
    function layer_page(page){
        //加载层
        layer.msg('{{trans('message.data_loading')}}', {
            icon: 16,
//            time: 1500,
            shade: 0.01
        });
        var layer_id ;
        // 发异步请求完成分页
        $.ajax({
            type: "GET",
            url: layer_pagination_url,
            dataType: 'json',
            cache: false,
            data: {
                page: page,
                album_id:$('#album_id').val(),
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

                $('#collapse_two_content').html(data['html']);
            }
        });

    }
</script>