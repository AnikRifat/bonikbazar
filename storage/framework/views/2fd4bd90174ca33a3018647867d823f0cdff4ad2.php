<?php $__env->startSection('title', 'Wishtlist | '. Config::get('siteSetting.site_name') ); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Main Container  -->
<div class="container bg-white mb-2 px-0">
    <?php echo $__env->make('users.inc.user_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <?php if((new \Jenssegers\Agent\Agent())->isDesktop()): ?>
        <div class="col-12 col-md-3">
            <?php echo $__env->make('users.inc.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div><?php endif; ?>
        <div class="col-12 col-md-9">
        <h3 class="mb-2">My Wish List</h3>
        <?php if(count($wishlists)>0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td class="text-center">Image</td>
                            <td class="text-left">Post Name</td>
                            <td class="text-right">Price</td>
                            <td class="text-right">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $wishlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wishlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="item<?php echo e($wishlist->id); ?>">
                                <td class="text-center">
                                    <?php if($wishlist->get_product !== null): ?>
                                    <a href="<?php echo e(route('post_details', $wishlist->get_product->slug)); ?>"><img src="<?php echo e(asset('upload/images/product/thumb/'. $wishlist->get_product->feature_image)); ?>" width="48" height="40" class="img-thumbnail"></a>
                                    <?php endif; ?>
                                </td>
                                <td class="text-left">
                                    <?php if($wishlist->get_product !== null): ?>
                                    <a href="<?php echo e(route('post_details', $wishlist->get_product->slug)); ?>"><?php echo e(Str::limit($wishlist->get_product->title, 30)); ?></a>
                                    <?php endif; ?>
                                </td>
                                <td class="text-right">
                                    <?php if($wishlist->get_product !== null): ?>
                                    <div class="price"><?php echo e(Config::get('siteSetting.currency_symble') . $wishlist->get_product->price); ?> </div>
                                    <?php endif; ?>
                                </td>
                                <td class="text-right">

                                    <a href="#" onclick="deleteConfirmPopup('<?php echo e(route("wishlist.remove", $wishlist->id)); ?>')" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Remove"><i class="fa fa-times"></i></a></td>
                            </tr>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="buttons clearfix">
                <div class="pull-right"><a href="<?php echo e(url('/')); ?>" class="btn btn-primary">Continue</a></div>
            </div>
        <?php else: ?>
            <div style="text-align: center;">
                <i style="font-size: 80px;" class="fa fa-heart"></i>
                <h1>Your wishlist is empty.</h1>
                <p>Looks line you have no items in your wishlist list.</p>
                Click here <a href="<?php echo e(url('/')); ?>">Continue Shopping</a>
            </div>
        <?php endif; ?>
        </div>
    </div>

</div>
<?php echo $__env->make('users.modal.delete-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- //Main Container -->
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/users/wishlist.blade.php ENDPATH**/ ?>