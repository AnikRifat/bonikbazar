<form  onsubmit="return confirm('Are you sure update this ad payment info.?')" action="<?php echo e(route('addvertisement.changeAdPaymentStatus')); ?>" method="post">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-md-12">
        	<input type="hidden" name="id" value="<?php echo e($addvertisement->id); ?>">
            <table class="">
                <tr><td style="font-weight: bold;">Customer Name:</td><td> <?php echo e($addvertisement->customer->name); ?></td></tr>
                <tr><td style="font-weight: bold;">Payble Amount:</td><td>  <?php echo e($addvertisement->amount); ?></td>
                </tr>
            </table>
      
            <span style="font-weight: bold;">Payment Information:</span><br/>
            <?php if($addvertisement->tnx_id): ?> Trnx Id: <?php echo e($addvertisement->tnx_id); ?> <br> <?php endif; ?> <?php echo e($addvertisement->payment_info); ?>

            
        </div>

        <div class="col-md-12">
            <label for="notes">Payment Status</label>
            <select name="payment_status" required="" class="form-control" id="status">
                <option value="">Select Status</option>
                <option <?php if($addvertisement->payment_status== 'pending'): ?> selected <?php endif; ?> value="pending">Pending</option>
                <option <?php if($addvertisement->payment_status== 'paid'): ?> selected <?php endif; ?> value="paid">Paid</option> 
            </select>
        </div>

        <div class="col-md-12">
            <div class="modal-footer">
                <button type="submit" id="submitBtn" class="btn btn-success"> <i class="fa fa-save"></i> Update payment</button>
            </div>
        </div>
       
    </div>
</form><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/admin/addvertisement/paymentCheckModal.blade.php ENDPATH**/ ?>