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

<div class="row">

  <?php if($status!=-1): ?>
  <div style="margin-bottom:10px;margin-left:15px;margin-right:15px">
    <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/1')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="<?php echo e(url('users/transport/list/1')); ?>">Chờ duyệt</a>
    <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/2')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="<?php echo e(url('users/transport/list/2')); ?>">Chờ thanh toán phí ship</a>
    <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/3')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="<?php echo e(url('users/transport/list/3')); ?>">Chờ giao</a>
    <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/4')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="<?php echo e(url('users/transport/list/4')); ?>">Đã huỷ</a>
    <a class="btn <?php if(Request::fullUrl()==url('users/transport/list/5')){echo 'btn-danger';}else{echo 'btn-default';} ?>" href="<?php echo e(url('users/transport/list/5')); ?>">Đã giao</a>
  </div>
  <?php endif; ?>
<?php if(count($list)>0): ?>
<?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-xs-12 col-md-4">
   <div class="box box-info">
      <div class="box-header with-border">
         <span><b>Mã đơn: <a href="<?php echo e(url('users/orders/detail/'.$r->id)); ?>" target="_blank">QC<?php echo e($r->id); ?></a></b></span>
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
         <?php if($r->ship_request==0 && $r->is_final==1): ?>
         <p>
              <form action="<?php echo e(url('users/transport/send_request')); ?>" class="send_request_form" method="POST" onsubmit="return send_request()">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" value="<?php echo e($r->id); ?>" name="id">
                  <input type="text" name="receiver" placeholder="nguời nhận" class="form-control" required/>
                  <textarea name="address" placeholder="Địa chỉ" class="form-control" style="margin-top:10px" required></textarea>
                  <input type="text" name="receiver_phone" placeholder="SDT" class="form-control"  style="margin-top:10px" required/>
                  <button type="submit" class='btn btn-sm btn-success' style="margin-top:10px">Yêu cầu giao</button>
              </form>
         </p>
         <?php endif; ?>

         <?php if($r->ship_request==0 && $r->is_final==0): ?>
           <a href="<?php echo e(url('users/orders/detail/'.$r->id)); ?>">Tất toán đơn hàng</a>
         <?php endif; ?>

         <?php if($r->ship_request==2 && $r->ship_fee>0): ?>
         <p>
              <form action="<?php echo e(url('users/transport/pay_shipfee')); ?>" method="POST">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" value="<?php echo e($r->id); ?>" name="id">
                  <input type="hidden" value="<?php echo e($r->ship_fee); ?>" name="ship_fee">
                  <button type="submit" class='btn btn-sm btn-success'>Thanh toán tiền ship</button>
              </form>
         </p>
         <?php endif; ?>
         <?php if($r->ship_request!=0): ?>
         <p>
            Nguời nhận: <b><?php echo e($r->receiver); ?></b><br>
            Địa chỉ: <b><?php echo e($r->address); ?></b><br>
            Số ĐT: <b><?php echo e($r->receiver_phone); ?></b><br>
            Đơn vị giao:  <b><?php echo e($r->transport_vn_name); ?></b>
            <br>
            Mã đơn vận: <b><?php echo e($r->vn_lading); ?></b><br>
            Phí ship: <b><?php echo e($r->ship_fee); ?></b>
         </p>
         <?php endif; ?>

      </div>
   </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php echo e($list->links()); ?>

<?php endif; ?>
</div>




<script>
  // function choose_address(){
  //   $.ajax({
  //     type: "get",
  //     url: "<?php echo e(url('users/transport/choose_address_api')); ?>",
  //     dataType: "html",
  //     success: function (response) {
  //       $('#addAddressModal .modal-body').html(response);
  //       $('#addAddressModal').modal('show');
  //     }
  //   });
  // }

  // $('.choose-address').click(function(){
  //   choose_address();
  // })

  // function send_request(){
  //    if($('.send_request_form input[name="id_address"]').val()==''){
  //     $.ajax({
  //     type: "get",
  //     url: "<?php echo e(url('users/transport/choose_address_api')); ?>",
  //     dataType: "html",
  //     success: function (response) {
  //       $('#addAddressModal .modal-body').html(response);
  //       $('#addAddressModal').modal('show');
  //     }
  //   });
  //     return false;
  //    }
  //  };


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/azorder/resources/views/users/request-transport.blade.php ENDPATH**/ ?>