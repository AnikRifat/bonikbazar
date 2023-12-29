@extends('layouts.frontend')
@section('title', 'Profile | '. Config::get('siteSetting.site_name') )
@section('css')

<style type="text/css">

</style>
@endsection
@section('content')

    @if($user->sellerVerify)
    <div class="container bg-white p-0 pb-3 mb-2">
        <div style="position: relative;">
        <span title="Change cover photo" data-toggle="modal" data-target="#user_coverImageModal" class="uploadIcon" ><i class="fa fa-camera"></i></span>

        <img class="lazyload mw-100 h-300" src="{{ asset('upload/users/'.$user->cover_photo)}}"></div>
        <div class="row mt4">
            <div class="col-md-6 d-flex align-items-end">
                <div style="position: relative;">
                <span  data-toggle="modal" title="Change profile photo" data-target="#user_imageModal" class="uploadIcon" ><i class="fa fa-camera"></i></span>

                <img class="by2 w-150 rounded mr-2 bg-white" src="{{ asset('upload/users') }}/{{($user->photo) ? $user->photo : 'default.png'}}">
                </div>
                <div>
                    <h3>{{$user->name}}</h3>
                    <div class="d-flex align-items-center">
                         @if($user->getMembership)
                            <img class="lazyload" width="25" src="{{ asset('upload/images/membership/'. $user->getMembership->ribbon)}}">
                            <p class="bt">{{$user->getMembership->name}}</p>
                        @endif
                    </div>
                    <p>Member Since {{Carbon\Carbon::parse($user->created_at)->format(Config::get('siteSetting.date_format'))}}</p>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-end">
                <div style="display: flex; gap: 10px;">
                    <div class="btn_box"><span class="count_box">{{ $liked }}</span> Liked Post</div>
                    <div class="btn_box"> <span class="count_box">{{ $follower }}</span> Follower</div>
                    <div class="btn_box"><span class="count_box">{{ $following }}</span> Following</div>
                </div>
            </div>
        </div>
    </div>
    <div class="container bg-white px-0 py-2 mb-3">
        <div class="row">
            <div class="col-md-4 col-12">
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <p class="mr-2">Bonik ID: </p>
                    <b>{{$user->seller_id}}</b>
                </div>
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <p class="mr-2">Published: </p>
                    <b>{{$posts->total()}} Ads</b>
                </div>
                @if($user->mobile)
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <img width="25" height="25" class="mr-2" src="{{ asset('upload/images/phones.png')}}" alt="logo">
                    <b>{{$user->mobile}}</b>
                </div>
                @endif
                @if($user->email)
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <img width="25" height="25" class="mr-2" src="{{ asset('upload/images/envelope.png')}}" alt="logo">
                    <b>support@bonikbazar.com <br>
                        <p class="font-weight-normal">via BonikBazar</p>
                    </b>
                </div>
                @endif
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <img width="25" height="25" class="mr-2" src="{{ asset('upload/images/time.png')}}" alt="logo">
                    <div class="w-100">
                        @if($user->sellerVerify)
                        <div class="d-flex justify-content-between">
                            @if($user->sellerVerify->open_time <= date("H:i:s") && $user->sellerVerify->close_time >= date("H:i:s") )
                            <p>Now Open</p>
                            @else
                            <p>Closed</p>
                            @endif
                        </div>
                        <b> {{ Carbon\Carbon::parse($user->sellerVerify->open_time)->format("h:i A")}} - {{ Carbon\Carbon::parse($user->sellerVerify->close_time)->format("h:i A")}}</b>
                         @endif
                    </div>
                </div>
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <img width="25" height="25" class="mr-2" src="{{ asset('upload/images/maps.png')}}" alt="logo">
                    <b>
                        @if($user->sellerVerify->address)
                            {{$user->sellerVerify->address}}
                        @endif
                    </b>
                </div>
                @if($user->sellerVerify)
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    @if($user->sellerVerify->facebook)
                    <a href="{{$user->sellerVerify->facebook}}">
                        <img width="40" src="{{ asset('frontend/images/facebook.svg') }}">
                    </a>
                    @endif

                    @if($user->sellerVerify->website)
                    <a href="{{$user->sellerVerify->website}}">
                        <img width="40" src="{{ asset('frontend/images/web.svg') }}">
                    </a>
                    @endif

                    @if($user->sellerVerify->youtube)
                    <a href="{{$user->sellerVerify->youtube}}">
                        <img width="40" src="{{ asset('frontend/images/youtube.svg') }}">
                    </a>
                    @endif

                    @if($user->sellerVerify->instagram)
                    <a href="{{$user->sellerVerify->instagram}}">
                        <img width="40" src="{{ asset('frontend/images/instagram.svg') }}">
                    </a>
                    @endif

                    @if($user->sellerVerify->whatsapp)
                    <a href="{{$user->sellerVerify->whatsapp}}">
                        <img width="40" src="{{ asset('frontend/images/whatsapp.svg') }}">
                    </a>
                    @endif
                </div>
                @endif
                <div class="border-bottom">
                    <h4 style="font-weight:500;text-decoration: underline; ">Shop About: </h4>
                    {!! $user->sellerVerify->shop_about !!}
                </div>
            </div>
            <div class="col-md-8 col-12">
                @if(count($posts)>0)
                    <div class="hl-2">
                    @foreach($posts as $index => $post)
                    <div class="w-100 ab p-2 mb-2 position-relative">
                        <a class="w-100" href="{{ route('post_details', $post->slug) }}">
                            <div class="position-relative">
                                
                                
                                <img class="lazyload w-100" src="{{ asset('upload/images/product/thumb/default.jpg')}}" data-src="{{asset('upload/images/product/thumb/'. $post->feature_image)}}" alt="{{$post->title}}">
                            </div>
                            <div class="w-100">
                                <h4 class="font-weight-bold bt py-1" title="">{{$post->title}}</h4>
                                
                                <div class="d-flex flex-column" style="color: #000;">
                                        
                                        <p>Price: {{Config::get('siteSetting.currency_symble')}}. {{$post->price}}</p>
                                   
                                        <p>React: {{$post->reacts_count}}</p>
                                        <p>Share: {{$post->share}}</p>
                                        <p>Massage: {{$post->messages_count}}</p>
                                        <p>Report: {{$post->reports_count}}</p>
                                        <p>Date: {{Carbon\Carbon::parse(($post->approved) ? $post->approved : $post->created)->format(Config::get('siteSetting.date_format'))}}</p>
                                        <p>Views: {{$post->views}}</p>
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
                    <h1>Posts not found.!</h1>
                @endif
            </div>
        </div>
    </div>
    @else
    <div class="container bg-white p-0 pb-3 mb-2">
        <div class="row">
            <div class="col-md-6 d-flex align-items-end">
                <div style="position: relative;margin-top: 10px;">
                <span  data-toggle="modal" title="Change cover photo" data-target="#user_imageModal" class="uploadIcon" ><i class="fa fa-camera"></i></span>

                <img class="by2 w-150 rounded mr-2 bg-white" src="{{ asset('upload/users') }}/{{($user->photo) ? $user->photo : 'default.png'}}">
                </div>
                <div>
                   <h3>{{$user->name}}</h3>
                    <p>{{$user->mobile}}</p>
                    <p>{{$user->email}}</p>
                    <p>
                    @if($user->address)
                        {{$user->address}},
                    @endif
                    @if($user->get_city)
                        {{$user->get_city->name}}, 
                    @endif @if($user->get_state)
                        {{$user->get_state->name}}
                    @endif</p>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-end">
                <div>
                <div style="display: flex; gap: 10px; margin-bottom: 25px;">
                    <a class="btnSetting" href="{{route('user.myAccount')}}">Account <br/> Setting</a>
                    <a href="{{route('verifyAccount')}}" class="btnSetting" style="background: #f9ef6b;">Become <br> A Member</a>
                </div>
                <div style="display: flex; gap: 10px;">
                    <div class="btn_box"><span class="count_box">{{ $liked }}</span> Liked Post</div>
                    <div class="btn_box"> <span class="count_box">{{ $follower }}</span> Follower</div>
                    <div class="btn_box"><span class="count_box">{{ $following }}</span> Following</div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        
        @if(count($posts)>0)
            <div class="row">
            @foreach($posts as $index => $post)
            <div class="w-100 col-md-4 col-12 mb-2 position-relative">
                <div class="bg-white" style="padding: 10px">
                <a class="w-100  "  href="{{ route('post_details', $post->slug) }}">
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
            </div>
            @endforeach
            </div>
            {{$posts->appends(request()->query())->links()}}
        @else
            <h1>Posts not found.!</h1>
        @endif
        
    </div>
    @endif

    <div class="modal fade" id="reportModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>User report</h4>
                    <button class="fa fa-times" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('sellerReport')}}" method="post">
                        @csrf()
                        <input type="hidden" name="seller_id" value="{{$user->id}}">
                        <div id="reportForm"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection  

@section('js')
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
                    $('#follower').html(data.msg);
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
                type:'user'
            },
            success:function(data){
                if(data){
                    $('#reportForm').html(data);
                }
            }
        });
    }


    @endif
</script>   
@endsection     
    


