    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="{{ loadEdition('/js/plugins/ckeditor/ckeditor.js')}}"></script>
    <script src="{{ loadEdition('/js/plugins/ckeditor/ckeditor_api.js')}}"></script>
    <script>
// Replace the <textarea id="editor_t"> with an CKEditor instance.

    function RegisterEditCKEditor() {
        return CKEDITOR.replace('zh_introduction', {
            on: {
                focus: onFocus,
                blur: onBlur,

                // Check for availability of corresponding plugins.
                pluginsLoaded: function (evt) {
                    var doc = CKEDITOR.document, ed = evt.editor;
                    if (!ed.getCommand('bold'))
                        doc.getById('exec-bold').hide();
                    if (!ed.getCommand('link'))
                        doc.getById('exec-link').hide();
                }
            }
        });
    }

    function RegisterCreateCKEditor() {
        var objEditor2 = CKEDITOR.replace('c_zh_introduction', {
            on: {
                focus: onFocus,
                blur: onBlur,

                // Check for availability of corresponding plugins.
                pluginsLoaded: function (evt) {
                    var doc = CKEDITOR.document, ed = evt.editor;
                    if (!ed.getCommand('bold'))
                        doc.getById('exec-bold').hide();
                    if (!ed.getCommand('link'))
                        doc.getById('exec-link').hide();
                }
            }
        });
    }

        var pagination_url = '{{route('flavor.paginate')}}';

        $('.fontawesome-icon-list .fa-hover').find('a').click(function(){
            var str=$(this).text();
            $('#fonts').val( $.trim(str));
            layer.closeAll();
        });

        $(document).on('click', '.edit-modal', function() {

                $('#edit_modal input').val('');

                var id =  $(this).data('info');

                var layer_id ;
                layer_id = showLoadLayer();
                NProgress.start();

                $.ajax({
                    type: 'get',
                    url: '{{route('about.edit')}}',
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
//                    ElementClassBind();
                },
                success: function(data) {

                    ClearCKEditorInstance();        //此function寫在layout.blade.php中
                    ckEditor = RegisterEditCKEditor();

                    $('#id').val(data['Data'].id);
                    $('#zh_company_name').val(data['Data'].zh_company_name);
                    $('#en_company_name').val(data['Data'].en_company_name);
                    $('#address').val(data['Data'].address);
                    $('#telephone').val(data['Data'].telephone);
                    $('#en_introduction').val(data['Data'].en_introduction);
                    $('#email').val(data['Data'].email);
                    $('#status').val(data['Data'].status);
                    $('#uniform_number').val(data['Data'].uniform_number);
                    $('#fex').val(data['Data'].fex);
                    SetContents(ckEditor,data['Data'].zh_introduction);

                    if(data['Data'].status==1){
                        $("#status").val(1);
                    }else{
                        $("#status").val(0);
                    }

                    $('#edit_modal').modal('show');

                },error:function(e)
                {
                    var errors=e.responseJSON;
                    alert(errors.Message);
                }
            });


        });



        /*
            當按下新增按鈕時，會去做的事情
        */
        $(document).on('click', '.btn-primary', function() {
        });

        /*
            當按下儲存時，會去做的事情
        */
        $(document).on('click', '.btn-store', function() {
        //            alert('test');
        });

        $("#addbtn").click(function() {

        });


        $(document).on('click', '#btn_delete', function() {
            var id = $('#delete_id').val();
            var layer_id ;
            {{--layer.msg('{{trans('message.data_destroy')}}', {--}}
                {{--icon: 16,--}}
                {{--time: 1500,--}}
                {{--shade: 0.01--}}
            {{--});--}}
            $.ajax({
                    type: 'post',
                    url: '{{route('about.destroy')}}',
                    data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                        'id':id,
                        'page':$("li[class='active'] > span").text()
                },beforeSend:function(){
                    layer_id = showLoadLayer();
                    NProgress.start();
                },
                complete:function(){
                    NProgress.done();
                    closeLoadLayer(layer_id);
                    $('#delete_id').val('');
                },
                success: function(data) {

                    $('#destroy_modal').modal('hide');
                    $('#query_content').html(data['html']);
                    ClearFormContent();

                },error:function(e)
                {
                    var errors=e.responseJSON;
                    alert(errors.Message);
                }
            });
        });


        $(document).on('click', '.delete-modal', function() {
            $('#delete_id').val($(this).data('info'));
            $('#destroy_modal').modal('show');
        });


        $().ready(function() {

            $("#form_edit").validate({
                    rules: {
                        edit_zh_company_name: {
                            required: true
                        },
                        edit_address:{
                            required: true
                        },
                        edit_telephone:{
                            required:true
                        },
                        edit_zh_introduction:{
                            required:true
                        },
                        edit_email:{
                            required:true
                        },
                        edit_status:{
                            required:true
                        }

                    },
                    messages: {
                        edit_zh_company_name: '{{trans('message.err_zh_company_name')}}',
                    edit_address:{requried:'{{trans('message.err_address')}}'},
                edit_telephone:'{{trans('message.err_telephone')}}',
                edit_zh_introduction:'{{trans('message.err_zh_introduction')}}',
                edit_email:'{{trans('message.err_email')}}',
                edit_status:'{{trans('message.err_status')}}'
        },
            submitHandler: function(form) {
                {{--layer.msg('{{trans('message.data_submit')}}', {--}}
                    {{--icon: 16,--}}
                    {{--time: 1500,--}}
                    {{--shade: 0.01--}}
                    {{--});--}}
                var id=$('#id').val();
                var layer_id ;
                var ckEditor = CKEDITOR.instances['zh_introduction'];

                $.ajax({
                        type: 'post',
                        url: '{{route('about.update')}}',
                        data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                            'id':id,
                            'zh_company_name':$('#zh_company_name').val(),
                            'en_company_name':$('#en_company_name').val(),
                            'address':$('#address').val(),
                            'telephone':$('#telephone').val(),
                            'zh_introduction':GetContents(ckEditor),
                            'en_introduction':$('#en_introduction').val(),
                            'email':$('#email').val(),
                            'status':$('#status').val(),
                            'uniform_number':$('#uniform_number').val(),
                            'fex':$('#fex').val(),
                            'page':$("li[class='active'] > span").text()
                    },
                    beforeSend:function(){
                        layer_id = showLoadLayer();
                        NProgress.start();
                    },
                    complete:function(){
                        NProgress.done();
                        closeLoadLayer(layer_id);
//                        ElementClassBind();
                    },
                    success: function(data) {
                    //                            $('#company_name'+id).val($('#edit_zh_company_name').val());
                        {{--alert('{{trans('message.store_successful')}}');--}}
                        $('#edit_modal').modal('hide');

                    },error:function(requestObject, error, errorThrown)
                    {
                        alert('{{trans('message.error')}}');
                    }
                    });
                }
        });

        $('#form_create').validate({
                    rules: {
                        c_zh_company_name: {
                            required: true
                        },
                        c_address:{
                            required: true
                        },
                        c_telephone:{
                            required:true
                        },
                        c_zh_introduction:{
                            required:true
                        },
                        c_email:{
                            required:true
                        },
                        c_status:{
                            required:true
                        }

                    },
                    messages: {
                        c_zh_company_name: '{{trans('message.err_zh_company_name')}}',
                        c_address:{requried:'{{trans('message.err_address')}}'},
                        c_telephone:'{{trans('message.err_telephone')}}',
                        c_zh_introduction:'{{trans('message.err_zh_introduction')}}',
                        c_email:'{{trans('message.err_email')}}',
                        c_status:'{{trans('message.err_status')}}'
            }
            ,
            submitHandler: function(form) {
                    layer.msg('{{trans('message.data_submit')}}');
                    var layer_id ;
                    var ckEditor = CKEDITOR.instances['c_zh_introduction'];

                    $.ajax({
                            type: 'post',
                            url: '{{route('about.store')}}',
                            data: {
                                '_token': $('meta[name="csrf-token"]').attr('content'),
                                'zh_company_name':$('#c_zh_company_name').val(),
                                'en_company_name':$('#c_en_company_name').val(),
                                'address':$('#c_address').val(),
                                'telephone':$('#c_telephone').val(),
                                'zh_introduction': GetContents(ckEditor),
                                'en_introduction':$('#c_en_introduction').val(),
                                'email':$('#c_email').val(),
                                'status':$('#c_status').val(),
                                'uniform_number':$('#c_uniform_number').val(),
                                'fex':$('#c_fex').val(),
                                'page':$("li[class='active'] > span").text()
                                },
                            beforeSend:function(){
                                layer_id = showLoadLayer();
                                NProgress.start();
                            },
                            complete:function(){
                                NProgress.done();
                                closeLoadLayer(layer_id);
//                                ElementClassBind();
                            },
                            success: function(data) {
                                $('#create_modal').modal('hide');
                                $('#query_content').html(data['html']);
                                ClearFormContent();

                            },error:function(requestObject, error, errorThrown)
                            {
                                alert('{{trans('message.error')}}');
                            }
                    });
                }
            });
        });

        $(document).on('click', '.create-modal', function() {
            ClearCKEditorInstance();        //此function寫在layout.blade.php中
            ckEditor = RegisterCreateCKEditor();
            $('#create_modal').modal('show');
        });

        /**
         * 請空表單中的內容
         * @constructor
         */
        function ClearFormContent(){
            $('#photo_preview').attr('src','http://placehold.it/900x300');
            $("form").each(function(){
                this.reset();
            });
        }
</script>