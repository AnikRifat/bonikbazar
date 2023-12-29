
<?php $__env->startSection('title', 'Logo Setting'); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />

    <style type="text/css">
        .dropify_image{
            position: absolute;top: -8px!important;left: 19px !important; z-index: 9; background:#fff!important;
        }.dropify-wrapper{height: 150px}
        .info{color: red;font-size: 12px;}
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                
                    <div class="col-md-12 align-self-center ">
                        <div class="d-fl ">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">General</a></li>
                                <li class="breadcrumb-item ">Setting</li>
                                <li class="breadcrumb-item active">Logo</li>
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
                        <div class="card card-body">
                            <div class="title_head"> Set Logo </div>
                            <form action="<?php echo e(route('logoSettingUpdate', $setting->id)); ?>" enctype="multipart/form-data" method="post" id="generalSetting">
                            <?php echo csrf_field(); ?>
                        
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group"> 
                                        <label class="dropify_image">Main Logo</label>
                                        <?php if($setting->logo): ?>
                                        <span class="imagelogo" >
                                            <div class="dropify-wrapper" onclick="removeImage('general_settings', 'logo', '1', 'logo')">
                                                <img src="<?php echo e(asset('upload/images/logo/'.$setting->logo)); ?>" style="width: 90%;height: 80%;">
                                                <span style="position: absolute;top: 0;right: 0; background: #fff;border: 1px solid #fff;padding: 3px;color: red;">Remove</span>
                                            </div>
                                        </span>
                                        <?php else: ?>
                                        <input type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg png gif"  data-max-file-size="5M"  name="logo" id="input-file-events"><?php endif; ?>
                                        <p class="info">Image size: 200px*50px</p>
                                    </div>
                                    <?php if($errors->has('logo')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <?php echo e($errors->first('logo')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group"> 
                                        <label class="dropify_image">Invoice Logo</label>
                                        <?php if($setting->invoice_logo): ?>
                                        <span class="imageinvoice_logo" >
                                            <div class="dropify-wrapper" onclick="removeImage('general_settings', 'invoice_logo', '1', 'invoice_logo')">
                                                <img src="<?php echo e(asset('upload/images/logo/'.$setting->invoice_logo)); ?>" style="width: 90%;height:80%;">
                                                <span style="position: absolute;top: 0;right: 0; background: #fff;border: 1px solid #fff;padding: 3px;color: red;">Remove</span>
                                            </div>
                                        </span>
                                        <?php else: ?>
                                        <input type="file" class="dropify" accept="image/*" data-type='image'  data-allowed-file-extensions="jpg png gif"  data-max-file-size="5M"  name="invoice_logo" id="input-file-events"><?php endif; ?>
                                        <p class="info">Image size: 200px*50px</p>
                                    </div>
                                    <?php if($errors->has('invoice_logo')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <?php echo e($errors->first('invoice_logo')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group"> 
                                        <label class="dropify_image">Favicon</label>
                                        <?php if($setting->favicon): ?>
                                        <span class="imagefavicon" >
                                            <div class="dropify-wrapper" onclick="removeImage('general_settings', 'favicon', '1', 'favicon')">
                                                <img src="<?php echo e(asset('upload/images/logo/'.$setting->favicon)); ?>" style="width: 50px;height: 50px;">
                                                <span style="position: absolute;top: 0;right: 0; background: #fff;border: 1px solid #fff;padding: 3px;color: red;">Remove</span>
                                            </div>
                                        </span>
                                        <?php else: ?>
                                        <input type="file" class="dropify" accept="image/*" data-type='image'data-allowed-file-extensions="jpg png gif"  data-max-file-size="5M"  name="favicon" id="input-file-events"><?php endif; ?>
                                        <p class="info">Image size: 32px*32px</p>
                                    </div>
                                    <?php if($errors->has('favicon')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <?php echo e($errors->first('favicon')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group"> 
                                        <label class="dropify_image">Watermark</label>
                                        <?php if($setting->watermark): ?>
                                        <span class="imagewatermark" >
                                        <div class="dropify-wrapper" onclick="removeImage('general_settings', 'watermark', '1', 'watermark')">
                                                <img src="<?php echo e(asset('upload/images/logo/'.$setting->watermark)); ?>" style="width: 80%;height: 60%;">
                                                <span style="position: absolute;top: 0;right: 0; background: #fff;border: 1px solid #fff;padding: 3px;color: red;">Remove</span>
                                            </div>
                                        </span>
                                        <?php else: ?>
                                        <input type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg png gif"  data-max-file-size="5M"  name="watermark" id="input-file-events"> <?php endif; ?>
                                        <p class="info">Image size: 350px*70px</p>
                                    </div>
                                    <?php if($errors->has('watermark')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <?php echo e($errors->first('watermark')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                    <div class="form-actions pull-right">
                                        <button type="submit"  name="submit" value="save" class="btn btn-success"> <i class="fa fa-save"></i> Update Logo</button>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
           
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/js/dropify.min.js"></script>
     <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();
    });

    function removeImage(table, field, id, imageNo){
            if ( confirm("Are you sure delete it.?")) {
                       
                $.ajax({
                    url:"<?php echo e(route('admin.imageDelete')); ?>",
                    method:"get",
                    data: {table:table, field:field, id:id},
                    success:function(data){
                        if(data){
                            $('.image'+imageNo).html('<input type="file" required accept="image/*" data-type="image" data-allowed-file-extensions="jpg jpeg png gif"  name="'+field+'" id="'+imageNo+'" class="dropify" />');
                            
                            $('.dropify').dropify();
                            toastr.success(data.msg);
                        }
                    }
                }); 
            }
            return false;
        }
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/admin/setting/logo.blade.php ENDPATH**/ ?>