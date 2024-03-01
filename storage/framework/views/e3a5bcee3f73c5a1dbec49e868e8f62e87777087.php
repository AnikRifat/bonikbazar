<input type="hidden" value="<?php echo e($data->id); ?>" name="id">

<div class="col-md-12">
    <div class="form-group">
        <label for="brand">Brand Name</label>
        <input name="name" id="brand" value="<?php echo e($data->name); ?>" required="" type="text" class="form-control">
    </div>
</div>

<div class="col-md-12">                           
    <div class="form-group">
        <label for="category">Select Category</label>
        <select name="category_id" id="category" class="form-control select2 custom-select">
                <option <?php echo e((0 == $data->category_id) ?  'selected' : ''); ?> value="0">All Category</option>
            <?php $__currentLoopData = $get_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>" <?php echo e(($category->id == $data->category_id) ?  'selected' : ''); ?>><?php echo e($category->name); ?></option>
                <?php if($category->get_subcategory): ?>
                    <?php $__currentLoopData = $category->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($subcategory->id); ?>" <?php echo e(($subcategory->id == $data->category_id) ?  'selected' : ''); ?>>--<?php echo e($subcategory->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>

<div class="col-md-12">
    <div class="form-group"> 
        <label class="dropify_image">Brand Logo</label>
        <input data-default-file="<?php echo e(asset('upload/images/brand/thumb/'.$data->logo)); ?>" type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg png gif"  data-max-file-size="2M"  name="phato" id="input-file-events">
        <p class="upload-info">Logo Size: 95px*95px</p>
    </div>
    <?php if($errors->has('phato')): ?>
        <span class="invalid-feedback" role="alert">
            <?php echo e($errors->first('phato')); ?>

        </span>
    <?php endif; ?>
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

<?php /**PATH D:\BonikBazar\bonikbazar\resources\views/admin/edit/brand.blade.php ENDPATH**/ ?>