<?php echo $__env->yieldContent('css-top'); ?>
<!-- FONTS -->
<link rel="stylesheet" href="<?php echo e(asset('frontend')); ?>/fonts/flaticon/flaticon.css">
<link rel="stylesheet" href="<?php echo e(asset('frontend')); ?>/fonts/font-awesome/fontawesome.css">

<!-- VENDOR -->
<link rel="stylesheet" href="<?php echo e(asset('frontend')); ?>/css/vendor/slick.min.css">
<link rel="stylesheet" href="<?php echo e(asset('frontend')); ?>/css/vendor/bootstrap.min.css">

<!-- CUSTOM -->
<link rel="stylesheet" href="<?php echo e(asset('frontend')); ?>/css/custom/main.css">
<link rel="stylesheet" href="<?php echo e(asset('frontend')); ?>/css/custom.css">
<link rel="stylesheet" href="<?php echo e(asset('css')); ?>/toastr.css">
<style type="text/css">

	#loadingData { z-index: 999999; width: 100%; height: 100%; top: 25%; left: 50%; transform: translate(-50%, -50%); display: none; position: absolute; background: url('<?php echo e(asset("assets/images/loading.gif")); ?>') no-repeat center; }
	#loadingData-sm { z-index: 9999; width: 100%; height: 20px; background: url('<?php echo e(asset("assets/images/loading.gif")); ?>') no-repeat center; }
	.header-part{ background: <?php echo e(config('siteSetting.header_bg_color')); ?>; color: <?php echo e(config('siteSetting.header_text_color')); ?> } 
	.header-part span, .header-part .btn{ color: <?php echo e(config('siteSetting.header_text_color')); ?> }
	.notify-item span{ color:#555555; }
	.footer_area{background: <?php echo e(config('siteSetting.footer_bg_color')); ?>; color: <?php echo e(config('siteSetting.footer_text_color')); ?> }
	.footer_area p,  .footer_area a,  .footer_area h3,  .footer_area i{color: <?php echo e(config('siteSetting.footer_text_color')); ?> }
	.footer_area .title-footer{border-bottom:1px solid <?php echo e(config('siteSetting.footer_text_color')); ?> !important; }
	.copyright_area li a:before{background: <?php echo e(config('siteSetting.copyright_bg_color')); ?> !important; color:<?php echo e(config('siteSetting.copyright_text_color')); ?>}
	.copyright_area { text-align: center; border-top: 1px solid #857e7e; background: <?php echo e(config('siteSetting.copyright_bg_color')); ?> !important; color: <?php echo e(config('siteSetting.copyright_text_color')); ?> !important; }
	.copyright_area p{ color: <?php echo e(config('siteSetting.copyright_text_color')); ?> !important; }
</style>
<?php echo $__env->yieldContent('css'); ?>
<?php /**PATH D:\bonik_bazar_latest\bonikbazar\resources\views/layouts/partials/frontend/css.blade.php ENDPATH**/ ?>