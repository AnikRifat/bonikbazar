
<?php $__env->startSection('title', 'Register | '. Config::get('siteSetting.site_name') ); ?>
<?php  

    $reCaptcha = App\Models\SiteSetting::where('type', 'google_recaptcha')->first(); 

    $socailLogins = App\Models\SiteSetting::where('type', 'facebook_login')->orWhere('type', 'google_login')->orWhere('type', 'twitter_login')->get(); 
   
?>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('frontend')); ?>/css/custom/user-form.css">

<?php if($reCaptcha->status == 1): ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<section class="user-form-part">
           
            <div class="user-form-category" style="padding-top: 10px;">
                
              
                <div class="tab-pane active" id="login-tab" >
                    
                    <div class="user-form-title">
                        <h2>Register</h2>
                        <p>Setup a new account in a minute.</p>
                    </div>
                    
                    <?php if(Session::has('error')): ?>
                    <div class="alert alert-danger">
                      <strong>Error! </strong> <?php echo e(Session::get('error')); ?>

                    </div>
                    <?php endif; ?>
                    <form action="<?php echo e(route('userRegister')); ?>" id="loginform" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" name="name" value="<?php echo e(old('name')); ?>" required class="form-control" placeholder="Name">
                                    <small class="form-alert">Please enter your full name</small>
                                    <?php if($errors->has('name')): ?>
                                        <span class="error" role="alert">
                                            <?php echo e($errors->first('name')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" value="<?php echo e(old('emailOrMobile')); ?>" required name="emailOrMobile" class="form-control" placeholder="Email Or Mobile">
                                    
                                    <?php if($errors->has('emailOrMobile')): ?>
                                        <span class="error" role="alert">
                                            <?php echo e($errors->first('emailOrMobile')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="password" required name="password" class="form-control" placeholder="Password">
                                    <button class="form-icon"><i class="eye fas fa-eye"></i></button>
                                    <small class="form-alert">Password must be 6 characters</small>
                                    <?php if($errors->has('password')): ?>
                                        <span class="error" role="alert">
                                            <?php echo e($errors->first('password')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <?php if($reCaptcha->status == 1): ?>
                                    <div class="form-group">
                                        
                                        <div class="g-recaptcha" data-sitekey="<?php echo e($reCaptcha->public_key); ?>"></div>
                                        <span id="recaptcha-error" style="color: red"></span>
                                        
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input required type="checkbox" class="custom-control-input" id="signup-check">
                                        <label class="custom-control-label" for="signup-check">I agree to the all <a href="<?php echo e(url('terms-conditions')); ?>">terms & consitions</a>.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-inline">
                                        <i class="fas fa-user-check"></i>
                                        <span>Create new account</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php if(count($socailLogins)>0): ?>
                    <ul class="user-form-option">

                        <?php $__currentLoopData = $socailLogins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socailLogin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($socailLogin->type == 'facebook_login' && $socailLogin->status == 1): ?>
                         <li >
                            <a class="facebook" href="<?php echo e(route('social.login', 'facebook')); ?>">
                                <i class="fab fa-facebook-f"></i>
                                <span>facebook</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if($socailLogin->type == 'google_login' && $socailLogin->status == 1): ?>
                         <li>
                            <a class="google" href="<?php echo e(route('social.login', 'google')); ?>">
                                <i class="fab fa-google"></i>
                                <span>google</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if($socailLogin->type == 'twitter_login' && $socailLogin->status == 1): ?>
                         <li>
                            <a class="twitter" href="<?php echo e(route('social.login', 'twitter')); ?>">
                                <i class="fab fa-twitter"></i>
                                <span>twitter</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if($socailLogin->type == 'linkedin_login' && $socailLogin->status == 1): ?>
                        <li>
                            <a class="google" href="<?php echo e(route('social.login', 'linkedin')); ?>">
                                <i class="fab fa-linkedin"></i>
                                <span>linkedin</span>
                            </a>
                        </li>
                        <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <?php endif; ?>
                    <?php if(Session::has('success')): ?>
                    <div class="alert alert-success">
                      <strong>Success! </strong> <?php echo e(Session::get('success')); ?>

                    </div>
                    <?php endif; ?>
                    <div class="user-form-direction">
                        <p>Already have an account? click on the <a  href="<?php echo e(url('login')); ?>" >( sign in )</a></p>
                    </div>
                    
                    
                </div>
                </div>

            </div>
        </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script type="text/javascript">
    <?php if($reCaptcha->status == 1): ?>
        $("#loginform").submit(function(event) {

           var recaptcha = $("#g-recaptcha-response").val();
           if (recaptcha === "") {
              event.preventDefault();
              $("#recaptcha-error").html("Recaptcha is required");
           }
        });
    <?php endif; ?>
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/auth/register.blade.php ENDPATH**/ ?>