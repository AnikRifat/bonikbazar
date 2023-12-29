
<?php $__env->startSection('title', 'SMTP configuration'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css')); ?>/pages/tab-page.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        #generalSetting input, #generalSetting textarea{color: #797878!important}
    </style>
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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">SMTP</a></li>
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
                                <div class="title_head"> SMTP Configuration </div>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"> <a class="nav-link <?php if(!Session::get('activeTap')): ?> active <?php endif; ?> <?php if(Session::get('activeTap') == 'smtp'): ?> active <?php endif; ?>" data-toggle="tab" href="#smtp" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">SMTP Configure</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link <?php if(Session::get('activeTap') == 'mailgun'): ?> active <?php endif; ?>" data-toggle="tab" href="#mailgun" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Mailgun Configure </span></a> </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <div class="tab-pane <?php if(!Session::get('activeTap')): ?> active <?php endif; ?> <?php if(Session::get('activeTap') == 'smtp'): ?> active <?php endif; ?>" id="smtp" role="tabpanel">
                                        <div class="p-20">
                                        <form class="form-horizontal" action="<?php echo e(route('env_key_update')); ?>" method="POST">
						                    <?php echo csrf_field(); ?>
						                    <input type="hidden" name="types[MAIL_DRIVER]" value="smtp">
						                    
					                        <div class="row justify-content-md-center ">
					                            <div class="col-md-5">
					                            	<div class="form-group">
					                            	<label class="control-label">MAIL HOST</label>
					                                <input type="text" class="form-control" name="types[MAIL_HOST]" value="<?php echo e(env('MAIL_HOST')); ?>" placeholder="Exm: smtp.mailtrap.io">
					                            	</div>
					                            </div>
					                       
					                            <div class="col-md-5 form-group">
					                            	<label class="control-label">MAIL PORT</label>
					                                <input type="text" class="form-control" name="types[MAIL_PORT]" value="<?php echo e(env('MAIL_PORT')); ?>" placeholder="Exm: 2525">
					                            </div>
					                        
					                            <div class="col-md-5 form-group">
					                            	 <label class="control-label">MAIL USERNAME</label>
					                                <input type="text" class="form-control" name="types[MAIL_USERNAME]" value="<?php echo e(env('MAIL_USERNAME')); ?>" placeholder="Enter mail username">
					                            </div>
					                       
					                            <div class="col-md-5 form-group">
					                            	<label class="control-label">MAIL PASSWORD</label>
					                                <input type="text" class="form-control" name="types[MAIL_PASSWORD]" value="<?php echo e(env('MAIL_PASSWORD')); ?>" placeholder="Enter mail password">
					                            </div>
					                       
					                            <div class="col-md-3 form-group">
					                            	<label class="control-label">MAIL ENCRYPTION</label>
					                                <input type="text" class="form-control" name="types[MAIL_ENCRYPTION]" value="<?php echo e(env('MAIL_ENCRYPTION')); ?>" placeholder="Exm: ssl ">
					                            </div>
					                        
					                            
					                            <div class="col-md-3 form-group">
					                            	<label class="control-label">MAIL FROM ADDRESS</label>
					                                <input type="text" class="form-control" name="types[MAIL_FROM_ADDRESS]" value="<?php echo e(env('MAIL_FROM_ADDRESS')); ?>" placeholder="Exm: info@gmail.com">
					                            </div>
					                       
					                            <div class="col-md-4 form-group">
					                            	<label class="control-label">MAIL FROM NAME</label>
					                                <input type="text" class="form-control" name="types[MAIL_FROM_NAME]" value="<?php echo e(env('MAIL_FROM_NAME')); ?>" placeholder="Exm: <?php echo e(url('/')); ?>">
					                            </div>
					                        </div>
						                    <div class="col-md-10">
						                       <div class="modal-footer pull-right">
                                                    <button type="submit" name="activeTap" value="smtp" class="btn btn-success"> <i class="fa fa-save"></i> Update smtp setting</button>
                                                   
                                                    <button type="reset" class="btn waves-effect waves-light btn-secondary">Reset</button>
                                                </div>
						                    </div>
						                </form>
                                        </div>
                                    </div>

                                    <div class="tab-pane <?php if(Session::get('activeTap') == 'mailgun'): ?> active <?php endif; ?>" id="mailgun" role="tabpanel">
                                        <div class="p-20">
                                        <form class="form-horizontal" action="<?php echo e(route('env_key_update')); ?>" method="POST">
						                    <?php echo csrf_field(); ?>
						                    <input type="hidden" name="types[MAIL_DRIVER]" value="mailgun">
						                    
					                        <div class="row justify-content-md-center ">
					                            <div class="col-md-5">
					                            	<div class="form-group">
					                            	<label class="control-label">MAILGUN DOMAIN</label>
					                                <input type="text" class="form-control" name="types[MAILGUN_DOMAIN]" value="<?php echo e(env('MAILGUN_DOMAIN')); ?>" placeholder="Enter mailgun donain">
					                            	</div>
					                            </div>
					                            <div class="col-md-5">
					                            	<div class="form-group">
					                            	<label class="control-label">MAILGUN SECRET</label>
					                                <input type="text" class="form-control" name="types[MAILGUN_SECRET]" value="<?php echo e(env('MAILGUN_SECRET')); ?>" placeholder="Enter mailgun secret">
					                            	</div>
					                            </div>
					                        </div>
						                    
						                    
					                       <div class="modal-footer pull-right">
                                                <button type="submit" name="activeTap" value="mailgun" class="btn btn-success"> <i class="fa fa-save"></i> Update mailgun setting</button>
                                               
                                                <button type="reset" class="btn waves-effect waves-light btn-secondary">Reset</button>
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

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/admin/setting/smtp_setting.blade.php ENDPATH**/ ?>