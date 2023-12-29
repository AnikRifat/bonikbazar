<input type="hidden" name="id" value="<?php echo e($affiliate->id); ?>">
<div class="col-md-12">
    <div class="form-group">
        <label for="name">Membership</label>
        <select required name="membership" class="form-control">
            <option value="all">All membership</option>
            <?php $__currentLoopData = $memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option <?php if($affiliate->membership == $membership->slug): ?> selected <?php endif; ?> value="<?php echo e($membership->slug); ?>"><?php echo e($membership->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label for="name">Month</label>
        <select name="month" required class="form-control">
            <option value="">Select Month</option>
            <?php for($i=1; $i<=12; $i++): ?>
            <option <?php if($affiliate->month == $i): ?> selected <?php endif; ?> value="<?php echo e($i); ?>"><?php echo e($i); ?> Month</option>
            <?php endfor; ?>
        </select>
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="discount"> Discount(%)</label>
        <input  name="discount" required placeholder="Enter discount" id="discount" value="<?php echo e($affiliate->discount); ?>" type="number" class="form-control">
    </div>
</div><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/admin/affiliate/affiliate-discount-edit.blade.php ENDPATH**/ ?>