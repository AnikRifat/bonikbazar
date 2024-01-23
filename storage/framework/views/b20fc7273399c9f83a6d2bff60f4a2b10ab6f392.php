 
<?php $__env->startSection('title', 'Ads Post' ); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('assets')); ?>/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style>
ol.carousel-indicators.list-inline.position-static.mt-0 {
    overflow: hidden;
}
.carousel-indicators {
    margin-right: 0;
    margin-left: 0;
}
#custCarousel .carousel-indicators li.active img {
opacity: 0.4;
}
#custCarousel .carousel-indicators li:hover img {
opacity: 0.7;
}
.h1s{
    top: 50%;
    transform: translateY(-50%);
    font-size: 16px;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.carousel-indicators li {text-indent:0;}
.carousel-item img{width: 100%}
.changeBtn{color:green;margin: 5px; font-size:12px;}
.adjust-field{cursor: pointer; border: none;border-radius:0;position: absolute;top: 0;right: 0;background: #e9ecef;padding: 7px;}
.select2-container{z-index: 0}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container bg-white mb-2 py-3 px-0">
        <form action="<?php echo e(route('post.store')); ?>" data-parsley-validate method="post" enctype="multipart/form-data" class="adpost-form">
        <input type="hidden" name="post_id" value="<?php echo e($post->product_id); ?>">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-12 border-b">
                <div  style="display:flex; justify-content: space-between;">
                <div class="d-flex align-items-center mb-2">
                    <img width="60" height="60" class="rounded-3 mr-2" src="<?php echo e(asset('upload/users')); ?>/<?php echo e((Auth::user()->photo) ? Auth::user()->photo : 'default.png'); ?>" alt="user">
                    <div>
                        <h4><?php echo e(Auth::user()->name); ?></h4>
                        <?php if(Auth::user()->getMembership): ?>
                        <div class="d-flex align-items-center">
                        <img class="lazyload" width="25" src="<?php echo e(asset('upload/images/membership/'. Auth::user()->getMembership->ribbon)); ?>">
                       
                        <p class="bt"><?php echo e(Auth::user()->getMembership->name); ?></p></div> <?php endif; ?>
                    </div>
                </div>
                <div >
                <div style="margin-bottom: 5px;">
                <a href="javascript:void(0)" data-toggle="modal" data-target="#selectcatmodal">
                <img width="20" class=" mr-2" src="<?php echo e(asset('upload/images/m-1.png')); ?>"> <?php echo e($category->name); ?> <span class="changeBtn">Change</span></a></div>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#locationmodal">
                <img width="20" class=" mr-1" src="<?php echo e(asset('upload/images/m-2.png')); ?>"> <?php echo e($location->name); ?><?php if($location->state): ?>, <?php echo e($location->state->name); ?> <?php endif; ?> <span class="changeBtn">Change</span></a>
                </div>
                </div>
            </div>
           
            <div class="col-12 col-md-7 pt-3 border-rr">
                <div id="custCarousel" class="carousel slide mb-3" data-ride="carousel" align="center">
                    <!-- slides -->
                    <div class="carousel-inner">
                        <div class="carousel-item mh-300 active">
                            <img src="<?php echo e(asset('upload/images/product/'.$post->feature_image)); ?>" alt="Hills">
                        </div>
                        <?php $__currentLoopData = $post->get_galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $galleryImage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="carousel-item mh-300">
                            <img src="<?php echo e(asset('upload/images/product/gallery/'.$galleryImage->image_path)); ?>" alt="Hills">
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    
                    <!-- Left right -->
                    <a class="h1s position-absolute left-0 bg-white px-2 py-1 mt-3" href="#custCarousel" data-slide="prev">
                    <img height="15" src="<?php echo e(asset('upload/images/a.png')); ?>">
                    </a>
                    
                    <a class="h1s position-absolute right-0 bg-white px-2 py-1 mt-3" href="#custCarousel" data-slide="next">
                    <img height="15" class="transform-180" src="<?php echo e(asset('upload/images/a.png')); ?>">
                    </a>
                    
                    <!-- Thumbnails -->
                    <ol class="carousel-indicators list-inline position-static mt-0">
                        <li class="list-inline-item w-100 h-auto active">
                            <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#custCarousel">
                                <img style="width: 100px" src="<?php echo e(asset('upload/images/product/'.$post->feature_image)); ?>" >
                            </a>
                        </li>
                        <?php $__currentLoopData = $post->get_galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $galleryImage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <li class="list-inline-item w-100 h-auto">
                            <a id="carousel-selector-1" data-slide-to="1" data-target="#custCarousel">
                                <img style="width: 100px" src="<?php echo e(asset('upload/images/product/gallery/'.$galleryImage->image_path)); ?>">
                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </ol>
                </div>
                <!--<div class="d-flex flex-wrap">-->
                <!--    <div class="d-flex align-items-center mr-2">-->
                <!--        <input name="sale_type"  <?php if(old('sale_type') == 'new'): ?> selected <?php endif; ?> value="new" type="radio" id="NEW" checked>-->
                <!--        <label class="iy" for="NEW">NEW</label>-->
                <!--    </div>-->
                <!--    <div class="d-flex align-items-center mr-2">-->
                <!--        <input name="sale_type" <?php if(old('sale_type') == 'used'): ?> selected <?php endif; ?> value="used"  type="radio" id="USED">-->
                <!--        <label class="iy" for="USED">USED</label>-->
                <!--    </div>-->
                    
                <!--</div>-->

                
                <div class="row"> 

                <?php if(Auth::user()->getMembership && Auth::user()->getMembership->slug == "wholesale"): ?>
                <div class="col-md-6 col-lg-6 p-1">
                    <label>Minimum quantity</label>
                    <input type="text" class="form-control" placeholder="Enter qty" name="wholesale_qty">
                </div>
                <?php endif; ?>
                <?php if(count($brands)>0): ?>
                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="required" for="brand">Brand </label>
                        <select name="brand" required id="brand" style="width:100%" id="brand" data-parsley-required-message = "Brand is required" class="select2 form-control custom-select">
                           <option value="">Select Brand</option>
                           <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option  <?php if(old('brand') == $brand->id): ?> selected <?php endif; ?>  value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       </select>
                   </div>
                </div>
                <?php endif; ?>
                
                <?php echo $__env->make("users.post.attribute", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                </div>
                <div <?php if(count($features) <= 0): ?> style="display:none" <?php endif; ?>>
                    <!-- Allow attribute checkbox button -->
                    <label class="form-label">Product Features</label>
                    <div class="row">
                        <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12 col-md-6 p-1">
                            <div class="<?php if($feature->is_required): ?> required <?php endif; ?> ">
                                <?php echo e($feature->name); ?>

                                <input type="hidden" value="<?php echo e($feature->name); ?>" class="form-control" name="features[<?php echo e($feature->id); ?>]">
                            </div>
                            <div>
                                <input <?php if($feature->is_required): ?> required <?php endif; ?> type="text" name="featureValue[<?php echo e($feature->id); ?>]" class="form-control" placeholder="Input value here">
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div id="PredefinedFeatureBycategory"></div>
                    <div id="PredefinedFeatureBySubcategory"></div>

                </div>
                
               
                <div class="form-group">
                    <label class="required">Ad Title</label>
                    <input name="title" value="<?php echo e(old('title')); ?>" required type="text" class="form-control" placeholder="Type your title here">
                </div>
                
                <div class="form-group">
                    <label class="required">Description</label>
                    <textarea name="description" required class="summernote form-control" rows="4" placeholder="Describe your message"><?php echo e(old('description')); ?></textarea>
                    <p>Max 5000 character</p>
                </div>
            </div>
            <div class="col-12 col-md-5 pt-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text required" id="basic-addon1">TK </span>
                    </div>
                    <input type="text" name="price" value="<?php echo e(old('price')); ?>" required class="form-control borders" placeholder="Enter your price" aria-label="Username" aria-describedby="basic-addon1">
                    <div class="input-group-append input-group-text">
                        <input id="negotiable" name="negotiable" type="checkbox" value="1">
                        <label for="negotiable"><small>Negotiable</small></label>
                    </div>
                </div>
                
                <h3 class="font-weight-normal mb-2">CONTACT DETAILS:</h3>
                 
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text required">Name:</span>
                    </div>
                    <input type="text" required name="contact_name" value="<?php echo e((old('contact_name') ? old('contact_name') : Auth::user()->name )); ?>" class="form-control" placeholder="Your Name">
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text required">Email:</span>
                    </div>
                    <input type="text" required name="contact_email" value="<?php echo e((old('contact_email') ? old('contact_email') : Auth::user()->email )); ?>" class="form-control" placeholder="Your Email">
                </div>
                <div class="w-100">
                    <div class="form-group mb-2">
                        <label>Mobile Number</label>
                        <div id="mobileNumber">
                            <?php if(Auth::user()->mobile): ?>
                            <div id="<?php echo e(Auth::user()->mobile); ?>" class="addNumber">
                                <input type="hidden" class="contact_mobile" name="contact_mobile[]" value="<?php echo e(Auth::user()->mobile); ?>">
                                <i class="fa fa-check-square"></i>
                                <strong><?php echo e(Auth::user()->mobile); ?> </strong>
                                <a class="removeNumber" href="javascript:void(0)" onclick="removeNumber('<?php echo e(Auth::user()->mobile); ?>')" title="Remove phone number">✕</a>
                            </div>
                            
                            <?php endif; ?>
                        </div>
                        <span id="moreMobile">
                            <?php if(Auth::user()->mobile): ?>
                                <a onclick="moreMobile()" href="javascript:void(0)">Add another mobile number</a>
                            <?php else: ?>
                            <div style="display:flex; margin-bottom: 10px;">
                                <div>
                                    Add mobile number
                                    <div style="position: relative;margin-right: 10px;width: 300px;">
                                        <input type="number" id="number" value="number" required name="mobile" class="form-control" placeholder="Enter your number">
                                        <div class="adjust-field" onclick="addNumber()"> Add</div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div>
                        <input id="contact_hidden" name="contact_hidden" type="checkbox" value="1">
                        <label for="contact_hidden">Hide mobile number(s)</label>
                    </div>
                </div>
                <div class="my-2">
                   <input id="conditions" required type="checkbox">
                   <label for="conditions">I have read and accept the <a href="#"> Terms and Conditions</a></label>
                </div>
            </div>

            <div class="col-md-12">
            <div class="form-group" style="text-align: right;">
                <button class="btn btn-inline">
                    <i class="fas fa-check-circle"></i>
                    <span>Post Your Ad</span>
                </button>
            </div>
            </div>
        </div>

        </form>
    </div>
    

    <div class="modal fade" id="selectcatmodal" role="dialog" style="display: none;">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="border: none;padding-bottom: 0;">
                    <h4 class="modal-title">Select Category</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="padding: 0 20px;">
                    <ul class="product-widget-list">
                        <?php $__currentLoopData = $get_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="product-widget-dropitem" style="margin: 0;padding: 8px; border-bottom: 1px solid #f1f1f1;">
                            <button type="button" class="product-widget-link">
                                 <?php echo e($category->name); ?>

                            </button>
                            <ul class="product-widget-dropdown" >
                                <?php $__currentLoopData = $category->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(route('post.categoryChange', [$post->id, $subcategory->id])); ?>"> <?php echo e($subcategory->name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="locationmodal" role="dialog" style="display: none;">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="border: none;padding-bottom: 0;">
                    <h4 class="modal-title">Select Location</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="padding: 0 20px;">
                    <ul class="product-widget-list">
                        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="product-widget-dropitem" style="margin: 0;padding: 8px; border-bottom: 1px solid #f1f1f1;">
                            <button type="button" class="product-widget-link">
                                 <?php echo e($state->name); ?>

                            </button>
                            <ul class="product-widget-dropdown">
                                <?php $__currentLoopData = $state->get_city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(route('post.locationChange', [$post->id, $city->id])); ?>"> <?php echo e($city->name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/js/dropify.min.js"></script>
    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

    });
</script>
<script src="<?php echo e(asset('js/parsley.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets')); ?>/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(".select2").select2();
</script>
<script type="text/javascript">


    <?php if(old('state_id')): ?>
        get_city(old('state_id'));
    <?php endif; ?>

    function get_city(id){

        var  url = '<?php echo e(route("get_city", ":id")); ?>';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#city_id").html(data);
                }else{
                    $("#city_id").html('<option>City not found</option>');
                }
            }
        });
    }
    // Enter form submit preventDefault for tags
    $(document).on('keyup keypress', 'form input[type="text"]', function(e) {
      if(e.keyCode == 13) {
        e.preventDefault();
        return false;
      }
    });

</script>

<script type="text/javascript">
    function moreMobile(number=null){

        $('#moreMobile').html(`
        <div style="display:flex; margin-bottom: 10px;">
        <div>
        Add mobile number
        <div style="position: relative;margin-right: 10px;width: 300px;">
        <input type="number" id="number" value="`+number+`" required name="mobile" class="form-control" placeholder="Enter your number">
        <span class="adjust-field" onclick="addNumber()"> Add</span>
        </div>
        </div>
        </div>`);
    }
    function addNumber(){
       var number = $('#number').val();
        if(number){
        $.ajax({
            url:"<?php echo e(route('addNumber')); ?>",
            method:'get',
            data:{number:number},
            success:function(data){
                $('#moreMobile').html(data);
            }
        });
        }
    }

    function verifyNumber(number){

       var otp = $('#otp').val();
        if(otp){
        $.ajax({
            url:"<?php echo e(route('verifyNumber')); ?>",
            method:'get',
            data:{otp:otp,number:number},
            success:function(data){
                if(data.status){
                    $('#mobileNumber').append(data.number);
                    $('#moreMobile').html('<a onclick="moreMobile()" href="javascript:void(0)">Add another mobile number</a>')
                }else{
                    $('#optmsg').html('<span style="color:red">Invalid otp code.</span>')
                }
            }
        });
        }else{
            $('#optmsg').html('<span style="color:red">Please enter otp</span>')
        }
    }


    function removeNumber(number) {
       $('#'+number).remove();
       if($('.contact_mobile').val() == null){
            moreMobile();
       }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $('.summernote').summernote({
        tabsize: 2,
        height: 250
      });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BonikBazar\bonikbazar\resources\views/users/post/ad-post.blade.php ENDPATH**/ ?>