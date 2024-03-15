<input type="hidden" value="<?php echo e($data->id); ?>" name="id">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="ads_name">Ads Name</label>
            <input type="text" value="<?php echo e($data->ads_name); ?>"  name="ads_name"  id="ads_name" placeholder="Enter ads name" class="form-control" >
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="page">Select Page</label>
            <select name="page"  required="required" id="page" class="form-control custom-select">
                <option value="all">All page</option>
                <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if($data->page == $page->slug): ?> selected <?php endif; ?> value="<?php echo e($page->slug); ?>"><?php echo e($page->title); ?></option>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group"> 
            <label for="position">Position</label>
            <select name="position" required="required" id="position" class="form-control custom-select">
                <option value="" selected disabled>Select an option</option>
                <option value="top" <?php echo e(($data->position == 'top') ? 'selected' : ''); ?>>Ad For (Top view)</option>
                <option value="bottom" <?php echo e(($data->position == 'bottom') ? 'selected' : ''); ?>>Ad For (Bottom view)</option>
                <option value="leftSide" <?php echo e(($data->position == 'lefSide') ? 'selected' : ''); ?>>Ad For Left Sidebar</option>
                <option value="rightSide" <?php echo e(($data->position == 'rightSide') ? 'selected' : ''); ?>>Ad For Right Sidebar</option>
                <option value="mobile-ad" <?php echo e(($data->position == 'mobile-ad') ? 'selected' : ''); ?>>Ad For Mobile</option>
            </select>
        </div>
    </div>



    <div class="col-md-6">
        <div class="form-group"><label for="adsType required">Ad Type</label><select name="adsType" onchange="adsTypes(this.value, 'edit')" required="required" id="adsType" class="form-control custom-select">
            <option value="">Select Type</option>
            <option <?php if($data->adsType == 'adsense'): ?> selected <?php endif; ?> value="adsense" > Google Adsense</option>
            <option <?php if($data->adsType == 'image'): ?> selected <?php endif; ?> value="image" >Banner Ads</option>
            
        </select>
    </div>
    </div>
    <div class="col-md-12" id="editshowAdsType">
        <?php if($data->adsType == 'adsense'): ?>
        <div class="form-group"> <label class="required" for="add_code">Add code</label> <textarea name="add_code" class=" form-control" rows="5" id="add_code" placeholder="Enter ads code ..."><?php echo $data->add_code; ?></textarea> </div> 
        <?php elseif($data->adsType== 'image'): ?>
        <div class="form-group"><label class="dropify_image_area required">Add Images</label> <div class="form-group"> <input type="file" data-default-file="<?php echo e(asset('upload/marketing/'.$data->image)); ?>" name="image" id="input-file-now" class="dropify" /> </div> </div><div class="form-group"> <label for="redirect_url">Redirect URL</label>  <input type="text" value="<?php echo e($data->redirect_url); ?>" name="redirect_url"  id="redirect_url" class="form-control" > </div>
        <?php else: ?>
        <div class="form-group"> <label for="add_link required">Add code or link</label> <textarea name="add_code" class=" form-control" rows="3" id="add_link" placeholder="Enter ads code ..."><?php echo $data->add_code; ?></textarea></div><div class="form-group"> <label for="redirect_url">Redirect URL</label>  <input type="text" value="<?php echo e($data->redirect_url); ?>" name="redirect_url"  id="redirect_url" class="form-control" > </div>
        <?php endif; ?>
    </div>

    <div class="col-md-6">
     <div class="form-group">
    <label>Start date</label>
        <input type="date" value="<?php echo e(Carbon\Carbon::parse($data->start_date)->format('Y-m-d')); ?>" required min="<?php echo e(date('Y-m-d')); ?>" name="start_date" id="start_date" class="form-control">
        </div>
</div>
<div class="col-md-6">
     <div class="form-group">
    <label>End date</label>
    <input type="date" value="<?php echo e(Carbon\Carbon::parse($data->end_date)->format('Y-m-d')); ?>" required min="<?php echo e(Carbon\Carbon::parse(now())->addDay()->format('Y-m-d')); ?>" name="end_date" id="end_date" placeholder="link" class="form-control"></div>

</div>
 


    <div class="col-md-12">

        <div class="form-group">
            <label class="switch-box">Status</label>
            <div  class="status-btn" >
                <div class="custom-control custom-switch">
                    <input name="status" <?php echo e(($data->status == 1) ?  'checked' : ''); ?>   type="checkbox" class="custom-control-input" id="status-edit">
                    <label  class="custom-control-label" for="status-edit">Publish/UnPublish</label>
                </div>
            </div>
        </div>

    </div>
</div><?php /**PATH D:\BonikBazar\bonikbazar\resources\views/admin/addvertisement/addvertisement-edit.blade.php ENDPATH**/ ?>