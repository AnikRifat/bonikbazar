<?php
$products = App\Models\Product::with(['get_promoteAd.get_adPackage', 'wishlist'])->where('status', 'active')
->selectRaw('id,title,slug,price,category_id,state_id,views,sale_type, feature_image,created_at')->orderBy('id', 'desc')->take($section->item_number)->get(); 
?>
@if(count($products)>0)
<div class="hl-2 mt-2">
    @foreach($products as $index => $product)
    <div class="w-100 @if($index==0) ab @else bg-white @endif p-2 mb-2">
        <a class="w-100" href="{{ route('post_details', $product->slug) }}">
            <div class="position-relative">
                <div class="d-flex align-items-center position-absolute left-0 top-0 ">
                    <div class="yb bt px-3 font-weight-bold">USED</div>
                    <div class="ff"></div>
                </div>
                <img class="position-absolute right-0 top-0 lazyload" src="{{ asset('upload/images/urgent.png')}}">
                <img class="lazyload w-100 mh-300" src="{{ asset('upload/images/product/thumb/default.jpg')}}" data-src="{{asset('upload/images/product/'.$product->feature_image)}}" alt="{{$product->title}}">
            </div>
            <div class="">
                <h4 class="font-weight-bold bt py-1 title" title="{{ $product->title }}">{{ $product->title }}</h4>
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="d-flex align-items-center">
                            <img class="lazyload" src="{{ asset('upload/users/lavel1.png')}}">
                            <p class="bt" title="Verified Bonik">Verified Bonik</p>
                        </div>
                        <p class="bt py-1" title="{{$product->get_state->name ?? ''}}">{{$product->get_state->name ?? ''}}</p>
                    </div>
                    <div>
                        <img class="lazyload" src="{{ asset('upload/users/pin.png')}}">
                    </div>
                </div>
                
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="font-weight-bold bt py-1">{{Config::get('siteSetting.currency_symble') .' '. number_format($product->price) }}</h4>
                    <p class="bt py-1">{{Carbon\Carbon::parse($product->created_at)->diffForHumans()}}</p>
                </div>
            </div>
            @if($product->get_promoteAd && $product->get_promoteAd->get_adPackage)
            <img src="{{asset('upload/images/package/'.$product->get_promoteAd->get_adPackage->ribbon)}}">
            @endif
        </a>
        <div class="d-flex align-items-center bb2 rounded shadow mx-3">
            <input type="text" class="px-2 py-1 w-100 rounded" placeholder="Username">
            <button><img height="23" src="{{ asset('upload/images/chat2.png')}}"></button>
        </div>
    </div>
    @endforeach
</div>
@endif