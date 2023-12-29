@extends('layouts.frontend')
@section('title', 'Edit Post' )

@section('css')
<link href="{{asset('assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
<style>.h-300 .dropify-wrapper {height: 300px !important;}.dropify-wrapper {height: 140px !important;}
.h-500 .dropify-wrapper {height: 600px !important; width: 240px;}

  .adjust-field{cursor: pointer; border: none;border-radius:0;position: absolute;top: 0;right: 0;background: #e9ecef;padding: 7px;}
</style>

@endsection

@section('content')
<div class="container bg-white mb-2 p-3">
    <div  class="box w-100 py-3" >
        <form action="{{ route('updateWantedPost', $post->id)}}" data-parsley-validate method="post" enctype="multipart/form-data">
        @csrf
        
        <h3 class="border-bottom text-center pb-2 mb-3">Update your post request</h3>
        <div class="row">
            <div class="col-12 col-md-6">
                <label class="mb-2 w-100" for="">Select a category:</label>
                <select name="category" class="form-control gb shadow-b borders">
                    <option value="" selected disabled>Select an option</option>
                    @foreach($categories as $category)
                       	@if(count($category->get_subcategory)>0)
                        <optgroup label="{{$category->name}}">
                            @foreach($category->get_subcategory as $subcategory)
                            <option @if($post->subcategory_id == $subcategory->id) selected @endif value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                            @endforeach
                        </optgroup>
                        @else
                        <option @if($post->category_id == $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label class="mb-2 w-100" for="">Select District</label>
                <select name="location" required class="form-control mb-2 gb shadow-b borders" id="">
                    <option value="" selected disabled>Select an option</option>
                    @foreach($regions as $region)
                        @if(count($region->get_city)>0)
                            <optgroup label="{{$region->name}}">
                                @foreach($region->get_city as $city)
                                <option @if($post->city_id == $city->id) selected @endif value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </optgroup>
                        @else
                            <option @if($post->state_id == $region->id) selected @endif value="{{ $region->id }}">{{$region->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label class="mb-2 w-100" for="">Upload ad photo</label>
                <div class="h-300">
                    <input type="file" data-allowed-file-extensions="jpg jpeg png gif" data-default-file="{{asset('upload/images/product/'.$post->feature_image)}}" @if(!$post->feature_image) required @endif data-max-file-size="5M"  class="dropify mt-2 borders shadow-b" name="feature_image">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <label class="mb-2" for="">Type ad title</label>
                <input type="text" name="title" value="{{$post->title}}" placeholder="Title" class="w-100 borders p-2 gb shadow-b rounded-3">
                <label class="my-2" for="">Type ad description</label>
                <textarea name="description" required class="summernote form-control gb shadow-b borders" rows="5" maxlength="5000" placeholder="Describe your message">{!! $post->description !!}</textarea>
                <p>Max 5000 character</p>

                <h3 class="font-weight-normal mb-2">CONTACT DETAILS:</h3>
                
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text required">Name:</span>
                    </div>
                    <input type="text" required name="contact_name" value="{{($post->contact_name ? $post->contact_name : Auth::user()->name )}}" class="form-control" placeholder="Your Name">
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
               
                <button class="yb py-2 text-center bt bb2 rounded font-weight-bold mt-2 float-right px-5">Update Ad</button>
            </div>
        </div>
        </form>
    </div>
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
@endsection