<?php $__env->startSection('content'); ?>
<?php $__env->startSection('header',__('main.finance')); ?>
<?php $__env->startSection('small_header',__('main.deposit')); ?>
<script>
   $(document).ready(function () {
     $('select[name="transfer_method"]').on('change',function(){
       let val = $(this).val();
       console.log(val);
       if(val==2){
         $('.form-group-banks').removeClass('hide').addClass('show');
       }else{
        $('.form-group-banks').removeClass('show').addClass('hide');
       }
     })
     $.datetimepicker.setLocale('vi');
     $('input[name="transaction_time"]').datetimepicker({
       format:'d-m-Y H:i'
     });
   });
</script>

<style>
    .show{
      display: block;
    }

    .hide{
      display: none;
    }
</style>
<div class="row">
<div class="col-md-8 col-xs-12">
    <?php if(session('status')): ?>
        <div class="alert alert-success">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>
        <!-- Horizontal Form -->
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Chuyển khoản</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal" action="<?php echo e(URL::to('users/finance/deposit')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-3 col-xs-12 control-label"><?php echo e(__('main.picture')); ?> (Không bắt buộc)</label>
                <div class="col-sm-9 col-xs-12">
                  <input type="file" name="photo">
                  <?php if ($errors->has('photo')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('photo'); ?>
                    <div class="error"><?php echo e($message); ?></div>
                  <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 col-xs-12 control-label"><?php echo e(__('main.amount')); ?><span class="asterisk">*</span></label>
                <div class="col-sm-9 col-xs-12">
                  <input type="number" name="amount" class="form-control" placeholder="<?php echo e(__('main.amount')); ?>" value="<?php echo e(old('amount')); ?>">
               
                  <?php if ($errors->has('amount')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('amount'); ?>
                    <div class="error"><?php echo e($message); ?></div>
                  <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 col-xs-12 control-label"><?php echo e(__('main.method')); ?><span class="asterisk">*</span></label>
                <div class="col-sm-9 col-xs-12">
                    <select class="form-control" name="transfer_method">
                        <option value=""><?php echo e(__('main.method')); ?></option>
                        <option value="1" <?php if(old('transfer_method')==1){echo 'selected';} ?>><?php echo e(__('main.cash')); ?></option>
                        <option value="2" <?php if(old('transfer_method')==2){echo 'selected';} ?>><?php echo e(__('main.transfer_via_bank')); ?></option>
                    </select>

                    <?php if ($errors->has('transfer_method')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('transfer_method'); ?>
                       <div class="error"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                </div>
              </div>

              <div class="form-group form-group-banks <?php if(old('transfer_method')==1 || old('transfer_method')==null){echo 'hide';}else{ echo 'show';} ?>">
                    <label class="col-sm-3 col-xs-12 control-label"><?php echo e(__('main.banks')); ?><span class="asterisk">*</span></label>
                    <div class="col-sm-9 col-xs-12" >
                     <div style="display:flex;align-items:flex-start">
                        <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <span style="margin-left:10px">
                            <img style="width:150px" src="<?php echo e(asset($r->logo)); ?>"/>
                            <br>
                            <label style="margin-top:10px"><?php echo e($r->name); ?></label>
                            <br>
                            <input type="radio" name="bank" value="<?php echo e($r->id); ?>" <?php if(old('bank')==$r->id){echo 'checked';} ?>/>
                          </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </div>
                      <?php if ($errors->has('bank')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('bank'); ?>
                      <div class="error"><?php echo e($message); ?></div>
                      <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                    </div>
              </div>
    
              <div class="form-group">
                <label class="col-sm-3 col-xs-12 control-label"><?php echo e(__('main.entry')); ?></label>
                <div class="col-sm-9 col-xs-12">
                    <input type="text" name="entry" class="form-control" placeholder="<?php echo e(__('main.entry')); ?>" value="<?php echo e(old('entry')); ?>">
                </div>
              </div>

              <div class="form-group">
                    <label class="col-sm-3 col-xs-12 control-label"><?php echo e(__('main.transaction_time')); ?><span class="asterisk">*</span></label>
                    <div class="col-sm-9 col-xs-12">
                    <input type="text" name="transaction_time" class="form-control" placeholder="<?php echo e(__('main.transaction_time')); ?>" value="<?php echo e(old('transaction_time')); ?>">
                    <?php if ($errors->has('transaction_time')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('transaction_time'); ?>
                      <div class="error"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                    </div>
              </div>

              <div class="form-group">
                    <label class="col-sm-3 col-xs-12 control-label"><?php echo e(__('main.content')); ?><span class="asterisk">*</span></label>
                    <div class="col-sm-9 col-xs-12">
                        <textarea name="content" style="height:250px" class="form-control" placeholder="<?php echo e(__('main.content')); ?>"><?php echo e(old('content')); ?></textarea>
                        <?php if ($errors->has('content')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('content'); ?>
                      <div class="error"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                      </div>
              </div>

              <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-9 col-xs-12">
                      <button class="btn btn-primary"><?php echo e(__('main.update')); ?></button>
                      <button class="btn btn-default"><?php echo e(__('main.reset')); ?></button>
                  </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
</div>


<div class="col-md-4 col-xs-12">
    <div class="box box-danger col-md-6 col-xs-12">
      <div class="box-header with-border row">
        <h3 class="box-title">Thông tin ngân hàng</h3>
      </div>

        <div style="margin-top:10px">
              
        </div>
    </div>
  </div>
      </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/qcexpress/resources/views/users/deposit.blade.php ENDPATH**/ ?>