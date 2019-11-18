<style>
    *{
        font-family: Arial, Helvetica, sans-serif;
    }
    .card-header{
        font-size: 30px;
        font-weight: 900;
    }
    .container{
        display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    }
    .label{
        width: 100%;

    }
    .form-control{
        width: 100%;
    height: 30px;
    border: none;
    background: #ebebeb;
    border-radius: 5px;
    }
</style>

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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><?php echo e(__('main.login')); ?></div>
                <br>
                <br>
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="form-group row">
                            <label for="email" class="col-12 col-form-label text-md-right"><?php echo e(__('E-Mail Address')); ?></label>

                            <div class="col-12">
                                <input id="email" type="email" class="form-control <?php if ($errors->has('email')) :
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
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-12 col-form-label text-md-right"><?php echo e(__('Password')); ?></label>

                            <div class="col-12">
                                <input id="password" type="password" class="form-control <?php if ($errors->has('password')) :
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
                        </div>
                        <br>

                        <div class="form-group row mb-0">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Login')); ?>

                                </button>

                                <?php if(Route::has('password.request')): ?>
                                    <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                        <?php echo e(__('Forgot Your Password?')); ?>

                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php /**PATH /Library/WebServer/Documents/qcexpress/resources/views/auth/login-admin.blade.php ENDPATH**/ ?>