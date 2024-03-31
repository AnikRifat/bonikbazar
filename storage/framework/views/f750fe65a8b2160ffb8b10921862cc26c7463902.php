<?php $__env->startSection('title', 'Edit Post' ); ?>

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
<style>.h-300 .dropify-wrapper {height: 300px !important;}.dropify-wrapper {height: 140px !important;}
.h-500 .dropify-wrapper {height: 600px !important; width: 240px;}

  .adjust-field{cursor: pointer; border: none;border-radius:0;position: absolute;top: 0;right: 0;background: #e9ecef;padding: 7px;}
</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container bg-white mb-2 p-3">
    <div  class="box w-100 py-3" >
        <form action="<?php echo e(route('updateWantedPost', $post->id)); ?>" data-parsley-validate method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        
        <h3 class="border-bottom text-center pb-2 mb-3">Update your post request</h3>
        <div class="row">
            <div class="col-12 col-md-6">
                <label class="mb-2 w-100" for="">Select a category:</label>
                <select name="category" class="form-control gb shadow-b borders">
                    <option value="" selected disabled>Select an option</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       	<?php if(count($category->get_subcategory)>0): ?>
                        <optgroup label="<?php echo e($category->name); ?>">
                            <?php $__currentLoopData = $category->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php if($post->subcategory_id == $subcategory->id): ?> selected <?php endif; ?> value="<?php echo e($subcategory->id); ?>"><?php echo e($subcategory->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </optgroup>
                        <?php else: ?>
                        <option <?php if($post->category_id == $category->id): ?> selected <?php endif; ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label class="mb-2 w-100" for="">Select District</label>
                <select name="location" required class="form-control mb-2 gb shadow-b borders" id="">
                    <option value="" selected disabled>Select an option</option>
                    <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(count($region->get_city)>0): ?>
                            <optgroup label="<?php echo e($region->name); ?>">
                                <?php $__currentLoopData = $region->get_city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php if($post->city_id == $city->id): ?> selected <?php endif; ?> value="<?php echo e($city->id); ?>"><?php echo e($city->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                        <?php else: ?>
                            <option <?php if($post->state_id == $region->id): ?> selected <?php endif; ?> value="<?php echo e($region->id); ?>"><?php echo e($region->name); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label class="mb-2 w-100" for="">Upload ad photo</label>
                <div class="h-300">
                    <input type="file" data-allowed-file-extensions="jpg jpeg png gif" data-default-file="<?php echo e(asset('upload/images/product/'.$post->feature_image)); ?>" <?php if(!$post->feature_image): ?> required <?php endif; ?> data-max-file-size="5M"  class="dropify mt-2 borders shadow-b" name="feature_image">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <label class="mb-2" for="">Type ad title</label>
                <input type="text" name="title" value="<?php echo e($post->title); ?>" placeholder="Title" class="w-100 borders p-2 gb shadow-b rounded-3">
                <label class="my-2" for="">Type ad description</label>
                <textarea name="description" required class="summernote form-control gb shadow-b borders" rows="5" maxlength="5000" placeholder="Describe your message"><?php echo $post->description; ?></textarea>
                <p>Max 5000 character</p>

                <h3 class="font-weight-normal mb-2">CONTACT DETAILS:</h3>
                
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text required">Name:</span>
                    </div>
                    <input type="text" required name="contact_name" value="<?php echo e(($post->contact_name ? $post->contact_name : Auth::user()->name )); ?>" class="form-control" placeholder="Your Name">
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
               
                <button class="yb py-2 text-center bt bb2 rounded font-weight-bold mt-2 float-right px-5">Update Ad</button>
            </div>
        </div>
        </form>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Workspace\LaravelWorkspace\bonikbazar\resources\views/users/post/wanted-post-edit.blade.php ENDPATH**/ ?>