<li class="safety_tip">
    <h4>Safety Tips</h4>
    <?php echo App\Models\SiteSetting::where('type', 'safety_tip')->first()->value; ?>

</li>
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
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/users/message/realtimeMessage.blade.php ENDPATH**/ ?>