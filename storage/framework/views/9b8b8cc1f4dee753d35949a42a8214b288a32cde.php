<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="shortcut icon" type="text/css" href="<?php echo e(asset('upload/images/logo/'. Config::get('siteSetting.favicon'))); ?>"/>
  <title><?php echo $__env->yieldContent('title'); ?></title>
  <?php echo $__env->yieldContent('metatag'); ?>
  <?php echo $__env->make('layouts.partials.frontend.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo config('siteSetting.header'); ?>

</head>
<body class="mb">
  <?php 
  if(!Session::has('menus')){
    $menus =  \App\Models\Menu::with(['get_categories'])->orderBy('position', 'asc')->where('status', 1)->get();
    Session::put('menus', $menus);
  }
  $menus = Session::get('menus');
  $categories =  \App\Models\Category::with('get_subcategory')->where('parent_id', '=', null)->orderBy('position', 'asc')->where('status', 1)->get(); ?>
  <div id="app">
    <!-- Header Start -->
    <?php echo $__env->make("layouts.partials.frontend.header1", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Header End -->
    <div class="contentArea">
    <?php echo $__env->yieldContent('content'); ?>
    </div>

  <?php if(\Route::current()->getName() != 'user.message'): ?> 
  <!-- Footer Area start -->
  <?php echo $__env->make("layouts.partials.frontend.footer1", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php endif; ?>
  <!--  Footer Area End -->
  <?php echo $__env->make('users.modal.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php if(Auth::check()): ?>
  <?php echo $__env->make('layouts.partials.frontend.user-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
  </div>
  <?php echo $__env->make('layouts.partials.frontend.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo config('siteSetting.google_analytics'); ?>

  <?php echo config('siteSetting.google_adsense'); ?>

  <?php echo config('siteSetting.footer'); ?>

 
</body>
</html><?php /**PATH D:\Minhaz\bonikbazar\resources\views/layouts/frontend.blade.php ENDPATH**/ ?>