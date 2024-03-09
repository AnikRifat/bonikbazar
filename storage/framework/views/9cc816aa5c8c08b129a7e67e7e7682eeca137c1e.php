
<?php $__env->startSection('title', 'Add Setting'); ?>
<?php $__env->startSection('css-top'); ?>
    <link href="<?php echo e(asset('assets')); ?>/node_modules/jquery-asColorPicker-master/dist/css/asColorPicker.css" rel="stylesheet"
        type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

    <link href="<?php echo e(asset('css')); ?>/pages/tab-page.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        #addSetting input,
        #addSetting textarea {
            color: #797878 !important
        }

        .asColorPicker_open {
            z-index: 9999999;
            border: 1px solid #ccc;
        }
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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Add</a></li>
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
                            <div class="title_head"> Add Setting </div>
                            <h6 class="card-subtitle">Set the basic configuration settings for your site.</h6>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"> <a class="nav-link  active" data-toggle="tab" href="#addSetting"
                                        role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span
                                            class="hidden-xs-down">Link Adds</span></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content tabcontent-border">
                                <div class="tab-pane active" id="addSetting" role="tabpanel">
                                    <div class="p-20">
                                        <form action="<?php echo e(isset($setting->id) ? route('addSettingUpdate', ['id' => $setting->id]) : route('addSettingUpdate', ['id' => 0])); ?>" method="post">
                                            <?php echo csrf_field(); ?>
                                        <div class="form-body">

                                            <input type="hidden" name="type" value="2">

                                            <div class="">
                                                <div class="form-group row">
                                                    <label class="col-md-3 text-right col-form-label" for="price">Desktop
                                                        Banner Price</label>
                                                    <div class="col-md-3">
                                                        <input type="text" placeholder="Enter Desktop Banner Price" value="<?php echo e($setting->price??""); ?>"
                                                            name="price" id="price" class="form-control">
                                                    </div>


                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 text-right col-form-label"
                                                        for="sideAdPrice">(Side View) Banner Price</label>
                                                    <div class="col-md-3">
                                                        <input type="text" placeholder="Enter Side View Banner Price"
                                                            name="side_bn_price" value="<?php echo e($setting->side_bn_price??""); ?>" id="sideAdPrice" class="form-control">
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-md-3 text-right col-form-label"
                                                        for="mobileBannerPrice">Mobile Banner Price</label>
                                                    <div class="col-md-3">
                                                        <input type="text" placeholder="Enter Mobile Banner Price"
                                                            name="mob_bn_price" value="<?php echo e($setting->mob_bn_price??""); ?>" id="mobileBannerPrice" class="form-control">
                                                    </div>
                                                </div>



                                            </div>
                                            <hr>
                                            <div class="form-actions pull-right ml-5">
                                                <button type="submit" name="updateTab" value="addSetting"
                                                    class="btn btn-success"> <i class="fa fa-save"></i> Update Add
                                                    Setting</button>

                                                <button type="reset"
                                                    class="btn waves-effect waves-light btn-secondary">Reset</button>
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

<?php $__env->startSection('js'); ?>


    <!-- Color Picker Plugin JavaScript -->
    <script src="<?php echo e(asset('assets')); ?>/node_modules/jquery-asColor/dist/jquery-asColor.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>

    <script>
        $(".gradient-colorpicker").asColorPicker({
            mode: 'gradient'
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BonikBazar\bonikbazar\resources\views/admin/setting/add-setting.blade.php ENDPATH**/ ?>