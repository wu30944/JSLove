<div class="">
    <section id="new">
        <div class="row">
            <br>
        </div>
        <div class="modal-header row" style="height:260px;" id="OrderTop">
            <div class="col-md-6 col-xs-6">
                <table>
                    <tr>
                        <td><h2><p id="Item" style="font-weight:bold;" >尚未選擇項目</p></h2></td>
                        <td><h2><p id="Number" style="font-weight:bold;"></p></h2></td>
                    </tr>

                </table>
            </div>

            <div class="col-md-6 col-xs-6 content" id="Content" style="width:40%;height:240px;overflow-y:auto;">
                <table id="Flavor" align="center" class="table table-bordered scrollable" style="font-size: 16px;">
                    <thead>
                        <td>@lang('default.flavor')</td>
                        <td>@lang('default.number')</td>
                        <td>@lang('default.money')</td>
                        <td>@lang('default.edit')</td>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <input id="order_serial_no" type="text" value="" style="display:none">
        </div>

        <div class="row">
            <div class="col-md-8 col-xs-8">
                <ul id="myTab" class="nav nav-tabs">
                    @if(isset($Title))
                        @for($i=0;$i<$Title->count();$i++)
                            @if($i==0)
                                <li class="active">
                                    <a href="#{{$Title[$i]["menu_name"]}}" data-toggle="tab">
                                        @lang('default.pancake')
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="#{{$Title[$i]["menu_name"]}}" data-toggle="tab">
                                        @lang('default.rice_ball')
                                    </a>
                                </li>
                            @endif
                        @endfor
                    @endif
                </ul>
                <div id="myTabContent" class="tab-content col-md-12">
                    @if(isset($Title))
                        @for($i=0;$i<$Title->count();$i++)
                            @if($i==0)
                                <div class="tab-pane fade in active" id="{{$Title[$i]["menu_name"]}}">
                            @else
                                <div class="tab-pane fade" id="{{$Title[$i]["menu_name"]}}">
                            @endif
                                    @if(isset($Menu))
                                        @foreach($Menu as $menu)
                                            @if($menu->menu_name == $Title[$i]["menu_name"])
                                                <div class="col-md-6 divbox PressEvent" id="{{$menu->id}}" data-flavorid="{{$menu->id}}" data-flavor="{{$menu->prod_name}}" data-Money="{{$menu->price}}">
                                                    <div class="menu-text_wthree">

                                                        <div class="col-md-4">
                                                            <div class="img-div">
                                                                <img src="{{$menu->photo}}" alt="" class="img-responsive" >
                                                            </div>
                                                            <div class="clearfix"> </div>
                                                        </div>
                                                        <div class="col-md-8" style="line-height:100px;color:black;">
                                                            <h1 style="">{{$menu->prod_name}}<font style="color:red;">${{$menu->price}}</font></h1>
                                                            {{--<font size="4">{{$menu->prod_name}}</font><font style="color:red;" size="4">${{$menu->price}}</font>--}}
                                                        </div>
                                                        <div class="clearfix"> </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                        @endfor
                    @endif
                </div>
            </div>
            <div class="col-md-4 col-xs-4">
                <div><h2>數量：</h2></div>
                <div class="row">
                    <div class="DivCal Calculate" data-value="1">
                        <div class="menu-text_wthree">
                            <div class="col-md-3">
                                <div class="img-div"  style="text-align:center;line-height:100px;border:none;">
                                    <p>
                                        <font size="6">1</font>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="DivCal Calculate" data-value="2">
                        <div class="menu-text_wthree">
                            <div class="col-md-3">
                                <div class="img-div"  style="text-align:center;line-height:100px;border:none;">
                                    <p>
                                        <font size="6">2</font>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="DivCal Calculate" data-value="3">
                        <div class="menu-text_wthree">
                            <div class="col-md-3">
                                <div class="img-div"  style="text-align:center;line-height:100px;border:none;">
                                    <p>
                                        <font size="6">3</font>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="DivCal Calculate" data-value="4">
                        <div class="menu-text_wthree">
                            <div class="col-md-3">
                                <div class="img-div"  style="text-align:center;line-height:100px;border:none;">
                                    <p>
                                        <font size="6">4</font>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="DivCal Calculate" data-value="5">
                        <div class="menu-text_wthree">
                            <div class="col-md-3">
                                <div class="img-div"  style="text-align:center;line-height:100px;border:none;">
                                    <p>
                                        <font size="6">5</font>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="DivCal Calculate" data-value="6">
                        <div class="menu-text_wthree">
                            <div class="col-md-3">
                                <div class="img-div"  style="text-align:center;line-height:100px;border:none;">
                                    <p>
                                        <font size="6">6</font>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="DivCal Calculate" data-value="7">
                        <div class="menu-text_wthree">
                            <div class="col-md-3">
                                <div class="img-div"  style="text-align:center;line-height:100px;border:none;">
                                    <p>
                                        <font size="6">7</font>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="DivCal Calculate" data-value="8">
                        <div class="menu-text_wthree">
                            <div class="col-md-3">
                                <div class="img-div"  style="text-align:center;line-height:100px;border:none;">
                                    <p>
                                        <font size="6">8</font>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="DivCal Calculate" data-value="9">
                        <div class="menu-text_wthree">
                            <div class="col-md-3">
                                <div class="img-div"  style="text-align:center;line-height:100px;border:none;">
                                    <p>
                                        <font size="6">9</font>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="DivCal Correction">
                        <div class="menu-text_wthree">
                            <div class="col-md-3">
                                <div class="img-div"  style="text-align:center;line-height:100px;border:none;">
                                    <p>
                                        <font size="6">x</font>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-lg" id="check">
                        <span class='glyphicon glyphicon-check'></span> @lang('default.add')
                    </button>
                    {{csrf_field()}}
                    <button type="button" class="btn btn-primary btn-finish btn-lg" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> @lang('default.finish')
                    </button>
                </div>
            </div>
            {{--</div>--}}
        </div>
        <div class="row">
            <br>
            <br><br>
            <br>
        </div>
    </section>
</div>