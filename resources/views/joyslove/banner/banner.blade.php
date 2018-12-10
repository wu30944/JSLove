<div class="slider">
    <div class="callbacks_container">
        <ul class="rslides callbacks callbacks1" id="slider4">
            @if(count($Banner)>0)
                @foreach($Banner as $item)
                    <li>
                        <div class="banner-top" style="background-image:url('{{$item->photo_url}}');">
                            <div class="banner-info_agile_w3ls">
                                <h3>{{$item->title}}</h3>
                                <p>{{$item->description}}</p>
                                <a href="{{$item->button_url}}" class="scroll">{{$item->button_title}} <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                {{--<a href="#mail" class="scroll">Contact Us <i class="fa fa-caret-right" aria-hidden="true"></i></a>--}}
                            </div>
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
    <div class="clearfix"> </div>
    <!--banner Slider starts Here-->
</div>
{{--<li>--}}
{{--<div class="banner-top" style="background-image:url('/storage/album/主題式全頁相簿/banner1.jpg');">--}}
{{--<div class="banner-info_agile_w3ls">--}}
{{--<h3>Come hungry. <span>Leave</span> happy.</h3>--}}
{{--<p>Small change,Big differences.</p>--}}
{{--<a href="#about" class="scroll">Read More <i class="fa fa-caret-right" aria-hidden="true"></i></a>--}}
{{--<a href="#mail" class="scroll">Contact Us <i class="fa fa-caret-right" aria-hidden="true"></i></a>--}}
{{--</div>--}}
{{--</div>--}}
{{--</li>--}}
{{--<li>--}}
{{--<div class="banner-top1">--}}
{{--<div class="banner-info_agile_w3ls">--}}
{{--<h3>Better Ingredients. <span> Better</span> Food.</h3>--}}
{{--<p>Small change,Big differences.</p>--}}
{{--<a href="#about" class="scroll">Read More <i class="fa fa-caret-right" aria-hidden="true"></i></a>--}}
{{--<a href="#mail" class="scroll">Contact Us <i class="fa fa-caret-right" aria-hidden="true"></i></a>--}}
{{--</div>--}}

{{--</div>--}}
{{--</li>--}}
{{--<li>--}}
{{--<div class="banner-top2">--}}
{{--<div class="banner-info_agile_w3ls">--}}
{{--<h3>Come hungry. <span>Leave</span> happy.</h3>--}}
{{--<p>Small change,Big differences.</p>--}}
{{--<a href="#about" class="scroll">Read More <i class="fa fa-caret-right" aria-hidden="true"></i></a>--}}
{{--<a href="#mail" class="scroll">Contact Us <i class="fa fa-caret-right" aria-hidden="true"></i></a>--}}
{{--</div>--}}

{{--</div>--}}
{{--</li>--}}
{{--<li>--}}
{{--<div class="banner-top3">--}}
{{--<div class="banner-info_agile_w3ls">--}}
{{--<h3>Better Ingredients. <span> Better</span> Food.</h3>--}}
{{--<p>Small change,Big differences.</p>--}}
{{--<a href="#about" class="scroll">Read More <i class="fa fa-caret-right" aria-hidden="true"></i></a>--}}
{{--<a href="#mail" class="scroll">Contact Us <i class="fa fa-caret-right" aria-hidden="true"></i></a>--}}
{{--</div>--}}

{{--</div>--}}
{{--</li>--}}