
<script src="<?php echo e(asset('public/bower_components/datetimepicker/build/jquery.datetimepicker.full.min.js')); ?>"></script>
<link rel="stylesheet" href="<?php echo e(asset('public/bower_components/datetimepicker/build/jquery.datetimepicker.min.css')); ?>">
<form role="form" method="GET">
        <?php
            $lading=Request::input('lading');
            $id_stm='';
            $id_order='';
            $status = -1;
            $type=-1;

            if(Request::input('id_stm')!=null){
                $id_stm=Request::input('id_stm');
                if(strpos($id_stm,'GD')===false){
                    $id_stm='GD'.$id_stm;
                }
            }


            if(Request::input('id_order')!=null){
                $id_order=Request::input('id_order');
                if(strpos($id_order,'QDH')===false){
                    $id_order='QDH'.$id_order;
                }
            }

            if (Request::input('status')!=null) {
                $status=Request::input('status');
            }

            if (Request::input('type')!=null) {
                $type=Request::input('type');
            }
            $created_at=Request::input('created_at');
            $updated_at=Request::input('updated_at');
        ?>
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-sm-2 form-group">
                <label for="">Mã đơn</label>
                <input class="form-control" type="text" name="id_order" value="<?php echo e($id_order); ?>">
            </div>

            <div class="col-sm-2 form-group">
                    <label for="">Mã GD</label>
                    <input class="form-control" type="text" name="id_stm" value="<?php echo e($id_stm); ?>">
            </div>

            <div class="col-sm-2 form-group">
                    <label for="">TG xử lý từ</label>
                    <input class="form-control" type="text" name="created_at" value="<?php echo e($created_at); ?>">
            </div>

            <div class="col-sm-2 form-group">
                    <label for="">TG xử lý đến</label>
                    <input class="form-control" type="text" name="updated_at" value="<?php echo e($updated_at); ?>">
            </div>

            <div class="col-sm-2 form-group">
                    <label for="">Mục đích</label>
                    <select class="form-control" name="type">
                            <option value="-1">Mục đích</option>
                            <option value="0" <?php 
                                if($type==0){echo 'selected';}
                            ?>>Nạp tiền</option>
                            <option value="1" <?php
                                if($type==1){echo 'selected';}
                            ?>>Tất toán</option>
                            <option value="2" <?php
                                if($type==2){echo 'selected';}
                            ?>>Đặt cọc</option>
                            <option value="3" <?php 
                                if($type==3){echo 'selected';}
                            ?>>Thanh toán</option>
                              <option value="4" <?php 
                              if($type==4){echo 'selected';}
                          ?>>Huỷ và hoàn tiền</option>
                    </select>
            </div>


            <div class="col-sm-2 form-group">
                    <label for="">Trạng thái</label>
                    <select class="form-control" name="status">
                            <option value="-1">Trạng thái</option>
                            <option value="0" <?php 
                                if($status==0){echo 'selected';}
                            ?>>Đang chờ</option>
                            <option value="1" <?php 
                                if($status==1){echo 'selected';}
                            ?>>Hoàn thành</option>
                    </select>
            </div>


            <div class="col-sm-8 form-group">
                    <button class="btn btn-success" style="margin-top:25px">Lọc</button>
                    <a class="btn btn-warning" style="margin-top:25px" href="<?php echo e(url()->current()); ?>">Xoá bộ lọc</a>
                    <button class="btn btn-success btn-export-excel" style="margin-top:25px"  name="export_excel" value="1"><i class="fa fa-file-excel-o"></i>&nbsp;Xuất Excel</button>
            </div>
        </div>
    </form>

<script>
            $(document).ready(function () {
              $('input[name="created_at"]').on('change',function(){
                 let val = $(this).val();
                 if(val==2){
                   $('.form-group-banks').removeClass('hide').addClass('show');
                 }else{
                  $('.form-group-banks').removeClass('show').addClass('hide');
                 }
               })
               $.datetimepicker.setLocale('vi');
               $('input[name="created_at"],input[name="updated_at"]').datetimepicker({
                 format:'d-m-Y H:i'
               });
            });
</script><?php /**PATH /Library/WebServer/Documents/qcexpress/resources/views/shared/filter_user_stm.blade.php ENDPATH**/ ?>