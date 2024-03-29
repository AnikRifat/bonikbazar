<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Addvertisement;
use App\Models\Page;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Session;
class LinkAdController extends Controller
{

    public function index(Request $request){
        $advertisements = Addvertisement::where("user_id", Auth::id())->orderBy('id', 'DESC')->paginate(15);
        return view('users.linkAds.index')->with(compact('advertisements'));
    }
 

    public function store(Request $request)
    {

        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'redirect_url' => 'required',
        ]);

        $start_date = Carbon::parse($request->start_date);
        $days = $start_date->diffInDays($request->end_date);
        $amount = (100 * $days);

        $data = new Addvertisement();
        $data->user_id = Auth::id();
        $data->amount = $amount;
        $data->ads_name = "link ad";
        $data->adsType = "linkAd";
        $data->page = "all";
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->redirect_url = $request->redirect_url;
        $data->contact_name = ($request->contact_name) ? $request->contact_name : null;
        $data->contact_mobile = ($request->contact_mobile) ? json_encode($request->contact_mobile) : null;
        $data->contact_email = ($request->contact_email) ? $request->contact_email : null;
        $data->created_by = Auth::id();
        $data->status = "pending";

        $data->position = $request->desktopAd_position;
        if($request->hasFile('desktop_image')) {
            $image = $request->file('desktop_image');
            $image_name = time().$image->getClientOriginalName();
            $image->move(public_path('upload/marketing'), $image_name);
            $data->image = $image_name;
        }

        $data->sideAd_position = $request->sideAd_position;
        if($request->hasFile('sideAd_image')) {
            $image = $request->file('sideAd_image');
            $image_name = time().$image->getClientOriginalName();
            $image->move(public_path('upload/marketing'), $image_name);
            $data->sideAd_image = $image_name;
        }

        $data->mobile_position = $request->mobile_position;
        if($request->hasFile('mobile_image')) {
            $image = $request->file('mobile_image');
            $image_name = time().$image->getClientOriginalName();
            $image->move(public_path('upload/marketing'), $image_name);

            $data->mobile_image = $image_name;
        }

        $store = $data->save();
       
        if($store){
            
            $data = [
                'ad_id' => $data->id,
                'total_price' => $amount,
                'currency' => config('siteSetting.currency'),
                'payment_method' => $request->payment_method
            ];
            Session::put('payment_data', $data);
        }else{
            Toastr::error('Payment failed.');
            return redirect()->back();
        }

        if($request->payment_method == 'paypal'){
            //redirect PaypalController for payment process
            $paypal = new PaypalController;
            return $paypal->paypalPayment();
        }
        else{
            Session::put('payment_data.payment_method', $request->payment_method);
            Session::put('payment_data.status', 'success');
            Session::put('payment_data.payment_status', 'pending');
            Session::put('payment_data.trnx_id', $request->trnx_id);
            Session::put('payment_data.payment_info', $request->payment_info);
            //redirect payment success method
            return $this->paymentSuccess();
        }
        return back();
    }

    public function edit($id)
    {  
        $data = Addvertisement::find($id);
        return view('users.linkAds.edit')->with(compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'desktopAd_position' => 'required'
        ]);
        $data = Addvertisement::find($request->id);
        $data->redirect_url = $request->redirect_url;
        $data->position = $request->desktopAd_position;
        if($request->hasFile('desktop_image')) {
            //delete from store folder
            if ($data->image){
                $image_path = public_path('upload/marketing/' . $data->image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                } 
            }
            $image = $request->file('desktop_image');
            $image_name = time().$image->getClientOriginalName();
            $image->move(public_path('upload/marketing'), $image_name);
            $data->image = $image_name;
        }

        $data->sideAd_position = $request->sideAd_position;
        if($request->hasFile('sideAd_image')) {
            //delete from store folder
            if ($data->sideAd_image){
                $image_path = public_path('upload/marketing/' . $data->sideAd_image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                } 
            }
            
            $image = $request->file('sideAd_image');
            $image_name = time().$image->getClientOriginalName();
            $image->move(public_path('upload/marketing'), $image_name);
            $data->sideAd_image = $image_name;
        }

        $data->mobile_position = $request->mobile_position;
        if($request->hasFile('mobile_image')) {

            //delete from store folder
            if ($data->mobile_image){
                $image_path = public_path('upload/marketing/' . $data->mobile_image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                } 
            }

            $image = $request->file('mobile_image');
            $image_name = time().$image->getClientOriginalName();
            $image->move(public_path('upload/marketing'), $image_name);

            $data->mobile_image = $image_name;
        }

        $data->save();

        Toastr::success('Ad Update Successful.');
        return back();
    }

    public function delete($id)
    {
        $get_ads = Addvertisement::where("id",$id)->where("user_id", Auth::id())->first();
        
        if($get_ads){
            //delete from store folder
            if ($get_ads->image){
                $image_path = public_path('upload/marketing/' . $get_ads->image);
                if (file_exists($image_path) && $get_ads->image) {
                    unlink($image_path);
                } 

                $image_path = public_path('upload/marketing/' . $get_ads->mobile_image);
                if (file_exists($image_path) && $get_ads->mobile_image) {
                    unlink($image_path);
                } 
            }
            $get_ads->delete();
            $output = [
                'status' => true,
                'msg' => 'Ad deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Ad cannot deleted.'
            ];
        }
        return response()->json($output);
    }


    //payment status success then update payment status
    public function paymentSuccess(){

        $payment_data = Session::get('payment_data');

        //clear session payment data
        Session::forget('payment_data');
        if($payment_data && $payment_data['status'] == 'success') {
            
            $addvertisement = Addvertisement::where('id', $payment_data['ad_id'])->first();
            if ($addvertisement) {
                $user_id = $addvertisement->user_id;
                $addvertisement->payment_method = $payment_data['payment_method'];
                $addvertisement->tnx_id = (isset($payment_data['trnx_id'])) ? $payment_data['trnx_id'] : null;
                $addvertisement->payment_status = (isset($payment_data['payment_status'])) ? $payment_data['payment_status'] : 'pending';
                $addvertisement->payment_info = (isset($payment_data['payment_info'])) ? $payment_data['payment_info'] : null;
                $addvertisement->save();

                Toastr::success('Your link ad has been successfully completed.');
                return redirect()->route('linkAds');
            }
        }
        Toastr::error('Sorry payment failed.');
        return redirect()->route('post.create')->with('error', 'Sorry payment failed.');
    }
}
