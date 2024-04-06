
<?php $__env->startSection('title', 'Addvertisement list'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .h-300 .dropify-wrapper {height: 300px !important;}.dropify-wrapper {height: 140px !important;}
.h-500 .dropify-wrapper {height: 600px !important; width: 240px;}


   /* CSS for zoom effect */
    /* .zoomable-image {
        transition: transform 0.2s ease;
    }

    .zoomable-image:hover {
        transform: scale(1.2); 
    } */

    

   
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
                        <h4 class="text-themecolor">Addvertisement List</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">ads</a></li>
                                <li class="breadcrumb-item active">list</li>
                            </ol>
                            <button data-toggle="modal" data-target="#add" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Add Adsense</button>
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
                    <div class="col-lg-12">
                        <div class="card" style="margin-bottom: 2px;">

                            <form action="" method="get">

                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input name="title" placeholder="Title" value="<?php echo e(Request::get('title')); ?>" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <select name="adsType" class="form-control">
                                                        <option value="all" <?php echo e((Request::get('adsType') == "all") ? 'selected' : ''); ?>>All Ads</option>
                                                        <option value="image" <?php echo e((Request::get('adsType') == "image") ? 'selected' : ''); ?>>Image Ads</option>
                                                        <option value="adsense" <?php echo e((Request::get('adsType') == 'google') ? 'selected' : ''); ?>>Google Ads</option>
                                                       
                                                       
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <select name="page_name" id="page_name" style="width:100%" id="page_name"  class="select2 form-control custom-select">
                                                       <option value="all">All Page</option>
                                                       <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                       <option <?php if(Request::get('page_name') == $page->slug): ?> selected <?php endif; ?> value="<?php echo e($page->slug); ?>"><?php echo e($page->title); ?></option>
                                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                   </select>
                                               </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <select name="status" class="form-control">
                                                        <option value="all" <?php echo e((Request::get('status') == "all") ? 'selected' : ''); ?>>All Status</option>
                                                        <option value="active" <?php echo e((Request::get('status') == 'active') ? 'selected' : ''); ?>>Active</option>
                                                        <option value="deactive" <?php echo e((Request::get('status') == 'deactive') ? 'selected' : ''); ?>>Deactive</option>
                                                       
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <select class="form-control" name="show">
                                                        <option <?php if(Request::get('show') == 15): ?> selected <?php endif; ?> value="15">15</option>
                                                        <option <?php if(Request::get('show') == 25): ?> selected <?php endif; ?> value="25">25</option>
                                                        <option <?php if(Request::get('show') == 50): ?> selected <?php endif; ?> value="50">50</option>
                                                        <option <?php if(Request::get('show') == 100): ?> selected <?php endif; ?> value="100">100</option>
                                                        <option <?php if(Request::get('show') == 255): ?> selected <?php endif; ?> value="250">250</option>
                                                        <option <?php if(Request::get('show') == 500): ?> selected <?php endif; ?> value="500">500</option>
                                                       
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                   
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

                        <div class="card">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Ad Name</th>
                                                <th>Creator</th>
                                                <th>Type</th>
                                                <th style="max-width: 250px;">Link</th>
                                                <th>Position</th>
                                                <th>Views</th>
                                                <th>Payment</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $advertisements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr id="item<?php echo e($data->id); ?>">

                                                <td><?php echo e($index+1); ?></td>
                                                <td><?php echo e($data->ads_name); ?></td>
                                                <td>
                                                    <?php echo e(($data->customer) ? $data->customer->name : "Admin"); ?>


                                                    <?php if($data->contact_email): ?>
                                                    <p><?php echo e($data->contact_email); ?></p>
                                                    <?php endif; ?>
                                                    <?php if($data->contact_mobile): ?>
                                                        <?php $__currentLoopData = json_decode($data->contact_mobile, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $number): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a href="tel:<?php echo e($number); ?>"><?php echo e($number); ?></a>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>

                                                </td>
                                                <td><?php echo e($data->adsType); ?></td>
                                                <td style="max-width: 250px;"><a target="_blank" href="<?php echo e($data->redirect_url); ?>"> <?php echo e(parse_url($data->redirect_url, PHP_URL_SCHEME) || $data->redirect_url == "#" ? $data->redirect_url : 'https://' . $data->redirect_url); ?> </a></td>
                                                <td>
                                                    <?php echo e(str_replace('-', ' ', $data->position)); ?>

                                                </td>
                                                <td><?php echo e($data->views); ?></td>
                                                <td>
                                                    <a href="javascript:void(0)" class="label btn-xs <?php if($data->payment_status == 'paid'): ?>  label-success <?php elseif($data->payment_status == 'received'): ?> label-info <?php else: ?> label-danger <?php endif; ?>">
                                                
                                                    <div  <?php if($data->payment_status != 'paid'): ?> onclick="adPaymentPopup('<?php echo e(route("addvertisement.paymentDetails", $data->id)); ?>')"  <?php endif; ?> class="text-inverse p-r-10" ><?php echo e($data->payment_status); ?> </div>
                                                    
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php if($data->status != 'pending'): ?>
                                                    <div class="custom-control custom-switch" style="padding-left: 3.25rem;">
                                                      <input name="status" onclick="satusActiveDeactive('addvertisements', <?php echo e($data->id); ?>)"   type="checkbox" <?php echo e(($data->status == 1) ? 'checked' : ''); ?> class="custom-control-input" id="status<?php echo e($data->id); ?>">
                                                      <label class="custom-control-label" for="status<?php echo e($data->id); ?>"></label>
                                                    </div>
                                                    <?php else: ?>
                                                    <span class="label label-danger">Pending</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>

                                                   
                                                     <button type="button" onclick="edit('<?php echo e($data->id); ?>')"  data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm"> View & Edit</button>
                                                     <button title="Delete" data-target="#delete" onclick="deleteConfirmPopup('<?php echo e(route("addvertisement.delete", $data->id)); ?>')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> Delete</button>
                                                     
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                       <?php echo e($advertisements->appends(request()->query())->links()); ?>

                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing <?php echo e($advertisements->firstItem()); ?> to <?php echo e($advertisements->lastItem()); ?> of total <?php echo e($advertisements->total()); ?> entries (<?php echo e($advertisements->lastPage()); ?> Pages)</div>
                </div>


                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        
        <!-- add Modal -->
        <div class="modal fade" id="add">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add new ads </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row">
                        <div class="card-body">
                            <form action="<?php echo e(route('addvertisement.store')); ?>" enctype="multipart/form-data" method="POST" >
                                <?php echo e(csrf_field()); ?>

                               
                                <div class="form-body">
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ads_name">Ads Name</label>
                                                <input type="text" value="<?php echo e(old('ads_name')); ?>"  name="ads_name"  id="ads_name" placeholder="Enter ads name" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="page">Select Page</label>
                                                <select name="page"  required="required" id="page" class="form-control custom-select">
                                                    <option value="all">All page</option>
                                                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($page->slug); ?>"><?php echo e($page->title); ?></option>
                                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"> 
                                                <label for="position">Position</label>
                                                <select name="position" required="required" id="position" class="form-control custom-select">
                                                    <option value="" selected disabled>Select an option</option>
                                                    
                                                    <option value="top" <?php echo e((old('position') == 'top') ? 'selected' : ''); ?>>Ad For (Top view)</option>
                                                    <option value="bottom" <?php echo e((old('position') == 'bottom') ? 'selected' : ''); ?>>Ad For (Bottom view)</option>
                                                    <option value="leftSide" <?php echo e((old('position') == 'leftSide') ? 'selected' : ''); ?>>Ad For Left Sidebar</option>
                                                    <option value="rightSide" <?php echo e((old('position') == 'rightSide') ? 'selected' : ''); ?>>Ad For Right Sidebar</option>
                                                    <option value="mobile-ad" <?php echo e((old('position') == 'mobile_image') ? 'selected' : ''); ?>>Ad For Mobile</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Ad Type</label>
                                                <select name="adsType" onchange="adsTypes(this.value)" required="required" class="form-control">
                                                    <option value="">Select Type</option>
                                                    <option value="adsense" <?php echo e((Request::get('adsType') == 'adsense') ? 'selected' : ''); ?>>Google Ads</option>
                                                    <option value="image" <?php echo e((Request::get('adsType') == "image") ? 'selected' : ''); ?>>Banner Ads</option>
                                                   
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12" id="showAdsType"></div>
                                        
                                        <div class="col-md-6">
                                             <div class="form-group">
                                            <label>Start date</label>
                                                <input type="date" required min="<?php echo e(date('Y-m-d')); ?>" name="start_date" id="start_date" class="form-control">
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                             <div class="form-group">
                                            <label>End date</label>
                                            <input type="date" required min="<?php echo e(Carbon\Carbon::parse(now())->addDay()->format('Y-m-d')); ?>" name="end_date" id="end_date" placeholder="link" class="form-control"></div>

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
                                    </div>

                                    <div class="row justify-content-md-center">
                                        <div class="col-md-12">
                                            <div class="modal-footer">
                                                <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
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
        <div class="modal fade" id="edit" role="dialog" style="display: none;">
            <div class="modal-dialog">
                <form action="<?php echo e(route('addvertisement.update')); ?>" enctype="multipart/form-data" method="post">
                      <?php echo e(csrf_field()); ?>

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Advertisement</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row" id="edit_form">

                    
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
        <div class="modal bs-example-modal-lg" id="adPaymentModal" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Update payment info.</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <?php if(Session::has('error')): ?>
                    <div class="alert alert-danger">
                      <?php echo e(Session::get('error')); ?>

                    </div>
                <?php endif; ?>
                <div class="modal-body" id="adPaymentDetails"></div> 
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


   

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <!-- This is data table -->
    <script src="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/js/dropify.min.js"></script>
    
    <script type="text/javascript">
        $('.dropify').dropify();
        $(".select2").select2();

        function edit(id){
            $('#edit_form').html('<div class="loadingData"></div>');
            var  url = '<?php echo e(route("addvertisement.edit", ":id")); ?>';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $("#edit_form").html(data);
                        $(".select2").select2();
                        $('.dropify').dropify();
                    }
                },
                // $ID Error display id name
                <?php echo $__env->make('common.ajaxError', ['ID' => 'edit_form'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            });
        }


        function adsTypes(type, edit=''){

            var output = '';
            if(type == 'image'){
                output = '<div style="display:flex;"><div style="width:99%;margin:5px" class="form-group"><label class="dropify_image_area required">Upload Banner</label> <div class="form-group"> <input required type="file" name="image" id="input-file-now" class="dropify" /> </div> </div></div><div class="form-group"> <label for="redirect_url">Redirect URL</label>  <input type="text" name="redirect_url"  id="redirect_url" class="form-control" > </div>';
            }else if(type == 'adsense'){
                output = '<div class="form-group"> <label class="required" for="add_code">Add code</label> <textarea name="add_code" class=" form-control" rows="5" id="add_code" placeholder="Enter ads code ..."></textarea> </div> ';
            }else if(type == 'others'){
                output = '<div class="form-group"> <label for="add_link required">Add code or link</label> <textarea name="add_code" class=" form-control" rows="3" id="add_link" placeholder="Enter ads code ..."></textarea></div><div class="form-group"> <label for="redirect_url">Redirect URL</label>  <input type="text" name="redirect_url"  id="redirect_url" class="form-control" > </div>';
            }else{
                 output = '';
            }

            if(edit == 'edit'){
                $('#editshowAdsType').html(output);
                $('#showAdsType').html('');
            }else{
                $('#showAdsType').html(output);
                $('#editshowAdsType').html('');
            }

            $('.dropify').dropify();
        }

        function adPaymentPopup(link){
            $('#adPaymentModal').modal('show');
            $('#adPaymentDetails').html('<div class="loadingData"></div>');
            $.ajax({
                url:link,
                method:"get",
                success:function(data){
                    $('#adPaymentDetails').html(data);
                }
            });
        }
    </script>

  

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Workspace\LaravelWorkspace\bonikbazar\resources\views/admin/addvertisement/addvertisement-list.blade.php ENDPATH**/ ?>