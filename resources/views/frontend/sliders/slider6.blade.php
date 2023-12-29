@php $specialSection = App\Models\HomepageSection::with(['sectionItems' => function ($query) {
$query->where('status', '=', 'active')->orderBy('position', 'asc'); }])->where('slug', 'special-item')->where('status', 1)->first(); @endphp
<section class="sliderArea" >
    <div class="container">
    <div class="row" >
      <div class="col-xs-12 col-md-3 ">
        <div class="megamenu-style-dev megamenu-dev" >
            <div class="responsive">
              <div class="so-vertical-menu no-gutter">
                  <nav class="navbar-default">
                      <div class=" container-megamenu  container   vertical  ">
                       
                        <div class="vertical-wrapper">
                          <span id="remove-verticalmenu" class="fa fa-times"></span>
                          <div class="megamenu-pattern">
                            <div class="container">
                              <ul class="megamenu" data-transition="slide" data-animationtime="300">
                                @php
                                if(!Session::has('categories')){
                                  $categories =  \App\Models\Category::where('parent_id', '=', null)->orderBy('orderBy', 'asc')->where('status', 1)->get();
                                  Session::put('categories', $categories);
                              }
                              $categories = Session::get('categories'); 
                              @endphp
                              @foreach($categories as $category)

                                @if(count($category->get_subcategory)>0)
                                  <li class="item-vertical  css-menu with-sub-menu hover">
                                                    <p class="close-menu"></p>
                                                    <a href="{{ route('home.category', $category->slug) }}" class="clearfix">
                                                    <span>
                                                    <strong><img width="20" src="{{asset('upload/images/category/thumb/'.$category->image)}}" alt="{{$category->name}}"> {{$category->name}}</strong>
                                                    </span>
                                                    <b class="fa fa-caret-right"></b>
                                                    </a>
                                                    <div class="sub-menu" style="width: 934px;">
                                                      <div class="content">
                                                        <div class="row">
                                                          <div class="col-sm-3">
                                                            <div class="row">
                                                              @php $max_iteration = round(count($category->get_subcategory) / 4);  @endphp
                                                              @foreach($category->get_subcategory as $menuRow => $subcategory)
                                                          
                                                                <div class="col-sm-12 static-menu">
                                                                  <div class="menu">
                                                                    <ul>
                                                                      <li>
                                                                        <a href="{{ route('home.category', [$category->slug, $subcategory->slug]) }}" class="main-menu">{{$subcategory->name }}
                                                                        </a>
                                                                        @if(count($subcategory->get_subcategory)>0)
                                                                        <ul>
                                                                          @foreach($subcategory->get_subcategory as $childcategory)
                                                                          <li><a href="{{ route('home.category',[ $category->slug, $subcategory->slug, $childcategory->slug]) }}" > {{$childcategory->name}}</a></li>
                                                                          @endforeach
                                                                        </ul>
                                                                        @endif
                                                                      </li>
                                                                    </ul>
                                                                  </div>
                                                                </div>
                                                              @if(($menuRow + 1) % $max_iteration == 0)
                                                            </div>
                                                          </div> <div class="col-sm-3">
                                                            <div class="row">@endif
                                                           @endforeach
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </li>
                                @else
                                  <li class="item-vertical">
                                    <p class="close-menu"></p>
                                    <a href="{{ route('home.category', $category->slug) }}" class="clearfix">
                                    <span>
                                    <strong><img width="30" src="{{asset('upload/images/category/thumb/'.$category->image)}}" alt=""> {{$category->name}}</strong>
                                    </span>
                                    </a>
                                  </li>
                                @endif
                                @endforeach

                                <li class="loadmore"><i class="fa fa-plus-square"></i><span class="more-view"> More Categories</span></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                  </nav>
              </div>
            </div>
        </div>
      </div>
      <div class="col-xs-12 col-md-{{($specialSection) ? 6 : 9}} " style="padding: 0px;margin:10px 0 0px;">
        <div class="module sohomepage-slider so-homeslider-ltr" style="overflow: hidden; max-height: 430px; width: 100% !important; position: relative;">

          <div class="modcontent">
            <div id="sohomepage-slider1">
              <div class="so-homeslider yt-content-slider full_slider owl-drag" data-rtl="yes" data-autoplay="yes" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="10" data-items_column00="1" data-items_column0="1" data-items_column1="1" data-items_column2="1"  data-items_column3="1" data-items_column4="1" data-arrows="yes" data-pagination="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
              @foreach($sliders as $index => $slider)
              <div class="item" data-background="{{$slider->bg_color}}">
                 <a href="{{$slider->btn_link}}" title="{{$slider->title}}" target="_self">
                 <img class="responsive" src="{{asset('upload/images/slider/'.$slider->phato)}}" alt="">
                 </a>
                 <div class="sohomeslider-description">
                 </div>
              </div>
              @endforeach
             </div>
            </div>
          </div>
        </div>
      </div>
      @if($specialSection)
      <div class="col-xs-12 col-md-3" style="margin: 10px 0;">
        <div class="module-right" style="background: #fff;  padding:5px 8px;border-radius: 3px;">
          <header class="title" style="background:{{ config('siteSetting.header_bg_color') }};padding: 5px; text-align: center;margin-bottom: 15px;">
                <h4 style="color:{{$specialSection->text_color ?? '#fff'}};">{{$specialSection->title}}</h4>
            </header>
            
            <div class="row">
                
                @foreach($specialSection->sectionItems->take($specialSection->item_number) as $sectionItem)
                <div class="col-xs-12" style="margin-bottom:15px;">
                    <a class="link exclick" href="{{url($sectionItem->custom_url)}}" >
                        <span class="img-wrap">
                            <img src="{{asset('upload/images/homepage/'. $sectionItem->thumb_image)}}"  title="{{ $sectionItem->item_title }}" alt="">
                        </span>
                    </a>
                </div>
                @endforeach
                
                <div class="col-xs-12">
                  <div title="View More {{$specialSection->title}}" class="more" style="text-align: center;">
                    <a style="color:{{$specialSection->text_color ?? '#fff'}};" href="{{url('mega-discount')}}" rel="nofollow" >View More<i class="fa fa-angle-right"></i></a>
                </div>
                </div>
            </div>
        </div>
      </div>
      @endif
    </div>
  </div>
</section>