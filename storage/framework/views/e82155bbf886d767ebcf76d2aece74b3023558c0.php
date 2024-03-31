 
<?php $__env->startSection('title', 'Edit Post' ); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('assets')); ?>/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('assets')); ?>/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style>
.select2-container{z-index: 0}
.carousel-indicators li {text-indent:0;}
.carousel-item img{width: 100%}
.dropify-wrapper{height: 130px!important; margin-bottom: 15px;}
.changeBtn{color:green;margin: 5px; font-size:12px;}
.adjust-field{cursor: pointer; border: none;border-radius:0;position: absolute;top: 0;right: 0;background: #e9ecef;padding: 7px;}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container bg-white mb-2 py-3 px-0">
        <form action="<?php echo e(route('post.update',$post->id)); ?>" data-parsley-validate method="post" enctype="multipart/form-data" class="adpost-form">
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
                <a href="javascript:void(0)" style="cursor: not-allowed;">
                <img width="20" class=" mr-2" src="<?php echo e(asset('upload/images/m-1.png')); ?>"> <?php echo e($category->name); ?> </a></div>
                <a href="javascript:void(0)"  style="cursor: not-allowed;">
                <img width="20" class=" mr-1" src="<?php echo e(asset('upload/images/m-2.png')); ?>"> <?php echo e($location->name); ?><?php if($location->state): ?>, <?php echo e($location->state->name); ?> <?php endif; ?> </a>
                </div>
                </div>
            </div>
            
            <div class="col-12 col-md-7 pt-3 border-rr">
                
                    <div class="form-group">
                       
                        <div class="row image">

                            <div class="col-12 col-md-4">
                               
                                <input type="file" data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" name="feature_image" class="dropify" data-default-file="<?php echo e(asset('upload/images/product/thumb/'.$post->feature_image)); ?>" <?php if(!$post->feature_image): ?> required <?php endif; ?>  accept="image/*" >
                            </div>
                            <?php $__currentLoopData = $post->get_galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $galleryImage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div class="col-6 col-md-4 image<?php echo e($galleryImage->id); ?>" >

                                <div class="dropify-wrapper" onclick="removeImage('product_images', '<?php echo e($galleryImage->id); ?>')">
                                    <img src="<?php echo e(asset('upload/images/product/gallery/'.$galleryImage->image_path)); ?>" style="width: 100%;">
                                    <span style="position: absolute;top: 0;right: 0; background: #fff;border: 1px solid #fff;padding: 3px;color: red;">Delete</span>
                                </div>
                            </div>
 
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php for($i=count($post->get_galleryImages); $i<(Auth::user()->membership ? 8 : 4); $i++): ?>
                            <div class="col-6 col-md-4">
                               <input type="file" data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" name="gallery_image[]" class="dropify" accept="image/*" >
                            </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                
                <!--<div class="d-flex flex-wrap">-->
                <!--    <div class="d-flex align-items-center mr-2">-->
                <!--        <input name="sale_type"  <?php if($post->sale_type == 'new'): ?> checked <?php endif; ?> value="new" type="radio" id="NEW" checked>-->
                <!--        <label class="iy" for="NEW">NEW</label>-->
                <!--    </div>-->
                <!--    <div class="d-flex align-items-center mr-2">-->
                <!--        <input name="sale_type" <?php if($post->sale_type == 'used'): ?> checked <?php endif; ?> value="used"  type="radio" id="USED">-->
                <!--        <label class="iy" for="USED">USED</label>-->
                <!--    </div>-->
                    
                <!--</div>-->

                
                <div class="row"> 

                <?php if(Auth::user()->getMembership && Auth::user()->getMembership->slug == "wholesale"): ?>
                <div class="col-md-6 col-lg-6 p-1">
                    <label>Minimum quantity</label>
                    <input type="text" class="form-control" value="<?php echo e($post->wholesale_qty); ?>" placeholder="Enter qty" name="wholesale_qty">
                </div>
                <?php endif; ?>
                <?php if(count($brands)>0): ?>
                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="required" for="brand">Brand </label>
                        <select name="brand" required id="brand" style="width:100%" id="brand" data-parsley-required-message = "Brand is required" class="select2 form-control custom-select">
                           <option value="">Select Brand</option>
                           <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option  <?php if($post->brand_id == $brand->id): ?> selected <?php endif; ?>  value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       </select>
                   </div>
                </div>
                <?php endif; ?>
                
                <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 col-lg-6 p-1">
                        <input type="hidden" name="attribute[<?php echo e($attribute->id); ?>]" value="<?php echo e($attribute->name); ?>">
                    
                        <div class="form-group">
                            <label class="<?php if($attribute->is_required == 1): ?> required <?php endif; ?>"><?php echo e($attribute->name); ?></label>
                            <?php if($attribute->display_type == 1): ?>
                                <?php if(count($attribute->get_attrValues)>0): ?>
                                <ul class="form-check-list">
                                    <?php $__currentLoopData = $attribute->get_attrValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <input name="attributeValue[<?php echo e($attribute->id); ?>][]" <?php if($attribute->is_required == 1): ?> required <?php endif; ?> <?php if($value->get_productVariant): ?> checked <?php endif; ?> value="<?php echo e($value->id); ?>" type="checkbox" class="form-check" id="attributeValue<?php echo e($value->id); ?>">
                                        <label for="attributeValue<?php echo e($value->id); ?>" class="form-check-text"><?php echo e($value->name); ?></label>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <?php endif; ?>
                            <?php elseif($attribute->display_type == 3): ?>
                            <?php if(count($attribute->get_attrValues)>0): ?>
                                <ul class="form-check-list">
                                    <?php $__currentLoopData = $attribute->get_attrValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <input name="attributeValue[<?php echo e($attribute->id); ?>][]" <?php if($value->get_productVariant): ?> checked <?php endif; ?> <?php if($attribute->is_required == 1): ?> required <?php endif; ?> value="<?php echo e($value->id); ?>" type="radio" class="form-check" id="attributeValue<?php echo e($value->id); ?>">
                                        <label for="attributeValue<?php echo e($value->id); ?>" class="form-check-text"><?php echo e($value->name); ?></label>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <?php endif; ?>

                            <?php else: ?>
                            <select class="form-control" <?php if($attribute->is_required == 1): ?> required <?php endif; ?> name="attributeValue[<?php echo e($attribute->id); ?>][]">
                                <?php if($attribute->get_attrValues): ?>
                                    <?php if(count($attribute->get_attrValues)>0): ?>
                                        <option value="">Select one</option>
                                        <?php $__currentLoopData = $attribute->get_attrValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($value->get_productVariant): ?> selected <?php endif; ?> value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <option value="">Value Not Found</option>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </select>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
                                <input <?php if($feature->is_required): ?> required <?php endif; ?> type="text" name="featureValue[<?php echo e($feature->id); ?>]" value="<?php echo e(($feature->featureValue) ? $feature->featureValue->value : null); ?>" class="form-control" placeholder="Input value here">
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                </div>
                
               
                <div class="form-group">
                    <label class="required">Ad Title</label>
                    <input name="title" value="<?php echo e($post->title); ?>" required type="text" class="form-control" placeholder="Type your title here">
                </div>
                
                <div class="form-group">
                    <label class="required">Description</label>
                    <textarea name="description" required class="summernote form-control" rows="4" placeholder="Describe your message"><?php echo $post->description; ?></textarea>
                    <p>Max 5000 character</p>
                </div>
            </div>
            <div class="col-12 col-md-5 pt-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text required" id="basic-addon1">TK </span>
                    </div>
                    <input type="text" name="price" value="<?php echo e($post->price); ?>" required class="form-control borders" placeholder="Enter your price" aria-label="Username" aria-describedby="basic-addon1">
                    <div class="input-group-append input-group-text">
                        <input id="negotiable" name="negotiable"  <?php if($post->negotiable == 1): ?> checked <?php endif; ?> type="checkbox" value="1">
                        <label for="negotiable"><small>Negotiable</small></label>
                    </div>
                </div>
                
                <h3 class="font-weight-normal mb-2">CONTACT DETAILS:</h3>
                
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text required">Name:</span>
                    </div>
                    <input type="text" required name="contact_name" value="<?php echo e(($post->contact_name ? $post->contact_name : Auth::user()->name )); ?>" class="form-control" placeholder="Your Name">
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
                            <?php if($post->contact_mobile): ?>
                            <?php $__currentLoopData = json_decode($post->contact_mobile); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $number): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                                <div id="<?php echo e($number); ?>" class="addNumber">
                                <input type="hidden" name="contact_mobile[]" value="<?php echo e($number); ?>">
                                <i class="fa fa-check-square"></i> <strong><?php echo e($number); ?> </strong><a class="removeNumber" href="javascript:void(0)" onclick="removeNumber('<?php echo e($number); ?>')" title="Remove phone number">✕
                                </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <span id="moreMobile"><a onclick="moreMobile()" href="javascript:void(0)">Add another mobile number</a></span>
                        </div>
                    </div>
                    <div>
                        <input id="contact_hidden" name="contact_hidden" <?php if($post->contact_hidden == 1): ?> checked <?php endif; ?> type="checkbox" value="1">
                        <label for="contact_hidden">Hide mobile number(s)</label>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
            <div class="form-group" style="text-align: right;">
                <button class="btn btn-inline">
                    <i class="fas fa-check-circle"></i>
                    <span>Update Your Ad</span>
                </button>
            </div>
            </div>
        </div>

        </form>
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

    function removeImage(table, id){
        if ( confirm("Are you sure delete it.?")) {
                   
            $.ajax({
                url:"<?php echo e(route('user.imageDelete')); ?>",
                method:"get",
                data: {table:table, id:id},
                success:function(data){
                    if(data){
                        $('.image'+id).html('<input type="file" data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" name="gallery_image['+id+']" class="dropify" accept="image/*" >');
                        
                        $('.dropify').dropify();
                        toastr.success(data.msg);
                    }
                }
            }); 
        }
        return false;
    }

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

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Workspace\LaravelWorkspace\bonikbazar\resources\views/users/post/ad-post-edit.blade.php ENDPATH**/ ?>