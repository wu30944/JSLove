<!DOCTYPE html>
<html>
<head>
    <title>就是愛法式吐司訂購單</title>
    <meta name="keywords" content="就是愛,就是愛訂購單,法式吐司,就是愛法式吐司"/>
    <meta name="description" content="就是愛法式吐司訂購"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 引入ystep样式 -->
    <link href="{{loadEdition('/css/ystep/ystep.css')}}" rel="stylesheet">

    <link href="{{loadEdition('/admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{loadEdition('/admin/css/font-awesome.min.css')}}" rel="stylesheet">
    {{--<link href="{{loadEdition('/admin/css/animate.min.css')}}" rel="stylesheet">--}}
    <link href="{{loadEdition('/admin/css/style.min.css')}}" rel="stylesheet">

    {{--2018/04/21 進度條--}}
    <link href="{{ loadEdition('/admin/css/nprogress.css')}}" rel="stylesheet">

    <link href="{{ loadEdition('/css/joyslove/easy-responsive-tabs.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{loadEdition('/css/joyslove/style.css')}}" rel='stylesheet' type='text/css' />
    <style>
        /* 預設樣式 */
        .divbox{
            /*height:300px;*/
            /*width:200px;*/
            background:#ffffff;
            border:solid 1px #cccccc;
            float:left;
            cursor:pointer;
            /*margin-right:10px;*/
        }

        .divOverNotAllowedClick{
            /*height:300px;*/
            /*width:200px;*/
            background:#ffffff;
            border:solid 1px #cccccc;
            float:left;
            cursor:not-allowed;
            /*margin-right:10px;*/
        }

        /*  滑入時變換底色樣式 */
        .divOver{
            background:#a6e1ec;
            border:solid 1px #d2dce3;
        }

        /*  點選時變換底色樣式 */
        .divClick{
            background:#5acde2;
            border:solid 1px #d2dce3;
        }
    </style>
</head>
<body class="gray-bg" >
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">

                <div class="ibox-content">
                    {{--<a class="menuid btn btn-primary btn-sm" href="javascript:history.go(-1)">@lang('default.return')</a>--}}
                    {{--<a href="{{route('admins.index')}}"><button class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus-circle"></i> 管理员管理</button></a>--}}
                    <br><br><br><br>
                    <div align="right">
                        <h1>
                            <a href="">
                                <span class='glyphicon glyphicon-shopping-cart'></span>
                            </a>
                        </h1>
                    </div>
                    <div class="col-sm-4"></div>
                    <div class="ystep1"></div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <form class="form-horizontal m-t-md" role="form" id="form_create" >
                        {{--<ul id="myTab" class="nav nav-tabs">--}}
                            {{--<li class="active">--}}
                                {{--<a href="#employee_info" data-toggle="tab">--}}
                                    {{--@lang('default.contact_info')--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li><a href="#ios" data-toggle="tab">iOS</a></li>--}}
                            {{--<li class="dropdown">--}}
                                {{--<a href="#" id="myTabDrop1" class="dropdown-toggle"--}}
                                   {{--data-toggle="dropdown">@lang('default.about_us')--}}
                                    {{--<b class="caret"></b>--}}
                                {{--</a>--}}
                                {{--<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">--}}
                                    {{--<li><a href="#jmeter" tabindex="-1" data-toggle="tab">@lang('default.zh_about_us')</a></li>--}}
                                    {{--<li><a href="#ejb" tabindex="-1" data-toggle="tab">@lang('default.en_about_us')</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade in active" id="employee_info">
                                <br>
                                <div class="form-group hidden">
                                    <label class="control-label col-sm-2 " for="id">id:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="id" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="cname">@lang('default.cname'):</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="cname" name="cname" >
                                    </div>
                                </div>
                                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="contact_phone">@lang('default.contact_phone'):</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="contact_phone" name="contact_phone" >
                                    </div>
                                </div>
                                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="address">@lang('default.address'):</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="address"  name="address">
                                    </div>
                                </div>
                                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">@lang('default.email'):</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email" name="email">
                                    </div>
                                </div>
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


                        <ul id="myTab" class="nav nav-tabs">
                            <li class="active">
                                <a href="#sweet_flavor" data-toggle="tab">
                                    @lang('default.sweet_flavor')
                                </a>
                            </li>
                            <li>
                                <a href="#salty_flavor" data-toggle="tab">
                                    @lang('default.salty_flavor')
                                </a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content col-md-12">
                            <div class="tab-pane fade in active" id="sweet_flavor">
                                <div class="col-md-6 menu-grids divbox">
                                    <div class="menu-text_wthree">

                                        <div class="menu-text-left">
                                            <div class="rep-img">
                                                <img src="http://joyslove/storage/album/菜單/196255_3_r.jpg" alt=" " class="img-responsive">
                                            </div>
                                            <div class="rep-text" >
                                                <h4 style="color:black">經典原味煎餅果子............</h4>
                                                <h6>with wild mushrooms and asparagus</h6>
                                            </div>

                                            <div class="clearfix"> </div>
                                        </div>
                                        <div class="menu-text-right">
                                            <h4>$50</h4>
                                        </div>
                                        <div class="clearfix"> </div>
                                    </div>
                                </div>
                                <div class="col-md-6 menu-grids divbox">
                                    <div class="menu-text_wthree">

                                        <div class="menu-text-left">
                                            <div class="rep-img">
                                                <img src="http://joyslove/storage/album/菜單/196255_3_r.jpg" alt=" " class="img-responsive">
                                            </div>
                                            <div class="rep-text">
                                                <h4>經典原味煎餅果子............</h4>
                                                <h6>with wild mushrooms and asparagus</h6>
                                            </div>

                                            <div class="clearfix"> </div>
                                        </div>
                                        <div class="menu-text-right">
                                            <h4>$50</h4>
                                        </div>
                                        <div class="clearfix"> </div>
                                    </div>
                                </div>
                                <div class="col-md-6 menu-grids divbox">
                                    <div class="menu-text_wthree">

                                        <div class="menu-text-left">
                                            <div class="rep-img">
                                                <img src="http://joyslove/storage/album/菜單/196255_3_r.jpg" alt=" " class="img-responsive">
                                            </div>
                                            <div class="rep-text">
                                                <h4>經典原味煎餅果子............</h4>
                                                <h6>with wild mushrooms and asparagus</h6>
                                            </div>

                                            <div class="clearfix"> </div>
                                        </div>
                                        <div class="menu-text-right">
                                            <h4>$50</h4>
                                        </div>
                                        <div class="clearfix"> </div>
                                    </div>
                                </div>
                                <div class="col-md-6 menu-grids divbox">
                                    <div class="menu-text_wthree">

                                        <div class="menu-text-left">
                                            <div class="rep-img">
                                                <img src="http://joyslove/storage/album/菜單/196255_3_r.jpg" alt=" " class="img-responsive">
                                            </div>
                                            <div class="rep-text">
                                                <h4>經典原味煎餅果子............</h4>
                                                <h6>with wild mushrooms and asparagus</h6>
                                            </div>

                                            <div class="clearfix"> </div>
                                        </div>
                                        <div class="menu-text-right">
                                            <h4>$50</h4>
                                        </div>
                                        <div class="clearfix"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="salty_flavor">
                                <div class="col-md-6 menu-grids divbox">
                                    <div class="menu-text_wthree">

                                        <div class="menu-text-left">
                                            <div class="rep-img">
                                                <img src="http://joyslove/storage/album/菜單/196255_3_r.jpg" alt=" " class="img-responsive">
                                            </div>
                                            <div class="rep-text">
                                                <h4>經典原味煎餅果子............</h4>
                                                <h6>with wild mushrooms and asparagus</h6>
                                            </div>

                                            <div class="clearfix"> </div>
                                        </div>
                                        <div class="menu-text-right">
                                            <h4>$50</h4>
                                        </div>
                                        <div class="clearfix"> </div>
                                    </div>
                                </div>
                                <div class="col-md-6 menu-grids divbox">
                                    <div class="menu-text_wthree">

                                        <div class="menu-text-left">
                                            <div class="rep-img">
                                                <img src="http://joyslove/storage/album/菜單/196255_3_r.jpg" alt=" " class="img-responsive">
                                            </div>
                                            <div class="rep-text">
                                                <h4>經典原味煎餅果子............</h4>
                                                <h6>with wild mushrooms and asparagus</h6>
                                            </div>

                                            <div class="clearfix"> </div>
                                        </div>
                                        <div class="menu-text-right">
                                            <h4>$50</h4>
                                        </div>
                                        <div class="clearfix"> </div>
                                    </div>
                                </div>
                                <div class="col-md-6 menu-grids divbox">
                                    <div class="menu-text_wthree">

                                        <div class="menu-text-left">
                                            <div class="rep-img">
                                                <img src="http://joyslove/storage/album/菜單/196255_3_r.jpg" alt=" " class="img-responsive">
                                            </div>
                                            <div class="rep-text">
                                                <h4>經典原味煎餅果子............</h4>
                                                <h6>with wild mushrooms and asparagus</h6>
                                            </div>

                                            <div class="clearfix"> </div>
                                        </div>
                                        <div class="menu-text-right">
                                            <h4>$50</h4>
                                        </div>
                                        <div class="clearfix"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <p class="error text-center alert alert-danger hidden"></p>
                            {{--<div>--}}
                                {{--<button type="button" class="btn btn-warning" data-dismiss="modal" style="display:none">--}}
                                    {{--<span class='glyphicon glyphicon-remove'></span> @lang('default.cancel')--}}
                                {{--</button>--}}
                            {{--</div>--}}
                            <div align="left">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">
                                    <span class='glyphicon glyphicon-shopping-cart'></span> @lang('default.put_buy_car')
                                </button>
                                <button type="button" class="btn btn-warning" data-dismiss="modal" >
                                    <span class='glyphicon glyphicon-remove'></span> @lang('default.cancel')
                                </button>
                            </div>
                            <button type="submit" class="btn btn-store btn-success" id="editbtn" style="display:none">
                                <span id="footer_action_button" class='glyphicon glyphicon-ok'> </span> @lang('default.commit')
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal" style="display:none">
                                <span class='glyphicon glyphicon-remove'></span> @lang('default.cancel')
                            </button>

                            <button type="button" class="btn btn-success" data-dismiss="modal" id="prev_step">
                                <span class='glyphicon glyphicon-chevron-left'></span> @lang('default.prev_step')
                            </button>
                            <button type="submit" class="btn btn-success" data-dismiss="modal" id="next_step">
                                <span class='glyphicon glyphicon-chevron-right'></span> @lang('default.next_step')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- 引入jquery -->
<script src="{{loadEdition('/js/jquery.min.js')}}"></script>
<!-- 引入ystep插件 -->
<script src="{{loadEdition('/js/ystep/ystep.js')}}"></script>
<script src="{{loadEdition('/admin/js/bootstrap.min.js')}}"></script>


<script src="{{ loadEdition('/admin/js/jquery.pjax.min.js')}}"></script>

{{--201/04/21 進度條--}}
<script src="{{ loadEdition('/admin/js/nprogress.js')}}"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
{{--<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.cs">--}}
<script>
    //根据jQuery选择器找到需要加载ystep的容器
    //loadStep 方法可以初始化ystep
    $(".ystep1").loadStep({
        //ystep的外观大小
        //可选值：small,large
        size: "large",
        //ystep配色方案
        //可选值：green,blue
        color: "blue",
        //ystep中包含的步骤
        steps: [{
            //步骤名称
            title: "{{trans('default.step_1')}}",
            //步骤内容(鼠标移动到本步骤节点时，会提示该内容)
            content: "填寫姓名、電話、寄送地址等資訊。"
        },{
            title: "{{trans('default.step_2')}}",
            content: "選擇您需要的口味"
        },{
            title: "{{trans('default.step_3')}}",
            content: "確認訂購單內容，與寄送地址。"
        },{
            title: "{{trans('default.finish')}}",
            content: "完成訂購。"
        }]
    });

//    //跳转到下一个步骤
//    $(".ystep1").nextStep(3);
//    //跳转到上一个步骤
//    $(".ystep1").prevStep();
//    //跳转到指定步骤
    $(".ystep1").setStep(0);
//    //获取当前在第几步
//    $(".ystep1").getStep(2);

    $().ready(function() {

        $('#form_create').validate({
            rules: {
                cname: {
                    required: true
                },address: {
                    required: true
                },email: {
                    required: true,
                    email: true
                },contact_phone: {
                    required: true,
                    digits:true
                }

            },
            messages: {
                cname: '{{trans('message.err_cname')}}',
                address: '{{trans('message.err_address')}}',
                email:{required:'{{trans('message.err_email')}}',email:'{{trans('message.err_email_format')}}'},
                contact_phone :{required:'{{trans('message.err_contact_phone')}}',digits:'{{trans('message.err_digits')}}'}
            },invalidHandler:function(form){

            },success:function(error){
                //因為success，如果是文字時代表error的成功時的className，改成function時className就要寫死了。
                //不像highlight，className寫在validClass、errorClass變數中

                //增加OK文字
                error.addClass('valid').text('OK');
            }
            ,
            submitHandler: function(form) {
                $(".ystep1").nextStep();

                $("#employee_info").fadeOut(1000,function () {

                });
            }
        });


    });

    $(document).on('click', '#next_step', function() {

//        $(".ystep1").nextStep();
//
//        $("#employee_info").fadeOut(1000,function () {
//
//        });

    });

    $(document).on('click', '#prev_step', function() {

        $(".ystep1").prevStep();
//
        $("#employee_info").fadeIn(1000,function () {

        });
    });

    $(function(){
        //當滑鼠滑入時將div的class換成divOver
        $('.divbox').hover(function(){

//            alert($('.divClick').size());
                if(strSelectCount<2 || $(this).is('.divClick'))
                    $(this).addClass('divOver');
                else
                    $(this).addClass('divOverNotAllowedClick');
            },function(){
                //滑開時移除divOver樣式
                $(this).removeClass('divOver');
                 $(this).removeClass('divOverNotAllowedClick');
            }
        );

    });

    $(document).on('click', '.divbox', function() {

        if($(this).is('.divClick')){
            $(this).removeClass('divClick');
        }else{
            if(strSelectCount<2)
            {
                $(this).addClass('divClick');
            }
        }

        strSelectCount=$('.divClick').size();

    });

    var strSelectCount = 0;
</script>
</body>
</html>
