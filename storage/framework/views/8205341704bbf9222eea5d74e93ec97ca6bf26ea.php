<?php $__env->startSection('header',__('main.address')); ?>
<?php $__env->startSection('small_header',''); ?>
<?php $__env->startSection('content'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('public/css/cart.css?x='.time())); ?>"/>


<style>
    #timeline-wrap{
        display: flex !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
        margin-bottom: 30px !important;
    }
    #timeline{
        position: absolute !important;
        display: none;
    }
    marker:hover, .marker.active {
        background: #dd4b39;
        /* border: 2px solid #dd4b39; */
        color: #fff;
    }
.marker-wrapper{
    left: unset !important;
    flex: 1;
    position: relative !important;
    padding: 10px;
}
.marker {
    /* background: #fff; */
    background: transparent !important;
    color: #dd4b39;
    height: 50px;
    width: 100% !important;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    border: none !important;
    border-radius: 0 !important;
    position: relative;
    overflow: hidden;
    padding: 0px 60px;
}
.marker i{
    background: #fff;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.marker:hover::after, .marker:hover::before, .marker:hover i,
.marker.active::after, .marker.active::before, .marker.active i{
    background: #dd4a39;
}

.marker::after{
    content: '';
    background: #fff;
    width: 100px;
    height: 100px;
    position: absolute;
    right: 20px;
    top: 0px;
    transform: rotate(45deg);
}
.marker::before{
    content: '';
    background: #fff;
    width: 100px;
    height: 100px;
    position: absolute;
    left: 20px;
    bottom: 0px;
    transform: rotate(45deg);
}
.marker-two{
    margin-right: -50px;
    margin-left: -50px;
}


.marker-wrapper:first-child .marker::before{
    left: -10px;
    bottom: -25px;
}
.marker-wrapper:last-child .marker::after{
    right: -10px;
    top: -25px;
}
</style>

<div class="choose-address">

    <div id="timeline-wrap">                
        <!-- This is the individual marker-->
        <div class="marker-wrapper">
            <div class="marker">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <span class="marker-title"><?php echo e(__('main.cart')); ?></span>
        </div>

        <div class="marker-wrapper marker-two">
            <div class="marker active">
                <i class="fa fa-map-pin"></i>
            </div>
            <span class="marker-title">Chọn địa chỉ</span>
        </div>

        <div class="marker-wrapper marker-three">
            <div class="marker">
                <i class="fa fa-list"></i>
            </div>
            <span class="marker-title"><?php echo e(__('main.singles')); ?></span>
        </div>
    </div>





<form role="form" action="<?php echo e(URL::to('users/cart/add_order')); ?>" method="post">
  <?php echo csrf_field(); ?>
  
  <input type="hidden" name="order_lst" value="<?php echo e(json_encode($item_orders)); ?>">

  
  
  
  
  
  
  

  <div class="row">

    <div class="col-sm-12 col-xs-12">
      <div class="box box-primary">
        <div class="box-body">
            
            

            <div class="box-body">
              <table>
                <thead>
                  <th style="width: 100px;">Ảnh</th>
                  <th style="width: 40%;">Shop</th>
                  <th style="text-align: right;">Số lượng</th>
                  <th style="text-align: right;">Tiền hàng</th>
                </thead>
                <tbody>
                    <?php
                      $total = 0;
                      foreach($item_orders as $od){
                        foreach ($od['item'] as $item){
                          $temp_price = $item['price']*$item['rate']*$item['quantity'];
                          $total = $total + $temp_price;
                        }
                      } 
                    ?>
                    <?php $__currentLoopData = $item_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $od): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php $__currentLoopData = $od['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><img style="height: 70px; width: 70px;margin-top:10px" src="<?php echo e($item['picture']); ?>" alt=""></td>
                          <td><?php echo e($item['name']); ?></td>
                          <td style="text-align: right;"><?php echo e($item['quantity']); ?></td>
                          <td style="text-align: right;"><?php echo e(formatVND($item['price']*$item['rate']*$item['quantity'])); ?></td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
              </table>
            </div>

            <hr>

            <div class="" style="display: flex;">
              <div class="" style="flex: 1">
                  <br>
                  <?php
                      $buy_fee = Auth::user()->buy_fee;
                  ?>
                  
                  <p class="text-right"><b>Tổng: <span class="text-red"><?php echo e(formatVND($total)); ?></span></b></p>
                  <p class="text-right"><b>Phí mua hàng: <span class="text-red"><?php echo e(formatVND(($total/100)*$buy_fee)); ?></span></b></p>
                  <p class="text-right"><b>Đặt cọc(<?php echo e(Auth::user()->per_deposit); ?>%): <span class="text-red"> <?php echo e(formatVND(($total/100)*(Auth::user()->per_deposit))); ?></span></b></p>
                  <p class="text-right"><b>Tạm tính: <span class="text-red" style="font-size: 20px;"><?php echo e(formatVND($total + (($total/100)*$buy_fee))); ?></span></b></p>
                  <p class="text-right"><b>Số dư hiện tại:  <span class="text-green" style="font-size: 18px;"><?php echo e(formatVND(Auth::user()->amount)); ?></span></b></p>

                  <br>

                  <div class="text-right">
                    <button type="submit" class="btn btn-primary">Lên đơn</button>
                  </div>
              </div>
            </div>

        </div>
      </div>
    </div>

  </div>

</form>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/qcexpress/resources/views/users/make-order.blade.php ENDPATH**/ ?>