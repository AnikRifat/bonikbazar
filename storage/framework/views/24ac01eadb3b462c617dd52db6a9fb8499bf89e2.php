 
<?php $__env->startSection('title', 'Blog Post' ); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container bg-white mb-2 py-3 px-0">
        <div class="row">
            <div class="col-12 col-md-3">
                <?php echo $__env->make('users.inc.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="col-12 col-md-9">
                <form action="" method="get">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <input name="title" placeholder="Title" value="<?php echo e(Request::get('title')); ?>" type="text" class="form-control mr-md-2">
                        <select name="status" class="form-control mr-md-2">
                            <option value="all" <?php echo e((Request::get('status') == "all") ? 'selected' : ''); ?>>All Status</option>
                            <option value="pending" <?php echo e((Request::get('status') == 'pending') ? 'selected' : ''); ?> >Pending</option>
                            <option value="active" <?php echo e((Request::get('status') == 'active') ? 'selected' : ''); ?>>Active</option>
                            <option value="deactive" <?php echo e((Request::get('status') == 'deactive') ? 'selected' : ''); ?>>Deactive</option>
                            <option value="reject" <?php echo e((Request::get('status') == 'reject') ? 'selected' : ''); ?>>Reject</option>
                        </select>
                        <button type="submit" class="form-control btn btn-success mr-md-2">Search</button>
                        <a class="btn btn-primary" href="<?php echo e(route('blog.create')); ?>">New</a>
                    </div>
                </form>

                <div class="table-responsive">
                    
                    <table id="config-table" class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Blog Title</th>
                                <th>Category</th>
                                <th>Comments</th>
                                <th>Views</th>
                                <th>Publish</th>
                                <th>Status</th>
                                
                                <th>Action</th>
                            </tr>
                        </thead> 
                        <tbody>
                            <?php if(count($blogs)>0): ?>
                            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="item<?php echo e($blog->id); ?>">
                                <td><?php echo e($index+1); ?></td>
                                <td><a target="_blank" href="<?php echo e(route('blog_details', $blog->slug)); ?>"><img src="<?php echo e(asset('upload/images/blog/thumb/'. $blog->image)); ?>" width="50"> </a></td>
                                <td><a target="_blank" href="<?php echo e(route('blog_details', $blog->slug)); ?>"> <?php echo e($blog->title); ?> </a></td>
                                
                                <td><?php echo e($blog->get_category->name ?? ''); ?></td>
                               
                                <td><?php echo e($blog->comments_count); ?></td>
                                <td><p style="font-size:10px" class="fa fa-eye">  <?php echo e($blog->views); ?> </p></td>
                                <td><?php echo e(Carbon\Carbon::parse($blog->created_at)->format(Config::get('siteSetting.date_format'))); ?></td>
                                <td>
                                    <?php if($blog->status != 'pending'): ?>
                                    <div class="custom-control custom-switch">
                                      <input  name="status" onclick="satusActiveDeactive('blogs', <?php echo e($blog->id); ?>)"  type="checkbox" <?php echo e(($blog->status == 'active') ? 'checked' : ''); ?>  type="checkbox" class="custom-control-input" id="status<?php echo e($blog->id); ?>">
                                      <label style="padding: 5px 12px" class="custom-control-label" for="status<?php echo e($blog->id); ?>"></label>
                                    </div>
                                    <?php else: ?>
                                        <span class="label label-warning"> Pending </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                   
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a target="_blank" class="dropdown-item text-inverse" title="View product" href="<?php echo e(route('blog_details', $blog->slug)); ?>"><i class="ti-eye"></i> View Blog</a>
                                            <a class="dropdown-item" title="Edit product" href="<?php echo e(route('blog.edit', $blog->slug)); ?>"><i class="ti-pencil-alt"></i> Edit Blog</a>
                                            <span title="Delete"><button   data-target="#delete" onclick='deleteConfirmPopup("<?php echo e(route("blog.delete", $blog->id)); ?>")'  data-toggle="modal" class="dropdown-item" ><i class="ti-trash"></i> Delete Product</button></span>
                                        </div>
                                    </div>                                     
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <tr style="text-align: center;"><td colspan="8">Blog not found.!</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('users.modal.delete-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
  <script type="text/javascript">
        //change status by id
        function satusActiveDeactive(table, id, field = null){
            <?php if(env('MODE') == 'demo'): ?>
            toastr.error('Demo mode on edit/update not working');
            return false;
            <?php endif; ?>
            var  url = '<?php echo e(route("statusChange")); ?>';
            $.ajax({
                url:url,
                method:"get",
                data:{table:table,field:field,id:id},
                success:function(data){
                    if(data.status){
                        toastr.success(data.message);
                    }else{
                        toastr.error(data.message);
                    }
                }
            });
        }
    </script>  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Workspace\LaravelWorkspace\bonikbazar\resources\views/users/blog/index.blade.php ENDPATH**/ ?>