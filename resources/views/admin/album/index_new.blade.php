@extends('admin.layouts.layout')

@section('css')
    <style>
        .animated{-webkit-animation-fill-mode: none;}
        .table-borderless tbody tr td, .table-borderless tbody tr th,
        .table-borderless thead tr th {
            border: none;
        }

    </style>
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">

    {{--2018/01/08  相簿資料維護--}}
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <!-- Generic page styles -->
    <link rel="stylesheet" href="{{ loadEdition('/admin/css/fileupload/style.css')}}">
    <!-- blueimp Gallery styles -->
    <link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="{{loadEdition('/admin/css/fileupload/jquery.fileupload.css')}}">
    <link rel="stylesheet" href="{{loadEdition('/admin/css/fileupload/jquery.fileupload-ui.css')}}">
    <!-- CSS adjustments for browsers with JavaScript disabled -->
    <noscript><link rel="stylesheet" href="{{loadEdition('/admin/css/fileupload/jquery.fileupload-noscript.css')}}"></noscript>
    <noscript><link rel="stylesheet" href="{{loadEdition('/admin/css/fileupload/jquery.fileupload-ui-noscript.css')}}"></noscript>
    {{--2018/01/08  相簿資料維護--}}

@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox-title">
                <h5>相簿資料維護</h5>
            </div>
            <div class="ibox-content">
                <div align="right">
                    <button class="create-modal btn btn-info" value="">
                        <span class="glyphicon glyphicon-plus"></span> @lang('default.create')
                    </button>
                </div>
                <div id="partial"></div>
                @include('admin.album.query')
                @include('admin.album.create')
                @include('admin.album.destroy_album')
                @include('admin.album.destroy_photo')
            </div>
        </div>
    </div>
@endsection
@section('footer-js')
    @include('admin.album.js.album_js')
@stop