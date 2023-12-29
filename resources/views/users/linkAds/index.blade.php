@extends('layouts.frontend')
@section('title', 'Link ad lists' )
@section('css')
    <link href="{{asset('assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .h-300 .dropify-wrapper {height: 300px !important;}.dropify-wrapper {height: 140px !important;}
    .h-500 .dropify-wrapper {height: 600px !important; width: 240px;}
    </style>
@endsection
@section('content')
    <div class="container bg-white mb-2 px-0">
        @include('users.inc.user_header')
        <div class="row">
            @if((new \Jenssegers\Agent\Agent())->isDesktop())
            <div class="col-12 col-md-3">
                @include('users.inc.sidebar')
            </div>@endif
            <div class="col-12 col-md-9">
                @if(count($advertisements)>0)
               
                <div class="table-responsive">
                    <table id="config-table" class="table post-list table-hover ">
                        <thead class="hidden-xs">
                            <tr>
                                <th>Banner</th>
                                <th>Ad Info</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($advertisements as $index => $ad)
                            <tr class="d-h-flex" id="item{{$ad->id}}">
                                <td>

                                    @if($ad->sideAd_image) <br/>
                                    <a target="_blank" title="sidebar image" class="w-100" href="{{asset('upload/marketing/'. $ad->sideAd_image)}}">
                                        <img width="100" src="{{asset('upload/marketing/'. $ad->sideAd_image)}}">
                                    </a>@endif
                                    @if($ad->mobile_image) <br/>
                                    <a target="_blank" title="mobile image" class="w-100" href="{{asset('upload/marketing/'. $ad->mobile_image)}}">
                                        <img width="100" src="{{asset('upload/marketing/'. $ad->mobile_image)}}">
                                    </a>@endif
                                </td>
                                <td>

                                    <a style="width: 100%;height: 150px;display: block;" target="_blank" title="desktop image"  href="{{asset('upload/marketing/'. $ad->image)}}">
                                        <img style="width: auto;height : auto;max-height: 100%;max-width: 100%;" src="{{asset('upload/marketing/'. $ad->image)}}">
                                    </a>
                                    <a target="_blank"  href="{{ $ad->redirect_url }}">
                                       {{ $ad->redirect_url }}
                                    </a>
                                    <div class="d-flex flex-column">
                                        
                                        Position: {{$ad->position}}
                                        
                                        <p>{{Config::get('siteSetting.currency_symble')}}. {{$ad->amount}}</p>
                                        
                                        <p>{{Carbon\Carbon::parse($ad->start_date)->format(Config::get('siteSetting.date_format'))}}</p>
                                        <p>Views: {{$ad->views}}</p>
                                        
                                    </div>
                                </td>
                                
                                <td class="action">
                                   <div class="status">
                                        <span class="post-status badge @if($ad->status == 'reject')  badge-danger @elseif($ad->status == 0) badge-danger @elseif($ad->status == 1) badge-success @else badge-info @endif"> @if($ad->status == 1) Active @elseif($ad->status == 0) Deactive @else  {{ $ad->status }} @endif</span>
                                        
                                    </div>
                                    <div class="actionBtn">
                                       
                                        <a href="javascript:void(0)" style="display: flex;align-items: center;" data-target="#edit" data-toggle="modal" onclick="editAd({{$ad->id}})" ><i class="fa fa-edit"></i> Edit</a> 
                                        <a href="javascript:void(0)" style="color:red;display: flex;align-items: center;" data-target="#delete" data-toggle="modal" onclick="confirmPopup({{$ad->id}})" ><i class="fa fa-trash"></i> Delete</a> 
                                    </div>                           
                                </td>
                            </tr>
                            @endforeach
                            <tr style="margin: 5px">{{$advertisements->appends(request()->query())->links()}}</tr>
                        </tbody>
                    </table>
                </div>
                @else
                <h3 class="pb-2 mb-2 border-bottom">{{Auth::user()->name}}</h3>
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
        </div>
    </div>

    <!-- update Modal -->
        <div class="modal fade" id="edit" role="dialog" style="display: none;">
            <div class="modal-dialog">
                <form action="{{route('linkAd.update')}}" enctype="multipart/form-data" method="post">
                      {{ csrf_field() }}
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Ad</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row" id="edit_form"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>        

    <div id="delete" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <h4 class="modal-title">Are you sure?</h4>
                    <p>Do you really want to delete these records? This process cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    <button type="button" value="" id="itemID" onclick="deleteItem(this.value)" data-dismiss="modal" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div> 
@endsection

@section('js')
    <script src="{{asset('assets')}}/node_modules/dropify/dist/js/dropify.min.js"></script>
    
    <script type="text/javascript">


     function confirmPopup(id) {

        document.getElementById('itemID').value = id;
     }
    function deleteItem(id) {

        var link = '{{route("linkAd.delete", ":id")}}';
        var link = link.replace(':id', id);
       
            $.ajax({
            url:link,
            method:"get",
            success:function(data){
                if(data.status){
                    $("#item"+id).hide();
                    toastr.success(data.msg);
                }else{
                    toastr.error(data.msg);
                }
            }

        });
    }

    function editAd(id) {

        var link = '{{route("linkAd.edit", ":id")}}';
        var link = link.replace(':id', id);
       
            $.ajax({
            url:link,
            method:"get",
            success:function(data){
                if(data){
                    $("#edit_form").html(data);
                     $('.dropify').dropify();
                }
            }
        });
    }

</script>
@endsection