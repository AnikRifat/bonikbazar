<?php $__currentLoopData = $conversationUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conversationUser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php
if($conversationUser->sender_id == Auth::id()){
    $receiver = $conversationUser->receiver;
}else{
    $receiver = $conversationUser->sender;
}
?>

<?php if($conversationUser->product && (($conversationUser->sender_id == Auth::id() && $conversationUser->deleted_date_sender == null) || ($conversationUser->receiver_id == Auth::id() && $conversationUser->deleted_date_receiver == null) )): ?>
<li class="message-item <?php if($conversationUser->last_message->receiver_id == Auth
::id() && $conversationUser->last_message->is_seen == 0): ?> unread <?php endif; ?> ">
    <a href="javascript:void(0)" onclick="message('<?php echo e($conversationUser->id); ?>')" class="message-link">
        <div class="message-img <?php if($receiver && Cache::has('UserOnline-' . $receiver->id)): ?> active <?php else: ?> deactive <?php endif; ?>">
            <img src="<?php echo e(asset('upload/images/product/thumb/'.$conversationUser->product->feature_image)); ?>" alt="photo">
        </div>
        <div class="message-text">
            <h6><?php if($receiver): ?><?php echo e($receiver->name); ?> <?php endif; ?><span><?php echo e(Carbon\Carbon::parse($conversationUser->last_message->created_at)->diffForHumans()); ?></span></h6>
            <p><strong><?php echo e(Str::limit($conversationUser->product->title, 25)); ?></strong></p>
            <p id="<?php echo e($conversationUser->id); ?>"><?php echo e(Str::limit($conversationUser->last_message->message, 25)); ?></p>
        </div> 
    </a>
    <div class="btn-group message-control">
        <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="<?php echo e(route('deleteAllMessage', $conversationUser->id)); ?>" title="Delete"><i class="fas fa-trash-alt"></i> Delete</a>
            <a class="dropdown-item" href="javascript:void(0)" onclick="report(<?php echo e($conversationUser->product->id); ?>)" title="Report"><i class="fas fa-flag"></i> Report</a>
            <a class="dropdown-item" href="<?php echo e(route('blockUser', $conversationUser->id)); ?>" title="<?php echo e(($conversationUser->block_user != null) ? 'Unblock' :'Block'); ?> "> <i class="fas fa-shield-alt"></i> Block</a>
        </div>
    </div>  
</li>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH D:\Workspace\LaravelWorkspace\bonikbazar\resources\views/users/message/conversationList.blade.php ENDPATH**/ ?>