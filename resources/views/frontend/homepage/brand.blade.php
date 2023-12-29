<?php $brands = App\Models\Brand::where('top', 1)->where('status', 1)->take($section->item_number)->get(); ?>
@if(count($brands)>0)
<section class="section" style="max-height: 455px !important; @if($section->layout_width == 1)  background:{{$section->background_color}}" @endif>
    <div class="container" @if($section->layout_width != 1) style="background:{{$section->background_color}};border-radius: 5px; padding: 5px;" @endif>
    
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background:{{$section->text_bg}};display: {{$section->display}};margin: 0;padding: 10px 0;display: flex;justify-content: space-between;align-items: center;">
          <h4 style="color:{{$section->text_color}};margin: 0;">{{$section->title}}</h4>
          <div class="col -df -j-end -fsh0">
              <a href="{{route('topBrand')}}" class="-df -i-ctr -upp -m -mls -pvxs">See All <i class="fa fa-chevron-right" aria-hidden="true"></i></a></div>
        </div>
        @foreach($brands as $brand)
        <div class="col-xs-4 col-md-1" style="padding-left: 5px; padding-right: 5px;margin-bottom:10px;">
        	<div class="brand-list">
                <a href="{{ route('brandProducts', $brand->slug) }}"> 
                <div class="brand-thumb">
                    <img src="{{asset('upload/images/brand/thumb/'.$brand->logo)}}" >
                </div>
                </a>
            </div>
        </div>
        @endforeach
        </div>
    </div>
</section>
@endif