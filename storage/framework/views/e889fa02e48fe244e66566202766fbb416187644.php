<?php
if($conversation->sender_id == Auth::id()){
    $receiver = $conversation->receiver;
}else{
    $receiver = $conversation->sender;
}
?>
<div id="message-body" style="min-height: 210px;">
<div class="inbox-header">
    <div class="inbox-header-profile">
        <a onclick="userHideShow()" class="message-arrow" href="javascript:void(0)"><i class="fa fa-angle-left"></i></a>
        <a class="inbox-header-img <?php if($receiver && Cache::has('UserOnline-' . $receiver->id)): ?> active <?php else: ?> deactive <?php endif; ?>" target="_blank" href="<?php echo e(route('post_details',$conversation->product->slug )); ?>">
            <img src="<?php echo e(asset('upload/images/product/thumb/'.$conversation->product->feature_image)); ?>" alt="avatar">
        </a>
        <div class="inbox-header-text">
            <h5><a href="<?php echo e(route('userProfile', $receiver->username)); ?>"><?php echo e($receiver->name); ?></a></h5>
            <p><a target="_blank" href="<?php echo e(route('post_details',$conversation->product->slug )); ?>"><?php echo e(Str::limit($conversation->product->title, 45)); ?></a></p>
            <span><?php echo e(Config::get('siteSetting.currency_symble') . $conversation->product->price); ?></span>
        </div>
    </div>
    <?php if($conversation): ?>
    <ul class="inbox-header-list">
        <li><a href="<?php echo e(route('deleteAllMessage', $conversation->id)); ?>" title="Delete" class="fas fa-trash-alt"></a></li>
        <li><a href="javascript:void(0)" onclick="report(<?php echo e($conversation->product->id); ?>)" title="Report" class="fas fa-flag"></a></li>
        <li><a href="<?php echo e(route('blockUser', $conversation->id)); ?>" title="<?php echo e(($conversation->block_user != null) ? 'Unblock' :'Block'); ?> " class="fas fa-shield-alt"></a></li>
    </ul><?php endif; ?>
</div>
<ul class="inbox-chat-list" id="inbox-chat-list">
    <li class="safety_tip">
        <h4>Safety Tips</h4>
        <?php echo App\Models\SiteSetting::where('type', 'safety_tip')->first()->value; ?>

    </li>
<?php if($conversation && $messages): ?>
    <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($message->sender_id == Auth::id()): ?>
        <li class="inbox-chat-item my-chat" id="message<?php echo e($message->id); ?>">
            <div class="inbox-chat-content">
                <?php if($message->deleted_from_sender == 0): ?>
                <div class="inbox-chat-text">
                    <?php if($message->image): ?>
                    <div class="galleryBox">
                        <?php $__currentLoopData = json_decode($message->image); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="conversation-gallery" href="<?php echo e(asset('upload/message/'.$image)); ?>" class="image-popup-no-margins"> <img  class="img-fluid" src="<?php echo e(asset('upload/message/'.$image)); ?>" alt="">  </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                    <?php if($message->message): ?>
                    <p><?php echo $message->message; ?></p><?php endif; ?>
                    <div class="inbox-chat-action">
                        <a href="javascript:void(0)" title="Remove" onclick= "removeMessage(<?php echo e($message->id); ?>)" class="fas fa-trash-alt"></a>
                    </div>
                </div>
                <small class="inbox-chat-time"><?php echo e(Carbon\Carbon::parse($message->created_at)->diffForHumans()); ?></small>
               <?php endif; ?>
            </div>
        </li>
        <?php else: ?>
        <li class="inbox-chat-item" id="message<?php echo e($message->id); ?>">
            <div class="inbox-chat-content">
                <?php if($message->deleted_from_receiver == 0): ?>
                <div class="inbox-chat-text">
                    <?php if($message->image): ?>
                    <div class="galleryBox">
                        <?php $__currentLoopData = json_decode($message->image); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a data-fancybox="gallery" class="conversation-gallery" href="<?php echo e(asset('upload/message/'.$image)); ?>" class="image-popup-no-margins"> <img  class="img-fluid" src="<?php echo e(asset('upload/message/'.$image)); ?>" alt="">  </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                    <?php if($message->message): ?>
                    <p><?php echo $message->message; ?></p><?php endif; ?>
                    <div class="inbox-chat-action">
                        <a href="javascript:void(0)" title="Remove" onclick= "removeMessage(<?php echo e($message->id); ?>)" class="fas fa-trash-alt"></a>
                    </div>
                </div>
                <small class="inbox-chat-time"><?php echo e(Carbon\Carbon::parse($message->created_at)->diffForHumans()); ?></small>
                <?php endif; ?>
            </div>
        </li>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <li><h3>No conversation</h3></li>
<?php endif; ?>
</ul>
</div>
<?php if(isset($messageWriteBox)): ?>

<form class="inbox-chat-form" id="sendMessage" action="<?php echo e(route('user.sendMessage')); ?>" enctype="multipart/form-data" method="post" style="display: flex; align-items: center;">
<?php if(!$conversation || $conversation->block_user == null): ?>
<?php echo csrf_field(); ?>
<input type="hidden" name="productOrConId" value="<?php echo e($conversation->id); ?>">
<div><label for="attachment" title="Send image" style="margin-right: 5px;font-size: 20px;cursor: pointer"><i class="fa fa-camera"></i> <input type="file" style="display:none;" name="file[]" accept="image/*" multiple id="attachment"> </label></div>
<textarea  name="message" class="message" required placeholder="Type a Message"></textarea>
<button class="sendMessage"  onclick="sendMessage('<?php echo e($conversation->id); ?>')" type="button"><i class="fas fa-paper-plane"></i></button>
<?php else: ?>
    <?php if($conversation->block_user == Auth::id()): ?>
        <p>You've blocked message. You can't message In this chat and you won't receive their message. <a href="<?php echo e(route('blockUser', $conversation->id)); ?>">Unblock</a></p>
        
    <?php else: ?>
    <h3>You have been blocked so you can't send any message.</h3>
    <?php endif; ?>
<?php endif; ?>
</form>
<?php endif; ?><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/users/message/message.blade.php ENDPATH**/ ?>