<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="shortcut icon" type="text/css" href="{{asset('upload/images/logo/'. Config::get('siteSetting.favicon'))}}"/>
  <title>@yield('title')</title>
  @yield('metatag')
  @include('layouts.partials.frontend.css')
  {!! config('siteSetting.header') !!}
</head>
<body class="mb">
  @php 
  if(!Session::has('menus')){
    $menus =  \App\Models\Menu::with(['get_categories'])->orderBy('position', 'asc')->where('status', 1)->get();
    Session::put('menus', $menus);
  }
  $menus = Session::get('menus');
  $categories =  \App\Models\Category::with('get_subcategory')->where('parent_id', '=', null)->orderBy('position', 'asc')->where('status', 1)->get(); @endphp
  <div id="app">
    <!-- Header Start -->
    @include("layouts.partials.frontend.header1")
    <!-- Header End -->
    <div class="contentArea">
    @yield('content')
    </div>

  @if (\Route::current()->getName() != 'user.message') 
  <!-- Footer Area start -->
  @include("layouts.partials.frontend.footer1")

  @endif
  <!--  Footer Area End -->
  @include('users.modal.login')
  @if(Auth::check())
  @include('layouts.partials.frontend.user-sidebar')
  @endif
  </div>
  @include('layouts.partials.frontend.scripts')
  {!! config('siteSetting.google_analytics') !!}
  {!! config('siteSetting.google_adsense') !!}
  {!! config('siteSetting.footer') !!}
 
</body>
</html>