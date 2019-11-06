<?php $__env->startSection('header',__('main.users')); ?>
<?php $__env->startSection('small_header',__('main.add')); ?>
<?php $__env->startSection('content'); ?>

<?php if(session('notify')): ?>
  <div class="alert alert-success">
    <?php echo e(session('notify')); ?>

  </div>
<?php endif; ?>

<div class="box box-primary">
        <!-- form start -->
        <form role="form" method="POST" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <div class="box-body">
            
            <div class="form-group">
              <label><?php echo e(__('main.avatar')); ?></label>
              <input type="file" name="avatar">
            </div>

            <br>

            <div class="form-group">
              <label><?php echo e(__('main.level')); ?></label>
              <select class="form-control" name="per" id="per">
                <option value="0"><?php echo e(__('main.user')); ?></option>
                <option value="1"><?php echo e(__('main.admin')); ?></option>
              </select>
            </div>

            <div class="form-group">
              <label><?php echo e(__('main.fullname')); ?>*</label>
              <input type="text" class="form-control" name="fullname" value="<?php echo e(old('fullname')); ?>">
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
              <input type="text" class="form-control" name="email" value="<?php echo e(old('email')); ?>">
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
              <input type="text" class="form-control" name="phone" value="<?php echo e(old('phone')); ?>">
              <?php if ($errors->has('phone')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('phone'); ?>
                <div class="error"><?php echo e($message); ?></div>
              <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
            </div>

            <div class="form-group">
              <label><?php echo e(__('main.amount')); ?>*</label>
              <input type="number" class="form-control" name="amount" value="0">
              <?php if ($errors->has('amount')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('amount'); ?>
                <div class="error"><?php echo e($message); ?></div>
              <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
            </div>

            <div class="form-group">
              <label><?php echo e(__('main.buy_fee')); ?> (%)</label>
              <input type="number" class="form-control" name="buy_fee" value="50">
              <?php if ($errors->has('buy_fee')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('buy_fee'); ?>
                <div class="error"><?php echo e($message); ?></div>
              <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
            </div>

            <div class="form-group">
              <label><?php echo e(__('main.per_deposit')); ?> (%)</label>
              <input type="number" class="form-control" name="per_deposit" value="50">
              <?php if ($errors->has('per_deposit')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('per_deposit'); ?>
                <div class="error"><?php echo e($message); ?></div>
              <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
            </div>

            <div class="form-group">
              <label><?php echo e(__('main.address')); ?>*</label>
              <input type="text" class="form-control" name="address" value="<?php echo e(old('address')); ?>">
              <?php if ($errors->has('address')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('address'); ?>
                  <div class="error"><?php echo e($message); ?></div>
              <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
            </div>

            <div class="form-group">
              <label><?php echo e(__('main.password')); ?>*</label>
              <input type="password" class="form-control" name="password" value="<?php echo e(old('password')); ?>">
              <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?>
                <div class="error"><?php echo e($message); ?></div>
              <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
            </div>

            <div class="form-group">
              <label><?php echo e(__('main.repassword')); ?>*</label>
              <input type="password" class="form-control" name="password_confirmation" value="<?php echo e(old('password_confirmation')); ?>">
            </div>

          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary"><?php echo e(__('main.add')); ?></button>
          </div>
        </form>
      </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/azorder/resources/views/admin/users/add.blade.php ENDPATH**/ ?>