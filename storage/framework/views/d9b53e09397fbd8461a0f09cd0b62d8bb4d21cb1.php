<?php $__env->startSection('content'); ?>
    <div class="banner-blog">
        <img src="<?php echo e(asset('pictures/init/blog.jpg')); ?>" alt="">
    </div>
    <div class="blogone ptb-100 blog-page">
        <div class="container">
            <div class="">
                <br>
                <h2 style="text-align: center; text-transform: uppercase; font-weight: bold; font-size: 20px;"><?php echo e($post_cate[0]->name); ?></h2>
                <br>
                <p style="text-align: center">Đây là các bài viết mà chúng tôi muốn bạn đọc kĩ để hiểu hơn về các đặt hàng <br> nhằm đưa ra quyết định đúng và tránh những rủi ro.</p>
                <br>
                <br>
                <br>
            </div>
            <div class="row">
                <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <article class="blog-post-wrapper clearfix">
                        <div class="post-thumbnail">
                            <img src="<?php echo e(asset($l->thumb)); ?>" class="img-responsive " alt="Image">
                        </div>
                        <!-- /.post-thumbnail -->

                        <div class="blog-content">
                            <header class="entry-header">
                                <h4 class="entry-title"><a href="chi-tiet/<?php echo e($l->id); ?>"><?php echo e($l->title); ?></a></h4>
                                <div class="entry-meta">
                                    <ul>
                                        <li>
                                            <span class="posted-in"><?php echo e(__('main.keyword')); ?>: <a href="#"><?php echo e($l->keyword); ?></a></span></li>
                                            <br>
                                        <li>
                                            <br>
                                            <span class="posted-in"><?php echo e(__('main.description')); ?>: <a href="#"><?php echo e($l->description); ?></a></span>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.entry-meta -->
                            </header>
                            <!-- /.entry-header -->

                            <div class="entry-content">
                                <p><?php echo substr(strip_tags(htmlspecialchars_decode($l->contents)), 0, 150); ?></p>
                            </div>
                            <!-- /.entry-content -->
                        </div>
                        <!-- /.blog-content -->

                    </article>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <!-- /.row -->
            <?php echo e($list->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/qcexpress/resources/views/users/posts.blade.php ENDPATH**/ ?>