
<?php $__env->startSection('title', 'Affiliate Discount'); ?>

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
                    <h4 class="text-themecolor">Affiliate Discount</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <button data-toggle="modal" data-target="#add" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Add New</button>
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
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Membership</th>
                                            <th>Month</th>
                                            <th>Discount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        <?php $__currentLoopData = $affiliates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr id="item<?php echo e($data->id); ?>">
                                            <td><?php echo e($index+1); ?></td>
                                            <td><?php echo e(($data->getMembership) ? $data->getMembership->name : "All"); ?></td>
                                            <td><?php echo e($data->month); ?> Month</td>
                                            <td><?php echo e($data->discount); ?>%</td>
                                            <td>
                                                <button type="button" onclick="affiliateEdit('<?php echo e($data->id); ?>')"  class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> Edit</button>
                                                <button title="delete" data-target="#delete" onclick="deleteConfirmPopup('<?php echo e(route("affiliateDiscountDelete", $data->id)); ?>')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i></button>
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
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->

        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- add Modal -->
    <div class="modal fade" id="add" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Affiliate Discount</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body form-row">
                    <div class="card-body">
                        <form action="<?php echo e(route('affiliateDiscountStore')); ?>" method="POST" >
                            <?php echo e(csrf_field()); ?>

                            <div class="form-body">
                                <!--/row-->
                                <div class="row justify-content-md-center">
                                    

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Membership</label>
                                            <select required name="membership" class="form-control">
                                                <option value="all">All membership</option>
                                                <?php $__currentLoopData = $memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($membership->slug); ?>"><?php echo e($membership->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Month</label>
                                            <select required name="month" class="form-control">
                                                <option value="">Select Month</option>
                                                <?php for($i=1; $i<=12; $i++): ?>
                                                <option value="<?php echo e($i); ?>"><?php echo e($i); ?> Month</option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="discount"> Discount(%)</label>
                                            <input  name="discount" required placeholder="Enter discount" id="discount" value="<?php echo e(old('discount')); ?>" type="number" class="form-control">
                                        </div>
                                    </div>
                                 
                                </div>
                         
                                <div class="row justify-content-md-center">
                                    <div class="col-md-12">
                                        
                                        <div class="modal-footer">
                                            <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Save discount</button>
                                            <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- update Modal -->
    <div class="modal fade" id="edit" style="display: none;">
        <div class="modal-dialog modal-sm">
            <form action="<?php echo e(route('affiliateDiscountUpdate')); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Affiliate Discount</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body form-row" id="edit_form"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-success">Update</button>
                </div>
            </div>
            </form>
        </div>
    </div>        

    <!-- delete Modal -->
    <?php echo $__env->make('admin.modal.delete-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <script type="text/javascript">

        function affiliateEdit(id){
            $('#edit').modal('show');
            $('#edit_form').html('<div class="loadingData"></div>');
            var  url = '<?php echo e(route("affiliateDiscountEdit", ":id")); ?>';
            url = url.replace(':id',id);
          
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $("#edit_form").html(data);
                    }
                },
              
            });
        } 
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/admin/affiliate/affiliate-discount.blade.php ENDPATH**/ ?>