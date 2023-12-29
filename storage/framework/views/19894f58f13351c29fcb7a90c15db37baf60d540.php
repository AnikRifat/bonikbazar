<form  onsubmit="return confirm('Are you sure update this package payment info.?')" action="<?php echo e(route('changePaymentStatus')); ?>" method="post">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-md-12">
        	<input type="hidden" name="id" value="<?php echo e($order->order_id); ?>">
            <table class="">
                <tr><td style="font-weight: bold;">Customer Name:</td><td> <?php echo e($order->customer->name); ?></td></tr>
                <tr><td style="font-weight: bold;">Payble Amount:</td><td>  <?php echo e($order->currency_sign . $order->total_price); ?></td>
                </tr>
                
                
            </table>
      
            <span style="font-weight: bold;">Payment Information:</span><br/>
            <?php if($order->tnx_id): ?> Trnx Id: <?php echo e($order->tnx_id); ?> <br> <?php endif; ?> <?php echo e($order->payment_info); ?>

            
        </div>

 

        <div class="col-md-12">
            <label for="notes">Payment Status</label>
            <select name="payment_status" required="" class="form-control" id="status">
                <option value="">Select Status</option>
                <option <?php if($order->payment_status== 'pending'): ?> selected <?php endif; ?> value="pending">Pending</option>
                <option <?php if($order->payment_status== 'paid'): ?> selected <?php endif; ?> value="paid">Paid</option>
                
            </select>
        </div>

       
        <div class="col-md-12">
           
            <div class="modal-footer">
                <button type="submit" id="submitBtn" class="btn btn-success"> <i class="fa fa-save"></i> Update payment</button>
            </div>
        </div>
       
    </div>
</form><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/admin/package/paymentCheckModal.blade.php ENDPATH**/ ?>