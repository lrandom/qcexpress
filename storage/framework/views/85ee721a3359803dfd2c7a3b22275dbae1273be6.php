<?php $__env->startSection('header',__('main.complaints')); ?>
<?php $__env->startSection('small_header',__('main.list')); ?>
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
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php  $index= 0; ?>
        <table class="table table-bordered" style="background:white;margin-top:10px">
            <tbody>
                <tr>
                    <th>Thông tin phiếu</th>
                    <th>Thông tin nhận hàng</th>
                </tr>
                <tr>
                    <td class="text-center">Mã: <a>DH<?php echo e($r->id); ?></a> - Nguời bán: <a><?php echo e($r->owner_name); ?></a></td>
                    <td rowspan="2">
                            <div class="">
                                <p style="margin: 0" class="name"><b>Họ tên: <?php echo e($r->fullname); ?></b></p>
                                <p style="margin: 0" class="address"><b>Địa chỉ: <?php echo e($r->address); ?></b></p>
                                <p style="margin: 0" class="phone"><b>Sđt: <?php echo e($r->phone); ?></b></p>
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
                                        
                                        <br><br><br>
                    
                                        <div class="wrapper-picture">
                                            <div class="row">
                                                <?php for($i=0; $i < 2; $i++): ?>
                                                    <div class="form-group col-sm-4">
                                                        <label><?php echo e(__('main.picture')); ?> <?php echo e($i+1); ?></label>
                                                        <div style="height: 120px; width: 180px; border: 1px solid #ebebeb;">
                                                            <?php if(isset($obj->picture[$i])): ?>
                                                                <img src="<?php echo e(asset($obj->picture[$i])); ?>" style="width:120px;height:80px;"/>
                                                            <?php endif; ?>
                                                            <br/>
                                                        </div>
                                                    </div>
                                                <?php endfor; ?>
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

                                        <?php if($r->status != 9): ?>
                                            <a href="<?php echo e(asset('admin/transport/received/'.$r->id)); ?>" class="btn btn-success">Đã nhận hàng</a>
                                        <?php else: ?>
                                            <span class="label label-warning">Đã nhận hàng</span>
                                        <?php endif; ?>
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/azorder/resources/views/admin/transport/bill-transport.blade.php ENDPATH**/ ?>