
<?php $__env->startSection('title', 'Category list'); ?>

<?php $__env->startSection('css-top'); ?>
    <link href="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

    <style type="text/css">
        svg {
            width: 20px
        }

        .module_section {
            padding: 1px 15px;
            border-radius: 5px;
            /* background: #fff; */
            margin-bottom: 10px;
            list-style: none;
        }

        .panel-title {
            padding-left: 20px;
            background: #c7ecee;
        }

        .action_btn {
            margin-top: 5px;
        }

        .deactive_module {
            /* background-color: #e8dada9c; */
        }

        .panel-title>a,
        .panel-title>a:active {
            display: block;
            padding: 12px 0;
            color: #555;
            font-size: 14px;
            font-weight: bold;
        }

        .panel-heading a:after {
            padding-right: 7px !important;
            font-family: 'Font Awesome 5 Free';
            content: "\f107";
            float: left;
        }

        .panel-heading.active a:after {
            padding-left: 7px !important;
            -webkit-transform: rotate(180deg);
            -moz-transform: rotate(180deg);
            transform: rotate(180deg);
            padding-right: 0px !important;
        }

        .floating-labels label {
            position: relative;
            top: 0px;
            left: 0px;
        }
    </style>



    <link href="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets')); ?>/node_modules/bootstrap-switch/bootstrap-switch.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('css')); ?>/pages/bootstrap-switch.css" rel="stylesheet">
    <link href="<?php echo e(asset('assets')); ?>/node_modules/summernote/dist/summernote-bs4.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo e(asset('assets/custom/tagify.css')); ?>" rel="stylesheet" type="text/css" />

    <style type="text/css">
        .dropify_image {
            position: absolute;
            top: -12px !important;
            left: 12px !important;
            z-index: 9;
            background: #fff !important;
            padding: 3px;
        }

        .dropify-wrapper {
            height: 150px !important;
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
                    <h4 class="text-themecolor">Category List</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Category</a></li>
                            <li class="breadcrumb-item active">list</li>
                        </ol>
                        <?php if($permission['is_add']): ?>
                            <button data-toggle="modal" data-target="#add" class="btn btn-info d-none d-lg-block m-l-15"><i
                                    class="fa fa-plus-circle"></i> Create New</button>
                        <?php endif; ?>
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
                            <i class="drag-drop-info">Drag & drop sorting position</i>
                            <div class="table-responsive">
                                <table id="config-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category Name</th>
                                            <th>Feature Image</th>
                                            <th>Notes</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="categoryPositionSorting">
                                        <?php $__currentLoopData = $get_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr id="item<?php echo e($data->id); ?>">
                                                <td><?php echo e($index + 1); ?></td>
                                                <td><?php echo e($data->name); ?></td>
                                                <td><img src="<?php echo e(asset('upload/images/category/thumb/' . $data->image)); ?>"
                                                        width="50"></td>
                                                <td><?php echo e($data->notes); ?></td>

                                                <td>
                                                    <?php if($permission['is_edit']): ?>
                                                        <div class="custom-control custom-switch">
                                                            <input name="status"
                                                                onclick="satusActiveDeactive('categories', <?php echo e($data->id); ?>)"
                                                                type="checkbox" <?php echo e($data->status == 1 ? 'checked' : ''); ?>

                                                                type="checkbox" class="custom-control-input"
                                                                id="status<?php echo e($data->id); ?>">
                                                            <label style="padding: 5px 12px" class="custom-control-label"
                                                                for="status<?php echo e($data->id); ?>"></label>
                                                        </div>
                                                    <?php else: ?>
                                                        <label><?php echo e($data->status == 1 ? 'Active' : 'Deactive'); ?></label>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($permission['is_edit']): ?>
                                                        <button type="button" onclick="safetyTip('<?php echo e($data->id); ?>')"
                                                            class="btn btn-success btn-sm"><i class="ti-plus"
                                                                aria-hidden="true"></i> Safety Tip</button>

                                                        <button type="button"
                                                            onclick="getCategoryBanner('<?php echo e($data->slug); ?>')"
                                                            data-toggle="modal" data-target="#setBanner"
                                                            class="btn btn-success btn-sm"><i class="ti-plus"
                                                                aria-hidden="true"></i> Banner</button>

                                                        <button type="button"
                                                            onclick="category_edit('<?php echo e($data->id); ?>')"
                                                            class="btn btn-info btn-sm"><i class="ti-pencil"
                                                                aria-hidden="true"></i> Edit</button>
                                                    <?php endif; ?>
                                                    <?php if($permission['is_delete']): ?>
                                                        <button title="delete" data-target="#delete"
                                                            onclick="deleteConfirmPopup('<?php echo e(route('category.delete', $data->id)); ?>')"
                                                            class="btn btn-danger btn-sm" data-toggle="modal"><i
                                                                class="ti-trash" aria-hidden="true"></i></button>
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
    <div class="modal fade" id="add" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create category</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body form-row">
                    <div class="card-body">
                        <form id="categoryForm" action="<?php echo e(route('category.store')); ?>" enctype="multipart/form-data"
                            method="POST" class="floating-labels">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-body">
                                <!--/row-->

                                <div class="row justify-content-md-center">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Category Name</label>
                                            <input name="name" id="name" value="<?php echo e(old('name')); ?>"
                                                required="" type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="dropify_image">Feature Image</label>
                                            <input type="file" class="dropify" accept="image/*" data-type='image'
                                                data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="2M"
                                                name="phato" id="input-file-events">
                                        </div>
                                        <?php if($errors->has('phato')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <?php echo e($errors->first('phato')); ?>

                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label style="background: #fff;top:-10px;z-index: 1"
                                                for="notes">Details</label>
                                            <textarea name="notes" class="form-control" placeholder="Enter details" id="notes" rows="2"><?php echo e(old('notes')); ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="card ">
                                            <div class="card-body">

                                                <div class="panel-group" id="accordion2" role="tablist"
                                                    aria-multiselectable="true">
                                                    <ul id="sectionSositionSorting" data-table="modules"
                                                        style="padding: 0">
                                                        <li id="packageItem" class="module_section  deactive_module"
                                                            title="Deactive this section">
                                                            <div class="panel panel-default">
                                                                <div class="row panel-heading" role="tab">
                                                                    <div class="col-12">
                                                                        <h4 class="panel-title">
                                                                            <a role="button" data-toggle="collapse"
                                                                                data-parent="#accordion2"
                                                                                href="#packageSection"
                                                                                aria-expanded="true"
                                                                                aria-controls="packageSection"> Package
                                                                            </a>
                                                                        </h4>
                                                                    </div>

                                                                </div>

                                                                <div id="packageSection"
                                                                    class="panel-collapse collapse collapse show"
                                                                    role="tabpanel">
                                                                    <div class="panel-body">
                                                                        <div class="table-responsive"
                                                                            style="min-height:110px">
                                                                            <table id="tblPackage"
                                                                                class="table table-bordered table-striped">
                                                                                <thead style="text-wrap:nowrap;">
                                                                                    <tr>
                                                                                        <th>#</th>
                                                                                        <th>Package</th>
                                                                                        <th>Ads Duration</th>
                                                                                        <th>Price</th>
                                                                                        <th>status</th>
                                                                                        <th class="text-center">Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>

                                                                                    <tr>
                                                                                        <td>1</td>
                                                                                        <td>
                                                                                            <select required
                                                                                                name="package_id[]"
                                                                                                class="form-control custom-select select2"
                                                                                                style="width: 100%; height:36px;">
                                                                                                <?php $__currentLoopData = $package; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                    <option
                                                                                                        value="<?php echo e($data->id); ?>">
                                                                                                        <?php echo e($data->name); ?>

                                                                                                    </option>
                                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                            </select>
                                                                                        </td>
                                                                                        <td>

                                                                                            <input name="duration[]"
                                                                                                required
                                                                                                placeholder="Example: 7 Days"
                                                                                                value="<?php echo e(old('ads')); ?>"
                                                                                                class="form-control"
                                                                                                type="number">
                                                                                        </td>
                                                                                        <td>
                                                                                            <input name="price[]" required
                                                                                                placeholder="Example: <?php echo e(config('siteSetting.currency_symble')); ?>50 "
                                                                                                value="<?php echo e(old('price')); ?>"
                                                                                                class="form-control"
                                                                                                type="number">

                                                                                        </td>


                                                                                        <td>
                                                                                            <div
                                                                                                class="custom-control custom-switch">
                                                                                                <input
                                                                                                    name="package_status[]"
                                                                                                    type="checkbox"
                                                                                                    type="checkbox"
                                                                                                    class="custom-control-input"
                                                                                                    id="packageStatus">
                                                                                                <label
                                                                                                    style="padding: 5px 12px"
                                                                                                    class="custom-control-label"
                                                                                                    for="packageStatus"></label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td
                                                                                            class="text-nowrap text-center">
                                                                                            <a title="add"
                                                                                                class="btn btn-success btn-sm btnAdd"><i
                                                                                                    class="ti-plus"
                                                                                                    aria-hidden="true"></i></a>

                                                                                            <a title="delete"
                                                                                                class="btn btn-danger btn-sm text-white btnRemove"><i
                                                                                                    class="ti-trash"
                                                                                                    aria-hidden="true"></i></a>
                                                                                        </td>
                                                                                    </tr>


                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="panel-group" id="accordion" role="tablist"
                                                    aria-multiselectable="true">
                                                    <ul id="sectionSositionSorting" data-table="modules"
                                                        style="padding: 0">
                                                        <li id="attributeItem" class="module_section  deactive_module"
                                                            title="Deactive this section">
                                                            <div class="panel panel-default">
                                                                <div class="row panel-heading" role="tab">
                                                                    <div class="col-12">
                                                                        <h4 class="panel-title">
                                                                            <a role="button" data-toggle="collapse"
                                                                                data-parent="#accordion"
                                                                                href="#attributeSection"
                                                                                aria-expanded="true"
                                                                                aria-controls="attributeSection"> Product
                                                                                Attribute
                                                                            </a>
                                                                        </h4>
                                                                    </div>

                                                                </div>

                                                                <div id="attributeSection"
                                                                    class="panel-collapse collapse collapse show"
                                                                    role="tabpanel">
                                                                    <div class="panel-body">
                                                                        <div class="table-responsive"
                                                                            style="min-height:110px">
                                                                            <table id="tblAttribute"
                                                                                class="table table-bordered table-striped">
                                                                                <thead style="text-wrap:nowrap;">
                                                                                    <tr>
                                                                                        <th>#</th>
                                                                                        <th>Attribute Name</th>
                                                                                        <th style="width: 130px">Display
                                                                                            Type</th>
                                                                                        <th>Field is requird</th>
                                                                                        <th>Show in filter</th>
                                                                                        <th>Attribute Value</th>
                                                                                        <th>status</th>
                                                                                        <th class="text-center">Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>

                                                                                    <tr>
                                                                                        <td>1</td>
                                                                                        <td> <input name="attribute_name[]"
                                                                                                required=""
                                                                                                type="text"
                                                                                                class="form-control"></td>
                                                                                        <td>

                                                                                            <select required
                                                                                                name="display_type[]"
                                                                                                class="form-control form-control-sm custom-select"
                                                                                                style="width: 100%; height:36px;">
                                                                                                <option value="1">
                                                                                                    Checkbox</option>
                                                                                                <option value="2">
                                                                                                    Select</option>
                                                                                                <option value="3">
                                                                                                    Radio</option>
                                                                                                <option value="4">
                                                                                                    Dropdown</option>
                                                                                            </select>
                                                                                        </td>
                                                                                        <td><input name="is_required[]"
                                                                                                id="eeditis_required"
                                                                                                type="checkbox"> <label
                                                                                                for="eeditis_required">
                                                                                                Yes/No </label></td>
                                                                                        <td><input name="is_filter[]"
                                                                                                id="editfilter"
                                                                                                type="checkbox"> <label
                                                                                                for="editfilter">
                                                                                                Yes/No </label></td>
                                                                                        <td>

                                                                                            <input name="attribute_value[]"
                                                                                                type="text"
                                                                                                value=""
                                                                                                data-role="tagsinput"
                                                                                                placeholder="Add value" />



                                                                                        </td>

                                                                                        <td>
                                                                                            <div
                                                                                                class="custom-control custom-switch">
                                                                                                <input
                                                                                                    name="attribute_status[]"
                                                                                                    type="checkbox"
                                                                                                    type="checkbox"
                                                                                                    class="custom-control-input"
                                                                                                    id="attributeStatus">
                                                                                                <label
                                                                                                    style="padding: 5px 12px"
                                                                                                    class="custom-control-label"
                                                                                                    for="attributeStatus"></label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td class="text-nowrap">
                                                                                            <a href="javascript:void(0)"
                                                                                                title="add"
                                                                                                class="btn btn-success btn-sm btnAdd"><i
                                                                                                    class="ti-plus"
                                                                                                    aria-hidden="true"></i></a>

                                                                                            <a href="javascript:void(0)"
                                                                                                title="delete"
                                                                                                class="btn btn-danger btn-sm text-white btnRemove"><i
                                                                                                    class="ti-trash"
                                                                                                    aria-hidden="true"></i></a>
                                                                                        </td>
                                                                                    </tr>


                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12">
                                        <div class="head-label">
                                            <label class="switch-box">Status</label>
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
                                        <div class="modal-footer">
                                            <button type="submit" name="submit" value="add"
                                                class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                            <button type="button" data-dismiss="modal"
                                                class="btn btn-inverse">Cancel</button>
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
    <div class="modal fade" id="edit" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <form action="<?php echo e(route('category.update')); ?>" enctype="multipart/form-data" method="post">
                <?php echo e(csrf_field()); ?>

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update category</h4>
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


    <!-- safety tip Modal -->
    <div class="modal fade" id="safety_tip_modal" role="dialog" tabindex="-1" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <form action="<?php echo e(route('cat_safety_tip')); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Safety tip</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row">
                        <div class="form-body">
                            <div id="safety_tip">

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
    <!-- banner modal -->
    <?php echo $__env->make('admin.category.category-banner-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;


<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <!-- This is data table -->
    <script src="<?php echo e(asset('assets')); ?>/node_modules/jqueryui/jquery-ui.min.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/js/dropify.min.js"></script>
    <script>
        $(".select2").select2();
        $(document).ready(function() {
            // Basic
            $('.dropify').dropify();

        });
    </script>
    <!-- This is data table -->
    <script src="<?php echo e(asset('assets')); ?>/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>


    <script src="<?php echo e(asset('assets/custom/tagify.js')); ?>"></script>

    <!-- bt-switch -->
    <script src="<?php echo e(asset('assets')); ?>/node_modules/bootstrap-switch/bootstrap-switch.min.js"></script>
    <script type="text/javascript">
        $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
        var radioswitch = function() {
            var bt = function() {
                $(".radio-switch").on("switch-change", function() {
                    $(".radio-switch").bootstrapSwitch("toggleRadioState")
                }), $(".radio-switch").on("switch-change", function() {
                    $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
                }), $(".radio-switch").on("switch-change", function() {
                    $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
                })
            };
            return {
                init: function() {
                    bt()
                }
            }
        }();
        $(document).ready(function() {
            radioswitch.init()
        });
    </script>

    <script>
        //get safety_tip
        function safetyTip(id) {
            $('#safety_tip_modal').modal('show');
            $('#safety_tip').html('<div class="loadingData"></div>');
            var url = '<?php echo e(route('cat_safety_tip')); ?>';
            $.ajax({
                url: url,
                method: "get",
                data: {
                    id: id
                },
                success: function(data) {
                    if (data) {
                        $("#safety_tip").html(data);
                        $('.summernote').summernote();
                    }
                },

            });
        }
    </script>




    <script type="text/javascript">
        function category_edit(id) {
            $('#edit').modal('show');
            $('#edit_form').html('<div class="loadingData"></div>');
            var url = '<?php echo e(route('category.edit', ':id')); ?>';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                method: "get",
                success: function(data) {
                    if (data) {
                        $("#edit_form").html(data);
                        $('.dropify').dropify();
                    }
                },

            });
        }
    </script>


    <script>
        $(document).ready(function() {
            $("#categoryPositionSorting").sortable({
                placeholder: "ui-state-highlight",
                update: function(event, ui) {

                    var ids = new Array();
                    $('#categoryPositionSorting tr').each(function() {
                        ids.push($(this).attr("id"));
                    });

                    $.ajax({
                        url: "<?php echo e(route('categorySorting')); ?>",
                        method: "get",
                        data: {
                            ids: ids,
                            operator: '=',
                            operator2: '='
                        },
                        success: function(data) {
                            toastr.success(data)
                        }
                    });
                }
            });

        });
    </script>


    <script>
        $(document).ready(function() {
            $('#categoryForm').on('keypress', function(e) {
                if (e.which === 13) { // Check if Enter key is pressed
                    e.preventDefault(); // Prevent the default form submission
                    // Add your custom logic here if needed
                }
            });
        });

    


       
    $('#tblPackage').on('click', '.btnAdd', function () {
        // Get the last row index
        var lastRowIndex = $('#tblPackage tr').length;

        // Create a new row with the desired HTML structure
        var newRowHtml = '<tr>' +
            '<td>' + (lastRowIndex + 1) + '</td>' +
            '<td>' +
            '<select required name="package_id[]" class="form-control custom-select select2" style="width: 100%; height:36px;">' +
            '<?php $__currentLoopData = $package; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>' +
            '<option value="<?php echo e($data->id); ?>"><?php echo e($data->name); ?></option>' +
            '<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>' +
            '</select>' +
            '</td>' +
            '<td>' +
            '<input name="duration[]" required placeholder="Example: 7 Days" value="<?php echo e(old('ads')); ?>" class="form-control" type="number">' +
            '</td>' +
            '<td>' +
            '<input name="price[]" required placeholder="Example: <?php echo e(config('siteSetting.currency_symble')); ?>50 " value="<?php echo e(old('price')); ?>" class="form-control" type="number">' +
            '</td>' +
            '<td>' +
            '<div class="custom-control custom-switch">' +
            '<input name="package_status[]" type="checkbox" class="custom-control-input" id="packageStatus' + (lastRowIndex + 1) + '">' +
            '<label style="padding: 5px 12px" class="custom-control-label" for="packageStatus' + (lastRowIndex + 1) + '"></label>' +
            '</div>' +
            '</td>' +
            '<td class="text-nowrap text-center">' +
            '<a title="add" class="btn btn-success btn-sm btnAdd mr-1"><i class="ti-plus" aria-hidden="true"></i></a>' +
            '<a title="delete" class="btn btn-danger btn-sm text-white btnRemove"><i class="ti-trash" aria-hidden="true"></i></a>' +
            '</td>' +
            '</tr>';

        // Append the new row to the tblPackage table
        $('#tblPackage tbody').append(newRowHtml);

        $('.select2').select2();
    });


  
   
    $('#tblAttribute').on('click', '.btnAdd', function () {
    // Get the last row index
    var lastRowIndex = $('#tblAttribute tr').length;

    // Create a new row with the desired HTML structure
    var newRowHtml = '<tr>' +
        '<td>' + (lastRowIndex + 1) + '</td>' +
        '<td><input name="attribute_name[]" required type="text" class="form-control"></td>' +
        '<td>' +
        '<select required name="display_type[]" class="form-control form-control-sm custom-select" style="width: 100%; height:36px;">' +
        '<option value="1">Checkbox</option>' +
        '<option value="2">Select</option>' +
        '<option value="3">Radio</option>' +
        '<option value="4">Dropdown</option>' +
        '</select>' +
        '</td>' +
        '<td><input name="is_required[]" id="eeditis_required' + (lastRowIndex + 1) +'" type="checkbox"> <label for="eeditis_required' + (lastRowIndex + 1) +'">Yes/No</label></td>' +
        '<td><input name="is_filter[]" id="editfilter' + (lastRowIndex + 1) +'" type="checkbox"> <label for="editfilter' + (lastRowIndex + 1) +'">Yes/No</label></td>' +
        '<td>' +
        '<input name="attribute_value[]" type="text" value="" data-role="tagsinput" placeholder="Add value" />' +
        '</td>' +
        '<td>' +
        '<div class="custom-control custom-switch">' +
        '<input name="attribute_status[]" type="checkbox" class="custom-control-input" id="attributeStatus' + (lastRowIndex + 1) +'">' +
        '<label style="padding: 5px 12px" class="custom-control-label" for="attributeStatus' + (lastRowIndex + 1) +'"></label>' +
        '</div>' +
        '</td>' +
        '<td class="text-nowrap">' +
        '<a href="javascript:void(0)" title="add" class="btn btn-success btn-sm btnAdd mr-1"><i class="ti-plus" aria-hidden="true"></i></a>' +
        '<a href="javascript:void(0)" title="delete" class="btn btn-danger btn-sm text-white btnRemove"><i class="ti-trash" aria-hidden="true"></i></a>' +
        '</td>' +
        '</tr>';

    // Append the new row to the tblAttribute table
    $('#tblAttribute tbody').append(newRowHtml);

    // Initialize Tags Input on the new row
    $('#tblAttribute tbody tr:last-child input[data-role=tagsinput]').tagsinput();
});





        // Remove newly added row on button click
        $('#tblPackage').on('click', '.btnRemove', function() {
            if ($('#tblPackage tbody tr').length > 1) {
                $(this).closest('tr').remove();
            } else {
                alert('At least one row should be present.');
            }
        });


        $('#tblAttribute').on('click', '.btnRemove', function() {
            if ($('#tblAttribute tbody tr').length > 1) {
                $(this).closest('tr').remove();
            } else {
                alert('At least one row should be present.');
            }
        });
    </script>

    <script src="<?php echo e(asset('assets')); ?>/node_modules/summernote/dist/summernote-bs4.min.js"></script>
    <script>
        $(function() {

            $('.summernote').summernote({
                height: 250, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: false // set focus to editable area after initializing summernote
            });

            $('.inline-editor').summernote({
                airMode: true
            });

        });

        window.edit = function() {
                $(".click2edit").summernote()
            },
            window.save = function() {
                $(".click2edit").summernote('destroy');
            }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BonikBazar\bonikbazar\resources\views/admin/category/edit/test.blade.php ENDPATH**/ ?>