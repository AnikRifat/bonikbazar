<?php  
$products = App\Models\Product::with('get_brand')->where('status', 'active')
->selectRaw('products.id,title,selling_price,discount,discount_type,brand_id, slug, feature_image')
->whereRaw('id IN (select MAX(id) FROM products GROUP BY category_id)')
->orderBy('id', 'desc')->take($section->item_number)->get(); 
?>
@if(count($products)>0)
<section class="section" @if($section->layout_width == 1) style="background:{{$section->background_color}}" @endif>
  <div class="container" @if($section->layout_width != 1) style="background:{{$section->background_color}};border-radius: 5px; padding:5px;" @endif>
    <div class="row">
     
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background:{{$section->text_bg}};display: {{$section->display}};margin: 0;padding: 10px 0;display: flex;justify-content: space-between;align-items: center;">
          <h4 style="color:{{$section->text_color}};margin: 0;">{{$section->title}}</h4>
          <div class="col -df -j-end -fsh0">
              <a href="{{route('todayDeals')}}" class="-df -i-ctr -upp -m -mls -pvxs">See All <i class="fa fa-chevron-right" aria-hidden="true"></i></a></div>
        </div>
         
            <div class="clearfix module horizontal">
                  <div class="products-category">
                      <div class="category-slider-inner products-list yt-content-slider releate-products grid" data-rtl="yes" data-autoplay="yes" data-pagination="no" data-delay="7" data-speed="0.6" data-margin="5" data-items_column0="6" data-items_column1="5" data-items_column2="3" data-items_column3="3" data-items_column4="2" data-arrows="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
                        @foreach($products as $product)
                        <div class="item-inner product-thumb trg transition product-layout">
                            @include('frontend.homepage.products')
                        </div>
                        @endforeach
                      </div>
                  </div>
            </div>
        </div>
      </div>
  </div>
</section>
@endif