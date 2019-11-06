<link href="<?php echo e(asset('public/css/login_and_register.css')); ?>" rel="stylesheet">
<!-- Common Style CSS -->
<link href="<?php echo e(asset('public/css/styles.css')); ?>" rel="stylesheet">
<style>
    .login_section_overlay {
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .login_section_overlay img{
        height: 100%;
        min-width: 100%;
    }
</style>



<?php $__env->startSection('title_page',__('main.login')); ?>

<?php $__env->startSection('content'); ?>

    <div class="login_section">
        
        <div class="login_section_overlay">
            <img src="<?php echo e(asset('pictures/init/login-bg.jpg')); ?>" alt="">
        </div>

        <!-- login_form_wrapper -->
        <form  method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>
            <div class="login_form_wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <!-- login_wrapper -->
                            <div class="login_wrapper">
                                
                                <h1>Đăng nhập</h1>

                                <br>

                                <div class="form-group">
                                    <input placeholder=<?php echo e(__('main.email')); ?> id="email" type="email" class="form-control <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
                                    <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            
                            
                                <div class="form-group">
                                    <input placeholder=<?php echo e(__('main.password')); ?> id="password" type="password" class="form-control <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="password" required autocomplete="current-password">
                                    <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            
                                <div class="login_remember_box">
                                    <label class="control control--checkbox"><?php echo e(__('main.remember_me')); ?>

                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                        <span class="control__indicator"></span>
                                    </label>

                                    <?php if(Route::has('password.request')): ?>
                                        <a class="forget_password" href="<?php echo e(route('password.request')); ?>">
                                            <?php echo e(__('main.forgot_password')); ?> ?
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <div class="login_btn">
                                    <button type="submit" class="btn btn-success login_btn btn-block"> 
                                        <?php echo e(__('main.login')); ?> 
                                    </button>
                                    <br>
                                    
                                </div>
                                
                                <br><br><br>

                                <div class="login_message">
                                    <p><?php echo e(__('main.no_account')); ?> <a href="<?php echo e(url('register')); ?>"> <?php echo e(__('main.signup')); ?> </a> </p>

                                </div>
                            </div>
                            <!-- /.login_wrapper-->
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- /.login_form_wrapper-->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/qc_express/resources/views/auth/login.blade.php ENDPATH**/ ?>