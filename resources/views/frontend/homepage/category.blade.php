<?php  

$subcategories = App\Models\Category::withCount('productsBySubcategory')->where('parent_id', $section->product_id)->inRandomOrder()->take($section->item_number)->get();
?>

@if(count($subcategories)>0)
<section style="margin: 5px 0; @if($section->layout_width == 1) background:{{$section->background_color}} @endif">
  <div class="container" @if($section->layout_width != 1) style="background:{{$section->background_color}};border-radius: 5px;" @endif>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background:{{$section->text_bg}};display: {{$section->display}};margin: 0;padding:0;display: flex;justify-content: space-between;align-items: center;">
          <h4 style="color:{{$section->text_color}};margin: 0;">{{$section->title}}</h4>
          <!-- <div class="col -df -j-end -fsh0">
              <a href="#" class="-df -i-ctr -upp -m -mls -pvxs">See All <i class="fa fa-chevron-right" aria-hidden="true"></i></a></div> -->
        </div>
      <div class="row">
          @if($section->thumb_image && $section->image_position == 'left')
          <div class="col-md-3 col-xs-12 hidden-xs hidden-sm">
            <div style="background: #fff;padding: 5px">
              <img style="width: 100%;height: 100%;" src="{{ asset('upload/images/homepage/'.$section->thumb_image) }}">
            </div>
          </div>
          @endif
          <div class="col-xs-12 col-md-{{($section->thumb_image) ? 9 : 12}} col_hksd">
              <div class="category">
              @foreach($subcategories as $subcategory)

                <a style="padding: 10px;" href="{{ route('home.category', [$subcategory->slug]) }}" class="suggest-card">
                    <img src="{{asset('upload/images/category/thumb/'.$subcategory->image)}}" alt="car">
                    <h6>{{$subcategory->name}}</h6>
                    <p>({{$subcategory->products_by_subcategory_count}}) ads</p>
                </a>
             
              @endforeach

            </div>
          </div>
          @if($section->thumb_image && $section->image_position == 'right')
          <div class="col-md-3 col-xs-12 hidden-xs hidden-sm">
            <div style="background: #fff;padding: 5px">
              <img style="width: 100%;height: 100%;" src="{{ asset('upload/images/homepage/'.$section->thumb_image) }}">
            </div>
          </div>
          @endif
      </div>
    </div>
</section>
@endif