@extends('layouts.frontend')
@section('title', 'Official Stores  | '. Config::get('siteSetting.site_name') )
@section('metatag')<title>Official Stores  | {{Config::get('siteSetting.site_name')}}</title>@endsection
    
@section('content')
    <!-- Main Container  -->
    <div class="breadcrumbs">
        <div class="container">
            
            <ul class="breadcrumb-cate">
                <li><a href="{{url('/')}}"><i class="fa fa-home"></i> </a></li>
                <li>Official Stores</li>
            </ul>
        </div>
    </div>
    @include('frontend.sliders.slider2')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background:#e2f5ff;margin: 0;padding: 15px;display: flex;justify-content: center;align-items: center;">
              <h4 style="color:#000;margin: 0;">Zuricart Official Stores</h4>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" >
                <div class="products-category">
                    @if(count($products)>0)
                        
                        <div class="products-list grid row number-col-6 so-filter-gird">
                            @foreach($products as $product)
                            <div class="product-layout col-lg-2 col-md-2 col-sm-4 col-xs-6">
                                @include('frontend.homepage.products')
                            </div>
                            @endforeach
                        </div>

                        <div class="product-filter product-filter-bottom filters-panel">
                            <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                               {{$products->appends(request()->query())->links()}}
                              </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of total {{$products->total()}} entries ({{$products->lastPage()}} Pages)</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
