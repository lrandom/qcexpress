<?php if(count($list_ship_address)<=0): ?>
<p>Bạn không có địa chỉ nào trong sổ địa chỉ, vui lòng thêm 
  <a href="<?php echo e(url('users/account')); ?>" target="_blank" class="btn-close-add-modal">tại đây</a>
</p>  
<script>
  $('.btn-close-add-modal').click(function(){
    $('#addAddressModal').modal('hide');
  })
</script>  
<?php else: ?>
       
              <?php $__currentLoopData = $list_ship_address; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="box box-primary box-ship-address box-ship-address-<?php echo e($row->id); ?>">
                  <div class="box-body" style="">
            
                      <p style="margin: 0" class="name name-view"><?php echo e(Auth::user()->fullname); ?></p>
                      <p style="margin: 0" class="address address-view">Địa chỉ: <?php echo e($row->address); ?></p>
                      <p style="margin: 0" class="phone phone-view">Sđt: <?php echo e($row->phone); ?></p>
                      <br>
                   
                      <button type="button" class="pull-left btn btn-primary btn-success btn-xs btn-choose-address btn-choose-address-<?php echo e($row->id); ?>" data-id="<?php echo e($row->id); ?>">Giao đến địa chỉ này</button>
                      <?php if($row->is_default==1): ?>
                      <span class="label label-primary pull-right">Mặc định</span>
                      <?php endif; ?>
                  </div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?><?php /**PATH /Library/WebServer/Documents/azorder/resources/views/users/choose-address.blade.php ENDPATH**/ ?>