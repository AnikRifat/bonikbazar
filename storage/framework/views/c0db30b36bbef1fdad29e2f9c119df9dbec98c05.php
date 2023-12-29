<input type="hidden" value="<?php echo e($data->id); ?>" name="id">

<div class="col-md-12">
    <div class="form-group">
        <label for="attribute">Attribute value</label>
        <input name="name" id="attribute" value="<?php echo e($data->name); ?>" required="" type="text" class="form-control">
    </div>
</div>

<div class="col-md-12 mb-12">
    <div class="form-group">
        <label class="switch-box">Status</label>
       
            <div  class="status-btn" >
                <div class="custom-control custom-switch">
                    <input name="status" <?php echo e(($data->status == 1) ?  'checked' : ''); ?>   type="checkbox" class="custom-control-input" id="status-edit">
                    <label class="custom-control-label" for="status-edit">Publish/UnPublish</label>
                </div>
            </div>
      
    </div>
</div>

<?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/admin/category/edit/product-attributevalue.blade.php ENDPATH**/ ?>