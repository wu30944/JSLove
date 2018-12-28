<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>就是愛POS - @yield('title', config('app.name', '就是愛'))</title>
    <meta name="keywords" content="{{ config('app.name', 'Laravel') }}">
    <meta name="description" content="{{ config('app.name', 'Laravel') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{loadEdition('/icon/icon.png')}}" />
    <link href="{{loadEdition('/admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{loadEdition('/admin/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{loadEdition('/admin/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{loadEdition('/admin/css/style.min.css')}}" rel="stylesheet">

    {{--2018/04/21 進度條--}}
    <link href="{{ loadEdition('/admin/css/nprogress.css')}}" rel="stylesheet">

    <link href="{{ loadEdition('/admin/css/view.css')}}" rel="stylesheet">

    {{--2018/12/15 為了搜尋控制項輸入文字後有文字清單--}}
    <link href="{{ loadEdition('/admin/css/JquerySearch/jquery-ui.css')}}" rel="stylesheet">
    @yield('css')
</head>
<body class="gray-bg" >
<div class="wrapper wrapper-content animated fadeInRight">
    @php
        $admin = Auth::guard('admin')->user();
    @endphp
    @include('flash::message')
    <input type="text" class="form-control hide" id="user_id" disabled value="{{$admin->name}}">
    <!-- 添加 Pjax 设置：(必须有一个空元素放加载的内容) -->
    {{--<div class="main-content" id="pjax-container">--}}
        @yield('content')
    {{--</div>--}}
</div>
<script src="{{loadEdition('/js/jquery.min.js')}}"></script>
<script src="{{loadEdition('/admin/js/bootstrap.min.js')}}"></script>

<script src="{{ loadEdition('/js/plugins/ckeditor/ckeditor.js')}}"></script>
<script src="{{ loadEdition('/js/plugins/ckeditor/ckeditor_api.js')}}"></script>

@yield('js')


{{--<script src="{{ loadEdition('/admin/js/jquery.pjax.min.js')}}"></script>--}}

{{--201/04/21 進度條--}}
<script src="{{ loadEdition('/admin/js/nprogress.js')}}"></script>



<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

    var i ;

    /*
    * 當使用ajax傳送資料到後端，會叫用此function，告訴使用者載入中
    * */
    function showLoadLayer(){
        return layer.msg('{{trans('message.data_loading')}}', {
            icon: 16,
            shade: [0.5, '#f5f5f5'],
            scrollbar: false,
//            offset: '0px',
            time:100000
        }) ;
    }

    /*
    * 當後端資料完成後，回到前端，會將一開始顯示載入中的畫面關閉
    * */
    function closeLoadLayer(index){
        layer.close(index);
    }
//    function ityzl_SHOW_TIP_LAYER(){
//        layer.msg('恭喜您，加载完成！',{time: 1000,offset: '10px'});
//    }

    $(document).on('click', '.btn-submit', function() {
        NProgress.start();
        i=showLoadLayer();
    });

    /**
     * IE瀏覽器在使用modal時，會被背景疊到，導致無法編輯，所以需要加入下方Script解決此問題
     * @type {number}
     */
    var checkeventcount = 1,prevTarget;
    $('.modal').on('show.bs.modal', function (e) {

        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);

        if(typeof prevTarget == 'undefined' || (checkeventcount==1 && e.target!=prevTarget))
        {
            prevTarget = e.target;
            checkeventcount++;
            e.preventDefault();
            $(e.target).appendTo('body').modal('show');
        }
        else if(e.target==prevTarget && checkeventcount==2)
        {
            checkeventcount--;
        }
    });

    /**
     * 目的：清空ckeditor instance，避免資料重複
     *
     *  解決使用modal後，會有一層灰色背景覆蓋，
     *  所以加了一段script解決此問題，但該段Script會導致ckeditor無效
     *  所以將ckeditor在每次進行編輯、建立都進行註冊動作，避免重複註冊，就建立前，都先將原來註冊的給刪除
     * */
    function ClearCKEditorInstance(){

        for (name in CKEDITOR.instances)
        {
            CKEDITOR.instances[name].destroy(true);
        }
    }

</script>

{{--2018/12/15 為了搜尋控制項輸入文字後有文字清單--}}
<script src="{{ loadEdition('/admin/js/JquerySearch/jquery-ui.js')}}"></script>


@yield('footer-js')
</body>
</html>