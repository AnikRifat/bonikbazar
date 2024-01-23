<input type="hidden" value="<?php echo e($data->id); ?>" name="id">

<div class="col-md-12">
    <div class="form-group">
        <label for="subcategory">Product Attribute Name</label>
        <input name="name" id="subcategory" value="<?php echo e($data->name); ?>" required="" type="text" class="form-control">
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



<div class="col-md-6" >
    <span>Select display type</span>
    <div class="row form-group">
        <div class="custom-control custom-radio">
            <input value="1" type="radio" <?php if($data->display_type == 1): ?> checked <?php endif; ?> id="editflat" name="display_type" class="custom-control-input">
            <label class="custom-control-label" for="editflat">Checkbox</label>
        </div>
        <div class="custom-control custom-radio">
            <input value="2" type="radio" <?php if($data->display_type == 2): ?> checked <?php endif; ?> id="editselect" name="display_type" class="custom-control-input">
            <label class="custom-control-label" for="editselect">Select</label>
        </div>
        <div class="custom-control custom-radio">
            <input value="3" <?php if($data->display_type == 3): ?> checked <?php endif; ?> type="radio" id="editradio" name="display_type" class="custom-control-input">
            <label class="custom-control-label" for="editradio">Radio</label>
        </div>

        <div class="custom-control custom-radio">
            <input value="4" <?php if($data->display_type == 4): ?> checked <?php endif; ?> type="radio" id="editdropdown" name="display_type" class="custom-control-input">
            <label class="custom-control-label" for="editdropdown">Dropdown</label>
        </div>
    </div>
</div>
<div class="col-md-3">
    <span>Field is requird</span>
    <div class="form-group">
        <input  name="is_required"  <?php if($data->is_required): ?> checked <?php endif; ?> id="eeditis_required" type="checkbox" > <label for="eeditis_required"> Yes/No</label>
    </div>
</div>
<div class="col-md-3">
    <span>Show in filter</span>
    <div class="form-group">
        <input  name="is_filter"  <?php if($data->is_filter): ?> checked <?php endif; ?> id="editfilter" type="checkbox"> <label for="editfilter"> Yes/No </label>
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
<?php /**PATH D:\BonikBazar\bonikbazar\resources\views/admin/category/edit/product-attribute.blade.php ENDPATH**/ ?>