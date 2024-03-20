<style>
.h-56 {height: 59px;}
.contents {display: contents;}
.accordion .collapse.show {display: block;}
.accordion .card-header {cursor: pointer;}
.rounded-3 {border-radius: 3px !important;}
.rounded {border-radius: .4rem!important;}
.rounded-1 {border-radius: 1em!important;}
.border-r {border-right: 2px solid #fff;}
.border-rr {border-right: 1px solid #000;}
.border-b {border-bottom: 1px solid #000;}
.support {
    z-index: 0;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
}
.cchat:hover .support {
    display: block;
}
.z-3 {
    z-index: 9;
}
.cchat .support {
    display: none;
}
.borders {border: 1px solid #000;}
.w-250 {width: 250px;}
.h-300 {object-fit: cover;height: 250px;}
.w-150 {
    width: 150px;
    height: 150px;
    object-fit: cover;
}
.cchat img {z-index: 1;}
.cchat {
    left: 30px;
    bottom: 40px;
    display: flex;
    align-items: center;
}
.ppb-5 {padding-bottom: 20px!important;}
.bgs {
    padding: 32px 16px 12px;
    background: linear-gradient(180deg,hsla(0,0%,80.8%,0) -2%,rgba(0,0,0,.75) 80%);
}
.collapsed .rotate-90{rotate: 0deg;}
.rotate-90{rotate: 90deg;}
.left-0 {left: 0;}
.f-12 {font-size: 12px;}
.shadow-bb {box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;}
.shadow-b {box-shadow: 0 0 5px 0 #d4ded9;}
.dropify-wrapper {
    height: 150px;
}
.gap {gap: 5px;}
.title {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 30px;
}
.mh-300 {max-height: 310px;object-fit: cover;}
.rounded-l {
    border-top-left-radius: .6rem!important;
    border-bottom-left-radius: .6rem!important;
}
.page-item.active .page-link {
    background: #000000;
    color: #fbd601;
}
.page-item:first-child .page-link, .page-item:last-child .page-link {
    border-radius: 0;
}
.inbox-chat-list {
    min-height: 350px !important;
}
.message-inbox {
    padding: 10px !important;
}
.page-item.active .page-link {
    color: #fbd601 !important;
}
.h1s {
    transform: translateY(-50%);
    font-size: 16px;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.page-link {
    border-radius: 0;
}
.mt--4 {margin-top: -15px;}
.h-33 {height: 33px;}
.bib {background-image: url("/upload/images/bimgb.png");background-repeat: round;}

.transform-180 {transform: rotate(180deg);}
.bottom-0{bottom: 0;}

.top-50 {top: 50%;}
.pt {color:#009877;}
.bg-dark{background:#000 !important;}
.yt {color:#000;}
.yb {background:#f2e847;}
.e6 {background:#e6e6e6;}
.gb {background:#f5f5f5 !important;}

.ab {background:#FFFDEB !important;}

.by2 {border:2px solid #f9ef6b !important;}
.bb2 {border:2px solid #1f1e13 !important;}

.bt {color:#1f1e13;}
.bb {background:#e6e6e6;}
.eb {background:#E6E6E6;}
.mb {background:#EDEDED;}

.gt {color:#268000;}
.gb {background:#268000;}

.rt {color:#DC0000;}
.rb {background:#DC0000;}
.right-0{right: 0;}

.hl-2 {
    -webkit-column-count: 2;
    -moz-column-count: 2;
    column-count: 2;
    -webkit-column-gap: 10px;
    -moz-column-gap: 10px;
    column-gap: 10px;
    orphans: 1;
    widows: 1;
}
.user-f .follow {
    background: url('<?php echo e(asset('upload/images/white-btn.svg')); ?>');
    padding: 5px 8px 5px 25px;
    background-repeat: no-repeat;
}
.user-f .followy {
    background: url('<?php echo e(asset('upload/images/yellow-btn.svg')); ?>');
    padding: 5px 8px 5px 25px;
    background-repeat: no-repeat;
}
.text-red {
    color: red;
}
.footer-pagection {
    justify-content: center;
}
.ff:after {
    border-top: 12px solid;
    border-bottom: 12px solid;
    border-right: 0;
    border-left: 9px solid transparent;
    position: absolute;
    top: 0;
    border-top-color: #f9ef6b;
    border-bottom-color: #f9ef6b;
    content: '';
    transform: rotate(180deg);
}
[type="checkbox"]:checked+label:after,
[type="radio"]:checked+label:after {
  background-color: #1f1e13;
  border: 1px solid #1f1e13;
  border-radius: 0%;
}
[type="checkbox"]:not(:checked)+label:before,
[type="radio"]:not(:checked)+label:before {
    border-radius: 0%;
    border: 1px solid #1f1e13;
    background: #fff;
}
[type="checkbox"]+label:before, [type="checkbox"]+label:after,
[type="radio"]+label:before, [type="radio"]+label:after {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    margin: 4px;
    width: 16px;
    height: 16px;
    z-index: 0;
    transition: .28s ease;
}
[type="checkbox"]:not(:checked)+label, [type="checkbox"]:checked+label,
[type="radio"]:not(:checked)+label, [type="radio"]:checked+label {
    position: relative;
    padding-left: 25px;
    cursor: pointer;
    display: inline-block;
    height: 25px;
    line-height: 25px;
    font-size: 1rem;
    transition: .28s ease;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
input[type="checkbox" i],
input[type="radio" i]{
      display: none;
}
.dropdown-toggle::after {display: none;}
article::after {
    content: '';
    display: block;
    position: sticky;
    bottom: 0;
    left: 0;
    width: 100%;
    background: -moz-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
    background: -webkit-linear-gradient(top, rgba(255,255,255,0) 0%,rgba(255,255,255,1) 100%);
    background: linear-gradient(to bottom, rgba(255,255,255,0) 0%,rgba(255,255,255,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00ffffff', endColorstr='#ffffff',GradientType=0 );
    height: 21px;
}
.sh:hover {background: #1f1e13;border: 1px solid #f5ed74;}
.sh:hover img {filter: brightness(0) invert(1);}
.mt4 {margin-top: -3em;}
@media (min-width: 1200px){
.container, .container-lg, .container-md, .container-sm, .container-xl {
    max-width: 940px !important;
}
.mt4 {margin-top: -4em;}

.col-55 {
    -ms-flex: 0 0 20%;
    flex: 0 0 20%;
    max-width: 20%;
}
.hl-3 {
    -webkit-column-count: 3;
    -moz-column-count: 3;
    column-count: 3;
    -webkit-column-gap: 10px;
    -moz-column-gap: 10px;
    column-gap: 10px;
    orphans: 1;
    widows: 1;
}
.iuser {object-fit: cover;height: 240px;max-width: 180px;}
}
.hidden-md {
    display: none;
}
@media (max-width: 600px) {
    .hidden-md {
    display: block;
}
.breadcrumbs {
    display: none;
}
.mmm{margin:0}
.d-h-flex {
    display: flex;
    flex-direction: column;
    width: 100%;
}
.bottom-1 {bottom: 10px;right: 20px;}
.h-300{height: 150px}
.iuser {max-height: 180px;width: 100%;object-fit: cover;}
.d-h-flex td, .d-h-flex th {display: inline-flex;width: 100%; gap: 5px}
.ppb-5 {padding-bottom: 0px!important;}
.top-0 {top: 0;z-index: 999;}
.plus-btn i {color: #000000;background: #fed700;}
.cchat {
    bottom: 60px;
    display: flex;
    justify-content: flex-end;
}
.hl-2 {
    -webkit-column-count: 1;
    -moz-column-count: 1;
    column-count: 1;
    -webkit-column-gap: 10px;
    -moz-column-gap: 10px;
    column-gap: 10px;
    orphans: 1;
    widows: 1;
}
.htt {
    display: none;
}
.her {border: 1px solid #000 !important;}
.mbox {
    border: 0;
    border-radius: 0;
    margin: 0 !important;
    padding: 0;
}
button.bhera {
    position: absolute;
    right: 30px;
    bottom: -160px;
}
.mt4 {
    margin-top: -4em;
}
.w-150 {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border: 2px solid #000000 !important;
}
.h1s {
    display: none;
}
}
.col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
    position: relative;
    width: 100%;
    padding-right: 4px !important;
    padding-left: 4px !important;
}
a,
.product-widget-link {
    font-size: 18px !important;
    color: #000000 !important;
}
.hera-top a {
    max-height: 250px;
    overflow: hidden;
    width: 100%;
}
</style>
<header class="bg-white mb-2 hidden-xs">
    <div class="bg-dark w-100 h-56 position-absolute "></div>
    <div class="row">
        <div class="container px-0">
            <div class="row align-items-center">
                <div class="col-md-3 col-sm-6 pl-0">
                    <a href="<?php echo e(url('/')); ?>" class="py-3">
                        <img class="mw-100" src="<?php echo e(asset('upload/images/logo/'.config('siteSetting.logo'))); ?>" alt="logo">
                    </a>
                </div>
       
                <div class="col-md-7">
                    <form action="<?php echo e(route('home.category', [ (Request::route('location') ? Request::route('location') : 'all'), (Request::route('catslug') ? Request::route('catslug') : null) ])); ?>" method="get" id="searchForm" class="w-100 d-flex align-items-center bb2 rounded e6"> 
                        <input type="text" id="searchKey" value="<?php echo e(Request::get('q')); ?>" name="q" class="searchKey w-100 p-2 rounded-l" placeholder="What are you looking for?">
                        <button type="submit" class="contents">
                            <img class="px-2" src="<?php echo e(asset('upload/images/search-y.png')); ?>" alt="search">
                        </button>
                    </form>
                    <div class="d-flex align-items-center justify-content-center mt-1 mb-n4">
                        <b class="mr-2">Live Ads : </b>
                        <b class="pt"><?php echo e(App\Models\Product::where("status", "active")->count()); ?></b>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 pr-0">
                    <div class="d-flex justify-content-end flex-column">
                        <div class="d-flex justify-content-end py-2 icon-size">
                            <ul class="d-flex justify-content-end">
                                <li class="mr-3">
                                    <a href="<?php echo e(url('lang')); ?>/<?php echo e((Config::get('app.locale') == 'en') ? 'bd' : 'en'); ?>" type="button" class="border-r pr-2">
                                        <img width="25" height="25" src="<?php echo e(asset('upload/images/Language.png')); ?>" alt="logo">
                                    </a>
                                    <?php if(Auth::check()): ?>
                                    <div class="dropdown-card notify-item-list"></div>
                                    <?php endif; ?>
                                </li>
                                <li
                                <?php if(Auth::check()): ?>
                                    onclick="getNotification('message-user-list')"
                                <?php else: ?>
                                    data-toggle="modal" data-target="#so_sociallogin"
                                <?php endif; ?>
                                class="mr-3">
                                    <a href="<?php echo e(route('user.message')); ?>" class="border-r pr-2">
                                        <img width="25" height="25" src="<?php echo e(asset('upload/images/chat.png')); ?>" alt="logo">
                                    </a>
                                    <?php if(Auth::check()): ?>
                                    <div class="dropdown-card message-user-list"></div>
                                    <?php endif; ?>
                                </li>
                            </ul>
                            <?php if(Auth::check()): ?>
                            <div class="btn-group user">
                              <button type="button" class="border-none p-0 btn dropdown-toggle users" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                                  <img width="25" height="25" src="<?php echo e(asset('upload/users')); ?>/<?php echo e((Auth::user()->photo) ? Auth::user()->photo : 'default.png'); ?>" alt="user">
                              </button>
                              <div class="dropdown-menu dropdown-menu-lg-right">
                                <a href="<?php echo e(route('user.dashboard')); ?>" class="dropdown-item">Dashboard</a>
                                <a href="<?php echo e(route('post.list')); ?>" class="dropdown-item">My Ads</a>
                                <a href="<?php echo e(route('user.packageHistory')); ?>" class="dropdown-item"> My Package</a>
                                <a href="<?php echo e(route('user.change-password')); ?>" class="dropdown-item"> Change Password </a>
                                <a href="<?php echo e(route('userLogout')); ?>" class="dropdown-item">Logout </a> 
                                
                              </div>
                            </div>
                            <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>">
                                <img width="25" height="25" src="<?php echo e(asset('upload/images/user.png')); ?>" alt="logo">
                            </a>
                            <?php endif; ?>
                        </div>
                        <a
                        <?php if(Auth::check()): ?>
                            href="<?php echo e(route('post.create')); ?>"
                        <?php else: ?>
                            data-toggle="modal" data-target="#so_sociallogin" href="javascript:void(0)"
                        <?php endif; ?>
                        class="yb p-2 text-center bt bb2 rounded font-weight-bold mt-2 f-12">POST YOUR AD FREE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<header class="d-md-none">
    <div class="container bg-dark mb-2 position-fixed top-0">
        <div class="d-flex align-items-center justify-content-between">
            <a href="<?php echo e(url('/')); ?>" class="py-1">
                <img class="mw-100" height="40" src="<?php echo e(asset('upload/images/mlogo.png')); ?>" alt="logo">
            </a>
            <div>
                <a href="<?php echo e(url('lang')); ?>/<?php echo e((Config::get('app.locale') == 'en') ? 'bd' : 'en'); ?>" type="button" class="border-r pr-2">
                    <img width="25" height="25" src="<?php echo e(asset('upload/images/Language.png')); ?>" alt="logo">
                </a>
                <?php if(Auth::check()): ?>
                <div class="dropdown-card notify-item-list"></div>
                <?php endif; ?>
                <button type="button" id="openModalBtn">
                  <img width="35" height="30" class="pl-2" src="<?php echo e(asset('upload/images/search.png')); ?>" alt="search">
                </button>
                
            </div>
        </div>
    </div>
    <div style="height:40px;"></div>
</header>
<div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="d-flex" role="document">
        <form action="<?php echo e(route('home.category', [ (Request::route('location') ? Request::route('location') : 'all'), (Request::route('catslug') ? Request::route('catslug') : null) ])); ?>" method="get" id="searchForm" class="w-100 d-flex align-items-center bb2 rounded e6"> 
            <input type="text" id="searchKey" value="<?php echo e(Request::get('q')); ?>" name="q" class="searchKey w-100 p-2 rounded-l" placeholder="What are you looking for?">
            <button type="submit" class="contents">
                <img class="px-2" src="<?php echo e(asset('upload/images/search-y.png')); ?>" alt="search">
            </button>
        </form>
        <button type="button" class="close bg-white p-2" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
  </div>
</div>
<nav class="mobile-nav">
    <div class="container">
        <div class="mobile-group">
            <a href="<?php echo e(url('/')); ?>" class="mobile-widget">
                <i class="fa fa-home"></i>
                <span>home</span>
            </a>
          
            <a href="<?php echo e(route('user.message')); ?>" class="mobile-widget">
                <i class="fa fa-envelope"></i>
                <span>message</span>
            </a>
            <a  <?php if(Auth::check()): ?> href="<?php echo e(route('post.create')); ?>" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" href="javascript:void(0)" <?php endif; ?>  class="mobile-widget plus-btn">
                <i class="fa fa-plus"></i>
                <span>Ad Post</span>
            </a>
            <a href="<?php echo e(route('allNotifications')); ?>" class="mobile-widget">
                <i class="fa fa-bell"></i>
                <span>notify</span>
                <sup class="countNotifications">0</sup>
            </a>

            <?php if(Auth::check()): ?>
            <a href="javascript:void(0)" class="mobile-widget open-sidebar">
                <i class="fa fa-user"></i>
                <span>Dashboard</span>
            </a>
            <?php else: ?>
            <a data-toggle="modal" data-target="#so_sociallogin" href="javascript:void(0)" class="mobile-widget">
                <i class="fa fa-user"></i>
                <span>Account</span>
            </a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<script>
function isMobileDevice() {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

if (isMobileDevice()) {
    let lastScrollTop = 0;

    window.addEventListener("scroll", function() {
        const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

        if (currentScroll > lastScrollTop) {
            // Scrolling down
            const mobileNav = document.querySelector('.mobile-nav');
            if (mobileNav) {
                mobileNav.style.display = "none";
            }
        } else {
            // Scrolling up
            const mobileNav = document.querySelector('.mobile-nav');
            if (mobileNav) {
                mobileNav.style.display = "block";
            }
        }

        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
    });
}

document.getElementById('openModalBtn').addEventListener('click', function() {
    $('#myModal').modal('show');
  });
</script><?php /**PATH D:\BonikBazar\bonikbazar\resources\views/layouts/partials/frontend/header1.blade.php ENDPATH**/ ?>