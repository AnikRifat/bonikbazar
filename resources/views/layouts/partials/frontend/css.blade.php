@yield('css-top')
<!-- FONTS -->
<link rel="stylesheet" href="{{asset('frontend')}}/fonts/flaticon/flaticon.css">
<link rel="stylesheet" href="{{asset('frontend')}}/fonts/font-awesome/fontawesome.css">

<!-- VENDOR -->
<link rel="stylesheet" href="{{asset('frontend')}}/css/vendor/slick.min.css">
<link rel="stylesheet" href="{{asset('frontend')}}/css/vendor/bootstrap.min.css">

<!-- CUSTOM -->
<link rel="stylesheet" href="{{asset('frontend')}}/css/custom/main.css">
<link rel="stylesheet" href="{{asset('frontend')}}/css/custom.css">
<link rel="stylesheet" href="{{asset('css')}}/toastr.css">
<style type="text/css">

	#loadingData { z-index: 999999; width: 100%; height: 100%; top: 25%; left: 50%; transform: translate(-50%, -50%); display: none; position: absolute; background: url('{{ asset("assets/images/loading.gif")}}') no-repeat center; }
	#loadingData-sm { z-index: 9999; width: 100%; height: 20px; background: url('{{ asset("assets/images/loading.gif")}}') no-repeat center; }
	.header-part{ background: {{ config('siteSetting.header_bg_color') }}; color: {{ config('siteSetting.header_text_color') }} } 
	.header-part span, .header-part .btn{ color: {{ config('siteSetting.header_text_color') }} }
	.notify-item span{ color:#555555; }
	.footer_area{background: {{ config('siteSetting.footer_bg_color') }}; color: {{ config('siteSetting.footer_text_color') }} }
	.footer_area p,  .footer_area a,  .footer_area h3,  .footer_area i{color: {{ config('siteSetting.footer_text_color') }} }
	.footer_area .title-footer{border-bottom:1px solid {{ config('siteSetting.footer_text_color') }} !important; }
	.copyright_area li a:before{background: {{ config('siteSetting.copyright_bg_color') }} !important; color:{{ config('siteSetting.copyright_text_color') }}}
	.copyright_area { text-align: center; border-top: 1px solid #857e7e; background: {{ config('siteSetting.copyright_bg_color') }} !important; color: {{ config('siteSetting.copyright_text_color') }} !important; }
	.copyright_area p{ color: {{ config('siteSetting.copyright_text_color') }} !important; }
</style>
@yield('css')
