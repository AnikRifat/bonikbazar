@extends('layouts.frontend')
@section('title', 'Seller Verification')

@section('css')
<link href="{{asset('assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .payment-option ul li .checked {
      position: absolute;
      top: 0;
      left: 0;
      width: 30px;
      height: 30px;
      background: #6c2eb9;
      -webkit-clip-path: polygon(0 0, 0% 100%, 100% 0);
        clip-path: polygon(0 0, 0% 100%, 100% 0);
      opacity: 0;
    }
.payment-option ul li .active .checked {opacity: 1;}
.payment-option ul li .checked i{ font-size: 12px; color: white;margin-left: -10px;margin-top: -5px}
.tab-pane{display: block; opacity: 1 !important}
.socialIcon p{display: flex; gap: 5px; align-items: center;}


.open_days label {font-size: 14px !important;}
</style>
@endsection

@section('content')

<!-- Main Container  -->
<div class="container bg-white px-0">

    <h2 class="text-center py-3 border-bottom mb-3">@if($user->sellerVerify) MEMBERSHIP PLAN @else SELLER VERIFICATION @endif</h2>
    @if($user->sellerVerify && $user->sellerVerify->status == "pending")
        @if(Session::has('success'))
        <div style="margin: 10px;" class="alert alert-success">
          <strong>Success! </strong> {{Session::get('success')}}
        </div>
        @else
        <h3 style="padding: 10px; text-align: center;">Verification request already send. <br> <small>Your verify request under review.</small></h3>
        @endif
    @else
   
    <form action="{{ route('verifyAccount') }}" method="post" enctype="multipart/form-data" data-parsley-validate>
        @csrf
        @if($user->sellerVerify && $user->sellerVerify->status == "reject")
        <div style="padding: 10px;display: inline-block;background: #fff1f1;width: 100%;">
        <h3>Verified request rejected.</h3>
        <p><strong>Reject reason: </strong>{{ $user->sellerVerify->reject_reason}}</p> </div> 
        @endif
	
        <div class="row">
            <div class="col-md-6">

        		<div class="row ">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="shop_name" class="control-label required">Organization name</label>
                            <input type="text" required class="form-control" id="shop_name" placeholder="Organization name" value="@if($user->sellerVerify){{ $user->sellerVerify->shop_name }}@endif" name="shop_name">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="mobile" class="control-label required w-100">Mobile Number</label>
                        <div class="form-group" id="moreMobile" style="position: relative;">
                            
                            <input type="text" class="form-control" id="mobile" placeholder="Enter Mobile" value="@if($user->sellerVerify) {{$user->sellerVerify->mobile }} @endif" name="mobile">
                            
                        </div>
                        <label for="input-email" class="control-label w-100">E-Mail Address</label>
                        <div class="form-group" id="moreEmail" style="position: relative;">
                            <input type="email" class="form-control" id="input-email" placeholder="E-Mail" value="@if($user->sellerVerify){{$user->sellerVerify->email }} @endif" name="email">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-1">
                            <span class="required mb-2 d-block">About your shop</span>
                            <textarea required rows="1" class="form-control" id="address" placeholder="Describe your shop about" name="shop_about">@if($user->sellerVerify) {{ $user->sellerVerify->shop_about }} @endif</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <span class="required mb-2 d-block">Business address</span>
                            <textarea required rows="1" class="form-control" id="address" placeholder="For example: #road:2, #sector: 3, Dhaka-1215" name="address">@if($user->sellerVerify) {{ $user->sellerVerify->address }} @endif</textarea>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <div class="row">
                            <div class="col-6 col-md-6 pl-0 pr-1">
            				    <label class="required mb-2">NID Front Side</label>
            				    <input type="file" accept="image/*" @if($user->sellerVerify && $user->sellerVerify->nid_front) data-default-file="{{asset('upload/users/'.$user->sellerVerify->nid_front)}}" @else required @endif data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M"  class="dropify" name="nid_front" >
            				</div>
            				<div class="col-6 col-md-6 pr-0 pl-1">
            				    <label class="required mb-2">NID Back Side</label>                         
            				    <input type="file" accept="image/*" @if($user->sellerVerify && $user->sellerVerify->nid_back) data-default-file="{{asset('upload/users/'.$user->sellerVerify->nid_back)}}" @else required @endif data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M"  class="dropify" name="nid_back"  >
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 mb-2 trade_license">
        				<label class="required mb-2">Upload Trade License</label>   
        				<div class="d-flex gap">
        				    <input type="file"  @if($user->sellerVerify) data-default-file="{{asset('upload/users/'.$user->sellerVerify->trade_license)}}" @else required @endif data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" class="dropify mr-1" name="trade_license" >
        				    <input type="file" @if($user->sellerVerify) data-default-file="{{asset('upload/users/'.$user->sellerVerify->trade_license2)}}" @endif data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" class="dropify" name="trade_license2">
        				    <input type="file" @if($user->sellerVerify) data-default-file="{{asset('upload/users/'.$user->sellerVerify->trade_license3)}}" @endif data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M" class="dropify ml-1" name="trade_license3">
        				</div>
                    </div>
                    
                </div>
            </div>

            <div class="col-md-6">
                
            <div class="row">
                <div class="col-md-12">
                    <label class="required mb-2">SHOP OPEN AND CLOSE TIME</label>
                    <div class="d-flex align-items-center">
                        <input type="time" class="form-control" value="@if($user->sellerVerify){{ $user->sellerVerify->open_time }}@endif" name="open_time" id="name" placeholder="OPEN">
                        <p class="py-2 px-4">TO</p>
                        <input type="time" class="form-control" value="@if($user->sellerVerify){{ $user->sellerVerify->close_time }}@endif" name="closed_time" id="name" placeholder="OPEN">
                    </div>
                </div>
                <div class="col-12 col-md-12 mt-2">
                    <label class="required">Shop Open Days</label>
                    <div class="d-flex flex-wrap gap open_days">
                        <div class="d-flex align-items-center ">
                            <input type="checkbox" name="open_days[]" @if($user->sellerVerify && $user->sellerVerify->open_days && in_array("SAT", json_decode($user->sellerVerify->open_days) )) checked @endif value="SAT" id="SAT">
                            <label class="iy" for="SAT">SAT</label>
                        </div>
                        <div class="d-flex align-items-center ">
                            <input type="checkbox" name="open_days[]" @if($user->sellerVerify && $user->sellerVerify->open_days && in_array("SUN", json_decode($user->sellerVerify->open_days) )) checked @endif value="SUN" id="SUN">
                            <label class="iy" for="SUN">SUN</label>
                        </div>
                        <div class="d-flex align-items-center">
                            <input type="checkbox" name="open_days[]" @if($user->sellerVerify && $user->sellerVerify->open_days && in_array("MON", json_decode($user->sellerVerify->open_days) )) checked @endif value="MON" id="MON">
                            <label class="iy" for="MON">MON</label>
                        </div>
                        <div class="d-flex align-items-center">
                            <input type="checkbox" name="open_days[]" @if($user->sellerVerify && $user->sellerVerify->open_days && in_array("TUE", json_decode($user->sellerVerify->open_days) )) checked @endif value="TUE" id="TUE">
                            <label class="iy" for="TUE">TUE</label>
                        </div>
                        <div class="d-flex align-items-center">
                            <input type="checkbox" name="open_days[]" @if($user->sellerVerify && $user->sellerVerify->open_days && in_array("WED", json_decode($user->sellerVerify->open_days) )) checked @endif value="WED" id="WED">
                            <label class="iy" for="WED">WED</label>
                        </div>
                        <div class="d-flex align-items-center">
                            <input type="checkbox" name="open_days[]" @if($user->sellerVerify && $user->sellerVerify->open_days && in_array("THU", json_decode($user->sellerVerify->open_days) )) checked @endif value="THU" id="THU">
                            <label class="iy" for="THU">THU</label>
                        </div>
                        <div class="d-flex align-items-center">
                            <input type="checkbox" name="open_days[]" @if($user->sellerVerify && $user->sellerVerify->open_days && in_array("FRI", json_decode($user->sellerVerify->open_days) )) checked @endif value="FRI" id="FRI">
                            <label class="iy" for="FRI">FRI</label>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-md-12 socialIcon">
                    <br>
                    <p >
                        <img width="40" src="{{ asset('frontend/images/facebook.svg') }}">
                        <input class="form-control" value="@if($user->sellerVerify){{$user->sellerVerify->facebook }} @endif" type="text" placeholder="https://facebook.com/username" name="facebook">
                    </p>
                    <p>
                        <img width="40" src="{{ asset('frontend/images/web.svg') }}">
                        <input class="form-control" value="@if($user->sellerVerify){{$user->sellerVerify->website }} @endif" type="text" placeholder="https://example.com" name="website">
                    </p>
                    <p>
                        <img width="40" src="{{ asset('frontend/images/instagram.svg') }}">
                        <input class="form-control" value="@if($user->sellerVerify){{$user->sellerVerify->instagram }} @endif" type="text" placeholder="https://instagram.com/username" name="instagram">
                    </p>
                    <p>
                        <img width="40" src="{{ asset('frontend/images/youtube.svg') }}">
                        <input class="form-control" value="@if($user->sellerVerify){{$user->sellerVerify->youtube }} @endif" type="text" placeholder="https://youtube.com/username" name="youtube">
                    </p>
                    <p>
                        <img width="40" src="{{ asset('frontend/images/whatsapp.svg') }}">
                        <input class="form-control" value="@if($user->sellerVerify){{$user->sellerVerify->whatsapp }} @endif" type="text" placeholder="https://wa.me/8801700000000" name="whatsapp">
                    </p>
                </div>

                @if(!$user->sellerVerify)
                <div class="col-12 col-md-12">
                    <div class="form-group ">
                        <span class="required">Select Membership</span>
                        <select name="membership" id="membershipPlan" required class="form-control">
                            <option value="" selected disabled>Please Select</option>
                            @foreach($memberships as $membership)
                            <option @if($user->sellerVerify && $user->sellerVerify->membership == $membership->slug) selected @endif value="{{$membership->slug}}"> {{$membership->name}} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group ">
                        <label> Refer Code</label>
                        <input type="text" name="refer_by" value="{{ ($user->sellerVerify ) ? $user->sellerVerify->refer_by : '' }}" id="refer_code" onkeyup="referDiscount()" placeholder="Enter Refer" class="form-control">
                        <p id="refer_msg"></p>
                    </div>
                        
                    <div class=" w-100 ab px-2 py-3 borders my-3">
                        <div class="d-flex align-items-center justify-content-between border-bottom border-dark pb-1 mb-1">
                            <h4 class="">Membership Details:</h4>
                        </div>
                        <div class="d-flex align-items-center justify-content-between fir" id="membershipType">
                            <p>@if($user->sellerVerify) {{ucwords($user->sellerVerify->membership)}} Bonik @else Membership @endif</p>
                            <p>
                            <select class="form-control">
                                <option value="">Select Membership</option>
                                @if($user->sellerVerify && $user->sellerVerify->membershipDuration)
                                <option selected value="{{$user->sellerVerify->membershipDuration}}">{{$user->sellerVerify->membershipDuration}} Month</option> @endif
                            </select></p>
                        </div>
                        <div class=" border-top border-dark pt-1 mt-1">
                            <div id="referDiscountArea">
                                @if($user->sellerVerify && $user->sellerVerify->refer_by)
                                <div class="d-flex align-items-center justify-content-between">
                                <p>Amount</p>
                                <b>TK. <span>{{($user->sellerVerify && $user->sellerVerify->amount) ? $user->sellerVerify->amount + $user->sellerVerify->referAmount : 0 }}</span></b>
                                </div>

                                <div class="d-flex align-items-center justify-content-between">
                                <p>Refer Discount</p>
                                <b>TK. <span>-{{($user->sellerVerify && $user->sellerVerify->referAmount) ? $user->sellerVerify->referAmount : 0 }}</span></b>
                                </div>
                                @endif
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                            <p>Total Amount</p>
                            <input type="hidden" name="total_price" id="total_price" value="0">
                            <b>TK. <span class="total">{{($user->sellerVerify && $user->sellerVerify->amount) ? $user->sellerVerify->amount : 0 }}</span></b>
                            </div>
                        </div>
                    </div>
                    <div class="payment-option" id="paymentMethodOption"> 
                        
                    </div>
                </div>
                @else
                    <input type="hidden" name="membership" value="{{ $user->sellerVerify->membership }}">
                    @if($user->sellerVerify->status != "active")
                        <h3 style="color: green">Request for {{ucfirst($user->sellerVerify->membership)}} membership.</h3>
                    @endif
                @endif
                <div style="text-align: right;margin: 10px;" class="col-12">
                    <div class="pull-right">
                        <input type="submit" class="btn btn-md btn-primary" value="Verify Account">
                    </div>
                </div>
            </div>
            </div>
        </div>
        
    </form>
     
    @endif
</div>
@endsection

@section('js')
<script src="{{ asset('js/parsley.min.js') }}"></script>
    <script src="{{asset('assets')}}/node_modules/dropify/dist/js/dropify.min.js"></script>
    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();
    });
</script>
<script type="text/javascript">

	function get_city(id, type=''){
       
        var  url = '{{route("get_city", ":id")}}';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#show_city"+type).html(data);
                    $("#show_city"+type).focus();
                }else{
                    $("#show_city"+type).html('<option>City not found</option>');
                }
            }
        });
    }  	 

    function get_area(id, type=''){
           
        var  url = '{{route("get_area", ":id")}}';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#show_area"+type).html(data);
                    $("#show_area"+type).focus();
                }else{
                    $("#show_area"+type).html('<option>Area not found</option>');
                }
            }
        });
    }  

    function paymentMethod(id){
        $("#payment_method"+id).click();   
    }


    $(document).on("change", "#membershipPlan", function(){
       
        var membershipName = $("#membershipPlan :selected").val();

        @if(!$user->sellerVerify)
        if(membershipName == 'agent'){
            $("input[name=trade_license]").attr('required', false);
            $('.trade_license label').removeClass('required');
        }else{
            $("input[name=trade_license]").attr('required', true);
            $('.trade_license label').addClass('required');
        } @endif

        var output = '';
        @foreach($memberships as $membership)

            if(membershipName == "{{ $membership->slug }}"){
                output = `<p>{{ $membership->name }}</p>
                        <p>
                        <select name="membershipDuration" required id="membershipDuration" class="form-control">
                            <option value="" selected disabled>Select Month</option>
                            @foreach($membership->membershipDurations as $membershipDuration)
                            <option data-duration="{{ $membershipDuration->duration }}" data-price="{{$membershipDuration->price}}" value="{{$membershipDuration->id}}">{{$membershipDuration->duration ." ". $membershipDuration->type}}</option>
                            @endforeach
                        </select></p>
                    </div>
                    `;
            }

        @endforeach

        $("#membershipType").html(output);
        referDiscount();
    });

    $(document).on("change", "#membershipDuration", function(){    
        var price = $("#membershipDuration :selected").data("price");
        var duration = $("#membershipDuration :selected").data("duration");
        referDiscount();
        if(price > 0){
            $("#total_price").val(price);
            $(".total").html(price);
            $("#paymentMethodOption").html(`
                Select Payment Method  
                <ul class="nav nav-tabs payment-option">
                    @foreach($paymentgateways as $index => $method)
                    <li>
                    <input required type="radio" @if($index == 0) checked @endif name="payment_method" id="payment_method{{$method->id}}" value="{{$method->method_slug}}"> 
                    <a onclick="paymentMethod({{$method->id}})" @if($index == 0) class="active" @endif style="border: 1px solid #6c2eb9;border-radius: 5px; display:block;padding:5px;margin-bottom: 8px;position: relative; margin-right: 15px;text-align: center;" data-toggle="tab" href="#paymentgateway{{$method->id}}"><div class="checked"><i class="fa fa-check"></i></div> <img  width="50"  src="{{asset('upload/images/payment/'.$method->method_logo)}}"></a></li>
                    @endforeach
                </ul>
                <div class=" payment_field">
                    @foreach($paymentgateways as $index => $method)
                     @if($index == 0)
                    @if($method->is_default == 1)
                    <div id="paymentgateway{{$method->id}}">
                        {!! $method->method_info !!}
                    </div>
                    @else
                    <div id="paymentgateway{{$method->id}}" >
                        {!! $method->method_info !!}
                        <strong style="color: green;">Pay with {{$method->method_name}}.</strong><br/>
                        @if($method->method_slug != 'cash')
                        <strong>Payment Transaction Id</strong>
                        <p><input type="text" data-parsley-required-message = "Transaction Id is required" placeholder="Enter Transaction Id" value="{{old('trnx_id')}}" class="form-control" name="trnx_id"></p>
                        @endif
                        <strong>Write Your {{$method->method_name}} Payment Information below.</strong>
                        <textarea data-parsley-required-message = "Payment Information is required" name="payment_info" style="margin: 0;" rows="2" placeholder="Write Payment Information" class="form-control">{{old('payment_info')}}</textarea>
                    </div>
                    @endif
                    @endif
                    @endforeach
                </div>
            `);
        }else{
            $(".total").html(0);
            $("#total_price").val(0);
            $("#paymentMethodOption").html("");
        }
    });

    function referDiscount() {
        var membership = $("#membershipPlan :selected").val();
        var price = $("#membershipDuration :selected").data("price");
        var duration = $("#membershipDuration :selected").data("duration");

        $("#total_price").val(price);
        $(".total").html(price);
        $("#referDiscountArea").html('');
        $("#refer_msg").html('');
        var refer_code = $("#refer_code").val();
        if(refer_code){
            $.ajax({ 
                url:"{{url('seller/affiliate/discount')}}/"+refer_code+"/"+price+"/"+membership+"/"+duration,
                method:'get',
                success:function(data){
                    if(data.status){
                        $("#total_price").val(data.grandTotal);
                        $(".total").html(data.grandTotal);
                        $("#refer_msg").html('<span style="color:green;font-size:14px">'+data.msg+'</span>');
                        $("#referDiscountArea").html(`
                            <div class="d-flex align-items-center justify-content-between">
                            <p>Amount</p>
                            <input type="hidden" name="total_price" id="total_price" value="0">
                            <b>TK. <span>`+price+`</span></b>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                            <p>Refer Discount (`+data.referDiscount+`%)</p>
                            <input type="hidden" name="total_price" id="total_price" value="0">
                            <b>TK. <span>-`+data.referAmount+`</span></b>
                            </div>
                        `);
                    }else{
                        $("#refer_msg").html('<span style="color:red">'+data.msg+'</span>');
                    }
                }
            });
        }
    }


    function paymentMethod(method){
        $("#payment_method"+method).click();
        var output = ``;
        @foreach($paymentgateways as $index => $method)
            if(method == "{{$method->id}}"){
             output = ` @if($method->is_default == 1)
                      <div id="paymentgateway{{$method->id}}" class="tab-pane fade @if($index == 0) active show @endif">
                            {!! $method->method_info !!}
                      </div>
                      @else
                      <div id="paymentgateway{{$method->id}}" class="tab-pane fade @if($index == 0) active show @endif">
                        
                        {!! $method->method_info !!}
                          <strong style="color: green;">Pay with {{$method->method_name}}.</strong><br/>
                          @if($method->method_slug != 'cash')
                          <strong>Payment Transaction Id</strong>
                          <p><input type="text"  data-parsley-required-message = "Transaction Id is required" placeholder="Enter Transaction Id" value="{{old('trnx_id')}}" class="form-control" name="trnx_id"></p>
                          @endif
                          <strong>Write Your {{$method->method_name}} Payment Information.</strong>
                          <textarea  data-parsley-required-message = "Payment Information is required" name="payment_info" style="margin: 0;" rows="1" placeholder="Write Payment Information" class="form-control">{{old('payment_info')}}</textarea>
                        
                      </div>
                      @endif`;
            }
        @endforeach

        $(".payment_field").html(output); 
    }


    $(document).on("change", "#membershipRequest #membershipDuration", function(){    
        var price = $("#membershipDuration :selected").data("price");
        $("#total_price").val(price);
        $(".total").html(price);
    });
</script>
@endsection