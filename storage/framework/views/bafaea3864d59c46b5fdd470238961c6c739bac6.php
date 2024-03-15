<?php $__env->startSection('title', 'Package History'); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<div class="container bg-white mb-2 px-0">
        <?php echo $__env->make('users.inc.user_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <?php if((new \Jenssegers\Agent\Agent())->isDesktop()): ?>
            <div class="col-12 col-md-3">
                <?php echo $__env->make('users.inc.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div><?php endif; ?>
            <div class="col-12 col-md-9">
				
				<?php if(Session::has('success')): ?>
                <div class="alert alert-success">
                  <strong>Success! </strong> <?php echo e(Session::get('success')); ?>

                </div>
                <?php endif; ?>
                <?php if(Session::has('error')): ?>
                <div class="alert alert-danger">
                  <strong>Error! </strong> <?php echo e(Session::get('error')); ?>

                </div>
                <?php endif; ?>
			
				<form action="<?php echo e(route('user.packageHistory')); ?>" id="orerControll" method="get" class="w-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <input name="package" value="<?php echo e(Request::get('package')); ?>" type="text" placeholder="package name" class="form-control mr-md-2">
                        <select name="status" class="form-control mr-md-2">
                            <option value="">Select Status</option>
                            <option value="pending" <?php echo e((Request::get('status') == 'pending') ? 'selected' : ''); ?> >Pending</option>
                            <option value="received" <?php echo e((Request::get('status') == 'received') ? 'selected' : ''); ?>>Received</option>
                            <option value="paid" <?php echo e((Request::get('status') == 'paid') ? 'selected' : ''); ?>>Paid</option>
                            <option value="all" <?php echo e((Request::get('status') == "all") ? 'selected' : ''); ?>>All</option>
                        </select>
                       <button type="submit" class="form-control btn btn-success">Search </button>
                    </div>
                </form>
		       
				<div class="table-responsive">
                    <table class="table display table-bordered ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="min-width: 100px;">Package</th>
                               
                                <th>Ad & Category</th>
                                <!-- <th>Post</th> -->
                                <th>Duration</th>
                                <th>Price</th>
                               
                                <th>Pay_method</th>
                                <th>Payment</th>
                                <!-- <th>Promote</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($orders)>0): ?>
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $total_price = $order->price ?>
                                <tr id="<?php echo e($order->order_id); ?>" <?php if($order->order_status == 'cancel'): ?> style="background:#ff000026" <?php endif; ?> >
                                    <td><?php echo e((($orders->perPage() * $orders->currentPage() - $orders->perPage()) + ($index+1) )); ?></td>
                                    <td><?php if($order->package_id == 'post_fee'): ?> Ad post fee <?php else: ?> <?php if($order->get_package): ?> <img width="30" src="<?php echo e(asset('upload/images/package/'.$order->get_package->ribbon)); ?>">  <?php echo e($order->get_package->name); ?> <?php endif; ?>
                                       <p style="font-size: 12px;margin: 0;padding: 0"> <?php echo e(\Carbon\Carbon::parse($order->order_date)->format(Config::get('siteSetting.date_format'))); ?><br/>
                                    <?php echo e(\Carbon\Carbon::parse($order->order_date)->format('h:i:s A')); ?></p> <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($order->get_boostAd): ?>
                                        <a target="_blank" href="<?php echo e(route('post_details', $order->get_boostAd->slug)); ?>"> <?php echo e(Str::limit($order->get_boostAd->title, 40)); ?></a> <br/>

                                        <?php else: ?>  Ad Not found  <br/> <?php endif; ?>
                                        <?php echo e(($order->get_category) ? $order->get_category->name : '.'); ?></td>
                                   
                                    <td><?php echo e($order->duration); ?> days</td>
                                    <td>
                                        <?php echo e($order->currency_sign); ?><?php echo e($total_price); ?>

                                        
                                    </td>
                                   
                                    <td><?php echo e(str_replace( '-', ' ', $order->payment_method)); ?></td>
                                    <td> <span class="badge badge-<?php echo e(($order->payment_status=='pending') ? 'danger' : 'success'); ?>"><?php echo e($order->payment_status); ?></span></td>
                                    <!-- <td>
                                    <?php if($order->get_package): ?>
                                    <a href="<?php echo e(route('ads.promoteHistory', $order->get_package->slug)); ?>">History</a> <?php endif; ?></td> -->
                                </tr>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?> <tr><td colspan="8"> <h1>No package found.</h1></td></tr> <?php endif; ?>
                        </tbody>
                    </table>
                </div>

			</div>
			<!--Middle Part End-->
		</div>
	</div>
	
<?php $__env->stopSection(); ?>		
<?php $__env->startSection('js'); ?>
   	<script src="<?php echo e(asset('assets')); ?>/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>

     <script>
    // responsive table
        $('#config-table').DataTable({
            responsive: true,
            ordering: false
        });
    </script>
<?php $__env->stopSection(); ?>		



<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Workspace\LaravelWorkspace\bonikbazar\resources\views/users/package-purchase-history.blade.php ENDPATH**/ ?>