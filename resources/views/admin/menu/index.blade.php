@extends('admin.layouts.layout')
@section('css')
    <style>
        .animated{-webkit-animation-fill-mode: none;}

        p.image-container {
            width: 100%;
            height: 0;
            padding-bottom: 60%;
            overflow: hidden;
        }

        p.image-container img {
            width: 100%;
            height: 100%;
        }
        .divbox{
            /*height:300px;*/
            /*width:200px;*/
            /*background:#ffffff;*/
            border:solid 1px #cccccc;
            float:left;
            cursor:pointer;
            /*margin-right:10px;*/

        }

        .divOverNotAllowedClick{
            /*height:300px;*/
            /*width:200px;*/
            background:#ffffff;
            border:solid 1px #cccccc;
            float:left;
            cursor:not-allowed;
            /*margin-right:10px;*/
        }

        /*  滑入時變換底色樣式 */
        .divOver{
            background:#a6e1ec;
            border:solid 1px #d2dce3;
        }

        /*  點選時變換底色樣式 */
        .divClick{
            background:#5acde2;
            border:solid 1px #d2dce3;
        }

        .img-div{
            width: 100px;
            height: 100px;
            border: 1px solid #000;

        }

        img {
            width: 100%;
            height: 100%;
        }
    </style>
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
{{--    <link href="{{loadEdition('/css/joyslove/style.css')}}" rel='stylesheet' type='text/css' />--}}
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="ibox-title">
                <h5>就是愛 MENU</h5>
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
                 @include('admin.menu.query')
                 @include('admin.menu.destroy')
                 {{--@include('admin.menu.edit')--}}
            </div>
        </div>
    </div>

@endsection
@section('footer-js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
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
                        url: '{{route('menu.destroy')}}',
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
                    prod_name: {
                        required: true
                    }

                },
                messages: {
                    prod_name: '{{trans('message.err_store_name')}}'
                }
                ,
                submitHandler: function(form) {
                    var layer_id ;
                    var formData = new FormData();

                    if(typeof(objImg)!='undefined')
                    {
                        $.each(objImg,function(i,file){//所有文件都要放到同一个名字下面：如files
                            formData.append("fileupload[]",file);
                        });

                    }

                    formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                    formData.append("id",$('#id').val());
                    formData.append("prod_name",$("#prod_name").val());
                    formData.append("price",$("#price").val());
                    formData.append("status",$("#status").val());
                    formData.append("page",$("#current_page").val());
                    formData.append("menu_name",$("#menu_name").find(":selected").val());
                    formData.append("prod_intro",$("#prod_intro").val());


                    $.ajax({
                        type: 'post',
                        url: '{{route('menu.update')}}',
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
    //                            $('.page_content').html(data['page_content']);
    //                            $('.page').html(data['page']);
    //                            $('#current_page').val(data['page_num']);
    ////

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
        }

        $(document).on('click', '.divbox', function() {

            $('.divbox').removeClass('divClick');
            $(this).addClass('divClick');

            strSelectCount=$('.divClick').length;

            $(".edit-modal").val($(this).attr("id"));
            $("#btn-destroy").val($(this).attr("id"));

        });

        $(document).on('click', '.edit-modal', function() {

            var id =  $(this).val();

            $.ajax({
                type: 'get',
                url: '{{route('menu.edit')}}',
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

                    $('#partial').html(data['html']);
                    $('#edit_modal').modal('show');

                },error:function(e)
                {
                    var errors=e.responseJSON;
                    alert(errors.Message);
                }
            });
        });

        $(document).on('click', '.create-modal', function() {

            $.ajax({
                type: 'get',
                url: '{{route('menu.create')}}',
                container: '#create_modal',
                data: {
                    '_token': $('input[name=_token]').val()
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

                    $('#partial').html(data['html']);
                    $('#create_modal').modal('show');

                },error:function(e)
                {
                    var errors=e.responseJSON;
                    alert(errors.Message);
                }
            });
        });


        /**
         *
         * 資料建立
         * */
        $(document).on('click', '#btn-create', function() {

            $('#form_create').validate({
                rules: {
                    prod_name: {
                        required: true
                    }
                },
                messages: {
                    prod_name: '{{trans('message.err_store_name')}}'
                }
                ,
                submitHandler: function(form) {
                    var layer_id ;
                    var formData = new FormData();

                    if(typeof(objImg)!='undefined')
                    {
                        $.each(objImg,function(i,file){//所有文件都要放到同一个名字下面：如files
                            formData.append("fileupload[]",file);
                        });
                    }

                    formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                    formData.append("prod_name",$("#prod_name").val());
                    formData.append("price",$("#price").val());
                    formData.append("status",$("#status").val());
                    formData.append("page",$("#current_page").val());
                    formData.append("menu_name",$("#menu_name").find(":selected").val());
                    formData.append("prod_intro",$("#prod_intro").val());

                    $.ajax({
                        type: 'post',
                        url: '{{route('menu.store')}}',
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