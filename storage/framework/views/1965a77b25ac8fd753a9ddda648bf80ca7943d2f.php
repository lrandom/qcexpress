<?php $__env->startSection('header',__('main.banks')); ?>
<?php $__env->startSection('small_header',__('main.add')); ?>
<?php $__env->startSection('content'); ?>
    <div class="box box-primary">
        <!-- form start -->
        <form role="form" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="box-body">
                <div class="form-group">
                    <label><?php echo e(__('main.logo')); ?></label>
                    <input type="file" name="logo">
                </div>

                <div class="form-group">
                    <label><?php echo e(__('main.name')); ?>*</label>
                    <input type="text" class="form-control" name="name" value="">
                    <?php if ($errors->has('name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('name'); ?>
                        <div class="error"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                </div>
                
                <div class="form-group">
                    <label><?php echo e(__('main.fullname')); ?>*</label>
                    <input type="text" class="form-control" name="fullname" value="">
                    <?php if ($errors->has('fullname')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('fullname'); ?>
                        <div class="error"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                </div>

                <?php if(session('status')): ?>
                    <div class=“alert alert-success”>
                        <?php echo e(session('status')); ?>

                    </div>
                <?php endif; ?>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary"><?php echo e(__('main.add')); ?></button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/azorder/resources/views/admin/banks/add.blade.php ENDPATH**/ ?>