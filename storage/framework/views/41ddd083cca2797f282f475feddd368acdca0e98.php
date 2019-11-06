<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title>
    <?php echo $__env->yieldContent('title_page',__('main.orders')); ?>
  </title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo e(asset('public/bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(asset('public/bower_components/font-awesome/css/font-awesome.min.css')); ?>">
  <!-- Theme style -->

  <link href="<?php echo e(asset('public/css/styles.css')); ?>" rel="stylesheet">
  
  <link rel="stylesheet" href="<?php echo e(asset('public/adminlte/css/AdminLTE.min.css')); ?>">

  <link rel="stylesheet" href="<?php echo e(asset('public/adminlte/css/skins/skin-purple.min.css')); ?>">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="<?php echo e(asset('public/bower_components/datetimepicker/build/jquery.datetimepicker.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('public/css/user.css')); ?>"/>

  <script src="<?php echo e(asset('public/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/adminlte/js/adminlte.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/bower_components/datetimepicker/build/jquery.datetimepicker.full.min.js')); ?>"></script>
<style>
body{
  font-family: 'Open Sans', sans-serif;
}
.dropdown-menu li.user-footer a {
    display: block;
    padding: 5px 10px;
    font-size: 13px;
  }
</style>

<script>
    var BASE_URL = "<?php echo e(url('/')); ?>/";
    var BASE_API = "<?php echo e(url('/')); ?>/api/";
 </script>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo e(asset('/')); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>QC</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>QCexpress</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a href="<?php echo e(URL::to('users/finance/deposit')); ?>">
              <?php echo e(__('main.balance')); ?>:
              &nbsp;<strong><?php echo e(formatVND(Auth::user()->amount)); ?></strong>
            </a>
          </li>
          <!-- Notifications Menu -->
          

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?php echo e(asset(Auth::user()->avatar)); ?>" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <?php if(auth()->guard()->check()): ?>
              <span class="hidden-xs"><?php echo e(Auth::user()->email); ?></span>
              <?php endif; ?>
            
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?php echo e(asset(Auth::user()->avatar)); ?>" class="img-circle" alt="User Image">
                <p>
                    <?php echo e(Auth::user()->email); ?>

                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer" style="display:flex;justify-content:space-between">
                <div>
                  <a href="<?php echo e(URL::to('users/account')); ?>" class="btn btn-default btn-flat"><?php echo e(__('main.account')); ?></a>
                </div>
                <div>
                  <a href="<?php echo e(URL::to('users/password')); ?>" class="btn btn-default btn-flat"><?php echo e(__('main.password')); ?></a>
                </div>
                <div>
                  <a href="<?php echo e(asset('users/logout')); ?>" class="btn btn-default btn-flat"><?php echo e(__('main.logout')); ?></a>
                </div>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel" style="padding-bottom:20px">
        <div class="pull-left image">
          <img src="<?php echo e(asset(Auth::user()->avatar)); ?>" style="height:45px;width:45px" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> <?php echo e(Auth::user()->fullname); ?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div> 

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- Optionally, you can add icons to the links -->
        <li <?php if(strpos(url()->current(),'users/cart')!=false){echo 'class="active"';} ?>><a  href="<?php echo e(URL::to('users/cart')); ?>"><i class="fa fa-shopping-cart"></i> <span><?php echo e(__('main.cart')); ?></span></a></li>
        <li <?php if(strpos(url()->current(),'users/account')!=false){echo 'class="active"';} ?>><a href="<?php echo e(URL::to('users/account')); ?>"><i class="fa fa-id-badge"></i> <span><?php echo e(__('main.account')); ?></span></a></li>

        <li class="treeview <?php if(strpos(url()->current(),'users/orders/')!=false){echo 'active';} ?>">

          <a href="#"><i class="fa fa-archive"></i> <span><?php echo e(__('main.orders')); ?></span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <?php
            $all = DB::table('orders')->count();
            $pending = DB::table('orders')->where('status',0)->where('id_user',Auth::user()->id)->count();
            $checked = DB::table('orders')->where('status',1)->where('id_user',Auth::user()->id)->count();
            $process = DB::table('orders')->where('status',2)->where('id_user',Auth::user()->id)->count();
            $buyed = DB::table('orders')->where('status',3)->where('id_user',Auth::user()->id)->count();
            $cn = DB::table('orders')->where('status',5)->where('id_user',Auth::user()->id)->count();
            $vn = DB::table('orders')->where('status',6)->where('id_user',Auth::user()->id)->count();
            $check_goods = DB::table('orders')->where('status',7)->where('id_user',Auth::user()->id)->count();
            $delivered = DB::table('orders')->where('status',8)->where('id_user',Auth::user()->id)->count();
            $received = DB::table('orders')->where('status',9)->where('id_user',Auth::user()->id)->count();
            $sold_out = DB::table('orders')->where('status',10)->where('id_user',Auth::user()->id)->count();
            $paid = DB::table('orders')->where('deposit','>',0)->where('id_user',Auth::user()->id)->count();
            $unpaid = DB::table('orders')->where('deposit','<=',0)->where('id_user',Auth::user()->id)->count();
            $final = DB::table('orders')->where('is_final',1)->where('id_user',Auth::user()->id)->count();
            $cancel=DB::table('orders')->where('status',20)->where('id_user',Auth::user()->id)->count();
         
          ?> 
          
          <ul class="treeview-menu">
              <li <?php if(url()->current()==url('users/orders/-1')){echo 'class="active"';} ?>>
                  <a href="<?php echo e(URL::to('users/orders/-1')); ?>">Tất cả&nbsp;(<?php echo e($all); ?>)</a>
                </li>
              <li <?php if(url()->current()==url('users/orders/0')){echo 'class="active"';} ?>>
                  <a href="<?php echo e(URL::to('users/orders/0')); ?>"><?php echo e(__('main.pending')); ?>&nbsp;(<?php echo e($pending); ?>)</a>
                </li>
                <li <?php if(url()->current()==url('users/orders/11')){echo 'class="active"';} ?>>
                    <a href="<?php echo e(URL::to('users/orders/11')); ?>"><?php echo e(__('main.paid')); ?>&nbsp;(<?php echo e($paid); ?>)</a>
                  </li>
      
                  <li <?php if(url()->current()==url('users/orders/12')){echo 'class="active"';} ?>>
                    <a href="<?php echo e(URL::to('users/orders/12')); ?>"><?php echo e(__('main.unpaid')); ?>&nbsp;(<?php echo e($unpaid); ?>)</a>
                  </li>
                <li <?php if(url()->current()==url('users/orders/1')){echo 'class="active"';} ?>>
                  <a href="<?php echo e(URL::to('users/orders/1')); ?>"><?php echo e(__('main.checked')); ?>&nbsp;(<?php echo e($checked); ?>)</a>
                </li>
    
                <li <?php if(url()->current()==url('users/orders/2')){echo 'class="active"';} ?>>
                  <a href="<?php echo e(URL::to('users/orders/2')); ?>"><?php echo e(__('main.process')); ?>&nbsp;(<?php echo e($process); ?>)</a>
                </li>
    
                <li <?php if(url()->current()==url('users/orders/3')){echo 'class="active"';} ?>>
                  <a href="<?php echo e(URL::to('users/orders/3')); ?>"><?php echo e(__('main.buyed')); ?>&nbsp;(<?php echo e($buyed); ?>)</a>
                </li>
    
                <li <?php if(url()->current()==url('users/orders/5')){echo 'class="active"';} ?>>
                  <a href="<?php echo e(URL::to('users/orders/5')); ?>"><?php echo e(__('main.gathering_cn')); ?>&nbsp;(<?php echo e($cn); ?>)</a>
                </li>
    
                <li <?php if(url()->current()==url('users/orders/6')){echo 'class="active"';} ?>>
                  <a href="<?php echo e(URL::to('users/orders/6')); ?>"><?php echo e(__('main.gathering_vn')); ?>&nbsp;(<?php echo e($vn); ?>)</a>
                </li>
    
                <li <?php if(url()->current()==url('users/orders/7')){echo 'class="active"';} ?>>
                  <a href="<?php echo e(URL::to('users/orders/7')); ?>"><?php echo e(__('main.check_goods')); ?>&nbsp;(<?php echo e($check_goods); ?>)</a>
                </li>
    
                <li <?php if(url()->current()==url('users/orders/13')){echo 'class="active"';} ?>>
                    <a href="<?php echo e(URL::to('users/orders/13')); ?>"><?php echo e(__('main.final_settlement')); ?>&nbsp;(<?php echo e($final); ?>)</a>
                  </li>
                  
                <li <?php if(url()->current()==url('users/orders/8')){echo 'class="active"';} ?>>
                  <a href="<?php echo e(URL::to('users/orders/8')); ?>"><?php echo e(__('main.delivered')); ?>&nbsp;(<?php echo e($delivered); ?>)</a>
                </li>
    
                <li <?php if(url()->current()==url('users/orders/9')){echo 'class="active"';} ?>>
                  <a href="<?php echo e(URL::to('users/orders/9')); ?>"><?php echo e(__('main.received')); ?>&nbsp;(<?php echo e($received); ?>)</a>
                </li>
  
                <li <?php if(url()->current()==url('users/orders/20')){echo 'class="active"';} ?>>
                  <a href="<?php echo e(URL::to('users/orders/20')); ?>"><?php echo e(__('main.canceled')); ?>&nbsp;(<?php echo e($cancel); ?>)</a>
                </li>
              </ul>
            </li>
    
            <li class="treeview <?php if(strpos(url()->current(),'users/transport/')!=false){echo 'active';} ?>">
              <a href="#">
                <i class="fa fa-truck"></i> <span><?php echo e(__('main.manage_transport')); ?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li <?php if(Request::fullUrl()==url('users/transport/list/-1')){echo 'class="active"';} ?>>
                  <a href="<?php echo e(URL::to('users/transport/list/-1')); ?>"><?php echo e(__('main.request_transport')); ?></a>
                </li>
    
                <li <?php if(Request::fullUrl()==url('users/transport/list/1') 
                || Request::fullUrl()==url('users/transport/list/2') ||
                Request::fullUrl()==url('users/transport/list/3') 
                || Request::fullUrl()==url('users/transport/list/4') 
                || Request::fullUrl()==url('users/transport/list/5')
                ){echo 'class="active"';} ?>>
                  <a href="<?php echo e(URL::to('users/transport/list/1')); ?>"><?php echo e(__('main.bill_transport')); ?></a>
                </li>
              </ul>
            </li>
    
            <li <?php if(strpos(url()->current(),'complaints')!=false){echo 'class="active"';} ?>>
              <a href="<?php echo e(URL::to('users/complaints')); ?>">
                <i class="fa fa-gavel"></i> 
                <span><?php echo e(__('main.complaints')); ?></span>
              </a>
            </li>
    
            <li class="treeview <?php if(strpos(url()->current(),'users/finance/')!=false){echo 'active';} ?>">
              <a href="#">
                <i class="fa fa-money"></i> <span><?php echo e(__('main.finance')); ?></span>
                <span class="pull-right-container">
    
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li <?php if(strpos(url()->current(),'users/finance/statements')!=false){echo 'class="active"';} ?>>
                  <a href="<?php echo e(URL::to('users/finance/statements')); ?>"><?php echo e(__('main.statement')); ?></a>
                </li>
    
                <li <?php if(strpos(url()->current(),'users/finance/deposit')!=false){echo 'class="active"';} ?>>
                  <a href="<?php echo e(URL::to('users/finance/deposit')); ?>"><?php echo e(__('main.deposit')); ?></a>
                </li>
              </ul>
            </li>
    

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $__env->yieldContent('header',__('main.dashboard')); ?>
        <small><?php echo $__env->yieldContent('small_header',__('main.list')); ?></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
     <?php $__env->startSection('content'); ?>
         
     <?php echo $__env->yieldSection(); ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>


  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->



<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html><?php /**PATH /Library/WebServer/Documents/azorder/resources/views/layouts/user.blade.php ENDPATH**/ ?>