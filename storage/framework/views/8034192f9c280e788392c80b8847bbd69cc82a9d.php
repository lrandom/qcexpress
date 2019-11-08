
<script src="<?php echo e(asset('public/bower_components/datetimepicker/build/jquery.datetimepicker.full.min.js')); ?>"></script>
<link rel="stylesheet" href="<?php echo e(asset('public/bower_components/datetimepicker/build/jquery.datetimepicker.min.css')); ?>">
<form role="form" method="GET">
        <?php
            $lading=Request::input('lading');
            $id_client='';
            $id_order='';
            if(Request::input('id_client')!=null){
                $id_client =Request::input('id_client');
            }

            if(Request::input('id_order')!=null){
                $id_order=Request::input('id_order');
                if(strpos($id_order,'QC')===false){
                    $id_order='QC'.$id_order;
                }
            }
            $order_status=Request::input('order_status');
            $sites=Request::input('sites');
            $created_at=Request::input('created_at');
            $updated_at=Request::input('updated_at');
            $lading_status=Request::input('lading_status');
        ?>
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-sm-2 form-group">
                    <label for="">Mã đơn</label>
                    <input class="form-control" type="text" name="id_order" value="<?php echo e($id_order); ?>">
            </div>

            <div class="col-sm-2 form-group">
                    <label for="">Mã vận đơn</label>
                    <input class="form-control" type="text" name="lading" value="<?php echo e($lading); ?>">
            </div>

            <div class="col-sm-2 form-group">
                    <label for="">Id khách hàng</label>
                    <input class="form-control" type="text" name="id_client" value="<?php echo e($id_client); ?>">
            </div>

            <?php if($status==-1): ?>
            <div class="col-sm-2 form-group">
                    <label for="">Trạng thái đơn</label>
                    <select class="form-control" name="order_status">
                            <option>Trạng thái đơn</option>
                            <option>Có vận đơn</option>
                            <option>Chưa có vận đơn</option>
                    </select>
            </div>
            <?php endif; ?>

            <div class="col-sm-2 form-group">
                    <label for="">Trạng thái vận đơn</label>
                    <select class="form-control" name="lading_status">
                        <option value="0">Trạng thái vận đơn</option>
                        <option value="1" <?php if($lading_status==1){echo 'selected';} ?>>Có vận đơn</option>
                        <option value="2" <?php if($lading_status==2){echo 'selected';} ?>>Chưa có vận đơn</option>
                    </select>
            </div> 
      

            <div class="col-sm-2 form-group">
             
                        <label for="">Site đặt hàng</label>
                        <select class="form-control" name="sites">
                            <option>Site đặt hàng</option>
                            <option value="1" <?php if($sites==1){echo 'selected';} ?>>Tmall</option>
                            <option value="3" <?php if($sites==3){echo 'selected';} ?>>Taobao</option>
                            <option value="2" <?php if($sites==2){echo 'selected';} ?>>1688</option>
                        </select>
            </div>

            <div class="col-sm-2 form-group">
                    <label for="">TG xử lý từ</label>
                    <input class="form-control" type="text" name="created_at" value="<?php echo e($created_at); ?>">
            </div>

            <div class="col-sm-2 form-group">
                    <label for="">TG xử lý đến</label>
                    <input class="form-control" type="text" name="updated_at" value="<?php echo e($updated_at); ?>">
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
          </script><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/qc_express/resources/views/shared/filter.blade.php ENDPATH**/ ?>