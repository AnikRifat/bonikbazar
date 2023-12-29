<?php  
$category_id = $section->product_id;
$categoryType = App\Models\Category::where('id', $category_id)->select('slug','parent_id', 'subcategory_id')->first();
//ads duration
$ads_duration = App\Models\SiteSetting::where('type', 'free_ads_limit')->first();
$ads_duration =  Carbon\Carbon::parse(now())->subDays($ads_duration->value2); 

$category_type = ($categoryType->parent_id && $categoryType->subcategory_id) ? 'id' : (($categoryType->parent_id && $categoryType->subcategory_id == null) ? 'childcategory_id' : 'subcategory_id');
$products = App\Models\Product::where(function($query) use ($category_id){
          $query->where('category_id', $category_id)
                ->orWhere('subcategory_id', $category_id )
                ->orWhere('childcategory_id', $category_id);
            })
    //->whereRaw('id IN (select MAX(id) FROM products GROUP BY '.$category_type.')')
    ->orderBy('id', 'desc')
    ->selectRaw('id,title,slug,price,category_id,state_id,views,sale_type, feature_image,created_at')
    ->where('status', 'active')->where('approved', '>=', $ads_duration)->take($section->item_number)->get();
?> 

@if(count($products)>0)
<section class="section" @if($section->layout_width == 1) style="background:{{$section->background_color}}" @endif>
  <div class="container" @if($section->layout_width != 1) style="background:{{$section->background_color}};border-radius: 5px;" @endif>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background:{{$section->text_bg}};display: {{$section->display}};margin: 0; padding: 0; display: flex;justify-content: space-between;align-items: center;">
      <h4 style="color:{{$section->text_color}};margin: 0;">{{$section->title}}</h4>
      <div>
          <a href="{{route('home.category', $categoryType->slug)}}" class="-df -i-ctr -upp -m -mls -pvxs">See All <i class="fa fa-chevron-right" aria-hidden="true"></i></a></div>
    </div>
    <div class="row">
      @if($section->thumb_image && $section->image_position == 'left')
      <div class="col-md-3">
        <div style="background: #fff;padding: 5px">
          <img style="width: 100%;height: 100%;" src="{{ asset('upload/images/homepage/'.$section->thumb_image) }}">
        </div>
      </div>
      @endif
      <div class="col-md-{{($section->thumb_image) ? 9 : 12}} col-xs-12">
          <div class="recomend-slider slider-arrow">
                @foreach($products as $product)
                <div class="product-card">
                  <a style="width: 100%" href="{{ route('post_details', $product->slug) }}">
                    <div class="product-media">
                        <div class="product-img">
                            <img class="lazyload" src="{{ asset('upload/images/product/thumb/default.jpg')}}" data-src="{{asset('upload/images/product/thumb/'.$product->feature_image)}}" alt="{{$product->title}}">
                        </div>
                    </div></a>
                    <div class="product-content">
                      <a style="color: #666666" href="{{ route('post_details', $product->slug) }}">
                        <ol class="breadcrumb product-category">
                            <li><i class="fas fa-tags"></i></li>
                            <li class="breadcrumb-item">{{$product->get_category->name ?? ''}}</li>
                        </ol>
                        <h5 class="product-title">
                           {{Str::limit($product->title, 40)}}
                        </h5>
                        <div class="product-meta">
                            <span><i class="fas fa-map-marker-alt"></i>{{$product->get_state->name ?? ''}}</span>
                            <span><i class="fas fa-clock"></i>{{Carbon\Carbon::parse($product->created_at)->diffForHumans()}}</span>
                        </div>
                        </a>
                        <div class="product-info">
                            <h5 class="product-price">{{Config::get('siteSetting.currency_symble') .' '. number_format($product->price)}}@if($product->negotiable == 1)<small>/negotiable</small> @endif</span></h5>
                            <div class="product-btn">
                                
                                <button type="button" title="Wishlist" @if(Auth::check()) onclick="addToWishlist({{$product->id}})" data-toggle="tooltip" @else data-toggle="modal" data-target="#so_sociallogin" @endif class="far fa-heart"></button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
      </div>
      @if($section->thumb_image && $section->image_position == 'right')
        <div class="col-md-3">
          <div style="background: #fff;padding: 5px">
            <img style="width: 100%;height: 100%;" src="{{ asset('upload/images/homepage/'.$section->thumb_image) }}">
          </div>
        </div>
        @endif
    </div>
  </div>
</section>

<script type="text/javascript">
  try {
  $('.recomend-slider').slick({
    dots: false,
    infinite: true,
    speed: 1000,
    autoplay: true,
    arrows: true,
    fade: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    prevArrow: '<i class="fas fa-long-arrow-alt-right dandik"></i>',
    nextArrow: '<i class="fas fa-long-arrow-alt-left bamdik"></i>',
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
        }
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          variableWidth: true,
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          variableWidth: true,
          arrows: false,
        }
      }
    ]
  });
  }
  catch (e) {
     //Handle the error if you wish.
  }
</script>
@endif