
<?php $__env->startSection('title', ($category) ? $category->name : 'All ads' . ' | '. Config::get('siteSetting.site_name') ); ?>
<?php $__env->startSection('css'); ?>
    <style type="text/css">
        .page-info{font-size: 14px;}
        .filterBtn{text-align: left; border: none; padding: 0px 3px; font-weight: 600;font-size: 14px;}
        .filter{position: fixed;top: 0;background: #fff;z-index: 999;padding: 10px; display: none; overflow-y: scroll;height: 100%;}
        .product-widget-dropitem{padding-left: 5px;}
        .product-meta span{color: var(--gray);font-size: 12px}
        .product-meta {display: flex; flex-direction: column;}
        .product-info{padding: 0;border: none;}
        .page-item.active .page-link{background:#EB5206;}
        @media (max-width: 575px) {
            #verify-seller .product-img{width: 135px;}
          .featurePromotePost{padding: 0;}
          #filter_product{min-height:150px}
        }
      .advertising img{width: 100%}
      .close-filter{padding-right: 10px}
      .mt-2 .bg-white{padding: 0.5rem!important}
      #categories a, #location a{display:flex;gap: 5px;color: #000;margin-bottom: 5px;line-height: 15px; margin-left: 10px;font-size: 14px;}
      #categories img{width: 30px;height: 28px;}
      #categories p, #location p{font-size: 12px;color: #857e7e}
      .product-widget-dropdown .active, .parentItem{ font-weight: 600;}
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 
    <?php
        
        if($category){
            if($category->parent_id && $category->subcategory_id){ $maincategory = $category->get_category->get_category->name; $maincategory_slug = $category->get_category->get_category->slug; }  
            elseif($category->parent_id){$maincategory = $category->get_category->name; $maincategory_slug = $category->get_category->slug;} else{ $maincategory =  $category->name ; $maincategory_slug =  $category->slug ; }


            if($category->parent_id && $category->subcategory_id){ $subcategory = $category->get_category->name; $subcategory_slug = $category->get_category->slug; } 
            elseif($category->parent_id){$subcategory = $category->name; $subcategory_slug = $category->slug; } else{ $subcategory = null; }

            $childcategory = ($category->parent_id && $category->subcategory_id ? $category->name : null);

            $category_name = ($subcategory) ? $subcategory : $maincategory;
        }
    ?>
  
    <div class="container px-0">
        <div class="hera-top">
        <?php echo $__env->make("frontend.ads", ["adType" => "linkAd", "position" => "top"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="row">
            <div style="padding-left: 5px; padding-right: 5px; margin-top: 0.5rem!important;" class="col-md-3 <?php if(!(new \Jenssegers\Agent\Agent())->isDesktop()): ?> filter <?php endif; ?>">
                <?php if(!(new \Jenssegers\Agent\Agent())->isDesktop()): ?>
                <div style="display:flex;align-items: flex-end;justify-content: space-between; margin: 0;">
                    <p>Filters</p>
                    <span class="close-filter" >✕</span>
                </div>
                <?php endif; ?>
                <div>
                    <div class="accordion w-100" id="accordion">
                        <div class="bg-white mb-3 shadow-b">
                            <div class="bb p-2 shadow-bb" role="tab" id="headingOne">
                                <div class="w-100 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseOne">
                                    <div class="d-flex align-items-center">
                                        <img class="mr-1" width="15" src="<?php echo e(asset('upload/images/group.png')); ?>" alt="group">
                                        <h4 class="yt">Filter by</h4>
                                    </div>
                                    <img width="15" class="rotate-90" src="<?php echo e(asset('upload/images/vector.png')); ?>" alt="vector">
                                </div>
                            </div>
                    
                            <div id="collapseOne" class="collapse show p-2" role="tabpanel" aria-labelledby="headingOne">
                                
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="ad" value="premium" <?php if(in_array("premium", explode(',', Request::get('ad')))): ?> checked <?php endif; ?> class="common_selector package" id="premium">
                                    <label class="iy" for="premium">Premium Ad</label>
                                </div>

                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="member" value="member" <?php if(in_array("member", explode(',', Request::get('member')))): ?> checked <?php endif; ?> class="common_selector member" id="member">
                                    <label class="iy" for="member">Member Bonik</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="member" value="verified" <?php if(in_array("verified", explode(',', Request::get('member')))): ?> checked <?php endif; ?> class="common_selector member" id="verified">
                                    <label class="iy" for="verified">Verified Bonik</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="member" value="dealer" <?php if(in_array("dealer", explode(',', Request::get('member')))): ?> checked <?php endif; ?> class="common_selector member" id="dealer">
                                    <label class="iy" for="dealer">Dealers Bonik</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="agent" value="agent" <?php if(in_array("agent", explode(',', Request::get('member')))): ?> checked <?php endif; ?> class="common_selector member" id="agent">
                                    <label class="iy" for="agent">Agent Bonik</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="member" value="wholesale" <?php if(in_array("wholesale", explode(',', Request::get('member')))): ?> checked <?php endif; ?> class="common_selector member" id="wholesale">
                                    <label class="iy" for="wholesale">Wholesale Bonik</label>
                                </div>
                            </div>
                        </div>

                       
                        <div class="bg-white mb-3 shadow-b">
                            <div class="bb p-2 shadow-bb" role="tab" id="headingOne">
                                <div class="w-100 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#categories">
                                    <div class="d-flex align-items-center">
                                        <img class="mr-1" width="15" src="<?php echo e(asset('upload/images/group.png')); ?>" alt="group">
                                        <h4 class="yt">Categories</h4>
                                    </div>
                                    <img width="15" class="rotate-90" src="<?php echo e(asset('upload/images/vector.png')); ?>" alt="vector">
                                </div>
                            </div>
                    
                            <div id="categories" class="collapse show p-2" role="tabpanel" aria-labelledby="headingOne">
                                <ul class="product-widget-list">
                                    <?php $__currentLoopData = $get_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $show_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($category && Request::route('catslug')): ?>
                                        <?php if($category->parent_id == $show_category->id || $category->id == $show_category->id): ?>
                                        <li class="parentItem"><a href="<?php echo e(Request::route('location') ? route('home.category', [ Request::route('location'), $show_category->slug]) : route('home.category', ['all', $show_category->slug])); ?><?php echo e((request()->getQueryString()) ? '?'. request()->getQueryString() : null); ?>"><img alt="" src="<?php echo e(asset('upload/images/category/thumb/'.$show_category->image)); ?>"><span><?php echo e($show_category->name); ?> <p><?php echo e($show_category->products_by_category_count); ?> Ads</p></span> </a></li>

                                            <?php if(Request::route('catslug')): ?>
                                            <ul class="product-widget-dropdown" style="display: block;">
                                                <?php $__currentLoopData = $show_category->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filterCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li <?php if($category->id == $filterCategory->id): ?> class="active" <?php endif; ?>><a href="<?php echo e(Request::route('location') ? route('home.category', [ Request::route('location'), $filterCategory->slug]) : route('home.category', ['all', $filterCategory->slug])); ?><?php echo e((request()->getQueryString()) ? '?'. request()->getQueryString() : null); ?>"><span> <?php echo e($filterCategory->name); ?> <p><?php echo e($filterCategory->products_by_subcategory_count); ?> Ads</p></span> </a></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                    <?php else: ?>
                                    <li><a href="<?php echo e(Request::route('location') ? route('home.category', [ Request::route('location'), $show_category->slug]) : route('home.category', ['all', $show_category->slug])); ?><?php echo e((request()->getQueryString()) ? '?'. request()->getQueryString() : null); ?>"><img alt="" src="<?php echo e(asset('upload/images/category/thumb/'.$show_category->image)); ?>"><span><?php echo e($show_category->name); ?> <p><?php echo e($show_category->products_by_category_count); ?> Ads</p></span> </a></li>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                </ul>
                            </div>
                        </div>
                        
                        <div class="bg-white mb-3 shadow-b">
                            <div class="bb p-2 shadow-bb" role="tab" id="headingOne">
                                <div class="w-100 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#location">
                                    <div class="d-flex align-items-center">
                                        <img class="mr-1" width="15" src="<?php echo e(asset('upload/images/group.png')); ?>" alt="group">
                                        <h4 class="yt">Location</h4>
                                    </div>
                                    <img width="15" class="rotate-90" src="<?php echo e(asset('upload/images/vector.png')); ?>" alt="vector">
                                </div>
                            </div>
                    
                            <div id="location" class="collapse show p-2" role="tabpanel" aria-labelledby="headingOne">
                                <ul class="product-widget-list">
                                        
                                    <li><a href="<?php echo e(Request::route('location') ? route('home.category', [Request::route('catslug')]) : route('home.category')); ?>"> All Location</a></li>
                                  
                                    <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $show_state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php if($state): ?>
                                        <?php if(($state->state_id == $show_state->id) || ($state->id == $show_state->id && $state->state_id == null)): ?>
                                        <li class="parentItem"><a href="<?php echo e(Request::route('catslug') ? route('home.category', [$show_state->slug, Request::route('catslug')]) : route('home.category', $show_state->slug)); ?><?php echo e((request()->getQueryString()) ? '?'. request()->getQueryString() : null); ?>"><span> <?php echo e($show_state->name); ?><p><?php echo e($show_state->products_by_state_count); ?> Ads</p></span> </a></li>

                                            <?php if($show_state->get_city && Request::route('location') && Request::route('location') != "all"): ?>
                                            <ul class="product-widget-dropdown" style="display: block;">
                                                <?php $__currentLoopData = $show_state->get_city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li <?php if($state->id == $city->id && $state->state_id != null): ?> class="active" <?php endif; ?> ><a href="<?php echo e(Request::route('location') ? route('home.category', [$city->slug, Request::route('catslug')]) : route('home.category', $city->slug)); ?><?php echo e((request()->getQueryString()) ? '?'. request()->getQueryString() : null); ?>"><span> <?php echo e($city->name); ?><p><?php echo e($city->products_by_city_count); ?> Ads</p></span> </a></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                    <?php else: ?>

                                    <li><a href="<?php echo e(Request::route('catslug') ? route('home.category', [$show_state->slug, Request::route('catslug')]) : route('home.category', $show_state->slug)); ?><?php echo e((request()->getQueryString()) ? '?'. request()->getQueryString() : null); ?>"><span> <?php echo e($show_state->name); ?><p><?php echo e($show_state->products_by_state_count); ?> Ads</p></span> </a></li>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                </ul>
                            </div>
                        </div>

                        <?php if(count($brands)>0): ?>
                        <div class="bg-white mb-3 shadow-b">
                            <div class="bb p-2 shadow-bb" role="tab" id="headingOne">
                                <div class="w-100 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseOne">
                                    <div class="d-flex align-items-center">
                                        <img class="mr-1" width="15" src="<?php echo e(asset('upload/images/group.png')); ?>" alt="group">
                                        <h4 class="yt">Brand</h4>
                                    </div>
                                    <img width="15" class="rotate-90" src="<?php echo e(asset('upload/images/vector.png')); ?>" alt="vector">
                                </div>
                            </div>
                    
                            <div id="collapseOne" class="collapse show p-2" role="tabpanel" aria-labelledby="headingOne">
                                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="d-flex align-items-center">
                                    <input <?php if(in_array($brand->slug , explode(',', Request::get('brand')))): ?> checked <?php endif; ?> class="common_selector brand" value="<?php echo e($brand->slug); ?>" id="brand<?php echo e($brand->id); ?>" type="checkbox">
                                    <label class="iy" for="brand<?php echo e($brand->id); ?>">Urgent</label>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php $__currentLoopData = $product_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!-- check weather value set or not -->
                        <?php if(count($product_variation->get_attrValues)>0): ?>
                        <div class="bg-white mb-3 shadow-b">
                            <div class="bb p-2 shadow-bb" role="tab" id="heading3">
                                <div class="w-100 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapse3">
                                    <div class="d-flex align-items-center">
                                        <img class="mr-1" width="15" src="<?php echo e(asset('upload/images/group.png')); ?>" alt="group">
                                        <h4 class="yt"><?php echo e($product_variation->name); ?></h4>
                                    </div>
                                    <img width="15" class="rotate-90" src="<?php echo e(asset('upload/images/vector.png')); ?>" alt="vector">
                                </div>
                            </div>
                    
                            <div id="collapse3" class="collapse show p-2" role="tabpanel" aria-labelledby="heading3">
                                <?php $__currentLoopData = $product_variation->get_attrValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variationValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="d-flex align-items-center">
                                    <input  <?php if(in_array(strtolower($variationValue->name) , explode(',', Request::get(strtolower($product_variation->name)))) ): ?> checked <?php endif; ?> value="<?php echo e(strtolower($variationValue->name)); ?>" class=" <?php echo e(str_replace(' ', '', $product_variation->name)); ?> common_selector" id="attr<?php echo e($variationValue->id); ?>" type="checkbox">
                                    <label class="iy" for="attr<?php echo e($variationValue->id); ?>"><?php echo e($variationValue->name); ?></label>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="bg-white mb-3 shadow-b">
                    <div class="bb p-2 shadow-bb" role="tab" id="headingOne">
                        <div class="w-100 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#price">
                            <div class="d-flex align-items-center">
                                <img class="mr-1" width="15" src="<?php echo e(asset('upload/images/group.png')); ?>" alt="group">
                                <h4 class="yt">Price</h4>
                            </div>
                            <img width="15" class="rotate-90" src="<?php echo e(asset('upload/images/vector.png')); ?>" alt="vector">
                        </div>
                    </div>
            
                    <div id="price" class="collapse show p-2" role="tabpanel" aria-labelledby="headingOne">
                        <form class="product-widget-form">
                            <div class="product-widget-group">
                                <input type="text" value="<?php echo e(Request::get('price_min')); ?>" id="price_min" class="price-range" placeholder="min - 00">
                                <input type="text" value="<?php echo e(Request::get('price_max')); ?>" id="price_max" placeholder="max - 1B">
                            </div>
                            <button type="button" class="product-widget-btn common_selector">
                                <i class="fa fa-search"></i>
                                <span>search</span>
                            </button>
                        </form>
                    </div>
                </div>
               
                <div class="sticky-top">
                    <?php echo $__env->make("frontend.ads", ["adType" => "linkAd", "position" => "leftSide"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                
            </div>
            <div class="col-md-7 col-xl-7 mt-2" >
                <div id="filter_product">
                <?php echo $__env->make('frontend.post-filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
            <div class="col-md-2 p-0 hidden-xs">
                <?php echo $__env->make("frontend.ads", ["adType" => "linkAd", "position" => "rightSide"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
        <div style="margin-bottom: 97px;">
            
        </div>
        
    </div>

    <div class="modal fade" id="selectcatmodal" role="dialog" style="display: none;">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="border: none;padding-bottom: 0;">
                    <h4 class="modal-title">Select Category</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="padding: 0 20px;">
                    <ul class="product-widget-list">
                        <li><a href="<?php echo e(route('home.category')); ?>"> All Categories</a></li>
                        <?php $__currentLoopData = $get_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="product-widget-dropitem" style="margin: 0;padding: 8px; border-bottom: 1px solid #f1f1f1;">
                            <button type="button" class="product-widget-link">
                                 <?php echo e($category->name); ?>

                            </button>
                            <ul class="product-widget-dropdown" >
                                <?php $__currentLoopData = $category->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(Request::route('location') ? route('home.category', [ Request::route('location'), $subcategory->slug]) : route('home.category', ['all', $subcategory->slug])); ?><?php echo e((request()->getQueryString()) ? '?'. request()->getQueryString() : null); ?>"> <?php echo e($subcategory->name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="locationmodal" role="dialog" style="display: none;">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="border: none;padding-bottom: 0;">
                    <h4 class="modal-title">Select Location</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="padding: 0 20px;">
                    <ul class="product-widget-list">
                        <li><a href="<?php echo e(route('home.category')); ?>"> All Location</a></li>
                        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="product-widget-dropitem" style="margin: 0;padding: 8px; border-bottom: 1px solid #f1f1f1;">
                            <button type="button" class="product-widget-link">
                                 <?php echo e($state->name); ?>

                            </button>
                            <ul class="product-widget-dropdown">
                                <?php $__currentLoopData = $state->get_city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(Request::route('location') ? route('home.category', [$city->slug, Request::route('catslug')]) : route('home.category', $city->slug)); ?><?php echo e((request()->getQueryString()) ? '?'. request()->getQueryString() : null); ?>"> <?php echo e($city->name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<script type="text/javascript">
    
    function filter_data(page)
    {
        //enable loader
        $('#filter_product').html('<div style="display:block;" id="loadingData"></div>');
        
        window.scrollTo({top: 100, behavior: 'smooth'});
        $('.filter').hide().fadeOut();
        
        var category = "<?php echo str_replace(' ', '', Request::route('catslug')); ?>" ;
        <?php if(Request::route('location')): ?>
            category += "<?php echo e(Request::route('location')); ?>";
        <?php endif; ?>
        var concatUrl = '?';
        
        var searchKey = $("#searchKey").val();
        if(searchKey != '' ){
            concatUrl += 'q='+searchKey;
        }


        <?php $__currentLoopData = $product_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            var filterValue = get_filter('<?php echo e(str_replace(' ', '', $product_variation->name)); ?>');
            if(filterValue != ''){
                concatUrl += '&<?php echo e(strtolower(str_replace(' ', '', $product_variation->name))); ?>='+filterValue;
            }  
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       
        

        var package = get_filter('package');
        if(package != '' ){
            concatUrl += '&ad='+package;
        }  

        var member = get_filter('member');
        if(member != '' ){
            concatUrl += '&member='+member;
        }     

        var brand = get_filter('brand');
        if(brand != '' ){
            concatUrl += '&brand='+brand;
        }    
       
        var perPage = null;
        var showItem = $("#perPage :selected").val();
        if(typeof showItem != 'undefined' || showItem != null){
           perPage = showItem;
           //check weather page null or set 
            if(page == null){
                //var active = $('.active .page-link').html();
                var page = 1;
            }
        }

        var sortby = $("#sortby :selected").val();
        if(typeof sortby != 'undefined' && sortby != ''){
            concatUrl += '&sortby='+sortby;
            //check weather page null or set 
            if(page == null){
                //var active = $('.active .page-link').html();
                var page = 1;
            }
        }

        var period = $("#period :selected").val();
        if(typeof period != 'undefined' && period != ''){
            concatUrl += '&period='+period;
            //check weather page null or set 
            if(page == null){
                //var active = $('.active .page-link').html();
                var page = 1;
            }
        }

        var price_min = $("#price_min").val();
        if(price_min != '' ){
            concatUrl += '&price_min='+price_min;
        }

        var price_max = $("#price_max").val();
        if(price_max != '' ){
            concatUrl += '&price_max='+price_max;
        }

        if(page != null){concatUrl += '&page='+page;}
     
        var link = '<?php echo e(URL::current()); ?>/'+concatUrl;
            history.pushState({id: null}, null, link);

        $.ajax({
            url:link,
            method:"get",
            data:{
                filter:'filter',perPage:showItem
            },
            success:function(data){
               
                if(data){
                    $('#filter_product').html(data);
                    
                }else{
                    $('#filter_product').html('Not Found');
                }
            },
            error: function() {
                $('#filter_product').html('<span class="ajaxError">Internal server error.!</span>');
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
       
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    function sortproduct(){
        filter_data();
    }
    function showPeriod(){
        filter_data();
    }

    function searchItem(value){
        if(value != ''){ filter_data(); }
    }

    $(document).on('click', '.pagination a', function(e){
        e.preventDefault();

        var page = $(this).attr('href').split('page=')[1];

        filter_data(page);
    });

      
        $(window).on('popstate', function() {  
           var page = $('.pagination a').attr('href').split('page=')[1];
           
            if(page != 'undefined' && page>0){
                window.scrollTo({top: 100, behavior: 'smooth'});
                filter_data(page);
            }
       });

    

    $('#resetAll').click(function(){
        $('input:checkbox').removeAttr('checked');
        $('input[type=checkbox]').prop('checked', false);
        $("#searchKey").val('');
        $('input:radio').removeAttr('checked');
         $("#price-range").val('0');
        //call function
        filter_data();
    });

    $(document).ready(function(){

        $(document).on("click", ".open-filter", function(e){
            e.preventDefault();
            $(".filter").show().fadeIn();
        });
       
        $('.close-filter').click(function() {
          
            $('.filter').hide().fadeOut();
            
        }); 
    });


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

</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\bonik_bazar_latest\bonikbazar\resources\views/frontend/category-details.blade.php ENDPATH**/ ?>