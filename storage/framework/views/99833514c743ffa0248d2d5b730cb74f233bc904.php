<?php $__env->startSection('header',__('main.order')); ?>
<?php $__env->startSection('small_header',''); ?>
<?php $__env->startSection('content'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/cart.css?x='.time())); ?>"/>



<div class="choose-address">

    <div style="display: flex; align-items: center; justify-content: center; min-height: 70vh;">
        <div class="text-center">
            <img style="height: 150px; width: 150px;" src="<?php echo e(asset('pictures/init/successful.png')); ?>" alt="">
            <br><br>
            <h1 style="font-size: 30px">Đặt hàng thành công</h1>
            <br><br><br>
            <a class="btn btn-success" href="<?php echo e(asset('users/cart')); ?>">quay về giỏ hàng</a>
        </div>
    </div>

</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/qcexpress/resources/views/users/success.blade.php ENDPATH**/ ?>