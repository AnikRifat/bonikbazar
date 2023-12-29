<?php  

$categories = App\Models\Category::where('parent_id', null)->orderBy('position', 'asc')->where('status', 1)->limit($section->item_number)->get();
?>
@if(count($categories)>0)
<section style="margin: 5px 0;">
  <div class="container" @if($section->layout_width != 1) style="background:{{$section->background_color}};border-radius: 5px;" @endif>
      <h4 style="color:{{$section->text_color}};margin: 0;">{{$section->title}}</h4>
      <div class="row" style="padding: 10px 0px;">
        @foreach($categories as $category)

          <div class="col-4 col-md-2">
                <a style="padding: 0px; margin:0 0 10px;width:100%" href="{{ route('home.category', [$category->slug]) }}" class="suggest-card">
                    <img class="lazyload" src="{{ asset('upload/images/category/thumb/loader.jpg')}}" data-src="{{asset('upload/images/category/thumb/'.$category->image)}}" alt="car">
                    <h6>{{$category->name}}</h6>
                </a>
            </div>
           @endforeach
      </div>
    </div>
</section>
@endif