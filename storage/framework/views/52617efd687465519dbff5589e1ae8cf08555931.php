
<?php $__env->startSection('title', 'Affiliate Sellers'); ?>

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
                    <h4 class="text-themecolor">Affiliate Sellers List</h4>
                </div>
                
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="margin-bottom: 2px;">

                        <form action="" method="get">

                            <div class="form-body">
                                <div class="card-body">
                                    <div class="row">
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">User</label>
                                                <input type="text" value="<?php echo e(Request::get('user')); ?>" placeholder="User name or Id" name="user" class="form-control">
                                           </div>
                                        </div>

                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label class="control-label">From Date</label>
                                                <input name="from_date" value="<?php echo e(Request::get('from_date')); ?>" type="date" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label class="control-label">End Date</label>
                                                <input name="end_date" value="<?php echo e(Request::get('end_date')); ?>" type="date" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                            <div class="form-group">
                                               .
                                               <button type="submit" class="form-control btn btn-success"><i style="color:#fff; font-size: 20px;" class="ti-search"></i> </button>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <div class="card ">
                        <div class="card-body">
                           
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Seller Info</th>
                                            <th>Membership</th>
                                            <th>Amount</th>
                                            <th>Discount</th>
                                            <th>Address</th>
                                            <th>Payment</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr id="item<?php echo e($customer->id); ?>">
                                            <td><?php echo e((($customers->perPage() * $customers->currentPage() - $customers->perPage()) + ($index+1) )); ?></td>
                                            <td>
                                                <?php echo e(Carbon\Carbon::parse($customer->created_at)->format("d M, Y")); ?>

                                            </td>
                                            <td>
                                                <?php if($customer->username): ?>
                                                <a title="View Profile" href="<?php echo e(route('customer.profile', $customer->username)); ?>"> 
                                                <?php echo e($customer->shop_name); ?>

                                                </a> <br>
                                                User ID: <?php echo e($customer->user_id); ?> <br>
                                                <?php echo e($customer->mobile); ?> <br/> <?php echo e($customer->email); ?>

                                                <?php else: ?>
                                                User Not Found. <?php endif; ?>
                                            </td> 
                                            <td><?php echo e(str_replace("-", " ", $customer->membership)); ?> 
                                            </td>
                                            <td><?php echo e(config('siteSetting.currency_symble') . $customer->amount); ?></td>
                                            <td><?php echo e(config('siteSetting.currency_symble') . $customer->referAmount); ?></td>
                                         
                                            <td> <?php echo e($customer->address); ?> <?php if($customer->get_city): ?>, <?php echo e($customer->get_city->name); ?> <?php endif; ?> <?php if($customer->get_state): ?>, <?php echo e($customer->get_state->name); ?> <?php endif; ?></td>
                                            
                                            <td> <?php if( $customer->sellerMembership->payment_status == 'paid'): ?> <span style="color:green"> Paid </span> <?php else: ?> <span style="color:red">Unpaid</span> <?php endif; ?></td>

                                            <td> <?php if($customer->status == 'active'): ?> <span style="color:green"> Verified </span> <?php else: ?> <span style="color:red"><?php echo e($customer->status); ?></span> <?php endif; ?></td>
                                           
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
               <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                   <?php echo e($customers->appends(request()->query())->links()); ?>

                  </div>
                <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing <?php echo e($customers->firstItem()); ?> to <?php echo e($customers->lastItem()); ?> of total <?php echo e($customers->total()); ?> entries (<?php echo e($customers->lastPage()); ?> Pages)</div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->

        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
 

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/admin/affiliate/affiliate-sellers.blade.php ENDPATH**/ ?>