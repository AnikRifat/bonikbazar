<input type="hidden" value="<?php echo e($data->id); ?>" name="id">

<div class="col-md-12">
    <div class="form-group">
        <label for="subcategory">Subcategory Name</label>
        <input name="name" id="subcategory" value="<?php echo e($data->name); ?>" required="" type="text" class="form-control">
    </div>
</div>

<div class="col-md-12">                           
    <div class="form-group">
        <label for="category">Select Category</label>
        <select name="parent_id" id="category" class="form-control custom-select">
            <?php $__currentLoopData = $get_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>" <?php echo e(($category->id == $data->parent_id) ?  'selected' : ''); ?>><?php echo e($category->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>

<div class="col-md-12">
    <div class="form-group"> 
        <label class="dropify_image">Feature Image</label>
        <input data-default-file="<?php echo e(asset('upload/images/category/'.$data->image)); ?>" type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg png gif"  data-max-file-size="2M"  name="phato" id="input-file-events">
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

<?php /**PATH D:\BonikBazar\bonikbazar\resources\views/admin/category/edit/subcategory.blade.php ENDPATH**/ ?>