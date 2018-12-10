<div id="query_content">
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
                                    <div class="col-md-6 divbox" id="{{$menu->id}}">
                                        <div class="menu-text_wthree">

                                            <div class="col-md-3">
                                                <div class="img-div">
                                                    <img src="{{$menu->photo}}" alt="" class="img-responsive">
                                                </div>
                                                <div class="clearfix"> </div>
                                            </div>
                                            <div class="col-md-6" >
                                                <h4 style="">{{$menu->prod_name}}</h4>
                                                <h4>{{$menu->prod_intro}}</h4>
                                                <div class="">
                                                    <h4>${{$menu->price}}</h4>
                                                </div>
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
        <div class="clearfix"></div>
    </div>
</div>