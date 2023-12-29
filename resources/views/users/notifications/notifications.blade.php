@extends('layouts.frontend')
@section('title', 'Notifications')

@section('css')
    <link rel="stylesheet" href="{{asset('frontend')}}/css/custom/notification.css">
    <style type="text/css">
        .inbox-chat-list{overflow-y: scroll;min-height: 250px;}}
        .active{background: #25b90a1a;}
        .removeMessage{background: rgb(225 221 221 / 40%);color: #b56161;border-radius: 5px;padding: 5px;font-size: 12px;}
        .inbox-chat-form textarea{width: 95%;
    height: 50px;
    padding: 5px 45px 5px 5px;
    border: 1px solid #ccc; resize: none;}
    </style>
@endsection
@section('content')

 <section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="notify-body">
                    <div class="notify-filter">
                        <select onchange="markMotification(this.value)" class="select notify-select">
                            <option @if(Request::get('mark') == 'all') selected @endif value="all">All notification</option>
                            <option @if(Request::get('mark') == 'read') selected @endif value="read">Read notification</option>
                            <option @if(Request::get('mark') == 'unread') selected @endif value="unread">Unread notification</option>
                        </select>
                        <div class="notify-action">
                            
                            <a style="width:100%; border-radius: 5px; line-height: 28px; padding:5px;" href="{{route('readNotify')}}" title="Mark All As Read" class="fas fa-envelope-open"> Mark Read</a>
                            <!-- <a href="#" title="Notification Setting" class="fas fa-cog"></a> -->
                        </div>
                    </div>
                    <ul class="notify-list">
                        @if(count($notifications )>0)
                        @foreach($notifications as $notification)
                        @if($notification->type == 'post')
                        @if($notification->product)
                            <li class="notify-item @if($notification->read == 0) active @endif">
                                <a onclick="readNotify('{{$notification->id}}')" href="{{route('post_details', $notification->product->slug)}}" class="notify-link">
                                    <div class="notify-img">
                                        <img src="{{asset('upload/images/product/thumb/'. $notification->product->feature_image)}}" alt="avatar">
                                    </div>
                                    <div class="notify-content">
                                        <p class="notify-text">@if($notification->user)<span>{{$notification->user->name}}: </span>@endif<span>{{$notification->notify}}</span>  {{Str::limit($notification->product->title, 25)}}</p>
                                        <span class="notify-time">{{Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}</span>
                                    </div> 
                                </a>
                            </li>
                        @endif
                        @elseif($notification->type == 'package')
                            <li class="notify-item @if($notification->read == 0) active @endif">
                                <a onclick="readNotify('{{$notification->id}}')" href="{{route('user.packageHistory')}}#{{$notification->item_id}}" class="notify-link">
                                    <div class="notify-img">
                                         <img src="https://img.favpng.com/19/10/20/blue-computer-icon-area-symbol-png-favpng-Rsn1G41w4PgR3fpkZntM1wVrZ.jpg" alt="avatar">
                                    </div>
                                    <div class="notify-content">
                                        <p class="notify-text"> {{$notification->notify}} </p>
                                        <span class="notify-time">{{Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}</span>
                                    </div>
                                </a>
                            </li>
                            @elseif($notification->type == 'userStatus')
                            <li class="notify-item @if($notification->read == 0) active @endif">
                                <a onclick="readNotify('{{$notification->id}}')" href="{{route('verifyAccount')}}#{{$notification->item_id}}" class="notify-link">
                                    <div class="notify-img">
                                         <img src="https://img.favpng.com/19/10/20/blue-computer-icon-area-symbol-png-favpng-Rsn1G41w4PgR3fpkZntM1wVrZ.jpg" alt="">
                                    </div>
                                    <div class="notify-content">
                                        <p class="notify-text"> {{$notification->notify}} </p>
                                        <span class="notify-time">{{Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}</span>
                                    </div>
                                </a>
                            </li>
                        @elseif($notification->type == 'register'){
                            <li class="notify-item @if($notification->read == 0) active @endif">
                            <a href="{{route('user.dashboard')}}" class="notify-link">
                                <div class="notify-img">
                                    <img src="{{ asset('frontend/images/post.png') }}" alt="avatar">
                                </div>
                                <div class="notify-content">
                                    <p class="notify-text"><span>{{$notification->notify}}</span></p>
                                    <span class="notify-time">{{Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}</span>
                                </div>
                            </a>
                        </li>
                        }
                        @else

                        @endif
                        @endforeach
                        @else
                        <h3>No notification found.</h3>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection   

@section('js') 
      <script type="text/javascript">
          function markMotification(read) {
           if (read != undefined && read != null) {
                window.location = '{{route("allNotifications")}}?mark=' + read;
            }
          }
      </script>
@endsection    