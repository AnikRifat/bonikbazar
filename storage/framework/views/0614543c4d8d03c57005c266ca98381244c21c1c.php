
<?php $__env->startSection('title', 'Brand Model list'); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <link href="<?php echo e(asset('assets/custom/tagify.css')); ?>" rel="stylesheet" type="text/css" />
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
                    <h4 class="text-themecolor"><?php echo e($brand->name); ?> Model List</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('brand')); ?>">Brand</a></li>
                            <li class="breadcrumb-item active">Model</li>
                        </ol>
                        <button data-toggle="modal" data-target="#add" class="btn btn-info d-none d-lg-block m-l-15"><i
                                class="fa fa-plus-circle"></i> Set New Model</button>
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
                            <a href="<?php echo e(route('brand')); ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> Brand
                                list</a>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Model</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $get_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr id="item<?php echo e($data->id); ?>">
                                                <td><?php echo e($data->name); ?></td>
                                                <td><?php echo $data->status == 1
                                                    ? "<span class='label label-info'>Active</span>"
                                                    : '<span class="label label-danger">Deactive</span>'; ?>

                                                </td>
                                                <td>
                                                    <button type="button" onclick="edit(<?php echo e($data); ?>)"
                                                        data-toggle="modal" data-target="#edit"
                                                        class="btn btn-info btn-sm"><i class="ti-pencil"
                                                            aria-hidden="true"></i> Edit</button>
                                                    <button data-target="#delete"
                                                        onclick="deleteConfirmPopup('<?php echo e(route('brandmodel.delete', $data->id)); ?>')"
                                                        class="btn btn-danger btn-sm" data-toggle="modal"><i
                                                            class="ti-trash" aria-hidden="true"></i> Delete</button>
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

    <!-- set attribute Modal -->
    <div class="modal fade" id="add" style="display: none;">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Set Brand Model</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="<?php echo e(route('model.store')); ?>" method="POST">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" value="" id="setBrandId" name="brand_id">
                    <div class="modal-body form-row">

                        <div class="card-body">

                            <div class="form-body">

                                <div class="row justify-content-md-center">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="hidden" value="<?php echo e($brand->id); ?>" name="brand_id">
                                            <label for="valuename">Model Name</label>

                                            <input name="model_name[]" type="text" id="model"
                                                value="<?php echo e(old('model_name[]')); ?>" data-role="tagsinput"
                                                placeholder="Add model" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-md-center">
                                    <div class="col-md-12">
                                        <span>Status</span>
                                        <div class="head-label">

                                            <div class="status-btn">
                                                <div class="custom-control custom-switch">
                                                    <input name="status" checked type="checkbox"
                                                        class="custom-control-input"
                                                        <?php echo e(old('status') == 'on' ? 'checked' : ''); ?> id="status">
                                                    <label class="custom-control-label"
                                                        for="status">Publish/UnPublish</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submit" value="add" class="btn btn-success"> <i
                                class="fa fa-check"></i> Save</button>
                        <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- update Modal -->
    <div class="modal fade" id="edit" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <form action="<?php echo e(route('brandmodel.update')); ?>" enctype="multipart/form-data" method="post">
                <?php echo e(csrf_field()); ?>


                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Model</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row" id="edit_form">

                        <input type="hidden" name="id" id="id">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="attribute">Model</label>
                                <input name="name" id="name" required="" type="text"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12 mb-12">
                            <div class="form-group">
                                <label class="switch-box">Status</label>

                                <div class="status-btn">
                                    <div class="custom-control custom-switch">
                                        <input name="status" type="checkbox" class="custom-control-input"
                                            id="status-edit">
                                        <label class="custom-control-label" for="status-edit">Publish/UnPublish</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
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
    <!-- This is data table -->
    <script src="<?php echo e(asset('assets')); ?>/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo e(asset('assets/custom/tagify.js')); ?>"></script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('form').on('keypress', function(e) {
                if (e.which === 13) {
                    e.preventDefault();
                    return false;
                }
            });
        });
        $(function() {
            $('#myTable').DataTable();

        });
    </script>

    <script>
        function edit(model) {
            $("#id").val(model.id);
            $("#name").val(model.name);
            if (model.status == 1) {
                $("#status-edit").prop("checked", true); // Check the checkbox
            } else {
                $("#status-edit").prop("checked", false); // Uncheck the checkbox
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\bonik_bazar_latest\bonikbazar\resources\views/admin/brand/brand_model.blade.php ENDPATH**/ ?>