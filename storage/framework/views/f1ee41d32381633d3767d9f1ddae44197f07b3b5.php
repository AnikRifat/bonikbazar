
<?php $__env->startSection('title', 'Membership request list'); ?>
<?php $__env->startSection('css'); ?>

    <style type="text/css">
    table{
        table-layout: auto;
        text-wrap:nowrap;
    }
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
                    <h4 class="text-themecolor">Membership request List</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">

                        <!-- <button data-toggle="modal" data-target="#add" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
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
                <div class="col-12">

                    <div class="card ">
                        <div class="card-body">
                            <div class="table-responsive overflow-auto">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Info</th>
                                            <th>Membership</th>
                                            <th>NID</th>
                                            <th>Trade license</th>
                                            <th>Date</th>
                                            <th>Duration</th>
                                            <th>Amount</th>
                                            <th>Payment</th>
                                            <th>User Status</th>
                                            <th>Invoice</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $sellerMemberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr id="item<?php echo e($customer->id); ?>">
                                                <td><?php echo e($sellerMemberships->perPage() * $sellerMemberships->currentPage() - $sellerMemberships->perPage() + ($index + 1)); ?>

                                                </td>

                                                <td>
                                                    <?php if($customer->user): ?>
                                                        <a title="View Profile"
                                                            href="<?php echo e(route('customer.profile', $customer->user->username)); ?>">
                                                            <?php echo e($customer->user->name); ?></a> <br />
                                                        <?php echo e($customer->user->mobile); ?> <br /> <?php echo e($customer->user->email); ?>

                                                    <?php else: ?>
                                                        User not found.
                                                    <?php endif; ?>
                                                </td>

                                                <td><?php echo e(str_replace('-', ' ', ucfirst($customer->membership))); ?> </td>


                                                <td>
                                                    <a class="popup-gallery"
                                                        href="<?php echo e(asset('upload/users/' . $customer->sellerVerify->nid_front)); ?>"><img
                                                            width="50"
                                                            src="<?php echo e(asset('upload/users/' . $customer->sellerVerify->nid_front)); ?>"></a>
                                                    <a class="popup-gallery"
                                                        href="<?php echo e(asset('upload/users/' . $customer->sellerVerify->nid_back)); ?>"><img
                                                            width="50"
                                                            src="<?php echo e(asset('upload/users/' . $customer->sellerVerify->nid_back)); ?>"></a>
                                                </td>
                                                <td>
                                                    <?php if($customer->sellerVerify->trade_license): ?>
                                                        <a class="popup-gallery"
                                                            href="<?php echo e(asset('upload/users/' . $customer->sellerVerify->trade_license)); ?>"><img
                                                                width="50"
                                                                src="<?php echo e(asset('upload/users/' . $customer->sellerVerify->trade_license)); ?>"></a>
                                                    <?php endif; ?>
                                                    <?php if($customer->sellerVerify->trade_license2): ?>
                                                        <a class="popup-gallery"
                                                            href="<?php echo e(asset('upload/users/' . $customer->sellerVerify->trade_license2)); ?>"><img
                                                                width="50"
                                                                src="<?php echo e(asset('upload/users/' . $customer->sellerVerify->trade_license2)); ?>"></a>
                                                    <?php endif; ?>

                                                    <?php if($customer->sellerVerify->trade_license3): ?>
                                                        <a class="popup-gallery"
                                                            href="<?php echo e(asset('upload/users/' . $customer->sellerVerify->trade_license3)); ?>"><img
                                                                width="50"
                                                                src="<?php echo e(asset('upload/users/' . $customer->sellerVerify->trade_license3)); ?>"></a>
                                                    <?php endif; ?>

                                                </td>


                                                <td>Start:
                                                    <?php echo e(Carbon\Carbon::parse($customer->start_date)->format('d M, Y')); ?>

                                                    <br />
                                                    End: <?php echo e(Carbon\Carbon::parse($customer->end_date)->format('d M, Y')); ?>

                                                </td>
                                                <td><?php echo e($customer->duration); ?> Month</td>
                                                <td><?php echo e(config('siteSetting.currency_symble') . $customer->amount); ?></td>
                                                <td><?php echo e($customer->payment_method); ?>

                                                    <?php if($customer->tnx_id): ?>
                                                        <br><?php echo e($customer->tnx_id); ?>

                                                        <br><?php echo e($customer->payment_info); ?>

                                                    <?php endif; ?>
                                                </td>




                                                <td>
                                                    <?php if($customer->sellerVerify->status == 'active'): ?>
                                                        <span style="color:green"> User Verified </span>
                                                    <?php else: ?>
                                                        <span style="color:red"> User Not Verified
                                                    <?php endif; ?> </span>
                                                </td>
                                                <td><a href="<?php echo e(route('admin.membershipInvoice', $customer->id)); ?>"><i
                                                            class="fa fa-print"> Invoice </a></td>
                                                <td style="cursor:pointer;" onclick="customerStatus(<?php echo e($customer->id); ?>)">
                                                    <?php if($customer->status == 'active'): ?>
                                                        <span class="label label-success"> Active </span>
                                                    <?php else: ?>
                                                        <span class="label label-danger"><?php echo e($customer->status); ?></span>
                                                    <?php endif; ?>
                                                </td>

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
                    <?php echo e($sellerMemberships->appends(request()->query())->links()); ?>

                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing <?php echo e($sellerMemberships->firstItem()); ?> to
                    <?php echo e($sellerMemberships->lastItem()); ?> of total <?php echo e($sellerMemberships->total()); ?> entries
                    (<?php echo e($sellerMemberships->lastPage()); ?> Pages)</div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->

        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>

    <div class="modal fade" id="customerStatus_modal" role="dialog" tabindex="-1" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Membership request Status</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body form-row">
                    <div class="card-body">

                        <div class="form-body">
                            <form action="<?php echo e(route('membershipRequestUpdate')); ?>" method="POST">
                                <?php echo e(csrf_field()); ?>

                                <div id="verify_form">
                                    <input type="hidden" name="id" value="" id="request_id">
                                    <div class="form-group">
                                        <label>Request Status</label>
                                        <select required onchange="requestStatus(this.value)" name="status"
                                            class="form-control">
                                            <option value="">Select Status</option>
                                            <option value="active">Active</option>
                                            <option value="reject">Reject</option>
                                        </select>
                                    </div>

                                    <div class="form-group" id="bandReason"></div>


                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="submit" value="add" class="btn btn-success"> <i
                                            class="fa fa-check"></i> Change Status</button>
                                    <button type="button" data-dismiss="modal" class="btn btn-inverse">Close</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

    <script type="text/javascript">
        function requestStatus(status) {
            if (status == 'reject') {
                $('#bandReason').html(
                    `<div class="form-group">

</div><div class="form-group"><label>Write reject reason</label><textarea name="reject_reason" class="form-control" placeholder="Write reject reason"></textarea></div>`
                    );
            } else {
                $('#bandReason').html('');
            }

        }

        function customerStatus(id) {
            $("#customerStatus_modal").modal("show");
            $("#request_id").val(id);
        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BonikBazar\bonikbazar\resources\views/admin/membership/membershipRequest.blade.php ENDPATH**/ ?>