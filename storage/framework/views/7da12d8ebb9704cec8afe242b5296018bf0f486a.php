<div class="row">
    <div class="col-sm-12">
        <div class="ibox-title">
            <h5><?php echo app('translator')->getFromJson('default.add'); ?></h5>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal m-t-md" id="form_edit">
                <div class="form-group">
                    <input type="text" id="edit_id" name="store_name" style="display:none;">
                    <label class="col-sm-2 control-label"><?php echo app('translator')->getFromJson('default.branch_store_name'); ?>：</label>
                    <div class="col-sm-4">
                        <input type="text" id="edit_store_name" name="store_name" value="<?php echo e(old('name')); ?>" class="form-control" required data-msg-required="<?php echo e(trans('message.err_flavor_name')); ?>">
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo app('translator')->getFromJson('default.post_number'); ?>：</label>
                    <div class="col-sm-4">
                        <input type="text" id="edit_local" name="local" value="<?php echo e(old('name')); ?>" class="form-control" >
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo app('translator')->getFromJson('default.telephone'); ?>：</label>
                    <div class="col-sm-4">
                        <input type="text" id="edit_telephone" name="telephone" value="<?php echo e(old('name')); ?>" class="form-control" >
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo app('translator')->getFromJson('default.address'); ?>：</label>
                    <div class="col-sm-4">
                        <input type="text" id="edit_address" name="address" value="<?php echo e(old('name')); ?>" class="form-control" >
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo app('translator')->getFromJson('default.open_time'); ?>：</label>
                    <div class="col-sm-4">
                        <input type="text" id="edit_open_time" name="open_time" value="<?php echo e(old('name')); ?>" class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo app('translator')->getFromJson('default.close_time'); ?>：</label>
                    <div class="col-sm-4">
                        <input type="text" id="edit_close_time" name="close_time" value="<?php echo e(old('name')); ?>" class="form-control">
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo app('translator')->getFromJson('default.is_hide'); ?>：</label>
                    <div class="col-sm-2">
                        <select name="is_hidden" class="form-control" id="edit_is_hidden">
                            <option value="1"><?php echo app('translator')->getFromJson('default.show'); ?></option>
                            <option value="0"><?php echo app('translator')->getFromJson('default.hide'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo app('translator')->getFromJson('default.status'); ?>：</label>
                    <div class="col-sm-2">
                        <select name="status" class="form-control" id="edit_status">
                            <option value="1" >启用</option>
                            <option value="0" >禁用</option>
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset-2">
                        <button class="btn btn-primary btn-store" type="submit"><i class="fa fa-check"></i>&nbsp;<?php echo app('translator')->getFromJson('default.store'); ?></button>
                        
                    </div>
                </div>
                <div class="clearfix"></div>
                <?php echo e(csrf_field()); ?>

            </form>
        </div>
    </div>
</div>
