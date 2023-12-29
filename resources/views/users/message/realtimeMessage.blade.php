<li class="safety_tip">
    <h4>Safety Tips</h4>
    {!! App\Models\SiteSetting::where('type', 'safety_tip')->first()->value !!}
</li>
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