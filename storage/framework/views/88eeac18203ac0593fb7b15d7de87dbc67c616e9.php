<!--右侧部分开始-->
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i
                            class="fa fa-bars"></i> </a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown hidden-xs">
                    <a href="/" target="_blank"><i class="fa fa-home"></i> <?php echo app('translator')->getFromJson('default.back_side_home'); ?></a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row content-tabs">
        <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
        </button>
        <nav class="page-tabs J_menuTabs">
            <div class="page-tabs-content">
                <a href="javascript:;" class="active J_menuTab" data-id="index_v1.html"><?php echo app('translator')->getFromJson('default.home'); ?></a>
            </div>
        </nav>
        <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
        </button>
        <div class="btn-group roll-nav roll-right">
            <button class="dropdown J_tabClose" data-toggle="dropdown"><?php echo app('translator')->getFromJson('default.close_option'); ?><span class="caret"></span>

            </button>
            <ul role="menu" class="dropdown-menu dropdown-menu-right">
                <li class="J_tabShowActive"><a>定位当前选项卡</a>
                </li>
                <li class="divider"></li>
                <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                </li>
                <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                </li>
            </ul>
        </div>
        <a href="<?php echo e(route('admin.logout')); ?>" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i>
            <?php echo app('translator')->getFromJson('default.exit'); ?></a>
    </div>
    <div class="row J_mainContent" id="content-main">
        <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="<?php echo e(route('index.main')); ?>" frameborder="0" data-id="index_v1.html" seamless></iframe>
    </div>
    <div class="footer">
        <div class="pull-right">就是愛企業社 &copy; 2017-2018 <a href="" target="_blank"><?php echo e(config('app.name')); ?></a>
        </div>
    </div>
</div>
<!--右侧部分结束-->