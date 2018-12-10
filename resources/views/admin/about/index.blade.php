@extends('admin.layouts.layout')
@section('css')
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
    <style>
        .animated{-webkit-animation-fill-mode: none;}
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox-title">
                <h5>關於我們</h5>
            </div>
            <div class="ibox-content">
                {{--<a class="menuid btn btn-primary btn-sm" href="javascript:history.go(-1)">@lang('default.return')</a> &nbsp;--}}
                <button class="create-modal btn btn-info" value="">
                    <span class="glyphicon glyphicon-plus"></span> @lang('default.create')
                </button>

                <div id="partial"></div>
                @include('admin.about.query')
                @include('admin.about.destroy')
                @include('admin.about.edit')
                @include('admin.about.create')
            </div>
        </div>
    </div>
@endsection
@section('footer-js')
    @include('admin.about.js.about_js')
@endsection

