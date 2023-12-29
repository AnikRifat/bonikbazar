@extends('layouts.frontend')
@section('title', 'Membership Plan')

@section('css')
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
.payment-option ul li .active .checked {
  opacity: 1;
}
.payment-option ul li .checked i{ font-size: 12px; color: white;
  margin-left: -10px;margin-top: -5px}

</style>
@endsection

@section('content')

<!-- Main Container  -->
<div class="container bg-white px-0">

    <h2 class="text-center py-3 border-bottom mb-3">MEMBERSHIP PLAN</h2>
    
    <!-- //update membership plan or renew -->
    <form action="{{ route('membershipRequest') }}" id="membershipRequest" method="post" data-parsley-validate>
        @csrf
        @if(Session::has('success'))
        <div style="margin: 10px;" class="alert alert-success">
          <strong>Success! </strong> {{Session::get('success')}}
        </div>
        @endif
  
        
        @if($user->sellerMembership && $user->sellerMembership->status == "pending")
            <div style="margin: 10px;" class="alert alert-danger">
                {{$user->sellerMembership->membership}} membership is pending now.
            </div>
        @elseif($user->sellerMembership && $user->sellerMembership->status == "reject")
            <div style="margin: 10px;" class="alert alert-danger">
                <strong>Reject Reason:</strong> {{$user->sellerMembership->reject_reason}}
            </div>

        @else
        @if($user->membership)
        <h3 style="text-align: center;color: green">{{ucfirst($user->membership)}} membership active now.</h3>
        @endif
        @endif
        <div class="row">
            <div class="col-12 col-md-3"></div>
            <div class="col-12 col-md-6">

                <div class="form-group ">
                    <span class="required">Select Membership</span>
                    <select name="membership" id="membershipPlan" required class="form-control">
                        <option value="" selected disabled>Please Select</option>
                        @foreach($memberships as $membership)
                        <option value="{{$membership->slug}}"> {{$membership->name}} </option>
                        @endforeach
                    </select>
                </div>
               
                <div class=" w-100 ab px-2 py-3 borders my-3">
                    <div class="d-flex align-items-center justify-content-between border-bottom border-dark pb-1 mb-1">
                        <h4 class="">Membership Details:</h4>
                    </div>
                    <div class="d-flex align-items-center justify-content-between fir" id="membershipType">
                        <p> Membership </p>
                        <p>
                        <select required name="membershipDuration" id="membershipDuration" class="form-control">
                            <option value="">Select Month</option>
                        </select></p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between border-top border-dark pt-1 mt-1">
                        <p>Total Amount</p>
                        <input type="hidden" name="total_price" id="total_price" value="0">
                        <b>TK. <span class="total">0</span></b>
                    </div>
                </div>
                <div class="payment-option"> 
                    Select Payment Method 
                    <ul class="nav nav-tabs">
                        @foreach($paymentgateways as $index => $method)
                        <li>
                            <input required type="radio" @if($index == 0) checked @endif name="payment_method" id="payment_method{{$method->id}}" value="{{$method->method_slug}}"> 
                            <a onclick="paymentMethod({{$method->id}})" @if($index == 0) class="active" @endif style="border: 1px solid #6c2eb9;border-radius: 5px; display:block;padding:5px;margin-bottom: 8px;position: relative; margin-right: 15px;text-align: center;" data-toggle="tab" href="#paymentgateway{{$method->id}}"><div class="checked"><i class="fa fa-check"></i></div> <img  width="50"  src="{{asset('upload/images/payment/'.$method->method_logo)}}"></a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content payment_field">
                        @foreach($paymentgateways as $index => $method)
                        @if($index == 0)
                        @if($method->is_default == 1)
                        <div id="paymentgateway{{$method->id}}" class="tab-pane fade @if($index == 0) active show @endif">
                            {!! $method->method_info !!}
                        </div>
                        @else
                        <div id="paymentgateway{{$method->id}}" class="tab-pane fade @if($index == 0) active show @endif">
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
                  
                </div>
                
                <div style="text-align: right;margin: 10px;" class="buttons clearfix">
                <div class="pull-right">
                    <input type="submit" class="btn btn-md btn-primary" value="Change Membership Request">
                </div>
                </div>
            </div>
    	</div>
    </form>
   
</div>
@endsection

@section('js')
<script src="{{ asset('js/parsley.min.js') }}"></script>

<script type="text/javascript">

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


    $(document).on("change", "#membershipPlan", function(){
       
        var membershipName = $("#membershipPlan :selected").val();

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
        $(".total").html(0);
        $("#total_price").val(0);
    });

    $(document).on("change", "#membershipDuration", function(){    
        var price = $("#membershipDuration :selected").data("price");
        var duration = $("#membershipDuration :selected").data("duration");
        if(price > 0 && duration > 1){
            $("#total_price").val(price);
            $(".total").html(price);
        }else{
            $(".total").html("Membership free");
            $("#total_price").val(0);
            $("#paymentMethodOption").html("");
        }
    });

    $(document).on("change", "#membershipRequest #membershipDuration", function(){    
        var price = $("#membershipDuration :selected").data("price");
        $("#total_price").val(price);
        $(".total").html(price);
    });
</script>
@endsection