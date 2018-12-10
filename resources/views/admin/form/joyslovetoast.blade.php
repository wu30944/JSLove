
@extends('admin.layouts.layout')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox-title">
                <h5>@lang('default.store_apply_form')</h5>
            </div>
            <div class="ibox-content">
                <a class="menuid btn btn-primary btn-sm" href="javascript:history.go(-1)">@lang('default.return')</a>
                <a href="{{route('admins.index')}}"><button class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus-circle"></i> 管理员管理</button></a>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <form class="form-horizontal m-t-md" role="form" id="form_edit" >
                    <ul id="myTab" class="nav nav-tabs">
                        <li class="active">
                            <a href="#home" data-toggle="tab">
                                @lang('default.basic_company')
                            </a>
                        </li>
                        {{--<li><a href="#ios" data-toggle="tab">iOS</a></li>--}}
                        <li class="dropdown">
                            <a href="#" id="myTabDrop1" class="dropdown-toggle"
                               data-toggle="dropdown">@lang('default.about_us')
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
                                <li><a href="#jmeter" tabindex="-1" data-toggle="tab">@lang('default.zh_about_us')</a></li>
                                <li><a href="#ejb" tabindex="-1" data-toggle="tab">@lang('default.en_about_us')</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade in active" id="home">
                            <div class="form-group hidden">
                                <label class="control-label col-sm-2 " for="id">id:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="id" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="edit_zh_company_name">@lang('default.zh_company_name'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_zh_company_name" name="edit_zh_company_name" >
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="edit_en_company_name">@lang('default.en_company_name'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_en_company_name" name="edit_en_company_name" >
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="edit_address">@lang('default.address'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_address"  name="edit_address">
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="edit_fex">@lang('default.fex'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_fex" name="edit_fex">
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="edit_telephone">@lang('default.telephone'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_telephone" name="edit_telephone">
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="edit_email">@lang('default.email'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_email" name="edit_email">
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="edit_uniform_number">@lang('default.uniform_number'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_uniform_number" name="edit_uniform_number">
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">@lang('default.status')：</label>
                                <div class="col-sm-2">
                                    <select name="status" class="form-control" id="status">
                                        <option value="1" >@lang('default.use')</option>
                                        <option value="0" >@lang('default.not_use')</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('status')}}</span>
                                    @endif
                                </div>
                            </div>
                            <textarea cols="100" id="ckeditor" name="ckeditor" rows="10"></textarea>
                        </div>
                        <div class="tab-pane fade" id="jmeter">
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="edit_zh_introduction">@lang('default.zh_introduction'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_zh_introduction" name="edit_zh_introduction">
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="ejb">
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="edit_en_introduction">@lang('default.en_introduction'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_en_introduction" name="edit_en_introduction">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <p class="error text-center alert alert-danger hidden"></p>

                        <button type="submit" class="btn btn-store btn-success" id="editbtn" >
                            <span id="footer_action_button" class='glyphicon glyphicon-ok'> </span> @lang('default.store')
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> @lang('default.cancel')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection