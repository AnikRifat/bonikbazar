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

    @if (count($products) > 0 ||
            count($pinAds) > 0 ||
            count($urgentAds) > 0 ||
            count($highlightAds) > 0 ||
            count($fastAds) > 0)

        @for ($index = 0; $index < 24; $index++)

            @if ($index == 0)
                @if (count($pinAds) > 0)
                    @foreach ($pinAds as $pinAd)
                        <div class="col-6 col-sm-6 w-100 position-relative p-5">
                            <div class="w-100 ab p-2 shadow-bb rounded"
                                href="{{ route('post_details', $pinAd->slug) }}">
                                <div class="position-relative">
                                    <a class="w-100" href="{{ route('post_details', $pinAd->slug) }}">
                                        <img width="24" class="lazyload w-100 mh-300"
                                            src="{{ asset('upload/images/product/thumb/default.jpg') }}"
                                            data-src="{{ asset('upload/images/product/thumb/' . $pinAd->feature_image) }}"
                                            alt="{{ $pinAd->title }}">
                                    </a>
                                </div>
                                <div class="ppb-5 overflow-hidden h-100">
                                    <a href="{{ route('post_details', $pinAd->slug) }}">
                                        <h4 class="font-weight-bold bt py-1 title" title="{{ $pinAd->title }}">
                                            {{ $pinAd->title }}</h4>
                                    </a>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div>
                                            @if ($pinAd->membership_ribbon)
                                                <div class="d-flex align-items-center">
                                                    <img class="lazyload mr-1" width="20"
                                                        src="{{ asset('upload/images/membership/' . $pinAd->membership_ribbon) }}">
                                                    <p class="bt">{{ $pinAd->membership_name }}</p>
                                                </div>
                                            @endif
                                            <p class="bt" title="{{ $pinAd->state_name }}">
                                                {{ $pinAd->state_name }}</p>
                                            <p class="bt hidden-xs" title="{{ $pinAd->category_name }}">
                                                {{ $pinAd->category_name }}
                                                ({{ $pinAd->sale_type ? $pinAd->sale_type : $pinAd->post_type }})
                                            </p>
                                        </div>
                                        @if ($pinAd->ribbon)
                                            <div>
                                                <img class="lazyload" width="20"
                                                    src="{{ asset('upload/images/package/' . $pinAd->ribbon) }}">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="font-weight-bold bt">
                                            {{ Config::get('siteSetting.currency_symble') . ' ' . number_format($pinAd->price) }}
                                        </h4>
                                        <p class="bt hidden-xs">
                                            {{ Carbon\Carbon::parse($pinAd->approved ? $pinAd->approved : $pinAd->created_at)->diffForHumans() }}
                                        </p>

                                    </div>

                                </div>
                            </div>
                            <a class="position-absolute bottom-1 hidden-md"
                                href="{{ route('user.message', [$pinAd->username, $pinAd->slug]) }}" title="Message">
                                <img width="20" height="20" src="{{ asset('upload/images/sendss.svg') }}"
                                    alt="sms">
                            </a>
                            <div class="hidden-xs">
                                <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                    @if (Auth::check() && Auth::user()->getMembership)
                                        @if (Auth::user()->getMembership->name == 'Authentic Bonik')
                                            <a class='btn  btn-success text-white text-center px-1' href=""><i
                                                    class="fa fa-phone fa-flip-horizontal" style="color:white"></i>
                                                Call</a>
                                            <a href="{{ route('user.message') }}"
                                                class='btn btn-sm btn-info text-white text-center px-1'
                                                href=""><i class="fa fa-paper-plane"></i>Chat</a>
                                                @if ( $pinAd->website!=null)
                                                <a class='btn btn-sm btn-warning text-center px-1' target="_blank" href="{{ $pinAd->website }}"><i
                                                        class="fa fa-cart-plus"></i>Buy</a>
                                                @endif
                                        @else 
                                            <a class='btn  btn-success text-white text-center px-1' href=""><i
                                                    class="fa fa-phone fa-flip-horizontal" style="color:white"></i>
                                                Call</a>
                                            <a href="{{ route('user.message') }}"
                                                class='btn btn-sm btn-info text-white text-center px-1'
                                                href=""><i class="fa fa-paper-plane"></i>Chat</a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            @elseif($index >= 1 && $index <= 4)
                @php $productIndex = ($index - 1); @endphp

                @if ($productIndex < count($products))
                    @php $product = $products[$productIndex]; @endphp

                    <div class="col-6 col-sm-6 w-100 position-relative p-5">
                        <div class="w-100 bg-white rounded position-relative h-100">
                            <div class="position-relative">
                                <a class="w-100" href="{{ route('post_details', $product->slug) }}">
                                    <img class="lazyload w-100 mh-300"
                                        src="{{ asset('upload/images/product/thumb/default.jpg') }}"
                                        data-src="{{ asset('upload/images/product/thumb/' . $product->feature_image) }}"
                                        alt="{{ $product->title }}">
                                </a>
                            </div>
                            <div class="ppb-5 overflow-hidden">
                                <a href="{{ route('post_details', $product->slug) }}">
                                    <h4 class="font-weight-bold bt py-1 title" title="{{ $product->title }}">
                                        {{ $product->title }}</h4>
                                </a>
                                <div class="d-flex align-items-center justify-content-between">

                                    <div>
                                        @if ($product->membership_ribbon)
                                            <div class="d-flex align-items-center">
                                                <img class="lazyload mr-1" width="20"
                                                    src="{{ asset('upload/images/membership/' . $product->membership_ribbon) }}">
                                                <p class="bt">{{ $product->membership_name }}</p>
                                            </div>
                                        @endif
                                        <p class="bt">{{ $product->get_state->name ?? '' }}</p>
                                        <p class="bt hidden-xs">{{ $product->category_name ?? '' }}
                                            ({{ $product->sale_type ? $product->sale_type : $product->post_type }})
                                        </p>

                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="font-weight-bold bt py-1">
                                        {{ Config::get('siteSetting.currency_symble') . ' ' . number_format($product->price) }}
                                    </h4>
                                    <p class="bt py-1 hidden-xs">
                                        {{ Carbon\Carbon::parse($product->approved ? $product->approved : $product->created_at)->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            <a class="position-absolute bottom-1 hidden-md"
                                href="{{ route('user.message', [$product->username, $product->slug]) }}"
                                title="Message">
                                <img width="20" height="20" src="{{ asset('upload/images/sendss.svg') }}"
                                    alt="sms">
                            </a>
                        </div>

                        <div class="hidden-xs">

                            <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                @if (Auth::check() && Auth::user()->getMembership)
                                    @if (Auth::user()->getMembership->name == 'Authentic Bonik')
                                        <a class='btn  btn-success text-white text-center px-1' href=""><i
                                                class="fa fa-phone fa-flip-horizontal" style="color:white"></i>
                                            Call</a>
                                        <a href="{{ route('user.message') }}"
                                            class='btn btn-sm btn-info text-white text-center px-1' href=""><i
                                                class="fa fa-paper-plane"></i>Chat</a>
                                                @if ( $product->website!=null)
                                                <a class='btn btn-sm btn-warning text-center px-1' target="_blank" href="{{ $product->website }}"><i
                                                        class="fa fa-cart-plus"></i>Buy</a>
                                                @endif
                                    @else 
                                        <a class='btn  btn-success text-white text-center px-1' href=""><i
                                                class="fa fa-phone fa-flip-horizontal" style="color:white"></i>
                                            Call</a>
                                        <a href="{{ route('user.message') }}"
                                            class='btn btn-sm btn-info text-white text-center px-1' href=""><i
                                                class="fa fa-paper-plane"></i>Chat</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                @if ($index == 4 && count($products) > 0)
                    @include('frontend.mobile-ads', [
                        'adType' => 'linkAd',
                        'class' => 'col-6 col-sm-6 w-100  p-2',
                    ])
                @endif
            @elseif($index == 5)
                @foreach ($urgentAds as $urgentAd)
                    <div class="col-6 col-sm-6 w-100 position-relative p-5">
                        <div class="w-100 position-relative ab p-2 shadow-bb rounded">
                            <div class="position-relative">
                                <a class="w-100" href="{{ route('post_details', $urgentAd->slug) }}">
                                    <img class="lazyload w-100 mh-300"
                                        src="{{ asset('upload/images/product/thumb/default.jpg') }}"
                                        data-src="{{ asset('upload/images/product/thumb/' . $urgentAd->feature_image) }}"
                                        alt="{{ $urgentAd->title }}">
                                </a>
                            </div>
                            <div class="ppb-5 overflow-hidden h-100">
                                <a href="{{ route('post_details', $urgentAd->slug) }}">
                                    <h4 class="font-weight-bold bt py-1 title" title="{{ $urgentAd->title }}">
                                        {{ $urgentAd->title }}</h4>
                                </a>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        @if ($urgentAd->membership_ribbon)
                                            <div class="d-flex align-items-center">
                                                <img class="lazyload mr-1" width="20"
                                                    src="{{ asset('upload/images/membership/' . $urgentAd->membership_ribbon) }}">
                                                <p class="bt">{{ $urgentAd->membership_name }}</p>
                                            </div>
                                        @endif
                                        <p class="bt" title="{{ $urgentAd->state_name }}">
                                            {{ $urgentAd->state_name }}</p>
                                        <p class="bt hidden-xs" title="{{ $urgentAd->category_name }}">
                                            {{ $urgentAd->category_name }}
                                            ({{ $urgentAd->sale_type ? $urgentAd->sale_type : $urgentAd->post_type }})
                                        </p>
                                    </div>
                                    @if ($urgentAd->ribbon)
                                        <img width="20"
                                            src="{{ asset('upload/images/package/' . $urgentAd->ribbon) }}">
                                    @endif
                                </div>

                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="font-weight-bold bt py-1">
                                        {{ Config::get('siteSetting.currency_symble') . ' ' . number_format($urgentAd->price) }}
                                    </h4>
                                    <p class="bt py-1 hidden-xs">
                                        {{ Carbon\Carbon::parse($urgentAd->approved ? $urgentAd->approved : $urgentAd->created_at)->diffForHumans() }}
                                    </p>
                                </div>
                            </div><a class="position-absolute bottom-1 hidden-md"
                                href="{{ route('user.message', [$urgentAd->username, $urgentAd->slug]) }}"
                                title="Message">
                                <img width="20" height="20" src="{{ asset('upload/images/sendss.svg') }}"
                                    alt="sms">
                            </a>
                        </div>

                        <div class="hidden-xs">

                            <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                @if (Auth::check() && Auth::user()->getMembership)
                                    @if (Auth::user()->getMembership->name == 'Authentic Bonik')
                                        <a class='btn  btn-success text-white text-center px-1' href=""><i
                                                class="fa fa-phone fa-flip-horizontal" style="color:white"></i>
                                            Call</a>
                                        <a href="{{ route('user.message') }}"
                                            class='btn btn-sm btn-info text-white text-center px-1' href=""><i
                                                class="fa fa-paper-plane"></i>Chat</a>
                                                @if ( $urgentAd->website!=null)
                                                <a class='btn btn-sm btn-warning text-center px-1' target="_blank" href="{{ $urgentAd->website }}"><i
                                                        class="fa fa-cart-plus"></i>Buy</a>
                                                @endif
                                    @else 
                                        <a class='btn  btn-success text-white text-center px-1' href=""><i
                                                class="fa fa-phone fa-flip-horizontal" style="color:white"></i>
                                            Call</a>
                                        <a href="{{ route('user.message') }}"
                                            class='btn btn-sm btn-info text-white text-center px-1' href=""><i
                                                class="fa fa-paper-plane"></i>Chat</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @elseif($index >= 6 && $index <= 9)
                @php $productIndex = ($index - 2); @endphp

                @if ($productIndex < count($products))
                    @php $product = $products[$productIndex]; @endphp

                    <div class="col-6 col-sm-6 w-100 position-relative p-5">
                        <div class="w-100 bg-white position-relative rounded">
                            <div class="position-relative">
                                <a class="w-100" href="{{ route('post_details', $product->slug) }}">
                                    <img class="lazyload w-100 mh-300"
                                        src="{{ asset('upload/images/product/thumb/default.jpg') }}"
                                        data-src="{{ asset('upload/images/product/thumb/' . $product->feature_image) }}"
                                        alt="{{ $product->title }}">
                                </a>
                            </div>
                            <div class="ppb-5 overflow-hidden h-100">
                                <a href="{{ route('post_details', $product->slug) }}">
                                    <h4 class="font-weight-bold bt py-1 title" title="{{ $product->title }}">
                                        {{ $product->title }}</h4>
                                </a>
                                <div class="d-flex align-items-center justify-content-between">

                                    <div>
                                        @if ($product->membership_ribbon)
                                            <div class="d-flex align-items-center">
                                                <img class="lazyload mr-1" width="20"
                                                    src="{{ asset('upload/images/membership/' . $product->membership_ribbon) }}">
                                                <p class="bt">{{ $product->membership_name }}</p>
                                            </div>
                                        @endif
                                        <p class="bt">{{ $product->get_state->name ?? '' }}</p>
                                        <p class="bt hidden-xs">{{ $product->category_name ?? '' }}
                                            ({{ $product->sale_type ? $product->sale_type : $product->post_type }})
                                        </p>

                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="font-weight-bold bt py-1">
                                        {{ Config::get('siteSetting.currency_symble') . ' ' . number_format($product->price) }}
                                    </h4>
                                    <p class="bt py-1 hidden-xs">
                                        {{ Carbon\Carbon::parse($product->approved ? $product->approved : $product->created_at)->diffForHumans() }}
                                    </p>
                                </div>
                            </div><a class="position-absolute bottom-1 hidden-md"
                                href="{{ route('user.message', [$product->username, $product->slug]) }}"
                                title="Message">
                                <img width="20" height="20" src="{{ asset('upload/images/sendss.svg') }}"
                                    alt="sms">
                            </a>
                        </div>

                        <div class="hidden-xs">

                            <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                @if (Auth::check() && Auth::user()->getMembership)
                                    @if (Auth::user()->getMembership->name == 'Authentic Bonik')
                                        <a class='btn  btn-success text-white text-center px-1' href=""><i
                                                class="fa fa-phone fa-flip-horizontal" style="color:white"></i>
                                            Call</a>
                                        <a href="{{ route('user.message') }}"
                                            class='btn btn-sm btn-info text-white text-center px-1' href=""><i
                                                class="fa fa-paper-plane"></i>Chat</a>
                                                @if ( $product->website!=null)
                                                <a class='btn btn-sm btn-warning text-center px-1' target="_blank" href="{{ $product->website }}"><i
                                                        class="fa fa-cart-plus"></i>Buy</a>
                                                @endif
                                    @else 
                                        <a class='btn  btn-success text-white text-center px-1' href=""><i
                                                class="fa fa-phone fa-flip-horizontal" style="color:white"></i>
                                            Call</a>
                                        <a href="{{ route('user.message') }}"
                                            class='btn btn-sm btn-info text-white text-center px-1' href=""><i
                                                class="fa fa-paper-plane"></i>Chat</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @elseif($index == 12)
                @foreach ($highlightAds as $highlightAd)
                    <div class="col-6 col-sm-6 w-100 position-relative p-5">
                        <div class="w-100 position-relative ab p-2 shadow-bb rounded">
                            <div class="position-relative">

                                <a class="w-100" href="{{ route('post_details', $highlightAd->slug) }}">
                                    <img class="lazyload w-100 mh-300"
                                        src="{{ asset('upload/images/product/thumb/default.jpg') }}"
                                        data-src="{{ asset('upload/images/product/thumb/' . $highlightAd->feature_image) }}"
                                        alt="{{ $highlightAd->title }}">
                                </a>
                            </div>
                            <div class="ppb-5 overflow-hidden h-100">
                                <a href="{{ route('post_details', $highlightAd->slug) }}">
                                    <h4 class="font-weight-bold bt py-1 title" title="{{ $highlightAd->title }}">
                                        {{ $highlightAd->title }}</h4>
                                </a>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        @if ($highlightAd->membership_ribbon)
                                            <div class="d-flex align-items-center">
                                                <img class="lazyload mr-1" width="20"
                                                    src="{{ asset('upload/images/membership/' . $highlightAd->membership_ribbon) }}">
                                                <p class="bt">{{ $highlightAd->membership_name }}</p>
                                            </div>
                                        @endif
                                        <p class="bt" title="{{ $highlightAd->state_name }}">
                                            {{ $highlightAd->state_name }}</p>
                                        <p class="bt hidden-xs"> {{ $highlightAd->category_name }}
                                            ({{ $highlightAd->sale_type ? $highlightAd->sale_type : $highlightAd->post_type }})
                                        </p>
                                    </div>
                                    @if ($highlightAd->ribbon)
                                        <img width="25" class="lazyload"
                                            src="{{ asset('upload/images/package/' . $highlightAd->ribbon) }}">
                                    @endif
                                </div>

                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="font-weight-bold bt py-1">
                                        {{ Config::get('siteSetting.currency_symble') . ' ' . number_format($highlightAd->price) }}
                                    </h4>
                                    <p class="bt py-1 hidden-xs">
                                        {{ Carbon\Carbon::parse($highlightAd->approved ? $highlightAd->approved : $highlightAd->created_at)->diffForHumans() }}
                                    </p>
                                </div>
                            </div><a class="position-absolute bottom-1 hidden-md"
                                href="{{ route('user.message', [$highlightAd->username, $highlightAd->slug]) }}"
                                title="Message">
                                <img width="20" height="20" src="{{ asset('upload/images/sendss.svg') }}"
                                    alt="sms">
                            </a>
                        </div>

                        <div class="hidden-xs">

                            <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                @if (Auth::check() && Auth::user()->getMembership)
                                    @if (Auth::user()->getMembership->name == 'Authentic Bonik')
                                        <a class='btn  btn-success text-white text-center px-1' href=""><i
                                                class="fa fa-phone fa-flip-horizontal" style="color:white"></i>
                                            Call</a>
                                        <a href="{{ route('user.message') }}"
                                            class='btn btn-sm btn-info text-white text-center px-1' href=""><i
                                                class="fa fa-paper-plane"></i>Chat</a>
                                                @if ( $highlightAd->website!=null)
                                                <a class='btn btn-sm btn-warning text-center px-1' target="_blank" href="{{ $highlightAd->website }}"><i
                                                        class="fa fa-cart-plus"></i>Buy</a>
                                                @endif
                                    @else
                                        <a class='btn  btn-success text-white text-center px-1' href=""><i
                                                class="fa fa-phone fa-flip-horizontal" style="color:white"></i>
                                            Call</a>
                                        <a href="{{ route('user.message') }}"
                                            class='btn btn-sm btn-info text-white text-center px-1' href=""><i
                                                class="fa fa-paper-plane"></i>Chat</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                @foreach ($fastAds as $fastAd)
                    <div class="col-6 col-sm-6 w-100 position-relative p-5">
                        <div class="w-100 position-relative ab p-2 shadow-bb rounded">
                            <div class="position-relative">
                                <a class="w-100" href="{{ route('post_details', $fastAd->slug) }}">
                                    <img class="lazyload w-100 mh-300"
                                        src="{{ asset('upload/images/product/thumb/default.jpg') }}"
                                        data-src="{{ asset('upload/images/product/thumb/' . $fastAd->feature_image) }}"
                                        alt="{{ $fastAd->title }}">
                                </a>
                            </div>
                            <div class="ppb-5 overflow-hidden h-100">
                                <a href="{{ route('post_details', $fastAd->slug) }}">
                                    <h4 class="font-weight-bold bt py-1 title" title="{{ $fastAd->title }}">
                                        {{ $fastAd->title }}</h4>
                                </a>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        @if ($fastAd->membership_ribbon)
                                            <div class="d-flex align-items-center">
                                                <img class="lazyload mr-1" width="20"
                                                    src="{{ asset('upload/images/membership/' . $fastAd->membership_ribbon) }}">
                                                <p class="bt">{{ $fastAd->membership_name }}</p>
                                            </div>
                                        @endif
                                        <p class="bt" title="{{ $fastAd->state_name }}">
                                            {{ $fastAd->state_name }}</p>
                                        <p class="bt hidden-xs" title="{{ $fastAd->category_name }}">
                                            {{ $fastAd->category_name }}
                                            ({{ $fastAd->sale_type ? $fastAd->sale_type : $fastAd->post_type }})
                                        </p>
                                    </div>
                                    @if ($fastAd->ribbon)
                                        <img width="25" class="lazyload"
                                            src="{{ asset('upload/images/package/' . $fastAd->ribbon) }}">
                                    @endif
                                </div>

                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="font-weight-bold bt py-1">
                                        {{ Config::get('siteSetting.currency_symble') . ' ' . number_format($fastAd->price) }}
                                    </h4>
                                    <p class="bt py-1 hidden-xs">
                                        {{ Carbon\Carbon::parse($fastAd->approved ? $fastAd->approved : $fastAd->created_at)->diffForHumans() }}
                                    </p>
                                </div>
                            </div><a class="position-absolute bottom-1 hidden-md"
                                href="{{ route('user.message', [$fastAd->username, $fastAd->slug]) }}"
                                title="Message">
                                <img width="20" height="20" src="{{ asset('upload/images/sendss.svg') }}"
                                    alt="sms">
                            </a>
                        </div>

                        <div class="hidden-xs">
                            <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                @if (Auth::check() && Auth::user()->getMembership)
                                    @if (Auth::user()->getMembership->name == 'Authentic Bonik')
                                        <a class='btn  btn-success text-white text-center px-1' href=""><i
                                                class="fa fa-phone fa-flip-horizontal" style="color:white"></i>
                                            Call</a>
                                        <a href="{{ route('user.message') }}"
                                            class='btn btn-sm btn-info text-white text-center px-1' href=""><i
                                                class="fa fa-paper-plane"></i>Chat</a>

                                               @if ( $fastAd->website!=null)
                                               <a class='btn btn-sm btn-warning text-center px-1' target="_blank" href="{{ $fastAd->website }}"><i
                                                       class="fa fa-cart-plus"></i>Buy</a>
                                               @endif


                                    @else 
                                        <a class='btn  btn-success text-white text-center px-1' href=""><i
                                                class="fa fa-phone fa-flip-horizontal" style="color:white"></i>
                                            Call</a>
                                        <a href="{{ route('user.message') }}"
                                            class='btn btn-sm btn-info text-white text-center px-1' href=""><i
                                                class="fa fa-paper-plane"></i>Chat</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @elseif($index > 12)
                @php $productIndex = ($index - 5); @endphp

                @if ($productIndex < count($products))
                    @php $product = $products[$productIndex]; @endphp

                    <div class="col-6 col-sm-6 w-100 position-relative p-5">
                        <div class="w-100 bg-white position-relative rounded h-100">
                            <div class="position-relative">
                                <a class="w-100" href="{{ route('post_details', $product->slug) }}">
                                    <img class="lazyload w-100 mh-300"
                                        src="{{ asset('upload/images/product/thumb/default.jpg') }}"
                                        data-src="{{ asset('upload/images/product/thumb/' . $product->feature_image) }}"
                                        alt="{{ $product->title }}">
                                </a>
                            </div>
                            <div class="ppb-5 overflow-hidden">
                                <a class="w-100" href="{{ route('post_details', $product->slug) }}">
                                    <h4 class="font-weight-bold bt py-1 title" title="{{ $product->title }}">
                                        {{ $product->title }}</h4>
                                </a>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        @if ($product->membership_ribbon)
                                            <div class="d-flex align-items-center">
                                                <img class="lazyload mr-1" width="20"
                                                    src="{{ asset('upload/images/membership/' . $product->membership_ribbon) }}">
                                                <p class="bt">{{ $product->membership_name }}</p>
                                            </div>
                                        @endif
                                        <p class="bt">{{ $product->get_state->name ?? '' }}</p>
                                        <p class="bt hidden-xs">{{ $product->category_name ?? '' }}
                                            ({{ $product->sale_type ? $product->sale_type : $product->post_type }})
                                        </p>

                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="font-weight-bold bt py-1">
                                        {{ Config::get('siteSetting.currency_symble') . ' ' . number_format($product->price) }}
                                    </h4>
                                    <p class="bt py-1 hidden-xs">
                                        {{ Carbon\Carbon::parse($product->approved ? $product->approved : $product->created_at)->diffForHumans() }}
                                    </p>

                                </div>
                            </div>
                            <a class="position-absolute bottom-1 hidden-md"
                                href="{{ route('user.message', [$product->username, $product->slug]) }}"
                                title="Message">
                                <img width="20" height="20" src="{{ asset('upload/images/sendss.svg') }}"
                                    alt="sms">
                            </a>
                        </div>

                        <div class="hidden-xs">
                            <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                @if (Auth::check() && Auth::user()->getMembership)
                                    @if (Auth::user()->getMembership->name == 'Authentic Bonik')
                                        <a class='btn  btn-success text-white text-center px-1' href=""><i
                                                class="fa fa-phone fa-flip-horizontal" style="color:white"></i>
                                            Call</a>
                                        <a href="{{ route('user.message') }}"
                                            class='btn btn-sm btn-info text-white text-center px-1' href=""><i
                                                class="fa fa-paper-plane"></i>Chat</a>
                                                @if ( $product->website!=null)
                                                <a class='btn btn-sm btn-warning text-center px-1' target="_blank" href="{{ $product->website }}"><i
                                                        class="fa fa-cart-plus"></i>Buy</a>
                                                @endif
                                    @else 
                                        <a class='btn  btn-success text-white text-center px-1' href=""><i
                                                class="fa fa-phone fa-flip-horizontal" style="color:white"></i>
                                            Call</a>
                                        <a href="{{ route('user.message') }}"
                                            class='btn btn-sm btn-info text-white text-center px-1' href=""><i
                                                class="fa fa-paper-plane"></i>Chat</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                @if ($index == 13 && count($products) > 12)
                    @include('frontend.mobile-ads', [
                        'position' => 'mobile-ad',
                        'class' => 'col-6 col-sm-6 w-100  p-2',
                    ])
                @endif
            @endif

        @endfor
        <div class="col-lg-12">
            <div class="footer-pagection">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    @else
        <div style="text-align: center;">
            <h3>Search Result Not Found.</h3>
            <p>We're sorry. We cannot find any matches for your search term</p>
            <i style="font-size: 10rem;" class="fa fa-search"></i>
        </div>
    @endif
</div>
