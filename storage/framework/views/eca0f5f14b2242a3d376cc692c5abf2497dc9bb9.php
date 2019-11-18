<?php $__env->startSection('header',__('main.settings')); ?>
<?php $__env->startSection('small_header',__('main.services')); ?>
<?php $__env->startSection('content'); ?>
    <div id="main-wrapper">
        <!-- formOne section start -->
        <div class="formOne ptb-100">
            <div class="container">
                        <br>
                        <form action="services" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php if(session('notify')): ?>
                                <div class="alert alert-success">
                                    <?php echo e(session('notify')); ?>

                                </div>
                            <?php endif; ?>
                            <div class="row">
                                <div class="form-group">
                                    <label><?php echo e(__('main.about')); ?></label>
                                    <textarea class="form-control tyni-edit" rows="7"  placeholder="Type here" name="about"><?php echo e($services->about); ?></textarea>
                                    <?php if($errors->has('about')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e($errors->first('about')); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <br>
                                <div class="form-group">
                                <label><?php echo e(__('main.how_to_buy')); ?></label>
                                    <textarea class="form-control tyni-edit" rows="7"  placeholder="Type here" name="how_to_buy"><?php echo e($services->how_to_buy); ?></textarea>
                                    <?php if($errors->has('how_to_buy')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e($errors->first('how_to_buy')); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label><?php echo e(__('main.regulations_&_policies')); ?></label>
                                    <textarea class="form-control tyni-edit" rows="7" placeholder="Type here" name="policy"><?php echo e($services->policy); ?></textarea>
                                    <?php if($errors->has('policy')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e($errors->first('policy')); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label><?php echo e(__('main.tariff')); ?></label>
                                    <input class="form-control" name="tariff" value="<?php echo e($services->tariff); ?>">
                                    <?php if($errors->has('tariff')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e($errors->first('tariff')); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <!-- /.col-md-6 -->
                                <br>
                                <a class="btn btn-danger" href="<?php echo e(asset('admin/settings/default-services')); ?>"><?php echo e(__('main.set_to_default')); ?></a>
                                <button type="submit" class="btn btn-primary"><?php echo e(__('main.save')); ?></button>
                                <br>
                                <br>
                            </div>
                            <!-- /.row-->
                        </form>

            </div>
            <!-- /.container -->
        </div>
        <!-- formOne section end -->

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/qcexpress/resources/views/admin/settings/services.blade.php ENDPATH**/ ?>