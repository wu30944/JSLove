<div id="edit_modal" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                @lang("default.edit")
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="form_edit" enctype="multipart/form-data">
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
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="zh_company_name">@lang('default.zh_company_name'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="zh_company_name" name="zh_company_name" >
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="en_company_name">@lang('default.en_company_name'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="en_company_name" name="en_company_name" >
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="edit_address">@lang('default.address'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="address"  name="address">
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="fex">@lang('default.fex'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="fex" name="fex">
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="telephone">@lang('default.telephone'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="telephone" name="telephone">
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">@lang('default.email'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="uniform_number">@lang('default.uniform_number'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="uniform_number" name="uniform_number">
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
                        </div>
                        <div class="tab-pane fade" id="jmeter">
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                {{--<label class="control-label col-sm-2" for="zh_introduction">@lang('default.zh_introduction'):</label>--}}
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="zh_introduction" name="zh_introduction">
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="ejb">
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                {{--<label class="control-label col-sm-2" for="en_introduction">@lang('default.en_introduction'):</label>--}}
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="en_introduction" name="en_introduction">
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="modal-footer">
                        <p class="error text-center alert alert-danger hidden"></p>

                        <button type="submit" class="btn btn-success" id="btn-edit" >
                            <span class='glyphicon glyphicon-ok'> </span> @lang('default.store')
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> @lang('default.cancel')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>