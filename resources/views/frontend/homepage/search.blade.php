@php $states = App\Models\State::withCount('productsByState')->where('status', 1)->get(); @endphp
<section style="margin:0;padding: 4em 0 2em; @if($section->layout_width == 1) background:{{$section->background_color}} @endif">
    <div class="container" @if($section->layout_width != 1) style="background:{{$section->background_color}};border-radius:0;" @endif>
        <form action="{{route('home.category')}}" method="get" class="header-form">
            <span class="btn filterBtn btn-block hrta" type="submit" data-toggle="modal" data-target="#locationmodal" >
               <i style="color: #ffffff;margin-right: 7px;font-size: 20px;" class="fa fa-map-marker"></i> <span class="hidden-xs"> All of &nbsp; </span> location
            </span>
            <div class="header-search">
                <input type="text" id="searchKey" value="{{ Request::get('q') }}" name="q" class="searchKey" placeholder="What are you looking for?">
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
</section>
<div class="modal fade" id="locationmodal" role="dialog" style="display: none;">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="border: none;padding-bottom: 0;">
                <h4 class="modal-title">Select Location</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding: 0 20px;">
                <ul class="product-widget-list">
                    <li><a href="{{ route('home.category')}}"> All location</a></li>
                    @foreach($states as $state)
                    <li class="product-widget-dropitem" style="margin: 0;padding: 8px; border-bottom: 1px solid #f1f1f1;">
                        <button type="button">
                        <a href="{{ route('home.category', $state->slug)}}"> {{$state->name}} ({{$state->products_by_state_count}})</a></li>
                           
                        
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>