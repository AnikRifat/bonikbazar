@php
if($conversation->sender_id == Auth::id()){
    $receiver = $conversation->receiver;
}else{
    $receiver = $conversation->sender;
}
@endphp
<div id="message-body" style="min-height: 210px;">
<div class="inbox-header">
    <div class="inbox-header-profile">
        <a onclick="userHideShow()" class="message-arrow" href="javascript:void(0)"><i class="fa fa-angle-left"></i></a>
        <a class="inbox-header-img @if($receiver && Cache::has('UserOnline-' . $receiver->id)) active @else deactive @endif" target="_blank" href="{{route('post_details',$conversation->product->slug )}}">
            <img src="{{ asset('upload/images/product/thumb/'.$conversation->product->feature_image) }}" alt="avatar">
        </a>
        <div class="inbox-header-text">
            <h5><a href="{{route('userProfile', $receiver->username)}}">{{$receiver->name}}</a></h5>
            <p><a target="_blank" href="{{route('post_details',$conversation->product->slug )}}">{{Str::limit($conversation->product->title, 45)}}</a></p>
            <span>{{Config::get('siteSetting.currency_symble') . $conversation->product->price}}</span>
        </div>
    </div>
    @if($conversation)
    <ul class="inbox-header-list">
        <li><a href="{{route('deleteAllMessage', $conversation->id)}}" title="Delete" class="fas fa-trash-alt"></a></li>
        <li><a href="javascript:void(0)" onclick="report({{$conversation->product->id}})" title="Report" class="fas fa-flag"></a></li>
        <li><a href="{{route('blockUser', $conversation->id)}}" title="{{($conversation->block_user != null) ? 'Unblock' :'Block' }} " class="fas fa-shield-alt"></a></li>
    </ul>@endif
</div>
<ul class="inbox-chat-list" id="inbox-chat-list">
    <li class="safety_tip">
        <h4>Safety Tips</h4>
        {!! App\Models\SiteSetting::where('type', 'safety_tip')->first()->value !!}
    </li>
@if($conversation && $messages)
    @foreach($messages as $message)
        @if($message->sender_id == Auth::id())
        <li class="inbox-chat-item my-chat" id="message{{$message->id}}">
            <div class="inbox-chat-content">
                @if($message->deleted_from_sender == 0)
                <div class="inbox-chat-text">
                    @if($message->image)
                    <div class="galleryBox">
                        @foreach(json_decode($message->image) as $image)
                        <a class="conversation-gallery" href="{{asset('upload/message/'.$image)}}" class="image-popup-no-margins"> <img  class="img-fluid" src="{{asset('upload/message/'.$image)}}" alt="">  </a>
                        @endforeach
                    </div>
                    @endif
                    @if($message->message)
                    <p>{!! $message->message !!}</p>@endif
                    <div class="inbox-chat-action">
                        <a href="javascript:void(0)" title="Remove" onclick= "removeMessage({{$message->id}})" class="fas fa-trash-alt"></a>
                    </div>
                </div>
                <small class="inbox-chat-time">{{Carbon\Carbon::parse($message->created_at)->diffForHumans()}}</small>
               @endif
            </div>
        </li>
        @else
        <li class="inbox-chat-item" id="message{{$message->id}}">
            <div class="inbox-chat-content">
                @if($message->deleted_from_receiver == 0)
                <div class="inbox-chat-text">
                    @if($message->image)
                    <div class="galleryBox">
                        @foreach(json_decode($message->image) as $image)
                        <a data-fancybox="gallery" class="conversation-gallery" href="{{asset('upload/message/'.$image)}}" class="image-popup-no-margins"> <img  class="img-fluid" src="{{asset('upload/message/'.$image)}}" alt="">  </a>
                        @endforeach
                    </div>
                    @endif
                    @if($message->message)
                    <p>{!! $message->message !!}</p>@endif
                    <div class="inbox-chat-action">
                        <a href="javascript:void(0)" title="Remove" onclick= "removeMessage({{$message->id}})" class="fas fa-trash-alt"></a>
                    </div>
                </div>
                <small class="inbox-chat-time">{{Carbon\Carbon::parse($message->created_at)->diffForHumans()}}</small>
                @endif
            </div>
        </li>
        @endif
    @endforeach
@else
    <li><h3>No conversation</h3></li>
@endif
</ul>
</div>
@if(isset($messageWriteBox))

<form class="inbox-chat-form" id="sendMessage" action="{{route('user.sendMessage')}}" enctype="multipart/form-data" method="post" style="display: flex; align-items: center;">
@if(!$conversation || $conversation->block_user == null)
@csrf
<input type="hidden" name="productOrConId" value="{{$conversation->id}}">
<div><label for="attachment" title="Send image" style="margin-right: 5px;font-size: 20px;cursor: pointer"><i class="fa fa-camera"></i> <input type="file" style="display:none;" name="file[]" accept="image/*" multiple id="attachment"> </label></div>
<textarea  name="message" class="message" required placeholder="Type a Message"></textarea>
<button class="sendMessage"  onclick="sendMessage('{{$conversation->id}}')" type="button"><i class="fas fa-paper-plane"></i></button>
@else
    @if($conversation->block_user == Auth::id())
        <p>You've blocked message. You can't message In this chat and you won't receive their message. <a href="{{route('blockUser', $conversation->id)}}">Unblock</a></p>
        
    @else
    <h3>You have been blocked so you can't send any message.</h3>
    @endif
@endif
</form>
@endif