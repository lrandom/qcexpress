<?php $__env->startSection('header',__('main.posts')); ?>
<?php $__env->startSection('small_header',__('main.add')); ?>
<?php $__env->startSection('content'); ?>

<?php if(session('notify')): ?>
  <div class="alert alert-success">
    <?php echo e(session('notify')); ?>

  </div>
<?php endif; ?>

<div class="box box-primary">
        <!-- form start -->
        <form role="form" method="POST" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <div class="box-body">

            <div class="form-group">
              <label><?php echo e(__('main.thumb')); ?></label>
              <input type="file" name="thumb">
            </div>

            <br>

            <div class="form-group">
              <label><?php echo e(__('main.post_categories')); ?>*</label>
              <select class="form-control" name="id_categories">
                <option value="">Choose post categories</option>
                <?php $__currentLoopData = $post_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option  <?php if( old('id_categories') == $p->id): ?> selected="selected" <?php endif; ?> value="<?php echo e($p->id); ?>"><?php echo e($p->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <?php if($errors->has('id_categories')): ?>
                <div class="alert alert-danger">
                  <?php echo e($errors->first('id_categories')); ?>

                </div>
              <?php endif; ?>
            </div>

            <div class="form-group">
                <label><?php echo e(__('main.title')); ?>*</label>
                <input type="text" class="form-control" name="title" value="<?php echo e(old('title')); ?>">
              <?php if($errors->has('title')): ?>
                <div class="alert alert-danger">
                  <?php echo e($errors->first('title')); ?>

                </div>
              <?php endif; ?>
              </div>

              <div class="form-group">
                <label><?php echo e(__('main.contents')); ?>*</label>
                <textarea class="form-control tyni-edit" name="contents" ><?php echo e(old('contents')); ?></textarea>
                <?php if($errors->has('contents')): ?>
                  <div class="alert alert-danger">
                    <?php echo e($errors->first('contents')); ?>

                  </div>
                <?php endif; ?>
              </div>

              <div class="form-group">
                <label><?php echo e(__('main.description')); ?>*</label>
                <input type="text" class="form-control" name="description" value="<?php echo e(old('description')); ?>">
                <?php if($errors->has('description')): ?>
                  <div class="alert alert-danger">
                    <?php echo e($errors->first('description')); ?>

                  </div>
                <?php endif; ?>
              </div>

              <div class="form-group">
                <label><?php echo e(__('main.keyword')); ?>*</label>
                <input type="text" class="form-control" name="keyword" value="<?php echo e(old('keyword')); ?>">
                <?php if($errors->has('keyword')): ?>
                  <div class="alert alert-danger">
                    <?php echo e($errors->first('keyword')); ?>

                  </div>
                <?php endif; ?>
              </div>

          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary"><?php echo e(__('main.add')); ?></button>
          </div>
          </div>
        </form>
      </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/qcexpress/resources/views/admin/posts/add.blade.php ENDPATH**/ ?>