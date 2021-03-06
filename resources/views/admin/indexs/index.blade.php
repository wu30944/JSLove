<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta http-equiv="x-pjax-version" content="{{loadEdition('/css/app.css')}}">
    <title>{{config('app.title')}} - @yield('title', config('app.name', 'Laravel'))</title>
    <meta name="keywords" content="{{ config('app.name', 'Laravel') }}">
    <meta name="description" content="{{ config('app.name', 'Laravel') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{loadEdition('/admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{loadEdition('/admin/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{loadEdition('/admin/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{loadEdition('/admin/css/style.min.css')}}" rel="stylesheet">
    <link href="{{loadEdition('/js/dialog/ui-dialog.css')}}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{loadEdition('/icon/icon.png')}}" />
    @yield('css')
</head>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    @include('flash::message')
    @include('admin.commons._menu')
    @include('admin.commons._wrapper')

</div>
<script src="{{loadEdition('/js/jquery.min.js')}}"></script>
<script src="{{loadEdition('/admin/js/bootstrap.min.js')}}"></script>
<script src="{{loadEdition('/admin/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{loadEdition('/admin/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{loadEdition('/js/plugins/layer/src/layer.js')}}"></script>
<script src="{{loadEdition('/admin/js/plugins/pace/pace.min.js')}}"></script>
<script src="{{loadEdition('/admin/js/content.min.js')}}"></script>
<script src="{{loadEdition('/js/dialog/artdialog.js')}}"></script>

@yield('js')
<script>
    $(function(){$("#side-menu").metisMenu();});

    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);


    var iframeNo;
    $(".J_menuItem").click(function()
    {
//        if(document.addEventListener){// firefox
//            document.frames["iframe"+this.name].addEventListener("load", documentLoaded, false);}
//        else{// ie
//            document.frames["iframe"+this.name].attachEvent("onload", documentLoaded);
//        }
        var IFrameName = "iframe"+this.name;

        if(window.frames[IFrameName]) {
//            alert("存在");
        }
        else{
            iframeNo = showLoadLayer();
        }


    });

//    function documentLoaded(){
//
//    }

    function finish() {
        layer.close(iframeNo);
    }


    /*
* 當使用ajax傳送資料到後端，會叫用此function，告訴使用者載入中
* */
    function showLoadLayer(){
        return layer.msg('{{trans('message.data_loading')}}', {
            icon: 16,
            shade: [0.5, '#f5f5f5'],
            scrollbar: false,
//            offset: '0px',
            time:40000
        }) ;
    }


</script>
@yield('footer-js')
</body>
</html>
