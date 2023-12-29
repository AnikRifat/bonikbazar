@php
    $user = App\User::with(["getMembership:slug,ribbon", "sellerVerify:seller_id,shop_name"])->find(Auth::id());
    $follower = App\Models\FavoriteSeller::where('follower_id', $user->id)->count();

    $following = App\Models\FavoriteSeller::where('user_id', $user->id)->count();
    $liked = App\Models\Wishlist::join("products", "products.id", "wishlists.product_id")->where('products.user_id', $user->id)->count();
@endphp
    
    @if($user->cover_photo || $user->getMembership)
    <div style="position: relative;">
        <span title="Change cover photo" data-toggle="modal" data-target="#user_coverImageModal" class="uploadIcon" ><i class="fa fa-camera"></i></span>

        <img class="lazyload mw-100 h-300" style="width:100%" src="{{ asset('upload/users')}}/{{ ($user->cover_photo) ? $user->cover_photo : 'default-banner.png' }}" alt="">
    </div>
    @endif
    <div class="row @if($user->cover_photo || $user->getMembership) mt4 @endif" style="margin-bottom: 15px; border-bottom: 1px solid #ccc; padding-bottom: 15px;">

        <div class="col-md-6 d-flex align-items-end">
            <div style="position: relative;margin-top: 10px;">
            <span  data-toggle="modal" title="Change profile photo" data-target="#user_imageModal" class="uploadIcon" ><i class="fa fa-camera"></i></span>

            <img class="by2 w-150 rounded mr-2 bg-white" src="{{ asset('upload/users') }}/{{($user->photo) ? $user->photo : 'default.png'}}">
            </div>
            <div>
                @if($user->getMembership && $user->sellerVerify)
                <div class="d-flex align-items-center">
                    <h3 class="bt">{{$user->sellerVerify->shop_name}} <img class="lazyload" width="25" src="{{ asset('upload/images/membership/'. $user->getMembership->ribbon)}}"></h3>
                </div>

                @else
                <h3>{{$user->name}}</h3>
                @endif
                Bonik ID: {{$user->seller_id}}
               <p>Member Since {{Carbon\Carbon::parse($user->created_at)->format(Config::get('siteSetting.date_format'))}}</p>
                
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-end">
            <div>
            <div style="display: flex; gap: 10px; margin-bottom: 15px;justify-content: end;">
                <a class="btnSetting" href="{{route('user.myAccount')}}">Account <br/> Setting</a>
                @if($user->getMembership)
                <a class="btnSetting" href="{{route('user.message')}}"><img width="20" height="20" src="{{ asset('upload/images/sms.png')}}" alt="sms"> Chat</a>
                @else
                <a href="{{route('verifyAccount')}}" class="btnSetting" style="background: #f9ef6b;">Become <br> A Member</a> @endif
            </div>
            <div style="display: flex; gap: 10px;">
                <div class="btn_box"><span class="count_box">{{ $liked }}</span> Liked Post</div>
                @if($user->getMembership)
                <div class="btn_box"> <span class="count_box">{{ $follower }}</span> Follower</div>
                <div class="btn_box"><span class="count_box">{{ $following }}</span> Following</div>
                @else
                <a class="btnSetting" href="#"><img width="20" height="20" src="{{ asset('upload/images/sms.png')}}" alt="sms"> Support</a>
                @endif

            </div>
            </div>
        </div>
    </div>

