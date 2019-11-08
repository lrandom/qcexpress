<?php
$title = __('main.all_bill');
$check_btn = 1;
if(strpos(url()->full(),'admin/transport/bill_transport')!=false){
    if(strpos(url()->full(),'admin/transport/bill_transport/8')!=false){
        $title = 'Đã giao hàng';
        $check_btn = 2;
    }
    if(strpos(url()->current(),'admin/transport/bill_transport/9')!=false){
        $title = 'Đã nhận hàng';
        $check_btn = 3;
    }
}
?>


<?php $__env->startSection('header',__('main.bill_transport')); ?>
<?php $__env->startSection('small_header', $title); ?>
<?php $__env->startSection('content'); ?>

<?php
        use App\CommentsOrders as CommentsOrders;
        $total_quantity = 0;
        $total_price    = 0;
        $index= 0;
        ?>

<script>
        var id_user = '<?php echo e(Auth::user()->id); ?>';
    </script>
    
    <script src="<?php echo e(asset('js/order.js?x=')); ?><?php echo e(time()); ?>"></script>
    
    <div class="box-body table-responsive">    

            <a class="btn btn-primary <?php if($check_btn == 1){ echo 'btn-success'; } ?>" href="<?php echo e(asset('admin/transport/bill_transport')); ?>">Đang chờ giao hàng</a>
            <a class="btn btn-primary <?php if($check_btn == 2){ echo 'btn-success'; } ?>" href="<?php echo e(asset('admin/transport/bill_transport/8')); ?>">Đã giao hàng</a>
            <a class="btn btn-primary <?php if($check_btn == 3){ echo 'btn-success'; } ?>" href="<?php echo e(asset('admin/transport/bill_transport/9')); ?>">Đã nhận hàng</a>


        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php  $index= 0; ?>
        <table class="table table-bordered" style="background:white;margin-top:10px">
            <tbody>
                <tr>
                    <th>Thông tin phiếu</th>
                    <th>Thông tin nhận hàng</th>
                </tr>
                <tr>
                    <td class="text-center">Mã: <a><?php echo e(formatorderid($r->created_at,$r->id)); ?></a> - Nguời bán: <a><?php echo e($r->owner_name); ?></a></td>
                    <td rowspan="2">
                            <div class="">
                                <p style="margin: 0" class="name"><b>Họ tên: <?php echo e($r->fullname); ?></b></p>
                                <p style="margin: 0" class="address"><b>Địa chỉ: <?php echo e($r->address); ?></b></p>
                                <p style="margin: 0" class="phone"><b>Sđt: <?php echo e($r->phone); ?></b></p>
                            </div>

                            <br><br>

                            <div class="btn-group group-btn-status">
                                    <a class="btn btn-success btn-flat status-txt" href="javascript:void(0);">
                                    
                                        <?php if($r->ship_request == 3 && $r->status != 8 && $r->status != 9): ?>
                                            Đang chờ giao hàng
                                        <?php endif; ?>
                                        <?php if($r->ship_request == 3 && $r->status == 8): ?>
                                            Đã giao hàng
                                        <?php endif; ?>
                                        <?php if($r->ship_request == 3 && $r->status == 9): ?>
                                            Đã nhận hàng
                                        <?php endif; ?>
                                        
                                    </a>
                                    <button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="javascript:void" class="btn-update-status"  data-status="8" data-id="<?php echo e($r->id); ?>">Đã giao hàng</a></li>
                                        <li><a href="javascript:void" class="btn-update-status"  data-status="9" data-id="<?php echo e($r->id); ?>">Đã nhận hàng</a></li>
                                    </ul>
                                </div>
                    </td>
                </tr>

                <?php $__currentLoopData = $r->stuffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php 
                    $index++; 
                    $total_quantity += $r1->quantity;
                    $total_price += ($r1->quantity * $r1->price);
                    ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td>
                        <table class="table order_value">
                            <tbody>
                                    <td style="width: 60%; padding-right: 40px;" class="">
                                        <br>
                                        <b>Tổng: <?php echo e(formatVND(($total_price + (($total_price/100)*(Auth::user()->buy_fee)) + ($r->transport_cn) + ($r->wood_package))*($r->exchange_rate))); ?></b>
                                        <br>
                                        <span>(Tỷ giá <span class="exchange-rate"><?php echo e(formatVND($r->exchange_rate)); ?></span>)</span>
                                        <br><br><br><br>
                                        <div class="">
                                            <div class="col-sm-12 no-padding">
                                                    <label class="col-sm-4">Vận đơn:</label>
                                                    <input class="input-transport-vn-code" value="<?php echo e($r->transport_vn); ?>" type="text" name="transport_vn_code">

                                                    <br><br>

                                                    <label class="col-sm-4">Đơn vị vận chuyển:</label>
                                                    <input class="input-transport-vn-name" value="<?php echo e($r->transport_vn_name); ?>" type="text" name="transport_vn_name">

                                                    <br><br>
                                                    
                                                    <div class="col-sm-4"></div>
                                                    <button class="btn btn-xs btn-success btn-update-transport-vn" data-id="<?php echo e($r->id); ?>">Cập nhật</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
        
    <div class="">
            <?php echo e($list->links()); ?>

        </div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/qcexpress/resources/views/admin/transport/bill-transport.blade.php ENDPATH**/ ?>