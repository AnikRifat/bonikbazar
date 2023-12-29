<div class="table-responsive">
<p><?php echo e($title); ?> banner List</p>
<table  class="table table-bordered table-striped">

<tbody id="positionSorting">
    <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr id="banner<?php echo e($banner->id); ?>">
        <td> <img src="<?php echo asset('upload/images/banner/'. $banner->banner1); ?>" height="100"> </td>
        <td>
            <div class="custom-control custom-switch">
              <input onclick="satusActiveDeactive('banners', <?php echo e($banner->id); ?>)"  type="checkbox" <?php echo e(($banner->status == 1) ? 'checked' : ''); ?>  type="checkbox" class="custom-control-input" id="bannerstatus<?php echo e($banner->id); ?>">
              <label style="padding: 5px 12px" class="custom-control-label" for="bannerstatus<?php echo e($banner->id); ?>"></label>
            </div>
        </td>
        <td>
        <span  onclick="deleteBanner('<?php echo e($banner->id); ?>')" class="btn btn-danger btn-sm" ><i class="ti-trash" aria-hidden="true"></i> </span>
        </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
</div><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/admin/category/category-banner.blade.php ENDPATH**/ ?>