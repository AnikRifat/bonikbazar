@extends('layouts.frontend')
@section('title', ($blog) ? $blog->title : 'not found' . ' | Blog')

@section('css')
<link rel="stylesheet" href="{{asset('frontend')}}/css/custom/blog-details.css">
@endsection
@section('content')
    @if($blog)
    <div class="breadcrumbs">
        <div class="container px-0">
            <ul class="breadcrumb-cate">
                <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="{{url('blog')}}"> Blog</a></li>
                @if($blog)<li><a href="#">{{   $blog->title}}</a></li>@endif
            </ul>
        </div>
    </div>
    
    <div class="container bg-white mb-2 py-3 px-0">
        <div class="row">
            <div class="col-12 col-md-8">
                <h3 class="pb-2 mb-2 border-bottom">{{$blog->title}}</h3>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    @if($blog->author)
                    <p class="p-2 gb w-100 bt text-center mr-2">{{$blog->author->name}}</p>
                    @endif
                    <p class="p-2 gb w-100 bt text-center mr-2">{{Carbon\Carbon::parse($blog->created_at)->format(Config::get('siteSetting.date_format'))}}</p>
                    @if($blog->get_category)
                    <p class="p-2 gb w-100 bt text-center mr-2">{{$blog->get_category->name}}</p>
                    @endif
                    @if($totalComment)
                    <p class="p-2 gb w-100 bt text-center">{{$totalComment}} Comment</p>
                    @endif
                </div>
                <img class="mw-100 w-100 h-300" src="{{asset('upload/images/blog/'. $blog->image)}}" alt="{{$blog->title}}">
                <div class="description my-3">
                    {!! $blog->description !!}
                </div>
                <div class="d-flex align-items-center">
                    <h4>Share:</h4>
                    <a href="https://www.facebook.com/sharer.php?u={{route('blog_details', $blog->slug)}}">
                        <i class="fab fa-facebook-f radius-100 p-2 mr-1"></i>
                    </a>
                    <a href="https://twitter.com/share?url={{route('blog_details', $blog->slug)}}&amp;text={!! $blog->title !!}&amp;hashtags=blog">
                        <i class="fab fa-twitter radius-100 p-2 mr-1"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{route('blog_details', $blog->slug)}}?rs={{$blog->id}}">
                        <i class="fab fa-linkedin-in radius-100 p-2 mr-1"></i>
                    </a>
                    <a href="https://web.whatsapp.com/send?text={{route('blog_details', $blog->slug)}}&amp;title={!! $blog->title !!}">
                        <i class="fab fa-whatsapp radius-100 p-2 mr-1"></i>
                    </a>
                    <a href="https://pinterest.com/pin/create/button/?url={{route('blog_details', $blog->slug)}}?rs={{$blog->id}}">
                        <i class="fab fa-pinterest-p radius-100 p-2"></i>
                    </a>
                </div>
                <div class="blog-details-comment">
                    <h4 class="my-2">Comments ({{$totalComment}})</h4>
                    <div class="comment-list" id="show_comment">
                        @foreach($comments as $comment)
                            <div class="d-flex align-items-center mb-2 border-bottom py-2 border-top">
                                <a href="{{route('userProfile', $comment->author->username)}}">
                                    <img width="60" height="60" src="{{ asset('upload/users') }}/{{($comment->author->photo) ? $comment->author->photo : 'defualt.png'}}" alt="comment">
                                </a>
                                <div class="ml-2">
                                    <div class="d-flex align-items-center mb-1">
                                        <h4>{{$comment->author->name}}</h4>
                                        <span class="ml-2">{{Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</span>
                                    </div>
                                    <p id="comment{{$comment->id}}">{!! $comment->comments !!}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($totalComment > 5 )
                    <div><a href="{{route('blog_comments', $blog->slug)}}">See All Comments</a></div>
                    @endif
                    
                </div>
                <h4 class="my-2">Leave Your Comment</h4>
                <form method="post" id="commentForm">
                    @csrf
                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                    <textarea class="form-control mb-2" name="comment" id="comment" placeholder="Your Comment"></textarea>
                    <button @if(Auth::check()) type="submit" @else data-toggle="modal" data-target="#so_sociallogin" type="button" @endif  class="btn btn-inline">Drop your comment</button>
                </form>
            </div>
            <div class="col-12 col-md-4">
                @foreach($related_blogs as $related_blog)
                    <div class="w-100 p-2 mb-2">
                        <img class="mw-100 w-100" src="{{asset('upload/images/blog/thumb/'.$related_blog->image)}}" alt="{{$related_blog->title}}">
                        <span class="">{{$related_blog->get_category->name}}</span>
                    
                        @if($related_blog->author)
                        <div class="d-flex align-items-center">
                            <a href="{{route('userProfile', $related_blog->author->username)}}">
                                <img width="50" height="50" src="{{ asset('upload/users') }}/{{($related_blog->author->photo) ? $related_blog->author->photo : 'defualt.png'}}" alt="{{$related_blog->author->name}}">
                            </a>
                            <div class="ml-2">
                                <p>{{$related_blog->author->name}}</p>
                                <p>{{Carbon\Carbon::parse($related_blog->created_at)->format(Config::get('siteSetting.date_format'))}}</p>
                            </div>
                        </div>
                        @endif
                        <h4><a href="{{route('blog_details', $related_blog->slug)}}">{{Str::limit($related_blog->title, 40)}}</a></h4>
                        <p>{!! Str::limit(strip_tags($related_blog->description), 100) !!}</p>
                        <a href="{{route('blog_details', $related_blog->slug)}}" class="blog-read">
                            <span>read more</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @else
    <div class="container bg-white mb-2 py-3 px-0">
        <h3>Blog Not Found.</h3>
    </div>
    @endif
@endsection
@section('js')
<script type="text/javascript">
        $(function(){
            $("#commentForm").submit(function(event){
                event.preventDefault();
              
                $.ajax({
                        url:'{{route("blog_comment_insert")}}',
                        type:'get',
                        data:$(this).serialize(),
                        success:function(result){
                            document.getElementById("comment").value = '';
                            $("#show_comment").append(result);
                             toastr.success('Comment inserted.');
                        }

                });
            });
        }); 
</script>
@endsection
