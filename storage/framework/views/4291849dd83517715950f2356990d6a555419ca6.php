<?php $__env->startSection('header',__('main.account')); ?>
<?php $__env->startSection('small_header',__('main.update_account')); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
  <div class="col-md-12">
      <?php if(session('status')): ?>
        <div class="alert alert-success">
          <?php echo e(session('status')); ?>

        </div>
        <br/>
      <?php endif; ?>
      
    <div class="box box-info">

      <form role="form" method="POST" enctype="multipart/form-data" class="form-horizontal">
        <?php echo csrf_field(); ?>

        <div class="box-body">

          <div class="form-group">
            <label for="fullname" class="col-sm-2 control-label"><label><?php echo e(__('main.avatar')); ?></label></label>
            <div class="col-sm-10">
              <div>
                <img src="<?php echo e(asset($obj->avatar)); ?>" style="width:120px;height:80px;"/>
              </div>
              <br>
              <input type="file" name="avatar">
            </div>
          </div>

          <br>

          <div class="form-group">
            <label for="fullname" class="col-sm-2 control-label"><?php echo e(__('main.fullname')); ?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" value="<?php echo e($obj->fullname); ?>" name="fullname" id="fullname" 
              placeholder="<?php echo e(__('main.fullname')); ?>">
              <?php if ($errors->has('fullname')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('fullname'); ?>
                <div class="error"><?php echo e($message); ?></div>
              <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
            </div>
          </div>

          <div class="form-group">
            <label for="phone" class="col-sm-2 control-label"><?php echo e(__('main.phone')); ?></label>
            <div class="col-sm-10">
              <input type="number" class="form-control" value="<?php echo e($obj->phone); ?>"
               name="phone" id="phone" placeholder="<?php echo e(__('main.phone')); ?>">
              <?php if ($errors->has('phone')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('phone'); ?>
                <div class="error"><?php echo e($message); ?></div>
              <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
            </div>
          </div>

          <div class="form-group">
            <label for="address" class="col-sm-2 control-label"><?php echo e(__('main.address')); ?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" value="<?php echo e($obj->address); ?>" name="address" id="address" 
              placeholder="<?php echo e(__('main.address')); ?>">
              <?php if ($errors->has('address')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('address'); ?>
                <div class="error"><?php echo e($message); ?></div>
              <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
            </div>
          </div>

          <br>

          <div class="form-group">
            <label class="col-sm-2"></label>
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary"><?php echo e(__('main.update')); ?></button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>



  

          
      


  <div class="modal fade" id="addAddressModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <?php if(count($address) >= 5): ?>
          <div class="modal-body">
            <p>Chỉ tối đa được 5 địa chỉ nhận hàng, nếu nhiều hơn 5 địa chỉ nhận hàng vui lòng chỉ sửa hoặc xoá các địa chỉ trước.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        <?php endif; ?>
        <?php if(count($address) < 5): ?>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo e(__('main.add_ship_address')); ?></h4>
          </div>
          <div class="modal-body">
            
              <form role="form" action="add_address" method="POST" enctype="multipart/form-data" class="form-horizontal">
                <?php echo csrf_field(); ?>
                <div class="box-body">
                  <div class="form-group">
                    <label for="phone" class="col-sm-4 control-label"><?php echo e(__('main.provinces')); ?></label>
                    <div class="col-sm-8">
                      <select class="form-control provinces" name="province_id" id="province_id">
                        <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($item->matp); ?>"><?php echo e($item->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                  </div>
  
                  <div class="form-group">
                    <label for="fullname" class="col-sm-4 control-label"><?php echo e(__('main.cities')); ?></label>
                    <div class="col-sm-8">
                      <select class="form-control cities" name="city_id" id="city_id">
                        <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($item->maqh); ?>"><?php echo e($item->name); ?></option>    
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                  </div>
        
                  <div class="form-group">
                    <label for="address" class="col-sm-4 control-label"><?php echo e(__('main.address_detail')); ?></label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" value="" name="address" id="address" required="" placeholder="<?php echo e(__('main.address')); ?>">
                      <?php if ($errors->has('address_detail')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('address_detail'); ?>
                        <div class="error"><?php echo e($message); ?></div>
                      <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                    </div>
                  </div>
  
                  <div class="form-group">
                    <label for="address" class="col-sm-4 control-label"><?php echo e(__('main.phone')); ?></label>
                    <div class="col-sm-8">
                      <input type="tel" class="form-control" value="" name="phone" id="phone" required="" placeholder="<?php echo e(__('main.phone')); ?>">
                      <?php if ($errors->has('phone')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('phone'); ?>
                        <div class="error"><?php echo e($message); ?></div>
                      <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                    </div>
                  </div>
        
                  <br>
        
                  <div class="form-group">
                    <label class="col-sm-4"></label>
                    <div class="col-sm-8">
                      <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(__('main.cancel')); ?></button>
                      <button type="submit" class="btn btn-primary"><?php echo e(__('main.add')); ?></button>
                    </div>
                  </div>
                </div>
              </form>
  
          </div>
        <?php endif; ?>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


  <div class="modal fade" id="editAddressModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><?php echo e(__('main.update_ship_address')); ?></h4>
        </div>
        <div class="modal-body">
            <form role="form" action="edit_address" method="POST" enctype="multipart/form-data" class="form-horizontal">
              <?php echo csrf_field(); ?>
              <input class="id-address" type="hidden" name="id_address" value="">
              <div class="box-body">
                <div class="form-group">
                  <label for="phone" class="col-sm-4 control-label"><?php echo e(__('main.provinces')); ?></label>
                  <div class="col-sm-8">
                    <select class="form-control provinces" name="province_id" id="province_id"></select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="fullname" class="col-sm-4 control-label"><?php echo e(__('main.cities')); ?></label>
                  <div class="col-sm-8">
                    <select class="form-control cities" name="city_id" id="city_id"></select>
                  </div>
                </div>
      
                <div class="form-group">
                  <label for="address" class="col-sm-4 control-label"><?php echo e(__('main.address_detail')); ?></label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control address" value="" name="address" id="address" required="" placeholder="<?php echo e(__('main.address')); ?>">
                    <?php if ($errors->has('address_detail')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('address_detail'); ?>
                      <div class="error"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="address" class="col-sm-4 control-label"><?php echo e(__('main.phone')); ?></label>
                  <div class="col-sm-8">
                    <input type="tel" class="form-control phone" value="" name="phone" id="phone" required placeholder="<?php echo e(__('main.phone')); ?>">
                    <?php if ($errors->has('phone')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('phone'); ?>
                      <div class="error"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                  </div>
                </div>
                <br>
      
                <div class="form-group">
                  <label class="col-sm-4"></label>
                  <div class="col-sm-8">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(__('main.cancel')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo e(__('main.save_change')); ?></button>
                  </div>
                </div>
              </div>
            </form>

        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->



</div>

    <script type="text/javascript">

      var users_url = "<?php echo e(URL::to('api/users/')); ?>";

      $('.provinces').change(function(){
        var id =  $(this).children("option:selected").val();
        $.ajax({
          url : users_url +'/get_cities/'+ id,
          type : "post",
          success : function (result){
            console.log(result);
            html_tmp = '';
            result.forEach(elm => {
              html_tmp += "<option value="+elm['maqh']+">"+elm['name']+"</option>"; 
            });
            $('.cities').html(html_tmp);
          }
        });
      });

      $('.btn-edit').click(function(){
        var id =  $(this).data("id");

        console.log('');
        $.ajax({
          url : users_url +'/get_address/'+ id,
          type : "post",
          success : function (result){
            console.log(result);

            html_provinces = '';
            result['obj_provinces'].forEach(elm => {
              var checked = null;
              if(elm['matp'] == result['obj_address']['province_id']){
                checked = 'selected';
              };
              html_provinces += "<option "+checked+" value="+elm['matp']+">"+elm['name']+"</option>"; 
            });
            $('.provinces').html(html_provinces);
            
            html_cities = '';
            result['obj_cities'].forEach(elm => {
              var checked = null;
              if(elm['maqh'] == result['obj_address']['city_id']){
                checked = 'selected';
              };
              html_cities += "<option " +checked+ " value="+elm['maqh']+">"+elm['name']+"</option>"; 
            });
            $('.cities').html(html_cities);

            $('.address').val(result['obj_address']['address']);

            $('.phone').val(result['obj_address']['phone']);

            $('.id-address').val(id);
          }
        });
      });

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/Documents/qcexpress/resources/views/users/account.blade.php ENDPATH**/ ?>