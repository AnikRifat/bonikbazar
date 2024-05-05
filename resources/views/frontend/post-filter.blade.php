@if (count($bannerAds) > 0)
    <div id="carouselExampleControls" class="carousel slide  w-100 rounded" data-ride="carousel" style="max-height: 382px;">
        <div class="carousel-inner">
            @foreach ($bannerAds as $index => $bannerAd)
                <a href="{{ route('post_details', $bannerAd->slug) }}"
                    class="carousel-item @if ($index == 0) active @endif ">
                    <img class="d-block rounded w-100 mh-300 lazyload"
                        src="{{ asset('upload/images/product/default.jpg') }}"
                        data-src="{{ asset('upload/images/product/' . $bannerAd->feature_image) }}"
                        alt="{{ $bannerAd->title }}">
                    <div class="position-absolute left-0 bottom-0 rounded bgs w-100">
                        <h4 class="text-white title">{{ $bannerAd->title }}</h4>
                        <p class="text-white" title="{{ $bannerAd->state_name }}">{{ $bannerAd->category_name }}
                            ({{ $bannerAd->sale_type ? $bannerAd->sale_type : $bannerAd->post_type }})
                            ,
                            {{ $bannerAd->state_name }}</p>
                        <div class="d-flex align-items-center pb-1">
                            <div class="d-flex align-items-center">
                                <b class="text-white pr-1">{{ Config::get('siteSetting.currency_symble') }}.</b>
                                <b class="text-white py-1 mr-2">{{ $bannerAd->price }}</b>
                            </div>
                            @if ($bannerAd->membership_ribbon)
                                <div class="d-flex align-items-center">
                                    <img class="lazyload" width="25"
                                        src="{{ asset('upload/images/membership/' . $bannerAd->membership_ribbon) }}">
                                    <p class="text-white">{{ $bannerAd->membership_name }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <a class="h1s position-absolute left-0 top-50  px-2 py-1" href="#carouselExampleControls" role="button"
            data-slide="prev">
            <img height="15" src="{{ asset('upload/images/a.png') }}">
        </a>
        <a class="h1s position-absolute right-0 top-50  px-2 py-1" href="#carouselExampleControls" role="button"
            data-slide="next">
            <img height="15" class="transform-180" src="{{ asset('upload/images/a.png') }}">
        </a>
    </div>
@endif

<div
    class="e6 py-2 px-2 mx-2 px-md-4 mx-md-4 rounded position-relative shadow-bb @if (count($bannerAds) > 0) mt--4 @endif">
    <div class="d-flex align-items-center justify-content-between">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#selectcatmodal"
            class="d-flex align-items-center">
            <img width="35" height="35" class="lazyload mr-2" src="{{ asset('upload/images/m-1.png') }}">
            <p class="bt">
                @if ($category)
                    {{ $category->name }}
                @else
                    Categories
                @endif
            </p>
        </a>
        <a href="javascript:void(0)" data-toggle="modal" data-target="#locationmodal" class="d-flex align-items-center">
            <img width="35" height="35" class="lazyload mr-1" src="{{ asset('upload/images/m-2.png') }}">
            <p class="bt">
                @if ($state)
                    {{ $state->name }}
                @else
                    Location
                @endif
            </p>
        </a>
        @if (!(new \Jenssegers\Agent\Agent())->isDesktop())
            <div>
                <a href="javascript:void(0)" class="d-flex align-items-center filterBtn open-filter btn btn-block">
                    <img width="35" height="35" class="lazyload mr-1"
                        src="{{ asset('upload/images/m-3.png') }}">
                    <p class="bt">Filter</p>
                </a>
            </div>
        @endif
    </div>
</div>

<!-- <p style="margin: 5px 0; "> ({{ ($products ? $products->total() : '0') + count($pinAds) + count($urgentAds) + count($highlightAds) + count($fastAds) }}  ) ads found {{ Request::get('q') }} </p> -->

<div class="row mt-2">


    @foreach ($items as $item)
        <div class="col-6 col-sm-6 w-100 position-relative p-1">
            <div class="w-100 ab p-2 shadow-bb rounded" href="{{ route('post_details', $item['slug']) }}">
                <div class="position-relative">
                    <a class="w-100" href="{{ route('post_details', $item['slug']) }}">
                        <img width="24" class="lazyload w-100 mh-300"
                            src="{{ asset('upload/images/product/thumb/default.jpg') }}"
                            data-src="{{ asset('upload/images/product/thumb/' . $item['feature_image']) }}"
                            alt="{{ $item['title'] }}">
                    </a>
                </div>
                <div class="ppb-5 overflow-hidden h-100">
                    <a href="{{ route('post_details', $item['slug']) }}">
                        <h4 class="font-weight-bold bt py-1 title" title="{{ $item['title'] }}">{{ $item['title'] }}
                        </h4>
                    </a>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div>
                            @if ($item['membership_ribbon'])
                                <div class="d-flex align-items-center">
                                    <img class="lazyload m<p>Model:</p>

                                    r-1"
                                        width="20"
                                        src="{{ asset('upload/images/membership/' . $item['membership_ribbon']) }}">
                                    <p class="bt">{{ $item['membership_name'] }}</p>
                                </div>
                            @endif


                            <p class="bt"
                                title="{{ isset($item['state_name']) ? $item['state_name'] : $item['get_state']['name'] }}">
                                {{ isset($item['state_name']) ? $item['state_name'] : $item['get_state']['name'] }}</p>
                            <p class="bt hidden-xs" title="{{ $item['category_name'] }}"> {{ $item['category_name'] }}
                                ({{ $item['sale_type'] ? $item['sale_type'] : $item['post_type'] }})
                            </p>
                        </div>
                        @if (isset($item['ribbon']) && $item['ribbon'])
                            <div>
                                <img class="lazyload" width="20"
                                    src="{{ asset('upload/images/package/' . $item['ribbon']) }}">
                            </div>
                        @endif
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="font-weight-bold bt">
                            {{ Config::get('siteSetting.currency_symble') . ' ' . number_format($item['price']) }}</h4>
                        {{-- <p class="bt hidden-xs">{{Carbon\Carbon::parse($item->approved ? $item->approved : $pinAd->created_at)->diffForHumans()}}</p> --}}

                    </div>

                </div>
            </div>
            <a class="position-absolute bottom-1 hidden-md"
                href="{{ route('user.message', [$item['username'], $item['slug']]) }}" title="Message">
                <img width="20" height="20" src="{{ asset('upload/images/sendss.svg') }}" alt="sms">
            </a>
            <div class="hidden-xs">
                <div class="btn-group btn-block" role="group" aria-label="Basic example">
                    @if (Auth::check() && Auth::user()->getMembership)

                    @if ( Auth::user()->getMembership->name=="Authentic Bonik")

                    
                    <button type="button" class="btn btn-success text-white text-center px-1" data-container="body" data-toggle="popover" data-placement="top" data-content="Call us now at {{ $item['mobile'] }} for amazing deals!" data-html="true">
                        <i class="fa fa-phone fa-flip-horizontal" style="color:white"></i> Call
                    </button>
                    
                    <a href="{{ route('user.message') }}" class='btn btn-sm btn-info text-white text-center px-1' href=""><i
                            class="fa fa-paper-plane"></i>Chat</a>

                           
                            @if( $item['website']!=null)
                            
                            <a class='btn btn-sm btn-warning text-center px-1' target="_blank" href="{{ $item['website'] }}"><i
                                    class="fa fa-cart-plus"></i>Buy</a>
                            @endif

                    @else

                    <button type="button" class="btn btn-success text-white text-center px-1" data-container="body" data-toggle="popover" data-placement="top" data-content="Call us now at {{ $item['mobile'] }} for amazing deals!" data-html="true">
                        <i class="fa fa-phone fa-flip-horizontal" style="color:white"></i> Call
                    </button>

                   
                    <a href="{{ route('user.message') }}" class='btn btn-sm btn-info text-white text-center px-1' href=""><i
                            class="fa fa-paper-plane"></i>Chat</a>
                   
                    @endif
                    @endif
                </div>
            </div>
        </div>
    @endforeach

    
</div>
