<!--/tab_section-->
@if(count($MenuTitle)>0)
<div class="tabs_section" id="menu">
    <div class="container">
        <h5>就是愛 MENU</h5>
        <div id="horizontalTab">
            <ul class="resp-tabs-list">
                @foreach($MenuTitle as $index => $item)
                    <li> {{$item->menu_name}}</li>
                @endforeach
                    {{--<li> TO DAY SPECIALS</li>--}}
                    {{--<li> DRINKS</li>--}}
            </ul>

            <div class="resp-tabs-container">
                @foreach($MenuTitle as $TitleIndex => $TitleItem)
                    <div class="tab1">
                        <div class="recipe-grid">
                            @foreach($MenuContent as $ContentIndex => $ContentItem)
                                @if($TitleItem->menu_name == $ContentItem->menu_name)
                                    <div class="col-md-6 menu-grids">
                                        <div class="menu-text_wthree">
                                            <div class="menu-text-left">
                                                <div class="rep-img">
                                                    <img src="{{$ContentItem->photo}}" alt=" " class="img-responsive">
                                                </div>
                                                <div class="rep-text">
                                                    <h4>{{$ContentItem->prod_name}}............</h4>
                                                    <h6>{{$ContentItem->prod_intro}}</h6>
                                                </div>

                                                <div class="clearfix"> </div>
                                            </div>
                                            <div class="menu-text-right">
                                                <h4>{{$ContentItem->price}}</h4>
                                            </div>
                                            <div class="clearfix"> </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="clearfix"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- /tabs -->
<!--//tab_section-->
@endif