@php $specialSection = App\Models\HomepageSection::with(['sectionItems' => function ($query) {
$query->where('status', '=', 'active')->orderBy('position', 'asc'); }])->where('slug', 'special-item')->where('status', 1)->first(); @endphp
<section class="container section" style="background:transparent;">
    <div class="col-xs-12 col-md-8" style="">
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
    <div class="col-xs-12 col-md-4 hidden-xs">
        <div class="module-right" style="margin: 25px 0 0; border-radius: 3px;">
            <div class="row">
                @foreach($specialSection->sectionItems->take($specialSection->item_number) as $sectionItem)
                <div class="col-sm-6 col-xs-6" style="margin-bottom:15px;">
                    <a class="link exclick" href="{{url($sectionItem->custom_url)}}" >
                        <span class="img-wrap">
                            <img src="{{asset('upload/images/homepage/'. $sectionItem->thumb_image)}}"  alt="{{ $sectionItem->item_title }}">
                        </span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</section>





