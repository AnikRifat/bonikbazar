
<?php $__env->startSection('title', 'Recover password | '.Config::get('siteSetting.site_name')); ?>
<?php $__env->startSection('css-top'); ?>

<style type="text/css">
    @media (min-width: 1200px){
        .container {
            max-width: 1200px !important;
        }
    }
    .dropdown-toggle::after, .dropup .dropdown-toggle::after {
        content: initial !important;
    }
    .card-footer, .card-header {
        margin-bottom: 5px;
        border-bottom: 1px solid #ececec;
    }

    .loginArea{background: #fff; border-radius: 5px;margin:10px 0;padding: 20px;}
</style>
 <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <div id="pageLoading" style="display: none;"></div>
    <div class="row justify-content-center">
        <div class="col-md-6 col-xs-12 ">
            <div class="card loginArea">
                <div class="card-body">
                    <div id="loginform">
                        <div class="col-xs-12">
                            <h3 style="text-align: center;">Recover Password</h3>
                            <?php if(Session::has('status')): ?>
                            <div class="alert alert-success">
                              <strong>Success! </strong> <?php echo e(Session::get('status')); ?>

                            </div>
                            <?php endif; ?>
                            <?php if(Session::has('error')): ?>
                            <div class="alert alert-danger">
                              <strong>Error! </strong> <?php echo e(Session::get('error')); ?>

                            </div>
                            <?php endif; ?>
                        </div>
                        <?php if(Request::get('mobile')): ?> 
                        <form class="form-horizontal" data-parsley-validate  method="get" id="recoverResetform" action="<?php echo e(route('password.recoverVerify')); ?>">
                           
                            <input type="hidden" name="mobile" value="<?php echo e(Request::get('mobile')); ?>">
                            <p>Please enter the 4-digit verification code we sent via SMS:</p>
                            <div class="row">
                                <div class="col-xs-8 col-sm-8">
                                    <input class="form-control" value="<?php echo e(old('otp_code')); ?>" name="otp_code" type="text" minlength="4" required placeholder="Enter your OTP Code."> 
                                    <?php if($errors->has('otp_code')): ?>
                                        <span class="error" role="alert">
                                           <?php echo e($errors->first('otp_code')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-xs-4 col-sm-4">
                                    <button class="btn btn-primary" type="submit">Verify</button>
                                </div>
                                <div class="col-xs-12 col-sm-12" style="line-height: 2">
                                    <span>Didn't receive the code?</span><br/>
                                    <a href="<?php echo e(route('password.recover')); ?>?emailOrMobile=<?php echo e(Request::get('mobile')); ?>"> Send code again</a><br/>
                                    
                                </div>
                            </div>
                        </form>
                        <?php else: ?>      
                        <form class="form-horizontal" data-parsley-validate method="post" id="recoverResetform" action="<?php echo e(route('password.recover')); ?>">
                            <?php echo csrf_field(); ?> 
                            <div class="row">      
                                <div class="col-xs-12">
                                    
                                    <p class="text-muted">Enter your Mobile or Email and instructions will be sent to you!</p>
                                    
                                    <input class="form-control" id="emailOrMobile" value="<?php echo e(old('emailOrMobile')); ?>" name="emailOrMobile" type="text" required placeholder="Mobile or Email"> 
                                    <?php if($errors->has('emailOrMobile')): ?>
                                        <span class="error" role="alert">
                                           <?php echo e($errors->first('emailOrMobile')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-xs-12">
                                    <button style="margin: 20px 0;" class="btn btn-primary btn-sm btn-block text-uppercase waves-effect waves-light" id="sendBtn" type="submit">Reset Password </button>
                                </div>
                            </div>
                            </form>
                            <?php endif; ?>
                           
                    </div>
                </div>
            </div>
            <div class="actions-toolbar">
                <div class="col-sm-12 text-center">
                    Back to login <a href="<?php echo e(route('login')); ?>" class="text-info m-l-5"><b>Login</b></a>
                </div>
            </div>  
            <div class="col-md-3 col-xs-12"></div>     
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
     $('#sendBtn').click('on', function(){
        var emailOrMobile = $('#emailOrMobile').val();
        if(emailOrMobile){
            $('#sendBtn').html('Sending...');
        }
    });
        
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/auth/passwords/email.blade.php ENDPATH**/ ?>