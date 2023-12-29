
<?php $__env->startSection('title', 'Product Attribute list'); ?>
<?php $__env->startSection('css-top'); ?>
    <link href="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">

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
                    <h4 class="text-themecolor">Product Attribute List</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Product Attribute</a></li>
                            <li class="breadcrumb-item active">list</li>
                        </ol>
                        <?php if($permission['is_add']): ?>
                        <button data-toggle="modal" data-target="#add" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Add Attribute</button><?php endif; ?>
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
                                <table id="myTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Attribute Name</th>
                                            <th>Categories</th>
                                            <th>Is Display</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $get_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr id="item<?php echo e($data->id); ?>">
                                            <td><?php echo e($data->name); ?></td>
                                            <td><?php echo e(($data->get_category) ? $data->get_category->name : 'All Category'); ?></td>
                                           
                                            <td><?php if($data->display_type == 1): ?> Checkbox <?php elseif($data->display_type == 2): ?> Select <?php elseif($data->display_type == 3): ?> Radio <?php elseif($data->display_type == 4): ?> Dropdown <?php endif; ?>
                                            </td>
                                            <td><?php echo ($data->status == 1) ? "<span class='label label-info'>Active</span>" : '<span class="label label-danger">Deactive</span>'; ?>

                                            </td>
                                            <td>
                                                <?php if($permission['is_edit']): ?>
                                                <a href="<?php echo e(route('productAttributeValue', $data->slug)); ?>"  class="btn btn-success btn-sm"><i class="ti-eye" aria-hidden="true"></i> View</a>

                                                <button type="button" onclick="setValue('<?php echo e($data->id); ?>')"  data-toggle="modal" data-target="#setValue" class="btn btn-primary btn-sm"><i class="ti-plus" aria-hidden="true"></i> Set Value</button>
                                                <button type="button" onclick="edit('<?php echo e($data->id); ?>')"  data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> Edit</button><?php endif; ?>
                                                <?php if($permission['is_delete']): ?>
                                                <?php if($data->is_default != 1): ?>
                                                <button data-target="#delete" onclick="deleteConfirmPopup('<?php echo e(route("productAttribute.delete", $data->id)); ?>')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> Delete</button>
                                                <?php endif; ?>
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
    <div class="modal fade" id="add" style="display: none;">
        <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Product Attribute</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="<?php echo e(route('productAttribute.store')); ?>" enctype="multipart/form-data" method="POST">
                    <?php echo e(csrf_field()); ?>

                    <div class="modal-body form-row">

                        <div class="card-body">

                                <div class="form-body">

                                    <div class="row justify-content-md-center">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Product Attribute Name</label>
                                                <input  name="name" id="name" value="<?php echo e(old('name')); ?>" required="" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row justify-content-md-center">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Select Categroy</label>
                                                <select  required name="category_id" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                    <option value="all">All Category</option>
                                                    <?php $__currentLoopData = $get_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(Session::get('autoSelectId') == $category->id): ?> selected <?php endif; ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                                        <!-- get subcategory -->
                                                        <?php if(count($category->get_subcategory)>0): ?>
                                                       
                                                            <?php $__currentLoopData = $category->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                                <option <?php if(Session::get('autoSelectId') == $subcategory->id): ?> selected <?php endif; ?> value="<?php echo e($subcategory->id); ?>">--<?php echo e($subcategory->name); ?></option>

                                                                <!-- get sub childcategory -->
                                                                <?php if(count($subcategory->get_subcategory)>0): ?>
                                                                 
                                                                    <?php $__currentLoopData = $subcategory->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subchildcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                                        <option <?php if(Session::get('autoSelectId') == $subchildcategory->id): ?> selected <?php endif; ?> value="<?php echo e($subchildcategory->id); ?>"> &nbsp;---<?php echo e($subchildcategory->name); ?></option>

                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                
                                                                <?php endif; ?>
                                                                <!-- end sub childcatgory -->
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                          
                                                        <?php endif; ?>
                                                        <!-- end subcategory -->
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="row">

                                        <div class="col-md-6" >
                                            <span>Select display type</span>
                                            <div class="row form-group">
                                                <div class="custom-control custom-radio">
                                                    <input name="display_type" value="1" type="radio" id="flat" class="custom-control-input">
                                                    <label class="custom-control-label" for="flat">Checkbox</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input name="display_type" value="2" type="radio" id="select" class="custom-control-input">
                                                    <label class="custom-control-label" for="select">Select</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input value="3" type="radio" id="radio" name="display_type" class="custom-control-input">
                                                    <label class="custom-control-label" for="radio">Radio</label>
                                                </div>

                                                <div class="custom-control custom-radio">
                                                    <input value="4" type="radio" id="dropdown" name="display_type" class="custom-control-input">
                                                    <label class="custom-control-label" for="dropdown">Dropdown</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <span>Field is requird</span>
                                            <div class="form-group">
                                                <input  name="is_required" id="is_required" type="checkbox" > <label for="is_required"> Yes/No</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <span>Show in filter</span>
                                            <div class="form-group">
                                                <input  name="is_filter" id="filter" type="checkbox"> <label for="filter"> Yes/No </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-12">
                                           <span class="switch-box">Status</span>
                                            <div class="head-label">

                                                <div  class="status-btn" >
                                                    <div class="custom-control custom-switch">
                                                        <input name="status" checked  type="checkbox" class="custom-control-input" <?php echo e((old('status') == 'on') ? 'checked' : ''); ?> id="status">
                                                        <label  class="custom-control-label" for="status">Publish/UnPublish</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                     <div class="modal-footer">
                        <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                        <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- set attribute Modal -->
    <div class="modal fade" id="setValue" style="display: none;">
        <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Set Attribute Value</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="<?php echo e(route('productAttributeValue.store')); ?>"  method="POST">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" value="" id="setValueId" name="attribute_id">
                    <div class="modal-body form-row">

                        <div class="card-body">

                                <div class="form-body">

                                    <div class="row justify-content-md-center">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="valuename">Attribute Value Name</label>
                                                <input  name="name" id="valuename" value="<?php echo e(old('name')); ?>" required="" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row justify-content-md-center">
                                        <div class="col-md-12">
                                            <span>Status</span>
                                            <div class="head-label">

                                                <div  class="status-btn" >
                                                    <div class="custom-control custom-switch">
                                                        <input name="status" checked  type="checkbox" class="custom-control-input" <?php echo e((old('status') == 'on') ? 'checked' : ''); ?> id="status">
                                                        <label  class="custom-control-label" for="status">Publish/UnPublish</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                     <div class="modal-footer">
                        <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                        <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- update Modal -->
    <div class="modal fade" id="edit" role="dialog"   style="display: none;">
        <div class="modal-dialog">
            <form action="<?php echo e(route('productAttribute.update')); ?>"  enctype="multipart/form-data" method="post">
                  <?php echo e(csrf_field()); ?>

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Product Attribute</h4>
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
    <script src="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <!-- This is data table -->
    <script src="<?php echo e(asset('assets')); ?>/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
   <script>
        $(".select2").select2();
        $(function () {
            $('#myTable').DataTable();
        });

        function setValue(id){
            document.getElementById('setValueId').value = id;
        }
    </script>

    <script type="text/javascript">

        function edit(id){
            $('#edit_form').html('<div class="loadingData"></div>');
            var  url = '<?php echo e(route("productAttribute.edit", ":id")); ?>';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $("#edit_form").html(data);
                         $(".select2").select2();
                    }
                },
                // $ID Error display id name
                <?php echo $__env->make('common.ajaxError', ['ID' => 'edit_form'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            });

        }

</script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/admin/category/product-attribute.blade.php ENDPATH**/ ?>