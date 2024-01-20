<?php
    $user = App\User::with(["getMembership:slug,ribbon", "sellerVerify:seller_id,shop_name"])->find(Auth::id());
    $follower = App\Models\FavoriteSeller::where('follower_id', $user->id)->count();

    $following = App\Models\FavoriteSeller::where('user_id', $user->id)->count();
    $liked = App\Models\Wishlist::join("products", "products.id", "wishlists.product_id")->where('products.user_id', $user->id)->count();
?>
    
    <?php if($user->cover_photo || $user->getMembership): ?>
    <div style="position: relative;">
        <span title="Change cover photo" data-toggle="modal" data-target="#user_coverImageModal" class="uploadIcon" ><i class="fa fa-camera"></i></span>

        <img class="lazyload mw-100 h-300" style="width:100%" src="<?php echo e(asset('upload/users')); ?>/<?php echo e(($user->cover_photo) ? $user->cover_photo : 'default-banner.png'); ?>" alt="">
    </div>
    <?php endif; ?>
    <div class="row <?php if($user->cover_photo || $user->getMembership): ?> mt4 <?php endif; ?>" style="margin-bottom: 15px; border-bottom: 1px solid #ccc; padding-bottom: 15px;">

        <div class="col-md-6 d-flex align-items-end">
            <div style="position: relative;margin-top: 10px;">
            <span  data-toggle="modal" title="Change profile photo" data-target="#user_imageModal" class="uploadIcon" ><i class="fa fa-camera"></i></span>

            <img class="by2 w-150 rounded mr-2 bg-white" src="<?php echo e(asset('upload/users')); ?>/<?php echo e(($user->photo) ? $user->photo : 'default.png'); ?>">
            </div>
            <div>
                <?php if($user->getMembership && $user->sellerVerify): ?>
                <div class="d-flex align-items-center">
                    <h3 class="bt"><?php echo e($user->sellerVerify->shop_name); ?> <img class="lazyload" width="25" src="<?php echo e(asset('upload/images/membership/'. $user->getMembership->ribbon)); ?>"></h3>
                </div>

                <?php else: ?>
                <h3><?php echo e($user->name); ?></h3>
                <?php endif; ?>
                Bonik ID: <?php echo e($user->seller_id); ?>

               <p>Member Since <?php echo e(Carbon\Carbon::parse($user->created_at)->format(Config::get('siteSetting.date_format'))); ?></p>
                
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-end">
            <div>
            <div style="display: flex; gap: 10px; margin-bottom: 15px;justify-content: end;">
                <a class="btnSetting" href="<?php echo e(route('user.myAccount')); ?>">Account <br/> Setting</a>
                <?php if($user->getMembership): ?>
                <a class="btnSetting" href="<?php echo e(route('user.message')); ?>"><img width="20" height="20" src="<?php echo e(asset('upload/images/sms.png')); ?>" alt="sms"> Chat</a>
                <?php else: ?>
                <a href="<?php echo e(route('verifyAccount')); ?>" class="btnSetting" style="background: #f9ef6b;">Become <br> A Member</a> <?php endif; ?>
            </div>
            <div style="display: flex; gap: 10px;">
                <div class="btn_box"><span class="count_box"><?php echo e($liked); ?></span> Liked Post</div>
                <?php if($user->getMembership): ?>
                <div class="btn_box"> <span class="count_box"><?php echo e($follower); ?></span> Follower</div>
                <div class="btn_box"><span class="count_box"><?php echo e($following); ?></span> Following</div>
                <?php else: ?>
                <a class="btnSetting" href="#"><img width="20" height="20" src="<?php echo e(asset('upload/images/sms.png')); ?>" alt="sms"> Support</a>
                <?php endif; ?>

            </div>
            </div>
        </div>
    </div>

<?php /**PATH D:\BonikBazar\bonikbazar\resources\views/users/inc/user_header.blade.php ENDPATH**/ ?>