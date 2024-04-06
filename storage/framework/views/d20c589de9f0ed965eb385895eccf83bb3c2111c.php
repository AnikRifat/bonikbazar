
<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container bg-white mb-2 px-0">
        <?php echo $__env->make('users.inc.user_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <?php if((new \Jenssegers\Agent\Agent())->isDesktop()): ?>
            <div class="col-12 col-md-3">
                <?php echo $__env->make('users.inc.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div><?php endif; ?>
            <div class="col-12 col-md-9 px-0">
                
                <?php if(count($posts)>0): ?>
                    <div class="row">
                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="w-100 col-md-4 col-6 mb-2 position-relative">
                        <a class="w-100 bg-white shadow-bb rounded p-2"  href="<?php echo e(route('post_details', $post->slug)); ?>">
                            <div class="position-relative">
                                <img class="lazyload w-100" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/thumb/'. $post->feature_image)); ?>" alt="<?php echo e($post->title); ?>">
                            </div>
                            <div class="w-100">
                                <h4 class="font-weight-bold bt py-1" title=""><?php echo e($post->title); ?></h4>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="bt "><?php echo e($post->get_state->name ?? ''); ?></p>
                                        <p class="bt "><?php echo e($post->get_subcategory->name ?? ''); ?> (<?php echo e(($post->sale_type) ? $post->sale_type : $post->post_type); ?>)</p>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="font-weight-bold bt py-1"><?php echo e(Config::get('siteSetting.currency_symble') . $post->price); ?></h4>
                                    <p class="bt py-1"><?php echo e(Carbon\Carbon::parse($post->created_at)->format(Config::get('siteSetting.date_format'))); ?></p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php echo e($posts->appends(request()->query())->links()); ?>

                <?php else: ?>
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
            <!--Middle Part End-->
        </div>
    </div>
    
<?php $__env->stopSection(); ?>     
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>     



<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Minhaz\bonikbazar\resources\views/users/dashboard.blade.php ENDPATH**/ ?>