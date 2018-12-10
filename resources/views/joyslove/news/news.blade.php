@section('css')
    <style>
        #div img {
            max-width:550px;
            myimg:expression(onload=function(){
            this.style.width=(this.offsetWidth > 550)?"550px":"auto"});
            max-height:400px;
            myimg:expression(onload=function(){
            this.style.height=(this.offsetHeight > 400)?"400px":"auto"});
        }
    </style>
@endsection
<!--/services-->
<div class="choose" id="news">
    <div class="container">
        <div class="choose-main">
            <div class="col-md-5 choose-left">
                <h2>最新消息</h2>
            </div>
            <div class="col-md-7 choose-right">
                @if(count($News)>0)
                    @foreach($News as $index => $item)
                        <div class="col-md-6 " >
                            <h3>{{$item->title}}</h3>
                            @if($item->action_date!='')
                                <p> <span class="fa fa-clock-o" aria-hidden="true"></span>@lang('default.time'): {{$item->action_date}} {{$item->action_time}}</p>
                            @endif
                            @if($item->action_position!='')
                                <p> <span class="fa fa-map-marker" aria-hidden="true"></span>@lang('default.position'): {{$item->action_position}}</p>
                            @endif{{--{{$item->content}}--}}
                            {{--{{strlen(mb_substr(strip_tags ($item->content),0,25,"utf-8"))}}...--}}
                            {{mb_substr(strip_tags ($item->content),0,100,"utf-8")}}
                            <?php if(strlen(mb_substr(strip_tags ($item->content),0,25,"utf-8"))>=20) echo '<a class="active" href="#" data-toggle="modal" data-target="#'.$item->id.'">...</a>'?>
                            <?php if($index%2==1) echo '<div class="clearfix"></div></br>'?>
                        </div>
                    @endforeach
                @endif

                {{--<div class="col-md-6 choose-right-top">--}}
                {{--<h4>營業時間調整</h4>--}}
                {{--<p style="color:black;">星期一～星期六 <br>--}}
                {{--<div class="col-md-2 col-sm-2 col-xs-2 contact-icon">--}}
                {{--<span class="fa fa-clock-o" aria-hidden="true"></span>--}}
                {{--</div>--}}
                {{--中午 12:00 ~ 晚上 07:30</p>--}}
                {{--</div>--}}
                {{--<div class="col-md-6 choose-right-top">--}}
                {{--<h4>最新菜單</h4>--}}
                {{--<img src="http://joyslove/storage/album/菜單/0.jpg" alt=" " class="img-responsive" />--}}
                {{--<a class="active" href="#" data-toggle="modal" data-target="#myModal">@lang('default.check')</a>--}}
                {{--</div>--}}
                {{--<div class="clearfix"></div>--}}
                {{--<div class="col-md-6 choose-right-top">--}}
                {{--<h4>節省您的荷包</h4>--}}
                {{--<p>--}}
                {{--想要省荷包又可吃到美味的煎餅果子或飯糰嗎？我們們現在與GOMAJI合作，可以透過購買<a href="http://www.gomaji.com/deal.php?pid=196255">GOMAJI</a>--}}
                {{--的兌換券，到店兌換美味的飯糰或是煎餅果子，為你大大節省荷包 <br>--}}
                {{--下方連結為GOMAJI購買連結--}}
                {{--<a href="http://www.gomaji.com/deal.php?pid=196255">http://www.gomaji.com/deal.php?pid=196255</a>--}}
                {{--</p>--}}
                {{--</div>--}}

                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--//services-->
@if(count($News)>0)
    @foreach($News as $index => $item)
        <div class="modal video-modal fade" id="{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        {{$item->title}}
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <div id="div" class="modal-body" style="color:black;">
                        @if($item->action_date!='')
                            <p><span class="fa fa-clock-o" aria-hidden="true"></span> @lang('default.time'): {{$item->action_date}} {{$item->action_time}}</p>
                        @endif
                        @if($item->action_position!='')
                            <p><span class="fa fa-map-marker" aria-hidden="true"></span> @lang('default.position'): {{$item->action_position}}</p>
                        @endif
                        <div class="box">
                        {!! $item->content !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
