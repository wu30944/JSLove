<div class="mail" id="mail" style="background-color:#101325;">
    <div class="container">
        <h3>與就是愛聯絡</h3>
        <div class="mail_grids_wthree_agile_info">
            <div class="col-md-7 mail_grid_right_agileits_w3">
                <h5>@lang('default.fill_form')</h5>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <h4>有錯誤發生：</h4>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route('joyslove.submit')}}" method="post" id="contact_form">
                    {{csrf_field()}}
                    <div class="col-md-6 col-sm-6 contact_left_grid">
                        <input type="text" name="name" placeholder="@lang('default.name')" required="" oninvalid="InvalidMsg(this);" value="{{old('name')}}">
                        <input type="email" name="email" placeholder="@lang('default.email')" required="" oninvalid="InvalidMsg(this);"  oninput="InvalidMsg(this);" value="{{old('email')}}">
                    </div>
                    <div class="col-md-6 col-sm-6 contact_left_grid">
                        <input type="text" name="telephone" placeholder="@lang('default.telephone')" required="" oninvalid="InvalidMsg(this);" value="{{old('telephone')}}">
                        <input type="text" name="subject" placeholder="@lang('default.subject')" required="" oninvalid="InvalidMsg(this);" value="{{old('subject')}}">
                    </div>
                    <div class="clearfix"> </div>
                    <textarea name="message" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '@lang('default.content')...';}" required="" >@if(old('message')) {{old('message')}} @else @lang('default.content')...@endif</textarea>
                    <div class="col-md-12 col-sm-12 contact_left_grid">
                        <a  onclick="$('#captcha_img').attr('src','/captcha/flat?'+Math.random()); $('#captcha_img').removeClass('hide');" style="cursor: pointer" >點我產生驗證碼</a>
                    </div>
                    <div class="col-md-12 col-sm-12 contact_left_grid">
                        <input type="text" id="captcha" name="captcha" placeholder="{{trans('default.valid_code')}}" required="" oninvalid="InvalidMsg(this);">
                    {{--</div>--}}
                    {{--<div class="col-md-6 col-sm-6 contact_left_grid">--}}

                        {{--<img class="thumbnail captcha" src="{{captcha_src('flat')}}" style="cursor: pointer" onclick="this.src='{{captcha_src()}}'+Math.random()" title="點擊圖片重新獲取驗證碼">--}}
                        <img id="captcha_img" style="cursor: pointer"  class="thumbnail captcha hide" onclick="this.src='/captcha/flat?'+Math.random()" title="點擊圖片重新獲取驗證碼" hidden>

                    </div>
                    <input type="submit" value="@lang('default.submit')" id="btn-submit">
                    <input type="reset" value="@lang('default.clear')">

                </form>
            </div>
            <div class="col-md-5 contact-left">
                <h5>@lang('default.contact_info')</h5>
                <div class="visit">
                    <div class="col-md-2 col-sm-2 col-xs-2 contact-icon">
                        <span class="fa fa-home" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-10 contact-text">
                        <h4>Visit us</h4>
                        <p>{{$About['address']}}</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="mail-us">
                    <div class="col-md-2 col-sm-2 col-xs-2 contact-icon">
                        <span class="fa fa-envelope" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-10 contact-text">
                        <h4>Mail us</h4>
                        <p><a href="{{$About['email']}}">{{$About['email']}}</a></p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="visit">
                    <div class="col-md-2 col-sm-2 col-xs-2 contact-icon">
                        <span class="fa fa-phone" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-10 contact-text">
                        <h4>Call us</h4>
                        <p>{{$About['telephone']}}</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="visit">
                    <div class="col-md-2 col-sm-2 col-xs-2 contact-icon">
                        <span class="fa fa-clock-o" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-10 contact-text">
                        <h4>Work hours</h4>
                        <p>Mon-Sat 09:00 AM - 05:00PM</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>