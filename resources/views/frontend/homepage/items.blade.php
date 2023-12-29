<section style="margin:0;padding: 1em 0; @if($section->layout_width == 1) background:{{$section->background_color}} @endif">
    <div class="container" @if($section->layout_width != 1) style="background:{{$section->background_color}};border-radius:0;" @endif>
        <div class="row">
            <div class="col-md-12 col-xs-12 content">
                <div class="content-boxss">
                    <div class="box">
                        <img src="{{ asset('upload/images/item.png')}}" alt="logo">
                    </div>
                    <div class="content-box">
                        <h3 class="headingOw">Get items delivered to you with</h3>
                        <p class="subn">Choose from over 600 items that can be delivered to your doorstep. Order online and enjoy our <b>Buyer Protection </b><br>program, which means that we’ll replace the item for FREE if it’s not as described in the ad!</p>
                        <a @if(Auth::check()) href="{{route('post.create')}}" @else data-toggle="modal" data-target="#so_sociallogin" href="javascript:void(0)" @endif class="gtm-home-explore-jobs-cta" type="button">
                        <span class="pad-right">Shop now</span>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>