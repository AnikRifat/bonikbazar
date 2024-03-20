
<?php $__env->startSection('title', 'Membership Plan'); ?>

<?php $__env->startSection('css'); ?>
<style type="text/css">
    .payment-option ul li .checked {
  position: absolute;
  top: 0;
  left: 0;
  width: 30px;
  height: 30px;
  background: #6c2eb9;
  -webkit-clip-path: polygon(0 0, 0% 100%, 100% 0);
          clip-path: polygon(0 0, 0% 100%, 100% 0);
  opacity: 0;
}
.payment-option ul li .active .checked {
  opacity: 1;
}
.payment-option ul li .checked i{ font-size: 12px; color: white;
  margin-left: -10px;margin-top: -5px}

</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Main Container  -->
<div class="container bg-white px-0">

    <h2 class="text-center py-3 border-bottom mb-3">MEMBERSHIP PLAN</h2>
    
    <!-- //update membership plan or renew -->
    <form action="<?php echo e(route('membershipRequest')); ?>" id="membershipRequest" method="post" data-parsley-validate>
        <?php echo csrf_field(); ?>
        <?php if(Session::has('success')): ?>
        <div style="margin: 10px;" class="alert alert-success">
          <strong>Success! </strong> <?php echo e(Session::get('success')); ?>

        </div>
        <?php endif; ?>
  
        
        <?php if($user->sellerMembership && $user->sellerMembership->status == "pending"): ?>
            <div style="margin: 10px;" class="alert alert-danger">
                <?php echo e($user->sellerMembership->membership); ?> membership is pending now.
            </div>
        <?php elseif($user->sellerMembership && $user->sellerMembership->status == "reject"): ?>
            <div style="margin: 10px;" class="alert alert-danger">
                <strong>Reject Reason:</strong> <?php echo e($user->sellerMembership->reject_reason); ?>

            </div>

        <?php else: ?>
        <?php if($user->membership): ?>
        <h3 style="text-align: center;color: green"><?php echo e(ucfirst($user->membership)); ?> membership active now.</h3>
        <?php endif; ?>
        <?php endif; ?>
        <div class="row">
            <div class="col-12 col-md-3"></div>
            <div class="col-12 col-md-6">

                <div class="form-group ">
                    <span class="required">Select Membership</span>
                    <select name="membership" id="membershipPlan" required class="form-control">
                        <option value="" selected disabled>Please Select</option>
                        <?php $__currentLoopData = $memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($membership->slug); ?>"> <?php echo e($membership->name); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
               
                <div class=" w-100 ab px-2 py-3 borders my-3">
                    <div class="d-flex align-items-center justify-content-between border-bottom border-dark pb-1 mb-1">
                        <h4 class="">Membership Details:</h4>
                    </div>
                    <div class="d-flex align-items-center justify-content-between fir" id="membershipType">
                        <p> Membership </p>
                        <p>
                        <select required name="membershipDuration" id="membershipDuration" class="form-control">
                            <option value="">Select Month</option>
                        </select></p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between border-top border-dark pt-1 mt-1">
                        <p>Total Amount</p>
                        <input type="hidden" name="total_price" id="total_price" value="0">
                        <b>TK. <span class="total">0</span></b>
                    </div>
                </div>
                <div class="payment-option"> 
                    Select Payment Method 
                    <ul class="nav nav-tabs">
                        <?php $__currentLoopData = $paymentgateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <input required type="radio" <?php if($index == 0): ?> checked <?php endif; ?> name="payment_method" id="payment_method<?php echo e($method->id); ?>" value="<?php echo e($method->method_slug); ?>"> 
                            <a onclick="paymentMethod(<?php echo e($method->id); ?>)" <?php if($index == 0): ?> class="active" <?php endif; ?> style="border: 1px solid #6c2eb9;border-radius: 5px; display:block;padding:5px;margin-bottom: 8px;position: relative; margin-right: 15px;text-align: center;" data-toggle="tab" href="#paymentgateway<?php echo e($method->id); ?>"><div class="checked"><i class="fa fa-check"></i></div> <img  width="50"  src="<?php echo e(asset('upload/images/payment/'.$method->method_logo)); ?>"></a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <div class="tab-content payment_field">
                        <?php $__currentLoopData = $paymentgateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($index == 0): ?>
                        <?php if($method->is_default == 1): ?>
                        <div id="paymentgateway<?php echo e($method->id); ?>" class="tab-pane fade <?php if($index == 0): ?> active show <?php endif; ?>">
                            <?php echo $method->method_info; ?>

                        </div>
                        <?php else: ?>
                        <div id="paymentgateway<?php echo e($method->id); ?>" class="tab-pane fade <?php if($index == 0): ?> active show <?php endif; ?>">
                            <?php echo $method->method_info; ?>

                            <strong style="color: green;">Pay with <?php echo e($method->method_name); ?>.</strong><br/>
                            <?php if($method->method_slug != 'cash'): ?>
                            <strong>Payment Transaction Id</strong>
                            <p><input type="text" data-parsley-required-message = "Transaction Id is required" placeholder="Enter Transaction Id" value="<?php echo e(old('trnx_id')); ?>" class="form-control" name="trnx_id"></p>
                            <?php endif; ?>
                            <strong>Write Your <?php echo e($method->method_name); ?> Payment Information below.</strong>
                            <textarea data-parsley-required-message = "Payment Information is required" name="payment_info" style="margin: 0;" rows="2" placeholder="Write Payment Information" class="form-control"><?php echo e(old('payment_info')); ?></textarea>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  
                </div>
                
                <div style="text-align: right;margin: 10px;" class="buttons clearfix">
                <div class="pull-right">
                    <input type="submit" class="btn btn-md btn-primary" value="Change Membership Request">
                </div>
                </div>
            </div>
    	</div>
    </form>
   
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('js/parsley.min.js')); ?>"></script>

<script type="text/javascript">

    function paymentMethod(method){
        $("#payment_method"+method).click();
        var output = ``;
        <?php $__currentLoopData = $paymentgateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            if(method == "<?php echo e($method->id); ?>"){
             output = ` <?php if($method->is_default == 1): ?>
                      <div id="paymentgateway<?php echo e($method->id); ?>" class="tab-pane fade <?php if($index == 0): ?> active show <?php endif; ?>">
                            <?php echo $method->method_info; ?>

                      </div>
                      <?php else: ?>
                      <div id="paymentgateway<?php echo e($method->id); ?>" class="tab-pane fade <?php if($index == 0): ?> active show <?php endif; ?>">
                        
                        <?php echo $method->method_info; ?>

                          <strong style="color: green;">Pay with <?php echo e($method->method_name); ?>.</strong><br/>
                          <?php if($method->method_slug != 'cash'): ?>
                          <strong>Payment Transaction Id</strong>
                          <p><input type="text"  data-parsley-required-message = "Transaction Id is required" placeholder="Enter Transaction Id" value="<?php echo e(old('trnx_id')); ?>" class="form-control" name="trnx_id"></p>
                          <?php endif; ?>
                          <strong>Write Your <?php echo e($method->method_name); ?> Payment Information.</strong>
                          <textarea  data-parsley-required-message = "Payment Information is required" name="payment_info" style="margin: 0;" rows="1" placeholder="Write Payment Information" class="form-control"><?php echo e(old('payment_info')); ?></textarea>
                        
                      </div>
                      <?php endif; ?>`;
            }
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        $(".payment_field").html(output); 
    }


    $(document).on("change", "#membershipPlan", function(){
       
        var membershipName = $("#membershipPlan :selected").val();

        var output = '';
        <?php $__currentLoopData = $memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            if(membershipName == "<?php echo e($membership->slug); ?>"){
                output = `<p><?php echo e($membership->name); ?></p>
                        <p>
                        <select name="membershipDuration" required id="membershipDuration" class="form-control">
                            <option value="" selected disabled>Select Month</option>
                            <?php $__currentLoopData = $membership->membershipDurations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membershipDuration): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option data-duration="<?php echo e($membershipDuration->duration); ?>" data-price="<?php echo e($membershipDuration->price); ?>" value="<?php echo e($membershipDuration->id); ?>"><?php echo e($membershipDuration->duration ." ". $membershipDuration->type); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select></p>
                    </div>
                    `;
            }

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        $("#membershipType").html(output);
        $(".total").html(0);
        $("#total_price").val(0);
    });

    $(document).on("change", "#membershipDuration", function(){    
        var price = $("#membershipDuration :selected").data("price");
        var duration = $("#membershipDuration :selected").data("duration");
        if(price > 0 && duration > 1){
            $("#total_price").val(price);
            $(".total").html(price);
        }else{
            $(".total").html("Membership free");
            $("#total_price").val(0);
            $("#paymentMethodOption").html("");
        }
    });

    $(document).on("change", "#membershipRequest #membershipDuration", function(){    
        var price = $("#membershipDuration :selected").data("price");
        $("#total_price").val(price);
        $(".total").html(price);
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BonikBazar\bonikbazar\resources\views/users/membership-plan.blade.php ENDPATH**/ ?>