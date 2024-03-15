<?php

namespace App\Http\Controllers;

use App\Models\SellerVerification;
use Illuminate\Http\Request;
use App\User;
use App\Models\Membership;
use App\Models\MembershipDuration;
use App\Models\SellerMembership;
use App\Models\City;
use App\Models\State;
use App\Models\PaymentGateway;
use App\Models\Affiliate;
use App\Models\AffiliateDiscount;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageEmail;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\SellerMembershipController;
use Image;
use Session;
use App\Traits\CreateSlug;
use Carbon\Carbon;
class SellerVerificationController extends Controller
{

    use CreateSlug;
    public function verifyAccount(Request $request)
    {
        $data['user'] = User::with("sellerVerify")->find(Auth::id());

        $region = ($data['user']->sellerVerify) ? $data['user']->sellerVerify->region : 0;
        $data['memberships'] = Membership::with('membershipDurations')->where('status', 1)->get();
        $data['affiliate'] = AffiliateDiscount::all();
        $data['states'] = State::orderBy('position', 'desc')->where('status', 1)->get();
        $data['cities'] = City::where('state_id', $region )->where('status', 1)->get();
        $data['paymentgateways'] = PaymentGateway::orderBy('position', 'asc')->where('method_for', '!=', 'payment')->where('status', 1)->get();
        
        if($request->is('api/*')){
            return response()->json($data);
        } else {
            return view('users.seller-verify')->with($data);
        }
    } 

    public function verifyAccountRequest(Request $request){

        $request->validate([
            'shop_name' => 'required',
            'membership' => 'required'
        ]);

        $amount = $referAmount = null;
        $user = SellerVerification::where("seller_id", Auth::id())->first();
        if(!$user){
            $user = new SellerVerification();
        }else{
            $referAmount = $user->referAmount;
            $amount = $user->amount;
            $duration = $user->membershipDuration;
        }

        if($request->membershipDuration){
            $membershipDuration = MembershipDuration::find($request->membershipDuration);

            //free 30 days membership
            $duration = 30;
            if($membershipDuration && $membershipDuration->duration > 0){
                $duration = ($membershipDuration->type == 'month') ? ($membershipDuration->duration * 30) : $membershipDuration->duration;

                $amount = $membershipDuration->price;
            }
            $end_date = Carbon::parse(now())->addDays($duration)->format("Y-m-d");
            $user->membership = $request->membership;
            $user->membershipDuration = $membershipDuration->duration;
            $user->end_date = $end_date;

            if($request->refer_by){
                $affiliate = $this->affiliateDiscount($request->refer_by, $amount, $request->membership, $membershipDuration->duration);

                $data = json_decode(json_encode($affiliate, true), true)["original"];
                if($data["status"]){
                    $referAmount = $data["referAmount"];
                    $amount = $amount - $referAmount;
                    $user->refer_by= $request->refer_by;
                }
            }else{
                $referAmount = null;
            }
        }
        
        $user->seller_id = Auth::id();
        $user->verify_date = now();
        $user->amount = $amount;
        $user->referAmount= $referAmount;
        $user->name = $request->name;
        $user->shop_name = $request->shop_name;
        $user->shop_about = $request->shop_about;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->open_time= $request->open_time;
        $user->close_time= $request->closed_time;
        $user->open_days= ($request->open_days) ? json_encode($request->open_days) : null;
        $user->region = $request->region;
        $user->city = $request->city;
        $user->address= $request->address;
        $user->facebook= $request->facebook;
        $user->website= $request->website;
        $user->youtube= $request->youtube;
        $user->instagram= $request->instagram;
        $user->whatsapp= $request->whatsapp;
        
        $user->status= "pending";
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/users'), $new_image_name);
            $user->owner_photo = $new_image_name;
        }

        if ($request->hasFile('nid_front')) {
            $image = $request->file('nid_front');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/users'), $new_image_name);
            $user->nid_front = $new_image_name;
        }if ($request->hasFile('nid_back')) {
            $image = $request->file('nid_back');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/users'), $new_image_name);
            $user->nid_back = $new_image_name;
        }if ($request->hasFile('trade_license')) {
            $image = $request->file('trade_license');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/users'), $new_image_name);
            $user->trade_license = $new_image_name;
        }if ($request->hasFile('trade_license2')) {
            $image = $request->file('trade_license2');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/users'), $new_image_name);
            $user->trade_license2 = $new_image_name;
        }if ($request->hasFile('trade_license3')) {
            $image = $request->file('trade_license3');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/users'), $new_image_name);
            $user->trade_license3 = $new_image_name;
        }

        $store = $user->save();
        if($store){ 
            //set verify null
            User::where("id", Auth::id())->update(["verify" => null]);
            
            //if membership is not free or resubmit data
            if($request->payment_method){
                $order_id = $this->uniqueOrderId('seller_memberships', 'order_id', 'B');
                $sellerMembership = new SellerMembership();
                $sellerMembership->seller_id = Auth::id();
                $sellerMembership->order_id = $order_id;
                $sellerMembership->membership = $request->membership;
                $sellerMembership->duration = $membershipDuration->duration;
                $sellerMembership->start_date = now();
                $sellerMembership->end_date = $end_date; 
                $sellerMembership->amount = $amount;
                $sellerMembership->payment_method = ($request->payment_method) ? $request->payment_method : "free";
                $sellerMembership->save();

                $data = [
                    'membership_id' => $sellerMembership->id,
                    'total_price' => $amount,
                    'currency' => config('siteSetting.currency'),
                    'payment_method' => ($request->payment_method) ? $request->payment_method : "free"
                ];
                Session::put('payment_data', $data);
            
                if($request->payment_method == 'paypal'){
                    //redirect PaypalController for payment process
                    $paypal = new PaypalController;
                    return $paypal->paypalPayment();
                }
                else{
                    Session::put('payment_data.status', 'success');
                    Session::put('payment_data.payment_status', 'pending');
                    Session::put('payment_data.trnx_id', $request->trnx_id);
                    Session::put('payment_data.payment_info', $request->payment_info);

                    //redirect payment success method
                    $membershipPayment = new SellerMembershipController;
                    return $membershipPayment->paymentSuccess();
                }
            }
            Toastr::success('Account verify request send successful.');
        }else{
            Toastr::error('Sorry account verify request failed.');
        }
        return back()->with("success", "Your account verify request send successful. Your verify request under review.");
    }

    public function affiliateDiscount($refer_by, $amount=null, $membership=null, $month=null){

        //check valid code
        $affiliate = Affiliate::where("code", $refer_by)->first();
        
        if($affiliate){
            //check already used or not
            $affiliateUser = SellerVerification::whereNotNull("refer_by")->where("seller_id", Auth::id())->first();
            if(!$affiliateUser){
                $affiliateDiscount = AffiliateDiscount::whereIn("membership", ["all", $membership])->where("month", $month)->first();
                if($affiliateDiscount){
                    $referAmount = round(($amount * $affiliateDiscount->discount) / 100, 0);
                    $grandTotal = $amount - $referAmount;
                    return response()->json(['status' => true, 'referAmount' => $referAmount, 'referDiscount' => $affiliateDiscount->discount, 'grandTotal' => $grandTotal, 'msg' => 'Refer code successfully applied. You are available discount.']);
                }else{
                    return response()->json(["status" => false, 'msg' => ""]);
                }
            }else{
                return response()->json(["status" => false, 'msg' => "Refer code already used."]);
            }
        }else{
            return response()->json(["status" => false, 'msg' => "Invalid refer code"]);
        }

        return response()->json(["status" => false, 'msg' => '']);
    }
}
