<?php $__env->startSection('header',__('main.posts')); ?>
<?php $__env->startSection('small_header',__('main.list')); ?>
<?php $__env->startSection('content'); ?>
<div class="box">
    <div class="box-header with-border">
        <a class="btn btn-primary" href="<?php echo e(action('Admin\PostsControllers@add')); ?>"><?php echo e(__('main.add')); ?></a>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered">
        <tbody><tr>
          <th style="width: 10px">#</th>
          <th><?php echo e(__('main.picture')); ?></th>
          <th><?php echo e(__('main.title')); ?></th>
          <th><?php echo e(__('main.post_categories')); ?></th>
          <th><?php echo e(__('main.content')); ?></th>
          <th><?php echo e(__('main.description')); ?></th>
          <th><?php echo e(__('main.keyword')); ?></th>
          <th><?php echo e(__('main.status')); ?></th>
          <th style="width: 200px"><?php echo e(__('main.operation')); ?></th>
        </tr>

        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
                <td><?php echo e($r->id); ?></td>
                <td>
                  <img style="height: 80px; width: 120px;" src="<?php echo e(asset($r->thumb)); ?>" alt="">
                </td>
                <td><?php echo e($r->title); ?></td>
                <td>
                    

                    <?php $__currentLoopData = $post_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($r->id_categories == $p->id): ?>
                            <?php echo e($p->name); ?>

                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
                <td><?php echo \Illuminate\Support\Str::limit(htmlspecialchars_decode($r->contents),80); ?></td>
                <td><?php echo e($r->description); ?></td>
                <td><?php echo e($r->keyword); ?></td>
                <td>
                  <?php if($r->is_active == 0): ?>
                    <span class="btn btn-warning"><?php echo e(__('main.deactive')); ?></span>
                  <?php endif; ?>
                  <?php if($r->is_active == 1): ?>
                    <span class="btn btn-success"><?php echo e(__('main.active')); ?></span>
                  <?php endif; ?>
                </td>
                <td>
                  <div class="btn-group">
                    <a href="#" class="btn btn-primary btn-flat"><?php echo e(__('main.action')); ?></a>
                    <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <?php if($r->is_active==0): ?>
                        <li><a href="<?php echo e(URL::to('admin/posts/active/'.$r->id)); ?>"><?php echo e(__('main.active')); ?></a></li>
                      <?php endif; ?>
                      <?php if($r->is_active==1): ?>
                        <li><a href="<?php echo e(URL::to('admin/posts/deactive/'.$r->id)); ?>"><?php echo e(__('main.deactive')); ?></a></li>
                      <?php endif; ?>
                     <li> <a  href="<?php echo e(URL::to('admin/posts/edit/'.$r->id)); ?>"><?php echo e(__('main.edit')); ?></a></li>
                     <li> <a  href="<?php echo e(URL::to('admin/posts/delete/'.$r->id)); ?>"><?php echo e(__('main.delete')); ?></a></li>
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/qcexpress/resources/views/admin/posts/index.blade.php ENDPATH**/ ?>