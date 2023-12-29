<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PackagePurchase;
use App\Models\Notification;
use App\Models\Product;
use App\Models\PromoteAds;
use App\Traits\Sms;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Toastr;
class PurchasePackageController extends Controller
{
    use Sms;
    //get all package by user id
    public function packageHistory(Request $request, $status='')
    {
        //check role permission
        $data['permission'] = $this->checkPermission('purchase-package');
        if(!$data['permission'] || !$data['permission']['is_view']){ return back(); }
         
        $packages = PackagePurchase::with(['get_package', 'get_category', 'get_boostAd'])
            ->leftJoin('users', 'package_purchases.user_id', 'users.id')
            ->where('package_purchases.payment_method', '!=', 'pending');
        if($request->package_id){
            $packages->where('package_purchases.package_id', $request->package_id);
        }
        if($request->status && $request->status != 'all'){
            $packages->where('payment_status', $request->status);
        }if($request->payment){
            $packages->where('package_purchases.payment_method', $request->payment);
        }
        
        if($request->customer){
            $keyword = $request->customer;
            $packages->where(function ($query) use ($keyword) {
                $query->orWhere('users.name', 'like', '%' . $keyword . '%');
                $query->orWhere('users.mobile', 'like', '%' . $keyword . '%');
                $query->orWhere('users.email', 'like', '%' . $keyword . '%');
            });
        }
       
        if($request->from_date){
            $from_date = Carbon::parse($request->from_date)->format('Y-m-d')." 00:00:00";
            $packages = $packages->whereDate('order_date', '>=', $from_date);
        }if($request->end_date){
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d')." 23:59:59";
            $packages = $packages->whereDate('order_date', '<=', $request->end_date);
        }
       
        $data['packages'] = $packages->orderBy('package_purchases.id', 'desc')->groupBy("order_id")->selectRaw('package_purchases.*, sum(package_purchases.price) as total_price , users.name as customer_name,username,users.mobile')->paginate(15);

        return view('admin.package.purchasePackages')->with($data);
    }

    //show package details by package id
    public function showpackageDetails($packageId){

        $data['package'] = PackagePurchase::where('package_id', $packageId)->first();
        if($data['package']){
            return view('admin.package.package-details')->with($data);
        }
        return false;
    }

    //show package details by package id
    public function packageInvoice($order_id){
        $packages = PackagePurchase::with(['get_package', 'get_category', 'get_boostAd:id,title,slug,feature_image', 'customer'])->where('order_id', $order_id)->get();

        if($packages){
            return view('admin.package.invoice')->with(compact('packages'));
        }
        return view('404');
    }

    // change payment Status function
    public function changePaymentStatus(Request $request){

        $user_id = Auth::guard('admin')->id();
        $purchasePackages = PackagePurchase::where('order_id', $request->id)->get();
        if($purchasePackages){

            foreach ($purchasePackages as $purchasePackage) {
                  
                $purchasePackage->order_status = $request->payment_status;
                $purchasePackage->payment_status = $request->payment_status;
                $purchasePackage->save();

                //check whether post direct promote
                if($purchasePackage->purchase_for && $request->payment_status == 'paid'){
                    //check only post fee payment
                    if($purchasePackage->package_id != 'post_fee'){
                        $start_date = Carbon::now();
                        $end_date = Carbon::now()->addDays($purchasePackage->duration);

                        $promoteAds = new PromoteAds();
                        $promoteAds->category_id = $purchasePackage->category_id;
                        $promoteAds->user_id = $purchasePackage->user_id; 
                        $promoteAds->package_id = $purchasePackage->package_id;
                        $promoteAds->order_id = $purchasePackage->order_id;
                        $promoteAds->ads_id = $purchasePackage->purchase_for;
                        $promoteAds->duration = $purchasePackage->duration;
                        $promoteAds->start_date = $start_date;
                        $promoteAds->end_date = $end_date;
                        $promoteAds->status = 1;
                        $promote = $promoteAds->save();

                        //decrement user purchase remaining ads
                        if($promote){ $purchasePackage->decrement('remaining_ads'); }
                    }
                    //update post status
                    $post = Product::find($purchasePackage->purchase_for);
                    $post->ad_type = $purchasePackage->package_id;
                    $post->approved = now();
                    $post->status = 'active';
                    // $post->status = ($post->status == 'Not posted' || $post->status == 'draft') ? 'pending' : $post->status;
                    $post->save();
                }
            }

            Toastr::success('Payment status ' . str_replace('-', ' ', $request->payment_status) . '  successful.');

            //insert notification in database
            Notification::create([
                'type' => 'package',
                'fromUser' => null,
                'toUser' => $purchasePackage->user_id,
                'item_id' => $request->order_id,
                'notify' => 'Your package purchase payment '. $request->payment_status . ' successful.'
            ]);
        }else{
            Toastr::error('Payment status update failed.!');
        }
        return back();
    }

    public function packagePaymentDetails($id){

        $order = PackagePurchase::where('order_id', $id)->groupBy("order_id")->selectRaw('*, sum(price) as total_price')->first();
        if($order){
            return view('admin.package.paymentCheckModal')->with(compact('order'));
        }
    }
    

}
