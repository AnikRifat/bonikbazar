 @extends('layouts.frontend')
@section('title', 'Edit Post' )
@section('css')
<link href="{{asset('assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('assets')}}/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style>
.select2-container{z-index: 0}
.carousel-indicators li {text-indent:0;}
.carousel-item img{width: 100%}
.dropify-wrapper{height: 130px!important; margin-bottom: 15px;}
.changeBtn{color:green;margin: 5px; font-size:12px;}
.adjust-field{cursor: pointer; border: none;border-radius:0;position: absolute;top: 0;right: 0;background: #e9ecef;padding: 7px;}
</style>
@endsection
@section('content')
    <div class="container bg-white mb-2 py-3 px-0">
        <form action="{{ route('post.update',$post->id) }}" data-parsley-validate method="post" enctype="multipart/form-data" class="adpost-form">
        <input type="hidden" name="post_id" value="{{ $post->product_id}}">
        @csrf
        <div class="row">
            <div class="col-12 border-b">
                <div  style="display:flex; justify-content: space-between;">
                <div class="d-flex align-items-center mb-2">
                    <img width="60" height="60" class="rounded-3 mr-2" src="{{ asset('upload/users') }}/{{(Auth::user()->photo) ? Auth::user()->photo : 'default.png'}}" alt="user">
                    <div>
                        <h4>{{Auth::user()->name}}</h4>
                        @if(Auth::user()->getMembership)
                        <div class="d-flex align-items-center">
                        <img class="lazyload" width="25" src="{{ asset('upload/images/membership/'. Auth::user()->getMembership->ribbon)}}">
                       
                        <p class="bt">{{Auth::user()->getMembership->name}}</p></div> @endif
                    </div>
                </div>
                <div >
                <div style="margin-bottom: 5px;">
                <a href="javascript:void(0)" style="cursor: not-allowed;">
                <img width="20" class=" mr-2" src="{{ asset('upload/images/m-1.png')}}"> {{$category->name}} </a></div>
                <a href="javascript:void(0)"  style="cursor: not-allowed;">
                <img width="20" class=" mr-1" src="{{ asset('upload/images/m-2.png')}}"> {{$location->name}}@if($location->state), {{$location->state->name}} @endif </a>
                </div>
                </div>
            </div>
            
            <div class="col-12 col-md-7 pt-3 border-rr">
                
                    <div class="form-group">
                       
                        <div class="row image">

                            <div class="col-12 col-md-4">
                               
                                <input type="file" data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" name="feature_image" class="dropify" data-default-file="{{asset('upload/images/product/thumb/'.$post->feature_image)}}" @if(!$post->feature_image) required @endif  accept="image/*" >
                            </div>
                            @foreach($post->get_galleryImages as $galleryImage)

                            <div class="col-6 col-md-4 image{{$galleryImage->id}}" >

                                <div class="dropify-wrapper" onclick="removeImage('product_images', '{{$galleryImage->id}}')">
                                    <img src="{{asset('upload/images/product/gallery/'.$galleryImage->image_path)}}" style="width: 100%;">
                                    <span style="position: absolute;top: 0;right: 0; background: #fff;border: 1px solid #fff;padding: 3px;color: red;">Delete</span>
                                </div>
                            </div>
 
                            @endforeach
                            @for($i=count($post->get_galleryImages); $i<(Auth::user()->membership ? 8 : 4); $i++)
                            <div class="col-6 col-md-4">
                               <input type="file" data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" name="gallery_image[]" class="dropify" accept="image/*" >
                            </div>
                            @endfor
                        </div>
                    </div>
                
                <!--<div class="d-flex flex-wrap">-->
                <!--    <div class="d-flex align-items-center mr-2">-->
                <!--        <input name="sale_type"  @if($post->sale_type == 'new') checked @endif value="new" type="radio" id="NEW" checked>-->
                <!--        <label class="iy" for="NEW">NEW</label>-->
                <!--    </div>-->
                <!--    <div class="d-flex align-items-center mr-2">-->
                <!--        <input name="sale_type" @if($post->sale_type == 'used') checked @endif value="used"  type="radio" id="USED">-->
                <!--        <label class="iy" for="USED">USED</label>-->
                <!--    </div>-->
                    
                <!--</div>-->

                
                <div class="row"> 

                @if(Auth::user()->getMembership && Auth::user()->getMembership->slug == "wholesale")
                <div class="col-md-6 col-lg-6 p-1">
                    <label>Minimum quantity</label>
                    <input type="text" class="form-control" value="{{$post->wholesale_qty}}" placeholder="Enter qty" name="wholesale_qty">
                </div>
                @endif
                @if(count($brands)>0)
                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="required" for="brand">Brand </label>
                        <select name="brand" required id="brand" style="width:100%" id="brand" data-parsley-required-message = "Brand is required" class="select2 form-control custom-select">
                           <option value="">Select Brand</option>
                           @foreach($brands as $brand)
                           <option  @if($post->brand_id == $brand->id) selected @endif  value="{{$brand->id}}">{{$brand->name}}</option>
                           @endforeach
                       </select>
                   </div>
                </div>
                @endif
                
                @foreach($attributes as $attribute)
                    <div class="col-md-6 col-lg-6 p-1">
                        <input type="hidden" name="attribute[{{$attribute->id}}]" value="{{$attribute->name}}">
                    
                        <div class="form-group">
                            <label class="@if($attribute->is_required == 1) required @endif">{{$attribute->name}}</label>
                            @if($attribute->display_type == 1)
                                @if(count($attribute->get_attrValues)>0)
                                <ul class="form-check-list">
                                    @foreach($attribute->get_attrValues as $value)
                                    <li>
                                        <input name="attributeValue[{{$attribute->id}}][]" @if($attribute->is_required == 1) required @endif @if($value->get_productVariant) checked @endif value="{{$value->id}}" type="checkbox" class="form-check" id="attributeValue{{$value->id}}">
                                        <label for="attributeValue{{$value->id}}" class="form-check-text">{{$value->name}}</label>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            @elseif($attribute->display_type == 3)
                            @if(count($attribute->get_attrValues)>0)
                                <ul class="form-check-list">
                                    @foreach($attribute->get_attrValues as $value)
                                    <li>
                                        <input name="attributeValue[{{$attribute->id}}][]" @if($value->get_productVariant) checked @endif @if($attribute->is_required == 1) required @endif value="{{$value->id}}" type="radio" class="form-check" id="attributeValue{{$value->id}}">
                                        <label for="attributeValue{{$value->id}}" class="form-check-text">{{$value->name}}</label>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif

                            @else
                            <select class="form-control" @if($attribute->is_required == 1) required @endif name="attributeValue[{{$attribute->id}}][]">
                                @if($attribute->get_attrValues)
                                    @if(count($attribute->get_attrValues)>0)
                                        <option value="">Select one</option>
                                        @foreach($attribute->get_attrValues as $value)
                                            <option @if($value->get_productVariant) selected @endif value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    @else
                                        <option value="">Value Not Found</option>
                                    @endif
                                @endif
                            </select>
                            @endif

                        </div>
                    </div>
                @endforeach

                </div>
                <div @if(count($features) <= 0) style="display:none" @endif>
                    <!-- Allow attribute checkbox button -->
                    <label class="form-label">Product Features</label>
                    <div class="row">
                        @foreach($features as $feature)
                        <div class="col-12 col-md-6 p-1">
                            <div class="@if($feature->is_required) required @endif ">
                                {{$feature->name}}
                                <input type="hidden" value="{{$feature->name}}" class="form-control" name="features[{{$feature->id}}]">
                            </div>
                            <div>
                                <input @if($feature->is_required) required @endif type="text" name="featureValue[{{$feature->id}}]" value="{{ ($feature->featureValue) ? $feature->featureValue->value : null}}" class="form-control" placeholder="Input value here">
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
                
               
                <div class="form-group">
                    <label class="required">Ad Title</label>
                    <input name="title" value="{{$post->title}}" required type="text" class="form-control" placeholder="Type your title here">
                </div>
                
                <div class="form-group">
                    <label class="required">Description</label>
                    <textarea name="description" required class="summernote form-control" rows="4" placeholder="Describe your message">{!! $post->description !!}</textarea>
                    <p>Max 5000 character</p>
                </div>
            </div>
            <div class="col-12 col-md-5 pt-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text required" id="basic-addon1">TK </span>
                    </div>
                    <input type="text" name="price" value="{{$post->price}}" required class="form-control borders" placeholder="Enter your price" aria-label="Username" aria-describedby="basic-addon1">
                    <div class="input-group-append input-group-text">
                        <input id="negotiable" name="negotiable"  @if($post->negotiable == 1) checked @endif type="checkbox" value="1">
                        <label for="negotiable"><small>Negotiable</small></label>
                    </div>
                </div>
                
                <h3 class="font-weight-normal mb-2">CONTACT DETAILS:</h3>
                
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text required">Name:</span>
                    </div>
                    <input type="text" required name="contact_name" value="{{($post->contact_name ? $post->contact_name : Auth::user()->name )}}" class="form-control" placeholder="Your Name">
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text required">Email:</span>
                    </div>
                    <input type="text" required name="contact_email" value="{{(old('contact_email') ? old('contact_email') : Auth::user()->email )}}" class="form-control" placeholder="Your Email">
                </div>
                <div class="w-100">
                    <div class="form-group mb-2">
                        <label>Mobile Number</label>
                        <div id="mobileNumber">
                            @if($post->contact_mobile)
                            @foreach(json_decode($post->contact_mobile) as $number)
                            
                                <div id="{{ $number }}" class="addNumber">
                                <input type="hidden" name="contact_mobile[]" value="{{ $number }}">
                                <i class="fa fa-check-square"></i> <strong>{{ $number }} </strong><a class="removeNumber" href="javascript:void(0)" onclick="removeNumber('{{ $number }}')" title="Remove phone number">✕
                                </a>
                                </div>
                            @endforeach
                            @endif
                            <span id="moreMobile"><a onclick="moreMobile()" href="javascript:void(0)">Add another mobile number</a></span>
                        </div>
                    </div>
                    <div>
                        <input id="contact_hidden" name="contact_hidden" @if($post->contact_hidden == 1) checked @endif type="checkbox" value="1">
                        <label for="contact_hidden">Hide mobile number(s)</label>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
            <div class="form-group" style="text-align: right;">
                <button class="btn btn-inline">
                    <i class="fas fa-check-circle"></i>
                    <span>Update Your Ad</span>
                </button>
            </div>
            </div>
        </div>

        </form>
    </div>
    
@endsection

@section('js')
    <script src="{{asset('assets')}}/node_modules/dropify/dist/js/dropify.min.js"></script>
    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

    });
</script>
<script src="{{ asset('js/parsley.min.js') }}"></script>
<script src="{{asset('assets')}}/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="{{asset('assets')}}/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(".select2").select2();
</script>
<script type="text/javascript">

    function removeImage(table, id){
        if ( confirm("Are you sure delete it.?")) {
                   
            $.ajax({
                url:"{{route('user.imageDelete')}}",
                method:"get",
                data: {table:table, id:id},
                success:function(data){
                    if(data){
                        $('.image'+id).html('<input type="file" data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" name="gallery_image['+id+']" class="dropify" accept="image/*" >');
                        
                        $('.dropify').dropify();
                        toastr.success(data.msg);
                    }
                }
            }); 
        }
        return false;
    }

</script>

<script type="text/javascript">
    function moreMobile(number=null){

        $('#moreMobile').html(`
        <div style="display:flex; margin-bottom: 10px;">
        <div>
        Add mobile number
        <div style="position: relative;margin-right: 10px;width: 300px;">
        <input type="number" id="number" value="`+number+`" required name="mobile" class="form-control" placeholder="Enter your number">
        <span class="adjust-field" onclick="addNumber()"> Add</span>
        </div>
        </div>
        </div>`);
    }
    function addNumber(){
       var number = $('#number').val();
        if(number){
        $.ajax({
            url:"{{route('addNumber')}}",
            method:'get',
            data:{number:number},
            success:function(data){
                $('#moreMobile').html(data);
            }
        });
        }
    }

    function verifyNumber(number){

       var otp = $('#otp').val();
        if(otp){
        $.ajax({
            url:"{{route('verifyNumber')}}",
            method:'get',
            data:{otp:otp,number:number},
            success:function(data){
                if(data.status){
                    $('#mobileNumber').append(data.number);
                    $('#moreMobile').html('<a onclick="moreMobile()" href="javascript:void(0)">Add another mobile number</a>')
                }else{
                    $('#optmsg').html('<span style="color:red">Invalid otp code.</span>')
                }
            }
        });
        }else{
            $('#optmsg').html('<span style="color:red">Please enter otp</span>')
        }
    }


    function removeNumber(number) {
       $('#'+number).remove();
       if($('.contact_mobile').val() == null){
            moreMobile();
       }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $('.summernote').summernote({
        tabsize: 2,
        height: 250
      });
  </script>
@endsection
