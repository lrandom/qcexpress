<?php $__env->startSection('header',__('main.request_transport')); ?>
<?php $__env->startSection('small_header',__('main.list')); ?>
<?php $__env->startSection('content'); ?>
<?php
   $total_quantity = 0;
   $total_price    = 0;
   ?>
<script>
   var id_user = '<?php echo e(Auth::user()->id); ?>';
</script>
<script src="<?php echo e(asset('js/order.js?x=')); ?><?php echo e(time()); ?>"></script>

<div style="margin-bottom:10px;margin-left:15px;margin-right:15px">
        <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/1')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="<?php echo e(url('users/transport/list/1')); ?>">Chờ duyệt</a>
        <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/2')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="<?php echo e(url('users/transport/list/2')); ?>">Chờ thanh toán phí ship</a>
        <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/3')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="<?php echo e(url('users/transport/list/3')); ?>">Chờ giao</a>
        <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/4')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="<?php echo e(url('users/transport/list/4')); ?>">Đã huỷ</a>
        <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/5')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="<?php echo e(url('users/transport/list/5')); ?>">Đã giao</a>
      </div>
<?php if(count($list)>0): ?>
<?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-xs-12 col-md-4">
   <div class="box box-info">
        <div class="box-header with-border">
         <span><b>Mã đơn: <a href="<?php echo e(url('admin/orders/detail/'.$r->id)); ?>" target="_blank">QC<?php echo e($r->id); ?></a></b></span>
         <span style="float:right">
           
                <?php switch($r->ship_request):
                    case (1): ?>
                    <label class="label label-danger">Chờ duyệt</label>
                        <?php break; ?>
   
                    <?php case (2): ?>
                    <label class="label label-warning">Chờ thanh toán phí ship</label>
                       <?php break; ?>
   
                     <?php case (3): ?>
                     <label class="label label-warning">Chờ giao</label>
                        <?php break; ?>
   
                     <?php case (4): ?>
                     <label class="label label-danger">Đã huỷ</label>
                        <?php break; ?>;
   
                     <?php case (5): ?>
                     <label class="label label-success">Đã giao</label>
                           <?php break; ?>
                    <?php default: ?>
                        
                <?php endswitch; ?>
             
            </span>
        </div>
      <div class="box-body table-responsive box-info">
         <p>
                Nguời nhận: <b><?php echo e($r->receiver); ?></b><br>
                Địa chỉ: <b><?php echo e($r->address); ?></b><br>
                Số ĐT: <b><?php echo e($r->receiver_phone); ?></b><br>
                Phí giao hàng: <b class="text-green"><?php echo e(formatVND($r->ship_fee)); ?></b><br>
             </p>
         <form action="agree_ship" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" value="<?php echo e($r->id); ?>" name="id" class="form-control" required>

            <?php if($r->ship_request==1): ?>
            <p>Chấp thuận giao hàng</p>
            <input class="form-control" type="number" name="ship_fee" placeholder="Phí ship" required><br>
            <button type="submit" class="btn btn-success btn-sm" name="btn-agree-ship" value="1">Chấp thuận giao hàng</button>
            <?php endif; ?>

            <?php if($r->ship_request==3): ?>
              <input class="form-control" type="text" name="transport_vn_name" placeholder="Đơn vị giao hàng" required><br>
              <input class="form-control" type="text" name="vn_lading" placeholder="Mã đơn vận" required><br>
              <button type="submit" class="btn btn-success btn-sm" name="btn-update-ship-info" value="1">Cập nhật</button>
            <?php endif; ?>

         </form>

         <?php if($r->ship_request==1 || $r->ship_request==3): ?>
         <form action="<?php echo e(url('admin/transport/cancel/')); ?>" method="POST" style="margin-top:10px">
                <?php echo csrf_field(); ?>
                <input type="hidden" value="<?php echo e($r->id); ?>" name="id" class="form-control" required>
                <p>Huỷ giao với lý do:</p>
                <input class="form-control" type="text" name="reason" required>
                <br>
                <button type="submit" class="btn btn-danger btn-sm btn-cancel-transport">Huỷ giao</button>
         </form>
         <?php endif; ?>
      </div>
      <!-- /.box-body -->
   </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php echo e($list->links()); ?>

<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/qcexpress/resources/views/admin/transport/request-transport.blade.php ENDPATH**/ ?>