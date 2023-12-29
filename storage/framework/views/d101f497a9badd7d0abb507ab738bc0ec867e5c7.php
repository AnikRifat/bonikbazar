
<?php $__env->startSection('title', 'Notifications'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('frontend')); ?>/css/custom/notification.css">
    <style type="text/css">
        .inbox-chat-list{overflow-y: scroll;min-height: 250px;}}
        .active{background: #25b90a1a;}
        .removeMessage{background: rgb(225 221 221 / 40%);color: #b56161;border-radius: 5px;padding: 5px;font-size: 12px;}
        .inbox-chat-form textarea{width: 95%;
    height: 50px;
    padding: 5px 45px 5px 5px;
    border: 1px solid #ccc; resize: none;}
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

 <section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="notify-body">
                    <div class="notify-filter">
                        <select onchange="markMotification(this.value)" class="select notify-select">
                            <option <?php if(Request::get('mark') == 'all'): ?> selected <?php endif; ?> value="all">All notification</option>
                            <option <?php if(Request::get('mark') == 'read'): ?> selected <?php endif; ?> value="read">Read notification</option>
                            <option <?php if(Request::get('mark') == 'unread'): ?> selected <?php endif; ?> value="unread">Unread notification</option>
                        </select>
                        <div class="notify-action">
                            
                            <a style="width:100%; border-radius: 5px; line-height: 28px; padding:5px;" href="<?php echo e(route('readNotify')); ?>" title="Mark All As Read" class="fas fa-envelope-open"> Mark Read</a>
                            <!-- <a href="#" title="Notification Setting" class="fas fa-cog"></a> -->
                        </div>
                    </div>
                    <ul class="notify-list">
                        <?php if(count($notifications )>0): ?>
                        <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($notification->type == 'post'): ?>
                        <?php if($notification->product): ?>
                            <li class="notify-item <?php if($notification->read == 0): ?> active <?php endif; ?>">
                                <a onclick="readNotify('<?php echo e($notification->id); ?>')" href="<?php echo e(route('post_details', $notification->product->slug)); ?>" class="notify-link">
                                    <div class="notify-img">
                                        <img src="<?php echo e(asset('upload/images/product/thumb/'. $notification->product->feature_image)); ?>" alt="avatar">
                                    </div>
                                    <div class="notify-content">
                                        <p class="notify-text"><?php if($notification->user): ?><span><?php echo e($notification->user->name); ?>: </span><?php endif; ?><span><?php echo e($notification->notify); ?></span>  <?php echo e(Str::limit($notification->product->title, 25)); ?></p>
                                        <span class="notify-time"><?php echo e(Carbon\Carbon::parse($notification->created_at)->diffForHumans()); ?></span>
                                    </div> 
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php elseif($notification->type == 'package'): ?>
                            <li class="notify-item <?php if($notification->read == 0): ?> active <?php endif; ?>">
                                <a onclick="readNotify('<?php echo e($notification->id); ?>')" href="<?php echo e(route('user.packageHistory')); ?>#<?php echo e($notification->item_id); ?>" class="notify-link">
                                    <div class="notify-img">
                                         <img src="https://img.favpng.com/19/10/20/blue-computer-icon-area-symbol-png-favpng-Rsn1G41w4PgR3fpkZntM1wVrZ.jpg" alt="avatar">
                                    </div>
                                    <div class="notify-content">
                                        <p class="notify-text"> <?php echo e($notification->notify); ?> </p>
                                        <span class="notify-time"><?php echo e(Carbon\Carbon::parse($notification->created_at)->diffForHumans()); ?></span>
                                    </div>
                                </a>
                            </li>
                            <?php elseif($notification->type == 'userStatus'): ?>
                            <li class="notify-item <?php if($notification->read == 0): ?> active <?php endif; ?>">
                                <a onclick="readNotify('<?php echo e($notification->id); ?>')" href="<?php echo e(route('verifyAccount')); ?>#<?php echo e($notification->item_id); ?>" class="notify-link">
                                    <div class="notify-img">
                                         <img src="https://img.favpng.com/19/10/20/blue-computer-icon-area-symbol-png-favpng-Rsn1G41w4PgR3fpkZntM1wVrZ.jpg" alt="">
                                    </div>
                                    <div class="notify-content">
                                        <p class="notify-text"> <?php echo e($notification->notify); ?> </p>
                                        <span class="notify-time"><?php echo e(Carbon\Carbon::parse($notification->created_at)->diffForHumans()); ?></span>
                                    </div>
                                </a>
                            </li>
                        <?php elseif($notification->type == 'register'): ?>{
                            <li class="notify-item <?php if($notification->read == 0): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('user.dashboard')); ?>" class="notify-link">
                                <div class="notify-img">
                                    <img src="<?php echo e(asset('frontend/images/post.png')); ?>" alt="avatar">
                                </div>
                                <div class="notify-content">
                                    <p class="notify-text"><span><?php echo e($notification->notify); ?></span></p>
                                    <span class="notify-time"><?php echo e(Carbon\Carbon::parse($notification->created_at)->diffForHumans()); ?></span>
                                </div>
                            </a>
                        </li>
                        }
                        <?php else: ?>

                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <h3>No notification found.</h3>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>   

<?php $__env->startSection('js'); ?> 
      <script type="text/javascript">
          function markMotification(read) {
           if (read != undefined && read != null) {
                window.location = '<?php echo e(route("allNotifications")); ?>?mark=' + read;
            }
          }
      </script>
<?php $__env->stopSection(); ?>    
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/users/notifications/notifications.blade.php ENDPATH**/ ?>