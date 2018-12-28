@extends('admin.layouts.layout')
@section('css')
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
    <style>
        .animated{-webkit-animation-fill-mode: none;}
    </style>
    <link rel="stylesheet" href="/css/jquery.datetimepicker.css">

@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox-title">
                <h5>店家資訊</h5>
            </div>
            <div class="ibox-content">
                <div align="left">
                    <div class="col-sm-2 ui-widget">
                        <input type="text" class="form-control" placeholder="店家名稱" id="search_keyword">
                    </div>
                    <div class="col-sm-2">
                        <button class="btn-search btn btn-info" id="btn_search">
                            <span class="glyphicon glyphicon-search"></span> @lang('default.search')
                        </button>
                    </div>
                </div>
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
                @include('admin.store_info.query')
                @include('admin.store_info.destroy')
                @include('admin.store_info.edit')
                @include('admin.store_info.create')
            </div>
        </div>
    </div>
@endsection
@section('footer-js')
    @include('admin.store_info.js.store_info_js')
@endsection