@extends('layouts.frontend')
@section('title', ($state) ? $state->name : 'All ads' . ' | '. Config::get('siteSetting.site_name') )
@section('css')
    <style type="text/css">
        .page-info{font-size: 14px;}
    </style>
@endsection
@section('content')
    @php
    if($category->parent_id && $category->subcategory_id){ $maincategory = $category->get_category->get_category->name; $maincategory_slug = $category->get_category->get_category->slug; }  
    elseif($category->parent_id){$maincategory = $category->get_category->name; $maincategory_slug = $category->get_category->slug;} else{ $maincategory =  $category->name ; $maincategory_slug =  $category->slug ; }


    if($category->parent_id && $category->subcategory_id){ $subcategory = $category->get_category->name; $subcategory_slug = $category->get_category->slug; } 
    elseif($category->parent_id){$subcategory = $category->name; $subcategory_slug = $category->slug; } else{ $subcategory = null; }

    $childcategory = ($category->parent_id && $category->subcategory_id ? $category->name : null);
    @endphp
    
    <section class="inner-section ad-list-part">
        <div class="container">
            <div class="row content-reverse">
                <div class="col-lg-4 col-xl-3 sticky-conent">
                    <div class="row">
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by category</h6>
                                <form class="product-widget-form">
                                    <ul class="product-widget-list product-widget-scroll">
                                        <li class="product-widget-dropitem">
                                            <button type="button" class="product-widget-link active">
                                                <i class="fa fa-tags"></i> {{$category->name}}
                                            </button>
                                            <ul class="product-widget-dropdown" style="display: block;">
                                                @foreach($category->get_subcategory as $filterCategory )
                                                <li><a href="{{ Request::route('name') ? route('home.location', [Request::route('name'), $filterCategory->slug]) : route('home.category', $filterCategory->slug)}}"> {{$filterCategory->name}} ({{$filterCategory->products_by_subcategory_count}})</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by Price</h6>
                                <form class="product-widget-form">
                                    <div class="product-widget-group">
                                        <input type="text" value="{{Request::get('price_min')}}" id="price_min" class="price-range" placeholder="min - 00">
                                        <input type="text" value="{{Request::get('price_max')}}" id="price_max" placeholder="max - 1B">
                                    </div>
                                    <button type="button" class="product-widget-btn common_selector">
                                        <i class="fa fa-search"></i>
                                        <span>search</span>
                                    </button>
                                </form>
                            </div> 
                        </div>
                        
                        
                        @foreach($product_variations as $product_variation)
                        <!-- check weather value set or not -->
                        @if(count($product_variation->get_attrValues)>0)
                        <div class="col-md-6 col-lg-12">

                            <div class="product-widget">
                                <h6 class="product-widget-title">{{$product_variation->name}}</h6>
                                
                                    <ul class="product-widget-list">
                                        @foreach($product_variation->get_attrValues as $variationValue)
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox">
                                                <input @if(in_array(strtolower($variationValue->name) , explode(',', Request::get(strtolower($product_variation->name)))) ) checked @endif value="{{strtolower($variationValue->name)}}" class=" {{str_replace(' ', '', $product_variation->name)}} common_selector" id="attr{{$variationValue->id}}" type="checkbox" />
                                            </div>
                                            <label class="product-widget-label" for="attr{{$variationValue->id}}">
                                                <span class="product-widget-text">{{ $variationValue->name }}</span>
                                                <span class="product-widget-number">({{$variationValue->get_variant_products_count}})</span>
                                            </label>
                                        </li>
                                        @endforeach
                                    </ul>
                                
                            </div>
                        </div>
                        @endif
                        @endforeach
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by type</h6>
                                <form class="product-widget-form">
                                    <ul class="product-widget-list">
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek1"></div>
                                            <label class="product-widget-label" for="chcek1">
                                                <span class="product-widget-type sale">sales</span>
                                                <span class="product-widget-number">(15)</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek2"></div>
                                            <label class="product-widget-label" for="chcek2">
                                                <span class="product-widget-type rent">rental</span>
                                                <span class="product-widget-number">(25)</span>
                                            </label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek3"></div>
                                            <label class="product-widget-label" for="chcek3">
                                                <span class="product-widget-type booking">booking</span>
                                                <span class="product-widget-number">(35)</span>
                                            </label>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </div>

                        
                        @if(count($brands)>0)
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">filter by Brand</h6>
                                <form class="product-widget-form">
                                    <ul class="product-widget-list product-widget-scroll">
                                        @foreach($brands as $brand)
                                        <li class="product-widget-dropitem">
                                            <button type="button" class="product-widget-link">
                                            <input @if(in_array($brand->slug , explode(',', Request::get('brand')))) checked @endif class="common_selector brand" value="{{$brand->slug}}" id="brand{{$brand->id}}" type="checkbox" />
                                            <label style="margin: 0px;" for="brand{{$brand->id}}" >{{ $brand->name }}</label> 
                                            </button>
                                        </li>
                                        @endforeach
                                    </ul>
                                </form>
                            </div>
                        </div>
                        @endif
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by cities</h6>
                                <form class="product-widget-form">
                                    <ul class="product-widget-list product-widget-scroll">
                                        
                                        <li class="product-widget-dropitem">
                                            <button type="button" class="product-widget-link">
                                                <i class="fa fa-tags"></i> {{$state->name}}
                                            </button>
                                            <ul class="product-widget-dropdown" style="display: block;">
                                                @foreach($state->get_city as $city )
                                                <li><a href="{{ Request::route('catslug') ? route('home.location', [$city->slug, Request::route('catslug')]) : route('home.location', $city->slug) }}"> {{$city->name}} ({{$city->products_by_city_count}})</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="content" class="col-lg-8 col-xl-9 sticky-conent" >
                    <div id="filter_product">
                    @include('frontend.post-filter')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')

<script type="text/javascript">
    
    function filter_data(page)
    {
        //enable loader
        document.getElementById('dataLoading').style.display ='block';
        
        var category = "{!! str_replace(' ', '', Request::route('catslug')) !!}" ;
        
        var concatUrl = '?';
        
        var searchKey = $("#searchKey").val();
        if(searchKey != '' ){
            concatUrl += 'q='+searchKey;
        }


        @foreach($product_variations as $product_variation)
            var filterValue = get_filter('{{str_replace(' ', '', $product_variation->name)}}');
            if(filterValue != ''){
                concatUrl += '&{{strtolower(str_replace(' ', '', $product_variation->name))}}='+filterValue;
            }  
        @endforeach
       
        var brand = get_filter('brand');
        if(brand != '' ){
            concatUrl += '&brand='+brand;
        }        
       
        var perPage = null;
        var showItem = $("#perPage :selected").val();
        if(typeof showItem != 'undefined' || showItem != null){
           perPage = showItem;
           //check weather page null or set 
            if(page == null){
                //var active = $('.active .page-link').html();
                var page = 1;
            }
        }

        var sortby = $("#sortby :selected").val();
        if(typeof sortby != 'undefined' && sortby != ''){
            concatUrl += '&sortby='+sortby;
            //check weather page null or set 
            if(page == null){
                //var active = $('.active .page-link').html();
                var page = 1;
            }
        }

        var price_min = $("#price_min").val();
        if(price_min != '' ){
            concatUrl += '&price_min='+price_min;
        }

        var price_max = $("#price_max").val();
        if(price_max != '' ){
            concatUrl += '&price_max='+price_max;
        }

        if(page != null){concatUrl += '&page='+page;}
     
        var link = '{{ URL::current() }}/'+concatUrl;
            history.pushState({id: null}, null, link);

        $.ajax({
            url:link,
            method:"get",
            data:{
                filter:'filter',perPage:showItem
            },
            success:function(data){
                document.getElementById('dataLoading').style.display ='none';
        
                if(data){
                    $('#filter_product').html(data);
                    window.scrollTo({top: 100, behavior: 'smooth'});
                    //AD LIST FEATURE SLIDER
                    $('.ad-feature-slider').slick({
                        autoplay: true,
                        infinite: true,
                        arrows: true,
                        centerMode: true,
                        centerPadding: '120px',
                        speed: 800,
                        slidesToShow: 1,
                        prevArrow: '<i class="fa fa-long-arrow-alt-right dandik"></i>',
                        nextArrow: '<i class="fa fa-long-arrow-alt-left bamdik"></i>',
                        responsive: [
                          {
                            breakpoint: 1200,
                            settings: {
                              arrows: true,
                              centerMode: true,
                              centerPadding: '60px',
                              slidesToShow: 1
                            }
                          },
                          {
                            breakpoint: 768,
                            settings: {
                              arrows: true,
                              centerMode: true,
                              centerPadding: '40px',
                              slidesToShow: 1
                            }
                          },
                          {
                            breakpoint: 576,
                            settings: {
                              arrows: false,
                              centerMode: true,
                              centerPadding: '35px',
                              slidesToShow: 1
                            }
                          },
                          {
                            breakpoint: 401,
                            settings: {
                              arrows: false,
                              centerMode: true,
                              centerPadding: '0px',
                              slidesToShow: 1
                            }
                          }
                        ]
                    });
                }else{
                    $('#filter_product').html('Not Found');
                }
            },
            error: function() {
                document.getElementById('dataLoading').style.display ='none';
                $('#filter_product').html('<span class="ajaxError">Internal server error.!</span>');
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
       
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    function sortproduct(){
        filter_data();
    }
    function showPeriod(){
        filter_data();
    }

    function searchItem(value){
        if(value != ''){ filter_data(); }
    }

    $(document).on('click', '.pagination a', function(e){
        e.preventDefault();

        var page = $(this).attr('href').split('page=')[1];

        filter_data(page);
    });

    $('#resetAll').click(function(){
        $('input:checkbox').removeAttr('checked');
        $('input[type=checkbox]').prop('checked', false);
        $("#searchKey").val('');
        $('input:radio').removeAttr('checked');
         $("#price-range").val('0');
        //call function
        filter_data();
    });
</script>

@endsection

