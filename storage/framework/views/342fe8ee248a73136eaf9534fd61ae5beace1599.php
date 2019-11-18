<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Quảng Châu Express</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo e(asset('public/bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(asset('public/bower_components/font-awesome/css/font-awesome.min.css')); ?>">
  <!-- Ionicons -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('public/adminlte/css/AdminLTE.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('public/adminlte/css/skins/skin-blue.min.css')); ?>">
  <script src="<?php echo e(asset('public/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
  <script>
     var BASE_API = "<?php echo e(url('/')); ?>/api/";
  </script>
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo e(asset('admin/dashboard')); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>QC Express</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>QC Express</b></span>
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
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?php echo e(asset(Auth::user()->avatar)); ?>" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo e(Auth::user()->fullname); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?php echo e(asset(Auth::user()->avatar)); ?>" class="img-circle" alt="User Image">
                <p>
                  <?php echo e(Auth::user()->fullname); ?>

                  <small><?php echo e(Auth::user()->created_at); ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo e(asset('admin/users/profile')); ?>" class="btn btn-default btn-flat"><?php echo e(__('main.profile')); ?></a>
                </div>
                <div class="pull-left">
                  <a href="<?php echo e(asset('admin/users/change-password')); ?>" class="btn btn-default btn-flat"><?php echo e(__('main.password')); ?></a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo e(asset('admin/users/logout')); ?>" class="btn btn-default btn-flat"><?php echo e(__('main.logout')); ?></a>
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
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <!-- Optionally, you can add icons to the links -->
        <li <?php if(strpos(url()->current(),'admin/dashboard')!=false){echo 'class="active"';} ?>>
          <a href="<?php echo e(asset('admin/dashboard/')); ?>"><i class="fa fa-dashboard"></i> <span><?php echo e(__('main.dashboard')); ?></span></a>
        </li>

        <li class="treeview <?php if(strpos(url()->current(),'admin/orders/')!=false){echo 'active';} ?>">
          <a href="#"><i class="fa fa-archive"></i> <span><?php echo e(__('main.orders')); ?></span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <?php
          $all = DB::table('orders')->count();
          $pending = DB::table('orders')->where('status',0)->count();
          $checked = DB::table('orders')->where('status',1)->count();
          $process = DB::table('orders')->where('status',2)->count();
          $buyed = DB::table('orders')->where('status',3)->count();
          $cn = DB::table('orders')->where('status',5)->count();
          $vn = DB::table('orders')->where('status',6)->count();
          $check_goods = DB::table('orders')->where('status',7)->count();
          $delivered = DB::table('orders')->where('status',8)->count();
          $received = DB::table('orders')->where('status',9)->count();
          $sold_out = DB::table('orders')->where('status',10)->count();
          $paid = DB::table('orders')->where('deposit','>',0)->count();
          $unpaid = DB::table('orders')->where('deposit','<=',0)->where('is_final',0)->count();
          $final = DB::table('orders')->where('is_final',1)->count();
          $cancel=DB::table('orders')->where('is_final',20)->count();
        ?>
         <ul class="treeview-menu">
            <li <?php if(url()->current()==url('admin/orders/-1')){echo 'class="active"';} ?>>
                <a href="<?php echo e(URL::to('admin/orders/-1')); ?>">Tất cả&nbsp;(<?php echo e($all); ?>)</a>
              </li>

            <li <?php if(url()->current()==url('admin/orders/0')){echo 'class="active"';} ?>>
              <a href="<?php echo e(URL::to('admin/orders/0')); ?>"><?php echo e(__('main.pending')); ?>&nbsp;(<?php echo e($pending); ?>)</a>
            </li>


            <li <?php if(url()->current()==url('admin/orders/11')){echo 'class="active"';} ?>>
                <a href="<?php echo e(URL::to('admin/orders/11')); ?>">Đã đặt cọc&nbsp;(<?php echo e($paid); ?>)</a>
              </li>
  
              <li <?php if(url()->current()==url('admin/orders/12')){echo 'class="active"';} ?>>
                <a href="<?php echo e(URL::to('admin/orders/12')); ?>">Chưa đặt cọc&nbsp;(<?php echo e($unpaid); ?>)</a>
              </li>
  
              <li <?php if(url()->current()==url('admin/orders/1')){echo 'class="active"';} ?>>
                  <a href="<?php echo e(URL::to('admin/orders/1')); ?>"><?php echo e(__('main.checked')); ?>&nbsp;(<?php echo e($checked); ?>)</a>
                </li>
            <li <?php if(url()->current()==url('admin/orders/2')){echo 'class="active"';} ?>>
              <a href="<?php echo e(URL::to('admin/orders/2')); ?>"><?php echo e(__('main.process')); ?>&nbsp;(<?php echo e($process); ?>)</a>
            </li>

            <li <?php if(url()->current()==url('admin/orders/3')){echo 'class="active"';} ?>>
              <a href="<?php echo e(URL::to('admin/orders/3')); ?>"><?php echo e(__('main.buyed')); ?>&nbsp;(<?php echo e($buyed); ?>)</a>
            </li>

            <li <?php if(url()->current()==url('admin/orders/5')){echo 'class="active"';} ?>>
              <a href="<?php echo e(URL::to('admin/orders/5')); ?>"><?php echo e(__('main.gathering_cn')); ?>&nbsp;(<?php echo e($cn); ?>)</a>
            </li>

            <li <?php if(url()->current()==url('admin/orders/6')){echo 'class="active"';} ?>>
              <a href="<?php echo e(URL::to('admin/orders/6')); ?>"><?php echo e(__('main.gathering_vn')); ?>&nbsp;(<?php echo e($vn); ?>)</a>
            </li>

            <li <?php if(url()->current()==url('admin/orders/7')){echo 'class="active"';} ?>>
              <a href="<?php echo e(URL::to('admin/orders/7')); ?>"><?php echo e(__('main.check_goods')); ?>&nbsp;(<?php echo e($check_goods); ?>)</a>
            </li>

            <li <?php if(url()->current()==url('admin/orders/13')){echo 'class="active"';} ?>>
                <a href="<?php echo e(URL::to('admin/orders/13')); ?>"><?php echo e(__('main.final_settlement')); ?>&nbsp;(<?php echo e($final); ?>)</a>
              </li>
  

            <li <?php if(url()->current()==url('admin/orders/8')){echo 'class="active"';} ?>>
              <a href="<?php echo e(URL::to('admin/orders/8')); ?>"><?php echo e(__('main.delivered')); ?>&nbsp;(<?php echo e($delivered); ?>)</a>
            </li>

            <li <?php if(url()->current()==url('admin/orders/9')){echo 'class="active"';} ?>>
              <a href="<?php echo e(URL::to('admin/orders/9')); ?>"><?php echo e(__('main.received')); ?>&nbsp;(<?php echo e($received); ?>)</a>
            </li>

            <li <?php if(url()->current()==url('admin/orders/10')){echo 'class="active"';} ?>>
              <a href="<?php echo e(URL::to('admin/orders/10')); ?>"><?php echo e(__('main.sold_out')); ?>&nbsp;(<?php echo e($sold_out); ?>)</a>
            </li>

       
            <li <?php if(url()->current()==url('admin/orders/20')){echo 'class="active"';} ?>>
              <a href="<?php echo e(URL::to('admin/orders/20')); ?>"><?php echo e(__('main.canceled')); ?>&nbsp;(<?php echo e($cancel); ?>)</a>
            </li>
          </ul>


        <?php 
          $request_transport_count = DB::table('orders')->where('status',7)->where('ship_request',0)->where('id_user',Auth::user()->id)->count();
          $bill_transport_count = DB::table('orders')->where('ship_request','!=',0)->where('id_user',Auth::user()->id)->count();
        ?>
        </li>
        <li class="treeview <?php if(strpos(url()->current(),'admin/transport/')!=false){echo 'active';} ?>">
            <a href="#"><i class="fa fa-truck"></i> <span><?php echo e(__('main.transport')); ?></span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
           
  
              <li <?php if(Request::fullUrl()==url('admin/transport/list/1') 
              || Request::fullUrl()==url('admin/transport/list/2') ||
              Request::fullUrl()==url('admin/transport/list/3') 
              || Request::fullUrl()==url('admin/transport/list/4') 
              || Request::fullUrl()==url('admin/transport/list/5')
              ){echo 'class="active"';} ?>>
                <a href="<?php echo e(URL::to('admin/transport/list/1')); ?>"><?php echo e(__('main.bill_transport')); ?>&nbsp;(<?php echo e($bill_transport_count); ?>)</a>
              </li>
            </ul>
        </li>

        <li class="treeview <?php if(strpos(url()->current(),'admin/banks')!=false){echo 'active';} ?>">
          <a href="#"><i class="fa fa-bank"></i><span><?php echo e(__('main.banks')); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if(strpos(url()->current(),'admin/banks/add')!=false){echo 'class="active"';} ?>>
              <a href="<?php echo e(asset('admin/banks/add')); ?>"><?php echo e(__('main.add_a_new')); ?></a>
            </li>
            <li <?php if(strpos(url()->current(),'admin/banks')!=false){echo 'class="active"';} ?>>
              <a href="<?php echo e(asset('admin/banks')); ?>"><?php echo e(__('main.all_banks')); ?></a>
            </li>
          </ul>
        </li>



        <li <?php if(strpos(url()->current(),'admin/complaints')!=false){echo 'class="active"';} ?>>
          <a href="<?php echo e(asset('admin/complaints/')); ?>"><i class="fa fa-gavel"></i> <span><?php echo e(__('main.complaints')); ?></span></a>
        </li>
        
        <li class="treeview <?php if(strpos(url()->current(),'admin/posts')!=false){echo 'active';} ?><?php if(strpos(url()->current(),'admin/post_categories')!=false){echo 'active';} ?>">
          <a href="#"><i class="fa fa-file-text"></i><span><?php echo e(__('main.posts')); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if(strpos(url()->current(),'admin/posts/add')!=false){echo 'class="active"';} ?>>
              <a href="<?php echo e(asset('admin/posts/add')); ?>"><?php echo e(__('main.add_a_new')); ?></a>
            </li>
            <li <?php if(strpos(url()->current(),'admin/post_categories')!=false){echo 'class="active"';} ?>>
              <a href="<?php echo e(asset('admin/post_categories')); ?>"><?php echo e(__('main.posts_categories')); ?></a>
            </li>
            <li <?php if(strpos(url()->current(),'admin/posts')!=false){echo 'class="active"';} ?>>
              <a href="<?php echo e(asset('admin/posts')); ?>"><?php echo e(__('main.all_posts')); ?></a>
            </li>
          </ul>
        </li>

        <li class="treeview <?php if(strpos(url()->current(),'admin/users')!=false){echo 'active';} ?>">
          <a href="#"><i class="fa fa-id-badge"></i><span><?php echo e(__('main.users')); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if(strpos(url()->current(),'admin/users/add')!=false){echo 'class="active"';} ?>>
              <a href="<?php echo e(asset('admin/users/add/')); ?>"><?php echo e(__('main.add_a_new')); ?></a>
            </li>
            <li <?php if(strpos(url()->current(),'admin/users')!=false){echo 'class="active"';} ?>>
              <a href="<?php echo e(asset('admin/users/')); ?>"><?php echo e(__('main.all_users')); ?></a>
            </li>
          </ul>
        </li>
        
        <li <?php if(strpos(url()->current(),'admin/statements')!=false){echo 'class="active"';} ?>>
          <a href="<?php echo e(asset('admin/statements/')); ?>"><i class="fa fa-clipboard"></i> <span><?php echo e(__('main.transaction')); ?></span></a>
        </li>

        <li class="treeview <?php if(strpos(url()->current(),'admin/settings/')!=false){echo 'active';} ?>">
          <a href="#"><i class="fa fa-gear"></i><span><?php echo e(__('main.settings')); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if(strpos(url()->current(),'admin/settings/general')!=false){echo 'class="active"';} ?>>
              <a href="<?php echo e(asset('admin/settings/general')); ?>"><?php echo e(__('main.settings_general')); ?></a>
            </li>
            <li <?php if(strpos(url()->current(),'admin/settings/services')!=false){echo 'class="active"';} ?>>
              <a href="<?php echo e(asset('admin/settings/services')); ?>"><?php echo e(__('main.settings_services')); ?></a>
            </li>
            <li <?php if(strpos(url()->current(),'admin/settings/contacts')!=false){echo 'class="active"';} ?>>
              <a href="<?php echo e(asset('admin/settings/contacts')); ?>"><?php echo e(__('main.settings_contacts')); ?></a>
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
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->


<!-- Bootstrap 3.3.7 -->
<script src="<?php echo e(asset('public/bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('public/adminlte/js/adminlte.min.js')); ?>"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->


<script src="https://cdn.tiny.cloud/1/1t4achym7sxldb6kbsascbkd68o2huhdipqhr0re1p2b39d2/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
          selector: 'textarea.tyni-edit',
          plugins: 'print preview fullpage powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap tinycomments mentions quickbars linkchecker emoticons',
          imagetools_cors_hosts: ['picsum.photos'],
          tinydrive_demo_files_url: '/docs/demo/tiny-drive-demo/demo_files.json',
          tinydrive_dropbox_app_key: 'jee1s9eykoh752j',
          tinydrive_google_drive_key: 'AIzaSyAsVRuCBc-BLQ1xNKtnLHB3AeoK-xmOrTc',
          tinydrive_google_drive_client_id: '748627179519-p9vv3va1mppc66fikai92b3ru73mpukf.apps.googleusercontent.com',
          menu: {
              tc: {
              title: 'TinyComments',
              items: 'addcomment showcomments deleteallconversations'
              }
          },
          menubar: 'file edit view insert format tools table tc help',
          toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
          autosave_ask_before_unload: true,
          autosave_interval: "30s",
          autosave_prefix: "{path}{query}-{id}-",
          autosave_restore_when_empty: false,
          autosave_retention: "2m",
          image_advtab: true,
          content_css: [
              '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
              '//www.tiny.cloud/css/codepen.min.css'
          ],
          link_list: [
              { title: 'My page 1', value: 'http://www.tinymce.com' },
              { title: 'My page 2', value: 'http://www.moxiecode.com' }
          ],
          image_list: [
              { title: 'My page 1', value: 'http://www.tinymce.com' },
              { title: 'My page 2', value: 'http://www.moxiecode.com' }
          ],
          image_class_list: [
              { title: 'None', value: '' },
              { title: 'Some class', value: 'class-name' }
          ],
          importcss_append: true,
          height: 400,
          file_picker_callback: function (callback, value, meta) {
              /* Provide file and text for the link dialog */
              if (meta.filetype === 'file') {
              callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
              }

              /* Provide image and alt text for the image dialog */
              if (meta.filetype === 'image') {
              callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
              }

              /* Provide alternative source and posted for the media dialog */
              if (meta.filetype === 'media') {
              callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
              }
          },
          templates: [
                  { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
              { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
              { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
          ],
          template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
          template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
          height: 600,
          image_caption: true,
          quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
          noneditable_noneditable_class: "mceNonEditable",
          toolbar_drawer: 'sliding',
          spellchecker_dialog: true,
          spellchecker_whitelist: ['Ephox', 'Moxiecode'],
          tinycomments_mode: 'embedded',
          content_style: ".mymention{ color: gray; }",
          contextmenu: "link image imagetools table configurepermanentpen",
          mentions_selector: '.mymention',
          });  
</script>


<style>
.box{
  overflow-x: scroll;
}

.tox-notifications-container{
  display: none;
}
</style>
</body><?php /**PATH /Library/WebServer/Documents/qcexpress/resources/views/layouts/admin.blade.php ENDPATH**/ ?>