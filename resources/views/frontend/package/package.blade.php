@extends('layouts.frontend')
@section('title', $packageType->name. ' | '. Config::get('siteSetting.site_name') )

@section('css')
<link rel="stylesheet" href="{{asset('frontend')}}/css/custom/price.css">
<style type="text/css">.section-center-heading h2, .section-center-heading p{color:#000} .section-center-heading{margin: 0;}
	.price-btn{text-align: center;}.price-list{margin-bottom: 0;}
</style>
@endsection
@section('content')

	<!--=====================================
	             PRICE PART START
	=======================================-->
	<section>
	    <div class="container" style="background: #fff;border-radius: 5px; margin-bottom: 10px;padding: 15px;">
	    	<div class="row">

	    		<div class="col-md-12" style="padding: 15px;text-align: center;">
	    		<h3>{{$packageType->name}}</h3>
				<p>{{$packageType->details}}</p> 
				</div>
	            
	        </div>
	        <div class="row">

	        	@foreach($packageValues as $package)
	            <div class="col-md-3 col-lg-3">
	            	<form action="{{route('packagePurchase', $package->id)}}" method="post">
	            	@csrf
	                <div class="price-card" style="padding:25px 15px;">
	                	<?php  
					        $selling_price = $package->price;
					        $discount = ($package->discount) ? $package->discount : null;
					        $discount_type = '%';
					        if($discount){
					            $calculate_discount = App\Http\Controllers\HelperController::calculate_discount($selling_price, $discount, $discount_type );
					        }
					    ?>
	                    <div class="price-head">
	                        <i><img width="60" src="{{asset('upload/images/package/'.$packageType->ribbon)}}"></i>
	                        <h3>{{ config('siteSetting.currency_symble') }}{{round($discount ? $calculate_discount['price'] : $selling_price) }} @if($discount)<s style="font-size: 18px;color: red;display: block;position: absolute; left: 45px">{{ config('siteSetting.currency_symble') }}{{round($selling_price)}}</s>@endif</h3>
	                        
	                    </div>
	                    <ul class="price-list">
	                        <li>
	                            <i class="fa fa-plus"></i>
	                            <p>{{$package->ads}} Ads</p>
	                        </li>

	                        <li>
	                            <i class="fa fa-plus"></i>
	                            <p>Ads for {{$package->duration}} days</p>
	                        </li>
	                       
	                    </ul>
	                    <p>{{$package->details}}</p>
	                    <div class="price-btn">
	                        <button class="btn btn-inline btn-sm">
	                            <i class="fa fa-sign-in-alt"></i>
	                            <span>Purchase Now</span>
	                        </button>
	                    </div>
	                </div>
	                </form>
	            </div>
	            @endforeach
	        </div>
	        
	    </div>
	</section>
	<!--=====================================
	             PRICE PART END
	=======================================-->
@endsection    
