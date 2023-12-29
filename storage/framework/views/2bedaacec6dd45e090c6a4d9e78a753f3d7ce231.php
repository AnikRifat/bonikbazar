<input type="hidden" name="id" value="<?php echo e($affiliate->id); ?>">
<div class="row justify-content-md-center">
    <div class="col-md-12">
        <div class="form-group">
            <label for="name"> Name</label>
            <input  name="name" id="name" value="<?php echo e($affiliate->name); ?>" required="" type="text" class="form-control">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="name"> Mobile</label>
            <input  name="mobile" id="mobile" value="<?php echo e($affiliate->mobile); ?>" required="" type="text" class="form-control">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="email"> Email</label>
            <input  name="email" id="email" value="<?php echo e($affiliate->email); ?>" type="text" class="form-control">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="code"> Affiliate Code</label>
            <input name="code" id="code" value="<?php echo e($affiliate->code); ?>" type="text" class="form-control">
        </div>
    </div>
</div><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/admin/affiliate/affiliate-edit.blade.php ENDPATH**/ ?>