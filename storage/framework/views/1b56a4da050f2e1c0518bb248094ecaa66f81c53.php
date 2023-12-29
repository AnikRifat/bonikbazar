
<input type="hidden" value="<?php echo e($data->id); ?>" name="id">


<div class="col-md-12">
    <div class="form-group">
        <label for="state">State</label>
        <input  name="name" id="state" value="<?php echo e($data->name); ?>" required="" type="text" class="form-control">
    </div>
</div>

<div class="col-md-12">                           
    <div class="form-group">
        <label for="country">Country name</label>
        <select required name="country_id" id="country" class="form-control custom-select">
            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($country->id); ?>" <?php echo e(($country->id == $data->country_id) ?  'selected' : ''); ?>><?php echo e($country->name); ?></option>
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

<?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/admin/location/edit/state.blade.php ENDPATH**/ ?>