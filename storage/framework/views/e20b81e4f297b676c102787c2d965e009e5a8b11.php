
<?php $__env->startSection('title', 'Social media login'); ?>

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('css')); ?>/pages/tab-page.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
        <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                
                <div class="col-md-12 align-self-center ">
                    <div class="d-fl ">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">General</a></li>
                            <li class="breadcrumb-item active">Setting</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
               
                <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="title_head"> Social media login configuration</div>
                               
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                   
                                    <li class="nav-item"> <a class="nav-link  <?php if(!Session::get('activeTap')): ?> active <?php endif; ?> <?php if(Session::get('activeTap') == 'facebook'): ?> active <?php endif; ?> " data-toggle="tab" href="#facebook" role="tab"><i class="ti-facebook"></i>  Facebook Setting</a> </li>
                                    <li class="nav-item"> <a class="nav-link <?php if(Session::get('activeTap') == 'google'): ?> active <?php endif; ?> " data-toggle="tab" href="#google" role="tab"><i class="ti-google"></i>  Google Setting</a> </li>
                                    <li class="nav-item"> <a class="nav-link <?php if(Session::get('activeTap') == 'twitter'): ?> active <?php endif; ?> " data-toggle="tab" href="#twitter" role="tab"><i class="ti-twitter"></i>  Twitter Setting</a> </li>
                                   
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                   
                                    <div class="tab-pane <?php if(!Session::get('activeTap')): ?> active <?php endif; ?> <?php if(Session::get('activeTap') == 'facebook'): ?> active <?php endif; ?> " id="facebook" role="tabpanel">
                                        <div class="p-20">
                                            <form action="<?php echo e(route('env_key_update')); ?>"  method="post" data-parsley-validate>
                                                <?php echo csrf_field(); ?>
                                                <div class="form-body">
                                                    
                                                    <div class="">
                                                        <div class="form-group row justify-content-md-center ">
                                                            <div class="col-md-4">
                                                                <label class="col-form-label" for="client_id"> Facebook client id</label>
                                                                <input type="text" value="<?php echo e(env('FACEBOOK_CLIENT_ID')); ?>" placeholder="Enter client id" name="types[FACEBOOK_CLIENT_ID]" id="client_id" class="form-control" >
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="col-form-label" for="client_secret">Facebook client secret</label>
                                                                <input type="text" value="<?php echo e(env('FACEBOOK_CLIENT_SECRET')); ?>" placeholder="Enter client secret" name="types[FACEBOOK_CLIENT_SECRET]" id="client_secret" class="form-control" >
                                                            </div>
                                                        </div>
                                                            
                                                    </div><hr>
                                                    <div class="form-actions pull-right">
                                                        <button type="submit" name="activeTap" value="facebook" class="btn btn-success"> <i class="fa fa-save"></i> Update facebook setting</button>
                                                       
                                                        <button type="reset" class="btn waves-effect waves-light btn-secondary">Reset</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="tab-pane <?php if(Session::get('activeTap') == 'google'): ?> active <?php endif; ?> " id="google" role="tabpanel">
                                        <div class="p-20">
                                            <form action="<?php echo e(route('env_key_update')); ?>"  method="post" data-parsley-validate>
                                                <?php echo csrf_field(); ?>
                                                <div class="form-body">
                                                    
                                                    <div class="">
                                                        <div class="form-group row justify-content-md-center ">
                                                            <div class="col-md-4">
                                                                <label class="col-form-label" for="client_id"> Google client id</label>
                                                                <input type="text" value="<?php echo e(env('GOOGLE_CLIENT_ID')); ?>" placeholder="Enter client id" name="types[GOOGLE_CLIENT_ID]" id="client_id" class="form-control" >
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="col-form-label" for="client_secret">Google client secret</label>
                                                                <input type="text" value="<?php echo e(env('GOOGLE_CLIENT_SECRET')); ?>" placeholder="Enter client secret" name="types[GOOGLE_CLIENT_SECRET]" id="client_secret" class="form-control" >
                                                            </div>
                                                        </div>
                                                            
                                                    </div><hr>
                                                    <div class="form-actions pull-right">
                                                        <button type="submit" name="activeTap" value="google" class="btn btn-success"> <i class="fa fa-save"></i> Update google setting</button>
                                                       
                                                        <button type="reset" class="btn waves-effect waves-light btn-secondary">Reset</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="tab-pane <?php if(Session::get('activeTap') == 'twitter'): ?> active <?php endif; ?> " id="twitter" role="tabpanel">
                                        <div class="p-20">
                                            <form action="<?php echo e(route('env_key_update')); ?>"  method="post" data-parsley-validate>
                                                <?php echo csrf_field(); ?>
                                                <div class="form-body">
                                                    
                                                    <div class="">
                                                        <div class="form-group row justify-content-md-center ">
                                                            <div class="col-md-4">
                                                                <label class="col-form-label" for="client_id"> Twitter client id</label>
                                                                <input type="text" value="<?php echo e(env('TWITTER_CLIENT_ID')); ?>" placeholder="Enter client id" name="types[TWITTER_CLIENT_ID]" id="client_id" class="form-control" >
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="col-form-label" for="client_secret">Twitter client secret</label>
                                                                <input type="text" value="<?php echo e(env('TWITTER_CLIENT_SECRET')); ?>" placeholder="Enter client secret" name="types[TWITTER_CLIENT_SECRET]" id="client_secret" class="form-control" >
                                                            </div>
                                                            
                                                        </div>
                                                            
                                                    </div><hr>
                                                    <div class="form-actions pull-right">
                                                        <button type="submit" name="activeTap" value="twitter" class="btn btn-success"> <i class="fa fa-save"></i> Update facebook setting</button>
                                                       
                                                        <button type="reset" class="btn waves-effect waves-light btn-secondary">Reset</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/admin/setting/social-login.blade.php ENDPATH**/ ?>