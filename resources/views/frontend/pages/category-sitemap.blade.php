@extends('layouts.frontend')
@section('title', Config::get('siteSetting.title'))

@section('css')
<link rel="stylesheet" href="{{asset('frontend')}}/css/custom/category-list.css">
@endsection
@section('content')
  
    @php $categories = App\Models\Category::where('parent_id', '=', null)->orderBy('position', 'asc')->where('status', 1)->get(); @endphp
    <section class="inner-section category-part">
            <div class="container">
                <div class="row">
                    @foreach($categories as $category)
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                        <div class="category-card">
                            <div class="category-head">
                                <img src="{{asset('frontend')}}/images/category/electronics.jpg" alt="category">
                                <a href="{{ route('home.category', $category->slug) }}" class="category-content">
                                    <h4>{{$category->name}}</h4>
                                    <p>(3678)</p>
                                </a>
                            </div>
                            @if(count($category->get_subcategory)>0)
                            
                            <ul class="category-list">
                                @foreach($category->get_subcategory as $subcategory)
                                <li><a href="{{ route('home.category', [$subcategory->slug]) }}"><h6>{{$subcategory->name}}</h6><p>(34)</p></a></li>
                                @endforeach
                            </ul>
                            
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="center-20">
                            <a href="#" class="btn btn-inline">
                                <i class="fas fa-eye"></i>
                                <span>show more categories</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

@section('js')
<script type="text/javascript">
    var $root = $('html, body');

    $('a[href^="#"]').click(function() {
        var href = $.attr(this, 'href');

        $root.animate({
            scrollTop: $(href).offset().top
        }, 500, function () {
            window.location.hash = href;
        });

        return false;
    });
</script>
@endsection