
<?php $__env->startSection('title', 'Sub childcategory list'); ?>
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

        .select2-container--default .select2-selection--multiple .select2-selection__rendered {
            height: 100px !important
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

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
                    <h4 class="text-themecolor">Childcategory List</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Childcategory</a></li>
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
                    <div class="card">

                        <form action="" method="get">

                            <div class="form-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input name="title" placeholder="Title"
                                                    value="<?php echo e(Request::get('title')); ?>" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="category" id="category" style="width:100%" id="seller"
                                                    class="select2 form-control custom-select">
                                                    <option value="all">All Category</option>
                                                    <?php $__currentLoopData = $get_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(Request::get('category') == $category->id): ?> selected <?php endif; ?>
                                                            value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <select class="form-control" name="show">
                                                    <option <?php if(Request::get('show') == 15): ?> selected <?php endif; ?>
                                                        value="15">15</option>
                                                    <option <?php if(Request::get('show') == 25): ?> selected <?php endif; ?>
                                                        value="25">25</option>
                                                    <option <?php if(Request::get('show') == 50): ?> selected <?php endif; ?>
                                                        value="50">50</option>
                                                    <option <?php if(Request::get('show') == 100): ?> selected <?php endif; ?>
                                                        value="100">100</option>
                                                    <option <?php if(Request::get('show') == 255): ?> selected <?php endif; ?>
                                                        value="250">250</option>
                                                    <option <?php if(Request::get('show') == 500): ?> selected <?php endif; ?>
                                                        value="500">500</option>
                                                    <option <?php if(Request::get('show') == 750): ?> selected <?php endif; ?>
                                                        value="750">750</option>
                                                    <option <?php if(Request::get('show') == 1000): ?> selected <?php endif; ?>
                                                        value="1000">1000</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                            <div class="form-group">

                                                <button type="submit" class="form-control btn btn-success"><i
                                                        style="color:#fff; font-size: 20px;" class="ti-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <i class="drag-drop-info">Drag & drop sorting position</i>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Sub Childcategory</th>
                                            <th>Feature Image</th>
                                            <th>Category</th>
                                            <th>Notes</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="categoryPositionSorting">
                                        <?php $__currentLoopData = $get_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr id="item<?php echo e($data->id); ?>">
                                                <td><?php echo e($get_data->perPage() * $get_data->currentPage() - $get_data->perPage() + ($index + 1)); ?>

                                                </td>
                                                <td><?php echo e($data->name); ?></td>
                                                <td><img src="<?php echo e(asset('upload/images/category/thumb/' . $data->image)); ?>"
                                                        alt="" width="50"></td>
                                                <td><?php echo e($data->get_category->name ?? 'Not found'); ?></td>
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
                                                        <button type="button"
                                                            onclick="getCategoryBanner('<?php echo e($data->slug); ?>')"
                                                            data-toggle="modal" data-target="#setBanner"
                                                            class="btn btn-success btn-sm"><i class="ti-plus"
                                                                aria-hidden="true"></i> Banner</button>
                                                        <button type="button" onclick="edit('<?php echo e($data->id); ?>')"
                                                            data-toggle="modal" data-target="#edit"
                                                            class="btn btn-info btn-sm"><i class="ti-pencil"
                                                                aria-hidden="true"></i> Edit</button>
                                                    <?php endif; ?>
                                                    <?php if($permission['is_delete']): ?>
                                                        <button data-target="#delete"
                                                            onclick="deleteConfirmPopup('<?php echo e(route('subchildcategory.delete', $data->id)); ?>')"
                                                            class="btn btn-danger btn-sm" data-toggle="modal"><i
                                                                class="ti-trash" aria-hidden="true"></i> Delete</button>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                                    <?php echo e($get_data->appends(request()->query())->links()); ?>

                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing <?php echo e($get_data->firstItem()); ?> to
                                    <?php echo e($get_data->lastItem()); ?> of total <?php echo e($get_data->total()); ?> entries
                                    (<?php echo e($get_data->lastPage()); ?> Pages)</div>
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
    <!-- update Modal -->
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

                                                <div class="panel-group" id="accordion1" role="tablist"
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

                                                <div class="panel-group" id="accordion2" role="tablist"
                                                    aria-multiselectable="true">
                                                    <ul id="sectionSositionSorting2" data-table="modules"
                                                        style="padding: 0">
                                                        <li id="attributeItem2" class="module_section  deactive_module"
                                                            title="Deactive this section">
                                                            <div class="panel panel-default">
                                                                <div class="row panel-heading" role="tab">
                                                                    <div class="col-12">
                                                                        <h4 class="panel-title">
                                                                            <a role="button" data-toggle="collapse"
                                                                                data-parent="#accordion2"
                                                                                href="#attributeSection2"
                                                                                aria-expanded="true"
                                                                                aria-controls="attributeSection2"> Product
                                                                                Attribute
                                                                            </a>
                                                                        </h4>
                                                                    </div>

                                                                </div>

                                                                <div id="attributeSection2"
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

                                                <div class="panel-group" id="accordion3" role="tablist"
                                                    aria-multiselectable="true">
                                                    <ul id="sectionSositionSorting3" data-table="modules"
                                                        style="padding: 0">
                                                        <li id="attributeItem3" class="module_section  deactive_module"
                                                            title="Deactive this section">
                                                            <div class="panel panel-default">
                                                                <div class="row panel-heading" role="tab">
                                                                    <div class="col-12">
                                                                        <h4 class="panel-title">
                                                                            <a role="button" data-toggle="collapse"
                                                                                data-parent="#accordion3"
                                                                                href="#attributeSection3"
                                                                                aria-expanded="true"
                                                                                aria-controls="attributeSection3"> Product
                                                                                Feature
                                                                            </a>
                                                                        </h4>
                                                                    </div>

                                                                </div>

                                                                <div id="attributeSection3"
                                                                    class="panel-collapse collapse collapse show"
                                                                    role="tabpanel">
                                                                    <div class="panel-body">
                                                                        <div class="table-responsive"
                                                                            style="min-height:110px">
                                                                            <table id="tblFeature"
                                                                                class="table table-bordered table-striped">
                                                                                <thead style="text-wrap:nowrap;">
                                                                                    <tr>
                                                                                        <th>#</th>
                                                                                        <th>Product Feature Name</th>
                                                                                        <th>Is Required</th>
                                                                                        <th>Status</th>
                                                                                        <th class="text-center">Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>

                                                                                    <tr>
                                                                                        <td>1</td>
                                                                                        <td> <input name="feature_name[]"
                                                                                                required=""
                                                                                                type="text"
                                                                                                class="form-control"></td>

                                                                                        <td><input
                                                                                                name="required_feature[]"
                                                                                                id="featureis_required"
                                                                                                type="checkbox"> <label
                                                                                                for="featureis_required">
                                                                                                Yes/No </label></td>




                                                                                        <td>
                                                                                            <div
                                                                                                class="custom-control custom-switch">
                                                                                                <input
                                                                                                    name="feature_status[]"
                                                                                                    type="checkbox"
                                                                                                    type="checkbox"
                                                                                                    class="custom-control-input"
                                                                                                    id="featureStatus">
                                                                                                <label
                                                                                                    style="padding: 5px 12px"
                                                                                                    class="custom-control-label"
                                                                                                    for="featureStatus"></label>
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

                                                <div class="panel-group" id="accordion4" role="tablist"
                                                    aria-multiselectable="true">
                                                    <ul id="sectionSositionSorting4" data-table="modules"
                                                        style="padding: 0">
                                                        <li id="attributeItem4" class="module_section  deactive_module"
                                                            title="Deactive this section">
                                                            <div class="panel panel-default">
                                                                <div class="row panel-heading" role="tab">
                                                                    <div class="col-12">
                                                                        <h4 class="panel-title">
                                                                            <a role="button" data-toggle="collapse"
                                                                                data-parent="#accordion4"
                                                                                href="#attributeSection4"
                                                                                aria-expanded="true"
                                                                                aria-controls="attributeSection4"> Product
                                                                                Brand
                                                                            </a>
                                                                        </h4>
                                                                    </div>

                                                                </div>

                                                                <div id="attributeSection4"
                                                                    class="panel-collapse collapse collapse show"
                                                                    role="tabpanel">
                                                                    <div class="panel-body">
                                                                        <div class="table-responsive"
                                                                            style="min-height:110px">
                                                                            <table id="tblBrand"
                                                                                class="table table-bordered table-striped">
                                                                                <thead style="text-wrap:nowrap;">
                                                                                    <tr>
                                                                                        <th>#</th>
                                                                                        <th>Brand Name</th>
                                                                                        <th>Brand Logo</th>
                                                                                        <th>Status</th>
                                                                                        <th class="text-center">Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>

                                                                                    <tr>
                                                                                        <td>1</td>
                                                                                        <td> <input name="brand_name[]"
                                                                                                required=""
                                                                                                type="text"
                                                                                                class="form-control"></td>

                                                                                        <td>
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    class="dropify_image">Feature
                                                                                                    Image</label>
                                                                                                <input type="file"
                                                                                                    class="dropify"
                                                                                                    accept="image/*"
                                                                                                    data-type='image'
                                                                                                    data-allowed-file-extensions="jpg jpeg png gif"
                                                                                                    data-max-file-size="2M"
                                                                                                    name="brand_photo[]"
                                                                                                    id="input-file-events">
                                                                                            </div>
                                                                                        </td>




                                                                                        <td>
                                                                                            <div
                                                                                                class="custom-control custom-switch">
                                                                                                <input
                                                                                                    name="brand_status[]"
                                                                                                    type="checkbox"
                                                                                                    type="checkbox"
                                                                                                    class="custom-control-input"
                                                                                                    id="brandStatus">
                                                                                                <label
                                                                                                    style="padding: 5px 12px"
                                                                                                    class="custom-control-label"
                                                                                                    for="brandStatus"></label>
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
    <div class="modal fade" id="edit" role="dialog" style="display: none;">
        <div class="modal-dialog">
            <form action="<?php echo e(route('subchildcategory.update')); ?>" enctype="multipart/form-data" method="post">
                <?php echo e(csrf_field()); ?>

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update sub childcategory</h4>
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

    <!-- banner modal -->
    <?php echo $__env->make('admin.category.category-banner-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/jqueryui/jquery-ui.min.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/custom/tagify.js')); ?>"></script>

    <script src="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/js/dropify.min.js"></script>
    <script>
        $(".select2").select2();

        $(document).ready(function() {
            // Basic
            $('.dropify').dropify();

        });
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
                            operator: '!=',
                            operator2: '!='
                        },
                        success: function(data) {
                            toastr.success(data)
                        }
                    });
                }
            });

        });
    </script>

    <script type="text/javascript">
        function edit(id) {
            $('#edit_form').html('<div class="loadingData"></div>');
            var url = '<?php echo e(route('subchildcategory.edit', ':id')); ?>';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                method: "get",
                success: function(data) {
                    if (data) {
                        $("#edit_form").html(data);
                        $('.dropify').dropify();
                        $(".select2").select2();
                    }
                },
                // $ID Error display id name
                <?php echo $__env->make('common.ajaxError', ['ID' => 'edit_form'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


            });

        }

        // if occur error open model
        <?php if($errors->any()): ?>
            $("#<?php echo e(Session::get('submitType')); ?>").modal('show');
        <?php endif; ?>
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





        $('#tblPackage').on('click', '.btnAdd', function() {
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
                '<input name="package_status[]" type="checkbox" class="custom-control-input" id="packageStatus' + (
                    lastRowIndex + 1) + '">' +
                '<label style="padding: 5px 12px" class="custom-control-label" for="packageStatus' + (lastRowIndex +
                    1) + '"></label>' +
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

        $('#tblAttribute').on('click', '.btnAdd', function() {
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
                '<td><input name="is_required[]" id="eeditis_required' + (lastRowIndex + 1) +
                '" type="checkbox"> <label for="eeditis_required' + (lastRowIndex + 1) + '">Yes/No</label></td>' +
                '<td><input name="is_filter[]" id="editfilter' + (lastRowIndex + 1) +
                '" type="checkbox"> <label for="editfilter' + (lastRowIndex + 1) + '">Yes/No</label></td>' +
                '<td>' +
                '<input name="attribute_value[]" type="text" value="" data-role="tagsinput" placeholder="Add value" />' +
                '</td>' +
                '<td>' +
                '<div class="custom-control custom-switch">' +
                '<input name="attribute_status[]" type="checkbox" class="custom-control-input" id="attributeStatus' +
                (lastRowIndex + 1) + '">' +
                '<label style="padding: 5px 12px" class="custom-control-label" for="attributeStatus' + (
                    lastRowIndex + 1) + '"></label>' +
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


        $('#tblFeature').on('click', '.btnAdd', function() {
            // Get the last row index
            var lastRowIndex = $('#tblFeature tbody tr').length;

            // Create a new row with the desired HTML structure
            var newRowHtml = '<tr>' +
                '<td>' + (lastRowIndex + 1) + '</td>' +
                '<td><input name="feature_name[]" required type="text" class="form-control"></td>' +
                '<td><input name="required_feature[]" type="checkbox"> <label for="featureis_required"> Yes/No </label></td>' +
                '<td><div class="custom-control custom-switch">' +
                '<input name="feature_status[]" type="checkbox" class="custom-control-input" id="featureStatus' + (
                    lastRowIndex + 1) + '">' +
                '<label style="padding: 5px 12px" class="custom-control-label" for="featureStatus' + (lastRowIndex +
                    1) + '"></label>' +
                '</div></td>' +
                '<td class="text-nowrap">' +
                '<a href="javascript:void(0)" title="add" class="btn btn-success btn-sm btnAdd mr-1"><i class="ti-plus" aria-hidden="true"></i></a>' +
                '<a href="javascript:void(0)" title="delete" class="btn btn-danger btn-sm text-white btnRemove"><i class="ti-trash" aria-hidden="true"></i></a>' +
                '</td>' +
                '</tr>';

            // Append the new row to the tblFeature table
            $('#tblFeature tbody').append(newRowHtml);
        });

        $('#tblBrand').on('click', '.btnAdd', function() {
            // Get the last row index
            var lastRowIndex = $('#tblBrand tbody tr').length;

            // Create a new row with the desired HTML structure
            var newRowHtml = '<tr>' +
                '<td>' + (lastRowIndex + 1) + '</td>' +
                '<td><input name="brand_name[]" required type="text" class="form-control"></td>' +
                '<td><div class="form-group">' +
                '<label class="dropify_image">Feature Image</label>' +
                '<input type="file" class="dropify" accept="image/*" data-type="image" data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="2M" name="brand_photo[]" id="input-file-events"></div></td>' +
                '<td><div class="custom-control custom-switch">' +
                '<input name="brand_status[]" type="checkbox" class="custom-control-input" id="brandStatus' + (
                    lastRowIndex + 1) + '">' +
                '<label style="padding: 5px 12px" class="custom-control-label" for="brandStatus' + (lastRowIndex +
                    1) + '"></label>' +
                '</div></td>' +
                '<td class="text-nowrap">' +
                '<a href="javascript:void(0)" title="add" class="btn btn-success mr-1 btn-sm btnAdd"><i class="ti-plus" aria-hidden="true"></i></a>' +
                '<a href="javascript:void(0)" title="delete" class="btn btn-danger btn-sm text-white btnRemove"><i class="ti-trash" aria-hidden="true"></i></a>' +
                '</td>' +
                '</tr>';

            // Append the new row to the tblBrand table

            $('#tblBrand tbody').append(newRowHtml);
            $('.dropify').dropify();
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

        $('#tblFeature').on('click', '.btnRemove', function() {
            if ($('#tblFeature tbody tr').length > 1) {
                $(this).closest('tr').remove();
            } else {
                alert('At least one row should be present.');
            }
        });

        $('#tblBrand').on('click', '.btnRemove', function() {
            if ($('#tblBrand tbody tr').length > 1) {
                $(this).closest('tr').remove();
            } else {
                alert('At least one row should be present.');
            }
        });
    </script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BonikBazar\bonikbazar\resources\views/admin/category/sub-childcategory.blade.php ENDPATH**/ ?>