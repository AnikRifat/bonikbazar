@extends('layouts.frontend')
@section('title', $user->name. ' | Profile')
@section('css')
<style type="text/css">
    .open_time{color: green}
    .close_time{color: red}
</style>
@endsection
@section('content')

    @if($user->getMembership)
    <div class="container bg-white p-0 pb-3 mb-2">
        <div>
            @if($user->cover_photo)
            <div style="position: relative;">
                <img class="lazyload mw-100 h-300" style="width:100%" src="{{ asset('upload/users/'.$user->cover_photo)}}">
            </div>
            @endif
            <div class="row mt4"> 
                <div class="col-md-6 col-12 d-flex align-items-end mb-2">
                    <img class="by2 w-150 rounded mr-2 bg-white" src="{{ asset('upload/users') }}/{{($user->photo) ? $user->photo : 'default.png'}}">
                    <div>
                        <h3>{{$user->sellerVerify->shop_name}}</h3>
                        <div class="hidden-xs">
                            @if($user->getMembership)
                            <div class="d-flex align-items-center">
                                <img class="lazyload" width="25" src="{{ asset('upload/images/membership/'. $user->getMembership->ribbon)}}">
                                <p class="bt">{{$user->getMembership->name}}</p>
                            </div>
                            @endif
                            <p>Member Since {{Carbon\Carbon::parse($user->created_at)->format(Config::get('siteSetting.date_format'))}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-end align-items-end">
                    <div class="hidden-xs">
                        <a
                        @if(Auth::check())
                            onclick="report({{$user->id}})" data-toggle="tooltip"
                        @else
                            data-toggle="modal" data-target="#so_sociallogin"
                        @endif
                        class="btn py-1 px-4 e6 text-red bb2 rounded shadow-bb font-weight-bold" href="javascript:void(0)">Report</a>
                        <a
                        @if(Auth::check())
                            onclick="follower({{$user->id}})"
                        @else
                            data-toggle="modal" data-target="#so_sociallogin"
                        @endif
                        class="btn user-f" id="follower" href="javascript:void(0)">
                            @if(Auth::check() && App\Models\FavoriteSeller::where('user_id', Auth::id())->where('follower_id', $user->id)->first())
                            <div class="followy">Unfollow</div>
                            @else
                            <div class="follow">Follow</div>
                            @endif
                        </a>
                    </div>
                   
                </div>
            </div>
        </div>
        <div class="d-md-none">
            <div class="row">
                <div class="col-6">
                    <div class="d-flex align-items-center">
                        <p class="mr-2">Bonik ID: </p>
                        <b>{{$user->seller_id}}</b>
                    </div>
                    @if($user->getMembership)
                    <div class="d-flex align-items-start">
                        <img class="lazyload" width="25" src="{{ asset('upload/images/membership/'. $user->getMembership->ribbon)}}">
                        <div>
                            <p class="bt">{{$user->getMembership->name}}</p>
                            <p>Member Since {{Carbon\Carbon::parse($user->created_at)->format(Config::get('siteSetting.date_format'))}}</p>
                        </div>
                        
                    </div>
                    @endif
                    <div class="d-flex align-items-center pb-2">
                        <img width="25" height="25" class="mr-2" src="{{ asset('upload/images/time.png')}}" alt="logo">
                        <div class="w-100">
                            @if($user->sellerVerify)
                           
                            <div class="d-flex justify-content-between">
                                @if($user->sellerVerify->open_time <= date("H:i:s") && $user->sellerVerify->close_time >= date("H:i:s") )
                                <p class="open_time">Now Open</p>
                                @else
                                <p class="close_time">Closed</p>
                                @endif
                            </div>
                            <b>
                                {{ Carbon\Carbon::parse($user->sellerVerify->open_time)->format("h:i A")}} - {{ Carbon\Carbon::parse($user->sellerVerify->close_time)->format("h:i A")}}</b>
                             @endif
                        </div>
                    </div>
                    <div class="d-flex align-items-center pb-2">
                        <img width="25" height="25" class="mr-2" src="{{ asset('upload/images/maps.png')}}" alt="logo">
                        <b>
                            @if($user->sellerVerify->address)
                                {{$user->sellerVerify->address}}
                            @endif
                        </b>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex align-items-center justify-content-end">
                        <a
                            @if(Auth::check())
                                onclick="report({{$user->id}})" data-toggle="tooltip"
                            @else
                                data-toggle="modal" data-target="#so_sociallogin"
                            @endif
                            class="btn py-1 px-4 e6 text-red bb2 rounded shadow-bb font-weight-bold" href="javascript:void(0)">Report
                        </a>
                        <a
                            @if(Auth::check())
                                onclick="follower({{$user->id}})"
                            @else
                                data-toggle="modal" data-target="#so_sociallogin"
                            @endif
                            class="btn user-f" id="follower" href="javascript:void(0)">
                                @if(Auth::check() && App\Models\FavoriteSeller::where('user_id', Auth::id())->where('follower_id', $user->id)->first())
                                <div class="followy">Unfollow</div>
                                @else
                                <div class="follow">Follow</div>
                                @endif
                        </a>
                    </div>
                     @if($user->sellerVerify)
                        <div class="d-flex align-items-center">
                            @if($user->sellerVerify->facebook)
                            <a href="{{$user->sellerVerify->facebook}}"> <img width="45" src="{{ asset('frontend/images/facebook.svg') }}"> </a>@endif
        
                            @if($user->sellerVerify->website)
                            <a href="{{$user->sellerVerify->website}}"> <img width="45" src="{{ asset('frontend/images/web.svg') }}">  </a>@endif
        
                            @if($user->sellerVerify->youtube)
                            <a href="{{$user->sellerVerify->youtube}}"> <img width="45" src="{{ asset('frontend/images/youtube.svg') }}"> </a>@endif
        
                            @if($user->sellerVerify->instagram)
                            <a href="{{$user->sellerVerify->instagram}}"> <img width="45" src="{{ asset('frontend/images/instagram.svg') }}"> </a>@endif
        
                            @if($user->sellerVerify->whatsapp)
                            <a href="{{$user->sellerVerify->whatsapp}}"> <img width="45" src="{{ asset('frontend/images/whatsapp.svg') }}"> </a>@endif
                        </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container bg-white px-0 py-2 mb-3">
        <div class="row">
            <div class="col-md-4 col-12 hidden-xs">
                <div class=" order-bottom pb-2 mb-2">
                    <div class="d-flex align-items-center">
                        <p class="mr-2">Bonik ID: </p>
                        <b>{{$user->seller_id}}</b>
                    </div>
                    {{ $follower }} Follower
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
                    <a href="mailto:support@bonikbazar.com" target="_blank"><b class="bt">via BonikBazar</b></a>
                </div>
                @endif
                <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                    <img width="25" height="25" class="mr-2" src="{{ asset('upload/images/time.png')}}" alt="logo">
                    <div class="w-100">
                        @if($user->sellerVerify)
                       
                        <div class="d-flex justify-content-between">
                            @if($user->sellerVerify->open_time <= date("H:i:s") && $user->sellerVerify->close_time >= date("H:i:s") )
                            <p class="open_time">Now Open</p>
                            @else
                            <p class="close_time">Closed</p>
                            @endif
                        </div>
                        <b>
                            {{ Carbon\Carbon::parse($user->sellerVerify->open_time)->format("h:i A")}} - {{ Carbon\Carbon::parse($user->sellerVerify->close_time)->format("h:i A")}}</b>
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
                    <a href="{{$user->sellerVerify->facebook}}"> <img width="45" src="{{ asset('frontend/images/facebook.svg') }}"> </a>@endif

                    @if($user->sellerVerify->website)
                    <a href="{{$user->sellerVerify->website}}"> <img width="45" src="{{ asset('frontend/images/web.svg') }}">  </a>@endif

                    @if($user->sellerVerify->youtube)
                    <a href="{{$user->sellerVerify->youtube}}"> <img width="45" src="{{ asset('frontend/images/youtube.svg') }}"> </a>@endif

                    @if($user->sellerVerify->instagram)
                    <a href="{{$user->sellerVerify->instagram}}"> <img width="45" src="{{ asset('frontend/images/instagram.svg') }}"> </a>@endif

                    @if($user->sellerVerify->whatsapp)
                    <a href="{{$user->sellerVerify->whatsapp}}"> <img width="45" src="{{ asset('frontend/images/whatsapp.svg') }}"> </a>@endif
                </div>
                @endif
                <div>
                    <h4 style="font-weight:500;text-decoration: underline; ">Shop About: </h4>
                    {!! $user->sellerVerify->shop_about !!}
                </div>
            </div>
            <div class="col-md-8 col-12">
                @if(count($posts)>0)
                    <div class="row">
                    @foreach($posts as $index => $post)
                    <div class="col-6 col-md-6 w-100 ab p-1 mb-2 position-relative">
                        <a class="w-100 bg-white shadow-bb p-2 rounded" href="{{ route('post_details', $post->slug) }}">
                            <div class="position-relative">
                                <img class="lazyload w-100" src="{{ asset('upload/images/product/thumb/default.jpg')}}" data-src="{{asset('upload/images/product/thumb/'. $post->feature_image)}}" alt="{{$post->title}}">
                            </div>
                            <div class="w-100 ppb-5">
                                <h4 class="font-weight-bold bt py-1" title="">{{$post->title}}</h4>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="bt hidden-xs">{{$post->get_state->name ?? ''}}</p>
                                        <p class="bt hidden-xs">{{$post->get_subcategory->name ?? ''}} ({{($post->sale_type) ? $post->sale_type : $post->post_type}})</p>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="font-weight-bold bt py-1">{{Config::get('siteSetting.currency_symble') . $post->price}}</h4>
                                    <p class="bt py-1 hidden-xs">{{Carbon\Carbon::parse($post->created_at)->format(Config::get('siteSetting.date_format'))}}</p>
                                </div>
                            </div>
                        </a>
                        <div class="hidden-xs">
                            <div class="d-flex bg-white mt-n3 flex-column">
                                <div class="d-flex align-items-center bb2 rounded shadow mx-3 bg-white">
                                    <input type="text" name="message" id="message{{$post->id}}" class="px-2 py-1 w-100 rounded" placeholder="Send message">
                                    <button @if(Auth::check()) onclick="sendMessage({{$post->id}})" @else data-target="#so_sociallogin" data-toggle="modal" @endif><img height="23" src="{{ asset('upload/images/chat2.png')}}"></button>
                                </div>
                            </div>
                        </div>
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
    <div class="container">
        <div class="container bg-white p-0 pb-3 mb-2">
            <div class="row ">
                <div class="col-md-6 d-flex align-items-end">
                    <img class="by2 w-150 rounded mr-2 bg-white" src="{{ asset('upload/users') }}/{{($user->photo) ? $user->photo : 'default.png'}}">
                    <div>
                        <h3>{{$user->name}}</h3>
                        <p>{{$user->mobile}}</p>
                        <p>{{$user->email}}</p>
                        <p>@if($user->address)
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
                        <a
                        @if(Auth::check())
                            onclick="report({{$user->id}})" data-toggle="tooltip"
                        @else
                            data-toggle="modal" data-target="#so_sociallogin"
                        @endif
                        class="btn py-1 px-4 e6 text-red bb2 rounded shadow-bb font-weight-bold" href="javascript:void(0)">Report</a>
                        <a
                        @if(Auth::check())
                            onclick="follower({{$user->id}})"
                        @else
                            data-toggle="modal" data-target="#so_sociallogin"
                        @endif
                        class="btn user-f" id="follower" href="javascript:void(0)">
                            @if(Auth::check() && App\Models\FavoriteSeller::where('user_id', Auth::id())->where('follower_id', $user->id)->first())
                            <div class="followy">Unfollow</div>
                            @else
                            <div class="follow">Follow</div>
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
        @if(count($posts)>0)
            <div class="row">
            @foreach($posts as $index => $post)
            <div class="w-100 col-md-4 col-6 mb-2 position-relative">
                <a class="w-100 bg-white shadow-bb p-1 rounded"  href="{{ route('post_details', $post->slug) }}">
                    <div class="position-relative">
                        <img class="lazyload w-100" src="{{ asset('upload/images/product/thumb/default.jpg')}}" data-src="{{asset('upload/images/product/thumb/'. $post->feature_image)}}" alt="{{$post->title}}">
                    </div>
                    <div class="w-100 ppb-5">
                        <h4 class="font-weight-bold bt py-1" title="">{{$post->title}}</h4>
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="bt hidden-xs">{{$post->get_state->name ?? ''}}</p>
                                <p class="bt hidden-xs">{{$post->get_subcategory->name ?? ''}} ({{($post->sale_type) ? $post->sale_type : $post->post_type}})</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold bt py-1">{{Config::get('siteSetting.currency_symble') . $post->price}}</h4>
                            <p class="bt py-1 hidden-xs">{{Carbon\Carbon::parse($post->created_at)->format(Config::get('siteSetting.date_format'))}}</p>
                        </div>
                    </div>
                </a>
                <div class="hidden-xs">
                    <div class="d-flex mt-n3 flex-column">
                        <div class="d-flex align-items-center bb2 rounded shadow mx-3 bg-white">
                            <input type="text" name="message" id="message{{$post->id}}" class="px-2 py-1 w-100 rounded" placeholder="Send message">
                        <button @if(Auth::check()) onclick="sendMessage({{$post->id}})" @else data-target="#so_sociallogin" data-toggle="modal" @endif><img height="23" src="{{ asset('upload/images/chat2.png')}}"></button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            @endforeach
            </div>
            {{$posts->appends(request()->query())->links()}}
        @else
            <h1>Posts not found.!</h1>
        @endif
        </div>
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

    function sendMessage(product_id){
    
    var message = $('#message'+product_id).val();
   
      $.ajax({
        url:'{{route("user.sendMessage")}}',
        type:'post',
        data:{productOrConId:product_id,message:message,'_token':'{{ csrf_token() }}'},
        success:function(data){
            if(data){
                $('#message'+product_id).val('');
                toastr.success('Message send success.');
            }else{
                toastr.error('Message send failad.');
            }
          }
      });
    }
    @endif
</script>   
@endsection     
    


