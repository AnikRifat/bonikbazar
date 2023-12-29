
<?php $__env->startSection('title', $user->name. ' | Profile'); ?>
<?php $__env->startSection('css'); ?>
<style type="text/css">
    .open_time{color: green}
    .close_time{color: red}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php if($user->getMembership): ?>
    <div class="container bg-white p-0 pb-3 mb-2">
        <div>
            <?php if($user->cover_photo): ?>
            <div style="position: relative;">
                <img class="lazyload mw-100 h-300" style="width:100%" src="<?php echo e(asset('upload/users/'.$user->cover_photo)); ?>">
            </div>
            <?php endif; ?>
            <div class="row mt4"> 
                <div class="col-md-6 col-12 d-flex align-items-end mb-2">
                    <img class="by2 w-150 rounded mr-2 bg-white" src="<?php echo e(asset('upload/users')); ?>/<?php echo e(($user->photo) ? $user->photo : 'default.png'); ?>">
                    <div>
                        <h3><?php echo e($user->sellerVerify->shop_name); ?></h3>
                        <div class="hidden-xs">
                            <?php if($user->getMembership): ?>
                            <div class="d-flex align-items-center">
                                <img class="lazyload" width="25" src="<?php echo e(asset('upload/images/membership/'. $user->getMembership->ribbon)); ?>">
                                <p class="bt"><?php echo e($user->getMembership->name); ?></p>
                            </div>
                            <?php endif; ?>
                            <p>Member Since <?php echo e(Carbon\Carbon::parse($user->created_at)->format(Config::get('siteSetting.date_format'))); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-end align-items-end">
                    <div class="hidden-xs">
                        <a
                        <?php if(Auth::check()): ?>
                            onclick="report(<?php echo e($user->id); ?>)" data-toggle="tooltip"
                        <?php else: ?>
                            data-toggle="modal" data-target="#so_sociallogin"
                        <?php endif; ?>
                        class="btn py-1 px-4 e6 text-red bb2 rounded shadow-bb font-weight-bold" href="javascript:void(0)">Report</a>
                        <a
                        <?php if(Auth::check()): ?>
                            onclick="follower(<?php echo e($user->id); ?>)"
                        <?php else: ?>
                            data-toggle="modal" data-target="#so_sociallogin"
                        <?php endif; ?>
                        class="btn user-f" id="follower" href="javascript:void(0)">
                            <?php if(Auth::check() && App\Models\FavoriteSeller::where('user_id', Auth::id())->where('follower_id', $user->id)->first()): ?>
                            <div class="followy">Unfollow</div>
                            <?php else: ?>
                            <div class="follow">Follow</div>
                            <?php endif; ?>
                        </a>
                    </div>
                   
                </div>
            </div>
        </div>
        <div class="d-md-none">
            <div class="row">
                <div class="col-6">
                    <div class="d-flex align-items-center">
                        <p class="mr-2">Bonik ID: </p>
                        <b><?php echo e($user->seller_id); ?></b>
                    </div>
                    <?php if($user->getMembership): ?>
                    <div class="d-flex align-items-start">
                        <img class="lazyload" width="25" src="<?php echo e(asset('upload/images/membership/'. $user->getMembership->ribbon)); ?>">
                        <div>
                            <p class="bt"><?php echo e($user->getMembership->name); ?></p>
                            <p>Member Since <?php echo e(Carbon\Carbon::parse($user->created_at)->format(Config::get('siteSetting.date_format'))); ?></p>
                        </div>
                        
                    </div>
                    <?php endif; ?>
                    <div class="d-flex align-items-center pb-2">
                        <img width="25" height="25" class="mr-2" src="<?php echo e(asset('upload/images/time.png')); ?>" alt="logo">
                        <div class="w-100">
                            <?php if($user->sellerVerify): ?>
                           
                            <div class="d-flex justify-content-between">
                                <?php if($user->sellerVerify->open_time <= date("H:i:s") && $user->sellerVerify->close_time >= date("H:i:s") ): ?>
                                <p class="open_time">Now Open</p>
                                <?php else: ?>
                                <p class="close_time">Closed</p>
                                <?php endif; ?>
                            </div>
                            <b>
                                <?php echo e(Carbon\Carbon::parse($user->sellerVerify->open_time)->format("h:i A")); ?> - <?php echo e(Carbon\Carbon::parse($user->sellerVerify->close_time)->format("h:i A")); ?></b>
                             <?php endif; ?>
                        </div>
                    </div>
                    <div class="d-flex align-items-center pb-2">
                        <img width="25" height="25" class="mr-2" src="<?php echo e(asset('upload/images/maps.png')); ?>" alt="logo">
                        <b>
                            <?php if($user->sellerVerify->address): ?>
                                <?php echo e($user->sellerVerify->address); ?>

                            <?php endif; ?>
                        </b>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex align-items-center justify-content-end">
                        <a
                            <?php if(Auth::check()): ?>
                                onclick="report(<?php echo e($user->id); ?>)" data-toggle="tooltip"
                            <?php else: ?>
                                data-toggle="modal" data-target="#so_sociallogin"
                            <?php endif; ?>
                            class="btn py-1 px-4 e6 text-red bb2 rounded shadow-bb font-weight-bold" href="javascript:void(0)">Report
                        </a>
                        <a
                            <?php if(Auth::check()): ?>
                                onclick="follower(<?php echo e($user->id); ?>)"
                            <?php else: ?>
                                data-toggle="modal" data-target="#so_sociallogin"
                            <?php endif; ?>
                            class="btn user-f" id="follower" href="javascript:void(0)">
                                <?php if(Auth::check() && App\Models\FavoriteSeller::where('user_id', Auth::id())->where('follower_id', $user->id)->first()): ?>
                                <div class="followy">Unfollow</div>
                                <?php else: ?>
                                <div class="follow">Follow</div>
                                <?php endif; ?>
                        </a>
                    </div>
                     <?php if($user->sellerVerify): ?>
                        <div class="d-flex align-items-center">
                            <?php if($user->sellerVerify->facebook): ?>
                            <a href="<?php echo e($user->sellerVerify->facebook); ?>"> <img width="45" src="<?php echo e(asset('frontend/images/facebook.svg')); ?>"> </a><?php endif; ?>
        
                            <?php if($user->sellerVerify->website): ?>
                            <a href="<?php echo e($user->sellerVerify->website); ?>"> <img width="45" src="<?php echo e(asset('frontend/images/web.svg')); ?>">  </a><?php endif; ?>
        
                            <?php if($user->sellerVerify->youtube): ?>
                            <a href="<?php echo e($user->sellerVerify->youtube); ?>"> <img width="45" src="<?php echo e(asset('frontend/images/youtube.svg')); ?>"> </a><?php endif; ?>
        
                            <?php if($user->sellerVerify->instagram): ?>
                            <a href="<?php echo e($user->sellerVerify->instagram); ?>"> <img width="45" src="<?php echo e(asset('frontend/images/instagram.svg')); ?>"> </a><?php endif; ?>
        
                            <?php if($user->sellerVerify->whatsapp): ?>
                            <a href="<?php echo e($user->sellerVerify->whatsapp); ?>"> <img width="45" src="<?php echo e(asset('frontend/images/whatsapp.svg')); ?>"> </a><?php endif; ?>
                        </div>
                        <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container bg-white px-0 py-2 mb-3">
        <div class="row">
            <div class="col-md-4 col-12 hidden-xs">
                <div class=" order-bottom pb-2 mb-2">
                    <div class="d-flex align-items-center">
                        <p class="mr-2">Bonik ID: </p>
                        <b><?php echo e($user->seller_id); ?></b>
                    </div>
                    <?php echo e($follower); ?> Follower
                </div>

                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <p class="mr-2">Published: </p>
                    <b><?php echo e($posts->total()); ?> Ads</b>
                </div>
                <?php if($user->mobile): ?>
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <img width="25" height="25" class="mr-2" src="<?php echo e(asset('upload/images/phones.png')); ?>" alt="logo">
                    <b><?php echo e($user->mobile); ?></b>
                </div>
                <?php endif; ?>
                <?php if($user->email): ?>
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <img width="25" height="25" class="mr-2" src="<?php echo e(asset('upload/images/envelope.png')); ?>" alt="logo">
                    <a href="mailto:support@bonikbazar.com" target="_blank"><b class="bt">via BonikBazar</b></a>
                </div>
                <?php endif; ?>
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <img width="25" height="25" class="mr-2" src="<?php echo e(asset('upload/images/time.png')); ?>" alt="logo">
                    <div class="w-100">
                        <?php if($user->sellerVerify): ?>
                       
                        <div class="d-flex justify-content-between">
                            <?php if($user->sellerVerify->open_time <= date("H:i:s") && $user->sellerVerify->close_time >= date("H:i:s") ): ?>
                            <p class="open_time">Now Open</p>
                            <?php else: ?>
                            <p class="close_time">Closed</p>
                            <?php endif; ?>
                        </div>
                        <b>
                            <?php echo e(Carbon\Carbon::parse($user->sellerVerify->open_time)->format("h:i A")); ?> - <?php echo e(Carbon\Carbon::parse($user->sellerVerify->close_time)->format("h:i A")); ?></b>
                         <?php endif; ?>
                    </div>
                </div>
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <img width="25" height="25" class="mr-2" src="<?php echo e(asset('upload/images/maps.png')); ?>" alt="logo">
                    <b>
                        <?php if($user->sellerVerify->address): ?>
                            <?php echo e($user->sellerVerify->address); ?>

                        <?php endif; ?>
                    </b>
                </div>

                <?php if($user->sellerVerify): ?>
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <?php if($user->sellerVerify->facebook): ?>
                    <a href="<?php echo e($user->sellerVerify->facebook); ?>"> <img width="45" src="<?php echo e(asset('frontend/images/facebook.svg')); ?>"> </a><?php endif; ?>

                    <?php if($user->sellerVerify->website): ?>
                    <a href="<?php echo e($user->sellerVerify->website); ?>"> <img width="45" src="<?php echo e(asset('frontend/images/web.svg')); ?>">  </a><?php endif; ?>

                    <?php if($user->sellerVerify->youtube): ?>
                    <a href="<?php echo e($user->sellerVerify->youtube); ?>"> <img width="45" src="<?php echo e(asset('frontend/images/youtube.svg')); ?>"> </a><?php endif; ?>

                    <?php if($user->sellerVerify->instagram): ?>
                    <a href="<?php echo e($user->sellerVerify->instagram); ?>"> <img width="45" src="<?php echo e(asset('frontend/images/instagram.svg')); ?>"> </a><?php endif; ?>

                    <?php if($user->sellerVerify->whatsapp): ?>
                    <a href="<?php echo e($user->sellerVerify->whatsapp); ?>"> <img width="45" src="<?php echo e(asset('frontend/images/whatsapp.svg')); ?>"> </a><?php endif; ?>
                </div>
                <?php endif; ?>
                <div>
                    <h4 style="font-weight:500;text-decoration: underline; ">Shop About: </h4>
                    <?php echo $user->sellerVerify->shop_about; ?>

                </div>
            </div>
            <div class="col-md-8 col-12">
                <?php if(count($posts)>0): ?>
                    <div class="row">
                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-6 col-md-6 w-100 ab p-1 mb-2 position-relative">
                        <a class="w-100 bg-white shadow-bb p-2 rounded" href="<?php echo e(route('post_details', $post->slug)); ?>">
                            <div class="position-relative">
                                <img class="lazyload w-100" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/thumb/'. $post->feature_image)); ?>" alt="<?php echo e($post->title); ?>">
                            </div>
                            <div class="w-100 ppb-5">
                                <h4 class="font-weight-bold bt py-1" title=""><?php echo e($post->title); ?></h4>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="bt hidden-xs"><?php echo e($post->get_state->name ?? ''); ?></p>
                                        <p class="bt hidden-xs"><?php echo e($post->get_subcategory->name ?? ''); ?> (<?php echo e(($post->sale_type) ? $post->sale_type : $post->post_type); ?>)</p>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="font-weight-bold bt py-1"><?php echo e(Config::get('siteSetting.currency_symble') . $post->price); ?></h4>
                                    <p class="bt py-1 hidden-xs"><?php echo e(Carbon\Carbon::parse($post->created_at)->format(Config::get('siteSetting.date_format'))); ?></p>
                                </div>
                            </div>
                        </a>
                        <div class="hidden-xs">
                            <div class="d-flex bg-white mt-n3 flex-column">
                                <div class="d-flex align-items-center bb2 rounded shadow mx-3 bg-white">
                                    <input type="text" name="message" id="message<?php echo e($post->id); ?>" class="px-2 py-1 w-100 rounded" placeholder="Send message">
                                    <button <?php if(Auth::check()): ?> onclick="sendMessage(<?php echo e($post->id); ?>)" <?php else: ?> data-target="#so_sociallogin" data-toggle="modal" <?php endif; ?>><img height="23" src="<?php echo e(asset('upload/images/chat2.png')); ?>"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php echo e($posts->appends(request()->query())->links()); ?>

                <?php else: ?>
                    <h1>Posts not found.!</h1>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="container">
        <div class="container bg-white p-0 pb-3 mb-2">
            <div class="row ">
                <div class="col-md-6 d-flex align-items-end">
                    <img class="by2 w-150 rounded mr-2 bg-white" src="<?php echo e(asset('upload/users')); ?>/<?php echo e(($user->photo) ? $user->photo : 'default.png'); ?>">
                    <div>
                        <h3><?php echo e($user->name); ?></h3>
                        <p><?php echo e($user->mobile); ?></p>
                        <p><?php echo e($user->email); ?></p>
                        <p><?php if($user->address): ?>
                            <?php echo e($user->address); ?>,
                        <?php endif; ?>
                        <?php if($user->get_city): ?>
                            <?php echo e($user->get_city->name); ?>, 
                        <?php endif; ?> <?php if($user->get_state): ?>
                            <?php echo e($user->get_state->name); ?>

                        <?php endif; ?></p>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-end align-items-end">
                    <div>
                        <a
                        <?php if(Auth::check()): ?>
                            onclick="report(<?php echo e($user->id); ?>)" data-toggle="tooltip"
                        <?php else: ?>
                            data-toggle="modal" data-target="#so_sociallogin"
                        <?php endif; ?>
                        class="btn py-1 px-4 e6 text-red bb2 rounded shadow-bb font-weight-bold" href="javascript:void(0)">Report</a>
                        <a
                        <?php if(Auth::check()): ?>
                            onclick="follower(<?php echo e($user->id); ?>)"
                        <?php else: ?>
                            data-toggle="modal" data-target="#so_sociallogin"
                        <?php endif; ?>
                        class="btn user-f" id="follower" href="javascript:void(0)">
                            <?php if(Auth::check() && App\Models\FavoriteSeller::where('user_id', Auth::id())->where('follower_id', $user->id)->first()): ?>
                            <div class="followy">Unfollow</div>
                            <?php else: ?>
                            <div class="follow">Follow</div>
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
        <?php if(count($posts)>0): ?>
            <div class="row">
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="w-100 col-md-4 col-6 mb-2 position-relative">
                <a class="w-100 bg-white shadow-bb p-1 rounded"  href="<?php echo e(route('post_details', $post->slug)); ?>">
                    <div class="position-relative">
                        <img class="lazyload w-100" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/thumb/'. $post->feature_image)); ?>" alt="<?php echo e($post->title); ?>">
                    </div>
                    <div class="w-100 ppb-5">
                        <h4 class="font-weight-bold bt py-1" title=""><?php echo e($post->title); ?></h4>
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="bt hidden-xs"><?php echo e($post->get_state->name ?? ''); ?></p>
                                <p class="bt hidden-xs"><?php echo e($post->get_subcategory->name ?? ''); ?> (<?php echo e(($post->sale_type) ? $post->sale_type : $post->post_type); ?>)</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold bt py-1"><?php echo e(Config::get('siteSetting.currency_symble') . $post->price); ?></h4>
                            <p class="bt py-1 hidden-xs"><?php echo e(Carbon\Carbon::parse($post->created_at)->format(Config::get('siteSetting.date_format'))); ?></p>
                        </div>
                    </div>
                </a>
                <div class="hidden-xs">
                    <div class="d-flex mt-n3 flex-column">
                        <div class="d-flex align-items-center bb2 rounded shadow mx-3 bg-white">
                            <input type="text" name="message" id="message<?php echo e($post->id); ?>" class="px-2 py-1 w-100 rounded" placeholder="Send message">
                        <button <?php if(Auth::check()): ?> onclick="sendMessage(<?php echo e($post->id); ?>)" <?php else: ?> data-target="#so_sociallogin" data-toggle="modal" <?php endif; ?>><img height="23" src="<?php echo e(asset('upload/images/chat2.png')); ?>"></button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php echo e($posts->appends(request()->query())->links()); ?>

        <?php else: ?>
            <h1>Posts not found.!</h1>
        <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="modal fade" id="reportModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>User report</h4>
                    <button class="fa fa-times" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('sellerReport')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="seller_id" value="<?php echo e($user->id); ?>">
                        <div id="reportForm"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>  

<?php $__env->startSection('js'); ?>
<script>
    <?php if(Auth::check()): ?>
    function follower(follower_id){
        $.ajax({
            method:'get',
            url:'<?php echo e(route("follower")); ?>',
            data:{
                follower_id:follower_id,
            },
            success:function(data){
                if(data.status){
                    $('#follower').html(data.msg);
                }
            }
        });

    }
    function report(id){
        $('#reportModal').modal('show');
         $('#reportForm').html('<div class="loadingData-sm"></div>');
        $.ajax({
            method:'get',
            url:'<?php echo e(route("reportForm")); ?>',
            data:{
                type:'user'
            },
            success:function(data){
                if(data){
                    $('#reportForm').html(data);
                }
            }
        });
    }

    function sendMessage(product_id){
    
    var message = $('#message'+product_id).val();
   
      $.ajax({
        url:'<?php echo e(route("user.sendMessage")); ?>',
        type:'post',
        data:{productOrConId:product_id,message:message,'_token':'<?php echo e(csrf_token()); ?>'},
        success:function(data){
            if(data){
                $('#message'+product_id).val('');
                toastr.success('Message send success.');
            }else{
                toastr.error('Message send failad.');
            }
          }
      });
    }
    <?php endif; ?>
</script>   
<?php $__env->stopSection(); ?>     
    



<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/frontend/user/user_profile.blade.php ENDPATH**/ ?>