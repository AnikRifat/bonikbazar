<input type="hidden" value="<?php echo e($data->id); ?>" name="id">
<div style="margin:0 10px;" class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <div class="row">
        <div class="col-12">
            <label class="mb-2" for="">Type your banner link</label>
            <input type="text" required name="redirect_url" value="<?php echo e($data->redirect_url); ?>" placeholder="link" class="mb-2 w-100 borders p-2 gb shadow-b rounded-3">
        </div>
        <div class="col-6">
            <label for="">Start date</label>
            <input type="date" required  value="<?php echo e(Carbon\Carbon::parse($data->start_date)->format('Y-m-d')); ?>" name="start_date" id="start_date" class="mt-2 w-100 borders p-2 gb shadow-b rounded-3">
        </div>
        <div class="col-6">

            <label for="">End date</label>
            <input type="date" required min="<?php echo e(Carbon\Carbon::parse(now())->format('Y-m-d')); ?>" value="<?php echo e(Carbon\Carbon::parse($data->end_date)->format('Y-m-d')); ?>" name="end_date" id="end_date" class="mt-2 w-100 borders p-2 gb shadow-b rounded-3">
        </div>
        </div>
    </div> 
        
    <div class="col-6">
        <div class="form-group">
        <label for="">Select Your Banner For Desktop</label>
        <select name="desktopAd_position"  required="required" id="position" class="form-control borders p-2 gb shadow-b rounded-3">
        <option value="" selected disabled>Select an option</option>
            <option value="top" <?php if($data->position == "top"): ?> selected <?php endif; ?>>Banner for desktop (Top view)</option>
            <option value="bottom" <?php if($data->position == "bottom"): ?> selected <?php endif; ?>>Banner for desktop (Bottom view)</option>
        </select>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
        <input type="file" data-allowed-file-extensions="jpg jpeg png gif" accept="image/*" data-max-file-size="15M" data-default-file="<?php echo e(asset('upload/marketing/'.$data->image)); ?>" class=" dropify shadow-b" name="desktop_image">
        <span>Size: 960 * 250 px</span></div>
    </div>
   
    <div class="col-12 col-md-6">
        <label class="my-2 w-100" for="">Select Your Banner For Desktop (SideView)</label>
        <select name="sideAd_position" class="form-control mb-2 gb shadow-b borders" id="desktop_sideAds">
            <option value="" selected disabled>Select an option</option>
            <option data-width="240" data-height="600" value="leftSide" <?php if($data->sideAd_position == "leftSide"): ?> selected <?php endif; ?>>Left Sidebar</option>
            <option data-width="160" data-height="600" value="rightSide" <?php if($data->sideAd_position == "rightSide"): ?> selected <?php endif; ?>>Right Sidebar</option>
        </select>
        <div class="h-500">
            <input type="file" data-allowed-file-extensions="jpg jpeg png gif" accept="image/*" data-max-file-size="15M" data-default-file="<?php echo e(asset('upload/marketing/'.$data->sideAd_image)); ?>" class=" dropify mt-2 shadow-b" name="sideAd_image">
            <span id="sideAdSize">Size: 240*600 px</span>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <label class="mb-2 w-100" for="">Select Your Banner For Mobile</label>
        <div>
            <input type="file" data-allowed-file-extensions="jpg jpeg png gif" accept="image/*" data-max-file-size="5M" data-default-file="<?php echo e(asset('upload/marketing/'.$data->mobile_image)); ?>" class=" dropify mt-2 shadow-b" name="mobile_image">
            <span>Size: 300*300 px</span>
        </div>

       
    </div>
    
</div><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/admin/addvertisement/addvertisement-linkAd.blade.php ENDPATH**/ ?>