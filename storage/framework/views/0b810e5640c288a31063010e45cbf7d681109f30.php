<input type="hidden" value="<?php echo e($data->id); ?>" name="id">

<div class="col-md-12">
    <div class="form-group">
        <label for="Feature">Product Feature Name</label>
        <input name="name" id="Feature" value="<?php echo e($data->name); ?>" required="" type="text" class="form-control">
    </div>
</div>

<div class="col-md-12">                           
    <div class="form-group">
        <label for="category">Select Category</label>
        <select name="category_id" id="category_id" class="form-control custom-select">
                <option <?php if($data->category_id == 'all'): ?> selected <?php endif; ?> value="all">All Category</option>
             <?php $__currentLoopData = $get_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>" <?php echo e(($category->id == $data->category_id) ?  'selected' : ''); ?>><?php echo e($category->name); ?></option>
                <?php if($category->get_subcategory): ?>
                    <?php $__currentLoopData = $category->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($subcategory->id); ?>" <?php echo e(($subcategory->id == $data->category_id) ?  'selected' : ''); ?>>--<?php echo e($subcategory->name); ?></option>
                         <!-- get sub childcategory -->
                        <?php if($subcategory->get_subcategory): ?>
                        
                            <?php $__currentLoopData = $subcategory->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subchildcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           
                                <option <?php echo e(($subchildcategory->id == $data->category_id) ?  'selected' : ''); ?> value="<?php echo e($subchildcategory->id); ?>"> &nbsp;---<?php echo e($subchildcategory->name); ?></option>
                            
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                        <?php endif; ?>
                        <!-- end sub childcatgory -->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">

    <input <?php if($data->is_required): ?> checked <?php endif; ?> name="is_required" id="is_required" type="checkbox" > <label for="is_required"> Is Requird</label>
    </div>
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
<?php /**PATH D:\BonikBazar\bonikbazar\resources\views/admin/category/edit/product-feature.blade.php ENDPATH**/ ?>