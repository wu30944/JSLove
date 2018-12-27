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
                <h5>畫廊資料維護</h5>
            </div>
            <div class="ibox-content">
                <div align="left">
                    <div class="col-sm-2 ui-widget">
                        <input type="text" class="form-control" placeholder="標題" id="search_title">
                    </div>
                    <div class="col-sm-2">
                        <button class="btn-search btn btn-info" id="btn_search">
                            <span class="glyphicon glyphicon-edit"></span> @lang('default.edit')
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
                 @include('admin.gallery.query')
                 @include('admin.gallery.destroy')

                 @include('admin.gallery.edit')
                 @include('admin.gallery.create')
            </div>
        </div>
    </div>

@endsection
@section('footer-js')
    @include('admin.gallery.js.gallery_js')
@endsection