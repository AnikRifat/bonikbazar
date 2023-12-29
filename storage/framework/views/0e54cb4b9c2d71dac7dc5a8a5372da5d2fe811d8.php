
<?php $__env->startSection('title', 'Package payment |'. Config::get('siteSetting.site_name') ); ?>
<?php $__env->startSection('css'); ?>
  <style type="text/css">
  	.tab-content{padding: 10px;background: #f1f2f4;margin-bottom: 10px;}
  
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

<section class="inner-section">
    <div class="container">
        <div class="row">
        	<div class="col-md-2"></div>

        	<div class="col-md-8 col-xs-12" style="background: #fff;border-radius: 5px;padding-top: 15px;">
        		<h5> Package Details </h5>
	            <div style="background: #f1f2f4;" class="box-inner">
	                <div class="table-responsive checkout-product">
	                  <table  id="order_summary" class="table table-bordered table-hover">
	                    <thead>
	                      <tr>
	                        <th><?php if($package->get_boostAd): ?> Ad Title <?php else: ?> Package <?php endif; ?></th>
	                        <?php if($package->get_package): ?><th>Ads</th>	                        
	                        <?php endif; ?>
	                        <th>Price</th>
	                      </tr>
	                    </thead>
	                    <tbody style="background:#fff">
	                        <tr>
	                          <td>
                                <?php if($package->get_boostAd): ?><img src="<?php echo e(asset('upload/images/product/thumb/'.$package->get_boostAd->feature_image)); ?>" width="50"> <?php echo e($package->get_boostAd->title); ?> <?php else: ?> <?php echo e($package->get_package->name); ?> <?php endif; ?>
                            </td>
                            <?php if($package->get_package): ?>
	                          <td><?php echo e($package->total_ads); ?> ads</td>
	                         <?php endif; ?>
	                         <td ><?php echo e(config('siteSetting.currency_symble')); ?><?php echo e($postFee->price + $postFee->post_fee); ?></td>
	                        </tr>
	                     
	                    </tbody>
	                    
	                  </table>
	                </div>
	              </div>
              <h5>Select Payment Method</h5>
      				<div style="background: #fff; padding-bottom: 0 10px 10px;">
      					
      					<div class="box-inner">          
               		<div id="process"></div>  
                  <?php if(Session::has('error')): ?>
                    <div class="alert alert-danger">
                      <?php echo e(Session::get('error')); ?>

                    </div>
                  <?php endif; ?>      
                  <div class="payment-option">  
                  <ul class="nav nav-tabs">
                      <?php $__currentLoopData = $paymentgateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <li>
                          <input required type="radio" <?php if($index == 0): ?> checked <?php endif; ?> name="payment_method" id="payment_method<?php echo e($method->id); ?>" value="<?php echo e($method->method_slug); ?>"> 
                            <a onclick="paymentMethod(<?php echo e($method->id); ?>)" <?php if($index == 0): ?> class="active" <?php endif; ?> style="border: 1px solid #6c2eb9;border-radius: 5px; display:block;padding:5px;margin-bottom: 8px;position: relative; margin-right: 15px;text-align: center;" data-toggle="tab" href="#paymentgateway<?php echo e($method->id); ?>"><div class="checked"><i class="fa fa-check"></i></div> <img  width="50"  src="<?php echo e(asset('upload/images/payment/'.$method->method_logo)); ?>"></a></li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                  <div class="tab-content payment_field">
                    <?php $__currentLoopData = $paymentgateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($index == 0): ?>
                      <?php if($method->is_default == 1): ?>
                      <div id="paymentgateway<?php echo e($method->id); ?>">
                          <form action="<?php echo e(route('packagePurchasePayment', $package->order_id)); ?>" method="post" <?php if($method->method_slug == 'masterCard'): ?> class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="<?php echo e($method->public_key); ?>"  <?php endif; ?> >
                              <?php echo csrf_field(); ?>
                              <input type="hidden"  name="payment_method" value="<?php echo e($method->method_slug); ?>">
                              
                              <?php echo $method->method_info; ?>

                              
                              <?php if($method->method_slug == 'wallet-balance'): ?>
                                 Your wallet balance: <?php echo e(config('siteSetting.currency_symble').Auth::user()->wallet_balance); ?>

                              <?php endif; ?>

                              <?php if($method->method_slug == 'masterCard'): ?>
                                <div class="form-row">                                    
                                    <div id="card-element" style="width: 100%">
                                         <div class="display-td" >                            
                                            <img class="img-responsive pull-right" src="https://i76.imgup.net/accepted_c22e0.png">
                                          </div>
                                       
                                          <div class="row">
                                            <div class="col-lg-8 col-md-8">
                                            <div class='col-lg-12 col-md-12 col-xs-12 card '> <span class='control-label required'>Card Number</span> <input  autocomplete='off' placeholder='Enter card number' class='form-control card-number' required size='20' type='text'> </div> <div class='col-xs-3  cvc '> <span class='control-label required'>CVC</span> <input autocomplete='off' class='form-control card-cvc' maxlength="3" placeholder='ex. 311' required size='4' type='text'> </div> <div class='col-xs-4 expiration '> <span class='required control-label'>Month</span>  <input maxlength="2" required class='form-control card-expiry-month' placeholder='MM' size='2' type='text'> </div> <div class='col-xs-5 expiration '> <span class='control-label required'>Expiration Year</span> <input class='form-control card-expiry-year' placeholder='YYYY' required size='4' maxlength="4" type='text'> </div>
                                          </div>
                                        </div>
                  
                                        <div class='row'>
                                            <div class='col-md-12 error form-group hide'>
                                                <div style="padding: 5px;margin-top: 10px;" class='alert-danger alert'>Please correct the errors and try again.</div>
                                            </div>
                                        </div>          
                                    </div>
                                  <!-- Used to display Element errors. -->
                                  <div id="card-errors" role="alert"></div>
                                </div>
                              <?php endif; ?>
                            
                            <div class="text-right" >
                            <?php if($method->method_slug == 'wallet-balance'): ?>
                                <?php if(Auth::user()->wallet_balance >= $package->price): ?>
                                  <button  class="btn payButton btn-success"><span><i class="fa fa-money" aria-hidden="true"></i> Pay with wallet balance </span></button>
                               
                                <?php else: ?>
                                 <button title="Insufficient wallet balance" disabled  class="btn btn-success"><span><i class="fa fa-money" aria-hidden="true"></i> Insufficient wallet balance </span></button>
                                <?php endif; ?>
                              <?php else: ?>
                                <button id="<?php echo e($method->method_slug); ?>"  class="btn btn-success payButton"><span><i class="fa fa-money" aria-hidden="true"></i> Pay with <?php echo e($method->method_name); ?></span></button>
                              <?php endif; ?>
                              </div>
                          </form>
                      </div>
                      <?php else: ?>
                      <div id="paymentgateway<?php echo e($method->id); ?>">
                        
                        <?php echo $method->method_info; ?>

                        <form action="<?php echo e(route('packagePurchasePayment', $package->order_id)); ?>" data-parsley-validate method="post">
                          <?php echo csrf_field(); ?>
                          <strong style="color: green;">Pay with <?php echo e($method->method_name); ?>.</strong><br/>
                          <input type="hidden"  name="manual_method_name" value="<?php echo e($method->method_slug); ?>">
                          <?php if($method->method_slug != 'cash'): ?>
                          <strong>Payment Transaction Id</strong>
                          <p><input type="text" required data-parsley-required-message = "Transaction Id is required" placeholder="Enter Transaction Id" value="<?php echo e(old('trnx_id')); ?>" class="form-control" name="trnx_id"></p>
                          <?php endif; ?>
                          <strong>Write Your <?php echo e($method->method_name); ?> Payment Information below.</strong>
                          <textarea required data-parsley-required-message = "Payment Information is required" name="payment_info" style="margin: 0;" rows="2" placeholder="Write Payment Information" class="form-control"><?php echo e(old('payment_info')); ?></textarea>

                          
                          <div class="text-right">
                              <button name="payment_method" value="manual" class="btn btn-success"><span><i class="fa fa-money" aria-hidden="true"></i> Pay <?php echo e($method->method_name); ?></span></button>
                          </div>
                        </form>
                      </div>
                      <?php endif; ?>
                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
              	</div>
                </div>
      				</div>
      			</div>
          
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<script>
  
    function paymentMethod(method){
        $("#payment_method"+method).click();
        var output = ``;
        <?php $__currentLoopData = $paymentgateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            if(method == "<?php echo e($method->id); ?>"){
             output = `<?php if($method->is_default == 1): ?>
                      <div id="paymentgateway<?php echo e($method->id); ?>">
                          <form action="<?php echo e(route('packagePurchasePayment', $package->order_id)); ?>" method="post" <?php if($method->method_slug == 'masterCard'): ?> class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="<?php echo e($method->public_key); ?>"  <?php endif; ?> >
                              <?php echo csrf_field(); ?>
                              <input type="hidden"  name="payment_method" value="<?php echo e($method->method_slug); ?>">
                              
                              <?php echo $method->method_info; ?>

                              
                              <?php if($method->method_slug == 'wallet-balance'): ?>
                                 Your wallet balance: <?php echo e(config('siteSetting.currency_symble').Auth::user()->wallet_balance); ?>

                              <?php endif; ?>

                              <?php if($method->method_slug == 'masterCard'): ?>
                                <div class="form-row">                                    
                                    <div id="card-element" style="width: 100%">
                                         <div class="display-td" >                            
                                            <img class="img-responsive pull-right" src="https://i76.imgup.net/accepted_c22e0.png">
                                          </div>
                                       
                                          <div class="row">
                                            <div class="col-lg-8 col-md-8">
                                            <div class='col-lg-12 col-md-12 col-xs-12 card '> <span class='control-label required'>Card Number</span> <input  autocomplete='off' placeholder='Enter card number' class='form-control card-number' required size='20' type='text'> </div> <div class='col-xs-3  cvc '> <span class='control-label required'>CVC</span> <input autocomplete='off' class='form-control card-cvc' maxlength="3" placeholder='ex. 311' required size='4' type='text'> </div> <div class='col-xs-4 expiration '> <span class='required control-label'>Month</span>  <input maxlength="2" required class='form-control card-expiry-month' placeholder='MM' size='2' type='text'> </div> <div class='col-xs-5 expiration '> <span class='control-label required'>Expiration Year</span> <input class='form-control card-expiry-year' placeholder='YYYY' required size='4' maxlength="4" type='text'> </div>
                                          </div>
                                        </div>
                  
                                        <div class='row'>
                                            <div class='col-md-12 error form-group hide'>
                                                <div style="padding: 5px;margin-top: 10px;" class='alert-danger alert'>Please correct the errors and try again.</div>
                                            </div>
                                        </div>          
                                    </div>
                                  <!-- Used to display Element errors. -->
                                  <div id="card-errors" role="alert"></div>
                                </div>
                              <?php endif; ?>
                            
                            <div class="text-right" >
                            <?php if($method->method_slug == 'wallet-balance'): ?>
                                <?php if(Auth::user()->wallet_balance >= $package->price): ?>
                                  <button  class="btn payButton btn-success"><span><i class="fa fa-money" aria-hidden="true"></i> Pay with wallet balance </span></button>
                               
                                <?php else: ?>
                                 <button title="Insufficient wallet balance" disabled  class="btn btn-success"><span><i class="fa fa-money" aria-hidden="true"></i> Insufficient wallet balance </span></button>
                                <?php endif; ?>
                              <?php else: ?>
                                <button id="<?php echo e($method->method_slug); ?>"  class="btn btn-success payButton"><span><i class="fa fa-money" aria-hidden="true"></i> Pay with <?php echo e($method->method_name); ?></span></button>
                              <?php endif; ?>
                              </div>
                          </form>
                      </div>
                      <?php else: ?>
                      <div id="paymentgateway<?php echo e($method->id); ?>">
                        
                        <?php echo $method->method_info; ?>

                        <form action="<?php echo e(route('packagePurchasePayment', $package->order_id)); ?>" data-parsley-validate method="post">
                          <?php echo csrf_field(); ?>
                          <strong style="color: green;">Pay with <?php echo e($method->method_name); ?>.</strong><br/>
                          <input type="hidden"  name="manual_method_name" value="<?php echo e($method->method_slug); ?>">
                          <?php if($method->method_slug != 'cash'): ?>
                          <strong>Payment Transaction Id</strong>
                          <p><input type="text" required data-parsley-required-message = "Transaction Id is required" placeholder="Enter Transaction Id" value="<?php echo e(old('trnx_id')); ?>" class="form-control" name="trnx_id"></p>
                          <?php endif; ?>
                          <strong>Write Your <?php echo e($method->method_name); ?> Payment Information below.</strong>
                          <textarea required data-parsley-required-message = "Payment Information is required" name="payment_info" style="margin: 0;" rows="2" placeholder="Write Payment Information" class="form-control"><?php echo e(old('payment_info')); ?></textarea>

                          
                          <div class="text-right">
                              <button name="payment_method" value="manual" class="btn btn-success"><span><i class="fa fa-money" aria-hidden="true"></i> Pay <?php echo e($method->method_name); ?></span></button>
                          </div>
                        </form>
                      </div>
                      <?php endif; ?>`;
            }
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        $(".payment_field").html(output); 
    }</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/frontend/package/packagePurchasePaymentGateway.blade.php ENDPATH**/ ?>