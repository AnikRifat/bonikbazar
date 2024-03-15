<input type="hidden" name="id" value="<?php echo e($customer->id); ?>">
<div class="form-group">
    <label>Status</label>
    <select required onchange="postStatus(this.value)" name="status" class="form-control">
        <option value="" >Select Status</option>
        
        <?php if($verify): ?>
        <option value="verify" <?php if($customer->verify): ?> selected <?php endif; ?>>Verify</option>
        <option value="reject" <?php if($customer->sellerVerify && $customer->sellerVerify->status == "reject"): ?> selected <?php endif; ?>>Reject</option>
        <?php else: ?>
        <option value="pending" <?php if($customer->status == 'pending'): ?> selected <?php endif; ?> >Pending</option>
        <option value="active" <?php if($customer->status == 'active'): ?> selected <?php endif; ?>>Active</option>
        <option value="deactive" <?php if($customer->status == 'deactive'): ?> selected <?php endif; ?>>Deactive</option>
       
        <option value="band" <?php if($customer->status == 'band'): ?> selected <?php endif; ?>>Band</option>
        <?php endif; ?>
    </select>
</div>


<?php if($verify): ?>
<div class="form-group" id="bandReason"><?php if($customer->sellerVerify &&  $customer->sellerVerify->status == 'reject'): ?><div class="form-group"><label>Reject reason</label><textarea name="reject_reason" class="form-control" placeholder="Write reject reason"><?php echo $customer->sellerVerify->reject_reason; ?></textarea></div><?php endif; ?></div>
<?php endif; ?>
<script type="text/javascript">
     
        function postStatus(status) {
            if(status == 'reject'){
                $('#bandReason').html(`<div class="form-group">
   
</div><div class="form-group"><label>Write reject issue</label><textarea name="reject_reason" class="form-control" placeholder="Write reject reason"><?php if($customer->sellerVerify): ?><?php echo $customer->sellerVerify->reject_reason; ?> <?php endif; ?></textarea></div>`);
            }else{
                 $('#bandReason').html('');
            }

        }
</script><?php /**PATH D:\Workspace\LaravelWorkspace\bonikbazar\resources\views/admin/customer/customerStatus.blade.php ENDPATH**/ ?>