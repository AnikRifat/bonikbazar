<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">

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



<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
<script>
    var firebaseConfig = {
            apiKey: "AIzaSyC1b98OA76h7W6hbaQczEz_0BPMRWY7WfA",
            authDomain: "laravel-notification-fc8c6.firebaseapp.com",
            databaseURL: "https://laravel-notification-fc8c6-default-rtdb.firebaseio.com",
            projectId: "laravel-notification-fc8c6",
            storageBucket: "laravel-notification-fc8c6.appspot.com",
            messagingSenderId: "945925731493",
            appId: "1:945925731493:web:17bad8b5b980b84e17894c",
            measurementId: "G-95MT691RF6"
        };
    firebase.initializeApp(firebaseConfig);

    // Firebase messaging setup
    const messaging = firebase.messaging();
    messaging.onMessage(function (payload) {
        console.log("action: ", payload.data);
        location.reload();
        const title = payload.notification.title;
        const options = {
            body: payload.notification.body,
            icon: payload.notification.icon,
            clickAction: payload.data?.click_action,
        };
        new Notification(title, options);
        notification.onclick = function () {
            if (options.clickAction) {
                window.location.href = options.clickAction;
            }
        };
    });
</script>
</html>