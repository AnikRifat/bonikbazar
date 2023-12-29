<?php $categories = App\Models\Category::withCount('productsByCategory')->where('parent_id', null)->orderBy('position', 'desc')->take($section->item_number)->get(); ?>
@if(count($categories)>0)
<section style="margin:0; @if($section->layout_width == 1) background:{{$section->background_color}} @endif">
  <div class="container" @if($section->layout_width != 1) style="background:{{$section->background_color}};border-radius: 5px;" @endif>
      <h2 class="heading">{{$section->title}}</h2>
      <div class="row">
        @foreach($categories as $category)
        <div class="col-md-3 col-6">
            <div class="quick-links">
                <a class="bikroysub" href="{{ route('home.category', [$category->slug]) }}"><b>{{$category->products_by_category_count}} ads in {{$category->name}}</b></a>
                <p class="subcategory">
                @foreach($category->get_subcategory->take(5) as $subcategory)
                    <a href="{{ route('home.category',[$subcategory->slug]) }}">{{$subcategory->name}}</a>
                @endforeach
                </p>
            </div>
        </div>
        @endforeach
      </div>
    </div>
</section>
@endif