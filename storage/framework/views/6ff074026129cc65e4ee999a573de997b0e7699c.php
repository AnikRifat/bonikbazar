<?php echo $__env->yieldContent('css-top'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(mix('css/app.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/custom.css')); ?>">

<?php echo $__env->yieldContent('css'); ?>
<?php echo $__env->yieldContent('perpage-css'); ?>
<style type="text/css">
    .loadingData
    {
        z-index: 9999;
        width: 100%;
        height: 20px;
        background: url('<?php echo e(asset("assets/images/loader.gif")); ?>') no-repeat center;
    }
    #allpageLoading
    {
        z-index: 999999;
        width: 100%;
        height: 100%;
        display: none;
        position: absolute;
        top: 10%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: url('<?php echo e(asset("assets/images/loading.gif")); ?>') no-repeat center;
    }    

    #pageLoading
    {
        z-index: 999999;
        width: 100%;
        height: 100%;
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: url('<?php echo e(asset("assets/images/loading.gif")); ?>') no-repeat center;
    }
    .container-fluid { padding: 0 10px !important; }
    .sidebar-nav ul li a:hover {background: #343a400a}
    .switch-box{top: -12px !important}
</style>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<?php /**PATH D:\BonikBazar\bonikbazar\resources\views/layouts/partials/backend/css.blade.php ENDPATH**/ ?>