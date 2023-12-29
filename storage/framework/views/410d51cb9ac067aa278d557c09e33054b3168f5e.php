<div class="dropdown-header">
    <h5>Message</h5>
    <a href="<?php echo e(route('user.message')); ?>">View all message</a>
</div>
<ul class="message-list ">
<?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conversation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php
if($conversation->sender_id == Auth::id()){
    $receiver = $conversation->receiver;
}else{
    $receiver = $conversation->sender;
}
?>
<?php if($conversation->product && $receiver): ?>
<li class="message-item <?php if($conversation->last_message->receiver_id == Auth
::id() && $conversation->last_message->is_seen == 0): ?> unread <?php endif; ?> ">
    <a href="<?php echo e(route('user.message', $conversation->id)); ?>" class="message-link">
        <div class="message-img" style="border-radius: 3px">
            <img style="border-radius: 3px" src="<?php echo e(asset('upload/images/product/thumb/'.$conversation->product->feature_image)); ?>" alt="obondhu">

        </div>
        <div class="message-text">
            <h6><?php echo e($receiver->name); ?> <span><?php echo e(Carbon\Carbon::parse($conversation->last_message->created_at)->diffForHumans()); ?></span></h6>
            <p><?php echo e(Str::limit($conversation->product->title, 25)); ?> <br/>
            <p><?php echo Str::limit($conversation->last_message->message, 25); ?></p>
        </div>
    </a>
</li>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
</ul><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/users/notifications/message-user-list.blade.php ENDPATH**/ ?>