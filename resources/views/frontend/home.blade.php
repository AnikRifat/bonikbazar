@extends('layouts.frontend')
@section('title', Config::get('siteSetting.title'))
@section('metatag')
    <title>{{Config::get('siteSetting.title')}}</title>
    <meta name="title" content="{{Config::get('siteSetting.title')}}">
    <meta name="description" content="{{Config::get('siteSetting.description')}}">
    <meta name="keywords" content="{{Config::get('siteSetting.meta_keywords')}}" />
    <meta name="robots" content="index,follow" />

    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta property="og:title" content="{{Config::get('siteSetting.title')}}">
    <meta property="og:description" content="{{Config::get('siteSetting.description')}}">
    <meta property="og:image" content="{{asset('upload/images/'.Config::get('siteSetting.meta_image'))}}">
    <meta property="og:url" content="{{ url()->full() }}">
    <meta property="og:site_name" content="{{Config::get('siteSetting.site_name')}}">
    <meta property="og:locale" content="bd">
    <meta property="og:type" content="e-commerce">
    <!-- Schema.org for Google -->

    <meta itemprop="title" content="{{Config::get('siteSetting.title')}}">
    <meta itemprop="description" content="{{Config::get('siteSetting.description')}}">
    <meta itemprop="image" content="{{asset('upload/images/'.Config::get('siteSetting.meta_image'))}}">

    <!-- Twitter -->
    <meta name="twitter:card" content="{{Config::get('siteSetting.title')}}">
    <meta name="twitter:title" content="{{Config::get('siteSetting.title')}}">
    <meta name="twitter:description" content="{{Config::get('siteSetting.description')}}">
    <meta name="twitter:site" content="{{url('/')}}">
    <meta name="twitter:creator" content="@bonik">
    <meta name="twitter:image:src" content="{{asset('upload/images/'.Config::get('siteSetting.meta_image'))}}">
    <meta name="twitter:player" content="#">
    <style>.home{display: none;}</style>
@endsection

@section('content')
@php
    $get_ads = App\Models\Addvertisement::whereIn('page', ['/', 'all'])->inRandomOrder()->where('status', 1)->get();

    $topOfContent = $middleOfContent = $bottomOfContent = $sitebarTop = $sitebarMiddle = $sitebarBottom = null ;
    foreach ($get_ads as $ads){
        if($ads->position == 'top-content'){
            $topOfContent = ($ads->adsType == 'image') ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }elseif($ads->position == 'middle-content'){
            $middleOfContent = ($ads->adsType == 'image') ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }elseif($ads->position == 'bottom-content'){
            $bottomOfContent = ($ads->adsType == 'image') ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code;
        }elseif($ads->position == 'sidebar-top'){
            $sitebarTop = '<div class="sidebar">'. ($ads->adsType == 'image' ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code) . '</div>';
        }elseif($ads->position == 'sidebar-middle'){
            $sitebarMiddle = '<div class="sidebar">'. ($ads->adsType == 'image' ? '<a  href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code) . '</div>';
        }elseif($ads->position == 'sidebar-bottom'){
            $sitebarBottom = '<div class="sidebar">'. ($ads->adsType == 'image' ? '<a href="'.$ads->redirect_url.'"><img src="'.asset('upload/marketing/'.$ads->image).'" alt=""></a>' : $ads->add_code) . '</div>' ; 
        }else{
            echo '';
        }
    }
    @endphp
<div class="">
    <div class="container px-0">
        <div class="advertising">
            {!! $topOfContent !!}
        </div>
        <div class="row">
            <div class="col-md-3 px-0 d-flex flex-column justify-content-between hidden-xs">
                <div>
                    <div class="accordion w-100" id="accordion">
                        <div class="bg-white mb-3">
                            <div class="bb p-2" role="tab" id="headingOne">
                                <div class="w-100 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseOne">
                                    <div class="d-flex align-items-center">
                                        <img width="15" class="mr-1" src="{{ asset('upload/images/group.png')}}" alt="group">
                                        <h4 class="yt">Filter by</h4>
                                    </div>
                                    <img width="15" src="{{ asset('upload/images/vector.png')}}" alt="vector">
                                </div>
                            </div>
                    
                            <div id="collapseOne" class="collapse show p-2" role="tabpanel" aria-labelledby="headingOne">
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Urgent</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Featured</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Member Bonik</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Verified Bonik</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Dealers Bonik</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Agent Bonik</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Wholesale Bonik</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white mb-3">
                            <div class="bb p-2" role="tab" id="headingOne">
                                <div class="w-100 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseOne">
                                    <div class="d-flex align-items-center">
                                        <img class="mr-1" src="{{ asset('upload/images/group.png')}}" alt="group">
                                        <h4 class="yt">Filter by</h4>
                                    </div>
                                    <img class="" src="{{ asset('upload/images/vector.png')}}" alt="vector">
                                </div>
                            </div>
                    
                            <div id="collapseOne" class="collapse show p-2" role="tabpanel" aria-labelledby="headingOne">
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Urgent</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Featured</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Member Bonik</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Verified Bonik</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Dealers Bonik</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Agent Bonik</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="Urgent" id="Urgent">
                                    <label class="iy" for="Urgent">Wholesale Bonik</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white mb-3">
                            <div class="bb p-2" role="tab" id="heading3">
                                <div class="w-100 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapse3">
                                    <div class="d-flex align-items-center">
                                        <img class="mr-1" src="{{ asset('upload/images/group.png')}}" alt="group">
                                        <h4 class="yt">Filter by</h4>
                                    </div>
                                    <img class="" src="{{ asset('upload/images/vector.png')}}" alt="vector">
                                </div>
                            </div>
                    
                            <div id="collapse3" class="collapse show p-2" role="tabpanel" aria-labelledby="heading3">
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="bg-white mb-3 p-2">
                    <img class="w-100 mw-100" src="{{ asset('upload/images/banner.png')}}" alt="banner">
                </div>
                <div>
                    <div class="accordion w-100" id="accordion">
                        <div class="bg-white mb-3">
                            <div class="bb p-2" role="tab" id="heading4">
                                <div class="w-100 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapse4">
                                    <div class="d-flex align-items-center">
                                        <img class="mr-1" src="{{ asset('upload/images/group.png')}}" alt="group">
                                        <h4 class="yt">Filter by</h4>
                                    </div>
                                    <img class="" src="{{ asset('upload/images/vector.png')}}" alt="vector">
                                </div>
                            </div>
                    
                            <div id="collapse4" class="collapse show p-2" role="tabpanel" aria-labelledby="heading4">
                            </div>
                        </div>
                        
                        <div class="bg-white mb-3">
                            <div class="bb p-2" role="tab" id="heading5">
                                <div class="w-100 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapse5">
                                    <div class="d-flex align-items-center">
                                        <img class="mr-1" src="{{ asset('upload/images/group.png')}}" alt="group">
                                        <h4 class="yt">Filter by</h4>
                                    </div>
                                    <img class="" src="{{ asset('upload/images/vector.png')}}" alt="vector">
                                </div>
                            </div>
                    
                            <div id="collapse5" class="collapse show p-2" role="tabpanel" aria-labelledby="heading5">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-12">
                <div class="homepage" >
                    <div id="loadProducts">
                        <!-- Load products here -->
                    </div>
                    <div class="ajax-load text-center" id="data-loader">
                        <img src="{{asset('frontend/images/loading.gif')}}">
                    </div>
                </div>
            </div>
            <div class="col-md-2 hidden-xs p-0 bg-white mb-3">
                <div class="advertising w-100 sticky-top">
                {!! $sitebarTop !!} </div>
        </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="advertising">
                    {!! $bottomOfContent !!}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        var page = 1;
        loadMoreProducts(page);
        function loadMoreProducts(page){
            $.ajax(
                {
                    url: '?page=' + page,
                    type: "get",
                    beforeSend: function()
                    {
                        $('.ajax-load').show();
                    }
                })
            .done(function(data)
            {
                $('.ajax-load').hide();
                $("#loadProducts").append(data.html);

                //check section last page
                if(page <= '{{$sections->lastPage()}}' ){
                    page++;
                    loadMoreProducts(page);
                }
                 
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                $('.ajax-load').hide();
            });
        }
    });
</script>
@endsection