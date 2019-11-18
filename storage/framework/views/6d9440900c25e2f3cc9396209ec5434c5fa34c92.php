<?php $__env->startSection('header',__('main.complaints')); ?>
<?php $__env->startSection('small_header',__('main.list')); ?>
<?php $__env->startSection('content'); ?>
<div class="box">

    <div class="box-body">
      <table class="table table-bordered">
        <tbody><tr>
          <th style="width: 10px">#</th>
          <th><?php echo e(__('main.picture')); ?></th>
          <th><?php echo e(__('main.user')); ?></th>
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
                <td><a class="" href="<?php echo e(URL::to('admin/complaints/detail/'.$r->id)); ?>"><?php echo e($r->id); ?></a></td>
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
                    <img src="<?php echo e(asset($pt_link)); ?>" style="width:120px;height:80px;"/>
                </td>
                <td><?php echo e($r->fullname); ?></td>
                <td>
                    <a class="" href="<?php echo e(URL::to('admin/orders/detail/'.$r->id_order)); ?>" target="_blank">QC<?php echo e($r->id_order); ?></a>
                </td>
                <td><?php echo e($r->reason); ?></td>
                <td><?php echo e($r->description); ?></td>
                <td><?php echo e($r->note); ?></td>
                <td><?php echo e($r->amount); ?></td>
                <td>
                    <?php if($r->status == 0): ?>
                        <span class="label label-primary"><?php echo e(__('main.not_seen')); ?></span>
                    <?php endif; ?>
                    <?php if($r->status == 1): ?>
                        <span class="label label-warning label-flat"><?php echo e(__('main.pending')); ?></span>
                    <?php endif; ?>
                    <?php if($r->status == 2): ?>
                        <span class="lábel label-success label-flat"><?php echo e(__('main.success')); ?></span>
                    <?php endif; ?>
                    <?php if($r->status == 3): ?>
                        <span class="label label-danger label-flat"><?php echo e(__('main.faild')); ?></span>
                    <?php endif; ?>
                </td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <?php echo e(__('main.action')); ?>

                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a  href="<?php echo e(URL::to('admin/complaints/not_seen/'.$r->id)); ?>"><?php echo e(__('main.not_seen')); ?></a></li>
                            <li><a  href="<?php echo e(URL::to('admin/complaints/pending/'.$r->id)); ?>"><?php echo e(__('main.pending')); ?></a></li>
                            <li><a  href="<?php echo e(URL::to('admin/complaints/success/'.$r->id)); ?>"><?php echo e(__('main.success')); ?></a></li>
                            <li><a  href="<?php echo e(URL::to('admin/complaints/faild/'.$r->id)); ?>"><?php echo e(__('main.faild')); ?></a></li>
                            <li><a  href="<?php echo e(URL::to('admin/complaints/detail/'.$r->id)); ?>"><?php echo e(__('main.detail')); ?></a></li>
                            
                        </ul>
                    </div>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
    </div>
    <!-- /.box-body -->
    
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
      <div class="p-3 pagi-block">
          <div class="text-left"> <?php echo e($list->links()); ?></div>
      </div>
  </div>    
  </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/qcexpress/resources/views/admin/complaints/index.blade.php ENDPATH**/ ?>