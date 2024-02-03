<input type="hidden" value="<?php echo e($data->id); ?>" name="id">
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="name required">Package Name</label>
            <input name="name" placeholder="Write package name" id="name" value="<?php echo e($data->name); ?>" required="" type="text" class="form-control">
        </div>
    </div>

    <div class="col-xs-6 col-md-6">
        <div class="form-group">
            <label for="name">Ribbon Image</label>
            <input name="ribbon" id="name" type="file" class="form-control">
            <i style="font-size: 12px;">Image Size: 50px*50px</i>
        </div>
    </div>
    <div class="col-xs-6 col-md-6">
        <div class="form-group">
            <label for="name">Ribbon Position</label>
            <select name="ribbon_position" class="form-control">
                <option <?php if($data->ribbon_position == 'top-left'): ?> selected <?php endif; ?> value="top-left">Top left</option>
                <option <?php if($data->ribbon_position == 'top-right'): ?> selected <?php endif; ?> value="top-right">Top right</option>
                <option <?php if($data->ribbon_position == 'bottom-left'): ?> selected <?php endif; ?> value="bottom-left">Bottom left</option>
                <option  <?php if($data->ribbon_position == 'bottom-right'): ?> selected <?php endif; ?> value="bottom-right">Bottom right</option>
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="name">Bacground Color</label>
            <input name="background_color" type="text" value="<?php echo e($data->background_color); ?>" class="gradient-colorpicker form-control ">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="name">Text Color</label>
            <input name="text_color" value="<?php echo e($data->text_color); ?>" class="gradient-colorpicker form-control" type="text">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="name">Border Color</label>
            <input name="border_color" value="<?php echo e($data->border_color); ?>" class="gradient-colorpicker form-control" type="text">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Package Details</label>
            <textarea name="details" rows="1" id="name" value="<?php echo e(old('details')); ?>" placeholder="Write package details" class="form-control"><?php echo e($data->details); ?></textarea>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="promote_demo">Promote Demo</label>
            <input name="promote_demo" id="promote_demo" type="file" class="form-control">
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
<?php /**PATH D:\BonikBazar\bonikbazar\resources\views/admin/package/edit/package.blade.php ENDPATH**/ ?>