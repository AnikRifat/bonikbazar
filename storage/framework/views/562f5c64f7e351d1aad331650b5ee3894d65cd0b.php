<?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-6 col-lg-6 p-1">
        <input type="hidden" name="attribute[<?php echo e($attribute->id); ?>]" value="<?php echo e($attribute->name); ?>">
    
        <div class="form-group">
            <label class="<?php if($attribute->is_required == 1): ?> required <?php endif; ?>"><?php echo e($attribute->name); ?></label>
            <?php if($attribute->display_type == 1): ?>
                <?php if(count($attribute->get_attrValues)>0): ?>
                <ul class="form-check-list">
                    <?php $__currentLoopData = $attribute->get_attrValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <input name="attributeValue[<?php echo e($attribute->id); ?>][]" <?php if($attribute->is_required == 1): ?> required <?php endif; ?> value="<?php echo e($value->id); ?>" type="checkbox" class="form-check" id="attributeValue<?php echo e($value->id); ?>">
                        <label for="attributeValue<?php echo e($value->id); ?>" class="form-check-text"><?php echo e($value->name); ?></label>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <?php endif; ?>
            <?php elseif($attribute->display_type == 3): ?>
            <?php if(count($attribute->get_attrValues)>0): ?>
                <ul class="form-check-list">
                    <?php $__currentLoopData = $attribute->get_attrValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <input name="attributeValue[<?php echo e($attribute->id); ?>][]" <?php if($attribute->is_required == 1): ?> required <?php endif; ?> value="<?php echo e($value->id); ?>" type="radio" class="form-check" id="attributeValue<?php echo e($value->id); ?>">
                        <label for="attributeValue<?php echo e($value->id); ?>" class="form-check-text"><?php echo e($value->name); ?></label>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <?php endif; ?>

            <?php else: ?>
            <select class="form-control select2" <?php if($attribute->is_required == 1): ?> required <?php endif; ?> name="attributeValue[<?php echo e($attribute->id); ?>][]">
                <?php if($attribute->get_attrValues): ?>
                    <?php if(count($attribute->get_attrValues)>0): ?>
                        <option value="">Select one</option>
                        <?php $__currentLoopData = $attribute->get_attrValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <option value="">Value Not Found</option>
                    <?php endif; ?>
                <?php endif; ?>
            </select>
            <?php endif; ?>

        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH D:\Minhaz\bonikbazar\resources\views/users/post/attribute.blade.php ENDPATH**/ ?>