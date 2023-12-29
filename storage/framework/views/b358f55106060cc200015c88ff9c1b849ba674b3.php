
<?php $__env->startSection('title', 'Search keywords list'); ?>

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
                    <h4 class="text-themecolor">Search keywords list</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Search keywords</a></li>
                            <li class="breadcrumb-item active">list</li>
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
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Keywords</th>
                                            <th>User IP</th>
                                            <th>Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        <?php $__currentLoopData = $search_keywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $search_keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr id="item<?php echo e($search_keyword->id); ?>">
                                            <td><?php echo e((($search_keywords->perPage() * $search_keywords->currentPage() - $search_keywords->perPage()) + ($index+1) )); ?></td>
                                            <td><?php echo e($search_keyword->keyword); ?></td>
                                            <td><?php echo e($search_keyword->user_ip_address); ?></td>
                                            <td><?php echo e(Carbon\Carbon::parse($search_keyword->created_at)->format("d M y, h:i a")); ?></td>
                                            <td>
                                                <button data-target="#delete" onclick="deleteConfirmPopup('<?php echo e(route("searchKeywordDelete", $search_keyword->id)); ?>')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> Delete</button>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <?php echo e($search_keywords->links()); ?>

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


    <!-- delete Modal -->
    <?php echo $__env->make('admin.modal.delete-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/admin/search_keywords.blade.php ENDPATH**/ ?>