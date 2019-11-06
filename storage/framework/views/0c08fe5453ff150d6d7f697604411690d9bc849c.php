<?php
    $title = __('main.all_bill');
    $check_btn = 1;
    if(strpos(url()->full(),'users/transport/bill_transport')!=false){
        if(strpos(url()->full(),'users/transport/bill_transport/8')!=false){
            $title = 'Đã giao hàng';
            $check_btn = 2;
        }
        if(strpos(url()->current(),'users/transport/bill_transport/9')!=false){
            $title = 'Đã nhận hàng';
            $check_btn = 3;
        }
    }
?>

<?php $__env->startSection('header',__('main.bill_transport')); ?>
<?php $__env->startSection('small_header', $title); ?>

<style>
        table ul {
            margin: 0px;
            padding: 0px;
        }
    
        table ul li {
            list-style-type: none;
        }
    </style>
    
    
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
    
    <script src="<?php echo e(asset('public/js/order.js?x=')); ?><?php echo e(time()); ?>"></script>
    


    <div class="box-body table-responsive">    
        <a class="btn btn-primary <?php if($check_btn == 1){ echo 'btn-success'; } ?>" href="<?php echo e(asset('users/transport/bill_transport')); ?>">Đang chờ giao hàng</a>
        <a class="btn btn-primary <?php if($check_btn == 2){ echo 'btn-success'; } ?>" href="<?php echo e(asset('users/transport/bill_transport/8')); ?>">Đã giao hàng</a>
        <a class="btn btn-primary <?php if($check_btn == 3){ echo 'btn-success'; } ?>" href="<?php echo e(asset('users/transport/bill_transport/9')); ?>">Đã nhận hàng</a>


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

                            <div>
                                <?php if($r->ship_request == 3 && $r->status != 8 && $r->status != 9): ?>
                                    <label class="label label-warning">Đang chờ giao hàng</label>
                                <?php endif; ?>
                                <?php if($r->ship_request == 3 && $r->status == 8): ?>
                                    <label class="label label-success">Đã giao hàng</label>
                                <?php endif; ?>
                                <?php if($r->ship_request == 3 && $r->status == 9): ?>
                                    <label class="label label-primary">Đã nhận hàng</label>
                                <?php endif; ?>
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
                                <tr>
                                    <td class="col-sm-5">Ghi chú</td>
                                    <td class="col-sm-7"><?php echo e($r->note); ?></td>
                                </tr>
                                <tr>
                                    <td class="col-sm-5">Tổng số lượng</td>
                                    <td class="col-sm-7">
                                        <?php echo e($total_quantity); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="">Tổng giá sản phẩm</td>
                                    <td><?php echo e(formatCNY($total_price)); ?></td>
                                </tr>
                                <tr>
                                    <td class="">Tổng tiền công</td>
                                    <td><?php echo e(formatCNY(($total_price/100)*(Auth::user()->buy_fee))); ?></td>
                                </tr>
                                <tr>
                                    <td class="">Phí nội địa TQ</td>
                                    <td>
                                        <?php echo e(formatCNY($r->transport_cn)); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="">Phí đóng kiện gỗ</td>
                                    <td><?php echo e(formatCNY($r->wood_package)); ?></td>
                                </tr>
                                <tr>
                                    <td class="">Mã đơn hàng TQ</td>
                                    <td><?php echo e($r->code_order_cn); ?></td>
                                </tr>
                                <tr>
                                    <td class="">Tổng tiền đơn hàng</td>
                                    <td>
                                        <?php echo e(formatCNY($total_price + (($total_price/100)*(Auth::user()->buy_fee)) + ($r->transport_cn) + ($r->wood_package))); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 60%; padding-right: 40px;" class="">
                                        <br><br>
                                        <div class="">
                                            <a>Giao dịch trên đơn</a>
                                            <ul>
                                                <li>Thanh toán</li>
                                                <li>Tất toán</li>
                                            </ul>
                                            <div class="col-sm-12 no-padding">
                                                    <label>Vận đơn: <?php echo e($r->lading); ?></label>
                                            </div>
                                        </div>
                                        
                                        <br>
                                    </td>
                                    <td>
                                        <br><br>
                                        <b>Tổng: <?php echo e(formatVND(($total_price + (($total_price/100)*(Auth::user()->buy_fee)) + ($r->transport_cn) + ($r->wood_package))*($r->exchange_rate))); ?></b>
                                        <br>
                                        <span>(Tỷ giá <span class="exchange-rate"><?php echo e(formatVND($r->exchange_rate)); ?></span>)</span>
                                        <br><br>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="">
            <?php echo e($list->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/azorder/resources/views/users/bill-transport.blade.php ENDPATH**/ ?>