
<?php $__env->startSection('title', 'Google Analytics & Adsense'); ?>
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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Google</a></li>
                            <li class="breadcrumb-item active">Analytics & Adsense</li>
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
                                <div class="title_head"> Google Analytics & Adsense </div>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active " data-toggle="tab" href="#analytics" role="tab"><span class="hidden-sm-up"><i class="ti-stats-up"></i></span> <span class="hidden-xs-down">Google Analytics & Adsense</span></a> </li>
                                   
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <div class="tab-pane  active " id="analytics" role="tabpanel">
                                        <div class="p-20">
                                            <form action="<?php echo e(route('googleSetting')); ?>" method="post" data-parsley-validate id="analytics">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="id" value="<?php echo e(config('siteSetting.id')); ?>">
                                                <div class="form-body">
                                                    <div class="">
                                                        <div class="form-group row">
                                                            <label class="col-md-2 text-right col-form-label" for="google_analytics">Google analytics</label>
                                                            <div class="col-md-8">
                                                                <textarea rows="5" placeholder="Enter google analytics" name="google_analytics" id="google_analytics" class="form-control" ><?php echo config('siteSetting.google_analytics'); ?></textarea>
                                                            </div> 
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-2 text-right col-form-label" for="google_adsense">Google Adsense</label>
                                                            <div class="col-md-8">
                                                                <textarea rows="5" placeholder="Enter google adsense" name="google_adsense" id="google_adsense" class="form-control"><?php echo config('siteSetting.google_adsense'); ?></textarea>
                                                            </div>
                                                        </div>
                                                            
                                                    </div><hr>
                                                    <div class="form-actions pull-right">
                                                        <button type="submit" name="googleSettingTab" value="analytics" class="btn btn-success"> <i class="fa fa-save"></i> Update Google Setting</button>
                                                       
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

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/admin/setting/google-config.blade.php ENDPATH**/ ?>