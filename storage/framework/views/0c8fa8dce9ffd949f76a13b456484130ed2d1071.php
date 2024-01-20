
<?php $__env->startSection('title', 'Seller Verification'); ?>

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
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
.payment-option ul li .active .checked {opacity: 1;}
.payment-option ul li .checked i{ font-size: 12px; color: white;margin-left: -10px;margin-top: -5px}
.tab-pane{display: block; opacity: 1 !important}
.socialIcon p{display: flex; gap: 5px; align-items: center;}


.open_days label {font-size: 14px !important;}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Main Container  -->
<div class="container bg-white px-0">

    <h2 class="text-center py-3 border-bottom mb-3"><?php if($user->sellerVerify): ?> MEMBERSHIP PLAN <?php else: ?> SELLER VERIFICATION <?php endif; ?></h2>
    <?php if($user->sellerVerify && $user->sellerVerify->status == "pending"): ?>
        <?php if(Session::has('success')): ?>
        <div style="margin: 10px;" class="alert alert-success">
          <strong>Success! </strong> <?php echo e(Session::get('success')); ?>

        </div>
        <?php else: ?>
        <h3 style="padding: 10px; text-align: center;">Verification request already send. <br> <small>Your verify request under review.</small></h3>
        <?php endif; ?>
    <?php else: ?>
   
    <form action="<?php echo e(route('verifyAccount')); ?>" method="post" enctype="multipart/form-data" data-parsley-validate>
        <?php echo csrf_field(); ?>
        <?php if($user->sellerVerify && $user->sellerVerify->status == "reject"): ?>
        <div style="padding: 10px;display: inline-block;background: #fff1f1;width: 100%;">
        <h3>Verified request rejected.</h3>
        <p><strong>Reject reason: </strong><?php echo e($user->sellerVerify->reject_reason); ?></p> </div> 
        <?php endif; ?>
	
        <div class="row">
            <div class="col-md-6">

        		<div class="row ">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="shop_name" class="control-label required">Organization name</label>
                            <input type="text" required class="form-control" id="shop_name" placeholder="Organization name" value="<?php if($user->sellerVerify): ?><?php echo e($user->sellerVerify->shop_name); ?><?php endif; ?>" name="shop_name">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="mobile" class="control-label required w-100">Mobile Number</label>
                        <div class="form-group" id="moreMobile" style="position: relative;">
                            
                            <input type="text" class="form-control" id="mobile" placeholder="Enter Mobile" value="<?php if($user->sellerVerify): ?> <?php echo e($user->sellerVerify->mobile); ?> <?php endif; ?>" name="mobile">
                            
                        </div>
                        <label for="input-email" class="control-label w-100">E-Mail Address</label>
                        <div class="form-group" id="moreEmail" style="position: relative;">
                            <input type="email" class="form-control" id="input-email" placeholder="E-Mail" value="<?php if($user->sellerVerify): ?><?php echo e($user->sellerVerify->email); ?> <?php endif; ?>" name="email">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-1">
                            <span class="required mb-2 d-block">About your shop</span>
                            <textarea required rows="1" class="form-control" id="address" placeholder="Describe your shop about" name="shop_about"><?php if($user->sellerVerify): ?> <?php echo e($user->sellerVerify->shop_about); ?> <?php endif; ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <span class="required mb-2 d-block">Business address</span>
                            <textarea required rows="1" class="form-control" id="address" placeholder="For example: #road:2, #sector: 3, Dhaka-1215" name="address"><?php if($user->sellerVerify): ?> <?php echo e($user->sellerVerify->address); ?> <?php endif; ?></textarea>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <div class="row">
                            <div class="col-6 col-md-6 pl-0 pr-1">
            				    <label class="required mb-2">NID Front Side</label>
            				    <input type="file" accept="image/*" <?php if($user->sellerVerify && $user->sellerVerify->nid_front): ?> data-default-file="<?php echo e(asset('upload/users/'.$user->sellerVerify->nid_front)); ?>" <?php else: ?> required <?php endif; ?> data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M"  class="dropify" name="nid_front" >
            				</div>
            				<div class="col-6 col-md-6 pr-0 pl-1">
            				    <label class="required mb-2">NID Back Side</label>                         
            				    <input type="file" accept="image/*" <?php if($user->sellerVerify && $user->sellerVerify->nid_back): ?> data-default-file="<?php echo e(asset('upload/users/'.$user->sellerVerify->nid_back)); ?>" <?php else: ?> required <?php endif; ?> data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M"  class="dropify" name="nid_back"  >
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 mb-2 trade_license">
        				<label class="required mb-2">Upload Trade License</label>   
        				<div class="d-flex gap">
        				    <input type="file"  <?php if($user->sellerVerify): ?> data-default-file="<?php echo e(asset('upload/users/'.$user->sellerVerify->trade_license)); ?>" <?php else: ?> required <?php endif; ?> data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" class="dropify mr-1" name="trade_license" >
        				    <input type="file" <?php if($user->sellerVerify): ?> data-default-file="<?php echo e(asset('upload/users/'.$user->sellerVerify->trade_license2)); ?>" <?php endif; ?> data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" class="dropify" name="trade_license2">
        				    <input type="file" <?php if($user->sellerVerify): ?> data-default-file="<?php echo e(asset('upload/users/'.$user->sellerVerify->trade_license3)); ?>" <?php endif; ?> data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" class="dropify ml-1" name="trade_license3">
        				</div>
                    </div>
                    
                </div>
            </div>

            <div class="col-md-6">
                
            <div class="row">
                <div class="col-md-12">
                    <label class="required mb-2">SHOP OPEN AND CLOSE TIME</label>
                    <div class="d-flex align-items-center">
                        <input type="time" class="form-control" value="<?php if($user->sellerVerify): ?><?php echo e($user->sellerVerify->open_time); ?><?php endif; ?>" name="open_time" id="name" placeholder="OPEN">
                        <p class="py-2 px-4">TO</p>
                        <input type="time" class="form-control" value="<?php if($user->sellerVerify): ?><?php echo e($user->sellerVerify->close_time); ?><?php endif; ?>" name="closed_time" id="name" placeholder="OPEN">
                    </div>
                </div>
                <div class="col-12 col-md-12 mt-2">
                    <label class="required">Shop Open Days</label>
                    <div class="d-flex flex-wrap gap open_days">
                        <div class="d-flex align-items-center ">
                            <input type="checkbox" name="open_days[]" <?php if($user->sellerVerify && $user->sellerVerify->open_days && in_array("SAT", json_decode($user->sellerVerify->open_days) )): ?> checked <?php endif; ?> value="SAT" id="SAT">
                            <label class="iy" for="SAT">SAT</label>
                        </div>
                        <div class="d-flex align-items-center ">
                            <input type="checkbox" name="open_days[]" <?php if($user->sellerVerify && $user->sellerVerify->open_days && in_array("SUN", json_decode($user->sellerVerify->open_days) )): ?> checked <?php endif; ?> value="SUN" id="SUN">
                            <label class="iy" for="SUN">SUN</label>
                        </div>
                        <div class="d-flex align-items-center">
                            <input type="checkbox" name="open_days[]" <?php if($user->sellerVerify && $user->sellerVerify->open_days && in_array("MON", json_decode($user->sellerVerify->open_days) )): ?> checked <?php endif; ?> value="MON" id="MON">
                            <label class="iy" for="MON">MON</label>
                        </div>
                        <div class="d-flex align-items-center">
                            <input type="checkbox" name="open_days[]" <?php if($user->sellerVerify && $user->sellerVerify->open_days && in_array("TUE", json_decode($user->sellerVerify->open_days) )): ?> checked <?php endif; ?> value="TUE" id="TUE">
                            <label class="iy" for="TUE">TUE</label>
                        </div>
                        <div class="d-flex align-items-center">
                            <input type="checkbox" name="open_days[]" <?php if($user->sellerVerify && $user->sellerVerify->open_days && in_array("WED", json_decode($user->sellerVerify->open_days) )): ?> checked <?php endif; ?> value="WED" id="WED">
                            <label class="iy" for="WED">WED</label>
                        </div>
                        <div class="d-flex align-items-center">
                            <input type="checkbox" name="open_days[]" <?php if($user->sellerVerify && $user->sellerVerify->open_days && in_array("THU", json_decode($user->sellerVerify->open_days) )): ?> checked <?php endif; ?> value="THU" id="THU">
                            <label class="iy" for="THU">THU</label>
                        </div>
                        <div class="d-flex align-items-center">
                            <input type="checkbox" name="open_days[]" <?php if($user->sellerVerify && $user->sellerVerify->open_days && in_array("FRI", json_decode($user->sellerVerify->open_days) )): ?> checked <?php endif; ?> value="FRI" id="FRI">
                            <label class="iy" for="FRI">FRI</label>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-md-12 socialIcon">
                    <br>
                    <p >
                        <img width="40" src="<?php echo e(asset('frontend/images/facebook.svg')); ?>">
                        <input class="form-control" value="<?php if($user->sellerVerify): ?><?php echo e($user->sellerVerify->facebook); ?> <?php endif; ?>" type="text" placeholder="https://facebook.com/username" name="facebook">
                    </p>
                    <p>
                        <img width="40" src="<?php echo e(asset('frontend/images/web.svg')); ?>">
                        <input class="form-control" value="<?php if($user->sellerVerify): ?><?php echo e($user->sellerVerify->website); ?> <?php endif; ?>" type="text" placeholder="https://example.com" name="website">
                    </p>
                    <p>
                        <img width="40" src="<?php echo e(asset('frontend/images/instagram.svg')); ?>">
                        <input class="form-control" value="<?php if($user->sellerVerify): ?><?php echo e($user->sellerVerify->instagram); ?> <?php endif; ?>" type="text" placeholder="https://instagram.com/username" name="instagram">
                    </p>
                    <p>
                        <img width="40" src="<?php echo e(asset('frontend/images/youtube.svg')); ?>">
                        <input class="form-control" value="<?php if($user->sellerVerify): ?><?php echo e($user->sellerVerify->youtube); ?> <?php endif; ?>" type="text" placeholder="https://youtube.com/username" name="youtube">
                    </p>
                    <p>
                        <img width="40" src="<?php echo e(asset('frontend/images/whatsapp.svg')); ?>">
                        <input class="form-control" value="<?php if($user->sellerVerify): ?><?php echo e($user->sellerVerify->whatsapp); ?> <?php endif; ?>" type="text" placeholder="https://wa.me/8801700000000" name="whatsapp">
                    </p>
                </div>

                <?php if(!$user->sellerVerify): ?>
                <div class="col-12 col-md-12">
                    <div class="form-group ">
                        <span class="required">Select Membership</span>
                        <select name="membership" id="membershipPlan" required class="form-control">
                            <option value="" selected disabled>Please Select</option>
                            <?php $__currentLoopData = $memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php if($user->sellerVerify && $user->sellerVerify->membership == $membership->slug): ?> selected <?php endif; ?> value="<?php echo e($membership->slug); ?>"> <?php echo e($membership->name); ?> </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="form-group ">
                        <label> Refer Code</label>
                        <input type="text" name="refer_by" value="<?php echo e(($user->sellerVerify ) ? $user->sellerVerify->refer_by : ''); ?>" id="refer_code" onkeyup="referDiscount()" placeholder="Enter Refer" class="form-control">
                        <p id="refer_msg"></p>
                    </div>
                        
                    <div class=" w-100 ab px-2 py-3 borders my-3">
                        <div class="d-flex align-items-center justify-content-between border-bottom border-dark pb-1 mb-1">
                            <h4 class="">Membership Details:</h4>
                        </div>
                        <div class="d-flex align-items-center justify-content-between fir" id="membershipType">
                            <p><?php if($user->sellerVerify): ?> <?php echo e(ucwords($user->sellerVerify->membership)); ?> Bonik <?php else: ?> Membership <?php endif; ?></p>
                            <p>
                            <select class="form-control">
                                <option value="">Select Membership</option>
                                <?php if($user->sellerVerify && $user->sellerVerify->membershipDuration): ?>
                                <option selected value="<?php echo e($user->sellerVerify->membershipDuration); ?>"><?php echo e($user->sellerVerify->membershipDuration); ?> Month</option> <?php endif; ?>
                            </select></p>
                        </div>
                        <div class=" border-top border-dark pt-1 mt-1">
                            <div id="referDiscountArea">
                                <?php if($user->sellerVerify && $user->sellerVerify->refer_by): ?>
                                <div class="d-flex align-items-center justify-content-between">
                                <p>Amount</p>
                                <b>TK. <span><?php echo e(($user->sellerVerify && $user->sellerVerify->amount) ? $user->sellerVerify->amount + $user->sellerVerify->referAmount : 0); ?></span></b>
                                </div>

                                <div class="d-flex align-items-center justify-content-between">
                                <p>Refer Discount</p>
                                <b>TK. <span>-<?php echo e(($user->sellerVerify && $user->sellerVerify->referAmount) ? $user->sellerVerify->referAmount : 0); ?></span></b>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                            <p>Total Amount</p>
                            <input type="hidden" name="total_price" id="total_price" value="0">
                            <b>TK. <span class="total"><?php echo e(($user->sellerVerify && $user->sellerVerify->amount) ? $user->sellerVerify->amount : 0); ?></span></b>
                            </div>
                        </div>
                    </div>
                    <div class="payment-option" id="paymentMethodOption"> 
                        
                    </div>
                </div>
                <?php else: ?>
                    <input type="hidden" name="membership" value="<?php echo e($user->sellerVerify->membership); ?>">
                    <?php if($user->sellerVerify->status != "active"): ?>
                        <h3 style="color: green">Request for <?php echo e(ucfirst($user->sellerVerify->membership)); ?> membership.</h3>
                    <?php endif; ?>
                <?php endif; ?>
                <div style="text-align: right;margin: 10px;" class="col-12">
                    <div class="pull-right">
                        <input type="submit" class="btn btn-md btn-primary" value="Verify Account">
                    </div>
                </div>
            </div>
            </div>
        </div>
        
    </form>
     
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('js/parsley.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/dropify/dist/js/dropify.min.js"></script>
    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();
    });
</script>
<script type="text/javascript">

	function get_city(id, type=''){
       
        var  url = '<?php echo e(route("get_city", ":id")); ?>';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#show_city"+type).html(data);
                    $("#show_city"+type).focus();
                }else{
                    $("#show_city"+type).html('<option>City not found</option>');
                }
            }
        });
    }  	 

    function get_area(id, type=''){
           
        var  url = '<?php echo e(route("get_area", ":id")); ?>';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#show_area"+type).html(data);
                    $("#show_area"+type).focus();
                }else{
                    $("#show_area"+type).html('<option>Area not found</option>');
                }
            }
        });
    }  

    function paymentMethod(id){
        $("#payment_method"+id).click();   
    }


    $(document).on("change", "#membershipPlan", function(){
       
        var membershipName = $("#membershipPlan :selected").val();

        <?php if(!$user->sellerVerify): ?>
        if(membershipName == 'agent'){
            $("input[name=trade_license]").attr('required', false);
            $('.trade_license label').removeClass('required');
        }else{
            $("input[name=trade_license]").attr('required', true);
            $('.trade_license label').addClass('required');
        } <?php endif; ?>

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
        referDiscount();
    });

    $(document).on("change", "#membershipDuration", function(){    
        var price = $("#membershipDuration :selected").data("price");
        var duration = $("#membershipDuration :selected").data("duration");
        referDiscount();
        if(price > 0){
            $("#total_price").val(price);
            $(".total").html(price);
            $("#paymentMethodOption").html(`
                Select Payment Method  
                <ul class="nav nav-tabs payment-option">
                    <?php $__currentLoopData = $paymentgateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                    <input required type="radio" <?php if($index == 0): ?> checked <?php endif; ?> name="payment_method" id="payment_method<?php echo e($method->id); ?>" value="<?php echo e($method->method_slug); ?>"> 
                    <a onclick="paymentMethod(<?php echo e($method->id); ?>)" <?php if($index == 0): ?> class="active" <?php endif; ?> style="border: 1px solid #6c2eb9;border-radius: 5px; display:block;padding:5px;margin-bottom: 8px;position: relative; margin-right: 15px;text-align: center;" data-toggle="tab" href="#paymentgateway<?php echo e($method->id); ?>"><div class="checked"><i class="fa fa-check"></i></div> <img  width="50"  src="<?php echo e(asset('upload/images/payment/'.$method->method_logo)); ?>"></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <div class=" payment_field">
                    <?php $__currentLoopData = $paymentgateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <?php if($index == 0): ?>
                    <?php if($method->is_default == 1): ?>
                    <div id="paymentgateway<?php echo e($method->id); ?>">
                        <?php echo $method->method_info; ?>

                    </div>
                    <?php else: ?>
                    <div id="paymentgateway<?php echo e($method->id); ?>" >
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
            `);
        }else{
            $(".total").html(0);
            $("#total_price").val(0);
            $("#paymentMethodOption").html("");
        }
    });

    function referDiscount() {
        var membership = $("#membershipPlan :selected").val();
        var price = $("#membershipDuration :selected").data("price");
        var duration = $("#membershipDuration :selected").data("duration");

        $("#total_price").val(price);
        $(".total").html(price);
        $("#referDiscountArea").html('');
        $("#refer_msg").html('');
        var refer_code = $("#refer_code").val();
        if(refer_code){
            $.ajax({ 
                url:"<?php echo e(url('seller/affiliate/discount')); ?>/"+refer_code+"/"+price+"/"+membership+"/"+duration,
                method:'get',
                success:function(data){
                    if(data.status){
                        $("#total_price").val(data.grandTotal);
                        $(".total").html(data.grandTotal);
                        $("#refer_msg").html('<span style="color:green;font-size:14px">'+data.msg+'</span>');
                        $("#referDiscountArea").html(`
                            <div class="d-flex align-items-center justify-content-between">
                            <p>Amount</p>
                            <input type="hidden" name="total_price" id="total_price" value="0">
                            <b>TK. <span>`+price+`</span></b>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                            <p>Refer Discount (`+data.referDiscount+`%)</p>
                            <input type="hidden" name="total_price" id="total_price" value="0">
                            <b>TK. <span>-`+data.referAmount+`</span></b>
                            </div>
                        `);
                    }else{
                        $("#refer_msg").html('<span style="color:red">'+data.msg+'</span>');
                    }
                }
            });
        }
    }


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


    $(document).on("change", "#membershipRequest #membershipDuration", function(){    
        var price = $("#membershipDuration :selected").data("price");
        $("#total_price").val(price);
        $(".total").html(price);
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BonikBazar\bonikbazar\resources\views/users/seller-verify.blade.php ENDPATH**/ ?>