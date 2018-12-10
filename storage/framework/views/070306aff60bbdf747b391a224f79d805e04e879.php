

<?php $__env->startSection('title', '成功提示'); ?>

<?php $__env->startSection('content'); ?>
    <div class="sa-icon sa-success animate">
        <span class="sa-line sa-tip animateSuccessTip"></span>
        <span class="sa-line sa-long animateSuccessLong"></span>
        <div class="sa-placeholder"></div>
        <div class="sa-fix"></div>
    </div>
    <h2><?php echo e($message); ?></h2>
    <p><?php echo app('translator')->getFromJson('message.page_auto_transform'); ?>：<b id="wait"><?php echo e($wait); ?></b><a id="href" style="display:none" href="<?php echo e($url); ?>"><?php echo app('translator')->getFromJson('message.click_transform'); ?></a></p>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.commons.prompt_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>