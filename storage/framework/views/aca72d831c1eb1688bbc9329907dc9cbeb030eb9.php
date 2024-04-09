 
<?php $__env->startSection('title', 'Promote Ad' ); ?>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('frontend')); ?>/css/custom/ad-post.css">
<style type="text/css">
    .packageBox{cursor: pointer; position: relative; border: 2px solid #bdbdbd;border-radius: 16px;padding: 10px;margin-bottom: 10px !important;width: 100%;}
    .packageValue{border: 1px solid #a3dca2; border-radius: 16px;padding: 3px 10px;margin-bottom: 5px; color: #279625;}
    .adpost-plan-list input[type="radio"]:checked + label { border-color: #3db83a; }

    .packageValueList input[type="radio"]:checked + label {background-color: #a3dca2;color: #279625;}
    .adpost-plan-list input[type="radio"]{display: none;}
</style>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 
    <!--=====================================
                ADPOST PART START
    =======================================-->
    <section class="user-area">
        <div class="container">
            
            <form action="<?php echo e(route('ads.promote', $adsSlug)); ?>" data-parsley-validate method="post" enctype="multipart/form-data" class="adpost-form">
            <?php echo csrf_field(); ?>
            <input type="hidden" class="postPrice" value="0" name="postPrice">
            <div class="container bg-white mb-3 py-3">
            
            <div class="row flex-md-row-reverse">
                <div class="col-md-4 col-sm-12 pr-md-0 px-0 pl-md-3">
                    <div class="yb bt p-2 borders mb-2 rounded text-center">Preview Boost ADS</div>
                    <div class="w-100 ab p-2 mb-2 position-relative">
                        <a class="w-100" target="_blank" href="<?php echo e(route('post_details', $post->slug)); ?>">
                            <div class="position-relative">
                                <div class="d-flex align-items-center position-absolute left-0 top-0 ">
                                    <div class="yb bt px-3 font-weight-bold"><?php echo e(strtoupper($post->sale_type)); ?></div>
                                    <div class="ff"></div>
                                </div>
                                
                                <img class="lazyload w-100" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/'.$post->feature_image)); ?>" alt="">
                            </div>
                            <div class="w-100">
                                <h4 class="font-weight-bold bt py-1" title=""><?php echo e($post->title); ?></h4>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="bt py-1" title=""><?php echo e($post->get_state->name ?? ''); ?></p>
                                        <p class="bt py-1" title=""><?php echo e($post->get_subcategory->name ?? ''); ?></p>
                                    </div>
                                    
                                </div>
                                
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="font-weight-bold bt py-1"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($post->price)); ?></h4>
                                    <p class="bt py-1"><?php echo e(Carbon\Carbon::parse(($post->approved ? $post->approved : $post->created_at))->diffForHumans()); ?></p>
                                </div>
                            </div>
                        </a>
                        
                    </div>
                </div>
                <div class="col-md-8 col-sm-12 px-0 promote">
                    <?php $__currentLoopData = $packageTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row borders shadow-sm p-3 mb-2">
                        <div class="col-md-8 col-sm-12 px-0 border-rr">
                            <div class="d-flex align-items-center">
                                <img width="50" height="50" class="mr-2" src="<?php echo e(asset('upload/images/package/'.$package->ribbon)); ?>" alt="banner">
                                <div class="">
                                    <h3 class="font-weight-bold"><?php echo e($package->name); ?></h3>
                                    <p><?php echo $package->details; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 pr-0">
                            <?php $__currentLoopData = $package->get_packageVlues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $packageValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p class="package">
                            <input data-package="<?php echo e($package->name); ?>" data-duration="<?php echo e($packageValue->duration); ?>" data-price="<?php echo e($packageValue->price); ?>" name="package[<?php echo e($package->id); ?>]" value="<?php echo e($packageValue->id); ?>" type="checkbox" id="<?php echo e($packageValue->id); ?>" />
                            <label for="<?php echo e($packageValue->id); ?>"><?php echo e($packageValue->duration); ?> days - <?php echo e(config('siteSetting.currency_symble') . $packageValue->price); ?></label>
                            </p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-8 col-sm-12 p-2 mb-3 ab">
                    <h4 class="border-bottom border-dark pb-1 mb-1">Payment Details</h4>
                    <div id="paymentList">
                    
                    </div>
                    <div class="d-flex align-items-center justify-content-between border-top border-dark pt-1 mt-1">
                        <p>Total Ammount </p>
                        <p>-</p>
                        <b><?php echo e(config('siteSetting.currency_symble')); ?> <span id="TotalPrice">0</span></b>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 px-0" id="promoteBtn"></div>
                <a href="<?php echo e(route('post.list')); ?>">Skip Promote</a>
            </div>
        </div>  

        </form>
                
        </div>
    </section>
    <!--=====================================
                ADPOST PART END
    =======================================-->
    <div class="modal fade" id="promte_demo_modal" role="dialog"   style="display: none;">
        <div class="modal-dialog" style="max-width: 95%;">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Promote Ad View</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div style="text-align:center;" id="promote_demo">
                
            </div>
          </div>
        </div>
    </div>
    <script type="text/javascript">
         function promteDemo(id) {
            $('#promte_demo_modal').modal('show');
            var  url = '<?php echo e(route("package_demo", ":id")); ?>';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                         $('#promote_demo').html(data);
                    }else{
                        $("#promote_demo").html('');
                    }
                }
            });
           
           
        }
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
    
    $('input[type="checkbox"]').on('change', function() {
        $('input[name="' + this.name + '"]').not(this).prop('checked', false);

        var total = 0;
        var paymentList = '';
        $('.package :checked').each(function () {
            var package = $(this).data('package');
            var duration = $(this).data('duration');
            var price = $(this).data('price');
            total = parseInt(total) + parseInt(price);

            paymentList += `<div class="d-flex align-items-center justify-content-between">
                <p>`+package+` </p>
                <p>`+duration+` Days</p>
                <p><?php echo e(config('siteSetting.currency_symble')); ?> `+price+`</p>
            </div>`;
        });
        $('#TotalPrice').html(total);
        $('#paymentList').html(paymentList);

        if(total > 0){
            $('#promoteBtn').html("<button class='yb bt p-2 borders mb-2 rounded text-center'>Promote Now</button>");
            $('.postPrice').val(total);
        }else{
            $('#promoteBtn').html('');
            $('.postPrice').val(0);
        }
    });



</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Minhaz\bonikbazar\resources\views/users/post/promoteAds.blade.php ENDPATH**/ ?>