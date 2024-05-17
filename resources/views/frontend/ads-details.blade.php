@extends('layouts.frontend')
@section('title', $post_detail->title.' | '.Config::get('siteSetting.title'))
@section('metatag')
    <meta name="keywords" content="{{ $post_detail->meta_keywords }}" />
    <meta name="title" content="{{($post_detail->meta_title) ? $post_detail->meta_title : $post_detail->title }}" />
    <meta name="description" content="{!! strip_tags( ($post_detail->meta_description) ? $post_detail->meta_description : Str::limit($post_detail->description, 500)) !!}">
    <meta name="image" content="{{asset('upload/images/product/'.$post_detail->feature_image) }}">
    <meta name="rating" content="5">
    <!-- Schema.org for Google -->
    <meta itemprop="name" content="{{($post_detail->meta_title) ? $post_detail->meta_title : $post_detail->title }}">
    <meta itemprop="description" content="{!! strip_tags(($post_detail->meta_description) ? $post_detail->meta_description : Str::limit($post_detail->description, 500)) !!}">
    <meta itemprop="image" content="{{asset('upload/images/product/'.$post_detail->feature_image) }}">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{($post_detail->meta_title) ? $post_detail->meta_title : $post_detail->title }}">
    <meta name="twitter:description" content="{!! strip_tags(($post_detail->meta_description) ? $post_detail->meta_description : Str::limit($post_detail->description, 500)) !!}">
    <meta name="twitter:site" content="{{ url()->full() }}">
    <meta name="twitter:creator" content="@neyamul">
    <meta name="twitter:image:src" content="{{asset('upload/images/product/'.$post_detail->feature_image) }}">
    <meta name="twitter:player" content="#">
    <!-- Twitter - Product (e-commerce) -->
    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta property="og:title" content="{{($post_detail->meta_title) ? $post_detail->meta_title : $post_detail->title }}">
    <meta property="og:description" content="{!! strip_tags(($post_detail->meta_description) ? $post_detail->meta_description : Str::limit($post_detail->description, 500)) !!}">
    <meta property="og:image" content="{{asset('upload/images/product/'.$post_detail->feature_image) }}">
    <meta property="og:url" content="{{asset('upload/images/product/'.$post_detail->feature_image) }}">
    <meta property="og:site_name" content="{{Config::get('siteSetting.site_name')}}">
    <meta property="og:locale" content="bd">
    <meta property="og:type" content="product">
@endsection
@section('css')
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
@endsection
@section('content')

    <div class="breadcrumbs">
        <div class="container">
          <ul class="breadcrumb-cate">
            <li> <a href="/"><i class="fa fa-home"></i></a></li>
              <li><a href="{{route('home.category', $post_detail->get_category->slug ?? '') }}">{{$post_detail->get_category->name ?? ''}}</a></li>
              @if($post_detail->get_subcategory ?? false)
              <li><a href="{{route('home.category', [$post_detail->get_subcategory->slug]) }}">{{$post_detail->get_subcategory->name}}</a></li>
              @endif
              @if($post_detail->get_childcategory ?? false)
              <!-- <li><a href="{{route('home.category', [$post_detail->get_childcategory->slug]) }}">{{$post_detail->get_childcategory->name}}</a></li> -->
              @endif
              <li>{{$post_detail->title}}</li>
          </ul>
        </div>
    </div>
    <div>
        <div class="container  mb-3 p-0">
            <div class="hera-top">
            @include("frontend.ads", ["position" => "top"]) </div>
        </div>

        <div class="container bg-white py-2 px-0 mb-3 rounded">
            <div class="row">
                <div class="col-12 d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <div class="d-md-none">
                            <a href="javascript:history.back()" class="d-flex align-items-center">
                                <img width="20" height="20" class="mr-1" src="{{ asset('upload/images/arrow.png')}}" alt="share">
                                <h3>Ad Details :</h3>
                            </a>
                        </div>
                        <h3 class="bt w-100 hidden-xs">{{$post_detail->title}}</h3>
                        <p class="bt mt-2 w-100 hidden-xs">
                            @if($post_detail->get_state)
                                {{$post_detail->get_state->name}}
                            @endif
                            @if($post_detail->get_city),
                                {{$post_detail->get_city->name}}
                            @endif
                        </p>
                    </div>
                    <div class="d-flex align-items-center">
                        <button type="button" id="shareBtn" data-toggle="modal" data-target="#ad-share" class="wish yb p-2 rounded borders mr-2 sh">
                            <img width="25" height="25" src="{{ asset('upload/images/share.svg')}}" alt="share">
                        </button>
                        <button type="button"  @if(Auth::check()) onclick="addToWishlist({{$post_detail->id}})" data-toggle="tooltip" @else data-toggle="modal" data-target="#so_sociallogin" @endif class="yb p-2 rounded borders sh">
                             <img width="25" height="25" src="{{ asset('upload/images/heart.svg')}}" alt="heart">
                        </button>
                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-12 pr-md-0">
                    <div class="p-2" >
                        <div class="ad-details-slider-group">
                            <div class="ad-details-slider slider-arrow shadow-bb mb-3">
                                <div><img src="{{asset('upload/images/product/'. $post_detail->feature_image)}}" alt="details"></div>
                                @foreach($post_detail->get_galleryImages as $image)
                                <div><img  src="{{asset('upload/images/product/gallery/'. $image->image_path)}}" alt="details"></div>
                                @endforeach
                            </div>

                        </div>
                        <div class="ad-thumb-slider">
                            <div><img width="100" height="100" src="{{asset('upload/images/product/thumb/'. $post_detail->feature_image)}}" alt="details"></div>
                            @foreach($post_detail->get_galleryImages as $image)
                            <div><img width="100" height="100" src="{{asset('upload/images/product/gallery/'. $image->image_path)}}" alt="details"></div>
                            @endforeach
                        </div>
                        <div class="hidden-xs">
                            <p class="bt mt-3">
                                Published On <span class="pt">{{Carbon\Carbon::parse(($post_detail->approved) ? $post_detail->approved : $post_detail->created_at)->format(Config::get('siteSetting.date_format'))}}
                                , {{\Carbon\Carbon::parse(($post_detail->approved) ? $post_detail->approved : $post_detail->created_at)->format('h:i A')}}</span>
                            </p>
                            <div class="d-flex align-items-end my-2">
                                <h3 class="pt ts mr-1">{{Config::get('siteSetting.currency_symble') .' '. number_format($post_detail->price) }}</h3>
                                @if($post_detail->negotiable == 1)
                                <h3 class="ts">(Negotiable)</h3>
                                @endif
                            </div>
                        </div>

                        <div class="d-md-none">
                            <h3 class="bt w-100">{{$post_detail->title}}</h3>
                            <div class="row px-0">
                                <div class="col-12 pl-0">
                                    <p class="bt mt-3 w-100">
                                        Published On <span class="pt">{{Carbon\Carbon::parse(($post_detail->approved) ? $post_detail->approved : $post_detail->created_at)->format(Config::get('siteSetting.date_format'))}}
                                        , {{\Carbon\Carbon::parse(($post_detail->approved) ? $post_detail->approved : $post_detail->created_at)->format('h:i A')}}</span>
                                    </p>
                                    <p class="bt w-100">
                                        @if($post_detail->get_state)
                                            {{$post_detail->get_state->name}}
                                        @endif
                                        @if($post_detail->get_city),
                                            {{$post_detail->get_city->name}}
                                        @endif
                                    </p>
                                    <div class="d-flex align-items-end">
                                        <h3 class="pt ts mr-1">{{Config::get('siteSetting.currency_symble') .' '. number_format($post_detail->price) }}</h3>
                                        @if($post_detail->negotiable == 1)
                                        <h3 class="ts">(Negotiable)</h3>
                                        @endif
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <h5>For Sale By</h5>
                                        <a class="pt ml-1" href="{{route('userProfile', $post_detail->author->username)}}"><h5>{{$post_detail->author->name}}</h5></a>

                                    </div>
                                    @if($post_detail->author && $post_detail->author->membership)
                                    <div class="d-flex align-items-center">
                                        <img class="lazyload" width="25" src="{{ asset('upload/images/membership/'.$post_detail->author->getMembership->ribbon)}}">
                                        <p class="bt">{{$post_detail->author->getMembership->name}}</p>
                                    </div>
                                    @endif
                                    <p>Member Since {{Carbon\Carbon::parse($post_detail->author->created_at)->format(Config::get('siteSetting.date_format'))}}</p>
                                </div>
                                <div class="col-12">
                                     @if(Auth::check())
                                    <div class="d-flex align-items-center justify-content-center my-2">
                                        <button type="button" class="boostads d-flex align-items-center mr-2" data-toggle="modal" data-target="#number">

                                            @if($post_detail->contact_hidden == 1)
                                                <img width="30" height="30" src="{{ asset('upload/images/phn.svg')}}" alt="banner">
                                                <p class="yt e6 py-0 px-2 borders rounded-3">+880*****</p>
                                            @else
                                                @if($post_detail->contact_mobile)
                                                    @foreach(json_decode($post_detail->contact_mobile) as $number)
                                                    <img width="30" height="30" src="{{ asset('upload/images/phn.svg')}}" alt="banner">
                                                    <a class="yt e6 py-0 px-2 borders rounded-3" href="tel:{{ $number}}">+88 {{ $number}}</a>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </button>

                                        <!-- <a class="boostads d-flex align-items-center" href="{{route('user.message', [$post_detail->author->username, $post_detail->slug])}}" title="Message">
                                            <img width="30" height="30" src="{{ asset('upload/images/cht.svg')}}" alt="sms">
                                            <h4 class="yt e6 py-0 px-2 borders rounded-3">Chat</h4>
                                        </a> -->

                                        <button class="btn btn-sm btn-info" onclick="sendMessage({{$post_detail->id}})"><img width="30" height="20" src="{{ asset('upload/images/cht.svg')}}" alt="sms">Chat</button>
                                    </div>
                                    @else
                                    <div class="d-flex align-items-center justify-content-center my-2">
                                        <button type="button" class="boostads d-flex align-items-center mr-2" data-toggle="modal" data-target="#so_sociallogin">
                                            @if($post_detail->contact_mobile)
                                                <img width="30" height="30" src="{{ asset('upload/images/phn.svg')}}" alt="banner">
                                                <p class="yt e6 py-0 px-2 borders rounded-3">+880*****</p>
                                            @endif
                                        </button>

                                        <!-- <a class="boostads d-flex align-items-center" href="{{route('user.message', [$post_detail->author->username, $post_detail->slug])}}" title="Message">
                                            <img width="30" height="30" src="{{ asset('upload/images/cht.svg')}}" alt="sms">
                                            <h4 class="yt e6 py-0 px-2 borders rounded-3">Chat</h4>
                                        </a> -->

                                        <button class="btn btn-sm btn-info" onclick="sendMessage({{$post_detail->id}})"><img width="30" height="20" src="{{ asset('upload/images/cht.svg')}}" alt="sms">Chat</button>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="hl-2 hl-x position-relative overflow-hidden">
                            <div class="htt"></div>
                            @if($post_detail->get_brand)
                            <div class="d-flex align-items-start justify-content-between">
                                <p>Brand:</p>
                                <b>{{ $post_detail->get_brand->name}}</b>
                            </div>

                            <div class="d-flex align-items-start justify-content-between">
                                <p>Model:</p>
                                <b>{{ $post_detail->get_model->name ?? '' }}</b>
                            </div>
                            @endif
                            @if(count($post_detail->get_features)>0)
                            @foreach($post_detail->get_features as $feature)
                            @if($feature->value)
                            <div class="d-flex align-items-start justify-content-between">
                                <p>{{ $feature->name }}: </p>
                                <b>{{$feature->value}}</b>
                            </div>
                            @endif
                            @endforeach
                            @endif

                            @if(count($post_detail->get_variations)>0)
                            @foreach($post_detail->get_variations as $variation)
                            <div class="d-flex align-items-start justify-content-between">
                                <p>{{$variation->attribute_name}}: </p>
                                @foreach($variation->get_variationDetails as $variationDetail)

                                @if($variationDetail->get_attributeValue)
                                <b>{{$variationDetail->get_attributeValue->name}}</b>
                                @endif
                                @endforeach
                            </div>
                            @endforeach
                            @endif
                        </div>

                        <div class="description my-2 border-bottom border-top pb-2 pt-2 text-break">
                            <h2>More Description</h2>
                            <article>{!! $post_detail->description !!}</article>
                        </div>
                        <div class="d-flex align-items-center justify-content-end........................">
                            <a class="boostads d-flex align-items-center justify-content-center" href="{{route('ads.promotePackage', [$post_detail->slug])}}" title="Message">
                                <img width="30" height="30" src="{{ asset('upload/images/boost-icon.png')}}" alt="sms">
                                <h4 class="yt yb py-0 px-2 borders rounded-3">Boost This POST</h4>
                            </a>
                            <button class="float-right py-1 px-4 e6 text-red bb2 rounded shadow-bb font-weight-bold" type="button" @if(Auth::check()) onclick="report({{$post_detail->id}})" data-toggle="tooltip" @else data-toggle="modal" data-target="#so_sociallogin" @endif>Report</button>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="mbox d-grid shadow-bb">
                        <div class="hidden-xs">
                            <div class="d-flex my-2">
                                <a href="{{route('userProfile', $post_detail->author->username)}}" class="mr-3">
                                    <img class="rounded" width="70" height="70" src="{{ asset('upload/users') }}/{{($post_detail->author->photo) ? $post_detail->author->photo : 'default.png'}}" alt="{{$post_detail->author->name}}">
                                </a>
                                <div class="mt-4">
                                    {{-- <h4>{{$post_detail->author->name}}</h4> --}}
                                    @if($post_detail->author && $post_detail->author->membership)
                                    <div class="d-flex align-items-center" style="
                                    font-size: 11px;
                                ">
                                        <p class="bt">
                                        <img class="lazyload" style="height: 20px;" src="{{ asset('upload/images/membership/'.$post_detail->author->getMembership->ribbon)}}">
                                        {{$post_detail->author->getMembership->name}}</p>
                                    <p>joined: {{Carbon\Carbon::parse($post_detail->author->created_at)->format(Config::get('siteSetting.date_format'))}}</p>

                                    </div>
                                    @endif
                                    <a class="c1" href="{{route('userProfile', $post_detail->author->username)}}">Visit Member Shop</a>
                                </div>
                            </div>

                            <a class="boostads d-flex align-items-center justify-content-center my-2" href="{{route('ads.promotePackage', [$post_detail->slug])}}" title="Message">
                                <img width="30" height="30" src="{{ asset('upload/images/boost-icon.png')}}" alt="sms">
                                <h4 class="yt yb py-0 px-2 borders rounded-3">Boost This AD</h4>
                            </a>
                             @if(Auth::check())
                            <div class="d-flex align-items-center justify-content-center my-2">
                                <button type="button" class="boostads d-flex align-items-center m-2" data-toggle="modal" data-target="#number">

                                    @if($post_detail->contact_hidden == 1)
                                        <img width="30" height="30" src="{{ asset('upload/images/phn.svg')}}" alt="banner">
                                        <p class="yt e6 py-0 px-2 borders rounded-3">+880*****</p>
                                    @else
                                        @if($post_detail->contact_mobile)
                                            @foreach(json_decode($post_detail->contact_mobile) as $number)
                                            <img width="30" height="30" src="{{ asset('upload/images/phn.svg')}}" alt="banner">
                                            <a class="yt e6 py-0 px-2 borders rounded-3" href="tel:{{ $number}}">+88 {{ $number}}</a>
                                            @endforeach
                                        @endif
                                    @endif
                                </button>
                                <button type="button" class="boostads d-flex align-items-center m-2 "  onclick="sendMessage({{$post_detail->id}})">
                                    <img width="30" height="30" src="{{ asset('upload/images/cht.svg')}}" alt="banner">
                                    <p class="yt e6 py-0 px-2 borders border-light rounded-3">chat</p>
                            </button>


                            </div>
                            @else
                            <div class=" mx-2">
                                <button type="button" class="boostads d-flex align-items-center m-2 " data-toggle="modal" data-target="#so_sociallogin">
                                    @if($post_detail->contact_mobile)
                                        <img width="30" height="30" src="{{ asset('upload/images/phn.svg')}}" alt="banner">
                                        <p class="yt e6 py-0 px-2 borders rounded-3">+880*****</p>
                                    @endif
                                </button>

                                <!-- <a class="boostads d-flex align-items-center" href="{{route('user.message', [$post_detail->author->username, $post_detail->slug])}}" title="Message">
                                            <img width="30" height="30" src="{{ asset('upload/images/cht.svg')}}" alt="sms">
                                            <h4 class="yt e6 py-0 px-2 borders rounded-3">Chat</h4>
                                        </a> -->

                                        <button type="button" class="boostads d-flex align-items-center m-2 "  onclick="sendMessage({{$post_detail->id}})">
                                                <img width="30" height="30" src="{{ asset('upload/images/cht.svg')}}" alt="banner">
                                                <p class="yt e6 py-0 px-2 borders border-light rounded-3">chat</p>
                                        </button>



                            </div>
                            @endif
                        </div>
                        <?php

                        $safety_tip = App\Models\SiteSetting::where('type', 'safety_tip')->first();
                        ?>
                        @if($safety_tip->status == 1)
                        <!-- SAFETY CARD -->
                        <div class="mbox her p-2 mt-3 mb-2">
                            <h5 class="mbox d-inline-block shadow-bb mb-2 c1 e6">Be Safe</h5>
                            <div class="c2" style="max-height: 125px;overflow: hidden;">
                                {!! ($post_detail->get_category->safety_tip) ? $post_detail->get_category->safety_tip : $safety_tip->value !!}
                            </div>
                            <a href="#" class="c1 d-flex justify-content-center">See all safety tips></a>
                        </div>
                        @endif
                    </div>

                    <div>
                        @include("frontend.ads", ["adType" => "linkAd", "position" => "leftSide"])
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(count($related_products)>0)
    <div class="container bg-white mb-3 py-4 px-0 rounded">
        @if($post_detail->author && $post_detail->author->membership)
        <div style="display: flex;justify-content: space-between; margin: 0 15px;align-items: center;">
            <div class="d-flex">
                <a href="{{route('userProfile', $post_detail->author->username)}}" class="mr-3">
                    <img class="rounded" width="70" height="70" src="{{ asset('upload/users') }}/{{($post_detail->author->photo) ? $post_detail->author->photo : 'default.png'}}" alt="{{$post_detail->author->name}}">
                </a>
                <div class="mt-4">
                    <h4>{{$post_detail->author->name}}</h4>
                    @if($post_detail->author && $post_detail->author->membership)
                    <div class="d-flex align-items-center">
                        <img class="lazyload" width="25" src="{{ asset('upload/images/membership/'.$post_detail->author->getMembership->ribbon)}}">
                        <p class="bt">{{$post_detail->author->getMembership->name}}</p>
                    </div>
                    @endif
                    <a class="c1" href="{{route('userProfile', $post_detail->author->username)}}">Visit Member Shop</a>
                    <h4>More Ads From</h4>
                </div>
            </div>
            <div>
            <a
            @if(Auth::check())
                onclick="follower({{$post_detail->user_id}})"
            @else
                data-toggle="modal" data-target="#so_sociallogin"
            @endif
            class="btn user-f" id="follower" href="javascript:void(0)">
                @if(Auth::check() && App\Models\FavoriteSeller::where('user_id', Auth::id())->where('follower_id', $post_detail->user_id)->first())
                <div class="followy">Unfollow</div>
                @else
                <div class="follow">Follow</div>
                @endif
            </a>
            </div>
        </div>
        @else
        <h3 class="mb-4 d-flex align-items-center justify-content-center">Related This <p class="pt font-weight-normal pl-2">Ads</p></h3>
        @endif
        <hr style="margin: 1em auto;width: 70%;border: 1px solid #000;">
        <div class="row px-md-5">

        @foreach($related_products as $index => $related_product)
            <div class="col-6 col-md-4 w-100 bg-white h-100 p-1 mb-2 position-relative">
                <div class="w-100 bg-white shadow-bb rounded position-relative p-2 h-100">
                    <div class="position-relative">
                        <a href="{{ route('post_details', $related_product->slug) }}">
                        <img class="lazyload w-100 mh-300" src="{{ asset('upload/images/product/thumb/default.jpg')}}" data-src="{{asset('upload/images/product/thumb/'. $related_product->feature_image)}}" alt="{{$related_product->title}}">
                        </a>
                    </div>
                    <div class="ppb-5 overflow-hidden">
                        <a href="{{ route('post_details', $related_product->slug) }}">
                            <h4 class="font-weight-bold bt py-1 title" title="{{ $related_product->title }}">{{ $related_product->title }}</h4>
                        </a>
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                @if($related_product->membership_ribbon)
                                <div class="d-flex align-items-center">
                                    <img class="lazyload" width="20" src="{{ asset('upload/images/membership/'.$related_product->membership_ribbon)}}">
                                    <p class="bt">{{$related_product->membership_name}}</p>
                                </div>
                                @endif
                                <p class="bt">{{$related_product->get_state->name ?? ''}}</p>
                                <p class="bt hidden-xs">{{$related_product->get_subcategory->name ?? ''}} ({{($related_product->sale_type) ? $related_product->sale_type : $related_product->post_type}})</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold bt py-1">{{Config::get('siteSetting.currency_symble') .' '. number_format($related_product->price) }}</h4>
                            <p class="bt py-1  hidden-xs">{{Carbon\Carbon::parse($related_product->created_at)->diffForHumans()}}</p>
                        </div>
                    </div>
                    {{-- <a class="position-absolute bottom-1 hidden-md" href="{{route('user.message', [ $related_product->slug])}}" title="Message">
                        <img width="20" height="20" src="{{ asset('upload/images/sendss.svg')}}" alt="sms">
                    </a> --}}

                    <div>
                        <div class="btn-group btn-block" role="group" aria-label="Basic example">
                            @if (Auth::check() && Auth::user()->getMembership)
                                @if (Auth::user()->getMembership->name == 'Authentic Bonik')
                                <button type="button" class="btn btn-success text-white text-center px-1" data-container="body" data-toggle="popover" data-placement="top" data-content="Call us now at {{ $post_detail->user->sellerVerify->mobile }} for amazing deals!" data-html="true">
                                    <i class="fa fa-phone fa-flip-horizontal" style="color:white"></i> Call

                                <!-- <a class="boostads d-flex align-items-center" href="{{route('user.message', [$post_detail->author->username, $post_detail->slug])}}" title="Message">
                                            <img width="30" height="30" src="{{ asset('upload/images/cht.svg')}}" alt="sms">
                                            <h4 class="yt e6 py-0 px-2 borders rounded-3">Chat</h4>
                                        </a> --></button>

                                <button class="btn btn-sm btn-info" onclick="sendMessage({{$post_detail->id}})"><img width="30" height="20" src="{{ asset('upload/images/cht.svg')}}" alt="sms">Chat</button>
                                @if ($post_detail->user->sellerVerify !== null && $post_detail->user->sellerVerify->website !== null && $post_detail->user->sellerVerify->website !== " " && $post_detail->user->sellerVerify->website !== "#")
                                        <a class='btn btn-sm btn-warning text-center px-1' target="_blank" href="{{$post_detail->user->sellerVerify->website }}"><i
                                                class="fa fa-cart-plus"></i>Buy</a>
                                        @endif
                                @else
                                <button type="button" class="btn btn-success text-white text-center px-1" data-container="body" data-toggle="popover" data-placement="top" data-content="Call us now at {{ $post_detail->user->sellerVerify->mobile }} for amazing deals!" data-html="true">
                                    <i class="fa fa-phone fa-flip-horizontal" style="color:white"></i> Call

                                <!-- <a class="boostads d-flex align-items-center" href="{{route('user.message', [$post_detail->author->username, $post_detail->slug])}}" title="Message">
                                            <img width="30" height="30" src="{{ asset('upload/images/cht.svg')}}" alt="sms">
                                            <h4 class="yt e6 py-0 px-2 borders rounded-3">Chat</h4>
                                        </a> --></button>

                                <button class="btn btn-sm btn-info" onclick="sendMessage({{$post_detail->id}})"><img width="30" height="20" src="{{ asset('upload/images/cht.svg')}}" alt="sms">Chat</button>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>

                {{-- <div class="hidden-xs">
                    <div class="d-flex mt-n3 position-relative z-3">
                        <div class="d-flex align-items-center bb2 rounded shadow mx-3 bg-white">
                            <input type="text" name="message" id="message{{$related_product->id}}" class="px-2 py-1 w-100 rounded" placeholder="Send message">
                            <button @if(Auth::check()) onclick="sendMessage({{$related_product->id}})" @else data-target="#so_sociallogin" data-toggle="modal" @endif>
                                <img height="23" src="{{ asset('upload/images/sendss.svg')}}">
                            </button>
                        </div>
                    </div>
                </div> --}}
            </div>

            @if($index == 1)
            <div class="col-6 col-md-4">
            @include("frontend.ads", ["position" => "mobile-ad", "class" => "w-100 p-0 mb-2 position-relative"])
            </div>
            @endif


            @if($index == 3)
            <div class="col-6 col-md-4">
            @include("frontend.ads", ["position" => "mobile-ad", "class" => "w-100 p-0 mb-2 position-relative"])
            </div>
            @endif

        @endforeach
        </div>
    </div>
    @endif

    <div class="container p-0" style="margin-bottom: 97px;">
        @include("frontend.ads", ["position" => "bottom"])
    </div>

    @if($post_detail->contact_hidden == 1)
    <div class="modal fade" id="number">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Contact this Number</h4>
                    <button class="fa fa-times" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h3 class="modal-number">@if($post_detail->contact_mobile) @foreach(json_decode($post_detail->contact_mobile) as $number) <p><a href="tel:{{ $number}}">{{ $number}}</a></p> @endforeach  @endif</h3>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="modal fade" id="reportModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Product report</h4>
                    <button class="fa fa-times" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('sellerReport')}}" method="post">
                        @csrf()
                        <input type="hidden" name="product_id" value="{{$post_detail->id}}">
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
                    <a href="https://www.facebook.com/sharer.php?u={{ route('post_details', $post_detail->slug) }}">
                        <i class="fab fa-facebook-f bt yb p-3 rounded-circle"></i>
                    </a>
                    <a href="https://twitter.com/share?url={{ route('post_details', $post_detail->slug) }}&amp;text={!! $post_detail->title !!}&amp;hashtags=blog">
                        <i class="fab fa-twitter bt yb p-3 rounded-circle"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{ route('post_details', $post_detail->slug) }}?rs={{$post_detail->id}}">
                        <i class="fab fa-linkedin-in bt yb p-3 rounded-circle"></i>
                    </a>
                    <a href="https://web.whatsapp.com/send?text={{ route('post_details', $post_detail->slug) }}&amp;title={!! $post_detail->title !!}">
                        <i class="fab fa-whatsapp bt yb p-3 rounded-circle"></i>
                    </a>
                    <a href="https://pinterest.com/pin/create/button/?url={{ route('post_details', $post_detail->slug) }}?rs={{$post_detail->id}}">
                        <i class="fab fa-pinterest-p bt yb p-3 rounded-circle"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="{{asset('js/readmore.js') }}"></script>
<script>
    @if(Auth::check())
    function follower(follower_id){
        $.ajax({
            method:'get',
            url:'{{route("follower")}}',
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
            url:'{{route("reportForm")}}',
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
    @endif
    $('article').readmore({speed: 500});


    function sendMessage(product_id){

        // var message = $('#message'+product_id).val();
        var message = " ";
        if(message == ''){
            toastr.error('Message field required.');
            return false;
        }
        $.ajax({
        url:'{{route("user.sendMessage")}}',
        type:'post',
        data:{productOrConId:product_id,message:message,'_token':'{{ csrf_token() }}'},
        success:function(data){
            if(data){
                $('#message'+product_id).val('');
                window.location.href = '/message';

                toastr.success('Message send success.');
            }else{
                toastr.error('Message send failad.');
            }
          }
      });
    }


    $(document).on("click", "#shareBtn", function(){
        var ad_id = "{{ $post_detail->id }}"
        $.ajax({
            method:'get',
            url:'{{route("shareAd")}}',
            data:{ ad_id:ad_id }
        });
    });
</script>
@endsection
