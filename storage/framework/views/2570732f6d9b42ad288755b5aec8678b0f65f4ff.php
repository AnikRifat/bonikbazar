
<div class="row justify-content-md-center">
    <div class="col-md-12">
        <div class="form-group">
            <label class="required" for="reason">Report Reason</label>
            <select required name="reason" class="form-control">
                <option value="">Select reason</option>
            <?php $__currentLoopData = $reportReasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($reason->reason); ?>"><?php echo e($reason->reason); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label class="required" for="reason_details">Please describe your issue.</label>
            <textarea class="form-control" required minlength="6" rows="2" id="reason_details" placeholder="Write reason details" name="reason_details"></textarea>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-danger"> Submit Report</button>
</div><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/users/report/report.blade.php ENDPATH**/ ?>