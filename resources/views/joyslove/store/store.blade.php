<!--/customer-->
@if(count($StoreInfo)>0)

        <div class="comments" id="client">
            <div class="container">
                <div class="comments-main">
                    <div class="comments-head">
                        <h3>@lang('default.store_info')</h3>
                        <p>Lorem ipsum dolor sit amet,vehicula vel sapien et</p>
                    </div>
                    @foreach($StoreInfo as $index => $item)
                        <div class="comments-top" >
                            <div class="col-md-6 comments-bottom  col-md-6">
                                <div class="comments-left">
                                    <span class="fa fa-quote-right"></span>
                                </div>
                                <div class="comments-right">
                                    <h3>{{$item->store_name}}</h3>
                                    <!--</p>-->
                                    <div class="visit">
                                        <div class="col-md-2 col-sm-2 col-xs-2 contact-icon">
                                            <span class="fa fa-home" aria-hidden="true"></span>
                                        </div>
                                        <div class="col-md-10 col-sm-10 col-xs-10 contact-text">
                                            <h4>@lang('default.address')</h4>
                                            <p>{{$item->address}}</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="visit">
                                        <div class="col-md-2 col-sm-2 col-xs-2 contact-icon">
                                            <span class="fa fa-clock-o" aria-hidden="true"></span>
                                        </div>
                                        <div class="col-md-10 col-sm-10 col-xs-10 contact-text">
                                            <h4>@lang('default.open_time')</h4>
                                            <p>Mon-Sat {{$item->open_time}} ~ {{$item->close_time}}</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="visit">
                                        <div class="col-md-2 col-sm-2 col-xs-2 contact-icon">
                                            <span class="fa fa-phone" aria-hidden="true"></span>
                                        </div>
                                        <div class="col-md-10 col-sm-10 col-xs-10 contact-text">
                                            <h4>@lang('default.contact_us')</h4>
                                            <p>{{$item->telephone}}</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    {{--<div class="visit">--}}
                                        {{--<div class="col-md-2 col-sm-2 col-xs-2 contact-icon">--}}
                                            {{--<span class="fa fa-clock-o" aria-hidden="true"></span>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-10 col-sm-10 col-xs-10 contact-text">--}}
                                            {{--<h4>Work hours</h4>--}}
                                            {{--<p>Mon-Sat 09:00 AM - 05:00PM</p>--}}
                                        {{--</div>--}}
                                        {{--<div class="clearfix"></div>--}}
                                    {{--</div>--}}

                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-md-6 ">
                            </div>
                        </div>
                        <div class="map_w3layouts col-md-6">
                            <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6147757.32442003!2d8.222917766116648!3d41.203578759977894!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12d4fe82448dd203%3A0xe22cf55c24635e6f!2sItaly!5e0!3m2!1sen!2sin!4v1512728449699"-->
                            <!--frameborder="0" style="border:0" allowfullscreen></iframe>-->
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3614.7187316836335!2d121.53007681454501!3d25.043617644060806!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3442a97cbc9c5815%3A0x63b1367d49edb5d7!2z5bCx5piv5oSbIOWFieiPr-eFjumkheaenOWtkC7nibnoibLpo6_ns7A!5e0!3m2!1szh-TW!2stw!4v1520832221949"
                                    frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

<!--//customer-->
@endif