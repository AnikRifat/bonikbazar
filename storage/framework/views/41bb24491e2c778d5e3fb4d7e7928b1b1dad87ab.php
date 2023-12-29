
<?php $__env->startSection('title', 'Purchase gateway list'); ?>
<?php $__env->startSection('css-top'); ?>

    <link href="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
  
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
        <link href="<?php echo e(asset('assets')); ?>/node_modules/summernote/dist/summernote-bs4.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" >
        <link href="<?php echo e(asset('assets')); ?>/node_modules/bootstrap-switch/bootstrap-switch.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('css')); ?>/pages/bootstrap-switch.css" rel="stylesheet">

    <style type="text/css">
        .dropify_image{
            position: absolute;top: -12px!important;left: 12px !important; z-index: 9; background:#fff!important;padding: 3px;
        }
        .dropify-wrapper{
            height: 100px !important;
        }
        .method_info img{width: 200px}
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
                    <h4 class="text-themecolor">Purchase gateway List</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Purchase gateway</a></li>
                            <li class="breadcrumb-item active">list</li>
                        </ol>
                        <button data-toggle="modal" data-target="#add" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Add Manual Purchase gateway</button>
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
                                            <th>Logo</th>
                                            <th>Name</th>
                                            <th>Shipping Location</th>
                                           
                                          <!--   <th>Use For</th> -->
                                            <th>Method Info</th>
                                            <th>Method mode</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead> 
                                    <tbody id="positionSorting" data-table="payment_gateways">
                                        <?php $__currentLoopData = $paymentgateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr id="item<?php echo e($gateway->id); ?>">
                                            <td><img src="<?php echo e(asset('upload/images/payment/'. $gateway->method_logo)); ?>" width="90" height="45"></td>
                                            <td><?php echo e($gateway->method_name); ?></td>
                                            <td>
                                                <?php $shipping_location = ($gateway->location_id) ? json_decode($gateway->location_id) : []; ?>

                                                 <?php if(in_array('all', $shipping_location)): ?>  <span class="label label-info label-sm">All Location</span> <?php endif; ?>

                                                <?php $__currentLoopData = App\Models\City::whereIn('id', $shipping_location)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span class="label label-info label-sm"><?php echo e($city->name); ?></span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </td>

                                            <td class="method_info"> <?php echo $gateway->method_info; ?></td>
                                           <!--  <td><?php echo e($gateway->method_for); ?></td> -->
                                            <td>
                                                <div class="bt-switch">
                                                    
                                                    <input type="checkbox"  onchange="paymentModeChange(<?php echo e($gateway->id); ?>)" <?php echo e(($gateway->method_mode == 'live') ? 'checked' : ''); ?>  data-on-color="success" data-off-color="warning" data-on-text="Live" data-off-text="Test"> 
                                               
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-switch" >
                                                  <input name="status" onclick="satusActiveDeactive('payment_gateways', <?php echo e($gateway->id); ?>)"  type="checkbox" <?php echo e(($gateway->status == 1) ? 'checked' : ''); ?> class="custom-control-input" id="status<?php echo e($gateway->id); ?>">
                                                  <label class="custom-control-label" for="status<?php echo e($gateway->id); ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <button title="Edit" type="button" onclick="editMethod('<?php echo e($gateway->id); ?>')"  data-toggle="modal" data-target="#editMethod" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> </button>
                                                <?php if($gateway->is_default != 1): ?>
                                                <button data-target="#delete" title="Delete" onclick='deleteConfirmPopup("<?php echo e(route("paymentGateway.delete", $gateway->id)); ?>")' class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> </button>
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
    <div class="modal fade" id="add" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Manual Payment gateway</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body form-row">
                    <div class="card-body">
                        <form action="<?php echo e(route('paymentGateway.store')); ?>" enctype="multipart/form-data" method="POST" >
                            <?php echo e(csrf_field()); ?>

                            <div class="form-body">
                               
                                <div class="row justify-content-md-center">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="required" for="method_name">Payment gateway name</label>
                                            <input required="" name="method_name" id="method_name" value="<?php echo e(old('method_name')); ?>" type="text" class="form-control">
                                            <?php if($errors->has('method_name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <?php echo e($errors->first('title')); ?>

                                            </span>
                                        <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="method_info">Payment Information</label>
                                            <textarea rows="2" name="method_info" id="method_info"  type="text" style="resize: vertical;" class="summernote form-control"><?php echo e(old('method_info')); ?></textarea>
                                        </div>
                                    </div>
                                    
                                    <!-- <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="public_key">Public Key</label>
                                            <input name="public_key" id="public_key" value="<?php echo e(old('public_key')); ?>" placeholder="Enter public key" type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="secret_key">Secret Key</label>
                                            <input name="secret_key" id="secret_key" value="<?php echo e(old('secret_key')); ?>" placeholder="Enter secret key" type="text" class="form-control">
                                        </div>
                                    </div> -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <span for="location_id">Shipping Location</span>
                                            <select name="location_id[]" id="showMenuSourch" class="select2 m-b-10 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Choose">
                                                <option value="all">All Location</option>
                                                <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($location->id); ?>"><?php echo e($location->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            <label class="dropify_image">Logo</label>
                                            <input type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg png gif"  data-max-file-size="2M"  name="method_logo" id="input-file-events">
                                            <i style="color: red;font-size: 12px;">Size: 100px * 50px</i>

                                        </div>
                                        <?php if($errors->has('method_logo')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <?php echo e($errors->first('method_logo')); ?>

                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="head-label">
                                            <label class="switch-box">Status</label>
                                            <div  class="status-btn" >
                                                <div class="custom-control custom-switch">
                                                    <input name="status" checked  type="checkbox" class="custom-control-input" <?php echo e((old('status') == 'on') ? 'checked' : ''); ?> id="status">
                                                    <label  class="custom-control-label" for="status">Publish/UnPublish</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                               
                                    <div class="col-md-12">
                                        
                                        <div class="modal-footer">
                                            <button type="submit" name="submitType" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Add New Payment gateway</button>
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
    <div class="modal fade" id="editMethod" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <form action="<?php echo e(route('paymentGateway.update')); ?>" enctype="multipart/form-data"  method="post">
                  <?php echo e(csrf_field()); ?>

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Payment gateway</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body form-row" id="edit_form"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="submitType" value="edit" class="btn btn-sm btn-success">Update</button>
                </div>
              </div>
            </form>
        </div>
    </div>
   <!--  Delete Modal -->
    <?php echo $__env->make('admin.modal.delete-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/jqueryui/jquery-ui.min.js"></script>

    <script src="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

    <!-- This is data table -->
    <script src="<?php echo e(asset('assets')); ?>/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
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
        $(function () {
            $('#myTable').DataTable({"ordering": false});
        });

    </script>

    <script type="text/javascript">

        function editMethod(id){
           
            $('#edit_form').html('<div class="loadingData"></div>');
            var  url = '<?php echo e(route("paymentGateway.edit", ":id")); ?>';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){

                        $("#edit_form").html(data);
                        $('.dropify').dropify();
                        $('.summernote').summernote({
                            height: 100, // set editor height
                            minHeight: null, // set minimum height of editor
                            maxHeight: null, // set maximum height of editor
                            focus: false // set focus to editable area after initializing summernote
                        });
                         $(".select2").select2();
                    }
                }, 
                // ID = Error display attribute id name
                <?php echo $__env->make('common.ajaxError', ['ID' => 'edit_form'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            });
        }
        //status change
        function satusActiveDeactive(table, id){

            var  url = '<?php echo e(route("statusChange")); ?>';
           
            $.ajax({
                url:url,
                method:"get",
                data:{table:table,id:id},
                success:function(data){
                    if(data.status){
                        toastr.success(data.message);
                    }else{
                        toastr.error(data.message);
                    }
                }
            });
        }//status change

      
        function paymentModeChange(id){

            var  url = '<?php echo e(route("paymentModeChange")); ?>';
           
            $.ajax({
                url:url,
                method:"get",
                data:{id:id},
                success:function(data){
                    if(data.status){
                        toastr.success(data.message);
                    }else{
                        toastr.error(data.message);
                    }
                }
            });
        }

    </script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/js/dropify.min.js"></script>
     <script>
    $(document).ready(function() { // Basic
        $('.dropify').dropify();
    });

     $(".select2").select2();
    </script>

    <script src="<?php echo e(asset('assets')); ?>/node_modules/summernote/dist/summernote-bs4.min.js"></script>
    <script>
    $(function() {

        $('.summernote').summernote({
            height: 100, // set editor height
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

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/admin/payments/payment-gateway.blade.php ENDPATH**/ ?>