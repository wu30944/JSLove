<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>
    var pagination_url = '{{route('album.paginate')}}';
    var layer_pagination_url = '{{route('album.layer_paginate')}}';
    var upload_url='{{route('album.upload')}}';
    var destory_url='{{route('album.destroy_photo')}}';

    $(document).on('click', '.edit-modal', function() {

        var id = $(this).data('info');

        $.ajax({
            type: 'get',
            url: '{{route('album.edit')}}',
            container: '#edit_modal',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'id':[''],
                'album_id':[id],
                'page':$('#layer_current_page').val()
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
                $('#edit_modal').modal('show');

            },error:function(e)
            {
                var errors=e.responseJSON;
                alert(errors.Message);
            }
        });

    });


    /**
     *
     * 下方程式碼為按下編輯後，將一些屬性bind上控制項上
     * 否則選擇圖片後，都不會有預覽畫面
     *
     * */
    function ElementClassBind(){

        var $DeletePhotoId;
        var $DeleteAlbumId;
        // alert(upload_url);
        'use strict';
        var FileUpload = $('#post-form').fileupload({
            url: upload_url,
            autoUpload: false,
            previewMaxWidth: 120,
            previewMaxHeight: 90,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png|bmp)$/i,
            maxFileSize: 10240000,
            minFileSize: undefined,
            maxNumberOfFiles: 20,
            singleFileUploads: false
        });

        FileUpload.on('fileuploaddone', function (e, data){
            $('#collapse_two_content').html(data.result.html);
        });

        $(document).on('click', '#btn-photo-destroy', function() {
            var layer_id ;
            $.ajax({
                type: 'post',
                url: destory_url,
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id':$DeletePhotoId,
                    'album_id':$DeleteAlbumId
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

                    $('#destroy_photo_modal').hide();
                    $('#collapse_two_content').html(data['html']);

                },error:function(e)
                {
                    var errors=e.responseJSON;
                }
            });
        });

        $(document).on('click', '.delete', function() {

            $DeleteAlbumId = $('#AlbumId').val();
            var $stuff = $(this).data('info');
            var $selected=[];
            if($stuff==''){

                $("[name=delete]:checkbox:checked").each(function(){
                    $selected.push($(this).val());
                });
                $DeletePhotoId=$selected;
            }else{
                $selected.push($stuff);
                $DeletePhotoId=$selected;
            }
            if($DeletePhotoId==''){
                alert('未選擇刪除的圖片');
            }else{
                $('#destroy_photo_modal').modal('show');
                $('#destroy_photo_modal').show();
            }

        });

        $(document).on('click', '.start', function() {
            // alert('test');
        });

        $('#Post_is_all_city').click(function(){
            alert('ac');
        });
        // Load existing files:
        $('#post-form').addClass('fileupload-processing');
//        $.ajax({
//            url: $('#post-form').fileupload('option', 'url'),
//            dataType: 'json',
//            context: $('#post-form')[0]
//        }).always(function () {
//            $(this).removeClass('fileupload-processing');
//        }).done(function (result) {
//            $(this).fileupload('option', 'done').call(this, $.Event('done'), {result: result});
//            alert('test');
//        });
    }


    /*
        當按下新增按鈕時，會去做的事情
    */
    $(document).on('click', '.create-modal', function() {

        $('#create_modal').modal('show');
    });


    $(document).on('click', '.delete-album-modal', function() {

        var stuff = $(this).data('info');
        $('#delete_album').val(stuff);
        $('#destroy_album_modal').modal('show');
    });


    $(document).on('click', '#btn-album-destroy', function() {

        var id = $('#delete_album').val();
        {{--layer.msg('{{trans('message.data_destroy')}}', {--}}
            {{--icon: 16,--}}
            {{--time: 1500,--}}
            {{--shade: 0.01--}}
        {{--});--}}

        $.ajax({
            type: 'post',
            url: '{{route('album.destroy_album')}}',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'id':[''],
                'album_id':[id],
                'page':$("#paginationli[class='active'] > span").text()
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
                $('#destroy_album_modal').modal('hide');
                $('#query_content').html(data['html']);
//                this.ClearFormContent();

            },error:function(requestObject, error, errorThrown)
            {
                alert('{{trans('message.error')}}');
            }
        });

    });

    $().ready(function() {

        $('#form_create').validate({
            rules: {
                create_album_name: {
                    required: true
                }
            },
            messages: {
                create_album_name: '{{trans('message.err_album_name')}}'
            }
            ,
            submitHandler: function(form) {
                var layer_id ;
                layer.msg('{{trans('message.data_submit')}}', {
                    icon: 16,
                    time: 1500,
                    shade: 0.01
                });

//                alert($('#album_name').val());
//                alert($('#album_type').val());

                $.ajax({
                    type: 'post',
                    url: '{{route('album.store')}}',
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'album_name':$('#album_name').val(),
                        'album_type':$('#album_type').val(),
                        'position':'',
                        'status':'1',
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
                        $('#query_content').html(data);
                        ClearFormContent();

                    },error:function(requestObject, error, errorThrown)
                    {
                        alert(errorThrown);
                        {{--alert('{{trans('message.error')}}');--}}
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

    $(document).on('click', '#delete-cancel', function() {
        $('#destroy_photo_modal').hide();
    });


</script>

<script id="template-upload" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-upload fade">
            <td>
                <span class="preview"></span>
            </td>
            <td>
                <p class="name">{%=file.name%}</p>
                <strong class="error text-danger"></strong>
            </td>
            <td>
                <p class="size">Processing...</p>
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
            </td>
            <td>
                {% if (!i && !o.options.autoUpload) { %}
                    <button class="btn btn-primary start" disabled>
                        <i class="glyphicon glyphicon-upload"></i>
                        <span>Start</span>
                    </button>
                {% } %}
                {% if (!i) { %}
                    <button class="btn btn-warning cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <span>Cancel</span>
                    </button>
                {% } %}
            </td>
        </tr>
    {% } %}
    </script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-download ">
            <td>
                <span class="preview">
                    {% if (file.thumbnailUrl) { %}
                        <a href="{%=file.url%}" title="{%=file.photo_name%}" download="{%=file.photo_name%}" data-gallery><img src="{%=file.thumbnailUrl%}" style="width:120px;height:90px;overflow:hidden;"></a>
                    {% } %}
                </span>
            </td>
            <td>
                <p class="name">
                    {% if (file.url) { %}
                        <a href="{%=file.url%}" title="{%=file.photo_name%}" download="{%=file.photo_name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.photo_name%}</a>
                    {% } else { %}
                        <span>{%=file.name%}</span>
                    {% } %}
                </p>
                {% if (file.error) { %}
                    <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                {% } %}
            </td>
            <td>
                <span class="size">{%=o.formatFileSize(file.size)%}</span>
            </td>
            <td>
                {% if (file.deleteUrl) { %}
                    <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                        <i class="glyphicon glyphicon-trash"></i>
                        <span>Delete</span>
                    </button>
                    <input type="checkbox" name="delete" value="1" class="toggle">
                {% } else { %}
                    <button class="btn btn-warning cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <span>Cancel</span>
                    </button>
                {% } %}
            </td>
        </tr>
    {% } %}
    </script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="{{asset('js/JqueryFileUpload/jquery.ui.widget.js')}}"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- blueimp Gallery script -->
<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="{{asset('js/JqueryFileUpload/jquery.iframe-transport.js')}}"></script>
<!-- The basic File Upload plugin -->
<script src="{{asset('js/JqueryFileUpload/jquery.fileupload.js')}}"></script>
<!-- The File Upload processing plugin -->
<script src="{{asset('js/JqueryFileUpload/jquery.fileupload-process.js')}}"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="{{asset('js/JqueryFileUpload/jquery.fileupload-image.js')}}"></script>
<!-- The File Upload audio preview plugin -->
<script src="{{asset('js/JqueryFileUpload/jquery.fileupload-audio.js')}}"></script>
<!-- The File Upload video preview plugin -->
<script src="{{asset('js/JqueryFileUpload/jquery.fileupload-video.js')}}"></script>
<!-- The File Upload validation plugin -->
<script src="{{asset('js/JqueryFileUpload/jquery.fileupload-validate.js')}}"></script>
<!-- The File Upload user interface plugin -->
<script src="{{asset('js/JqueryFileUpload/jquery.fileupload-ui.js')}}"></script>
<!-- The main application script -->
{{--<script src="{{asset('js/JqueryFileUpload/main.js')}}"></script>--}}
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]-->
{{--<script src="{{asset('js/JqueryFileUpload/cors/jquery.xdr-transport.js')}}"></script>--}}