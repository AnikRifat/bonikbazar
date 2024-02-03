<input type="hidden" value="<?php echo e($data->id); ?>" name="id">


    <div class="col-md-12">
        <div class="form-group">
            <label for="name" class="required">Categroy</label>
            <select  required name="category_id" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                <option value="">Select Category</option>
                <?php $__currentLoopData = $get_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <option disabled <?php if($data->category_id  == $category->id): ?> selected <?php endif; ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                    <!-- get subcategory -->
                    <?php if(count($category->get_subcategory)>0): ?>
                   
                        <?php $__currentLoopData = $category->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option <?php if($data->category_id  == $subcategory->id): ?> selected <?php endif; ?> value="<?php echo e($subcategory->id); ?>">-- <?php echo e($subcategory->name); ?></option>

                            <!-- get sub childcategory -->
                            <?php if(count($subcategory->get_subcategory)>0): ?>
                             
                                <?php $__currentLoopData = $subcategory->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subchildcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <option <?php if($data->category_id == $subchildcategory->id): ?> selected <?php endif; ?> value="<?php echo e($subchildcategory->id); ?>"> &nbsp;---<?php echo e($subchildcategory->name); ?></option>

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

    <!-- <div class="col-md-6">
        <div class="form-group">
            <label for="name" class="required">Number of ads</label>
            <input name="ads" required placeholder="Example: 50 ads" value="<?php echo e($data->ads); ?>" class="form-control" type="number">
        </div>
    </div> -->

    <div class="col-md-6">
        <div class="form-group"> 
            <label for="name" class="required">Ads duration</label>
            <input name="duration" required placeholder="Example: 7 Days" value="<?php echo e($data->duration); ?>" class="form-control" type="number">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="name" class="required">Price</label>
            <input name="price" required placeholder="Example: <?php echo e(config('siteSetting.currency_symble')); ?>50 " value="<?php echo e($data->price); ?>" class="form-control" type="number">
        </div>
    </div>
    <!-- <div class="col-md-4">
        <div class="form-group">
            <label for="name">Discount(%)</label>
            <input name="discount" value="<?php echo e($data->discount); ?>" placeholder="Example: 10" class="form-control" type="number">
        </div>
    </div> -->
    <!-- <div class="col-md-12">
        <div class="form-group">
            <label for="name">Package Details</label>
            <input name="details" id="name" value="<?php echo e($data->details); ?>"  placeholder="Write details" type="text" class="form-control">
        </div>
    </div> -->
</div>                               
<div class="col-md-12 mb-12">
    <div class="form-group">
        <label class="switch-box">Status</label>
       
            <div  class="status-btn" >
                <div class="custom-control custom-switch">
                    <input name="status" <?php echo e(($data->status == 1) ?  'checked' : ''); ?>   type="checkbox" class="custom-control-input" id="status-edit">
                    <label class="custom-control-label" for="status-edit">Publish/UnPublish</label>
                </div>
            </div>
      
    </div>
</div>

<?php /**PATH D:\BonikBazar\bonikbazar\resources\views/admin/package/edit/packageValue.blade.php ENDPATH**/ ?>