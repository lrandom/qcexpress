<?php $__env->startSection('header',__('main.dashboard')); ?>
<?php $__env->startSection('small_header',''); ?>
<?php $__env->startSection('content'); ?>


    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-gavel"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><?php echo e(__('main.new_complaints')); ?></span>
                <span class="info-box-number"><?php echo e(count($new_complaints)); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fa fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><?php echo e(__('main.new_orders')); ?></span>
                <span class="info-box-number"><?php echo e(count($new_orders)); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><?php echo e(__('main.users')); ?></span>
                <span class="info-box-number"><?php echo e(count($users)); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->









        <div class="box-body" style="background: #fff">

            <h4><strong><?php echo e(__('main.complaints')); ?></strong></h4>
            <br>

                <table class="table table-bordered">
                  <tbody><tr>
                    <th style="width: 10px">#</th>
                    <th><?php echo e(__('main.picture')); ?></th>
                    <th><?php echo e(__('main.user')); ?></th>
                    <th><?php echo e(__('main.order')); ?></th>
                    <th><?php echo e(__('main.reason')); ?></th>
                    <th><?php echo e(__('main.description')); ?></th>
                    <th><?php echo e(__('main.note')); ?></th>
                    <th><?php echo e(__('main.amount')); ?></th>
                    <th><?php echo e(__('main.status')); ?></th>
                    <th style="width: 200px"><?php echo e(__('main.operation')); ?></th>
                  </tr>
          
                  <?php $__currentLoopData = $new_complaints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                          <td><a class="" href="<?php echo e(URL::to('admin/complaints/detail/'.$r->id)); ?>"><?php echo e($r->id); ?></a></td>
                          <td><img src="<?php echo e(asset($r->photo[0])); ?>" style="width:120px;height:80px;"/></td>
                          <td><?php echo e($r->fullname); ?></td>
                          <td>
                              <a class="" href="<?php echo e(URL::to('admin/order/'.$r->id_order)); ?>">OD<?php echo e($r->id_order); ?></a>
                          </td>
                          <td><?php echo e($r->reason); ?></td>
                          <td><?php echo e($r->description); ?></td>
                          <td><?php echo e($r->note); ?></td>
                          <td><?php echo e($r->amount); ?></td>
                          <td>
                              <?php if($r->status == 0): ?>
                                  <span class="btn btn-primary btn-flat"><?php echo e(__('main.not_seen')); ?></span>
                              <?php endif; ?>
                              <?php if($r->status == 1): ?>
                                  <span class="btn btn-warning btn-flat"><?php echo e(__('main.pending')); ?></span>
                              <?php endif; ?>
                              <?php if($r->status == 2): ?>
                                  <span class="btn btn-success btn-flat"><?php echo e(__('main.success')); ?></span>
                              <?php endif; ?>
                              <?php if($r->status == 3): ?>
                                  <span class="btn btn-danger btn-flat"><?php echo e(__('main.faild')); ?></span>
                              <?php endif; ?>
                          </td>
                          <td>
                              <div class="btn-group">
                                  <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                      <?php echo e(__('main.action')); ?>

                                      <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu" role="menu">
                                      <li><a  href="<?php echo e(URL::to('admin/complaints/not_seen/'.$r->id)); ?>"><?php echo e(__('main.not_seen')); ?></a></li>
                                      <li><a  href="<?php echo e(URL::to('admin/complaints/pending/'.$r->id)); ?>"><?php echo e(__('main.pending')); ?></a></li>
                                      <li><a  href="<?php echo e(URL::to('admin/complaints/success/'.$r->id)); ?>"><?php echo e(__('main.success')); ?></a></li>
                                      <li><a  href="<?php echo e(URL::to('admin/complaints/faild/'.$r->id)); ?>"><?php echo e(__('main.faild')); ?></a></li>
                                      <li><a  href="<?php echo e(URL::to('admin/complaints/detail/'.$r->id)); ?>"><?php echo e(__('main.detail')); ?></a></li>
                                      
                                  </ul>
                              </div>
                          </td>
                      </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            <br>
            </div>




    </div><!--/. container-fluid -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/qcexpress/resources/views/admin/dashboard/index.blade.php ENDPATH**/ ?>