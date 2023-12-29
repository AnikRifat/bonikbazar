
<?php $__env->startSection('title', 'Invoice '); ?>
<?php $__env->startSection('css'); ?>
<style type="text/css">
    b, strong { font-weight: 700;}

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
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Invoice</h4>
                </div>
              
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
           
            <div class="container">
                <div class="card card-body printableArea" style="position: relative;">
                   
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="pull-left" style="float: left;">
                                <div style="width:160px; height: 55px;">
                                    <img style="height: 100%; width: 100%;" src="<?php echo e(asset('upload/images/logo/'.(Config::get('siteSetting.invoice_logo') ? Config::get('siteSetting.invoice_logo'): Config::get('siteSetting.logo')))); ?>" title="Home" alt="Logo">
                                </div>
                            </div>
                            <div class="pull-right text-right">
                                <address>
                                <?php echo e(Config::get('siteSetting.address')); ?><br/>
                                Phone: <?php echo e(Config::get('siteSetting.phone')); ?><br/>
                                Email: <?php echo e(Config::get('siteSetting.email')); ?>

                                </address>
                            </div>
                             <hr>
                        </div>
                       
                        <div class="col-md-12">

                            <div class="pull-left" style="float: left;max-width: 60%">
                                <address>
                                    <?php echo e($packages[0]->customer->name); ?>

                                    <?php if($packages[0]->customer->email): ?><br><?php echo e($packages[0]->customer->email); ?><?php endif; ?>
                                    <?php if($packages[0]->customer->mobile): ?><br><?php echo e($packages[0]->customer->mobile); ?><?php endif; ?>
                                   
                                </address>
                            </div>
                            <div class="pull-right text-right">
                                <address>
                                <strong>Invoice ID:</strong> #<?php echo e($packages[0]->order_id); ?> <br>
                                <b>Date:</b> <?php echo e(Carbon\Carbon::parse($packages[0]->order_date)->format('M d, Y')); ?><br>
                                <b>Payment Status:</b> <?php echo e(str_replace( '-', ' ',$packages[0]->payment_status)); ?>

                                
                                </address>
                            </div>
                        </div>
                       
                    </div>
                   
                    <div class="row">
                        <div class="col-md-12">
                           
                                <table class="table table-borders">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Package</th>
                                        <th>Duration</th>
                                        
                                        <th>Payment by</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total_amount = 0; ?>
                                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $total_amount = $total_amount+$package->price; ?>
                                        <tr>
                                            <td><?php echo e($index+1); ?></td>
                                           <td>
                                            <?php if($package->package_id == 'post_fee'): ?> Ad post fee <?php else: ?>
                                             <?php echo e($package->get_package->name); ?>

                                             <?php endif; ?>
                                            </td>
                                            <td><?php echo e($package->duration); ?> days</td>
                                            
                                            <td class ="payment-method"> 
                                                <?php echo e(str_replace( '-', ' ', $package->payment_method)); ?>

                                            </td>
                                            <td>
                                                <?php echo e($package->payment_status); ?> 
                                            </td>
                                            <td>
                                                <?php echo e(config("siteSetting.currency_symble").$package->price); ?>

                                            </td>
                                        </tr>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       <tr><td colspan="5" style="text-align: right;"><strong>Total</strong></td><td><?php echo e(config("siteSetting.currency_symble").$total_amount); ?></td></tr>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>

                    <p style="border: 1px dotted #979797;width: 100%;"></p>

                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="pull-left" style="float: left;">
                                <div style="width:160px; height: 55px;">
                                    <img style="height: 100%; width: 100%;" src="<?php echo e(asset('upload/images/logo/'.(Config::get('siteSetting.invoice_logo') ? Config::get('siteSetting.invoice_logo'): Config::get('siteSetting.logo')))); ?>" title="Home" alt="Logo">
                                </div>
                            </div>
                            <div class="pull-right text-right">
                                <address>
                                <?php echo e(Config::get('siteSetting.address')); ?><br/>
                                Phone: <?php echo e(Config::get('siteSetting.phone')); ?><br/>
                                Email: <?php echo e(Config::get('siteSetting.email')); ?>

                                </address>
                            </div>
                             <hr>
                        </div>
                       
                        <div class="col-md-12">

                            <div class="pull-left" style="float: left;max-width: 60%">
                                <address>
                                    <?php echo e($packages[0]->customer->name); ?>

                                    <?php if($packages[0]->customer->email): ?><br><?php echo e($packages[0]->customer->email); ?><?php endif; ?>
                                    <?php if($packages[0]->customer->mobile): ?><br><?php echo e($packages[0]->customer->mobile); ?><?php endif; ?>
                                   
                                </address>
                            </div>
                            <div class="pull-right text-right">
                                <address>
                                <strong>Invoice ID:</strong> #<?php echo e($packages[0]->order_id); ?> <br>
                                <b>Date:</b> <?php echo e(Carbon\Carbon::parse($packages[0]->order_date)->format('M d, Y')); ?><br>
                                <b>Payment Status:</b> <?php echo e(str_replace( '-', ' ',$packages[0]->payment_status)); ?>

                                
                                </address>
                            </div>
                        </div>
                       
                    </div>
                   
                    <div class="row">
                        <div class="col-md-12">
                           
                                <table class="table table-borders">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Package</th>
                                        <th>Duration</th>
                                        
                                        <th>Payment by</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total_amount = 0; ?>
                                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $total_amount = $total_amount+$package->price; ?>
                                        <tr>
                                            <td><?php echo e($index+1); ?></td>
                                           <td>
                                            <?php if($package->package_id == 'post_fee'): ?> Ad post fee <?php else: ?>
                                             <?php echo e($package->get_package->name); ?>

                                             <?php endif; ?>
                                            </td>
                                            <td><?php echo e($package->duration); ?> days</td>
                                            
                                            <td class ="payment-method"> 
                                                <?php echo e(str_replace( '-', ' ', $package->payment_method)); ?>

                                            </td>
                                            <td>
                                                <?php echo e($package->payment_status); ?> 
                                            </td>
                                            <td>
                                                <?php echo e(config("siteSetting.currency_symble"). $package->price); ?>

                                            </td>
                                        </tr>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       <tr><td colspan="5" style="text-align: right;"><strong>Total</strong></td><td><?php echo e(config("siteSetting.currency_symble").$total_amount); ?></td></tr>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
                <div class="text-right no-print">
                  
                    <button id="print" class="btn btn-success btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                   
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
    <script src="<?php echo e(asset('js/pages/jquery.PrintArea.js')); ?>" type="text/JavaScript"></script>
    <script>
    $(document).ready(function() {
        $("#print").click(function() {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableArea").printArea(options);
        });
    });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/admin/package/invoice.blade.php ENDPATH**/ ?>