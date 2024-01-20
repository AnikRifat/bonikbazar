<ul class="list-box" style="border-right: 1px solid #ccc;">
    <li ><a href="<?php echo e(route('user.dashboard')); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
    <li ><a href="<?php echo e(route('post.create')); ?>"><i class="fa fa-pencil-alt"></i> Ads Post</a></li>
    <li class="navbar-dropdown" style="">
        <a class="navbar-link" href="javascript:void(0)">
            <span><i style="font-size: 16px;" class="fa fa-th-list"></i> My Ads</span>
            <i class="fas fa-plus"></i>
        </a>
        <ul class="dropdown-list" style="display: none;">
            <li><a href="<?php echo e(route('post.list')); ?>">All Ads</a></li>
            <li><a href="<?php echo e(route('post.list', 'active')); ?>">Active Ads</a></li>
            <li><a href="<?php echo e(route('post.list', 'deactive')); ?>">Deactive Ads</a></li>
            <li><a href="<?php echo e(route('post.list', 'reject')); ?>">Reject Ads</a></li>
            <li><a href="<?php echo e(route('post.list', 'pending')); ?>">Pending Ads</a></li>
        </ul>
    </li>
    <li ><a href="<?php echo e(route('linkAds')); ?>"><i class="fa fa-ad"></i> Link Ads</a></li>
    <li ><a href="<?php echo e(route('user.packageHistory')); ?>"><i class="fa fa-clipboard-list"></i> My Package</a></li>
    <li ><a href="<?php echo e(route('user.message')); ?>"><i class="fa fa-comment"></i> Message</a></li>
    <li ><a href="<?php echo e(route('allNotifications')); ?>"><i class="fa fa-bell"></i> Notifications</a></li>
    <li ><a href="<?php echo e(route('wishlists')); ?>"><i class="fa fa-heart"></i> Wishlist</a></li>
    <li ><a href="<?php echo e(route('user.profile')); ?>"><i class="fa fa-user"></i> My Profile</a></li>
    <li ><a href="<?php echo e(route('verifyAccount')); ?>"><i class="fa fa-user-plus"></i> Seller Verification</a></li>
    <?php if(Auth::user()->sellerVerify): ?>
    <li ><a href="<?php echo e(route('membershipPlan')); ?>"><i class="fa fa-tags"></i> Membership Plan</a></li><?php endif; ?>
    <li ><a href="<?php echo e(route('user.change-password')); ?>"><i class="fa fa-edit"></i> Change Password </a></li>
    <li><a href="<?php echo e(route('userLogout')); ?>"><i class="fa fa-power-off"></i> Logout</a></li>
</ul>

<?php /**PATH D:\BonikBazar\bonikbazar\resources\views/users/inc/sidebar.blade.php ENDPATH**/ ?>