@extends('layouts.frontend')
@section('title', 'My Account | '. Config::get('siteSetting.site_name') )

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
			<form action="{{ route('user.profileUpdate') }}" method="post" data-parsley-validate>
				@csrf
				<div class="row">
						<div class="col-sm-12">
						<fieldset id="personal-details">
							<legend>Personal Details</legend></fieldset>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label for="name" class="control-label required">Full Name</label>
								<input type="text" class="form-control" id="name" placeholder="Full Name" value="{{ $user->name }}" name="name">
							</div>
						</div>
						
						<div class="col-sm-4">
							<div class="form-group">
								<label for="mobile" class="control-label required">Mobile Number</label>
								<input type="text" class="form-control" id="mobile" placeholder="Enter Mobile" value="{{ $user->mobile }}" name="mobile">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label for="input-email" class="control-label required">E-Mail Address</label>
								<input type="email" class="form-control" id="input-email" placeholder="E-Mail" value="{{ $user->email }}" name="email">
							</div>
						</div>


						<div class="col-sm-12">
							<div class="form-group">
								<label for="about" class="control-label">About </label>
								<textarea class="form-control" maxlength="120" rows="1" id="user_dsc" name="user_dsc">{{ $user->user_dsc }}</textarea>
								<p>Max 120 character</p>
							</div>
						</div>
						
					</div>
					<div class="buttons clearfix">
						<div class="pull-right" style="text-align: right;">
							<input type="submit" class="btn btn-sm btn-primary" value="Save Changes">
						</div>
					</div>
			</form>

			<form action="{{ route('user.addressUpdate') }}" method="post" data-parsley-validate>
				@csrf
				<div class="row">
						<div class="col-sm-12">
							<fieldset id="personal-details">
							<legend>Address</legend></fieldset>
						</div>
						<div class="col-sm-4">
						<div class="form-group ">
							<span class="required">Select Your District</span>
							<select name="region" onchange="get_city(this.value)" required id="input-payment-country" class="form-control">
								<option value=""> Please Select  </option>
								@foreach($states as $state)
								<option @if($user->region == $state->id) selected @endif value="{{$state->id}}"> {{$state->name}} </option>
								@endforeach
							</select>
						</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<span class="required">City</span>
								<select name="city" onchange="get_area(this.value)"  required id="show_city" class="form-control">
									
									<option value="">Please Select</option>
									@foreach($cities as $city)
									<option @if($user->city == $city->id) selected @endif value="{{$city->id}}"> {{$city->name}} </option>
									@endforeach
								</select>
							</div>
						</div>
					
						<div class="col-sm-12">
							<div class="form-group ">
								<span class="required">Address</span>
								<textarea class="form-control" id="address" placeholder="For example: #road:2, #sector: 3, Dhaka-1215" name="address">{{ $user->address }}</textarea>
								
							</div>
						</div>
						
					</div>
					<div class="buttons clearfix" style="text-align: right; margin-bottom: 5px;">
						<div class="pull-right">
							<input type="submit" class="btn btn-sm btn-primary" value="Save Changes">
						</div>
					</div>
			</form>
		</div>
		<!--Middle Part End-->
	</div>
</div>
<!-- //Main Container -->
@endsection

@section('js')

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
</script>
@endsection