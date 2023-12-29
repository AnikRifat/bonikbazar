
<?php $__env->startSection('title', 'Message'); ?>
<?php $__env->startSection('css-top'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('frontend')); ?>/css/vendor/nice-select.min.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('frontend')); ?>/css/custom/message.css">
    <style type="text/css">

        .inbox-chat-list{overflow-y: scroll;min-height: 250px;}}
        .active{background: #25b90a1a;}
        .removeMessage{background: rgb(225 221 221 / 40%);color: #b56161;border-radius: 5px;padding: 5px;font-size: 12px;}
        .inbox-chat-form textarea{width: 95%;
    height: 50px;
    padding: 5px 45px 5px 5px;
    border: 1px solid #ccc; resize: none;}
    .message-arrow{font-size: 25px;
    margin-right: 8px;
    color: #565454;
    display: none;}
    .header-fixed{position: initial;}
    .message-control{display: none;position: absolute;top: 5%;right: 15px;}
    @media (max-width: 768px) {
        .inbox-chat-list {
    min-height: 440px !important;
}
        .inbox-header-list{display: none;}
        .message-item{display: flex;position: relative;}
        .message-control{display: block; }
        .message-arrow{display: block;}
        <?php if(Request::route('username')): ?>
        .message-filter{display: none;}
        <?php endif; ?>

        .boxShow{display: block;}
        .boxHide{display: none;}
        .message-inbox {    bottom: 0;
    position: fixed;
    left: 0;
    right: 0;
    top: 46px;}
    nav.mobile-nav {
    display: none;
}
form#sendMessage {
    bottom: 20px;
    position: fixed;
    right: 10px;
    left: 0;
}
    }
    i.fa.fa-camera {
    font-size: 30px;
    padding: 10px;
}
    i.fa.fa-angle-left {
    font-size: 30px;
    margin-right: 5px;
}
    .conversation-gallery{width: 120px;padding: 5px;}
    .galleryBox{display:flex;justify-content: end; flex-wrap: wrap;}
    .warning{border: 1px solid #ff9b9b !important;}
    .safety_tip{border: 1px solid #ccc;margin-top:5px;
    padding: 5px;
    border-radius: 3px;
    background: #edf9ff;}
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<section class="message-part">
    <div class="container px-0">
        <div class="row">
            <div class="col-lg-5 col-xl-4 px-0">
                <div class="message-filter">
                    
                    <form style="display: block;" class="message-filter-src">
                        <input type="text" id="userList" placeholder="Search for message">
                    </form>
                    <ul class="message-list userList">
                        <?php echo $__env->make('users.message.conversationList', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                    </ul>
                </div>
            </div>
            <div class="col-lg-7 col-xl-8">
                <div class="message-inbox">
                    <?php if($conversation): ?>
                        <?php echo $__env->make('users.message.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php elseif($receiver && $product): ?>
                        <div id="message-body" style="min-height: 250px;">
                        <div class="inbox-header">
                            <div class="inbox-header-profile">
                                <a class="inbox-header-img" target="_blank" href="<?php echo e(route('post_details',$product->slug )); ?>">
                                    <img src="<?php echo e(asset('upload/images/product/thumb/'.$product->feature_image)); ?>" alt="avatar">
                                </a>
                                <div class="inbox-header-text">
                                    <h5><a href="<?php echo e(route('userProfile', $receiver->username)); ?>"><?php echo e($receiver->name); ?></a></h5>
                                    <p><a target="_blank" href="<?php echo e(route('post_details',$product->slug )); ?>"><?php echo e(Str::limit($product->title, 40)); ?></a></p>
                                    <span><?php echo e(Config::get('siteSetting.currency_symble') . $product->price); ?></span>
                                </div>
                            </div>
                            <?php if($conversation): ?>
                            <ul class="inbox-header-list">
                                <li><a href="<?php echo e(route('deleteAllMessage', $conversation->id)); ?>" title="Delete" class="fas fa-trash-alt"></a></li>
                                <li><a href="javascript:void(0)" onclick="report(<?php echo e($product->id); ?>)" title="Report" class="fas fa-flag"></a></li>
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
                                            <p><?php echo $message->message; ?></p>
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
                                            <p><?php echo $message->message; ?></p>
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

                        <form class="inbox-chat-form mr-3" id="sendMessage" style="display: flex; align-items: center;">
                        <?php if(!$conversation || $conversation->block_user == null): ?>
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="productOrConId" value="<?php echo e($product->id); ?>">
                        <div><label for="attachment" title="Send image" style="margin: 7px;font-size: 30px;cursor: pointer;"><i class="fa fa-camera"></i> <input type="file" accept="image/*" style="display:none;" name="file[]" multiple id="attachment"> </label></div>
                        <textarea  name="message" class="message" required placeholder="Type a Message"></textarea>
                        <button class="sendMessage" onclick="sendMessage('<?php echo e($product->id); ?>')" type="button"><i class="fas fa-paper-plane"></i></button>
                        <?php else: ?>
                            <?php if($conversation->block_user == Auth::id()): ?>
                                <p>You've blocked message. You can't message In this chat and you won't receive their message.</p>
                                <a href="<?php echo e(route('blockUser', $conversation->id)); ?>">Unblock</a>
                            <?php else: ?>
                            <h3>You have been blocked so you can't send any message.</h3>
                            <?php endif; ?>
                        <?php endif; ?>
                        </form>
                        <?php endif; ?> 
                    <?php else: ?>
                    <div style="text-align: center;position: relative;top: 30%;">
                        <img width="30%" src="<?php echo e(asset('frontend/images/communication.png')); ?>">
                       <p> Select a chat to view conversation</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

    <div class="modal fade" id="reportModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Report</h4>
                    <button class="fas fa-times" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('sellerReport')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="product_id"  id="product_id">
                        <div id="reportForm"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>	  

<?php $__env->startSection('js'); ?> 
    <script src="<?php echo e(asset('frontend')); ?>/js/vendor/nice-select.min.js"></script>
    <script src="<?php echo e(asset('frontend')); ?>/js/vendor/nicescroll.min.js"></script>
    <script src="<?php echo e(asset('frontend')); ?>/js/custom/nice-select.js"></script>
    <script src="<?php echo e(asset('frontend')); ?>/js/custom/nicescroll.js"></script>
    <script>

    var mydiv = $("#inbox-chat-list");
    mydiv.scrollTop(mydiv.prop("scrollHeight"));
    function userHideShow() {
        $('.message-filter').addClass("boxShow").removeClass("boxHide");
        $('.message-inbox').addClass('boxHide').removeClass("boxShow");
    }

    var timeSet = '';
    function message(conversation_id){
        clearInterval(timeSet);
        $('.message-filter').addClass("boxHide").removeClass("boxShow");
        $('.message-inbox').addClass('boxShow').removeClass("boxHide");
        var  link = '<?php echo e(route("user.getMessages", ":id")); ?>';
        link = link.replace(":id", conversation_id);

        $.ajax({
            url:link,
            method:"get",
            success:function(data){
                if(data){
                    $('.message-inbox').html(data);
                    var mydiv = $("#inbox-chat-list");
                    mydiv.scrollTop(mydiv.prop("scrollHeight"));
                    timeSet = setInterval(function(){
                        realTime(conversation_id);
                    }, 9000);
               }else{
                    $('.message-inbox').html('<h3>User not found.</h3>');
               }
            }
        });

        var path = "<?php echo e(route('user.message')); ?>/"+conversation_id;
        history.pushState(null, null, path);
    }
</script>

<script type="text/javascript">
    function sendMessage(productOrConId){
        clearInterval(timeSet);
        var message = $('.message').val();
        if($('.message').val() == ''){
            $('.message').addClass('warning');
            return false;
        }
        $('.message').removeClass('warning');
        $.ajax({
        url:'<?php echo e(route("user.sendMessage")); ?>',
        type:'post',
        data:{productOrConId:productOrConId,message:message,'_token':'<?php echo e(csrf_token()); ?>'},
        success:function(data){
            if(data){ 
                $('#message-body').html(data);
                var mydiv = $("#inbox-chat-list");
                mydiv.scrollTop(mydiv.prop("scrollHeight"));
                //pass last sms
                $('#'+productOrConId).html(message);
                $('.message').val('');
                timeSet = setInterval(function(){
                        realTime(productOrConId);
                    }, 9000);
            }else{
                toastr.error('Message send failad.');
            }
          }
      });
    }


    $(document).on("change", "#attachment", function() {
            var formData = new FormData($('#sendMessage')[0]);
           console.log(formData);
            $.ajax({
                url:'<?php echo e(route("user.sendMessage")); ?>',
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                enctype: 'multipart/form-data',
                success:function(data){
                    if(data){
                        $('#message-body').html(data);
                        var mydiv = $("#inbox-chat-list");
                        mydiv.scrollTop(mydiv.prop("scrollHeight"));
                        
                    }else{
                        toastr.error('Message send failad.');
                    }
                },
                error: function(err) {
                   console.log(err.responseText);   // <-- printing error message to console
                }
            });
        });

    function realTime(conversation_id){

      $.ajax({
        url:'<?php echo e(route("realTimeMessage")); ?>',
        type:'get',
        data:{conversation_id:conversation_id},
        success:function(data){
            
            if(data.message){
                $('#inbox-chat-list').html(data.message);
                var mydiv = $("#inbox-chat-list");
                mydiv.scrollTop(mydiv.prop("scrollHeight"));
            }
            if(data.conversationUsers){
                $('.userList').html(data.conversationUsers);
            }
            
        }
      });
    }
    
    function removeMessage(id){
        var url = '<?php echo e(route("deleteMessage", ":id")); ?>';
        url = url.replace(":id",id);
        $.ajax({
            url:url,
            type:'get',
            success:function(data){
                if(data.status){
                    $('#message'+id).remove();
                }
            }
        })
    }

    function report(product_id){
        $('#reportModal').modal('show');
         $('#reportForm').html('<div class="loadingData-sm"></div>');

        $.ajax({
            method:'get',
            url:'<?php echo e(route("reportForm")); ?>',
            data:{
                type:'product'
            },
            success:function(data){
                if(data){
                    $('#reportForm').html(data);
                    $('#product_id').val(product_id);
                }

            }
        });
    }
    $('#userList').keyup(function(){
        var searchText = $(this).val().toUpperCase();
        $('.userList li a').each(function(){
        var currentLiText = $(this).text(),
            showCurrentLi = currentLiText.toUpperCase().indexOf(searchText) !== -1;
        $(this).toggle(showCurrentLi);
        });     
    });
    //browser back button action
    $(window).on('popstate', function() {  
        clearInterval(timeSet);
        $('.message-filter').addClass("boxShow").removeClass("boxHide");
        $('.message-inbox').addClass('boxHide').removeClass("boxShow");
        var path = window.location.pathname.split("/").pop();

        if(typeof path != 'undefined' && path != '' && path != 'message'){
        var  link = '<?php echo e(route("user.getMessages", ":path")); ?>';
        link = link.replace(":path", path);
        $.ajax({
            url:link,
            method:"get",
            success:function(data){
                if(data){
                    $('.message-inbox').html(data);
                    var mydiv = $("#inbox-chat-list");
                    mydiv.scrollTop(mydiv.prop("scrollHeight"));
                    timeSet = setInterval(function(){
                        realTime(conversation_id);
                    }, 9000);
               }else{
                    $('.message-inbox').html('<h3>User not found.</h3>');
               }
            }
        });
        }
   });
</script>
<?php $__env->stopSection(); ?>    
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/users/message/inbox.blade.php ENDPATH**/ ?>