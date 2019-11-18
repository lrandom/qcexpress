<?php $__env->startSection('header',__('main.posts_categories')); ?>
<?php $__env->startSection('small_header',__('main.edit')); ?>
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
          <input type="hidden" value="<?php echo e($obj->id); ?>">

          <div class="box-body">

            <div class="form-group">
              <label><?php echo e(__('main.picture')); ?></label>
              <div>
                <img style="width: 120px; height: 80px;" src="<?php echo e(asset($obj->thumb)); ?>" alt="">
              </div>
              <br>
              <input type="file" name="thumb">
            </div>
  
            <br>

            <div class="form-group">
              <label><?php echo e(__('main.post_categories')); ?>*</label>
              <select class="form-control" name="id_categories">
                <?php $__currentLoopData = $post_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option
                    <?php if($obj->id_categories == $p->id): ?>
                    <?php echo e('selected'); ?>

                    <?php elseif(old('id_categories') == $p->id): ?>
                    selected="selected"
                    <?php endif; ?>
                    value="<?php echo e($p->id); ?>"><?php echo e($p->name); ?>

                  </option>
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
              <input type="text" class="form-control" name="title" value="<?php echo e($obj->title); ?>">
              <?php if($errors->has('title')): ?>
                <div class="alert alert-danger">
                  <?php echo e($errors->first('title')); ?>

                </div>
              <?php endif; ?>
            </div>

            <div class="form-group">
              <label><?php echo e(__('main.contents')); ?>*</label>
              <textarea class="form-control tyni-edit" name="contents" ><?php echo e(htmlspecialchars_decode($obj->contents)); ?></textarea>
              <?php if($errors->has('contents')): ?>
                <div class="alert alert-danger">
                  <?php echo e($errors->first('contents')); ?>

                </div>
              <?php endif; ?>
            </div>

            <div class="form-group">
              <label><?php echo e(__('main.description')); ?>*</label>
              <input type="text" class="form-control" name="description" value="<?php echo e($obj->description); ?>">
              <?php if($errors->has('description')): ?>
                <div class="alert alert-danger">
                  <?php echo e($errors->first('description')); ?>

                </div>
              <?php endif; ?>
            </div>

            <div class="form-group">
              <label><?php echo e(__('main.keyword')); ?>*</label>
              <input type="text" class="form-control" name="keyword" value="<?php echo e($obj->keyword); ?>">
              <?php if($errors->has('keyword')): ?>
                <div class="alert alert-danger">
                  <?php echo e($errors->first('keyword')); ?>

                </div>
              <?php endif; ?>
            </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary"><?php echo e(__('main.save_change')); ?></button>
          </div>
          </div>
        </form>
      </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/qcexpress/resources/views/admin/posts/edit.blade.php ENDPATH**/ ?>