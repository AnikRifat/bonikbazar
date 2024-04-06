
<?php $__env->startSection('title', 'Post lists' ); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container bg-white px-0">
        <?php echo $__env->make('users.inc.user_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <?php if((new \Jenssegers\Agent\Agent())->isDesktop()): ?>
            <div class="col-12 col-md-3">
                <?php echo $__env->make('users.inc.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div><?php endif; ?>
            <div class="col-12 col-md-9">
                <?php if(count($posts)>0): ?>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a class="p-2 gb w-100 bt text-center mr-2" href="<?php echo e(route('post.list', 'active')); ?>">Active Ads</a>
                    <a class="p-2 gb w-100 bt text-center mr-2" href="<?php echo e(route('post.list', 'deactive')); ?>">Deactive Ads</a>
                    <a class="p-2 gb w-100 bt text-center mr-2" href="<?php echo e(route('post.list', 'reject')); ?>">Reject Ads</a>
                    <a class="p-2 gb w-100 bt text-center" href="<?php echo e(route('post.list', 'pending')); ?>">Pending Ads</a>
                </div>
                <form action="" method="get" class="w-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <input name="title" placeholder="Title" value="<?php echo e(Request::get('title')); ?>" type="text" class="form-control mr-md-2">
                        <select name="status" class="form-control mr-md-2">
                            <option value="all" <?php echo e((Request::get('status') == "all") ? 'selected' : ''); ?>>All Status</option>
                            <option value="pending" <?php echo e((Request::get('status') == 'pending') ? 'selected' : ''); ?> >Pending</option>
                            <option value="active" <?php echo e((Request::get('status') == 'active') ? 'selected' : ''); ?>>Active</option>
                            <option value="deactive" <?php echo e((Request::get('status') == 'deactive') ? 'selected' : ''); ?>>Deactive</option>
                            <option value="reject" <?php echo e((Request::get('status') == 'reject') ? 'selected' : ''); ?>>Reject</option>
                        </select>
                        <button type="submit" class="form-control btn btn-success">Search</button>
                    </div>
                </form>
                <div class="table-responsive">
                    <table id="config-table" class="table post-list table-hover ">
                        <thead class="hidden-xs">
                            <tr>
                                <th>Image</th>
                                <th>Ads Title</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="d-h-flex" id="item<?php echo e($post->id); ?>">
                                <td>
                                    <a target="_blank" class="w-100" href="<?php echo e(route('post_details', $post->slug)); ?>">
                                        <img class="iuser" src="<?php echo e(asset('upload/images/product/thumb/'. $post->feature_image)); ?>">
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <a class="bt" target="_blank" href="<?php echo e(route('post_details', $post->slug)); ?>">
                                            <?php echo e($post->title); ?>

                                        </a>
                                        <p>Price: <?php echo e(Config::get('siteSetting.currency_symble')); ?>. <?php echo e($post->price); ?></p>
                                   
                                        <p>React: <?php echo e($post->reacts_count); ?></p>
                                        <p>Share: <?php echo e($post->share); ?></p>
                                        <p>Massage: <?php echo e($post->messages_count); ?></p>
                                        <p>Report: <?php echo e($post->reports_count); ?></p>
                                        <p>Date: <?php echo e(Carbon\Carbon::parse(($post->approved) ? $post->approved : $post->created)->format(Config::get('siteSetting.date_format'))); ?></p>
                                        <p>Views: <?php echo e($post->views); ?></p>
                                        <?php if($post->status == 'Not posted'): ?>
                                            <?php $last_free_post = App\Models\Product::where('subcategory_id', $post->subcategory_id)->where('user_id', $post->user_id)->where('id', '!=', $post->id)->orderBy('created_at', 'desc')->where('ad_type', 'free')->first();
                                            $days = 0;
                                            if($last_free_post){
                                            $to = \Carbon\Carbon::parse($last_free_post->created_at);
                                            $from = \Carbon\Carbon::parse(now());
                                            $days = $to->diffInDays($from);
                                            }
                                            $free_ads_duration = App\Models\SiteSetting::where('type', 'free_ads_limit')->first();
        
                                            ?>
                                        <?php else: ?>
                                            <?php if($post->reject_reason): ?>
                                            <p style="font-size:15px;color: red"><?php echo e($post->reject_reason); ?></p>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="action">
                                   <div class="status">
                                        <span class="post-status badge <?php if($post->status == 'reject'): ?>  badge-danger <?php elseif($post->status == 'Not posted'): ?> badge-danger <?php elseif($post->status == 'active'): ?> badge-success <?php else: ?> badge-info <?php endif; ?>"> <?php echo e($post->status); ?> </span>
                                        
                                    </div>
                                    <div>
                                        <a title="Edit ads" href="<?php echo e(route('post.edit', $post->slug)); ?>"><i class="fa fa-pencil-alt"></i> Edit</a>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" style="color:red;"  onclick='deleteModal(<?php echo e($post->id); ?>)' ><i class="fa fa-trash"></i> Delete</a> 
                                    </div>
                                    <div >
                                        <?php if($post->status == 'reject'): ?>
                                        <a class="btn btn-danger btn-sm" title="Edit ads" href="<?php echo e(route('post.edit', $post->slug)); ?>"><i class="ti-pencil-alt"></i> Edit Post</a>
                                        
        
                                        <?php elseif($post->status == 'pending'): ?>
                                        <a class="btn btn-warning btn-sm" title="Review this post" href="<?php echo e(route('post.edit', $post->slug)); ?>"> In review</a>
        
                                        <?php elseif($post->status == 'Not posted' || $post->status == 'draft'): ?>
                                        <a class="bt btn-primary btn-sm" title="Wait for free or promote ads" href="<?php echo e(route('post.edit', $post->slug)); ?>?status=post-now"><i class="ti-pencil-alt"></i>Continue Editing</a>
                                        <?php else: ?>
                                        <a class="bt btn-warning btn-sm" title="Promote ads" href="<?php echo e(route('ads.promotePackage', $post->slug)); ?>" style="width: 75px;"><i class="ti-pencil-alt"></i><?php if(count($post->get_promotePackage)>0): ?> Boosted <?php else: ?> Boost Ad <?php endif; ?></a>
                                        <?php endif; ?>
                                     </div>                                    
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr style="margin: 5px"><td colspan="4"><?php echo e($posts->appends(request()->query())->links()); ?></td></tr>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <h3 class="pb-2 mb-2 border-bottom"><?php echo e(Auth::user()->name); ?></h3>
                <div class="my-5 pt-md-5">
                    <div class="d-flex justify-content-center align-items-center">
                        <img width="95" height="63" src="https://w.bikroy-st.com/dist/img/all/shop/empty-1x-6561cc5e.png">
                        <div class="ml-3 text-center">
                            <h4>You don't have any ads yet.</h4>
                            <p>Click the "Post an ad now!" button to post your ad.</p>
                        </div>
                    </div>
                    <p class="d-flex justify-content-center align-items-end my-5">
                        <img height="56" src="<?php echo e(asset('upload/images/as.jpg')); ?>">
                        <a class="yb p-2 text-center bt bb2 rounded font-weight-bold f-12 mx-3 mb-n3" href="<?php echo e(route('post.create')); ?>">Post your ad now!</a>
                        <img height="56" style="-webkit-transform: scaleX(-1);transform: scaleX(-1);" src="<?php echo e(asset('upload/images/as.jpg')); ?>">
                    </p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
   
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Post Delete</h4>
                    <button class="fas fa-times" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('post.delete')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="product_id" id="product_id">
                         
                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="required" for="reason">Delete Reason</label>
                                    <select required name="reason" class="form-control">
                                        <option value="">Select reason</option>
                                    <?php $__currentLoopData = $reasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($reason->reason); ?>"><?php echo e($reason->reason); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="required" for="reason_details">Please describe delete reason.</label>
                                    <textarea class="form-control" required minlength="6" rows="2" id="reason_details" placeholder="Write reason details" name="reason_details"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger"> Delete Now</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
    function deleteModal(product_id){
        $('#deleteModal').modal('show');
        $('#product_id').val(product_id);
    }
    document.addEventListener('readystatechange', event => {
        if (event.target.readyState === "complete") {
            var clockdiv = document.getElementsByClassName("clockdiv");
          var countDownDate = new Array();
            for (var i = 0; i < clockdiv.length; i++) {
                countDownDate[i] = new Array();
                countDownDate[i]['el'] = clockdiv[i];
                countDownDate[i]['time'] = new Date(clockdiv[i].getAttribute('data-date')).getTime();
                countDownDate[i]['days'] = 0;
                countDownDate[i]['hours'] = 0;
                countDownDate[i]['seconds'] = 0;
                countDownDate[i]['minutes'] = 0;
            }
          
            var countdownfunction = setInterval(function() {
                for (var i = 0; i < countDownDate.length; i++) {
                    var now = new Date().getTime();
                    var distance = countDownDate[i]['time'] - now;
                    countDownDate[i]['days'] = Math.floor(distance / (1000 * 60 * 60 * 24));
                    countDownDate[i]['hours'] = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    countDownDate[i]['minutes'] = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    countDownDate[i]['seconds'] = Math.floor((distance % (1000 * 60)) / 1000);

                    if (distance < 0) {
                        countDownDate[i]['el'].querySelector('.days').innerHTML = 0;
                        countDownDate[i]['el'].querySelector('.hours').innerHTML = 0;
                        countDownDate[i]['el'].querySelector('.minutes').innerHTML = 0;
                        countDownDate[i]['el'].querySelector('.seconds').innerHTML = 0;
                    }else{
                        countDownDate[i]['el'].querySelector('.days').innerHTML = countDownDate[i]['days'];
                        countDownDate[i]['el'].querySelector('.hours').innerHTML = countDownDate[i]['hours'];
                        countDownDate[i]['el'].querySelector('.minutes').innerHTML = countDownDate[i]['minutes'];
                        countDownDate[i]['el'].querySelector('.seconds').innerHTML = countDownDate[i]['seconds'];
                    } 
                }
            }, 1000);
        }
    });
</script>  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Minhaz\bonikbazar\resources\views/users/post/index.blade.php ENDPATH**/ ?>