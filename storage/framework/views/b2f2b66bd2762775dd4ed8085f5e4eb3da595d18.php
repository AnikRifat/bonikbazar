<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
        <loc><?php echo e(url('/')); ?></loc>
        <lastmod><?php echo e(now()->tz('UTC')->toAtomString()); ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>
	<?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <url>
            <loc><?php echo e(route('page', $page->slug)); ?></loc>
            <lastmod><?php echo e(($page->updated_at) ? $page->updated_at->tz('UTC')->toAtomString() : Carbon\Carbon::now()->tz('UTC')->toAtomString()); ?></lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.6</priority>
        </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</urlset><?php /**PATH /home/u148401346/domains/bonikbazar.com/public_html/resources/views/sitemap/pages.blade.php ENDPATH**/ ?>