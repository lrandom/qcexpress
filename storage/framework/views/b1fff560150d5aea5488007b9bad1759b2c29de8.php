<?php $__env->startSection('header',__('main.complaints')); ?>
<?php $__env->startSection('small_header',__('main.list')); ?>

<?php $__env->startSection('content'); ?>
  <div class="col-md-12">

    <div class="box box-info">
   
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th style="width: 10px">#</th>
                    <th><?php echo e(__('main.picture')); ?></th>
                    <th><?php echo e(__('main.order')); ?></th>
                    <th><?php echo e(__('main.reason')); ?></th>
                    <th><?php echo e(__('main.description')); ?></th>
                    <th><?php echo e(__('main.note')); ?></th>
                    <th><?php echo e(__('main.amount')); ?></th>
                    <th><?php echo e(__('main.status')); ?></th>
                    <th style="width: 200px"><?php echo e(__('main.operation')); ?></th>
                </tr>
        
                <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($r->id); ?></td>
                        <td>
                            <?php
                                $pt_link = null;
                                foreach ($r->photo as $key) {
                                    if($key != null && $pt_link == null){
                                        $pt_link = asset($key);
                                        break;
                                    }
                                }
                            ?>
                            <img src="<?php echo e($pt_link); ?>" style="width:120px;height:80px;"/>
                        </td>
                        <td>
                            <a class="" href="<?php echo e(URL::to('users/orders/detail/'.$r->id_order)); ?>">DH<?php echo e($r->id_order); ?></a>
                        </td>
                        <td><?php echo e($r->reason); ?></td>
                        <td><?php echo e($r->description); ?></td>
                        <td><?php echo e($r->note); ?></td>
                        <td><?php echo e($r->amount); ?></td>
                        <td>
                            <?php if($r->status == 1 || $r->status == 0): ?>
                                <span class="btn btn-warning btn-flat"><?php echo e(__('main.pending')); ?></span>
                            <?php endif; ?>
                            <?php if($r->status == 2): ?>
                                <span class="btn btn-success btn-flat"><?php echo e(__('main.success')); ?></span>
                            <?php endif; ?>
                            <?php if($r->status == 3): ?>
                                <span class="btn btn-danger btn-flat"><?php echo e(__('main.faild')); ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-primary" href="<?php echo e(URL::to('users/complaints/detail/'.$r->id)); ?>"><?php echo e(__('main.detail')); ?></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="text-left"> <?php echo e($list->links()); ?></div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/qcexpress/resources/views/users/complaints.blade.php ENDPATH**/ ?>