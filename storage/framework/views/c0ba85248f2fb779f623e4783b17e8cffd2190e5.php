<style>
    table ul {
        margin: 0px;
        padding: 0px;
    }

    table ul li {
        list-style-type: none;
    }
    
</style>
<?php
  use App\CommentsOrders as CommentsOrders;
  use App\Links as Links;
?>

<?php $__env->startSection('content'); ?>
<?php $__env->startSection('header',__('main.orders')); ?>
<?php switch($status):
case (null): ?>
<?php $__env->startSection('small_header','Tất cả'); ?>
<?php break; ?>
    <?php case (0): ?>
        <?php $__env->startSection('small_header','Đang chờ'); ?>
        <?php break; ?>

        <?php case (1): ?>
        <?php $__env->startSection('small_header','Đã kiểm tra'); ?>
        <?php break; ?>

        <?php case (2): ?>
        <?php $__env->startSection('small_header','Đang xử lý'); ?>
        <?php break; ?>
        
        <?php case (3): ?>
        <?php $__env->startSection('small_header','Đã mua'); ?>
        <?php break; ?>

        <?php case (4): ?>
        <?php $__env->startSection('small_header','Shop đã gửi hàng'); ?>
        <?php break; ?>

        <?php case (5): ?>
        <?php $__env->startSection('small_header','Đến kho Trung Quốc'); ?>
        <?php break; ?>

        <?php case (6): ?>
        <?php $__env->startSection('small_header','Về kho Việt Nam'); ?>
        <?php break; ?>

        <?php case (7): ?>
        <?php $__env->startSection('small_header','Đã kiểm hàng'); ?>
        <?php break; ?>

        <?php case (8): ?>
        <?php $__env->startSection('small_header','Đã giao hàng'); ?>
        <?php break; ?>

        <?php case (9): ?>
        <?php $__env->startSection('small_header','Đã nhận hàng'); ?>
        <?php break; ?>

        <?php case (10): ?>
        <?php $__env->startSection('small_header','Đã hết hàng'); ?>
        <?php break; ?>

        <?php case (11): ?>
        <?php $__env->startSection('small_header','Đã thanh toán (cọc)'); ?>
        <?php break; ?>

        <?php case (12): ?>
        <?php $__env->startSection('small_header','Chưa thanh toán (chưa cọc)'); ?>
        <?php break; ?>

        <?php case (13): ?>
        <?php $__env->startSection('small_header','Đã tất toán'); ?>
        <?php break; ?>

        <?php case (20): ?>
        <?php $__env->startSection('small_header','Đã huỷ'); ?>
        <?php break; ?>
    <?php default: ?>
<?php endswitch; ?>
<?php if(session('notify')): ?>
  <div class="alert alert-success">
    <?php echo e(session('notify')); ?>

  </div>
<?php endif; ?>

<script>
    var id_user = '<?php echo e(Auth::user()->id); ?>';
</script>

<script src="<?php echo e(asset('js/order.js?x=')); ?><?php echo e(time()); ?>"></script>
<div class="box-body table-responsive">    
    <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php  
      $total_quantity = 0;
      $total_price    = 0;
      $index= 0;
    ?>
    <table class="table table-bordered" style="background:white;margin-top:10px">
        <tbody>
            <tr>

                <th colspan="2">Mã: <a>QC<?php echo e($r->id); ?></a> <br> Nguời bán: <a><?php echo e($r->owner_name); ?></a></th>
                <th class="text-center" style="min-width:80px">Giá 1 SP</th>
                <th class="text-center" style="min-width:80px">Số luợng</th>
                <th class="text-center" style="min-width:80px">Giá x SL</th>
                <th class="text-center">
                 
                        <?php switch($r->status):
                        case (0): ?>
                            <span class="status text-yellow">Tiếp nhận đơn</span>
                            <?php if($r->is_final==1): ?>
                              - <span class="status text-green">Đã tất toán</span>
                            <?php else: ?>
                            <?php if($r->deposit>0): ?>
                              - <span class="status text-green">Đã đặt cọc</span>
                            <?php else: ?>
                              - <span class="status text-green">Chưa đặt cọc</span>
                            <?php endif; ?> 
                            <?php endif; ?>
                        <?php break; ?>

                        <?php case (1): ?>
                            <span class="status text-yellow">Đã kiểm tra</span>
                            <?php if($r->is_final==1): ?>
                            - <span class="status text-green">Đã tất toán</span>
                          <?php else: ?>
                          <?php if($r->deposit>0): ?>
                            - <span class="status text-green">Đã đặt cọc</span>
                          <?php else: ?>
                            - <span class="status text-green">Chưa đặt cọc</span>
                          <?php endif; ?> 
                          <?php endif; ?>
                        <?php break; ?>


                        <?php case (3): ?>
                            <span class="status text-yellow">Đã mua</span>
                            <?php if($r->is_final==1): ?>
                            - <span class="status text-green">Đã tất toán</span>
                          <?php else: ?>
                          <?php if($r->deposit>0): ?>
                            - <span class="status text-green">Đã đặt cọc</span>
                          <?php else: ?>
                            - <span class="status text-green">Chưa đặt cọc</span>
                          <?php endif; ?> 
                          <?php endif; ?>
                        <?php break; ?>;

                        <?php case (4): ?>
                          <span class="status text-yellow">Shop đã gửi hàng</span>
                            <?php if($r->is_final==1): ?>
                            - <span class="status text-green">Đã tất toán</span>
                          <?php else: ?>
                          <?php if($r->deposit>0): ?>
                            - <span class="status text-green">Đã đặt cọc</span>
                          <?php else: ?>
                            - <span class="status text-green">Chưa đặt cọc</span>
                          <?php endif; ?> 
                          <?php endif; ?>
                        <?php break; ?>;

                        <?php case (5): ?>
                            <span class="status text-yellow">Đến kho Trung Quốc</span>
                            <?php if($r->is_final==1): ?>
                            - <span class="status text-green">Đã tất toán</span>
                          <?php else: ?>
                          <?php if($r->deposit>0): ?>
                            - <span class="status text-green">Đã đặt cọc</span>
                          <?php else: ?>
                            - <span class="status text-green">Chưa đặt cọc</span>
                          <?php endif; ?> 
                          <?php endif; ?>
                        <?php break; ?>;

                        <?php case (6): ?>
                            <span class="status text-green">Về kho Việt Nam</span>
                            <?php if($r->is_final==1): ?>
                            - <span class="status text-green">Đã tất toán</span>
                          <?php else: ?>
                          <?php if($r->deposit>0): ?>
                            - <span class="status text-green">Đã đặt cọc</span>
                          <?php else: ?>
                            - <span class="status text-green">Chưa đặt cọc</span>
                          <?php endif; ?> 
                          <?php endif; ?>
                        <?php break; ?>;

                        <?php case (7): ?>
                        <span class="status text-green">Đã kiểm hàng</span>
                        <?php if($r->is_final==1): ?>
                        - <span class="status text-green">Đã tất toán</span>
                      <?php else: ?>
                      <?php if($r->deposit>0): ?>
                        - <span class="status text-green">Đã đặt cọc</span>
                      <?php else: ?>
                        - <span class="status text-green">Chưa đặt cọc</span>
                      <?php endif; ?> 
                      <?php endif; ?>
                        <?php break; ?>;

                        <?php case (8): ?>
                        <span class="status text-green">Đã giao hàng</span>
                        <?php if($r->is_final==1): ?>
                        - <span class="status text-green">Đã tất toán</span>
                      <?php else: ?>
                      <?php if($r->deposit>0): ?>
                        - <span class="status text-green">Đã đặt cọc</span>
                      <?php else: ?>
                        - <span class="status text-green">Chưa đặt cọc</span>
                      <?php endif; ?> 
                      <?php endif; ?>
                        <?php break; ?>;

                        <?php case (9): ?>
                        <span class="status text-green">Đã nhận hàng</span>
                        <?php break; ?>;

                        <?php case (10): ?>
                        <span class="status text-red">Đã hết hàng</span>
                        <?php break; ?>;

                      
                        <?php case (20): ?>
                        <span class="status text-red">Đã huỷ</span>
                        <?php break; ?>;

                        <?php default: ?>
                    <?php endswitch; ?>

                </th>
            </tr>

            <?php $__currentLoopData = $r->stuffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php 
                $total_quantity += $r1->quantity;
                $total_price += ($r1->quantity * $r1->price);
              ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php $__currentLoopData = $r->stuffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 
              $index++; 
            ?>
            <tr>
                <td class="text-center"><?php echo e($index); ?></td>
                <td style="width: 40%; vertical-align: center;">
                    <div style="display: flex; align-content: center;">
                      <?php if($r->picture!=null): ?>
                        <img class="lazyload" style="float:left;width:85px;margin-right:10px" src="<?php echo e($r1->picture); ?>">
                      <?php endif; ?>
                        <span style="float:left">
                            <div>
                              <a href="<?php echo e($r1->link); ?>" target="_blank" style=" width: 250px;
                                white-space: nowrap;
                                overflow: hidden;
                                display:block;
                                text-overflow: ellipsis;"><?php echo e($r1->name); ?></a>
                              <br>
                              <?php $sub_link = Links::where('id_stuff', $r1->id)->get();
                                if($sub_link != null){
                                  foreach ($sub_link as $lab) { ?>
                                    <a href="<?php echo e($lab->path); ?>" target="_blank" style=" width: 250px;
                                        white-space: nowrap;
                                        overflow: hidden;
                                        display:block;
                                        text-overflow: ellipsis;"><?php echo e($lab->path); ?></a>
                                    <br>
                                  <?php }
                                }
                              ?>
                            </div>
                            <div>
                               <?php
                                  if($r1->props!=null){
                                    $props = json_decode($r1->props);
                                    foreach ($props as $prop) {
                                      echo $prop->name.'-'.$prop->val.'<br>';
                                    }
                                  }
                                ?>
                            </div>
                        </span>
                    </div>
                    <div class="">
                        <?php if($r1->status == 1): ?>
                            <label class="label label-danger" for="">Hết hàng</label>
                        <?php endif; ?>
                    </div>
                </td>

                <td style="font-size:14px"><?php echo e(formatCNY($r1->price)); ?></td>
                <td>
                    <?php echo e($r1->quantity); ?>

                </td>
                <td><strong style="font-size:14px"> <?php echo e(formatCNY($r1->quantity*$r1->price)); ?> </strong></td>

                <?php if($index==1): ?>
                  <td rowspan="<?php echo e(count($r->stuffs)); ?>">
                    <table class="table order_value">
                        <tbody>
                            <tr>
                                <td class="col-sm-5">Ngày tạo đơn</td>
                                <td class="col-sm-7 text-red"><?php echo e(formatvidate($r->created_at)); ?></td>
                            </tr>

                            <tr>
                                <td class="col-sm-5">Ngày cập nhật đơn</td>
                                <td class="col-sm-7 text-red"><?php echo e(formatvidate($r->updated_at)); ?></td>
                            </tr>

                            <tr>
                                <td class="col-sm-5">Ghi chú</td>
                                <td class="col-sm-7 text-red"><?php echo e($r->note); ?></td>
                            </tr>
                            <tr>
                                <td class="col-sm-5">Tổng số lượng</td>
                                <td class="col-sm-7">
                                    <b><?php echo e($total_quantity); ?></b>
                                </td>
                            </tr>
        
                            <tr>
                                <td>Tỷ giá</td>
                                <td class="text-red"><strong><?php echo e(formatVND($r->exchange_rate)); ?></strong></td>
                            </tr>

                            <tr>
                                <td class="">Tổng giá sản phẩm</td>
                                <td class="text-success"><strong><?php echo e(formatCNY($total_price)); ?> - <?php echo e(formatVND($total_price*$r->exchange_rate)); ?></strong></td>
                            </tr>

                            <tr>
                                <td class="">Phí mua hàng</td>
                                <td class="text-success">
                                <?php echo e(formatCNY($total_price/100*$r->fee_service)); ?> -
                                <?php echo e(formatVND( (($total_price/100*$r->fee_service))*$r->exchange_rate)); ?>

                                </td>
                            </tr>

                            <tr>
                                <td class="">Phí nội địa TQ</td>
                                <td>                                
                                    <?php if($r->transport_cn!=null): ?>  
                                     <?php echo e(formatCNY($r->transport_cn)); ?>

                                       -
                                     <?php echo e(formatVND($r->transport_cn*$r->exchange_rate)); ?>

                                    <?php else: ?>
                                      -    
                                     <?php endif; ?>
                                </td>
                            </tr>

                            <tr>
                                <td class="">Phí vận chuyển Trung Việt</td>
                                <td>
                                    <?php if($r->transport_cn_vn!=null): ?>  
                                     <?php echo e(formatCNY($r->transport_cn_vn)); ?>

                                       -
                                     <?php echo e(formatVND($r->transport_cn_vn*$r->exchange_rate)); ?>

                                    <?php else: ?>
                                      -    
                                     <?php endif; ?>
                                </td>
                            </tr>

                            <tr>
                                <td class="">Cân nặng</td>
                                <td>
                                    <?php if($r->weight!=null): ?>  
                                     <?php echo e($r->weight); ?> (Kg)
                                    <?php else: ?>
                                      -    
                                     <?php endif; ?>
                                </td>
                            </tr>

                            <tr>
                                <td class="">Phí đóng kiện gỗ</td>
                                <td>
                                <?php if($r->wood_package!=null): ?>  
                                <?php echo e(formatCNY($r->wood_package)); ?>

                                  -
                                <?php echo e(formatVND($r->wood_package*$r->exchange_rate)); ?>

                               <?php else: ?>
                                 -    
                                <?php endif; ?>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="">Mã đơn hàng TQ</td>
                                <td>
                                    <?php if($r->code_order_cn!=null): ?>  
                                        <?php echo e($r->code_order_cn); ?>

                                    <?php else: ?>
                                        -    
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <tr>
                                <td class="">Vận đơn</td>
                                 <td>
                                 <?php if($r->code_order_cn!=null): ?>  
                                     <?php echo e($r->lading); ?>

                                 <?php else: ?>
                                     -    
                                 <?php endif; ?>
                                </td>
                            </tr>

                            <tr>
                                <?php
                                  $miss_pay = ($total_price + (($total_price/100)*($r->fee)) + ($r->transport_cn) + ($r->wood_package))*($r->exchange_rate) - ($r->deposit);
                                ?>
                                <td><b>Tổng đơn hàng</b></td>
                                <td>
                                    <b><?php echo e(formatCNY(($total_price + (($total_price/100)*($r->fee)) + ($r->transport_cn) + ($r->wood_package)))); ?></b>
                                    - <b><?php echo e(formatVND(($total_price + (($total_price/100)*($r->fee)) + ($r->transport_cn) + ($r->wood_package))*($r->exchange_rate))); ?></b>
                                </td>
                            </tr>

                            <?php if($r->is_final==0): ?>
                              <tr>
                                <td><b>Đã đặt cọc</b></td>
                                 <td><b class="text-green"><?php echo e(formatVND($r->deposit)); ?></b></td>
                              </tr>

                             <tr>
                               <td><b>Còn thiếu</b></td>
                               <td><b class="text-red"><?php echo e(formatVND($miss_pay)); ?></b></td>
                              </tr>
                            <?php else: ?>
                               <tr>
                                 <td colspan="2"><label class="label label-success" for="">Đã tất toán</label></td>
                               </tr>
                            <?php endif; ?>
                  
                            <tr>
                              <td>
                                <?php if($r->status == 20 || $r->status == 10): ?>
                                    <br>
                                    <label class="label label-danger" for="">Đã huỷ và hoàn tiền</label>
                                <?php endif; ?>

                                <?php if($r->status == 9): ?>
                                    <a href='<?php echo e(asset('users/complaints/add/'.$r->id)); ?>' class='btn btn-danger'><?php echo e(__('main.complaints')); ?></a>
                                <?php endif; ?>

                                <?php if($r->is_final != 1 && $r->status != 20 && $r->status==7): ?>
                                  <form action="<?php echo e(url('users/orders/payment')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input class="id-address-selected" type="hidden" value="<?php echo e($r->id); ?>" name="id" />
                                    <input class="id-address-selected" type="hidden" value="<?php echo e($miss_pay); ?>" name="pay" />
                                    
                                    <?php if($miss_pay - (Auth::user()->amount) > 0): ?>
                                      <a href="<?php echo e(URL::to('users/finance/deposit')); ?>" style="margin-top:10px" class="btn btn-sm btn-danger">Nạp tiền</a>
                                      <button style="margin-top: 10px;" type="button" disabled class='btn btn-sm btn-success'><?php echo e(__('main.pay')); ?></button>
                                    <?php else: ?>
                                      <button type="submit" class='btn btn-success'>Tất toán</button>
                                    <?php endif; ?>
                                  </form>
                                <?php endif; ?>

                              </td>
                            </tr>
                        </tbody>
                    </table>
                <?php endif; ?>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            <tr>
                <th colspan="5">
                    <div class="wrapper-comments">
                        <h4>Bình luận</h4>
                        <hr>
                        <div class="cm-element">
                            <?php
                                $id_order = $r->id;
                                $comments = CommentsOrders::join('users', 'users.id', '=', 'comments_orders.id_user')
                                ->select('*','comments_orders.created_at as created_at')
                                ->where('comments_orders.id_order', '=', $id_order)
                                ->paginate(30);
                            ?>
                            <?php if($comments != null): ?>
                                <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="">
                                        <p style="margin-bottom: 0;" class=""> <?php echo e($item->fullname); ?> - <?php echo e(formatvidate($r->created_at)); ?></p>
                                        <p style="margin-top: 0; padding-left: 15px; font-weight: 400" class="">
                                            <?php
                                              echo htmlspecialchars_decode($item->content)
                                            ?></p>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                        <br>
                        <div class="cm-form">
                            <textarea class="form-control input-comment" name="" id="" cols="30" rows="1"></textarea>
                            <a style="margin-top: 10px;" href="javascript:void(0);" class="btn btn-success btn-xs btn-comment" data-user="<?php echo e(Auth::user()->fullname); ?>" data-id="<?php echo e($r->id); ?>">Bình luận</a>
                            <br><br>
                        </div>
                    </div>
                </th>

                <th colspan="">
                 
                    
                    <br><br><br>

                    <div class="wrapper-picture">
                            <form role="form" action="upload_img" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id" value="<?php echo e($r->id); ?>">
                                <div class="row">
                                    <?php for($i=0; $i < 2; $i++): ?>
                                        <div class="form-group col-sm-6 col-xs-12">
                                            <label><?php echo e(__('main.avatar')); ?> <?php echo e($i+1); ?></label>
                                            <div style="height: 80px; width: 120px; border: 1px solid #ebebeb;">
                                                <?php if(isset($r->picture[$i])): ?>
                                                    <img src="<?php echo e(asset($r->picture[$i])); ?>" style="width:120px;height:80px;"/>
                                                <?php endif; ?>
                                                <br/>
                                            </div>
                                            <input type="file" name="picture[]" style="margin-top:10px">
                                        </div>
                                    <?php endfor; ?>
                                </div>
                                <button type="submit" class="btn btn-sm btn-success">Upload</button>
                            </form>
                    </div>
                    <br>
                </th>
            </tr>

        </tbody>
    </table>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    

</div>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/qcexpress/resources/views/users/orderdetail.blade.php ENDPATH**/ ?>