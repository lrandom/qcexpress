<?php $__env->startSection('header',__('main.cart')); ?>
<?php $__env->startSection('small_header',''); ?>
<?php $__env->startSection('content'); ?>

<?php
 $buy_fee=0;   
?>
<script type="text/javascript">
    var url_deposit = "<?php echo e(URL::to('users/finance/deposit')); ?>";
    var user_amount = "<?php echo e(Auth::user()->amount); ?>";
    var buy_fee=5;
</script>



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




<link rel="stylesheet" type="text/css" href="<?php echo e(asset('public/css/cart.css?x='.time())); ?>"/>
<div class="col-xs-12">
    <div id="timeline-wrap">                
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
            <div class="box">
                <div class="box-header" style="background: #605ca8; color: #fff;">
                    <h3 class="box-title" style="color: #fff;">Tmall World Shop</h3>
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
                                    <th style="width:15px">
                                        <input type="checkbox" checked class="check-item-ip" name="slt_item[]">
                                    </th>
                                    <th style="width:30%"><?php echo e(__('main.product')); ?></th>
                                    <th><?php echo e(__('main.quantity')); ?></th>
                                    <th><?php echo e(__('main.price')); ?></th>
                                    <th><?php echo e(__('main.price_stuffs')); ?></th>
                                    <th><?php echo e(__('main.operation')); ?></th>
                                </tr>
                                <?php $index = 0; $stuffs_price = 0; ?>
                                <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php $index++; ?>
                                    <tr class="item-wrapper">
                                        <td>
                                            <input type="checkbox" checked class="check-item-elm" data-ind="<?php echo e($key); ?>">
                                            <input class="od-ind-item" data-only="tmalworld<?php echo e($key); ?>" type="hidden" value="<?php echo e($key); ?>" name="owner_type[1][-1][<?php echo e($key); ?>][ind_item][]"/>
                                        </td>
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
                                            <input class="text-center form-md input-quantity" data-config='<?php echo '{"owner_type":"1"'.',"shop":"-1","index":"'.$index.'"}' ?>'  min="1" value="<?php echo e($r['quantity']); ?>" type="number" min="1" value="<?php echo e($r['quantity']); ?>" style="width:80px;height:30px"/>
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
                                                <input class="price-only-item" type="hidden" value="<?php echo e($r1['price']*$r1['rate']*$r1['quantity']); ?>">
                                                <strong><?php echo e(formatVND( $r['price']*$r['rate']*$r['quantity'])); ?></strong>
                                            <?php 
                                            $stuffs_price+=$r['price']*$r['rate']*$r['quantity'];
                                            // if($stuffs_price<1000000){
                                            //     $buy_fee=7;
                                            // }
                                            // if($stuffs_price>=1000000 && $stuffs_price<15000000){
                                            //     $buy_fee=5;
                                            // }

                                            // if($stuffs_price>=15000000 && $stuffs_price<35000000){
                                            //     $buy_fee=4;
                                            // }

                                            // if($stuffs_price>=35000000 && $stuffs_price<55000000){
                                            //     $buy_fee=3;
                                            // }

                                            // if($stuffs_price>=55000000 && $stuffs_price<130000000){
                                            //     $buy_fee=2;
                                            // }

                                            // if($stuffs_price>=130000000 && $stuffs_price<250000000){
                                            //     $buy_fee=1;
                                            // }
                                             $buy_fee = Auth::user()->buy_fee;
                                             $fee= ($stuffs_price/100)*($buy_fee);
                                            // $fee=0;
                                            ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Default button group">
                                               
                                                <a data-toggle="modal" data-target="#delModal" class="btn btn-default btn-xs btn-danger btn-del" style="color:#fff" href="#" data-link="<?php echo e(URL::to('users/cart/delete?owner_type=1&shop=-1&index='.$index)); ?>">
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
                            <div class="group-ip">
                                <input class="od-owner-name" data-only="tmalworld<?php echo e($key); ?>" type="hidden" value="TMAL SHOP GLOBAL" name="owner_type[1][-1][<?php echo e($key); ?>][owner_name]"/>
                                <input class="od-rate" data-only="tmalworld<?php echo e($key); ?>" type="hidden" value="<?php echo e($r['stuffs'][0]['rate']); ?>" name="owner_type[1][-1][<?php echo e($key); ?>][rate]"/>
                                <input type="hidden" data-only="tmalworld<?php echo e($key); ?>" value="<?php echo e($fee+$stuffs_price); ?>" name="total"/>
                            </div>    
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
                                            <p class="text-right text-red"><strong class="count-fee-order"><?php echo e(formatVND($fee)); ?></strong></p>
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
                                        <label class="col-sm-6 control-label text-uppercase" style="padding-top: 5px;">Tạm tính:</label>
                                        <div class="col-sm-6 pull-right">
                                            <p class="text-right text-red text-bold6" style="font-size: 20px">
                                                <strong class="final-amount"><?php echo e(formatVND($fee+$stuffs_price)); ?></strong>
                                            </p>
                                        </div>
                                        
                                        
                                        
                                        <label class="col-sm-6 control-label text-uppercase" style="padding-top: 5px;">Số dư hiện tại:</label>
                                        <div class="col-sm-6 pull-right">
                                            <p class="text-right text-green"><b style="font-size: 18px;"><?php echo e(formatVND(Auth::user()->amount)); ?></b></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="pd10 clearfix">
                                        <label>Ghi chú cho đơn hàng</label>
                                        <textarea class="od-note form-control" data-only="tmalworld<?php echo e($key); ?>" name="owner_type[1][-1][<?php echo e($key); ?>][note]" rows="3" placeholder="Chú thích" spellcheck="false"></textarea>
                                    </div>
                                    <div class="text-right pd10 btn-order-wrapper">

                                        
                                            <button type="button" class="btn btn-add-order btn-danger" style="margin-top:10px">Lên đơn</button>
                                        
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
                    <div class="box-header" style="background: #605ca8; color: #fff;">
                        <h3 class="box-title" style="color: #fff;">Tmall Market - <?php echo e($r['owner_name']); ?></h3>
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
                                        <th style="width:15px">
                                            <input type="checkbox" checked class="check-item-ip" name="slt_item[]">
                                        </th>
                                        <th  style="width:30%"><?php echo e(__('main.product')); ?></th>
                                        <th><?php echo e(__('main.quantity')); ?></th>
                                        <th><?php echo e(__('main.price')); ?></th>
                                        <th><?php echo e(__('main.total')); ?></th>
                                        <th><?php echo e(__('main.operation')); ?></th>
                                    </tr>

                                    <?php $index = 0; $stuffs_price = 0; ?>
                                    <?php if(count($r['stuffs'])>0): ?>
                                    <?php $__currentLoopData = $r['stuffs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $r1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php $index++; ?>
                                        <tr class="item-wrapper">
                                            <td>
                                                <input type="checkbox" checked class="check-item-elm" data-ind="<?php echo e($k); ?>">
                                                <input class="od-ind-item" data-only="tmalmarket<?php echo e($key); ?><?php echo e($k); ?>" type="hidden" value="<?php echo e($k); ?>" name="owner_type[1][<?php echo e($r['id_owner']); ?>][<?php echo e($key); ?>][ind_item][]"/>
                                            </td>
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
                                                    <input class="price-only-item" type="hidden" value="<?php echo e($r1['price']*$r1['rate']*$r1['quantity']); ?>">
                                                    <strong><?php echo e(formatVND($r1['price']*$r1['rate']*$r1['quantity'])); ?></strong>
                                                </div>
                                                <?php 
                                                    $stuffs_price+=$r1['price']*$r1['rate']*$r1['quantity'];
                                                //     if($stuffs_price<1000000){
                                                //     $buy_fee=7;
                                                // }
                                                // if($stuffs_price>=1000000 && $stuffs_price<15000000){
                                                //     $buy_fee=5;
                                                // }

                                                // if($stuffs_price>=15000000 && $stuffs_price<35000000){
                                                //     $buy_fee=4;
                                                // }

                                                // if($stuffs_price>=35000000 && $stuffs_price<55000000){
                                                //     $buy_fee=3;
                                                // }

                                                // if($stuffs_price>=55000000 && $stuffs_price<130000000){
                                                //     $buy_fee=2;
                                                // }

                                                // if($stuffs_price>=130000000 && $stuffs_price<250000000){
                                                //     $buy_fee=1;
                                                // }

                                                $buy_fee = Auth::user()->buy_fee;
                                                $fee= ($stuffs_price/100)*($buy_fee);
                                                ?>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Default button group">
                                                
                                                    <a data-toggle="modal" data-target="#delModal" class="btn btn-default btn-xs btn-danger btn-del" style="color:#fff" href="#" data-link="<?php echo e(URL::to('users/cart/delete?owner_type=1&shop='.$r['id_owner'].'&index='.$index)); ?>">
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
                                    <div class="group-ip">
                                        <input class="od-owner-name" data-only="tmalmarket<?php echo e($key); ?>" type="hidden" value="<?php echo e($r['owner_name']); ?>" name="owner_type[1][<?php echo e($r['id_owner']); ?>][<?php echo e($key); ?>][owner_name]"/>
                                        <input class="od-rate" data-only="tmalmarket<?php echo e($key); ?>" type="hidden" value="<?php echo e($r['stuffs'][0]['rate']); ?>" name="owner_type[1][<?php echo e($r['id_owner']); ?>][<?php echo e($key); ?>][rate]"/>
                                        <input type="hidden" data-only="tmalmarket<?php echo e($key); ?>" value="<?php echo e($fee+$stuffs_price); ?>" name="total"/>
                                    </div>
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
                                                        <p class="text-right text-red"><strong class="count-fee-order"><?php echo e(formatVND($fee)); ?></strong></p>
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
                                                    <label class="col-sm-6 control-label text-uppercase" style="padding-top: 5px;">Tạm tính</label>
                                                    <div class="col-sm-6 pull-right">
                                                        <p class="text-right text-red text-bold6" style="font-size: 20px">
                                                            <strong class="final-amount"><?php echo e(formatVND($fee+$stuffs_price)); ?></strong>
                                                        </p>
                                                    </div>

                                            

                                                    <label class="col-sm-6 control-label text-uppercase" style="padding-top: 5px;">Số dư hiện tại:</label>
                                                    <div class="col-sm-6 pull-right">
                                                        <p class="text-right text-green"><b style="font-size: 18px;"><?php echo e(formatVND(Auth::user()->amount)); ?></b></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="pd10 clearfix">
                                                    <label>Ghi chú cho đơn hàng</label>
                                                    <textarea class="od-note form-control" data-only="tmalmarket<?php echo e($key); ?>" name="owner_type[1][<?php echo e($r['id_owner']); ?>][<?php echo e($key); ?>][note]" rows="3" placeholder="Chú thích" spellcheck="false"></textarea>
                                                </div>
                                                <div class="text-right pd10 btn-order-wrapper">

                                                
                                                        <button type="button" class="btn btn-add-order btn-danger" style="margin-top:10px">Lên đơn</button>
                                                
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
                    <div class="box-header" style="background: #605ca8; color: #fff;">
                        <h3 class="box-title" style="color: #fff;">Taobao - <?php echo e($r['owner_name']); ?></h3>
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
                                        <th style="width:15px">
                                            <input type="checkbox" checked class="check-item-ip" name="slt_item[]">
                                        </th>
                                        <th  style="width:30%"><?php echo e(__('main.product')); ?></th>
                                        <th><?php echo e(__('main.quantity')); ?></th>
                                        <th><?php echo e(__('main.price')); ?></th>
                                        <th><?php echo e(__('main.total')); ?></th>
                                        <th><?php echo e(__('main.operation')); ?></th>
                                    </tr>

                                    <?php $index = 0; $stuffs_price = 0; ?>
                                    <?php $__currentLoopData = $r['stuffs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $r1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php $index++; ?>
                                        <tr class="item-wrapper">
                                            <td>
                                                <input type="checkbox" checked class="check-item-elm" data-ind="<?php echo e($k); ?>">
                                                <input class="od-ind-item" data-only="taobao<?php echo e($key); ?><?php echo e($k); ?>" type="hidden" value="<?php echo e($k); ?>" name="owner_type[3][<?php echo e($r['id_owner']); ?>][<?php echo e($key); ?>][ind_item][]"/>
                                            </td>
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
                                                    <input class="price-only-item" type="hidden" value="<?php echo e($r1['price']*$r1['rate']*$r1['quantity']); ?>">
                                                    <strong><?php echo e(formatVND($r1['price']*$r1['rate']*$r1['quantity'])); ?></strong>
                                                </div>
                                                <?php 
                                                    $stuffs_price+=$r1['price']*$r1['rate']*$r1['quantity'];
                                                    // if($stuffs_price<1000000){
                                                    //     $buy_fee=7;
                                                    // }
                                                    // if($stuffs_price>=1000000 && $stuffs_price<15000000){
                                                    //     $buy_fee=5;
                                                    // }

                                                    // if($stuffs_price>=15000000 && $stuffs_price<35000000){
                                                    //     $buy_fee=4;
                                                    // }

                                                    // if($stuffs_price>=35000000 && $stuffs_price<55000000){
                                                    //     $buy_fee=3;
                                                    // }

                                                    // if($stuffs_price>=55000000 && $stuffs_price<130000000){
                                                    //     $buy_fee=2;
                                                    // }

                                                    // if($stuffs_price>=130000000 && $stuffs_price<250000000){
                                                    //     $buy_fee=1;
                                                    // }
                                                    $buy_fee = Auth::user()->buy_fee;
                                                    $fee= ($stuffs_price/100)*($buy_fee);
                                                ?>
                                            </td>
                                            <td>

                                                <div class="btn-group" role="group" aria-label="Default button group">
                                                
                                                    <a data-toggle="modal" data-target="#delModal" class="btn btn-default btn-xs btn-danger btn-del" style="color:#fff" href="#" data-link="<?php echo e(URL::to('users/cart/delete?owner_type=3&shop='.$r['id_owner'].'&index='.$index)); ?>">
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
                                    <div class="group-ip">
                                        <input class="od-owner-name" data-only="taobao<?php echo e($key); ?>" type="hidden" value="<?php echo e($r['owner_name']); ?>" name="owner_type[3][<?php echo e($r['id_owner']); ?>][<?php echo e($key); ?>][owner_name]"/>
                                        <input class="od-rate" data-only="taobao<?php echo e($key); ?>" type="hidden" value="<?php echo e($r['stuffs'][0]['rate']); ?>" name="owner_type[3][<?php echo e($r['id_owner']); ?>][<?php echo e($key); ?>][rate]"/>
                                        <input type="hidden" data-only="taobao<?php echo e($key); ?>" value="<?php echo e($fee+$stuffs_price); ?>" name="total"/>
                                    </div>
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
                                                            
                                                            <p class="text-right text-red"><strong class="count-fee-order"><?php echo e(formatVND($fee)); ?></strong></p>
                                                        </p>
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
                                                    <label class="col-sm-6 control-label text-uppercase" style="padding-top: 5px;">Tạm tính</label>
                                                    <div class="col-sm-6 pull-right">
                                                        <p class="text-right text-red text-bold6" style="font-size: 20px">
                                                            <strong class="final-amount"><?php echo e(formatVND($fee+$stuffs_price)); ?></strong>
                                                        </p>
                                                    </div>

                                            

                                                    <label class="col-sm-6 control-label text-uppercase" style="padding-top: 5px;">Số dư hiện tại:</label>
                                                    <div class="col-sm-6 pull-right">
                                                        <p class="text-right text-green"><b style="font-size: 18px;"><?php echo e(formatVND(Auth::user()->amount)); ?></b></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="pd10 clearfix">
                                                    <label>Ghi chú cho đơn hàng</label>
                                                    <textarea class="od-note form-control" data-only="taobao<?php echo e($key); ?>" name="owner_type[3][<?php echo e($r['id_owner']); ?>][<?php echo e($key); ?>][note]" rows="3" placeholder="Chú thích" spellcheck="false"></textarea>
                                                </div>
                                                <div class="text-right pd10 btn-order-wrapper">
                                                    <button type="button" class="btn btn-add-order btn-danger" style="margin-top:10px">Lên đơn</button>
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
                    <div class="box-header" style="background: #605ca8;">
                        <h3 class="box-title" style="color: #fff;">1688 - <?php echo e($r['owner_name']); ?></h3>
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
                                        <th style="width:15px">
                                            <input type="checkbox" checked class="check-item-ip" name="slt_item[]">
                                        </th>
                                        <th  style="width:30%"><?php echo e(__('main.product')); ?></th>
                                        <th><?php echo e(__('main.quantity')); ?></th>
                                        <th><?php echo e(__('main.price')); ?></th>
                                        <th><?php echo e(__('main.total')); ?></th>
                                        <th><?php echo e(__('main.operation')); ?></th>
                                    </tr>

                                    <?php $index = 0; $stuffs_price = 0; ?>
                                    <?php $__currentLoopData = $r['stuffs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $r1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php $index++; ?>
                                        <tr class="item-wrapper">
                                            <td>
                                                <input type="checkbox" checked class="check-item-elm" data-ind="<?php echo e($k); ?>">
                                                <input class="od-ind-item" data-only="1688<?php echo e($key); ?><?php echo e($k); ?>" type="hidden" value="<?php echo e($k); ?>" name="owner_type[2][<?php echo e($r['id_owner']); ?>][<?php echo e($key); ?>][ind_item][]"/>
                                            </td>
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
                                                    <input class="price-only-item" type="hidden" value="<?php echo e($r1['price']*$r1['rate']*$r1['quantity']); ?>">
                                                    <strong><?php echo e(formatVND($r1['price']*$r1['rate']*$r1['quantity'])); ?></strong>
                                                </div>
                                                <?php 
                                                    $stuffs_price+=$r1['price']*$r1['rate']*$r1['quantity'];
                                            //         if($stuffs_price<1000000){
                                            //     $buy_fee=7;
                                            // }
                                            // if($stuffs_price>=1000000 && $stuffs_price<15000000){
                                            //     $buy_fee=5;
                                            // }

                                            // if($stuffs_price>=15000000 && $stuffs_price<35000000){
                                            //     $buy_fee=4;
                                            // }

                                            // if($stuffs_price>=35000000 && $stuffs_price<55000000){
                                            //     $buy_fee=3;
                                            // }

                                            // if($stuffs_price>=55000000 && $stuffs_price<130000000){
                                            //     $buy_fee=2;
                                            // }

                                            // if($stuffs_price>=130000000 && $stuffs_price<250000000){
                                            //     $buy_fee=1;
                                            // }
                                            $buy_fee = Auth::user()->buy_fee;
                                            $fee = ($stuffs_price/100)*($buy_fee);
                                                ?>
                                            </td>
                                            <td>

                                                <div class="btn-group" role="group" aria-label="Default button group">
                                                    
                                                    <a data-toggle="modal" data-target="#delModal" class="btn btn-default btn-xs btn-danger btn-del" style="color:#fff" href="#" data-link="<?php echo e(URL::to('users/cart/delete?owner_type=2&shop='.$r['id_owner'].'&index='.$index)); ?>">
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
                                    <div class="group-ip">
                                        <input class="od-owner-name" data-only="1688<?php echo e($key); ?>" type="hidden" value="<?php echo e($r['owner_name']); ?>" name="owner_type[2][<?php echo e($r['id_owner']); ?>][<?php echo e($key); ?>][owner_name]"/>
                                        <input class="od-rate" data-only="1688<?php echo e($key); ?>" type="hidden" value="<?php echo e($r['stuffs'][0]['rate']); ?>" name="owner_type[2][<?php echo e($r['id_owner']); ?>][<?php echo e($key); ?>][rate]"/>
                                        <input type="hidden" data-only="1688<?php echo e($key); ?>" value="<?php echo e($fee+$stuffs_price); ?>" name="total"/>
                                    </div>

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
                                                    
                                                    <p class="text-right text-red"><strong class="count-fee-order"><?php echo e(formatVND($fee)); ?></strong></p>
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
                                                <label class="col-sm-6 control-label text-uppercase" style="padding-top: 5px;">Tạm tính</label>
                                                <div class="col-sm-6 pull-right">
                                                    <p class="text-right text-red text-bold6" style="font-size: 20px">
                                                        <strong class="final-amount"><?php echo e(formatVND($fee+$stuffs_price)); ?></strong>
                                                    </p>
                                                </div>

                                                <label class="col-sm-6 control-label text-uppercase" style="padding-top: 5px;">Số dư hiện tại:</label>
                                                <div class="col-sm-6 pull-right">
                                                    <p class="text-right text-green"><b style="font-size: 18px;"><?php echo e(formatVND(Auth::user()->amount)); ?></b></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="pd10 clearfix">
                                                <label>Ghi chú cho đơn hàng</label>
                                                <textarea class="od-note form-control" data-only="1688<?php echo e($key); ?>" name="owner_type[2][<?php echo e($r['id_owner']); ?>][<?php echo e($key); ?>][note]" rows="3" placeholder="Chú thích" spellcheck="false"></textarea>
                                            </div>
                                            <div class="text-right pd10 btn-order-wrapper">
                                                <button type="button" class="btn btn-add-order btn-danger" style="margin-top:10px">Đặt hàng</button>
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


    <br>

    <div class="rpw" style="    position: fixed;
    bottom: 0px;
    left: 0px;
    right: 0px;
    background: #605ca8;
    z-index: 10000;
    display: flex;
    align-items: center;
    color:white;
    padding:10px;
    justify-content:center
    ">
        <span class="shop-all-cart" style="margin-right: 30px;">Tổng số shop: <b class="numb-shop">-</b></span>
        <span class="" style="margin-right: 30px;">Tổng số sản phẩm: <b class="numb-item">-</b></span>
        <span class="price-all-cart" style="margin-right: 30px;">Tổng tiền hàng: <b class="numb-price">-</b></span>
        <span class="price-all-cart" style="margin-right: 30px;">Tổng tiền dịch vụ: <b class="numb-service">-</b></span>
        <span class="price-all-cart" style="margin-right: 30px;">Tổng đơn hàng: <b class="numb-total">-</b></span>
        
        <a class="btn btn-warning btn-md text-center pull-right" style="text-transform:uppercase" href="<?php echo e(URL::to('users/cart/empty')); ?>">
            <?php echo e(__('main.empty_cart')); ?>

        </a>
        <form action="<?php echo e(URL::to('users/cart/make_order')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="group-all-ip">
            </div>
            <button type="button" class="btn btn-warning btn-md text-center pull-right btn-order-total" style="text-transform:uppercase; margin-left: 15px;">
                Đặt hàng tất cả
            </button>
        </form>
    </div>

</div>




<style>
    .group-all-ip textarea{
        display: none !important;
    }
</style>




<div class="modal fade" id="tickModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Bạn chưa lựa chọn sản phẩm</h4>
        </div>
        <div class="modal-body">
            <p>Bạn chưa lựa chọn sản phẩm nào để thực hiện đặt hàng</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Đặt lại</button>
        </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="delModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Bạn có chắc xoá</h4>
        </div>
        <div class="modal-body">
            <p>Bạn có chắc chắn muón xoá sản phẩm này khỏi giỏ hàng</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(__('main.cancel')); ?></button>
            <button type="button" class="btn btn-danger confirm-del" data-dismiss="modal">Xoá</button>
        </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->





    <script>
        buy_fee = "<?php echo e($buy_fee); ?>";
    </script>
    <script type="text/javascript" src="<?php echo e(asset('public/js/cart.js?x='.time())); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/qc_express/resources/views/users/cart.blade.php ENDPATH**/ ?>