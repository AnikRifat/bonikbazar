<?php
$type = isset($adType) ? [$adType, "image"] : ["adsense", "image"];

$get_ad = App\Models\Addvertisement::where('status', 1)->whereIn("adsType", $type)->whereNotNull("mobile_image");

if(isset($position)){
	$get_ad->where("position", $position);
}
$get_ad = $get_ad->inRandomOrder()->take(1)->first();

if($get_ad){

	if(isset($adType) && $adType == "linkAd"){
		$showAd = '<a  href="'.$get_ad->redirect_url.'"><img src="'.asset('upload/marketing/'.$get_ad->mobile_image).'" alt=""></a>';
	}else{
		$showAd = ($get_ad->adsType == 'image') ? '<a  href="'.$get_ad->redirect_url.'"><img src="'.asset('upload/marketing/'.$get_ad->image).'" alt=""></a>' : $get_ad->add_code;
	}
}

?>

<?php if($get_ad): ?>
<div class="advertising <?php echo e(isset($class) ? $class : ''); ?>">
<?php echo $showAd; ?>

</div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\bonikbazar\resources\views/frontend/mobile-ads.blade.php ENDPATH**/ ?>