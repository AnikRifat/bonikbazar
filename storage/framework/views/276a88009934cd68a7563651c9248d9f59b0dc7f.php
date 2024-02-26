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

<script src="<?php echo e(asset('assets/custom/tagify.js')); ?>"></script>
<?php $__env->startSection('js'); ?>
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
<?php $__env->stopSection(); ?><?php /**PATH D:\BonikBazar\bonikbazar\resources\views/admin/category/common.blade.php ENDPATH**/ ?>