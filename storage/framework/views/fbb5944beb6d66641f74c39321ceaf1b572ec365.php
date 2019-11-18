<?php $__env->startSection('header',__('main.transaction')); ?>
<?php $__env->startSection('small_header',__('main.list')); ?>

<?php $__env->startSection('content'); ?>
    <style>
      .sub{
          color:red
      }

      .add{
          color:green;
      }
    </style>
<?php if(session('status')): ?>
<div class="alert alert-success">
    <?php echo e(session('status')); ?>

</div>
<?php endif; ?>
<?php echo $__env->make('shared.filter_stm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="width: 10px">STT</th>
                        <th style="width: 150px;"><?php echo e(__('main.transaction_code')); ?></th>
                        <th><?php echo e(__('main.picture')); ?></th>
                        <th>Khách hàng</th>
                        <th style="width: 250px;"><?php echo e(__('main.content')); ?></th>
                        <th><?php echo e(__('main.method')); ?></th>
                        <th><?php echo e(__('main.amount')); ?></th>
                        <th><?php echo e(__('main.transaction_time')); ?></th>
                        <th><?php echo e(__('main.status')); ?></th>
                        <th><?php echo e(__('main.action')); ?></th>
                    </tr>
                    <?php $index=0; ?>
                    <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $index++; ?>
                        <tr>
                            <td><?php echo e($index); ?></td>
                            <td>
                                <a href="" target="_blank">GD<?php echo e($r->id); ?></a>
                            </td>
                            <td>
                                <img class="photo-zoom" data-toggle="modal" data-target="#addAddressModal" style="height: 80px; width: 120px; cursor: pointer;" data-code="GD<?php echo e($r->id); ?>" src="<?php echo e(asset($r->photo)); ?>" alt="">
                            </td>
                            <td>
                                <a href="<?php echo e(url('/admin/users/edit/'.$r->id_user)); ?>" target="_blank"><?php echo e($r->id_user); ?></a>
                            </td>
                            <td>
                                <?php
                                    echo htmlspecialchars_decode($r->content)
                                ?> 
                            </td>
                            <td>
                                    <?php if($r->method==1): ?>
                                    <?php echo e(__('main.cash')); ?>

                                <?php endif; ?>
                                <?php if($r->method==2): ?>
                                <?php echo e($r->name); ?>

                            <?php endif; ?>
                            <?php if($r->method==3): ?>
                           Tiền Trong Tài Khoản QCExpress
                        <?php endif; ?>
                        </td>
                        <td>
                            <?php if($r->is_sub==0): ?>
                                <span class="sub">- <?php echo e(formatVND($r->amount)); ?></span>
                            <?php else: ?>
                                <span class="add">+ <?php echo e(formatVND($r->amount)); ?></span>
                            <?php endif; ?>
      
                            <?php if($r->type==0): ?>
                                <span class="label label-success">Nạp tiền</span>
                            <?php endif; ?>
        
                            <?php if($r->type==1): ?>
                                <span class="label label-success">Tất toán</span>
                            <?php endif; ?>
        
                            <?php if($r->type==2): ?>
                                <span class="label label-success">Đặt cọc</span>
                            <?php endif; ?>
        
                            <?php if($r->type==3): ?>
                                <span class="label label-success">Thanh toán</span>
                            <?php endif; ?>
      
      
                        <?php if($r->type==4): ?>
                            <span class="label label-success">Hoàn tiền</span>
                        <?php endif; ?>
                            </td>
                            <td><?php echo e(formatvidate($r->time)); ?></td>
                            <td>
                                <?php switch($r->status):
                                    case (0): ?>
                                    <span class="label bg-yellow"><?php echo e(__('main.pending')); ?></span>
                                        <?php break; ?>
                                    <?php case (1): ?>
                                    <span class="label bg-green"><?php echo e(__('main.complete')); ?></span>
                                        <?php break; ?>
                                    <?php default: ?>
                                <?php endswitch; ?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <?php echo e(__('main.action')); ?>

                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a class="btn-confirm" href="<?php echo e(URL::to('admin/statements/pending/'.$r->id)); ?>"><?php echo e(__('main.pending')); ?></a></li>
                                        <li><a class="btn-confirm" href="<?php echo e(URL::to('admin/statements/compelte/'.$r->id)); ?>"><?php echo e(__('main.compelte')); ?></a></li>
                                        <li><a class="btn-confirm" href="<?php echo e(URL::to('admin/statements/delete/'.$r->id)); ?>">Xoá</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <?php echo e($list->links()); ?>

        </div>
    </div>








    <div class="modal fade" id="addAddressModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title code-statement"></h4>
                  </div>
                  <div class="modal-body view-image-modal">
                    
          
                  </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->







    <script type="text/javascript">
        function show_confirm(obj){
            var r=confirm("Bạn chắc chắn muốn thực hiện tác vụ?");
            if (r==true)  
            window.location = obj.attr('href');
        }    
        $('.btn-confirm').click(function(event) {
            event.preventDefault();
            show_confirm($(this));

        });


        $('.photo-zoom').click(function(){
                    var code = $(this).data('code');
                    var link = $(this).attr('src');

                    $('.code-statement').html('chi tiết hoá đơn '+code);
                    $('.view-image-modal').html('<img style="width: 100%" src="'+link+'" alt="">')
                });
    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/qcexpress/resources/views/admin/statements/index.blade.php ENDPATH**/ ?>