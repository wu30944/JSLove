@extends('admin.layouts.layout')
@section('css')
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
    <link rel="stylesheet" href="/css/jquery.datetimepicker.css">
    <style>
        .animated{-webkit-animation-fill-mode: none;}
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox-title">
                <h5>消息資料維護</h5>
            </div>
            <div class="ibox-content">
                <div align="right">
                    <button class="edit-modal btn btn-info" value="">
                        <span class="glyphicon glyphicon-edit"></span> @lang('default.edit')
                    </button>
                    <button class="create-modal btn btn-info" value="">
                        <span class="glyphicon glyphicon-plus"></span> @lang('default.create')
                    </button>
                    <button class="destroy-modal btn btn-danger">
                        <span class='glyphicon glyphicon-trash'></span> @lang('default.delete')
                    </button>
                </div>
                <div id="partial"></div>
                 @include('admin.news.query')
                 @include('admin.news.destroy')

                 @include('admin.news.edit')
                 @include('admin.news.create')
            </div>
        </div>
    </div>

@endsection
@section('footer-js')
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

        var ckEditor = CKEDITOR.replace('content', {
            filebrowserImageUploadUrl:'{{route('files.upload')}}?_token={{csrf_token()}}'
        });

        var c_ckEditor = CKEDITOR.replace('c_content', {
            filebrowserImageUploadUrl:'{{route('files.upload')}}?_token={{csrf_token()}}'
//            on: {
//                focus: onFocus,
//                blur: onBlur,
//
//                // Check for availability of corresponding plugins.
//                pluginsLoaded: function( evt ) {
//                    var doc = CKEDITOR.document, ed = evt.editor;
//                    if ( !ed.getCommand( 'bold' ) )
//                        doc.getById( 'exec-bold' ).hide();
//                    if ( !ed.getCommand( 'link' ) )
//                        doc.getById( 'exec-link' ).hide();
//                }
//            }
        });

        var pagination_url = '{{route('news.paginate')}}';

        var objImg;

        var ImgURL;
        /**
         * 格式化
         * @param   num 要轉換的數字
         * @param   pos 指定小數第幾位做四捨五入
         */
        function format_float(num, pos)
        {
            var size = Math.pow(10, pos);
            return Math.round(num * size) / size;
        }
        /**
         * 預覽圖
         * @param   input 輸入 input[type=file] 的 this
         */
        function preview(input,$img_id) {
            if (!input.files[0].type.match('image.*'))
            {
                alert('您選擇的不是圖片檔案');
                $('#image').attr({value:''});
            }
            else if (input.files && input.files[0] ) {
                var reader = new FileReader();
                objImg=input.files;


//                //為了避免使用者上傳照片後，又去編輯其他ITEM的照片，導致上傳照片對應不正確
//                //所以改為當某個項目上傳照片後，將其他項目的更新、選取檔案的控制項改為不能修改的狀態
//                $('.chgupl').not('#image_'+$img_id).attr('disabled',"disabled");
//                $('.save-modal').not('#update_'+$img_id).attr('disabled',"disabled");


                if($img_id=='')
                {
                    $img_id='#photo_preview';
                }else{
                    $img_id='#photo_preview_'+$img_id;
                }

                reader.onload = function (e) {
                    $($img_id).attr('src', e.target.result);
                    var KB = format_float(e.total / 1024, 2);
                    $('.size').text("檔案大小：" + KB + " KB");
                    ImgURL=e.target.result
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("body").on("change", ".upl", function (){
            $id_info = $(this).data('info');


            if(typeof($id_info)=='undefined')
            {
                $img_id = '';
            }
            else{
                $img_id = $id_info;

            }
            preview(this,$img_id);
        });


        $().ready(function() {
            ElementClassBind();
        });

        $(document).on('click', '.destroy-modal', function() {
            $('#destroy_modal').modal('show');
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
                        url: '{{route('carousel.destroy')}}',
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

                    formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                    formData.append("id",$('#id').val());
                    formData.append("title",$("#title").val());
                    formData.append("action_date",$("#action_date").val());
                    formData.append("action_time",$("#action_time").val());
                    formData.append("action_position",$("#action_position").val());
                    formData.append("status",$("#status").find(":selected").val());
                    formData.append("content",GetContents(ckEditor));
                    formData.append("show_date",$("#show_date").val());
                    formData.append("page",$("li[class='active'] > span").text());

                    $.ajax({
                        type: 'post',
                        url: '{{route('news.update')}}',
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

            $('#action_date').datetimepicker({
                yearOffset:0,
                lang:'zh-TW',
                timepicker:false,
                format:'Y-m-d',
                formatDate:'Y-m-d'
            });

            /*
                時間
                datepicker:是否藏掉選擇日期的控制項 false,
                format:選擇時間格式'H:i',
                step:選擇時間的區間 30
              */
            $('#action_time').datetimepicker({
                datepicker:false,
                format:'H:i',
                step:30
            });

            $('#c_action_time').datetimepicker({
                datepicker:false,
                format:'H:i',
                step:30
            });

            $('#c_show_date').datetimepicker({
                yearOffset:0,
                lang:'zh-TW',
                timepicker:false,
                format:'Y-m-d',
                formatDate:'Y-m-d'
            });

            $('#c_action_date').datetimepicker({
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

            strSelectCount=$('.divClick').size();

            $(".edit-modal").val($(this).attr("id"));
            $("#btn-destroy").val($(this).attr("id"));


        });

        $(document).on('click', '.edit-modal', function() {

            var id =  $(this).val();

            $.ajax({
                type: 'get',
                url: '{{route('news.edit')}}',
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

                    $('#id').val(data['id']);
                    $('#title').val(data['title']);
                    $('#action_date').val(data['action_date']);
                    $('#action_time').val(data['action_time']);
                    $('#action_position').val(data['action_position']);
                    $('#show_date').val(data['show_date']);
                    $('#status').val(data['status']);
                    SetContents(ckEditor,data['content']);


                    $('#edit_modal').modal('show');

                },error:function(e)
                {
                    var errors=e.responseJSON;
                    alert(errors.Message);
                }
            });
        });

        $(document).on('click', '.create-modal', function() {
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

                    formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                    formData.append("id",$('#id').val());
                    formData.append("title",$("#c_title").val());
                    formData.append("action_date",$("#c_action_date").val());
                    formData.append("action_time",$("#c_action_time").val());
                    formData.append("action_position",$("#c_action_position").val());
                    formData.append("status",$("#c_status").find(":selected").val());
                    formData.append("content",GetContents(c_ckEditor));
                    formData.append("show_date",$("#c_show_date").val());
                    formData.append("page",$("li[class='active'] > span").text());

                    $.ajax({
                        type: 'post',
                        url: '{{route('news.store')}}',
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
            $('#photo_preview').attr('src','http://placehold.it/900x300');
            $("form").each(function(){
                this.reset();
            });
        }



        var strSelectCount = 0;
    </script>
@endsection