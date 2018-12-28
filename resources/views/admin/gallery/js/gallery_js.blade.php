<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="/js/jquery.datetimepicker.full.js"></script>
<script>
    CKEDITOR.on('dialogDefinition', function( ev ){
        var dialogName = ev.data.name;
        var dialogDefinition = ev.data.definition;
        if (dialogName == 'image')
        {
            dialogDefinition.contents[2].elements[0].action += '&pin='+$(".edit-modal").val();
            /* 2 is the upload tab it have two elements 0=apparently is the
            and 1: is the button to perform the upload, in 0 have the action property with the parameters of the get request simply adding the new data
              */

        }
    });

    function RegisterEditCKEditor(){
        return CKEDITOR.replace('content', {
            filebrowserImageUploadUrl:'{{route('files.upload')}}?_token={{csrf_token()}}'
        });
    }

    function RegisterCreateCKEditor(){
        return CKEDITOR.replace('c_content', {
            filebrowserImageUploadUrl:'{{route('files.upload')}}?_token={{csrf_token()}}'

        });
    }

    var pagination_url = '{{route('gallery.paginate')}}';


    $().ready(function() {
        ElementClassBind();

    });

    $( function() {

    } );

    $("#search_title").autocomplete({
        source: "{{route('gallery.keyword')}}",
        dataType: 'json', minLength: 1,
        select: function(e, ui) {
            $('#search_title').val(ui.item.value);
        }
    });

    $(document).on('click', '#btn_search', function() {

        $.ajax({
            type: 'get',
            url: '{{route('gallery.search')}}',
            data:{
                '_token': $('input[name=_token]').val(),
                'title':$('#search_title').val(),
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

                $.ajax({
                    type: 'post',
                    url: '{{route('gallery.destroy')}}',
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
                var formData = new FormData();
                var ckEditor = CKEDITOR.instances['content'];
                var ModifyUser = '{{Auth::guard('admin')->user()->name}}';

                formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                formData.append("id",$('#id').val());
                formData.append("title",$("#title").val());
                formData.append("is_show",$("#is_show").find(":selected").val());
                formData.append("content",GetContents(ckEditor));
                formData.append("show_date",$("#show_date").val());
                formData.append("modify_user",ModifyUser);
                formData.append("page",$("li[class='active'] > span").text());

                $.ajax({
                    type: 'post',
                    url: '{{route('gallery.update')}}',
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


    function ElementClassBind(){

        //當滑鼠滑入時將div的class換成divOver
        $('.divbox').hover(function(){
                $(this).addClass('divOver');

            },function(){
                //滑開時移除divOver樣式
                $(this).removeClass('divOver');
            }
        );

        $('#show_date').datetimepicker({
            yearOffset:0,
            lang:'zh-TW',
            timepicker:false,
            format:'Y-m-d',
            formatDate:'Y-m-d'
        });

        $('#c_show_date').datetimepicker({
            yearOffset:0,
            lang:'zh-TW',
            timepicker:false,
            format:'Y-m-d',
            formatDate:'Y-m-d'
        });

    }

    $(document).on('click', '.divbox', function() {

        $('.divbox').removeClass('divClick');
        $(this).addClass('divClick');
        $(".edit-modal").val($(this).attr("id"));
        $("#btn-destroy").val($(this).attr("id"));
    });

    $(document).on('click', '.edit-modal', function() {

        var id =  $(this).val();
        if(id!==''){
            $.ajax({
                type: 'get',
                url: '{{route('gallery.edit')}}',
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

                    ClearCKEditorInstance();        //此function寫在layout.blade.php中
                    ckEditor = RegisterEditCKEditor();

                    $('#id').val(data['id']);
                    $('#title').val(data['title']);
                    $('#is_show').val(data['is_show']);
                    $('#show_date').val(data['show_date']);
                    SetContents(ckEditor,data['content']);

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
        ClearCKEditorInstance();        //此function寫在layout.blade.php中
        ckEditor = RegisterCreateCKEditor();
        $('#create_modal').modal('show');
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
                var formData = new FormData();
                var c_ckEditor = CKEDITOR.instances['c_content'];
                var User = '{{Auth::guard('admin')->user()->name}}';

                formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                formData.append("id",$('#id').val());
                formData.append("title",$("#c_title").val());
                formData.append("is_show",$("#c_is_show").find(":selected").val());
                formData.append("content",GetContents(c_ckEditor));
                formData.append("show_date",$("#c_show_date").val());
                formData.append("create_user",User);
                formData.append("modify_user",User);
                formData.append("page",$("li[class='active'] > span").text());

                $.ajax({
                    type: 'post',
                    url: '{{route('gallery.store')}}',
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

    function test(Para){
        alert(Para);
    }
</script>