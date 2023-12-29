@extends('layouts.frontend')
@section('title', 'Wishtlist | '. Config::get('siteSetting.site_name') )
@section('css')

@endsection
@section('content')
<!-- Main Container  -->
<div class="container bg-white mb-2 px-0">
    @include('users.inc.user_header')
    <div class="row">
        @if((new \Jenssegers\Agent\Agent())->isDesktop())
        <div class="col-12 col-md-3">
            @include('users.inc.sidebar')
        </div>@endif
        <div class="col-12 col-md-9">
        <h3 class="mb-2">My Wish List</h3>
        @if(count($wishlists)>0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td class="text-center">Image</td>
                            <td class="text-left">Post Name</td>
                            <td class="text-right">Price</td>
                            <td class="text-right">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($wishlists as $wishlist)
                            <tr id="item{{$wishlist->id}}">
                                <td class="text-center">
                                    @if($wishlist->get_product !== null)
                                    <a href="{{route('post_details', $wishlist->get_product->slug)}}"><img src="{{asset('upload/images/product/thumb/'. $wishlist->get_product->feature_image)}}" width="48" height="40" class="img-thumbnail"></a>
                                    @endif
                                </td>
                                <td class="text-left">
                                    @if($wishlist->get_product !== null)
                                    <a href="{{route('post_details', $wishlist->get_product->slug)}}">{{Str::limit($wishlist->get_product->title, 30)}}</a>
                                    @endif
                                </td>
                                <td class="text-right">
                                    @if($wishlist->get_product !== null)
                                    <div class="price">{{Config::get('siteSetting.currency_symble') . $wishlist->get_product->price}} </div>
                                    @endif
                                </td>
                                <td class="text-right">

                                    <a href="#" onclick="deleteConfirmPopup('{{route("wishlist.remove", $wishlist->id)}}')" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Remove"><i class="fa fa-times"></i></a></td>
                            </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
            <div class="buttons clearfix">
                <div class="pull-right"><a href="{{url('/')}}" class="btn btn-primary">Continue</a></div>
            </div>
        @else
            <div style="text-align: center;">
                <i style="font-size: 80px;" class="fa fa-heart"></i>
                <h1>Your wishlist is empty.</h1>
                <p>Looks line you have no items in your wishlist list.</p>
                Click here <a href="{{url('/')}}">Continue Shopping</a>
            </div>
        @endif
        </div>
    </div>

</div>
@include('users.modal.delete-modal')
<!-- //Main Container -->
@endsection



