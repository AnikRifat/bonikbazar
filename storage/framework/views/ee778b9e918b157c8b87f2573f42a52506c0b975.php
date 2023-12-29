<div class="chat-main-header">
    <div class="p-2 b-b chatonline" style="display: flex;">
    	<div class="avatar dot-status online-active">
    		<img src="<?php echo e(asset('upload/images/product/thumb/'.$conversation->product->feature_image)); ?>" alt="user-img" class="img-circle">
    	</div>
    	<div class="content">
            <span><a target="_blank" href="<?php echo e(route('post_details',$conversation->product->slug )); ?>"><?php echo e(Str::limit($conversation->product->title, 65)); ?></a></span>
            <p class="time"><?php echo e(Config::get('siteSetting.currency_symble') . $conversation->product->price); ?></p>
        </div> 
       
    </div>
</div>
<div class="chat-rbox"> 
    <ul class="chat-list p-3">
        <?php if(count($messages)>0): ?>
        
        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <!--chat Row -->
        
        <?php if($conversation->sender_id == $message->sender_id || $conversation->sender_id == $message->receciver_id): ?>
        <li>
            <div class="chat-img"><a href="<?php echo e(route('customer.profile',  $message->sender->username)); ?>"><img src="<?php echo e(asset('upload/users')); ?>/<?php echo e(( $message->sender->photo) ? $message->sender->photo : 'default.png'); ?>" alt="user" /></a></div>
            <div class="chat-content">
                <div class="box bg-light-info"><?php echo $message->message; ?></div>
                <div class="chat-time"><?php echo e(Carbon\Carbon::parse($message->created_at)->diffForHumans()); ?></div>
            </div>
        </li>

        
        <?php else: ?>
        
        <!--chat Row -->
        <li class="reverse">
            <div class="chat-content">
                <div class="box bg-light-inverse"><?php echo $message->message; ?></div>
                <div class="chat-time"><?php echo e(Carbon\Carbon::parse($message->created_at)->diffForHumans()); ?></div>
            </div>
            <div class="chat-img"><a href="<?php echo e(route('customer.profile',  $message->receiver->username)); ?>"><img src="<?php echo e(asset('upload/users')); ?>/<?php echo e(( $message->receiver->photo) ? $message->receiver->photo : 'default.png'); ?>" alt="user" /></a></div>
        </li>
        <?php endif; ?>
        
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <li><h3>No conversation</h3></li>
        <?php endif; ?>
    </ul>
</div>
<!-- <div class="card-body border-top">
    <div class="row">
        <div class="col-12" >
        	<div style="position:relative">
                <textarea placeholder="Type your message here" class="message-box border-0"></textarea>
                <button type="button" class="btn btn-info btn-circle btn-lg theme-btn submit-btn border-0"><i class="fas fa-paper-plane"></i> </button>
            </div>
        </div>
    </div>
</div> --><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/admin/message/user_conversations.blade.php ENDPATH**/ ?>