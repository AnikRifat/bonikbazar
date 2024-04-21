<?php if(count($bannerAds) > 0): ?>
    <div id="carouselExampleControls" class="carousel slide  w-100 rounded" data-ride="carousel" style="max-height: 382px;">
        <div class="carousel-inner">
            <?php $__currentLoopData = $bannerAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $bannerAd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('post_details', $bannerAd->slug)); ?>"
                    class="carousel-item <?php if($index == 0): ?> active <?php endif; ?> ">
                    <img class="d-block rounded w-100 mh-300 lazyload"
                        src="<?php echo e(asset('upload/images/product/default.jpg')); ?>"
                        data-src="<?php echo e(asset('upload/images/product/' . $bannerAd->feature_image)); ?>"
                        alt="<?php echo e($bannerAd->title); ?>">
                    <div class="position-absolute left-0 bottom-0 rounded bgs w-100">
                        <h4 class="text-white title"><?php echo e($bannerAd->title); ?></h4>
                        <p class="text-white" title="<?php echo e($bannerAd->state_name); ?>"><?php echo e($bannerAd->category_name); ?>

                            (<?php echo e($bannerAd->sale_type ? $bannerAd->sale_type : $bannerAd->post_type); ?>)
                            ,
                            <?php echo e($bannerAd->state_name); ?></p>
                        <div class="d-flex align-items-center pb-1">
                            <div class="d-flex align-items-center">
                                <b class="text-white pr-1"><?php echo e(Config::get('siteSetting.currency_symble')); ?>.</b>
                                <b class="text-white py-1 mr-2"><?php echo e($bannerAd->price); ?></b>
                            </div>
                            <?php if($bannerAd->membership_ribbon): ?>
                                <div class="d-flex align-items-center">
                                    <img class="lazyload" width="25"
                                        src="<?php echo e(asset('upload/images/membership/' . $bannerAd->membership_ribbon)); ?>">
                                    <p class="text-white"><?php echo e($bannerAd->membership_name); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <a class="h1s position-absolute left-0 top-50  px-2 py-1" href="#carouselExampleControls" role="button"
            data-slide="prev">
            <img height="15" src="<?php echo e(asset('upload/images/a.png')); ?>">
        </a>
        <a class="h1s position-absolute right-0 top-50  px-2 py-1" href="#carouselExampleControls" role="button"
            data-slide="next">
            <img height="15" class="transform-180" src="<?php echo e(asset('upload/images/a.png')); ?>">
        </a>
    </div>
<?php endif; ?>

<div
    class="e6 py-2 px-2 mx-2 px-md-4 mx-md-4 rounded position-relative shadow-bb <?php if(count($bannerAds) > 0): ?> mt--4 <?php endif; ?>">
    <div class="d-flex align-items-center justify-content-between">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#selectcatmodal"
            class="d-flex align-items-center">
            <img width="35" height="35" class="lazyload mr-2" src="<?php echo e(asset('upload/images/m-1.png')); ?>">
            <p class="bt">
                <?php if($category): ?>
                    <?php echo e($category->name); ?>

                <?php else: ?>
                    Categories
                <?php endif; ?>
            </p>
        </a>
        <a href="javascript:void(0)" data-toggle="modal" data-target="#locationmodal" class="d-flex align-items-center">
            <img width="35" height="35" class="lazyload mr-1" src="<?php echo e(asset('upload/images/m-2.png')); ?>">
            <p class="bt">
                <?php if($state): ?>
                    <?php echo e($state->name); ?>

                <?php else: ?>
                    Location
                <?php endif; ?>
            </p>
        </a>
        <?php if(!(new \Jenssegers\Agent\Agent())->isDesktop()): ?>
            <div>
                <a href="javascript:void(0)" class="d-flex align-items-center filterBtn open-filter btn btn-block">
                    <img width="35" height="35" class="lazyload mr-1"
                        src="<?php echo e(asset('upload/images/m-3.png')); ?>">
                    <p class="bt">Filter</p>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- <p style="margin: 5px 0; "> (<?php echo e(($products ? $products->total() : '0') + count($pinAds) + count($urgentAds) + count($highlightAds) + count($fastAds)); ?>  ) ads found <?php echo e(Request::get('q')); ?> </p> -->

<div class="row mt-2">


    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-6 col-sm-6 w-100 position-relative p-1">
            <div class="w-100 ab p-2 shadow-bb rounded" href="<?php echo e(route('post_details', $item['slug'])); ?>">
                <div class="position-relative">
                    <a class="w-100" href="<?php echo e(route('post_details', $item['slug'])); ?>">
                        <img width="24" class="lazyload w-100 mh-300"
                            src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>"
                            data-src="<?php echo e(asset('upload/images/product/thumb/' . $item['feature_image'])); ?>"
                            alt="<?php echo e($item['title']); ?>">
                    </a>
                </div>
                <div class="ppb-5 overflow-hidden h-100">
                    <a href="<?php echo e(route('post_details', $item['slug'])); ?>">
                        <h4 class="font-weight-bold bt py-1 title" title="<?php echo e($item['title']); ?>"><?php echo e($item['title']); ?>

                        </h4>
                    </a>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div>
                            <?php if($item['membership_ribbon']): ?>
                                <div class="d-flex align-items-center">
                                    <img class="lazyload m<p>Model:</p>

                                    r-1"
                                        width="20"
                                        src="<?php echo e(asset('upload/images/membership/' . $item['membership_ribbon'])); ?>">
                                    <p class="bt"><?php echo e($item['membership_name']); ?></p>
                                </div>
                            <?php endif; ?>


                            <p class="bt"
                                title="<?php echo e(isset($item['state_name']) ? $item['state_name'] : $item['get_state']['name']); ?>">
                                <?php echo e(isset($item['state_name']) ? $item['state_name'] : $item['get_state']['name']); ?></p>
                            <p class="bt hidden-xs" title="<?php echo e($item['category_name']); ?>"> <?php echo e($item['category_name']); ?>

                                (<?php echo e($item['sale_type'] ? $item['sale_type'] : $item['post_type']); ?>)
                            </p>
                        </div>
                        <?php if(isset($item['ribbon']) && $item['ribbon']): ?>
                            <div>
                                <img class="lazyload" width="20"
                                    src="<?php echo e(asset('upload/images/package/' . $item['ribbon'])); ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="font-weight-bold bt">
                            <?php echo e(Config::get('siteSetting.currency_symble') . ' ' . number_format($item['price'])); ?></h4>
                        

                    </div>

                </div>
            </div>
            <a class="position-absolute bottom-1 hidden-md"
                href="<?php echo e(route('user.message', [$item['username'], $item['slug']])); ?>" title="Message">
                <img width="20" height="20" src="<?php echo e(asset('upload/images/sendss.svg')); ?>" alt="sms">
            </a>
            <div class="hidden-xs">
                <div class="btn-group btn-block" role="group" aria-label="Basic example">
                    <?php if(Auth::check() && Auth::user()->getMembership): ?>

                    <?php if( Auth::user()->getMembership->name=="Authentic Bonik"): ?>
                    <a class='btn  btn-success text-white text-center px-1' href=""><i
                            class="fa fa-phone fa-flip-horizontal" style="color:white"></i> Call</a>
                    <a href="<?php echo e(route('user.message')); ?>" class='btn btn-sm btn-info text-white text-center px-1' href=""><i
                            class="fa fa-paper-plane"></i>Chat</a>
                    <a class='btn btn-sm btn-warning text-center px-1' href=""><i
                            class="fa fa-cart-plus"></i>Buy</a>
                    <?php elseif(Auth::user()->getMembership->name=="Verified Bonik"): ?>
                    <a class='btn  btn-success text-white text-center px-1' href=""><i
                            class="fa fa-phone fa-flip-horizontal" style="color:white"></i> Call</a>
                    <a href="<?php echo e(route('user.message')); ?>" class='btn btn-sm btn-info text-white text-center px-1' href=""><i
                            class="fa fa-paper-plane"></i>Chat</a>
                   
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH D:\Minhaz\bonikbazar\resources\views/frontend/post-filter.blade.php ENDPATH**/ ?>