<?php
$type = isset($adType) ? [$adType, "image"] : ["adsense", "image"];

$get_ad = App\Models\Addvertisement::where('status', 1)->whereIn("adsType", $type);

if(isset($position) && ($position == "leftSide" || $position == "rightSide")){
	$get_ad->where("sideAd_position", $position);
}else{
	$get_ad->where("position", $position);
}

$get_ad = $get_ad->inRandomOrder()->take(1)->first();


if($get_ad){
	$redirect_url = parse_url($get_ad->redirect_url, PHP_URL_SCHEME) || $get_ad->redirect_url == "#" ? $get_ad->redirect_url : 'https://' . $get_ad->redirect_url ;

	if(isset($position) && ($position == "leftSide" || $position == "rightSide")){
		$showAd = '<a target="_blank" data-id="'.$get_ad->id.'" href="'.$redirect_url.'"><img src="'.asset('upload/marketing/'.$get_ad->sideAd_image).'" alt=""></a>';
	}else{
		$showAd = '<a target="_blank" data-id="'.$get_ad->id.'" href="'.$redirect_url.'"><img src="'.asset('upload/marketing/'.$get_ad->image).'" alt=""></a>';
	}
}

?>

<?php if($get_ad): ?>
<div class="advertising sticky-top <?php echo e(isset($class) ? $class : ''); ?>">
<?php echo $showAd; ?>

</div>
<?php endif; ?><?php /**PATH D:\Workspace\LaravelWorkspace\bonikbazar\resources\views/frontend/ads.blade.php ENDPATH**/ ?>