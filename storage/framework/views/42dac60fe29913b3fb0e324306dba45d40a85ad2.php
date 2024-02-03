<input type="hidden" value="<?php echo e($data->id); ?>" name="id">

    <div class="col-md-12">
        <div class="form-group">
            <label for="method_name">Gateway Name</label>
            <input name="method_name" id="method_name" value="<?php echo e($data->method_name); ?>" required="" type="text" class="form-control">
        </div>
    </div>

<?php if($data->method_for != 'payment'): ?>


    <?php if($data->is_default != null): ?>
    <?php if($data->method_slug == 'nagad'): ?>

    <div class="col-md-6">
        <div class="form-group">
            <label for="merchant_number">Merchant Number</label>
            <input name="merchant_number" id="merchant_number" value="<?php echo e($data->merchant_number); ?>" placeholder="Enter merchant number" type="text" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="merchant_id">Merchant ID</label>
            <input name="merchant_id" id="merchant_id" value="<?php echo e($data->merchant_id); ?>" placeholder="Enter merchant id" type="text" class="form-control">
        </div>
    </div>
    <?php endif; ?>
    <div class="col-md-6">
        <div class="form-group">
            <label for="public_key">Public Key</label>
            <input name="public_key" id="public_key" value="<?php echo e($data->public_key); ?>" placeholder="Enter public key" type="text" class="form-control">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="secret_key">Secret Key</label>
            <input name="secret_key" id="secret_key" value="<?php echo e($data->secret_key); ?>" placeholder="Enter secret key" type="text" class="form-control">
        </div>
    </div>
    <?php endif; ?>

        <div class="col-md-12">
        <div class="form-group">
            <span for="location_id">Shipping Location</span>
            <select name="location_id[]" id="showMenuSourch" class="select2 m-b-10 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Choose">
                 <?php $shipping_location = ($data->location_id) ? json_decode($data->location_id) : []; ?>
                <option  <?php if(in_array('all', $shipping_location)): ?> selected <?php endif; ?> value="all">All Location</option>
                <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option  <?php if(in_array($location->id, $shipping_location)): ?> selected <?php endif; ?> value="<?php echo e($location->id); ?>"><?php echo e($location->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
           
        </div>
    </div>
<?php endif; ?>
     <div class="col-md-12">
        <div class="form-group">
            <label for="method_info">Gateway Details</label>
            <textarea rows="1" name="method_info" id="method_info" type="text" style="resize: vertical;" class="form-control summernote"><?php echo $data->method_info; ?></textarea>
        </div>
    </div>
<div class="col-md-6">
    <div class="form-group"> 
        <label class="dropify_image">Method Logo</label>
        <input data-default-file="<?php echo e(asset('upload/images/payment/'.$data->method_logo)); ?>" type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg png gif"  data-max-file-size="2M"  name="method_logo" id="input-file-events">
    </div>
    <?php if($errors->has('method_logo')): ?>
        <span class="invalid-feedback" role="alert">
            <?php echo e($errors->first('method_logo')); ?>

        </span>
    <?php endif; ?>
</div>




<?php /**PATH D:\BonikBazar\bonikbazar\resources\views/admin/payments/edit/payment-gateway.blade.php ENDPATH**/ ?>