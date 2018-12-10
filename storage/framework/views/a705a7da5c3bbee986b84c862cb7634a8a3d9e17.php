<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title><?php echo e(config('app.title')); ?> - <?php echo e(config('app.name', '就是愛後台管理系統')); ?></title>
    <meta name="keywords" content="後台登入">
    <meta name="description" content="後台登入">
    <link href="<?php echo e(loadEdition('/admin/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(loadEdition('/admin/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(loadEdition('/admin/css/animate.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(loadEdition('/admin/css/style.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(loadEdition('/admin/css/login.min.css')); ?>" rel="stylesheet">
    <script>
        if(window.top!==window.self){window.top.location=window.location};
    </script>

</head>

<body class="signin">
    <div class="signinpanel">
        <div class="row">
            <div class="col-sm-5 animated fadeInLeft">
                <div class="signin-info">
                    <div class="logopanel m-b">
                        <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <h1><?php echo e(config('app.name', 'Laravel')); ?></h1>
                    </div>
                    <div class="m-b"></div>
                    <h4><?php echo app('translator')->getFromJson('default.welcome_use'); ?> <span class="label label-info"><?php echo e(config('app.name', 'Laravel')); ?></span></h4>
                    
                        
                        
                        
                        
                        
                    
                </div>
            </div>
            <div class="col-sm-7 animated fadeInRight">
                <form method="post" action="<?php echo e(route('login-handle')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <p class="login-title"><?php echo app('translator')->getFromJson('default.login'); ?></p>
                    <p class="m-t-md" style="color:#666"><?php echo app('translator')->getFromJson('default.login'); ?><?php echo e(config('app.name', 'Laravel')); ?>後台管理</p>
                    <input type="text" class="form-control uname" name="name" value="<?php echo e(old('name')); ?>" required placeholder="<?php echo e(trans('default.account')); ?>" />
                    <input type="password" class="form-control pword m-b" name="password" required placeholder="<?php echo e(trans('default.password')); ?>" />
                    
                        
                    
                    <p></p>
                    <button class="btn btn-success btn-block"><?php echo app('translator')->getFromJson('default.login'); ?></button>
                    <p></p>
                    <?php if(count($errors) > 0): ?>
                        <div class="alert alert-danger">
                            <h4>有錯誤發生：</h4>
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li> <?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
        <div class="signup-footer animated fadeInUp">
            &copy; 2018 All Rights Reserved. <?php echo e(config('app.name', 'Laravel')); ?>

        </div>
    </div>
</body>
</html>
