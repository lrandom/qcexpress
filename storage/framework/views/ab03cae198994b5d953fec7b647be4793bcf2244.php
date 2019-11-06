<?php $__env->startSection('header',__('main.users')); ?>
<?php $__env->startSection('small_header',__('main.list')); ?>
<?php $__env->startSection('content'); ?>
<div class="box">
    <div class="box-header with-border">
        <a class="btn btn-primary" href="<?php echo e(action('Admin\UsersControllers@add')); ?>"><?php echo e(__('main.add')); ?></a>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered">
        <tbody><tr>
          <th style="width: 10px">#</th>
          <th><?php echo e(__('main.picture')); ?></th>
          <th><?php echo e(__('main.name')); ?></th>
          <th><?php echo e(__('main.email')); ?></th>
          <th><?php echo e(__('main.address')); ?></th>
          <th><?php echo e(__('main.tel')); ?></th>
          <th class="text-right" style="width: 140px;"><?php echo e(__('main.amount')); ?></th>
          <th class="text-right" style="width: 80px;"><?php echo e(__('main.buy_fee')); ?> %</th>
          <th class="text-right" style="width: 80px;"><?php echo e(__('main.per_deposit')); ?> %</th>
          <th><?php echo e(__('main.level')); ?></th>
          <th><?php echo e(__('main.active')); ?></th>
          <th style="width: 200px !important"><?php echo e(__('main.operation')); ?></th>
        </tr>

        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>

          <td><?php echo e($r->id); ?></td>
          <td><img src="<?php echo e(asset($r->avatar)); ?>" style="width:80px;height:50px;"/></td>
          <td><?php echo e($r->fullname); ?></td>
          <td><?php echo e($r->email); ?></td>
          <td><?php echo e($r->address); ?></td>
          <td><?php echo e($r->phone); ?></td>
          <td class="text-right"><?php echo e(formatVND($r->amount)); ?></td>
          <td class="text-right"><?php echo e($r->buy_fee); ?>%</td>
          <td class="text-right"><?php echo e($r->per_deposit); ?>%</td>
          <td>
            <?php if($r->per == 1): ?>
              <span class="label label-danger"><?php echo e(__('main.admin')); ?></span>
            <?php else: ?>
              <span class="label label-success"><?php echo e(__('main.user')); ?></span>
            <?php endif; ?>
          </td>
          <td>
            <?php if($r->is_active == 0): ?>
            <span class="label label-danger"><?php echo e(__('main.deactive')); ?></span>
            <?php else: ?>
              <span class="label label-success"><?php echo e(__('main.active')); ?></span>
            <?php endif; ?>
          </td>
          <td>
            <div class="btn-group">
                  <a class="btn btn-primary btn-flat" href="#"><?php echo e(__('main.action')); ?></a>
              <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <?php if($r->is_active==0): ?>
                  <li><a href="<?php echo e(URL::to('admin/users/active/'.$r->id)); ?>"><?php echo e(__('main.active')); ?></a></li>
                <?php endif; ?>
                <?php if($r->is_active==1): ?>
                  <li><a href="<?php echo e(URL::to('admin/users/deactive/'.$r->id)); ?>"><?php echo e(__('main.deactive')); ?></a></li>
                <?php endif; ?>
                <li> <a  href="<?php echo e(URL::to('admin/users/edit/'.$r->id)); ?>"><?php echo e(__('main.edit')); ?></a></li>
                <li> <a  href="<?php echo e(URL::to('admin/users/delete/'.$r->id)); ?>"><?php echo e(__('main.delete')); ?></a></li>
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/azorder/resources/views/admin/users/index.blade.php ENDPATH**/ ?>