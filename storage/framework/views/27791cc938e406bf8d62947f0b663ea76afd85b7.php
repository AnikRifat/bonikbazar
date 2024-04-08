
<?php $__env->startSection('title', $post_detail->title.' | '.Config::get('siteSetting.title')); ?>
<?php $__env->startSection('metatag'); ?>
    <meta name="keywords" content="<?php echo e($post_detail->meta_keywords); ?>" />
    <meta name="title" content="<?php echo e(($post_detail->meta_title) ? $post_detail->meta_title : $post_detail->title); ?>" />
    <meta name="description" content="<?php echo strip_tags( ($post_detail->meta_description) ? $post_detail->meta_description : Str::limit($post_detail->description, 500)); ?>">
    <meta name="image" content="<?php echo e(asset('upload/images/product/'.$post_detail->feature_image)); ?>">
    <meta name="rating" content="5">
    <!-- Schema.org for Google -->
    <meta itemprop="name" content="<?php echo e(($post_detail->meta_title) ? $post_detail->meta_title : $post_detail->title); ?>">
    <meta itemprop="description" content="<?php echo strip_tags(($post_detail->meta_description) ? $post_detail->meta_description : Str::limit($post_detail->description, 500)); ?>">
    <meta itemprop="image" content="<?php echo e(asset('upload/images/product/'.$post_detail->feature_image)); ?>">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="<?php echo e(($post_detail->meta_title) ? $post_detail->meta_title : $post_detail->title); ?>">
    <meta name="twitter:description" content="<?php echo strip_tags(($post_detail->meta_description) ? $post_detail->meta_description : Str::limit($post_detail->description, 500)); ?>">
    <meta name="twitter:site" content="<?php echo e(url()->full()); ?>">
    <meta name="twitter:creator" content="@neyamul">
    <meta name="twitter:image:src" content="<?php echo e(asset('upload/images/product/'.$post_detail->feature_image)); ?>">
    <meta name="twitter:player" content="#">
    <!-- Twitter - Product (e-commerce) -->
    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta property="og:title" content="<?php echo e(($post_detail->meta_title) ? $post_detail->meta_title : $post_detail->title); ?>">
    <meta property="og:description" content="<?php echo strip_tags(($post_detail->meta_description) ? $post_detail->meta_description : Str::limit($post_detail->description, 500)); ?>">
    <meta property="og:image" content="<?php echo e(asset('upload/images/product/'.$post_detail->feature_image)); ?>">
    <meta property="og:url" content="<?php echo e(asset('upload/images/product/'.$post_detail->feature_image)); ?>">
    <meta property="og:site_name" content="<?php echo e(Config::get('siteSetting.site_name')); ?>">
    <meta property="og:locale" content="bd">
    <meta property="og:type" content="product">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<style>
.ad-thumb-slider .slick-slide {
    max-width: 100px;
    height: 100px;
    margin-right: 10px;
}
.dandik, .bamdik {color: #000000;}
.dandik:hover, .bamdik:hover {background: #000000;}
.mbox {
    border: 1px solid #000;
    border-radius: 5px;
    padding: 5px;
}
.boostads img {
    background: #000;
    padding: 5px;
    border-radius: 3px;
}
.c1 {color:#009877;}
.c2 {color:#FF0000;}
.c2 ol,
.c2 ul {
    list-style: disc!important;
    margin-left: 20px!important;
}
.d-grid {
    display: grid;
}
.slick-slide img {border-radius: 5px;}
.ts {text-shadow: 0px 5px 5px rgba(0,0,0,0.5);}
.hl-x {
    column-gap: 50px !important;
}
.htt {
    border-right: 2px solid #1e1e1e;
    height: 300px;
    position: absolute;
    left: 50%;
    overflow: hidden;
}

</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="breadcrumbs">
        <div class="container">
          <ul class="breadcrumb-cate">
            <li> <a href="/"><i class="fa fa-home"></i></a></li>
              <li><a href="<?php echo e(route('home.category', $post_detail->get_category->slug ?? '')); ?>"><?php echo e($post_detail->get_category->name ?? ''); ?></a></li>
              <?php if($post_detail->get_subcategory ?? false): ?>
              <li><a href="<?php echo e(route('home.category', [$post_detail->get_subcategory->slug])); ?>"><?php echo e($post_detail->get_subcategory->name); ?></a></li>
              <?php endif; ?>
              <?php if($post_detail->get_childcategory ?? false): ?>
              <!-- <li><a href="<?php echo e(route('home.category', [$post_detail->get_childcategory->slug])); ?>"><?php echo e($post_detail->get_childcategory->name); ?></a></li> -->
              <?php endif; ?>
              <li><?php echo e($post_detail->title); ?></li>
          </ul>
        </div>
    </div>
    <div>
        <div class="container  mb-3 p-0">
            <div class="hera-top">
            <?php echo $__env->make("frontend.ads", ["position" => "top"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div>
        </div>

        <div class="container bg-white py-2 px-0 mb-3 rounded">
            <div class="row">
                <div class="col-12 d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <div class="d-md-none">
                            <a href="javascript:history.back()" class="d-flex align-items-center">
                                <img width="20" height="20" class="mr-1" src="<?php echo e(asset('upload/images/arrow.png')); ?>" alt="share">
                                <h3>Ad Details :</h3>
                            </a>
                        </div>
                        <h3 class="bt w-100 hidden-xs"><?php echo e($post_detail->title); ?></h3>
                        <p class="bt mt-2 w-100 hidden-xs">
                            <?php if($post_detail->get_state): ?>
                                <?php echo e($post_detail->get_state->name); ?>

                            <?php endif; ?>
                            <?php if($post_detail->get_city): ?>,
                                <?php echo e($post_detail->get_city->name); ?>

                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="d-flex align-items-center">
                        <button type="button" id="shareBtn" data-toggle="modal" data-target="#ad-share" class="wish yb p-2 rounded borders mr-2 sh">
                            <img width="25" height="25" src="<?php echo e(asset('upload/images/share.svg')); ?>" alt="share">
                        </button>
                        <button type="button"  <?php if(Auth::check()): ?> onclick="addToWishlist(<?php echo e($post_detail->id); ?>)" data-toggle="tooltip" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" <?php endif; ?> class="yb p-2 rounded borders sh">
                             <img width="25" height="25" src="<?php echo e(asset('upload/images/heart.svg')); ?>" alt="heart">
                        </button>
                    </div>
                </div>
                
                <div class="col-lg-8 col-md-8 col-sm-12 pr-md-0">
                    <div class="p-2" >
                        <div class="ad-details-slider-group">
                            <div class="ad-details-slider slider-arrow shadow-bb mb-3">
                                <div><img src="<?php echo e(asset('upload/images/product/'. $post_detail->feature_image)); ?>" alt="details"></div>
                                <?php $__currentLoopData = $post_detail->get_galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div><img  src="<?php echo e(asset('upload/images/product/gallery/'. $image->image_path)); ?>" alt="details"></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            
                        </div>
                        <div class="ad-thumb-slider">
                            <div><img width="100" height="100" src="<?php echo e(asset('upload/images/product/thumb/'. $post_detail->feature_image)); ?>" alt="details"></div>
                            <?php $__currentLoopData = $post_detail->get_galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div><img width="100" height="100" src="<?php echo e(asset('upload/images/product/gallery/'. $image->image_path)); ?>" alt="details"></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="hidden-xs">
                            <p class="bt mt-3">
                                Published On <span class="pt"><?php echo e(Carbon\Carbon::parse(($post_detail->approved) ? $post_detail->approved : $post_detail->created_at)->format(Config::get('siteSetting.date_format'))); ?>

                                , <?php echo e(\Carbon\Carbon::parse(($post_detail->approved) ? $post_detail->approved : $post_detail->created_at)->format('h:i A')); ?></span>
                            </p>
                            <div class="d-flex align-items-end my-2">
                                <h3 class="pt ts mr-1"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($post_detail->price)); ?></h3>
                                <?php if($post_detail->negotiable == 1): ?>
                                <h3 class="ts">(Negotiable)</h3>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="d-md-none">
                            <h3 class="bt w-100"><?php echo e($post_detail->title); ?></h3>
                            <div class="row px-0">
                                <div class="col-12 pl-0">
                                    <p class="bt mt-3 w-100">
                                        Published On <span class="pt"><?php echo e(Carbon\Carbon::parse(($post_detail->approved) ? $post_detail->approved : $post_detail->created_at)->format(Config::get('siteSetting.date_format'))); ?>

                                        , <?php echo e(\Carbon\Carbon::parse(($post_detail->approved) ? $post_detail->approved : $post_detail->created_at)->format('h:i A')); ?></span>
                                    </p>
                                    <p class="bt w-100">
                                        <?php if($post_detail->get_state): ?>
                                            <?php echo e($post_detail->get_state->name); ?>

                                        <?php endif; ?>
                                        <?php if($post_detail->get_city): ?>,
                                            <?php echo e($post_detail->get_city->name); ?>

                                        <?php endif; ?>
                                    </p>
                                    <div class="d-flex align-items-end">
                                        <h3 class="pt ts mr-1"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($post_detail->price)); ?></h3>
                                        <?php if($post_detail->negotiable == 1): ?>
                                        <h3 class="ts">(Negotiable)</h3>
                                        <?php endif; ?>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <h5>For Sale By</h5>
                                        <a class="pt ml-1" href="<?php echo e(route('userProfile', $post_detail->author->username)); ?>"><h5><?php echo e($post_detail->author->name); ?></h5></a>
                                        
                                    </div>
                                    <?php if($post_detail->author && $post_detail->author->membership): ?>
                                    <div class="d-flex align-items-center">
                                        <img class="lazyload" width="25" src="<?php echo e(asset('upload/images/membership/'.$post_detail->author->getMembership->ribbon)); ?>">
                                        <p class="bt"><?php echo e($post_detail->author->getMembership->name); ?></p>
                                    </div> 
                                    <?php endif; ?>
                                    <p>Member Since <?php echo e(Carbon\Carbon::parse($post_detail->author->created_at)->format(Config::get('siteSetting.date_format'))); ?></p>
                                </div>
                                <div class="col-12">
                                     <?php if(Auth::check()): ?>
                                    <div class="d-flex align-items-center justify-content-center my-2">
                                        <button type="button" class="boostads d-flex align-items-center mr-2" data-toggle="modal" data-target="#number">
                                            
                                            <?php if($post_detail->contact_hidden == 1): ?>
                                                <img width="30" height="30" src="<?php echo e(asset('upload/images/phn.svg')); ?>" alt="banner">
                                                <p class="yt e6 py-0 px-2 borders rounded-3">+880*****</p>
                                            <?php else: ?>
                                                <?php if($post_detail->contact_mobile): ?>
                                                    <?php $__currentLoopData = json_decode($post_detail->contact_mobile); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $number): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <img width="30" height="30" src="<?php echo e(asset('upload/images/phn.svg')); ?>" alt="banner">
                                                    <a class="yt e6 py-0 px-2 borders rounded-3" href="tel:<?php echo e($number); ?>">+88 <?php echo e($number); ?></a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </button>
                                        
                                        <a class="boostads d-flex align-items-center" href="<?php echo e(route('user.message', [$post_detail->author->username, $post_detail->slug])); ?>" title="Message">
                                            <img width="30" height="30" src="<?php echo e(asset('upload/images/cht.svg')); ?>" alt="sms">
                                            <h4 class="yt e6 py-0 px-2 borders rounded-3">Chat</h4>
                                        </a>
                                    </div>
                                    <?php else: ?>
                                    <div class="d-flex align-items-center justify-content-center my-2">
                                        <button type="button" class="boostads d-flex align-items-center mr-2" data-toggle="modal" data-target="#so_sociallogin">
                                            <?php if($post_detail->contact_mobile): ?>
                                                <img width="30" height="30" src="<?php echo e(asset('upload/images/phn.svg')); ?>" alt="banner">
                                                <p class="yt e6 py-0 px-2 borders rounded-3">+880*****</p>
                                            <?php endif; ?>
                                        </button>
                                        
                                        <a class="boostads d-flex align-items-center" href="<?php echo e(route('user.message', [$post_detail->author->username, $post_detail->slug])); ?>" title="Message">
                                            <img width="30" height="30" src="<?php echo e(asset('upload/images/cht.svg')); ?>" alt="sms">
                                            <h4 class="yt e6 py-0 px-2 borders rounded-3">Chat</h4>
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="hl-2 hl-x position-relative overflow-hidden">
                            <div class="htt"></div>
                            <?php if($post_detail->get_brand): ?>
                            <div class="d-flex align-items-start justify-content-between">
                                <p>Brand:</p>
                                <b><?php echo e($post_detail->get_brand->name); ?></b>
                            </div>

                            <div class="d-flex align-items-start justify-content-between">
                                <p>Model:</p>
                                <b><?php echo e($post_detail->get_model->name); ?></b>
                            </div>
                            <?php endif; ?>
                            <?php if(count($post_detail->get_features)>0): ?>
                            <?php $__currentLoopData = $post_detail->get_features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($feature->value): ?>
                            <div class="d-flex align-items-start justify-content-between">
                                <p><?php echo e($feature->name); ?>: </p> 
                                <b><?php echo e($feature->value); ?></b>
                            </div>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                            <?php if(count($post_detail->get_variations)>0): ?>
                            <?php $__currentLoopData = $post_detail->get_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex align-items-start justify-content-between">
                                <p><?php echo e($variation->attribute_name); ?>: </p> 
                                <?php $__currentLoopData = $variation->get_variationDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variationDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php if($variationDetail->get_attributeValue): ?>
                                <b><?php echo e($variationDetail->get_attributeValue->name); ?></b>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                        
                        <div class="description my-2 border-bottom border-top pb-2 pt-2 text-break">
                            <h2>More Description</h2>
                            <article><?php echo $post_detail->description; ?></article>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <a class="boostads d-flex align-items-center justify-content-center" href="<?php echo e(route('ads.promotePackage', [$post_detail->slug])); ?>" title="Message">
                                <img width="30" height="30" src="<?php echo e(asset('upload/images/boost-icon.png')); ?>" alt="sms">
                                <h4 class="yt yb py-0 px-2 borders rounded-3">Boost This AD</h4>
                            </a>
                            <button class="float-right py-1 px-4 e6 text-red bb2 rounded shadow-bb font-weight-bold" type="button" <?php if(Auth::check()): ?> onclick="report(<?php echo e($post_detail->id); ?>)" data-toggle="tooltip" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" <?php endif; ?>>Report</button>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="mbox d-grid shadow-bb">
                        <div class="hidden-xs">
                            <div class="d-flex my-2">
                                <a href="<?php echo e(route('userProfile', $post_detail->author->username)); ?>" class="mr-3">
                                    <img class="rounded" width="70" height="70" src="<?php echo e(asset('upload/users')); ?>/<?php echo e(($post_detail->author->photo) ? $post_detail->author->photo : 'default.png'); ?>" alt="<?php echo e($post_detail->author->name); ?>">
                                </a>
                                <div class="mt-4">  
                                    <h4><?php echo e($post_detail->author->name); ?></h4>
                                    <?php if($post_detail->author && $post_detail->author->membership): ?>
                                    <div class="d-flex align-items-center">
                                        <img class="lazyload" width="25" src="<?php echo e(asset('upload/images/membership/'.$post_detail->author->getMembership->ribbon)); ?>">
                                        <p class="bt"><?php echo e($post_detail->author->getMembership->name); ?></p>
                                    </div> 
                                    <?php endif; ?>
                                    <h5>joined: <?php echo e(Carbon\Carbon::parse($post_detail->author->created_at)->format(Config::get('siteSetting.date_format'))); ?></h5>
                                    <a class="c1" href="<?php echo e(route('userProfile', $post_detail->author->username)); ?>">Visit Member Shop</a>
                                </div>
                            </div>
                             
                            <a class="boostads d-flex align-items-center justify-content-center my-2" href="<?php echo e(route('ads.promotePackage', [$post_detail->slug])); ?>" title="Message">
                                <img width="30" height="30" src="<?php echo e(asset('upload/images/boost-icon.png')); ?>" alt="sms">
                                <h4 class="yt yb py-0 px-2 borders rounded-3">Boost This AD</h4>
                            </a>
                             <?php if(Auth::check()): ?>
                            <div class="d-flex align-items-center justify-content-center my-2">
                                <button type="button" class="boostads d-flex align-items-center mr-2" data-toggle="modal" data-target="#number">
                                    
                                    <?php if($post_detail->contact_hidden == 1): ?>
                                        <img width="30" height="30" src="<?php echo e(asset('upload/images/phn.svg')); ?>" alt="banner">
                                        <p class="yt e6 py-0 px-2 borders rounded-3">+880*****</p>
                                    <?php else: ?>
                                        <?php if($post_detail->contact_mobile): ?>
                                            <?php $__currentLoopData = json_decode($post_detail->contact_mobile); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $number): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <img width="30" height="30" src="<?php echo e(asset('upload/images/phn.svg')); ?>" alt="banner">
                                            <a class="yt e6 py-0 px-2 borders rounded-3" href="tel:<?php echo e($number); ?>">+88 <?php echo e($number); ?></a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </button>
                                
                                <a class="boostads d-flex align-items-center" href="<?php echo e(route('user.message', [$post_detail->author->username, $post_detail->slug])); ?>" title="Message">
                                    <img width="30" height="30" src="<?php echo e(asset('upload/images/cht.svg')); ?>" alt="sms">
                                    <h4 class="yt e6 py-0 px-2 borders rounded-3">Chat</h4>
                                </a>
                            </div>
                            <?php else: ?>
                            <div class="d-flex align-items-center justify-content-center my-2">
                                <button type="button" class="boostads d-flex align-items-center mr-2" data-toggle="modal" data-target="#so_sociallogin">
                                    <?php if($post_detail->contact_mobile): ?>
                                        <img width="30" height="30" src="<?php echo e(asset('upload/images/phn.svg')); ?>" alt="banner">
                                        <p class="yt e6 py-0 px-2 borders rounded-3">+880*****</p>
                                    <?php endif; ?>
                                </button>
                                
                                <a class="boostads d-flex align-items-center" href="<?php echo e(route('user.message', [$post_detail->author->username, $post_detail->slug])); ?>" title="Message">
                                    <img width="30" height="30" src="<?php echo e(asset('upload/images/cht.svg')); ?>" alt="sms">
                                    <h4 class="yt e6 py-0 px-2 borders rounded-3">Chat</h4>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php
    
                        $safety_tip = App\Models\SiteSetting::where('type', 'safety_tip')->first();
                        ?>
                        <?php if($safety_tip->status == 1): ?>
                        <!-- SAFETY CARD -->
                        <div class="mbox her p-2 mt-3 mb-2">
                            <h5 class="mbox d-inline-block shadow-bb mb-2 c1 e6">Be Safe</h5>
                            <div class="c2" style="max-height: 125px;overflow: hidden;">
                                <?php echo ($post_detail->get_category->safety_tip) ? $post_detail->get_category->safety_tip : $safety_tip->value; ?>

                            </div>
                            <a href="#" class="c1 d-flex justify-content-center">See all safety tips></a>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div>
                        <?php echo $__env->make("frontend.ads", ["adType" => "linkAd", "position" => "leftSide"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php if(count($related_products)>0): ?>
    <div class="container bg-white mb-3 py-4 px-0 rounded">
        <?php if($post_detail->author && $post_detail->author->membership): ?>
        <div style="display: flex;justify-content: space-between; margin: 0 15px;align-items: center;">
            <div class="d-flex">
                <a href="<?php echo e(route('userProfile', $post_detail->author->username)); ?>" class="mr-3">
                    <img class="rounded" width="70" height="70" src="<?php echo e(asset('upload/users')); ?>/<?php echo e(($post_detail->author->photo) ? $post_detail->author->photo : 'default.png'); ?>" alt="<?php echo e($post_detail->author->name); ?>">
                </a>
                <div class="mt-4">
                    <h4><?php echo e($post_detail->author->name); ?></h4>
                    <?php if($post_detail->author && $post_detail->author->membership): ?>
                    <div class="d-flex align-items-center">
                        <img class="lazyload" width="25" src="<?php echo e(asset('upload/images/membership/'.$post_detail->author->getMembership->ribbon)); ?>">
                        <p class="bt"><?php echo e($post_detail->author->getMembership->name); ?></p>
                    </div> 
                    <?php endif; ?>
                    <a class="c1" href="<?php echo e(route('userProfile', $post_detail->author->username)); ?>">Visit Member Shop</a>
                    <h4>More Ads From</h4>
                </div>
            </div>
            <div>
            <a
            <?php if(Auth::check()): ?>
                onclick="follower(<?php echo e($post_detail->user_id); ?>)"
            <?php else: ?>
                data-toggle="modal" data-target="#so_sociallogin"
            <?php endif; ?>
            class="btn user-f" id="follower" href="javascript:void(0)">
                <?php if(Auth::check() && App\Models\FavoriteSeller::where('user_id', Auth::id())->where('follower_id', $post_detail->user_id)->first()): ?>
                <div class="followy">Unfollow</div>
                <?php else: ?>
                <div class="follow">Follow</div>
                <?php endif; ?>
            </a>
            </div>
        </div>
        <?php else: ?>
        <h3 class="mb-4 d-flex align-items-center justify-content-center">Related This <p class="pt font-weight-normal pl-2">Ads</p></h3>
        <?php endif; ?>
        <hr style="margin: 1em auto;width: 70%;border: 1px solid #000;">
        <div class="row px-md-5">
            
        <?php $__currentLoopData = $related_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $related_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-md-4 w-100 bg-white h-100 p-1 mb-2 position-relative">
                <div class="w-100 bg-white shadow-bb rounded position-relative p-2 h-100">
                    <div class="position-relative">
                        <a href="<?php echo e(route('post_details', $related_product->slug)); ?>">
                        <img class="lazyload w-100 mh-300" src="<?php echo e(asset('upload/images/product/thumb/default.jpg')); ?>" data-src="<?php echo e(asset('upload/images/product/thumb/'. $related_product->feature_image)); ?>" alt="<?php echo e($related_product->title); ?>">
                        </a>
                    </div>
                    <div class="ppb-5 overflow-hidden">
                        <a href="<?php echo e(route('post_details', $related_product->slug)); ?>">
                            <h4 class="font-weight-bold bt py-1 title" title="<?php echo e($related_product->title); ?>"><?php echo e($related_product->title); ?></h4>
                        </a>
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <?php if($related_product->membership_ribbon): ?>
                                <div class="d-flex align-items-center">
                                    <img class="lazyload" width="20" src="<?php echo e(asset('upload/images/membership/'.$related_product->membership_ribbon)); ?>">
                                    <p class="bt"><?php echo e($related_product->membership_name); ?></p>
                                </div>
                                <?php endif; ?>
                                <p class="bt"><?php echo e($related_product->get_state->name ?? ''); ?></p>
                                <p class="bt hidden-xs"><?php echo e($related_product->get_subcategory->name ?? ''); ?> (<?php echo e(($related_product->sale_type) ? $related_product->sale_type : $related_product->post_type); ?>)</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold bt py-1"><?php echo e(Config::get('siteSetting.currency_symble') .' '. number_format($related_product->price)); ?></h4>
                            <p class="bt py-1  hidden-xs"><?php echo e(Carbon\Carbon::parse($related_product->created_at)->diffForHumans()); ?></p>
                        </div>
                    </div>
                    <a class="position-absolute bottom-1 hidden-md" href="<?php echo e(route('user.message', [ $related_product->slug])); ?>" title="Message">
                        <img width="20" height="20" src="<?php echo e(asset('upload/images/sendss.svg')); ?>" alt="sms">
                    </a>
                </div>
                
                <div class="hidden-xs">
                    <div class="d-flex mt-n3 position-relative z-3">
                        <div class="d-flex align-items-center bb2 rounded shadow mx-3 bg-white">
                            <input type="text" name="message" id="message<?php echo e($related_product->id); ?>" class="px-2 py-1 w-100 rounded" placeholder="Send message">
                            <button <?php if(Auth::check()): ?> onclick="sendMessage(<?php echo e($related_product->id); ?>)" <?php else: ?> data-target="#so_sociallogin" data-toggle="modal" <?php endif; ?>>
                                <img height="23" src="<?php echo e(asset('upload/images/sendss.svg')); ?>">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php if($index == 1): ?>
            <div class="col-6 col-md-4">
            <?php echo $__env->make("frontend.ads", ["position" => "mobile-ad", "class" => "w-100 p-0 mb-2 position-relative"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <?php endif; ?>
            
            
            <?php if($index == 3): ?>
            <div class="col-6 col-md-4">
            <?php echo $__env->make("frontend.ads", ["position" => "mobile-ad", "class" => "w-100 p-0 mb-2 position-relative"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <?php endif; ?>
            
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="container p-0" style="margin-bottom: 97px;">
        <?php echo $__env->make("frontend.ads", ["position" => "bottom"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    
    <?php if($post_detail->contact_hidden == 1): ?>
    <div class="modal fade" id="number">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Contact this Number</h4>
                    <button class="fa fa-times" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h3 class="modal-number"><?php if($post_detail->contact_mobile): ?> <?php $__currentLoopData = json_decode($post_detail->contact_mobile); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $number): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <p><a href="tel:<?php echo e($number); ?>"><?php echo e($number); ?></a></p> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  <?php endif; ?></h3>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="modal fade" id="reportModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Product report</h4>
                    <button class="fa fa-times" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('sellerReport')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="product_id" value="<?php echo e($post_detail->id); ?>">
                        <div id="reportForm"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
    <div class="modal fade" id="ad-share">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Share Product</h4>
                    <button class="fa fa-times" data-dismiss="modal"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-around">
                    <a href="https://www.facebook.com/sharer.php?u=<?php echo e(route('post_details', $post_detail->slug)); ?>">
                        <i class="fab fa-facebook-f bt yb p-3 rounded-circle"></i>
                    </a>
                    <a href="https://twitter.com/share?url=<?php echo e(route('post_details', $post_detail->slug)); ?>&amp;text=<?php echo $post_detail->title; ?>&amp;hashtags=blog">
                        <i class="fab fa-twitter bt yb p-3 rounded-circle"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo e(route('post_details', $post_detail->slug)); ?>?rs=<?php echo e($post_detail->id); ?>">
                        <i class="fab fa-linkedin-in bt yb p-3 rounded-circle"></i>
                    </a>
                    <a href="https://web.whatsapp.com/send?text=<?php echo e(route('post_details', $post_detail->slug)); ?>&amp;title=<?php echo $post_detail->title; ?>">
                        <i class="fab fa-whatsapp bt yb p-3 rounded-circle"></i>
                    </a>
                    <a href="https://pinterest.com/pin/create/button/?url=<?php echo e(route('post_details', $post_detail->slug)); ?>?rs=<?php echo e($post_detail->id); ?>">
                        <i class="fab fa-pinterest-p bt yb p-3 rounded-circle"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('js/readmore.js')); ?>"></script>
<script>
    <?php if(Auth::check()): ?>
    function follower(follower_id){
        $.ajax({
            method:'get',
            url:'<?php echo e(route("follower")); ?>',
            data:{
                follower_id:follower_id,
            },
            success:function(data){
                if(data.status){
                    toastr.success(data.msg);
                }
            }
        });
    }

    function report(id){
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
                }
            }
        });
    }
    <?php endif; ?>
    $('article').readmore({speed: 500});


    function sendMessage(product_id){
    
        var message = $('#message'+product_id).val();
        if(message == ''){
            toastr.error('Message field required.');
            return false;
        }
        $.ajax({
        url:'<?php echo e(route("user.sendMessage")); ?>',
        type:'post',
        data:{productOrConId:product_id,message:message,'_token':'<?php echo e(csrf_token()); ?>'},
        success:function(data){
            if(data){
                $('#message'+product_id).val('');
                toastr.success('Message send success.');
            }else{
                toastr.error('Message send failad.');
            }
          }
      });
    }


    $(document).on("click", "#shareBtn", function(){
        var ad_id = "<?php echo e($post_detail->id); ?>"
        $.ajax({
            method:'get',
            url:'<?php echo e(route("shareAd")); ?>',
            data:{ ad_id:ad_id }
        });
    });
</script>   
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\bonik_bazar_latest\bonikbazar\resources\views/frontend/ads-details.blade.php ENDPATH**/ ?>