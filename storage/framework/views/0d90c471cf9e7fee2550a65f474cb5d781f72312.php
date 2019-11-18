<?php $__env->startSection('header',__('main.settings')); ?>
<?php $__env->startSection('small_header',__('main.general')); ?>
<?php $__env->startSection('content'); ?>

    <div id="main-wrapper">
        <!-- formOne section start -->
        <div class="formOne ptb-100">
            <div class="container">
                        <br>
                        <form action="general" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php if(session('notify')): ?>
                                <div class="alert alert-success">
                                    <?php echo e(session('notify')); ?>

                                </div>
                            <?php endif; ?>
                            <div class="row">
                                <div class="form-group">
                                    <label><?php echo e(__('main.logo')); ?></label>
                                    <div style="width: 120px; height: 120px; border: 1px solid #bebebe;">
                                        <img width="120px" height="120px" src="<?php echo e(asset($general->logo)); ?>" alt="logo">
                                    </div>
                                    <br>
                                    <input type="file" placeholder="Logo" name="logo">
                                    <br>
                                    <?php if($errors->has('logo')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e($errors->first('logo')); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label><?php echo e(__('main.site_name')); ?></label>
                                    <input type="text" class="form-control"  placeholder="Site Name" name="site_name" value="<?php echo e($general->site_name); ?>">
                                    <?php if($errors->has('site_name')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e($errors->first('site_name')); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label><?php echo e(__('main.author')); ?></label>
                                    <input type="text" class="form-control"  placeholder="Author" name="author" value="<?php echo e($general->author); ?>">
                                    <?php if($errors->has('author')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e($errors->first('author')); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label><?php echo e(__('main.keyword')); ?></label>
                                    <input type="text" class="form-control"  placeholder="Keyword" name="keyword" value="<?php echo e($general->keyword); ?>">
                                    <?php if($errors->has('keyword')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e($errors->first('keyword')); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label><?php echo e(__('main.about')); ?></label>
                                    <textarea class="form-control tyni-edit" rows="7" placeholder="Type here" name="about"><?php echo e($general->about); ?></textarea>
                                    <?php if($errors->has('about')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e($errors->first('about')); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label><?php echo e(__('main.description')); ?></label>
                                    <textarea class="form-control tyni-edit" rows="7" placeholder="Type here" name="description"><?php echo e($general->description); ?></textarea>
                                    <?php if($errors->has('description')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e($errors->first('description')); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label><?php echo e(__('main.currency_unit')); ?></label>
                                    <input type="text" class="form-control"  placeholder="Currency Unit" name="currency_unit" value="<?php echo e($general->currency_unit); ?>">
                                    <?php if($errors->has('currency_unit')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e($errors->first('currency_unit')); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label><?php echo e(__('main.exchange_rate_cn')); ?></label>
                                    <input type="text" class="form-control"  placeholder="Exchange Rate CN" name="exchange_rate_cn" value="<?php echo e($general->exchange_rate_cn); ?>">
                                    <?php if($errors->has('exchange_rate_cn')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e($errors->first('exchange_rate_cn')); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label><?php echo e(__('main.exchange_rate_us')); ?></label>
                                    <input type="text" class="form-control"  placeholder="Exchange Rate USD" name="exchange_rate_us" value="<?php echo e($general->exchange_rate_us); ?>">
                                    <?php if($errors->has('exchange_rate_us')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e($errors->first('exchange_rate_us')); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label><?php echo e(__('main.link_app_android')); ?></label>
                                    <input type="text" class="form-control"  placeholder="Link App Android" name="link_app_android" value="<?php echo e($general->link_app_android); ?>">
                                    <?php if($errors->has('link_app_android')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e($errors->first('link_app_android')); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label><?php echo e(__('main.link_app_ios')); ?></label>
                                    <input type="text" class="form-control"  placeholder="Link App IOS" name="link_app_ios" value="<?php echo e($general->link_app_ios); ?>">
                                    <?php if($errors->has('link_app_ios')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e($errors->first('link_app_ios')); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label><?php echo e(__('main.link_tool_chrome')); ?></label>
                                    <input type="text" class="form-control"  placeholder="Link Tool Chrome" name="link_tool_chrome" value="<?php echo e($general->link_tool_chrome); ?>">
                                    <?php if($errors->has('link_tool_chrome')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e($errors->first('link_tool_chrome')); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label><?php echo e(__('main.link_tool_coccoc')); ?></label>
                                    <input type="text" class="form-control"  placeholder="Link Tool CocCoc" name="link_tool_coccoc" value="<?php echo e($general->link_tool_coccoc); ?>">
                                    <?php if($errors->has('link_tool_coccoc')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e($errors->first('link_tool_coccoc')); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <!-- /.col-md-6 -->
                                <br>
                                <a class="btn btn-danger" href="<?php echo e(asset('admin/settings/default-general')); ?>"><?php echo e(__('main.set_to_default')); ?></a>
                                <button type="submit" class="btn btn-primary"><?php echo e(__('main.save')); ?></button>
                                <br>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/qcexpress/resources/views/admin/settings/general.blade.php ENDPATH**/ ?>