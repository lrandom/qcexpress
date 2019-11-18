<?php $__env->startSection('content'); ?>
<?php $__env->startSection('header',__('main.finance')); ?>
<?php $__env->startSection('small_header',__('main.statement')); ?>

<?php echo $__env->make('shared.filter_user_stm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

     <div class="box box-danger">
   
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 10px">STT</th>
                  <th><?php echo e(__('main.transaction_code')); ?></th>
                  <th><?php echo e(__('main.content')); ?></th>
                  <th><?php echo e(__('main.method')); ?></th>
                  <th><?php echo e(__('main.amount')); ?></th>
                  <th><?php echo e(__('main.transaction_time')); ?></th>
                  <th><?php echo e(__('main.status')); ?></th>
                </tr>
                <?php $index=0; ?>
                <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $index++; ?>
                <tr>
                        <td><?php echo e($index); ?></td>
                        <td>
                            <a href="" target="_blank">GD<?php echo e($r->stid); ?></a>
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
                     Tiền Trong Tài Khoản QC Express
                  <?php endif; ?>
                          
                        </td>
                        <td>
                            <?php if($r->is_sub==1): ?>
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
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody></table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
               <?php echo e($list->links()); ?>

            </div>
          </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/qcexpress/resources/views/users/statements.blade.php ENDPATH**/ ?>