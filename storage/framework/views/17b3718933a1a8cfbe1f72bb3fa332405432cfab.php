<?php $__env->startSection('header',__('main.users')); ?>
<?php $__env->startSection('small_header',__('main.profile')); ?>
<?php $__env->startSection('content'); ?>
    <br>
    <div class="box box-primary">
        <!-- form start -->
        <form role="form" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            
            <div class="box-body">
                
                <img src="<?php echo e(asset($obj->avatar)); ?>" style="width:120px;height:80px;"/>
                
                <div class="form-group">
                    <label><?php echo e(__('main.avatar')); ?></label>
                    <input type="file" name="picture">
                </div>

                <div class="form-group">
                    <label><?php echo e(__('main.fullname')); ?>*</label>
                    <input type="text" class="form-control" name="fullname" value="<?php echo e($obj->fullname); ?>">
                    <?php if ($errors->has('fullname')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('fullname'); ?>
                        <div class="error"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                </div>

                <div class="form-group">
                    <label><?php echo e(__('main.email')); ?>*</label>
                    <input type="text" class="form-control" name="email" value="<?php echo e($obj->email); ?>">
                    <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
                        <div class="error"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                </div>

                <div class="form-group">
                    <label><?php echo e(__('main.phone')); ?>*</label>
                    <input type="text" class="form-control" name="phone" value="<?php echo e($obj->phone); ?>">
                    <?php if ($errors->has('phone')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('phone'); ?>
                        <div class="error"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                </div>

                <div class="form-group">
                    <label><?php echo e(__('main.address')); ?>*</label>
                    <input type="text" class="form-control" name="address" value="<?php echo e($obj->address); ?>">
                    <?php if ($errors->has('address')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('address'); ?>
                    <div class="error"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                </div>

            </div>
            
            <?php if(session('status')): ?>
                <div class=“alert alert-success”>
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>
            
            <div class="box-footer">
                <button type="submit" class="btn btn-primary"><?php echo e(__('main.update')); ?></button>
            </div>
        </form>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/qcexpress/resources/views/admin/users/profile.blade.php ENDPATH**/ ?>