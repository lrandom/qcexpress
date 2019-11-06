<!DOCTYPE html>
<html lang="en" class=" js csstransforms csstransforms3d csstransitions">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>
            <?php echo $__env->yieldContent('title_page',__('main.orders')); ?>
        </title>

        <!-- Place favicon.ico in the root directory -->
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('images/favicon.png')); ?>">
    
        <!-- font-awesome -->
        <link href="<?php echo e(asset('public/bower_components/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('public/assets/css/fonts.css')); ?>" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="<?php echo e(asset('public/bower_components/bootstrap/dist/css/bootstrap.min.css')); ?> " rel="stylesheet">
        <!-- Animation Css -->
        
        <!-- Revolution slider Css -->
        
        <!-- Owl Carousel -->
        
        <!-- Magnific Popup Css -->
        
        <!-- Style Css -->
        <link href="<?php echo e(asset('public/css/app.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('public/assets/css/homepage_style_2.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('public/assets/css/blog.css')); ?>" rel="stylesheet">
        
        
        
    </head>
    
    <body>

        <?php
            use App\GeneralSettings;
            use App\ContactSettings;
            use App\PostCategories;
            use App\Posts;

            $recent_post = Posts::limit(5)->orderBy('id', 'DESC')->inRandomOrder()->get();
            $new_post = Posts::limit(2)->orderBy('id', 'DESC')->get();

            $general = GeneralSettings::first();
            $contact = ContactSettings::first();
            $cat = PostCategories::orderBy('id', 'DESC')->get();
        ?>
    
        <a href="javascript:" id="return-to-top" style="display: none;"><i class="fa fa-angle-up"></i></a>
    
        <!-- Preloader -->
        <div id="preloader" style="display: none;">
            <div id="status" style="display: none;">
                <div class="status-mes"></div>
            </div>
        </div>
    
        <!-- header start -->
        <div class="header">
            <div class="top-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                            <div class="contact_info_wrapper">
                                <ul>
                                    <li><?php echo e(__('main.exchange_rate')); ?> 1 NDT = <?php echo e(formatVND($general->exchange_rate_cn)); ?></li>
                                    <li><?php echo e(__('main.exchange_rate')); ?>1 USD = <?php echo e(formatVND($general->exchange_rate_us)); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                            <!-- signin_and_social_icon_wrapper -->
                            <div class="signin_and_social_icon_wrapper">
                                <ul>
                                    <li class="social_icon_wrapper hidden-xs">
                                        <ul>
                                            <li><a href="<?php echo e($contact->facebook); ?>"><i class="fa fa-facebook-square"></i></a></li>
                                            <li><a href="<?php echo e($contact->instagram); ?>"><i class="fa fa-instagram"></i></a></li>
                                        </ul>
                                    </li>
                                    <!-- Cart Option -->

                                    <?php if(auth()->guard()->guest()): ?>
                                        <li>
                                            <i class="fa fa-sign-in"></i>
                                            <a href="<?php echo e(asset('login')); ?>" class="dropdown-toggle">
                                                <?php echo e(__('main.login')); ?>

                                            </a>
                                            /
                                            <a href="<?php echo e(asset('register')); ?>" class="dropdown-toggle">
                                                <?php echo e(__('main.register')); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if(auth()->guard()->check()): ?>
                                        <li class="dropdown signin_wrapper">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-sign-in"></i> Xin chào <?php echo e(Auth::user()->email); ?>

                                            </a>
                                            <ul class="dropdown-menu">
                                                <li class="signin_dropdown">
                                                    <a href="<?php echo e(URL::to('users/account')); ?>">Tài khoản</a>
                                                    <a href="<?php echo e(asset('users/orders')); ?>">Đến phần quản lý đơn hàng</a>
                                                    <a href="<?php echo e(asset('users/password')); ?>"><?php echo e(__('main.password')); ?></a>
                                                    <a href="<?php echo e(asset('users/logout')); ?>">Thoát</a>
                                                </li>
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                    <!-- /.Cart Option -->
                                </ul>
                            </div>
                            <!-- /.signin_and_social_icon_wrapper end -->
                        </div>
                    </div>
                </div>
                <!-- /.container -->
            </div>
            <div class="main_menu_wrapper hidden-xs hidden-sm">
                <nav class="navbar mega-menu navbar-default">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="container">
                        <div class="navbar-header hidden-xs hidden-sm">
                            <a class="navbar-brand" href="<?php echo e(asset('/')); ?>">
                                <img width="250px" height="80px" src="<?php echo e(asset($general->logo)); ?>" alt="">
                            </a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->

                        <?php 
                            $cl_url = url()->full();
                        ?>

                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="<?php if($cl_url == asset('home') || $cl_url == asset('/')){ echo 'active'; }?>">
                                    <a href="<?php echo e(asset('home')); ?>"><?php echo e(__('main.home')); ?></a>
                                </li>
                                <li class="<?php if($cl_url == asset('gioi-thieu')){ echo 'active'; }?>">
                                    <a href="<?php echo e(asset('gioi-thieu')); ?>"><?php echo e(__('main.about')); ?></a>
                                </li>
                                <li class="<?php if($cl_url == asset('huong-dan')){ echo 'active'; }?>">
                                    <a href="<?php echo e(asset('huong-dan')); ?>"><?php echo e(__('main.document_order')); ?></a>
                                </li>
                                <?php $__currentLoopData = $cat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="<?php if(\Request::segment(2) == $item->name){ echo 'active'; }?>">
                                        <a href="<?php echo e(asset('bai-viet/'.$item->name.'?id='.$item->id)); ?>"><?php echo e($item->name); ?></a>
                                    </li>    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <li class="<?php if($cl_url == asset('chinh-sach')){ echo 'active'; }?>">
                                    <a href="<?php echo e(asset('chinh-sach')); ?>"><?php echo e(__('main.policy')); ?></a>
                                </li>
                                <!-- /.Cart Option -->
                            </ul>
    
                        </div>
                        <!-- /.navbar-collapse -->
                    </div>
                    <div class="bottom-menu">
                        <div class="container sdt-support">
                            <div class="elm-phone">
                                <i class="fa fa-phone"></i> Hỗ trợ đặt hàng: <?php echo e($contact->main_phone); ?>

                            </div>

                            <?php if($contact->phone != null): ?>
                                <?php $__currentLoopData = $contact->phone; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($item['name'] != null): ?>
                                        <div class="elm-phone text-center">
                                            <i class="fa fa-phone"></i> <?php echo e($item['name']); ?>: <?php echo e($item['value']); ?>

                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                            <div class="elm-phone text-right">
                                <i class="fa fa-phone"></i> Hot line: <?php echo e($contact->hotline); ?>

                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- .site-nav -->
            <div class="mobail_menu_main visible-xs visible-sm">
                <div class="navbar-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                <a class="navbar-brand" href="index.html">
                                    <img src="<?php echo e(asset($general->logo)); ?>" alt="">
                                </a>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                <button type="button" class="navbar-toggle collapsed" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="sidebar">
                    <a class="sidebar_logo" href="index.html"><img src="images/logo.png" alt=""></a>
                    <div id="toggle_close">×</div>
                    <br><br>
                    <div id="cssmenu">
                        <ul>
                            <li class="has-sub active">
                                <a href="<?php echo e(asset('/')); ?>"><?php echo e(__('main.home')); ?></a>
                            </li>
                            <li class="has-sub">
                                <a href="<?php echo e(asset('gioi-thieu')); ?>"><?php echo e(__('main.about')); ?></a>
                            </li>
                            <li class="has-sub">
                                <a href="<?php echo e(asset('huong-dan')); ?>"><?php echo e(__('main.document_order')); ?></a>
                            </li>
                            <?php $__currentLoopData = $cat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="has-sub">
                                    <a href="<?php echo e(asset('bai-viet/'.$item->name.'?id='.$item->id)); ?>"><?php echo e($item->name); ?></a>
                                </li>    
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <li class="has-sub">
                                <a href="<?php echo e(asset('chinh-sach')); ?>"><?php echo e(__('main.policy')); ?></a>
                            </li>
                            <li class="has-sub">
                                <a href="#"><i class="fa fa-phone"></i> Hỗ trợ đặt hàng: <?php echo e($contact->main_phone); ?></a>
                            </li>
                            <?php if($contact->phone != null): ?>
                                <?php $__currentLoopData = $contact->phone; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($item['name'] != null): ?>
                                        <li class="has-sub"><a href="#"><i class="fa fa-phone"></i> <?php echo e($item['name']); ?>: <?php echo e($item['value']); ?></a></li>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <li class="has-sub">
                                <a href="#"><i class="fa fa-phone"></i> Hot line: <?php echo e($contact->hotline); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- header end -->


        <?php $__env->startSection('article'); ?>

        <?php echo $__env->yieldSection(); ?>
        <hr>


        
        
        


        <?php $__env->startSection('content'); ?>

        <?php echo $__env->yieldSection(); ?>
        




         <!-- footer start -->
    <div class="footer">
            <div class="footer_wrapper_second">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-md-4 col-xs-12">
                            <div class="wrapper_second_about">
                                <h4><?php echo e(__('main.about_us')); ?></h4>
                                <div class="abotus_content">
                                    <p><?php echo $general->about; ?></p>
                                </div>
                                
                                <ul class="aboutus_social_icons">
                                    <li><a href="<?php echo e($contact->facebook); ?>"><i class="fa fa-facebook"></i></a></li>
                                    <li> <a href="<?php echo e($contact->instagram); ?>"><i class="fa fa-instagram" aria-hidden="true"></i> </a> </li>
                                </ul>
                            </div>
                        </div>

                      
                        <div class="col-md-4 col-xs-12">
                            <div class="wrapper_second_useful">
                                <h4><?php echo e(__('main.useful_link')); ?></h4>
                                <ul>
                                    <?php $__currentLoopData = $recent_post; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e(asset('bai-viet/chi-tiet/'.$item->id)); ?>"><i class="fa fa-caret-right" aria-hidden="true"></i><?php echo e($item->title); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>

                        

                        <div class="col-md-4 col-xs-12">
                            <div class="wrapper_second_contact">
                                <h4><?php echo e(__('main.contact_us')); ?></h4>
                                <ul>
                                    <li><i class="fa fa-map-marker"></i>
                                        <p><?php echo e($contact->address); ?></p>
                                    </li>
                                    <li><i class="fa fa-phone"></i>
                                        <a href="tel:<?php echo e($contact->main_phone); ?>"><?php echo e($contact->main_phone); ?></a>
                                    </li>
                                    <li><i class="fa fa-envelope"></i><a href="mailto:<?php echo e($contact->main_email); ?>"><?php echo e($contact->main_email); ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer end -->
    
        <!-- copyright_wrapper start -->
        <div class="copyright_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <div class="copyright_content">
                            <p>© Copyright 2018-19 by <a href=""> Quang Chau Express </a> - all right reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
    
        <!-- Bootstrap js -->
        <script src="<?php echo e(asset('public/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
        <!-- Revolution Slider js -->
        
        

        <!-- Portfolio Filter js -->
        
        
        
    </body></html><?php /**PATH /Library/WebServer/Documents/azorder/resources/views/layouts/app.blade.php ENDPATH**/ ?>