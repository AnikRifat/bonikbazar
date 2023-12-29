<?php

namespace App\Http\Controllers;

use App\Models\SellerMembership;
use App\Models\Membership;
use App\Models\MembershipDuration;
use App\Models\PaymentGateway;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Session;
use App\Traits\CreateSlug;
class SellerMembershipController extends Controller
{
    use CreateSlug;

    //ayta just kore rakse lagbe use korbo
    public function membershipPlan(){
        $data['user'] = User::with("sellerVerify")->find(Auth::id());

        if(!$data['user']->sellerVerify){
            return redirect()->route("verifyAccount");
        }

        $data['memberships'] = Membership::with('membershipDurations')->where('status', 1)->get();
    
        $data['paymentgateways'] = PaymentGateway::orderBy('position', 'asc')->where('method_for', '!=', 'payment')->where('status', 1)->get();
        return view('users.membership-plan')->with($data);
    }
    
    //insert membership request
	public function membershipRequest(Request $request){
        $request->validate([
            'membership' => 'required',
            'membershipDuration' => 'required',
        ]);
        
        $membershipDuration = MembershipDuration::find($request->membershipDuration);

        if(!$membershipDuration){
            Toastr::error("Membership update failed.");
            return back();
        }
        $duration = ($membershipDuration->type == 'month') ? ($membershipDuration->duration * 30) : $membershipDuration->duration;
        
        $end_date = Carbon::parse(now())->addDays($duration)->format("Y-m-d");
        $total_price = $membershipDuration->price;

        $order_id = $this->uniqueOrderId('seller_memberships', 'order_id', 'B');
        $sellerMembership = new SellerMembership();
        $sellerMembership->seller_id = Auth::id();
        $sellerMembership->order_id = $order_id;
        $sellerMembership->membership = $request->membership;
        $sellerMembership->start_date = now();
        $sellerMembership->end_date = $end_date;
        $sellerMembership->amount = $total_price;
        $sellerMembership->payment_method = "pending";
        $sellerMembership->status = "pending";
        $sellerMembership->tnx_id = $request->trnx_id;
        $sellerMembership->payment_info = $request->payment_info;
        $update = $sellerMembership->save();

        if($update){
            $data = [ 
                'membership_id' => $sellerMembership->id,
                'total_price' => $total_price,
                'currency' => config('siteSetting.currency'),
                'payment_method' => $request->payment_method
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
                return $this->paymentSuccess();
            }

            Toastr::success('Account verify request send successful.');
        }else{
            Toastr::error('Sorry account verify request failed.');
        }
        return back();
    }

    //payment status success then update payment status
    public function paymentSuccess(){

        $payment_data = Session::get('payment_data');
 
        //clear session payment data
        Session::forget('payment_data');
        if($payment_data && $payment_data['status'] == 'success') {
            
            $membership = SellerMembership::where('id', $payment_data['membership_id'])->first();

            if ($membership) {
                $membership->payment_method = $payment_data['payment_method'];
                $membership->tnx_id = (isset($payment_data['trnx_id'])) ? $payment_data['trnx_id'] : null;
                $membership->payment_status = (isset($payment_data['payment_status'])) ? $payment_data['payment_status'] : 'pending';
                $membership->payment_info = (isset($payment_data['payment_info'])) ? $payment_data['payment_info'] : null;
                $membership->save();

                Toastr::success('Membership request send successful');
                return back()->with("success", 'Membership request send successful');
            }
        }
        Toastr::error('Sorry membership payment failed.');
        return redirect()->route('verifyAccount')->with('error', 'Sorry membership payment failed.');
    }



}