@extends('layouts.frontend')
@section('title', 'Dashboard')
@section('css')

@endsection
@section('content')
    <div class="container bg-white mb-2 px-0">
        @include('users.inc.user_header')
        <div class="row">
            @if((new \Jenssegers\Agent\Agent())->isDesktop())
            <div class="col-12 col-md-3">
                @include('users.inc.sidebar')
            </div>@endif
            <div class="col-12 col-md-9 px-0">
                
                @if(count($posts)>0)
                    <div class="row">
                    @foreach($posts as $index => $post)
                    <div class="w-100 col-md-4 col-6 mb-2 position-relative">
                        <a class="w-100 bg-white shadow-bb rounded p-2"  href="{{ route('post_details', $post->slug) }}">
                            <div class="position-relative">
                                <img class="lazyload w-100" src="{{ asset('upload/images/product/thumb/default.jpg')}}" data-src="{{asset('upload/images/product/thumb/'. $post->feature_image)}}" alt="{{$post->title}}">
                            </div>
                            <div class="w-100">
                                <h4 class="font-weight-bold bt py-1" title="">{{$post->title}}</h4>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="bt ">{{$post->get_state->name ?? ''}}</p>
                                        <p class="bt ">{{$post->get_subcategory->name ?? ''}} ({{($post->sale_type) ? $post->sale_type : $post->post_type}})</p>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="font-weight-bold bt py-1">{{Config::get('siteSetting.currency_symble') . $post->price}}</h4>
                                    <p class="bt py-1">{{Carbon\Carbon::parse($post->created_at)->format(Config::get('siteSetting.date_format'))}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    </div>
                    {{$posts->appends(request()->query())->links()}}
                @else
                <div class="my-5 pt-md-5">
                    <div class="d-flex justify-content-center align-items-center">
                        <img width="95" height="63" src="https://w.bikroy-st.com/dist/img/all/shop/empty-1x-6561cc5e.png">
                        <div class="ml-3 text-center">
                            <h4>You don't have any ads yet.</h4>
                            <p>Click the "Post an ad now!" button to post your ad.</p>
                        </div>
                    </div>
                    <p class="d-flex justify-content-center align-items-end my-5">
                        <img height="56" src="{{asset('upload/images/as.jpg')}}">
                        <a class="yb p-2 text-center bt bb2 rounded font-weight-bold f-12 mx-3 mb-n3" href="{{route('post.create')}}">Post your ad now!</a>
                        <img height="56" style="-webkit-transform: scaleX(-1);transform: scaleX(-1);" src="{{asset('upload/images/as.jpg')}}">
                    </p>
                </div>
                @endif
              
            </div>
            <!--Middle Part End-->
        </div>
    </div>
    
@endsection     
@section('js')

@endsection     


