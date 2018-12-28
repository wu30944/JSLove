<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="/js/jquery.datetimepicker.full.js"></script>
<script>
    var pagination_url = '{{route('store_info.paginate')}}';

    $(document).on('click', '.divbox', function() {

        $('.divbox').removeClass('divClick');
        $(this).addClass('divClick');

        strSelectCount=$('.divClick').length;

        $(".edit-modal").val($(this).attr("id"));
        $("#btn-destroy").val($(this).attr("id"));

    });

    function ElementClassBind(){

        //當滑鼠滑入時將div的class換成divOver
        $('.divbox').hover(function(){
                $(this).addClass('divOver');

            },function(){
                //滑開時移除divOver樣式
                $(this).removeClass('divOver');
            }
        );

        /*
            時間
            datepicker:是否藏掉選擇日期的控制項 false,
            format:選擇時間格式'H:i',
            step:選擇時間的區間 30
          */
        $('#open_time').datetimepicker({
            datepicker:false,
            format:'H:i',
            step:30
        });

        $('#close_time').datetimepicker({
            datepicker:false,
            format:'H:i',
            step:30
        });

        $('#create_open_time').datetimepicker({
            datepicker:false,
            format:'H:i',
            step:30
        });

        $('#create_close_time').datetimepicker({
            datepicker:false,
            format:'H:i',
            step:30
        });
    }

    $().ready(function() {

    });

    $("#search_keyword").autocomplete({
        source: "{{route('store_info.keyword')}}",
        dataType: 'json', minLength: 1,
        select: function(e, ui) {
            $('#search_keyword').val(ui.item.value);
        }
    });

    $(document).on('click', '#btn_search', function() {

        $.ajax({
            type: 'get',
            url: '{{route('store_info.search')}}',
            data:{
                '_token': $('input[name=_token]').val(),
                'keyword':$('#search_keyword').val(),
                'page':$("li[class='active'] > span").text()
            },
            beforeSend:function(){
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

            },error:function(e,x,z)
            {
                var errors=e.responseJSON;
                alert(errors.message);

            }
        });
    });


    $(document).on('click', '.destroy-modal', function() {
        if($('#btn-destroy').val()!==''){
            $('#destroy_modal').modal('show');
        }

    });

    $(document).on('click', '#btn-destroy', function() {
        $destroy_id = $(this).val();

        $('#form_destroy').validate({
            submitHandler: function(form) {
                var layer_id ;
                var formData = new FormData();

                formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                formData.append("id",$destroy_id);
                formData.append("page",$("li[class='active'] > span").text());

                $.ajax({
                    type: 'post',
                    url: '{{route('store_info.destroy')}}',
                    processData:false,
                    cache:false,
                    contentType:false,
                    data:formData,
                    beforeSend:function(){
                        layer_id = showLoadLayer();
                        NProgress.start();
                    },
                    complete:function(){
                        NProgress.done();
                        closeLoadLayer(layer_id);
                        ElementClassBind();
                    },
                    success: function(data) {

                        $('#destroy_modal').modal('hide');
                        $('#query_content').html(data['html']);
                        ClearFormContent();

                    },error:function(e,x,z)
                    {
                        var errors=e.responseJSON;
                        alert(errors.message);

                    }
                });
            }
        });
    });

    $(document).on('click', '#btn-edit', function() {

        $('#form_edit').validate({
            rules: {
                title: {
                    required: true
                }
            },
            messages: {
                title: '{{trans('message.err_store_name')}}'
            }
            ,
            submitHandler: function(form) {
                var layer_id ;
                $.ajax({
                    type: 'post',
                    url: '{{route('store_info.update')}}',
                    data:{
                        '_token':$('meta[name="csrf-token"]').attr('content'),
                        'id':$('#id').val(),
                        'store_name':$('#store_name').val(),
                        'local':$('#local').val(),
                        'address':$('#address').val(),
                        'open_time':$('#open_time').val(),
                        'close_time':$('#close_time').val(),
                        'is_hidden': $("#is_hidden").find(":selected").val(),
                        'telephone':$('#telephone').val(),
                        'status':$("#status").find(":selected").val(),
                        'page':$("li[class='active'] > span").text()
                    },
                    beforeSend:function(){
                        layer_id = showLoadLayer();
                        NProgress.start();
                    },
                    complete:function(){
                        NProgress.done();
                        closeLoadLayer(layer_id);
                        ElementClassBind();
                    },
                    success: function(data) {

                        $('#edit_modal').modal('hide');
                        $('#query_content').html(data['html']);
                        ClearFormContent();

                    },error:function(e,x,z)
                    {
                        var errors=e.responseJSON;
                        alert(errors.message);

                    }
                });
            }
        });
    });

    $(document).on('click', '.edit-modal', function() {

        var id =  $(this).val();
        if(id!==''){
            $.ajax({
                type: 'get',
                url: '{{route('store_info.edit')}}',
                container: '#edit_modal',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id':id
                },beforeSend:function(){
                    layer_id = showLoadLayer();
                    NProgress.start();
                },
                complete:function(){
                    NProgress.done();
                    closeLoadLayer(layer_id);
                    ElementClassBind();
                },
                success: function(data) {

                    $('#partial_edit').html(data['html']);
                    $('#partial_create').html('');
                    $('#edit_modal').modal('show');

                },error:function(e)
                {
                    var errors=e.responseJSON;
                    alert(errors.Message);
                }
            });
        }

    });

    $(document).on('click', '.create-modal', function() {

        layer_id = showLoadLayer();
        NProgress.start();
        $('#create_modal').modal('show');
        NProgress.done();
        closeLoadLayer(layer_id);

    });


    /**
     *
     * 資料建立
     * */
    $(document).on('click', '#btn-create', function() {

        $('#form_create').validate({
            rules: {
                title: {
                    required: true
                }
            },
            messages: {
                title: '{{trans('message.err_store_name')}}'
            }
            ,
            submitHandler: function(form) {

                var layer_id ;

                $.ajax({
                    type: 'post',
                    url: '{{route('store_info.store')}}',
                    data:{
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'store_name':$('#create_store_name').val(),
                        'local':$('#create_local').val(),
                        'address':$('#create_address').val(),
                        'open_time':$('#create_open_time').val(),
                        'close_time':$('#create_close_time').val(),
                        'is_hidden': $("#create_is_hidden").find(":selected").val(),
                        'telephone':$('#create_telephone').val(),
                        'status':$("#create_status").find(":selected").val(),
                        'page':$('#current_page').val()
                    },
                    beforeSend:function(){
                        layer_id = showLoadLayer();
                        NProgress.start();
                    },
                    complete:function(){
                        NProgress.done();
                        closeLoadLayer(layer_id);
                        ElementClassBind();
                    },
                    success: function(data) {

                        $('#create_modal').modal('hide');
                        $('#query_content').html(data['html']);
                        ClearFormContent();

                    },error:function(e,x,z)
                    {
                        var errors=e.responseJSON;
                        alert(errors.message);

                    }
                });
            }
        });
    });

    /**
     * 請空表單中的內容
     * @constructor
     */
    function ClearFormContent(){
        $("form").each(function(){
            this.reset();
        });
    }

    var strSelectCount = 0;

    $(document).on('click', '.create-modal', function() {
        $('#create_modal').modal('show');
    });


</script>