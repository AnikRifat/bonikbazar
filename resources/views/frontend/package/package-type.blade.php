@extends('layouts.frontend')
@section('title', 'Package  | '. Config::get('siteSetting.site_name') )

@section('css')
<link rel="stylesheet" href="{{asset('frontend')}}/css/custom/price.css">
@endsection
@section('content')

	<!--=====================================
	    PRICE PART START
	=======================================-->
	<section >
	    <div class="container" style="background: #fff;border-radius: 5px;">

	    	<div class="row">
	    		<div class="col-md-12" style="padding: 15px;text-align: center;">
	    		<h3>Ad Promotions</h3>
				<p>Sell your items quickly at the best price by making your ads stand out on Bikroy - the largest marketplace in Bangladesh!
				<br/>
				While it's free to post ads on Bikroy, Ad Promotions is a paid tool that gets you more responses on your ads and helps you sell faster.</p> 
				</div>
	            <div class="col-md-4"></div>
	            <div class="col-md-6 col-lg-4">
	                <div class="price-card" style="padding: 15px;text-align: center;">
	                	
	                	<form action="" method="get">
	                    <div class="price-head">
	                        <h5>Select option to show packages</h5>
	                    </div>
	                    <ul class="price-list">
	                        <li>
	                            <select onchange="getSubcategory(this.value)" class="form-control">
	                            	<option value="">Select Category</option>
	                            	@foreach($get_categories as $category)
	                            	<option value="{{$category->id}}">{{$category->name}}</option>
	                            	@endforeach
	                            </select>
	                        </li>

	                        <li>
	                            <select name="category" id="showSubcateogry" class="form-control">
	                            	<option value="">Select Sub Category</option>
	                            </select>
	                        </li>

	                        <li>
	                            <select name="package" class="form-control">
	                            	<option value="">Select Ads Package</option>
	                            	@foreach($packages as $package)
	                            	<option value="{{$package->slug}}">{{$package->name}}</option>
	                            	@endforeach
	                            </select>
	                        </li>
	                        <li id=""></li>
	                    </ul>
	                    <div class="price-btn">
	                        <button  class="btn btn-inline">
	                            <i class="fa fa-sign-in-alt"></i>
	                            <span>Show Package</span>
	                        </button>
	                    </div>
	                	</form>
	                </div>
	            </div>
	        </div>
	        
	    </div>
	</section>
	<!--=====================================
	    PRICE PART END
	=======================================-->
@endsection   

@section('js')
<script type="text/javascript">
	
	// get category Sourch
    function getSubcategory(category_id){

        var  url = '{{route("getSubCategory", ":id")}}';
        url = url.replace(':id', category_id);
        if(category_id != ''){
            $.ajax({
                url:url,
                method:"get",
                data:{category_id:category_id},
                success:function(data){
                    if(data){
                        $("#showSubcateogry").html(data);
                    }else{
                        $("#showSubcateogry").html('<option>Category not found</option>');
                    }
                }
            });
        }else{
            $("#showSubcateogry").html('<option>Category not found</option>');
        }
    }
</script> 
@endsection    
