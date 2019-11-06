<?php $__env->startSection('header',__('main.address')); ?>
<?php $__env->startSection('small_header',''); ?>
<?php $__env->startSection('content'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/cart.css?x='.time())); ?>"/>
<div class="choose-address">

<div id="timeline-wrap">
    <div id="timeline"></div>
    <!-- This is the individual marker-->
    <div class="marker-wrapper">
        <div class="marker active">
            <i class="fa fa-shopping-cart"></i>
        </div>
      <span class="marker-title"><?php echo e(__('main.cart')); ?></span>
    </div>

    <div class="marker-wrapper marker-two">
            <div class="marker active">
                <i class="fa fa-map-pin"></i>
            </div>
          <span class="marker-title"><?php echo e(__('main.make_order')); ?></span>
    </div>

    <div class="marker-wrapper marker-three">
            <div class="marker">
                <i class="fa fa-shopping-cart"></i>
            </div>
          <span class="marker-title"><?php echo e(__('main.singles')); ?></span>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo e(URL::to('users/cart/add_order')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <input type="hidden" value="<?php echo e($index_cart); ?>" name="index_cart"/>
                <input type="hidden" value="<?php echo e($owner_type); ?>" name="owner_type"/>
                <input type="hidden" value="<?php echo e($note); ?>" name="note"/>
                <input type="hidden" value="<?php echo e($id_owner); ?>" name="id_owner"/>
                <input type="hidden" value="<?php echo e($owner_name); ?>" name="owner_name"/>
                <input type="hidden" value="<?php echo e($rate); ?>" name="rate"/>
                <input type="hidden" value="<?php echo e($total); ?>" name="total"/>
                <div class="box-body">
               <p>
                Nguời bán: <strong><?php echo e($owner_name); ?></strong>
                </p>

                <div class="box-body">
                  <table>
                    <thead>
                      <th style="width: 100px;">Ảnh</th>
                      <th style="width: 40%;">Shop</th>
                      <th style="text-align: right;">Số lượng</th>
                      <th style="text-align: right;">Tiền hàng</th>
                    </thead>
                    <tbody>
               
                        <?php $__currentLoopData = $item_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr >
                            <td><img style="height: 70px; width: 70px;margin-top:10px" src="<?php echo e($item['picture']); ?>" alt=""></td>
                            <td><?php echo e($item['name']); ?></td>
                            <td style="text-align: right;"><?php echo e($item['quantity']); ?></td>
                            <td style="text-align: right;"><?php echo e(formatVND($item['price']*$item['rate']*$item['quantity'])); ?></td>
                          </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>

                <hr>
                  <input type="hidden" value="<?php echo e(($total/100)*(Auth::user()->per_deposit)); ?>" name="deposit"/>
                  <p class="text-right"><b>Tổng: <span class="text-red"><?php echo e(formatVND($total)); ?></span></b></p>
                  <p class="text-right"><b>Đặt cọc(<?php echo e(Auth::user()->per_deposit); ?>%): <span class="text-red"> <?php echo e(formatVND(($total/100)*(Auth::user()->per_deposit))); ?></span></b></p>
                  <p class="text-right"><b>Số dư hiện tại:  <span class="text-red"><?php echo e(formatVND(Auth::user()->amount)); ?></span></b></p>
                </div>
                <!-- /.box-body -->
                
                <div class="box-footer text-right">
                  <button type="submit" class="btn btn-primary">Đặt hàng</button>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>






<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/azorder/resources/views/users/make-order.blade.php ENDPATH**/ ?>