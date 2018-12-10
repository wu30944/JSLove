<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>就是愛POS - <?php echo $__env->yieldContent('title', config('app.name', '就是愛')); ?></title>
    <meta name="keywords" content="<?php echo e(config('app.name', 'Laravel')); ?>">
    <meta name="description" content="<?php echo e(config('app.name', 'Laravel')); ?>">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <link rel="shortcut icon" href="/favicon.ico">
    <link href="<?php echo e(loadEdition('/admin/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(loadEdition('/admin/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(loadEdition('/admin/css/animate.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(loadEdition('/admin/css/style.min.css')); ?>" rel="stylesheet">

    
    <link href="<?php echo e(loadEdition('/admin/css/nprogress.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(loadEdition('/admin/css/view.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body class="gray-bg" >
<div class="wrapper wrapper-content animated fadeInRight">
    <?php
        $admin = Auth::guard('admin')->user();
    ?>
    <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <input type="text" class="form-control hide" id="user_id" disabled value="<?php echo e($admin->name); ?>">
    <!-- 添加 Pjax 设置：(必须有一个空元素放加载的内容) -->
    
        <?php echo $__env->yieldContent('content'); ?>
    
</div>
<script src="<?php echo e(loadEdition('/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(loadEdition('/admin/js/bootstrap.min.js')); ?>"></script>

<script src="<?php echo e(loadEdition('/js/plugins/ckeditor/ckeditor.js')); ?>"></script>
<script src="<?php echo e(loadEdition('/js/plugins/ckeditor/ckeditor_api.js')); ?>"></script>

<?php echo $__env->yieldContent('js'); ?>





<script src="<?php echo e(loadEdition('/admin/js/nprogress.js')); ?>"></script>



<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

    var i ;

    $(document).ready(function()
    {
        NProgress.start();

        $(document).on('show.bs.modal', '.modal', function (event) {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);

        });
    });

    $(window).load(function() {
        NProgress.done();
        closeLoadLayer(i);
    });
    /*
    * 當使用ajax傳送資料到後端，會叫用此function，告訴使用者載入中
    * */
    function showLoadLayer(){
        return layer.msg('<?php echo e(trans('message.data_loading')); ?>', {
            icon: 16,
            shade: [0.5, '#f5f5f5'],
            scrollbar: false,
//            offset: '0px',
            time:100000
        }) ;
    }

    /*
    * 當後端資料完成後，回到前端，會將一開始顯示載入中的畫面關閉
    * */
    function closeLoadLayer(index){
        layer.close(index);
    }
//    function ityzl_SHOW_TIP_LAYER(){
//        layer.msg('恭喜您，加载完成！',{time: 1000,offset: '10px'});
//    }

    $(document).on('click', '.btn-submit', function() {
        NProgress.start();
        i=showLoadLayer();
    });

</script>
<?php echo $__env->yieldContent('footer-js'); ?>
</body>
</html>