
<?php $__env->startSection('title', 'Profile | '. Config::get('siteSetting.site_name') ); ?>
<?php $__env->startSection('css'); ?>

<style type="text/css">

</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php if($user->sellerVerify): ?>
    <div class="container bg-white p-0 pb-3 mb-2">
        <div style="position: relative;">
        <span title="Change cover photo" data-toggle="modal" data-target="#user_coverImageModal" class="uploadIcon" ><i class="fa fa-camera"></i></span>

        <img class="lazyload mw-100 h-300" src="<?php echo e(asset('upload/users/'.$user->cover_photo)); ?>"></div>
        <div class="row mt4">
            <div class="col-md-6 d-flex align-items-end">
                <div style="position: relative;">
                <span  data-toggle="modal" title="Change profile photo" data-target="#user_imageModal" class="uploadIcon" ><i class="fa fa-camera"></i></span>

                <img class="by2 w-150 rounded mr-2 bg-white" src="<?php echo e(asset('upload/users')); ?>/<?php echo e(($user->photo) ? $user->photo : 'default.png'); ?>">
                </div>
                <div>
                    <h3><?php echo e($user->name); ?></h3>
                    <div class="d-flex align-items-center">
                         <?php if($user->getMembership): ?>
                            <img class="lazyload" width="25" src="<?php echo e(asset('upload/images/membership/'. $user->getMembership->ribbon)); ?>">
                            <p class="bt"><?php echo e($user->getMembership->name); ?></p>
                        <?php endif; ?>
                    </div>
                    <p>Member Since <?php echo e(Carbon\Carbon::parse($user->created_at)->format(Config::get('siteSetting.date_format'))); ?></p>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-end">
                <div style="display: flex; gap: 10px;">
                    <div class="btn_box"><span class="count_box"><?php echo e($liked); ?></span> Liked Post</div>
                    <div class="btn_box"> <span class="count_box"><?php echo e($follower); ?></span> Follower</div>
                    <div class="btn_box"><span class="count_box"><?php echo e($following); ?></span> Following</div>
                </div>
            </div>
        </div>
    </div>
    <div class="container bg-white px-0 py-2 mb-3">
        <div class="row">
            <div class="col-md-4 col-12">
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <p class="mr-2">Bonik ID: </p>
                    <b><?php echo e($user->seller_id); ?></b>
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
                    <b>support@bonikbazar.com <br>
                        <p class="font-weight-normal">via BonikBazar</p>
                    </b>
                </div>
                <?php endif; ?>
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <img width="25" height="25" class="mr-2" src="<?php echo e(asset('upload/images/time.png')); ?>" alt="logo">
                    <div class="w-100">
                        <?php if($user->sellerVerify): ?>
                        <div class="d-flex justify-content-between">
                            <?php if($user->sellerVerify->open_time <= date("H:i:s") && $user->sellerVerify->close_time >= date("H:i:s") ): ?>
                            <p>Now Open</p>
                            <?php else: ?>
                            <p>Closed</p>
                            <?php endif; ?>
                        </div>
                        <b> <?php echo e(Carbon\Carbon::parse($user->sellerVerify->open_time)->format("h:i A")); ?> - <?php echo e(Carbon\Carbon::parse($user->sellerVerify->close_time)->format("h:i A")); ?></b>
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
                    <a href="<?php echo e($user->sellerVerify->facebook); ?>">
                        <img width="40" src="<?php echo e(asset('frontend/images/facebook.svg')); ?>">
                    </a>
                    <?php endif; ?>

                    <?php if($user->sellerVerify->website): ?>
                    <a href="<?php echo e($user->sellerVerify->website); ?>">
                        <img width="40" src="<?php echo e(asset('frontend/images/web.svg')); ?>">
                    </a>
                    <?php endif; ?>

                    <?php if($user->sellerVerify->youtube): ?>
                    <a href="<?php echo e($user->sellerVerify->youtube); ?>">
                        <img width="40" src="<?php echo e(asset('frontend/images/youtube.svg')); ?>">
                    </a>
                    <?php endif; ?>

                    <?php if($user->sellerVerify->instagram): ?>
                    <a href="<?php echo e($user->sellerVerify->instagram); ?>">
                        <img width="40" src="<?php echo e(asset('frontend/images/instagram.svg')); ?>">
                    </a>
                    <?php endif; ?>

                    <?php if($user->sellerVerify->whatsapp): ?>
                    <a href="<?php echo e($user->sellerVerify->whatsapp); ?>">
                        <img width="40" src="<?php echo e(asset('frontend/images/whatsapp.svg')); ?>">
                    </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <div class="border-bottom">
                    <h4 style="font-weight:500;text-decoration: underline; ">Shop About: </h4>
                    <?php echo $user->sellerVerify->shop_about; ?>

                </div>
            </div>
            <div class="col-md-8 col-12">
                <?php if(count($posts)>0): ?>
                    <div class="hl-2">
                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="w-100 ab p-2 mb-2 position-relative">
                        <a class="w-100" href="<?php echo e(route('post_details', $post->slug)); ?>">
                            <div class="position-relative">
                                
                                
                                <img class="lazyload w-100" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/thumb/'. $post->feature_image)); ?>" alt="<?php echo e($post->title); ?>">
                            </div>
                            <div class="w-100">
                                <h4 class="font-weight-bold bt py-1" title=""><?php echo e($post->title); ?></h4>
                                
                                <div class="d-flex flex-column" style="color: #000;">
                                        
                                        <p>Price: <?php echo e(Config::get('siteSetting.currency_symble')); ?>. <?php echo e($post->price); ?></p>
                                   
                                        <p>React: <?php echo e($post->reacts_count); ?></p>
                                        <p>Share: <?php echo e($post->share); ?></p>
                                        <p>Massage: <?php echo e($post->messages_count); ?></p>
                                        <p>Report: <?php echo e($post->reports_count); ?></p>
                                        <p>Date: <?php echo e(Carbon\Carbon::parse(($post->approved) ? $post->approved : $post->created)->format(Config::get('siteSetting.date_format'))); ?></p>
                                        <p>Views: <?php echo e($post->views); ?></p>
                                    </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="font-weight-bold bt py-1"><?php echo e(Config::get('siteSetting.currency_symble') . $post->price); ?></h4>
                                    <p class="bt py-1"><?php echo e(Carbon\Carbon::parse($post->created_at)->format(Config::get('siteSetting.date_format'))); ?></p>
                                </div>
                            </div>
                        </a>
                        
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
    <div class="container bg-white p-0 pb-3 mb-2">
        <div class="row">
            <div class="col-md-6 d-flex align-items-end">
                <div style="position: relative;margin-top: 10px;">
                <span  data-toggle="modal" title="Change cover photo" data-target="#user_imageModal" class="uploadIcon" ><i class="fa fa-camera"></i></span>

                <img class="by2 w-150 rounded mr-2 bg-white" src="<?php echo e(asset('upload/users')); ?>/<?php echo e(($user->photo) ? $user->photo : 'default.png'); ?>">
                </div>
                <div>
                   <h3><?php echo e($user->name); ?></h3>
                    <p><?php echo e($user->mobile); ?></p>
                    <p><?php echo e($user->email); ?></p>
                    <p>
                    <?php if($user->address): ?>
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
                <div style="display: flex; gap: 10px; margin-bottom: 25px;">
                    <a class="btnSetting" href="<?php echo e(route('user.myAccount')); ?>">Account <br/> Setting</a>
                    <a href="<?php echo e(route('verifyAccount')); ?>" class="btnSetting" style="background: #f9ef6b;">Become <br> A Member</a>
                </div>
                <div style="display: flex; gap: 10px;">
                    <div class="btn_box"><span class="count_box"><?php echo e($liked); ?></span> Liked Post</div>
                    <div class="btn_box"> <span class="count_box"><?php echo e($follower); ?></span> Follower</div>
                    <div class="btn_box"><span class="count_box"><?php echo e($following); ?></span> Following</div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        
        <?php if(count($posts)>0): ?>
            <div class="row">
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="w-100 col-md-4 col-12 mb-2 position-relative">
                <div class="bg-white" style="padding: 10px">
                <a class="w-100  "  href="<?php echo e(route('post_details', $post->slug)); ?>">
                    <div class="position-relative">
                        
                        <img class="lazyload w-100" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/thumb/'. $post->feature_image)); ?>" alt="<?php echo e($post->title); ?>">
                    </div>
                    <div class="w-100">
                        <h4 class="font-weight-bold bt py-1" title=""><?php echo e($post->title); ?></h4>
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="bt "><?php echo e($post->get_state->name ?? ''); ?></p>
                                <p class="bt "><?php echo e($post->get_subcategory->name ?? ''); ?> (<?php echo e(($post->sale_type) ? $post->sale_type : $post->post_type); ?>)</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold bt py-1"><?php echo e(Config::get('siteSetting.currency_symble') . $post->price); ?></h4>
                            <p class="bt py-1"><?php echo e(Carbon\Carbon::parse($post->created_at)->format(Config::get('siteSetting.date_format'))); ?></p>
                        </div>
                    </div>
                </a>
                
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php echo e($posts->appends(request()->query())->links()); ?>

        <?php else: ?>
            <h1>Posts not found.!</h1>
        <?php endif; ?>
        
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


    <?php endif; ?>
</script>   
<?php $__env->stopSection(); ?>     
    



<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/users/profile.blade.php ENDPATH**/ ?>