<?php $__env->startSection('header',__('main.cart')); ?>
<?php $__env->startSection('small_header',''); ?>
<?php $__env->startSection('content'); ?>

<script type="text/javascript">
    var buy_fee = "<?php echo e(Auth::user()->buy_fee); ?>";
    var url_deposit = "<?php echo e(URL::to('users/finance/deposit')); ?>";
    var user_amount = "<?php echo e(Auth::user()->amount); ?>";
    var per_deposit = "<?php echo e(Auth::user()->per_deposit); ?>";
</script>

<script type="text/javascript" src="<?php echo e(asset('public/js/cart.js?x='.time())); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('public/css/cart.css?x='.time())); ?>"/>
<div class="col-xs-12">
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
            <div class="marker">
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

    <?php if($cart!=null): ?>
        <?php if(isset($cart['tmall_shop']) && count($cart['tmall_shop'])>0): ?> <?php $list = $cart['tmall_shop']; ?>
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Tmall World Shop</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;"></div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <div class="col-sm-8 col-xs-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width:30%"><?php echo e(__('main.product')); ?></th>
                                    <th><?php echo e(__('main.quantity')); ?></th>
                                    <th><?php echo e(__('main.price')); ?></th>
                                    <th><?php echo e(__('main.price_stuffs')); ?></th>
                                    <th><?php echo e(__('main.operation')); ?></th>
                                </tr>
                                <?php $index = 0; $stuffs_price = 0; ?>
                                <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php $index++; ?>
                                    <tr>
                                        <td>
                                            <img class="lazyload" style="float:left;width:100%;margin-right:10px" src="<?php echo e($r['picture']); ?>">
                                            <span style="float:left">
                                                <div><a href="<?php echo e($r['link']); ?>" target="_blank"><?php echo e($r['name']); ?></a></div>
                                                
                                                <?php if(isset($r['props'])): ?>
                                                <hr>
                                                <div style="font-size:14px">
                                                    <ul>
                                                       
                                                     <?php $__currentLoopData = $r['props']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><?php echo e($prop['name']); ?> - <?php echo e($prop['val']); ?></li>
                                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                      
                                                    </ul>
                                                </div>
                                                <?php endif; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <input class="text-center form-md input-quantity" data-config='<?php echo '{"owner_type":"1"'.',"shop":"-1","index":"'.$index.'"}' ?>'  min="1" value="<?php echo e($r1['quantity']); ?>" type="number" min="1" value="<?php echo e($r['quantity']); ?>" style="width:80px;height:30px"/>
                                            <input class="input-cny-price" type="hidden" />
                                            <input class="input-vnd-price" type="hidden" value="<?php echo e($r['price']*$r['rate']); ?>" />

                                            <div class="btn-group" role="group" aria-label="Default button group">
                                                <button type="button" class="btn btn-warning btn-xs btn-minus"  style="width:30px" value="<?php echo e($r['price']); ?>" data-config='<?php echo '{"owner_type":"1"'.',"shop":"-1","index":"'.$index.'"}' ?>'>
                                                    -
                                                </button>
                                                <button type="button" class="btn btn-success btn-xs btn-plus"  style="width:30px" data-config='<?php echo '{"owner_type":"1"'.',"shop":"-1","index":"'.$index.'"}' ?>'>
                                                    +
                                                </button>
                                            </div>
                                        </td>
                                        <!--giá sp-->
                                        <td>
                                            <div><?php echo e(formatCNY($r['price'])); ?></div>
                                            <div><?php echo e(formatVND($r['price']*$r['rate'])); ?></div>
                                        </td>
                                        <!--giá sau khi nhân với số sp-->
                                        <td>
                                            <div class="stuff-cny-price"><strong><?php echo e(formatCNY( $r['price']*$r['quantity'])); ?></strong></div>

                                            <div class="stuff-vnd-price">
                                            <strong><?php echo e(formatVND( $r['price']*$r['rate']*$r['quantity'])); ?></strong>
                                            <?php 
                                            $stuffs_price+=$r['price']*$r['rate']*$r['quantity'];
                                            $fee= ($stuffs_price/100)*(Auth::user()->buy_fee);
                                            ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Default button group">
                                               
                                                <a class="btn btn-default btn-xs btn-danger" 
                                                style="color:#fff" 
                                                href="<?php echo e(URL::to('users/cart/delete?owner_type=1&shop=-1&index='.$index)); ?>">
                                                    <i class="fa fa-trash"></i> <?php echo e(__('main.delete')); ?>

                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-4 col-xs-12">
                        <form action="<?php echo e(URL::to('users/cart/make_order')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="<?php echo e($key); ?>" name="index_cart"/>
                            <input type="hidden" value="1" name="owner_type"/>
                            <input type="hidden" value="-1" name="id_owner"/>
                            <input type="hidden" value="TMAL SHOP GLOBAL" name="owner_name"/>
                            <input type="hidden" value="<?php echo e($fee+$stuffs_price); ?>" name="total"/>
                            <input type="hidden" value="<?php echo e($list[0]['rate']); ?>" name="rate"/>
                            <div class="box-right ">
                                <div class="box-header">
                                    <div class="form-group row clearfix">
                                        <label class="col-sm-6 control-label">Tiền hàng:</label>
                                        <div class="col-sm-6 pull-right">
                                            <input type="hidden" class="input-stuffs-price" value="<?php echo e($stuffs_price); ?>"/>
                                            <p class="text-right text-bold6 stuffs-amount"><?php echo e(formatVND($stuffs_price)); ?></p>
                                        </div>
                                    </div>
                                    <div class="form-group row clearfix">
                                        <label class="col-sm-4 control-label">Phí mua hàng: </label>
                                        <div class="col-sm-6 pull-right">
                                            <input type="hidden" class="input-fee-order" value="<?php echo e($fee); ?>"/>
                                            <p class="text-right fee-order">
                                                <?php echo e(formatVND($fee)); ?>

                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group row clearfix">
                                        <label class="col-sm-8 control-label">Phí kiểm đếm:</label>
                                        <div class="col-sm-4 pull-right">
                                        
                                        </div>
                                    </div>
                                    <div class="form-group row clearfix">
                                        <label class="col-sm-8 control-label">Phí vận chuyển nội địa TQ:</label>
                                        <div class="col-sm-4 pull-right ">
                                            <p class="text-right"><i>-</i></p>
                                        </div>
                                    </div>
                                    <div class="form-group row clearfix">
                                        <label class="col-sm-8 control-label">Phí đóng kiện gỗ:</label>
                                        <div class="col-sm-4 pull-right">
                                            <p class="text-right"><i>-</i></p>
                                        </div>
                                    </div>
                                    <div class="form-group row clearfix">
                                        <label class="col-sm-8 control-label">Phí vận chuyển TQ - VN:</label>
                                        <div class="col-sm-4 pull-right">
                                            <p class="text-right"><i>-</i></p>
                                        </div>
                                    </div>
                                    <div class="form-group row clearfix">
                                        <label class="col-sm-8 control-label">Phí vận chuyển nội địa VN: </label>
                                        <div class="col-sm-4 pull-right">
                                            <p class="text-right"><i>-</i></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row clearfix">
                                        <label class="col-sm-6 control-label text-uppercase" style="padding-top: 5px;">Tổng tiền:</label>
                                        <div class="col-sm-6 pull-right">
                                            <p class="text-right text-red text-bold6" style="font-size: 20px">
                                                <strong class="final-amount"><?php echo e(formatVND($fee+$stuffs_price)); ?></strong>
                                            </p>
                                        </div>
                                        
                                        <div class="miss-amount-wrapper">
                                            <?php if(($fee+$stuffs_price) > (Auth::user()->amount)): ?>
                                                <label class="col-sm-6 control-label text-uppercase" style="padding-top: 5px;">Còn thiếu:</label>
                                                <div class="col-sm-6 pull-right">
                                                    <p class="text-right text-red text-bold6" style="font-size: 20px">
                                                        <strong class="miss-amount"><?php echo e(formatVND(($fee+$stuffs_price) - (Auth::user()->amount))); ?></strong>
                                                    </p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <label class="col-sm-6 control-label text-uppercase" style="padding-top: 5px;">Số dư hiện tại:</label>
                                        <div class="col-sm-6 pull-right">
                                            <p class="text-right"><b><?php echo e(formatVND(Auth::user()->amount)); ?></b></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="pd10 clearfix">
                                        <label>Ghi chú cho đơn hàng</label>
                                        <textarea name="note" class="form-control"  rows="3" placeholder="Chú thích" spellcheck="false" style=""></textarea>
                                    </div>
                                    <div class="text-right pd10 btn-order-wrapper">

                                        <?php if((($fee + $stuffs_price) - Auth::user()->amount > 0) && Auth::user()->per_deposit>0): ?>
                                            <a href="<?php echo e(URL::to('users/finance/deposit')); ?>" style="margin-top:10px" class="btn btn-danger">Nạp tiền</a>
                                        <?php else: ?>
                                            <button type="submit" class="btn btn-primary" style="margin-top:10px">Đặt hàng</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        <?php endif; ?>

        <?php if(isset($cart['tmall_market']) && count($cart['tmall_market'])>0): ?> <?php $list = $cart['tmall_market']; ?>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tmall Market - <?php echo e($r['owner_name']); ?></h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;"></div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <div class="col-sm-8 col-xs-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th  style="width:30%"><?php echo e(__('main.product')); ?></th>
                                    <th><?php echo e(__('main.quantity')); ?></th>
                                    <th><?php echo e(__('main.price')); ?></th>
                                    <th><?php echo e(__('main.total')); ?></th>
                                    <th><?php echo e(__('main.operation')); ?></th>
                                </tr>

                                <?php $index = 0; $stuffs_price = 0; ?>
                                <?php if(count($r['stuffs'])>0): ?>
                                <?php $__currentLoopData = $r['stuffs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php $index++; ?>
                                    <tr>
                                        <td>
                                            <img class="lazyload" style="float:left;width:100%;margin-right:10px" src="<?php echo e($r1['picture']); ?>">
                                            <span style="float:left">
                                                <div><a href="<?php echo e($r1['link']); ?>" target="_blank"><?php echo e($r1['name']); ?></a></div>
                                                <?php if(isset($r1['props'])): ?>
                                                <hr>
                                                <div style="font-size:14px">
                                                    <ul>
                                                    <?php $__currentLoopData = $r1['props']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><?php echo e($prop['name']); ?> - <?php echo e($prop['val']); ?></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    
                                                    </ul>
                                                </div>
                                                <?php endif; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <input class="text-center form-md input-quantity" type="number" data-config='<?php echo '{"owner_type":"1"'.',"shop":"'.$r['id_owner'].'","index":"'.$index.'"}' ?>'  min="1" value="<?php echo e($r1['quantity']); ?>" style="width:80px;height:30px"/>
                                            <input class="input-cny-price" type="hidden" value="<?php echo e($r1['price']); ?>" />
                                            <input class="input-vnd-price" type="hidden" value="<?php echo e($r1['price']*$r1['rate']); ?>"/>
                                            <div class="btn-group" role="group" aria-label="Default button group">
                                                <button type="button" class="btn btn-warning btn-xs btn-minus"  style="width:30px" data-config='<?php echo '{"owner_type":"1"'.',"shop":"'.$r['id_owner'].'","index":"'.$index.'"}' ?>'>
                                                    -
                                                </button>
                                                <button type="button" class="btn btn-success btn-xs btn-plus"  style="width:30px" data-config='<?php echo '{"owner_type":"1"'.',"shop":"'.$r['id_owner'].'","index":"'.$index.'"}' ?>'>
                                                    +
                                                </button>
                                            </div>

                                        </td>
                                        <td>
                                            <div><?php echo e(formatCNY($r1['price'])); ?></div>
                                            <div><?php echo e(formatVND($r1['price']*$r1['rate'])); ?></div>
                                        </td>

                                        <td>
                                            <div class="stuff-cny-price"><strong><?php echo e(formatCNY($r1['price']*$r1['quantity'])); ?></strong></div>
                                            <div class="stuff-vnd-price">
                                                <strong><?php echo e(formatVND($r1['price']*$r1['rate']*$r1['quantity'])); ?></strong>
                                            </div>
                                            <?php 
                                                $stuffs_price+=$r1['price']*$r1['rate']*$r1['quantity'];
                                                $fee=($stuffs_price/100)*(Auth::user()->buy_fee);
                                            ?>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Default button group">
                                               
                                                <a class="btn btn-default btn-xs btn-danger" 
                                                style="color:#fff" 
                                                href="<?php echo e(URL::to('users/cart/delete?owner_type=1&shop='.$r['id_owner'].'&index='.$index)); ?>">
                                                    <i class="fa fa-trash"></i> <?php echo e(__('main.delete')); ?>

                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                            <form action="<?php echo e(URL::to('users/cart/make_order')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" value="<?php echo e($key); ?>" name="index_cart"/>
                                <input type="hidden" value="1" name="owner_type"/>
                                <input type="hidden" value="<?php echo e($r['id_owner']); ?>" name="id_owner"/>
                                <input type="hidden" value="<?php echo e($r['owner_name']); ?>" name="owner_name"/>
                                <input type="hidden" value="<?php echo e($fee+$stuffs_price); ?>" name="total"/>
                                <input type="hidden" value="<?php echo e($r['stuffs'][0]['rate']); ?>" name="rate"/>

                                <div class="box-right ">
                                        <div class="box-header">
                                            <div class="form-group row clearfix">
                                                <label class="col-sm-6 control-label">Tiền hàng:</label>
                                                <div class="col-sm-6 pull-right">
                                                    <input type="hidden" class="input-stuffs-price" value="<?php echo e($stuffs_price); ?>"/>
                                                    <p class="text-right text-bold6 stuffs-amount text-red"><?php echo e(formatVND($stuffs_price)); ?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row clearfix">
                                                <label class="col-sm-4 control-label">Phí mua hàng: </label>
                                                <div class="col-sm-6 pull-right">
                                                    <input type="hidden" class="input-fee-order" value="<?php echo e($fee); ?>"/>
                                                    <p class="text-right fee-order text-red">
                                                        <?php echo e(formatVND($fee)); ?>

                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group row clearfix">
                                                <label class="col-sm-8 control-label">Phí kiểm đếm:</label>
                                                <div class="col-sm-4 pull-right">
                                                
                                                </div>
                                            </div>
                                            <div class="form-group row clearfix">
                                                <label class="col-sm-8 control-label">Phí vận chuyển nội địa TQ:</label>
                                                <div class="col-sm-4 pull-right ">
                                                    <p class="text-right"><i>-</i></p>
                                                </div>
                                            </div>
                                            <div class="form-group row clearfix">
                                                <label class="col-sm-8 control-label">Phí đóng kiện gỗ:</label>
                                                <div class="col-sm-4 pull-right">
                                                    <p class="text-right"><i>-</i></p>
                                                </div>
                                            </div>
                                            <div class="form-group row clearfix">
                                                <label class="col-sm-8 control-label">Phí vận chuyển TQ - VN:</label>
                                                <div class="col-sm-4 pull-right">
                                                    <p class="text-right"><i>-</i></p>
                                                </div>
                                            </div>
                                            <div class="form-group row clearfix">
                                                <label class="col-sm-8 control-label">Phí vận chuyển nội địa VN: </label>
                                                <div class="col-sm-4 pull-right">
                                                    <p class="text-right"><i>-</i></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row clearfix">
                                                <label class="col-sm-6 control-label text-uppercase" style="padding-top: 5px;">Tổng tiền:</label>
                                                <div class="col-sm-6 pull-right">
                                                    <p class="text-right text-red text-bold6" style="font-size: 20px">
                                                        <strong class="final-amount"><?php echo e(formatVND($fee+$stuffs_price)); ?></strong>
                                                    </p>
                                                </div>

                                                <div class="miss-amount-wrapper">
                                                    <?php if(($fee+$stuffs_price) > (Auth::user()->amount)): ?>
                                                        <label class="col-sm-6 control-label text-uppercase" style="padding-top: 5px;">Còn thiếu:</label>
                                                        <div class="col-sm-6 pull-right">
                                                            <p class="text-right text-red text-bold6" style="font-size: 20px">
                                                                <strong class="miss-amount"><?php echo e(formatVND(($fee+$stuffs_price) - (Auth::user()->amount))); ?></strong>
                                                            </p>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>

                                                <label class="col-sm-6 control-label text-uppercase" style="padding-top: 5px;">Số dư hiện tại:</label>
                                                <div class="col-sm-6 pull-right">
                                                    <p class="text-right"><b><?php echo e(formatVND(Auth::user()->amount)); ?></b></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="pd10 clearfix">
                                                <label>Ghi chú cho đơn hàng</label>
                                                <textarea name="note" class="form-control"  rows="3" placeholder="Chú thích" spellcheck="false" style=""></textarea>
                                            </div>
                                            <div class="text-right pd10 btn-order-wrapper">

                                                <?php if((($fee + $stuffs_price) - Auth::user()->amount > 0) && Auth::user()->per_deposit>0): ?>
                                                    <a href="<?php echo e(URL::to('users/finance/deposit')); ?>" style="margin-top:10px" class="btn btn-danger">Nạp tiền</a>
                                                <?php else: ?>
                                                    <button type="submit" class="btn btn-primary" style="margin-top:10px">Đặt hàng</button>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php endif; ?>


            
    <?php if(isset($cart['taobao_market']) && count($cart['taobao_market'])>0): ?> <?php $list = $cart['taobao_market']; ?>
    <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Taobao - <?php echo e($r['owner_name']); ?></h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm hidden-xs" style="width: 150px;"></div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <div class="col-sm-8 col-xs-12">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th  style="width:30%"><?php echo e(__('main.product')); ?></th>
                                <th><?php echo e(__('main.quantity')); ?></th>
                                <th><?php echo e(__('main.price')); ?></th>
                                <th><?php echo e(__('main.total')); ?></th>
                                <th><?php echo e(__('main.operation')); ?></th>
                            </tr>

                            <?php $index = 0; $stuffs_price = 0; ?>
                            <?php $__currentLoopData = $r['stuffs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php $index++; ?>
                                <tr>
                                    <td>
                                        <img class="lazyload" style="float:left;width:100%;margin-right:10px" src="<?php echo e($r1['picture']); ?>">
                                        <span style="float:left">
                                            <div><a href="<?php echo e($r1['link']); ?>" target="_blank"><?php echo e($r1['name']); ?></a></div>
                                            <?php if(isset($r1['props'])): ?>
                                            <hr>
                                            <div style="font-size:14px">
                                                <ul> 
                                                <?php $__currentLoopData = $r1['props']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><?php echo e($prop['name']); ?> - <?php echo e($prop['val']); ?></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                            <?php endif; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <input class="text-center form-md input-quantity" type="number" min="1" value="<?php echo e($r1['quantity']); ?>" style="width:80px;height:30px" data-config='<?php echo '{"owner_type":"3"'.',"shop":"'.$r['id_owner'].'","index":"'.$index.'"}' ?>'/>
                                        <input class="input-cny-price" type="hidden" value="<?php echo e($r1['price']); ?>" />
                                        <input class="input-vnd-price" type="hidden" value="<?php echo e($r1['price']*$r1['rate']); ?>" />
                                        <div class="btn-group" role="group" aria-label="Default button group">
                                            <button type="button" class="btn btn-warning btn-xs btn-minus"  style="width:30px" data-config='<?php echo '{"owner_type":"3"'.',"shop":"'.$r['id_owner'].'","index":"'.$index.'"}' ?>'>
                                                -
                                            </button>
                                            <button type="button" class="btn btn-success btn-xs btn-plus"  style="width:30px" data-config='<?php echo '{"owner_type":"3"'.',"shop":"'.$r['id_owner'].'","index":"'.$index.'"}' ?>'>
                                                +
                                            </button>
                                        </div>

                                    </td>
                                    <td>
                                        <div><?php echo e(formatCNY($r1['price'])); ?></div>
                                        <div><?php echo e(formatVND($r1['price']*$r1['rate'])); ?></div>
                                    </td>

                                    <td>
                                        <div class="stuff-cny-price"><strong><?php echo e(formatCNY($r1['price']*$r1['quantity'])); ?></strong></div>
                                        <div class="stuff-vnd-price">
                                            <strong><?php echo e(formatVND($r1['price']*$r1['rate']*$r1['quantity'])); ?></strong>
                                        </div>
                                        <?php 
                                            $stuffs_price+=$r1['price']*$r1['rate']*$r1['quantity'];
                                            $fee=($stuffs_price/100)*(Auth::user()->buy_fee);
                                        ?>
                                    </td>
                                    <td>

                                        <div class="btn-group" role="group" aria-label="Default button group">
                                           
                                            <a class="btn btn-default btn-xs btn-danger" 
                                            style="color:#fff" 
                                            href="<?php echo e(URL::to('users/cart/delete?owner_type=3&shop='.$r['id_owner'].'&index='.$index)); ?>">
                                                <i class="fa fa-trash"></i> <?php echo e(__('main.delete')); ?>

                                            </a>
                                        </div>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-xs-12 col-sm-4">
                        <form action="<?php echo e(URL::to('users/cart/make_order')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="<?php echo e($key); ?>" name="index_cart"/>
                            <input type="hidden" value="3" name="owner_type"/>
                            <input type="hidden" value="<?php echo e($r['id_owner']); ?>" name="id_owner"/>
                            <input type="hidden" value="<?php echo e($r['owner_name']); ?>" name="owner_name"/>
                            <input type="hidden" value="<?php echo e($fee+$stuffs_price); ?>" name="total"/>
                            <input type="hidden" value="<?php echo e($r['stuffs'][0]['rate']); ?>" name="rate"/>

                            <div class="box-right ">
                                    <div class="box-header">
                                        <div class="form-group row clearfix">
                                            <label class="col-sm-6 control-label">Tiền hàng:</label>
                                            <div class="col-sm-6 pull-right">
                                                <input type="hidden" class="input-stuffs-price" value="<?php echo e($stuffs_price); ?>"/>
                                                <p class="text-right text-bold6 stuffs-amount text-red"><?php echo e(formatVND($stuffs_price)); ?></p>
                                            </div>
                                        </div>
                                        <div class="form-group row clearfix">
                                            <label class="col-sm-4 control-label">Phí mua hàng: </label>
                                            <div class="col-sm-6 pull-right">
                                                <input type="hidden" class="input-fee-order" value="<?php echo e($fee); ?>"/>
                                                <p class="text-right fee-order text-red">
                                                    <?php echo e(formatVND($fee)); ?>

                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group row clearfix">
                                            <label class="col-sm-8 control-label">Phí kiểm đếm:</label>
                                            <div class="col-sm-4 pull-right">
                                            
                                            </div>
                                        </div>
                                        <div class="form-group row clearfix">
                                            <label class="col-sm-8 control-label">Phí vận chuyển nội địa TQ:</label>
                                            <div class="col-sm-4 pull-right ">
                                                <p class="text-right"><i>-</i></p>
                                            </div>
                                        </div>
                                        <div class="form-group row clearfix">
                                            <label class="col-sm-8 control-label">Phí đóng kiện gỗ:</label>
                                            <div class="col-sm-4 pull-right">
                                                <p class="text-right"><i>-</i></p>
                                            </div>
                                        </div>
                                        <div class="form-group row clearfix">
                                            <label class="col-sm-8 control-label">Phí vận chuyển TQ - VN:</label>
                                            <div class="col-sm-4 pull-right">
                                                <p class="text-right"><i>-</i></p>
                                            </div>
                                        </div>
                                        <div class="form-group row clearfix">
                                            <label class="col-sm-8 control-label">Phí vận chuyển nội địa VN: </label>
                                            <div class="col-sm-4 pull-right">
                                                <p class="text-right"><i>-</i></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row clearfix">
                                            <label class="col-sm-6 control-label text-uppercase" style="padding-top: 5px;">Tổng tiền:</label>
                                            <div class="col-sm-6 pull-right">
                                                <p class="text-right text-red text-bold6" style="font-size: 20px">
                                                    <strong class="final-amount"><?php echo e(formatVND($fee+$stuffs_price)); ?></strong>
                                                </p>
                                            </div>

                                            <div class="miss-amount-wrapper">
                                                <?php if(($fee+$stuffs_price) > (Auth::user()->amount)): ?>
                                                    <label class="col-sm-6 control-label text-uppercase" style="padding-top: 5px;">Còn thiếu:</label>
                                                    <div class="col-sm-6 pull-right">
                                                        <p class="text-right text-red text-bold6" style="font-size: 20px">
                                                            <strong class="miss-amount"><?php echo e(formatVND(($fee+$stuffs_price) - (Auth::user()->amount))); ?></strong>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <label class="col-sm-6 control-label text-uppercase" style="padding-top: 5px;">Số dư hiện tại:</label>
                                            <div class="col-sm-6 pull-right">
                                                <p class="text-right"><b><?php echo e(formatVND(Auth::user()->amount)); ?></b></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="pd10 clearfix">
                                            <label>Ghi chú cho đơn hàng</label>
                                            <textarea name="note" class="form-control"  rows="3" placeholder="Chú thích" spellcheck="false" style=""></textarea>
                                        </div>
                                        <div class="text-right pd10 btn-order-wrapper">

                                            <?php if((($fee + $stuffs_price) - Auth::user()->amount > 0) && Auth::user()->per_deposit>0): ?>
                                                <a href="<?php echo e(URL::to('users/finance/deposit')); ?>" style="margin-top:10px" class="btn btn-danger">Nạp tiền</a>
                                            <?php else: ?>
                                                <button type="submit" class="btn btn-primary" style="margin-top:10px">Đặt hàng</button>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                            </div>
                    </form>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
        <?php if(isset($cart['1688_market']) && count($cart['1688_market'])>0): ?> <?php $list = $cart['1688_market']; ?>
            <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">1688 - <?php echo e($r['owner_name']); ?></h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm hidden-xs" style="width: 150px;"></div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <div class="col-sm-8 col-xs-12">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th  style="width:30%"><?php echo e(__('main.product')); ?></th>
                                        <th><?php echo e(__('main.quantity')); ?></th>
                                        <th><?php echo e(__('main.price')); ?></th>
                                        <th><?php echo e(__('main.total')); ?></th>
                                        <th><?php echo e(__('main.operation')); ?></th>
                                    </tr>

                                    <?php $index = 0; $stuffs_price = 0; ?>
                                    <?php $__currentLoopData = $r['stuffs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php $index++; ?>
                                        <tr>
                                            <td>
                                                <img class="lazyload" style="float:left;width:100%;margin-right:10px" src="<?php echo e($r1['picture']); ?>">
                                                <span style="float:left">
                                                    <div><a href="<?php echo e($r1['link']); ?>" target="_blank"><?php echo e($r1['name']); ?></a></div>

                                                    <?php if(isset($r1['props'])): ?>
                                                    <hr>
                                                    <div style="font-size:14px">
                                                        <ul>
                                                        <?php $__currentLoopData = $r1['props']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li><?php echo e($prop['name']); ?> - <?php echo e($prop['val']); ?></li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                    </div>
                                                    <?php endif; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <input class="text-center form-md input-quantity" type="number" min="1" value="<?php echo e($r1['quantity']); ?>" style="width:80px;height:30px" data-config='<?php echo '{"owner_type":"2"'.',"shop":"'.$r['id_owner'].'","index":"'.$index.'"}' ?>'/>
                                                <input class="input-cny-price" type="hidden" value="<?php echo e($r1['price']); ?>" />
                                                <input class="input-vnd-price" type="hidden" value="<?php echo e($r1['price']*$r1['rate']); ?>" />
                                                <div class="btn-group" role="group" aria-label="Default button group">
                                                    <button type="button" class="btn btn-warning btn-xs btn-minus"  style="width:30px" data-config='<?php echo '{"owner_type":"2"'.',"shop":"'.$r['id_owner'].'","index":"'.$index.'"}' ?>'>
                                                        -
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-xs btn-plus"  style="width:30px" data-config='<?php echo '{"owner_type":"2"'.',"shop":"'.$r['id_owner'].'","index":"'.$index.'"}' ?>'>
                                                        +
                                                    </button>
                                                </div>

                                            </td>
                                            <td>
                                                <div><?php echo e(formatCNY($r1['price'])); ?></div>
                                                <div><?php echo e(formatVND($r1['price']*$r1['rate'])); ?></div>
                                            </td>

                                            <td>
                                                <div class="stuff-cny-price"><strong><?php echo e(formatCNY($r1['price']*$r1['quantity'])); ?></strong></div>
                                                <div class="stuff-vnd-price">
                                                    <strong><?php echo e(formatVND($r1['price']*$r1['rate']*$r1['quantity'])); ?></strong>
                                                </div>
                                                <?php 
                                                    $stuffs_price+=$r1['price']*$r1['rate']*$r1['quantity'];
                                                    $fee=($stuffs_price*Auth::user()->buy_fee)/100;
                                                ?>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Default button group">
                                                    <a class="btn btn-default btn-xs btn-danger" style="color:#fff" href="<?php echo e(URL::to('users/cart/delete?owner_type=2&shop='.$r['id_owner'].'&index='.$index)); ?>">
                                                        <i class="fa fa-trash"></i> <?php echo e(__('main.delete')); ?>

                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                                <form action="<?php echo e(URL::to('users/cart/make_order')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" value="<?php echo e($key); ?>" name="index_cart"/>
                                    <input type="hidden" value="2" name="owner_type"/>
                                    <input type="hidden" value="<?php echo e($r['id_owner']); ?>" name="id_owner"/>
                                    <input type="hidden" value="<?php echo e($r['owner_name']); ?>" name="owner_name"/>
                                    <input type="hidden" value="<?php echo e($fee+$stuffs_price); ?>" name="total"/>
                                    <input type="hidden" value="<?php echo e($r['stuffs'][0]['rate']); ?>" name="rate"/>

                                    <div class="box-right ">
                                        <div class="box-header">
                                            <div class="form-group row clearfix">
                                                <label class="col-sm-6 control-label">Tiền hàng:</label>
                                                <div class="col-sm-6 pull-right">
                                                    <input type="hidden" class="input-stuffs-price" value="<?php echo e($stuffs_price); ?>"/>
                                                    <p class="text-right text-bold6 stuffs-amount text-red"><?php echo e(formatVND($stuffs_price)); ?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row clearfix">
                                                <label class="col-sm-4 control-label">Phí mua hàng: </label>
                                                <div class="col-sm-6 pull-right">
                                                    <input type="hidden" class="input-fee-order" value="<?php echo e($fee); ?>"/>
                                                    <p class="text-right fee-order text-red">
                                                        <?php echo e(formatVND($fee)); ?>

                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group row clearfix">
                                                <label class="col-sm-8 control-label">Phí kiểm đếm:</label>
                                                <div class="col-sm-4 pull-right">
                                                
                                                </div>
                                            </div>
                                            <div class="form-group row clearfix">
                                                <label class="col-sm-8 control-label">Phí vận chuyển nội địa TQ:</label>
                                                <div class="col-sm-4 pull-right ">
                                                    <p class="text-right"><i>-</i></p>
                                                </div>
                                            </div>
                                            <div class="form-group row clearfix">
                                                <label class="col-sm-8 control-label">Phí đóng kiện gỗ:</label>
                                                <div class="col-sm-4 pull-right">
                                                    <p class="text-right"><i>-</i></p>
                                                </div>
                                            </div>
                                            <div class="form-group row clearfix">
                                                <label class="col-sm-8 control-label">Phí vận chuyển TQ - VN:</label>
                                                <div class="col-sm-4 pull-right">
                                                    <p class="text-right"><i>-</i></p>
                                                </div>
                                            </div>
                                            <div class="form-group row clearfix">
                                                <label class="col-sm-8 control-label">Phí vận chuyển nội địa VN: </label>
                                                <div class="col-sm-4 pull-right">
                                                    <p class="text-right"><i>-</i></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row clearfix">
                                                <label class="col-sm-6 control-label text-uppercase" style="padding-top: 5px;">Tổng tiền:</label>
                                                <div class="col-sm-6 pull-right">
                                                    <p class="text-right text-red text-bold6" style="font-size: 20px">
                                                        <strong class="final-amount"><?php echo e(formatVND($fee+$stuffs_price)); ?></strong>
                                                    </p>
                                                </div>

                                                <div class="miss-amount-wrapper">
                                                    <?php if(($fee+$stuffs_price) > (Auth::user()->amount)): ?>
                                                        <label class="col-sm-6 control-label text-uppercase" style="padding-top: 5px;">Còn thiếu:</label>
                                                        <div class="col-sm-6 pull-right">
                                                            <p class="text-right text-red text-bold6" style="font-size: 20px">
                                                                <strong class="miss-amount"><?php echo e(formatVND(($fee+$stuffs_price) - (Auth::user()->amount))); ?></strong>
                                                            </p>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>

                                                <label class="col-sm-6 control-label text-uppercase" style="padding-top: 5px;">Số dư hiện tại:</label>
                                                <div class="col-sm-6 pull-right">
                                                    <p class="text-right"><b><?php echo e(formatVND(Auth::user()->amount)); ?></b></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="pd10 clearfix">
                                                <label>Ghi chú cho đơn hàng</label>
                                                <textarea name="note" class="form-control"  rows="3" placeholder="Chú thích" spellcheck="false" style=""></textarea>
                                            </div>
                                            <div class="text-right pd10 btn-order-wrapper">

                                                <?php if((($fee + $stuffs_price) - Auth::user()->amount > 0) && Auth::user()->per_deposit>0): ?>
                                                    <a href="<?php echo e(URL::to('users/finance/deposit')); ?>" style="margin-top:10px" class="btn btn-danger">Nạp tiền</a>
                                                <?php else: ?>
                                                    <button type="submit" class="btn btn-primary" style="margin-top:10px">Đặt hàng</button>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    <?php endif; ?>


    <div style="display:flex;justify-content:center">
        <a class="btn btn-primary btn-md text-center" style="text-transform:uppercase" href="<?php echo e(URL::to('users/cart/empty')); ?>">
            <?php echo e(__('main.empty_cart')); ?>

        </a>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/azorder/resources/views/users/cart.blade.php ENDPATH**/ ?>