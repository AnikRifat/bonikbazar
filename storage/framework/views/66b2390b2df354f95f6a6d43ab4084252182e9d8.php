
<input type="hidden" value="<?php echo e($data->id); ?>" name="id">


<div class="col-md-12">
    <div class="form-group">
        <label for="city">City</label>
        <input  name="name" id="city" value="<?php echo e($data->name); ?>" required="" type="text" class="form-control">
    </div>
</div>

<div class="col-md-12">                           
    <div class="form-group">
        <label for="state">State name</label>
        <select required name="state_id" id="state" class="form-control custom-select">
            <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($state->id); ?>" <?php echo e(($state->id == $data->state_id) ?  'selected' : ''); ?>><?php echo e($state->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
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

<?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/admin/location/edit/city.blade.php ENDPATH**/ ?>