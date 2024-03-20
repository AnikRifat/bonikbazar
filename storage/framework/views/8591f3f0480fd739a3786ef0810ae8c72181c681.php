<?php if(count($bannerAds)>0): ?>
    <div id="carouselExampleControls" class="carousel slide  w-100 rounded" data-ride="carousel" style="max-height: 382px;">
        <div class="carousel-inner">
            <?php $__currentLoopData = $bannerAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $bannerAd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('post_details', $bannerAd->slug)); ?>" class="carousel-item <?php if($index==0): ?> active <?php endif; ?> ">
                <img class="d-block rounded w-100 mh-300 lazyload" src="<?php echo e(asset('upload/images/product/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/'.$bannerAd->feature_image)); ?>" alt="<?php echo e($bannerAd->title); ?>">
                <div class="position-absolute left-0 bottom-0 rounded bgs w-100">
                    <h4 class="text-white title"><?php echo e($bannerAd->title); ?></h4>
                    <p class="text-white" title="<?php echo e($bannerAd->state_name); ?>"><?php echo e($bannerAd->category_name); ?> (<?php echo e(($bannerAd->sale_type) ? $bannerAd->sale_type : $bannerAd->post_type); ?>), <?php echo e($bannerAd->state_name); ?></p>
                    <div class="d-flex align-items-center pb-1">
                        <div class="d-flex align-items-center">
                            <b class="text-white pr-1"><?php echo e(Config::get('siteSetting.currency_symble')); ?>.</b>
                            <b class="text-white py-1 mr-2"><?php echo e($bannerAd->price); ?></b>
                        </div>
                        <?php if($bannerAd->membership_ribbon): ?>
                        <div class="d-flex align-items-center">
                            <img class="lazyload" width="25" src="<?php echo e(asset('upload/images/membership/'.$bannerAd->membership_ribbon)); ?>">
                            <p class="text-white"><?php echo e($bannerAd->membership_name); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <a class="h1s position-absolute left-0 top-50  px-2 py-1" href="#carouselExampleControls" role="button" data-slide="prev">
            <img height="15" src="<?php echo e(asset('upload/images/a.png')); ?>">
        </a>
        <a class="h1s position-absolute right-0 top-50  px-2 py-1" href="#carouselExampleControls" role="button" data-slide="next">
            <img height="15" class="transform-180" src="<?php echo e(asset('upload/images/a.png')); ?>">
        </a>
    </div>
<?php endif; ?>

<div class="e6 py-2 px-2 mx-2 px-md-4 mx-md-4 rounded position-relative shadow-bb <?php if(count($bannerAds)>0): ?> mt--4 <?php endif; ?>">
    <div class="d-flex align-items-center justify-content-between">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#selectcatmodal" class="d-flex align-items-center">
            <img width="35" height="35" class="lazyload mr-2" src="<?php echo e(asset('upload/images/m-1.png')); ?>">
            <p class="bt">  <?php if($category): ?> <?php echo e($category->name); ?> <?php else: ?> Categories <?php endif; ?>
            </p>
        </a>
        <a href="javascript:void(0)" data-toggle="modal" data-target="#locationmodal" class="d-flex align-items-center">
            <img width="35" height="35" class="lazyload mr-1" src="<?php echo e(asset('upload/images/m-2.png')); ?>">
            <p class="bt"><?php if($state): ?> <?php echo e($state->name); ?> <?php else: ?> Location <?php endif; ?></p>
        </a>
        <?php if(!(new \Jenssegers\Agent\Agent())->isDesktop()): ?>
        <div>
            <a href="javascript:void(0)" class="d-flex align-items-center filterBtn open-filter btn btn-block">
                <img width="35" height="35" class="lazyload mr-1" src="<?php echo e(asset('upload/images/m-3.png')); ?>">
                <p class="bt">Filter</p>
            </a>
        </div>
        
        <?php endif; ?>
    </div>
</div>

<!-- <p style="margin: 5px 0; "> (<?php echo e(($products ?  $products->total() : '0') + count($pinAds) + count($urgentAds) + count($highlightAds) + count($fastAds)); ?>  ) ads found <?php echo e(Request::get('q')); ?> </p> -->

<div class="row mt-2">

<?php if(count($products)>0 || count($pinAds)>0 || count($urgentAds)>0 || count($highlightAds)>0 || count($fastAds)>0): ?> 

<?php for($index=0; $index < 24; $index++  ): ?> 
    
    <?php if($index == 0): ?>

        <?php if(count($pinAds)>0): ?>
            <?php $__currentLoopData = $pinAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pinAd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-sm-6 w-100 position-relative p-1">
                <div class="w-100 ab p-2 shadow-bb rounded" href="<?php echo e(route('post_details', $pinAd->slug)); ?>">
                    <div class="position-relative">
                        <a class="w-100" href="<?php echo e(route('post_details', $pinAd->slug)); ?>">
                            <img width="24" class="lazyload w-100 mh-300" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/thumb/'.$pinAd->feature_image)); ?>" alt="<?php echo e($pinAd->title); ?>">
                        </a>
                    </div>
                    <div class="ppb-5 overflow-hidden h-100">
                        <a href="<?php echo e(route('post_details', $pinAd->slug)); ?>">
                            <h4 class="font-weight-bold bt py-1 title" title="<?php echo e($pinAd->title); ?>"><?php echo e($pinAd->title); ?></h4>
                        </a>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div>
                                <?php if($pinAd->membership_ribbon): ?>
                                <div class="d-flex align-items-center">
                                    <img class="lazyload mr-1" width="20" src="<?php echo e(asset('upload/images/membership/'.$pinAd->membership_ribbon)); ?>">
                                    <p class="bt"><?php echo e($pinAd->membership_name); ?></p>
                                </div>
                                <?php endif; ?>
                                <p class="bt" title="<?php echo e($pinAd->state_name); ?>"><?php echo e($pinAd->state_name); ?></p>
                                <p class="bt hidden-xs" title="<?php echo e($pinAd->category_name); ?>"> <?php echo e($pinAd->category_name); ?> (<?php echo e(($pinAd->sale_type) ? $pinAd->sale_type : $pinAd->post_type); ?>)</p>
                            </div>
                            <?php if($pinAd->ribbon): ?>
                            <div>
                                <img class="lazyload" width="20" src="<?php echo e(asset('upload/images/package/'.$pinAd->ribbon)); ?>">
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold bt"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($pinAd->price)); ?></h4>
                            <p class="bt hidden-xs"><?php echo e(Carbon\Carbon::parse($pinAd->approved ? $pinAd->approved : $pinAd->created_at)->diffForHumans()); ?></p>
                            
                        </div>
                        
                    </div>
                </div>
                <a class="position-absolute bottom-1 hidden-md" href="<?php echo e(route('user.message', [$pinAd->username, $pinAd->slug])); ?>" title="Message">
                    <img width="20" height="20" src="<?php echo e(asset('upload/images/sendss.svg')); ?>" alt="sms">
                </a>
                <div class="hidden-xs">
                    <div class="d-flex mt-n3 position-relative z-3">
                        <form action="<?php echo e(route('user.sendMessage')); ?>?send=direct" method="post" class="d-flex align-items-center bb2 rounded shadow mx-3">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="productOrConId" value="<?php echo e($pinAd->id); ?>">
                        <input type="text" name="message" id="message<?php echo e($pinAd->id); ?>" class="px-2 py-1 w-100 rounded" placeholder="Send message">
                        <button <?php if(Auth::check()): ?> onclick="sendMessage(<?php echo e($pinAd->id); ?>)" <?php else: ?> data-target="#so_sociallogin" data-toggle="modal" <?php endif; ?> type="button"><img height="23" src="<?php echo e(asset('upload/images/sendss.svg')); ?>"></button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
 
    <?php elseif($index >= 1 && $index <=4): ?>

        <?php $productIndex = ($index - 1); ?>

        <?php if($productIndex < count($products)): ?>
        <?php $product = $products[$productIndex]; ?>

        <div class="col-6 col-sm-6 w-100 position-relative p-1">
            <div class="w-100 bg-white rounded position-relative h-100">
                <div class="position-relative">
                  <a class="w-100" href="<?php echo e(route('post_details', $product->slug)); ?>">
                    <img class="lazyload w-100 mh-300" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/thumb/'.$product->feature_image)); ?>" alt="<?php echo e($product->title); ?>">
                    </a>
                </div>
                <div class="ppb-5 overflow-hidden">
                    <a href="<?php echo e(route('post_details', $product->slug)); ?>">
                        <h4 class="font-weight-bold bt py-1 title" title="<?php echo e($product->title); ?>"><?php echo e($product->title); ?></h4>
                    </a>
                    <div class="d-flex align-items-center justify-content-between">
                        
                        <div>
                           <?php if($product->membership_ribbon): ?>
                            <div class="d-flex align-items-center">
                                <img class="lazyload mr-1" width="20" src="<?php echo e(asset('upload/images/membership/'.$product->membership_ribbon)); ?>">
                                <p class="bt"><?php echo e($product->membership_name); ?></p>
                            </div><?php endif; ?>
                            <p class="bt"><?php echo e($product->get_state->name ?? ''); ?></p>
                            <p class="bt hidden-xs"><?php echo e($product->category_name ?? ''); ?> (<?php echo e(($product->sale_type) ? $product->sale_type : $product->post_type); ?>)</p>
                            
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="font-weight-bold bt py-1"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($product->price)); ?></h4>
                        <p class="bt py-1 hidden-xs"><?php echo e(Carbon\Carbon::parse($product->approved ? $product->approved : $product->created_at)->diffForHumans()); ?></p>
                    </div>
                </div>
                <a class="position-absolute bottom-1 hidden-md" href="<?php echo e(route('user.message', [$product->username, $product->slug])); ?>" title="Message">
                    <img width="20" height="20" src="<?php echo e(asset('upload/images/sendss.svg')); ?>" alt="sms">
                </a>
            </div>
            
            <div class=" hidden-xs">
                <div class="d-flex mt-n3 position-relative z-3">
                    <form action="<?php echo e(route('user.sendMessage')); ?>?send=direct" method="post" class="d-flex align-items-center bb2 rounded shadow mx-3">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="productOrConId" value="<?php echo e($product->id); ?>">
                    <input type="text" name="message" id="message<?php echo e($product->id); ?>" class="px-2 py-1 w-100 rounded" placeholder="Send message">
                    <button <?php if(Auth::check()): ?> onclick="sendMessage(<?php echo e($product->id); ?>)" <?php else: ?> data-target="#so_sociallogin" data-toggle="modal" <?php endif; ?> type="button"><img height="23" src="<?php echo e(asset('upload/images/sendss.svg')); ?>"></button>
                    </form>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if($index == 4 && count($products)>0): ?>
            
            <?php echo $__env->make("frontend.mobile-ads", ["adType" => "linkAd", "class" => "col-6 col-sm-6 w-100  p-2"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
        <?php endif; ?>

    <?php elseif($index == 5): ?>
      
        <?php $__currentLoopData = $urgentAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $urgentAd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-6 col-sm-6 w-100 position-relative p-1">
            <div class="w-100 position-relative ab p-2 shadow-bb rounded">
                <div class="position-relative">
                    <a class="w-100" href="<?php echo e(route('post_details', $urgentAd->slug)); ?>">
                    <img class="lazyload w-100 mh-300" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/thumb/'.$urgentAd->feature_image)); ?>" alt="<?php echo e($urgentAd->title); ?>">
                    </a>
                </div>
                <div class="ppb-5 overflow-hidden h-100">
                     <a href="<?php echo e(route('post_details', $urgentAd->slug)); ?>">
                         <h4 class="font-weight-bold bt py-1 title" title="<?php echo e($urgentAd->title); ?>"><?php echo e($urgentAd->title); ?></h4>
                    </a>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <?php if($urgentAd->membership_ribbon): ?>
                            <div class="d-flex align-items-center">
                                <img class="lazyload mr-1" width="20" src="<?php echo e(asset('upload/images/membership/'.$urgentAd->membership_ribbon)); ?>">
                                <p class="bt"><?php echo e($urgentAd->membership_name); ?></p>
                            </div>
                            <?php endif; ?>
                            <p class="bt" title="<?php echo e($urgentAd->state_name); ?>"><?php echo e($urgentAd->state_name); ?></p>
                            <p class="bt hidden-xs" title="<?php echo e($urgentAd->category_name); ?>"> <?php echo e($urgentAd->category_name); ?> (<?php echo e(($urgentAd->sale_type) ? $urgentAd->sale_type : $urgentAd->post_type); ?>)</p>
                        </div>
                        <?php if($urgentAd->ribbon): ?>
                        <img width="20" src="<?php echo e(asset('upload/images/package/'.$urgentAd->ribbon)); ?>">
                        <?php endif; ?>
                    </div>
                    
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="font-weight-bold bt py-1"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($urgentAd->price)); ?></h4>
                        <p class="bt py-1 hidden-xs"><?php echo e(Carbon\Carbon::parse($urgentAd->approved ? $urgentAd->approved : $urgentAd->created_at)->diffForHumans()); ?></p>
                    </div>
                </div><a class="position-absolute bottom-1 hidden-md" href="<?php echo e(route('user.message', [$urgentAd->username, $urgentAd->slug])); ?>" title="Message">
                <img width="20" height="20" src="<?php echo e(asset('upload/images/sendss.svg')); ?>" alt="sms">
            </a>
            </div>
            
            <div class=" hidden-xs">
                <div class="d-flex mt-n3 position-relative z-3">
                    <form action="<?php echo e(route('user.sendMessage')); ?>?send=direct" method="post" class="d-flex align-items-center bb2 rounded shadow mx-3">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="productOrConId" value="<?php echo e($urgentAd->id); ?>">
                    <input type="text" name="message" id="message<?php echo e($urgentAd->id); ?>" class="px-2 py-1 w-100 rounded" placeholder="Send message">
                    <button <?php if(Auth::check()): ?> onclick="sendMessage(<?php echo e($urgentAd->id); ?>)" <?php else: ?> data-target="#so_sociallogin" data-toggle="modal" <?php endif; ?> type="button"><img height="23" src="<?php echo e(asset('upload/images/sendss.svg')); ?>"></button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php elseif($index >= 6 && $index <= 9): ?>

        <?php $productIndex = ($index - 2); ?>

        <?php if($productIndex < count($products)): ?>
        <?php $product = $products[$productIndex]; ?>

        <div class="col-6 col-sm-6 w-100 position-relative p-1">
            <div class="w-100 bg-white position-relative rounded">
                <div class="position-relative">
                  <a class="w-100" href="<?php echo e(route('post_details', $product->slug)); ?>">
                    <img class="lazyload w-100 mh-300" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/thumb/'.$product->feature_image)); ?>" alt="<?php echo e($product->title); ?>">
                    </a>
                </div>
                <div class="ppb-5 overflow-hidden h-100">
                    <a href="<?php echo e(route('post_details', $product->slug)); ?>">
                        <h4 class="font-weight-bold bt py-1 title" title="<?php echo e($product->title); ?>"><?php echo e($product->title); ?></h4>
                    </a>
                    <div class="d-flex align-items-center justify-content-between">
                        
                        <div>
                           <?php if($product->membership_ribbon): ?>
                            <div class="d-flex align-items-center">
                                <img class="lazyload mr-1" width="20" src="<?php echo e(asset('upload/images/membership/'.$product->membership_ribbon)); ?>">
                                <p class="bt"><?php echo e($product->membership_name); ?></p>
                            </div><?php endif; ?>
                            <p class="bt"><?php echo e($product->get_state->name ?? ''); ?></p>
                            <p class="bt hidden-xs"><?php echo e($product->category_name ?? ''); ?> (<?php echo e(($product->sale_type) ? $product->sale_type : $product->post_type); ?>)</p>
                            
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="font-weight-bold bt py-1"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($product->price)); ?></h4>
                        <p class="bt py-1 hidden-xs"><?php echo e(Carbon\Carbon::parse($product->approved ? $product->approved : $product->created_at)->diffForHumans()); ?></p>
                    </div>
                </div><a class="position-absolute bottom-1 hidden-md" href="<?php echo e(route('user.message', [$product->username, $product->slug])); ?>" title="Message">
                <img width="20" height="20" src="<?php echo e(asset('upload/images/sendss.svg')); ?>" alt="sms">
            </a>
            </div>
            
            <div class=" hidden-xs">
                <div class="d-flex mt-n3 position-relative z-3">
                    <form action="<?php echo e(route('user.sendMessage')); ?>?send=direct" method="post" class="d-flex align-items-center bb2 rounded shadow mx-3">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="productOrConId" value="<?php echo e($product->id); ?>">
                    <input type="text" name="message" id="message<?php echo e($product->id); ?>" class="px-2 py-1 w-100 rounded" placeholder="Send message">
                    <button <?php if(Auth::check()): ?> onclick="sendMessage(<?php echo e($product->id); ?>)" <?php else: ?> data-target="#so_sociallogin" data-toggle="modal" <?php endif; ?> type="button"><img height="23" src="<?php echo e(asset('upload/images/sendss.svg')); ?>"></button>
                    </form>
                </div>
            </div>
        </div>
        <?php endif; ?>
    <?php elseif($index == 12): ?>
   
        <?php $__currentLoopData = $highlightAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $highlightAd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-6 col-sm-6 w-100 position-relative p-1">
            <div class="w-100 position-relative ab p-2 shadow-bb rounded">
                <div class="position-relative">
                    
                    <a class="w-100" href="<?php echo e(route('post_details', $highlightAd->slug)); ?>">
                    <img class="lazyload w-100 mh-300" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/thumb/'.$highlightAd->feature_image)); ?>" alt="<?php echo e($highlightAd->title); ?>">
                    </a>
                </div>
                <div class="ppb-5 overflow-hidden h-100">
                    <a href="<?php echo e(route('post_details', $highlightAd->slug)); ?>">
                        <h4 class="font-weight-bold bt py-1 title" title="<?php echo e($highlightAd->title); ?>"><?php echo e($highlightAd->title); ?></h4>
                    </a>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <?php if($highlightAd->membership_ribbon): ?>
                            <div class="d-flex align-items-center">
                                <img class="lazyload mr-1" width="20" src="<?php echo e(asset('upload/images/membership/'.$highlightAd->membership_ribbon)); ?>">
                                <p class="bt"><?php echo e($highlightAd->membership_name); ?></p>
                            </div>
                            <?php endif; ?>
                            <p class="bt" title="<?php echo e($highlightAd->state_name); ?>"><?php echo e($highlightAd->state_name); ?></p>
                            <p class="bt hidden-xs"> <?php echo e($highlightAd->category_name); ?> (<?php echo e(($highlightAd->sale_type) ? $highlightAd->sale_type : $highlightAd->post_type); ?>)</p>
                        </div>
                        <?php if($highlightAd->ribbon): ?>
                        <img width="25" class="lazyload" src="<?php echo e(asset('upload/images/package/'.$highlightAd->ribbon)); ?>">
                        <?php endif; ?>
                    </div>
                    
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="font-weight-bold bt py-1"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($highlightAd->price)); ?></h4>
                        <p class="bt py-1 hidden-xs"><?php echo e(Carbon\Carbon::parse($highlightAd->approved ? $highlightAd->approved : $highlightAd->created_at)->diffForHumans()); ?></p>
                    </div>
                </div><a class="position-absolute bottom-1 hidden-md" href="<?php echo e(route('user.message', [$highlightAd->username, $highlightAd->slug])); ?>" title="Message">
                <img width="20" height="20" src="<?php echo e(asset('upload/images/sendss.svg')); ?>" alt="sms">
            </a>
            </div>
            
            <div class=" hidden-xs">
                <div class="d-flex mt-n3 position-relative z-3">
                    <form action="<?php echo e(route('user.sendMessage')); ?>?send=direct" method="post" class="d-flex align-items-center bb2 rounded shadow mx-3">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="productOrConId" value="<?php echo e($highlightAd->id); ?>">
                    <input type="text" name="message" id="message<?php echo e($highlightAd->id); ?>" class="px-2 py-1 w-100 rounded" placeholder="Send message">
                    <button <?php if(Auth::check()): ?> onclick="sendMessage(<?php echo e($highlightAd->id); ?>)" <?php else: ?> data-target="#so_sociallogin" data-toggle="modal" <?php endif; ?> type="button"><img height="23" src="<?php echo e(asset('upload/images/sendss.svg')); ?>"></button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php $__currentLoopData = $fastAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fastAd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-6 col-sm-6 w-100 position-relative p-1">
            <div class="w-100 position-relative ab p-2 shadow-bb rounded">
                <div class="position-relative">
                    <a class="w-100" href="<?php echo e(route('post_details', $fastAd->slug)); ?>">
                    <img class="lazyload w-100 mh-300" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/thumb/'.$fastAd->feature_image)); ?>" alt="<?php echo e($fastAd->title); ?>">
                    </a>
                </div>
                <div class="ppb-5 overflow-hidden h-100">
                    <a href="<?php echo e(route('post_details', $fastAd->slug)); ?>">
                        <h4 class="font-weight-bold bt py-1 title" title="<?php echo e($fastAd->title); ?>"><?php echo e($fastAd->title); ?></h4>
                    </a>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <?php if($fastAd->membership_ribbon): ?>
                            <div class="d-flex align-items-center">
                                <img class="lazyload mr-1" width="20" src="<?php echo e(asset('upload/images/membership/'.$fastAd->membership_ribbon)); ?>">
                                <p class="bt"><?php echo e($fastAd->membership_name); ?></p>
                            </div><?php endif; ?>
                            <p class="bt" title="<?php echo e($fastAd->state_name); ?>"><?php echo e($fastAd->state_name); ?></p>
                            <p class="bt hidden-xs" title="<?php echo e($fastAd->category_name); ?>"><?php echo e($fastAd->category_name); ?> (<?php echo e(($fastAd->sale_type) ? $fastAd->sale_type : $fastAd->post_type); ?>)</p>
                        </div>
                        <?php if($fastAd->ribbon): ?>
                        <img width="25" class="lazyload" src="<?php echo e(asset('upload/images/package/'.$fastAd->ribbon)); ?>">
                        <?php endif; ?>
                    </div>
                    
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="font-weight-bold bt py-1"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($fastAd->price)); ?></h4>
                        <p class="bt py-1 hidden-xs"><?php echo e(Carbon\Carbon::parse($fastAd->approved ? $fastAd->approved : $fastAd->created_at)->diffForHumans()); ?></p>
                    </div>
                </div><a class="position-absolute bottom-1 hidden-md" href="<?php echo e(route('user.message', [$fastAd->username, $fastAd->slug])); ?>" title="Message">
                <img width="20" height="20" src="<?php echo e(asset('upload/images/sendss.svg')); ?>" alt="sms">
            </a>
            </div>
            
            <div class=" hidden-xs">
                <div class="d-flex mt-n3 position-relative z-3">
                    <form action="<?php echo e(route('user.sendMessage')); ?>?send=direct" method="post" class="d-flex align-items-center bb2 rounded shadow mx-3">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="productOrConId" value="<?php echo e($fastAd->id); ?>">
                    <input type="text" name="message" id="message<?php echo e($fastAd->id); ?>" class="px-2 py-1 w-100 rounded" placeholder="Send message">
                    <button <?php if(Auth::check()): ?> onclick="sendMessage(<?php echo e($fastAd->id); ?>)" <?php else: ?> data-target="#so_sociallogin" data-toggle="modal" <?php endif; ?> type="button"><img height="23" src="<?php echo e(asset('upload/images/sendss.svg')); ?>"></button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php elseif($index > 12): ?>

        <?php $productIndex = ($index - 5); ?>

        <?php if($productIndex < count($products)): ?>
        <?php $product = $products[$productIndex]; ?>

        <div class="col-6 col-sm-6 w-100 position-relative p-1">
            <div class="w-100 bg-white position-relative rounded h-100">
                <div class="position-relative">
                  <a class="w-100" href="<?php echo e(route('post_details', $product->slug)); ?>">
                    <img class="lazyload w-100 mh-300" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/thumb/'.$product->feature_image)); ?>" alt="<?php echo e($product->title); ?>">
                </a>
                </div>
                <div class="ppb-5 overflow-hidden">
                    <a class="w-100" href="<?php echo e(route('post_details', $product->slug)); ?>">
                    <h4 class="font-weight-bold bt py-1 title" title="<?php echo e($product->title); ?>"><?php echo e($product->title); ?></h4>
                    </a>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                           <?php if($product->membership_ribbon): ?>
                            <div class="d-flex align-items-center">
                                <img class="lazyload mr-1" width="20" src="<?php echo e(asset('upload/images/membership/'.$product->membership_ribbon)); ?>">
                                <p class="bt"><?php echo e($product->membership_name); ?></p>
                            </div><?php endif; ?>
                            <p class="bt"><?php echo e($product->get_state->name ?? ''); ?></p>
                            <p class="bt hidden-xs"><?php echo e($product->category_name ?? ''); ?> (<?php echo e(($product->sale_type) ? $product->sale_type : $product->post_type); ?>)</p>
                            
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="font-weight-bold bt py-1"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($product->price)); ?></h4>
                        <p class="bt py-1 hidden-xs"><?php echo e(Carbon\Carbon::parse($product->approved ? $product->approved : $product->created_at)->diffForHumans()); ?></p>
                        
                    </div>
                </div>
                <a class="position-absolute bottom-1 hidden-md" href="<?php echo e(route('user.message', [$product->username, $product->slug])); ?>" title="Message">
                <img width="20" height="20" src="<?php echo e(asset('upload/images/sendss.svg')); ?>" alt="sms">
            </a>
            </div>
            
            <div class=" hidden-xs">
                <div class="d-flex mt-n3 position-relative z-3">
                    <form action="<?php echo e(route('user.sendMessage')); ?>?send=direct" method="post" class="d-flex align-items-center bb2 rounded shadow mx-3">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="productOrConId" value="<?php echo e($product->id); ?>">
                    <input type="text" name="message" id="message<?php echo e($product->id); ?>" class="px-2 py-1 w-100 rounded" placeholder="Send message">
                    <button <?php if(Auth::check()): ?> onclick="sendMessage(<?php echo e($product->id); ?>)" <?php else: ?> data-target="#so_sociallogin" data-toggle="modal" <?php endif; ?> type="button"><img height="23" src="<?php echo e(asset('upload/images/sendss.svg')); ?>"></button>
                    </form>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if($index == 13 && count($products)>12): ?>
           <?php echo $__env->make("frontend.mobile-ads", ["position" => "mobile-ad", "class" => "col-6 col-sm-6 w-100  p-2"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>
   
<?php endfor; ?>
    <div class="col-lg-12">
        <div class="footer-pagection">
            <?php echo e($products->appends(request()->query())->links()); ?>

        </div>
    </div>
<?php else: ?>
    <div style="text-align: center;">
        <h3>Search Result Not Found.</h3>
        <p>We're sorry. We cannot find any matches for your search term</p>
        <i style="font-size: 10rem;" class="fa fa-search"></i>
    </div>
<?php endif; ?>
</div>
<?php /**PATH D:\BonikBazar\bonikbazar\resources\views/frontend/post-filter.blade.php ENDPATH**/ ?>