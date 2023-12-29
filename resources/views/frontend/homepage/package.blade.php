<?php  
  $promoteAds = App\Models\PromoteAds::with('get_adPost')->where('package_id', $section->product_id)->get();

?> 

@if(count($promoteAds)>0)
<section class="section" @if($section->layout_width == 1) style="background:{{$section->background_color}}" @endif>
  <div class="container" @if($section->layout_width != 1) style="background:{{$section->background_color}};border-radius: 5px;" @endif>
    
    <h4 style="color:{{$section->text_color}};margin: 0;">{{$section->title}}</h4>
    
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
                @foreach($promoteAds as $post)
                <div class="product-card">
                  <a style="width: 100%" href="{{ route('post_details', $post->slug) }}">
                    <div class="product-media">
                        <div class="product-img">
                            <img class="lazyload" src="{{ asset('upload/images/product/thumb/default.jpg')}}" data-src="{{asset('upload/images/product/thumb/'.$post->get_adPost->feature_image)}}" alt="{{$post->get_adPost->title}}">
                        </div>
                    </div>
                    </a>
                    <div class="product-content">
                      <a style="color: #666666" href="{{ route('post_details', $post->slug) }}">
                        <ol class="breadcrumb product-category">
                            <li><i class="fas fa-tags"></i></li>
                            <li class="breadcrumb-item">{{$post->get_adPost->get_category->name ?? ''}}</li>
                        </ol>
                        <h5 class="product-title">
                            {{Str::limit($post->get_adPost->title, 40)}}
                        </h5>
                        <div class="product-meta">
                            <span><i class="fas fa-map-marker-alt"></i>{{$post->get_adPost->get_state->name ?? ''}}</span>
                            <span><i class="fas fa-clock"></i>{{Carbon\Carbon::parse($post->get_adPost->created_at)->diffForHumans()}}</span>
                        </div>
                        </a>
                        <div class="product-info">
                            <h5 class="product-price">{{Config::get('siteSetting.currency_symble') . $post->get_adPost->price}}@if($post->get_adPost->negotiable == 1)<small>/negotiable</small> @endif</h5>
                            <div class="product-btn">
                               
                                <button type="button" title="Wishlist" @if(Auth::check()) onclick="addToWishlist({{$post->get_adPost->id}})" data-toggle="tooltip" @else data-toggle="modal" data-target="#so_sociallogin" @endif class="far fa-heart"></button>
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