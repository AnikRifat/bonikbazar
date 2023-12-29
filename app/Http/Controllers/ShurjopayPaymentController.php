<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PackagePurchaseController;
use App\Models\Order;
use App\Models\PackagePurchase;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use shurjopayv2\ShurjopayLaravelPackage8\Http\Controllers\ShurjopayController;

class ShurjopayPaymentController extends Controller
{
    public function shurjopayPayment(){
        $payment_data = Session::get('payment_data');
       
        $order = PackagePurchase::where('order_id', $payment_data['order_id'])->first();
        if(!Session::has('payment_data') && !$order){
            return redirect()->back();
        }
        $total_price = $order->price;;
        $order_id = $payment_data['order_id'];
     
        $info = array( 
            'currency' => "BDT", 
            'amount' => $total_price, 
            'order_id' => $order_id, 
            'discsount_amount' => 0, 
            'disc_percent' => 0, 
            'client_ip' => $_SERVER['REMOTE_ADDR'], 
            'customer_name' => (Auth::user()->name) ? Auth::user()->name : 'obondhu.com', 
            'customer_phone' => (Auth::user()->mobile) ? Auth::user()->mobile : '01831463463', 
            'email' => (Auth::user()->email) ? Auth::user()->email : 'support@obondhu.com', 
            'customer_address' => "Malotinagar", 
            'customer_city' => "Bogura", 
            'customer_state' => "Rajshahi", 
            'customer_postcode' => "5800", 
            'customer_country' => "Bangladesh", 
        );

        $shurjopay_service = new ShurjopayController(); 
        return $shurjopay_service->checkout($info);
    }

    public function paymentSuccess(Request $request)
    {
        $shurjopay_service = new ShurjopayController(); 
        $order_id = $request->order_id;
        $data =  json_decode($shurjopay_service->verify($order_id) , true)[0];
        try{
       
            if ($data && $data['sp_code'] == 1000 && $data['sp_massage'] =="Success") {
                $orderid = $data['customer_order_id'];
                //after payment success update payment status
                Session::forget('payment_data');
                $data = [
                    'order_id' => $orderid,
                    'trnx_id' => $orderid,
                    'payment_status' => 'paid',
                    'payment_info' => $data['method'] . ' ,txId:' . $data['bank_trx_id'],
                    'payment_method' => 'shurjopay',
                    'status' => 'success'
                ];
                Session::put('payment_data', $data);
               
                $paymentController = new PackagePurchaseController();
                //redirect payment success method
                return $paymentController->paymentSuccess();
            } else {
                Toastr::error('Payment failed');
                $payment_data = Session::get('payment_data');
                if ($payment_data) {
                    
                    return Redirect::route('packagePurchasePaymentGateway', $payment_data['order_id']);
                }
                return redirect('/');
            }
        }catch (\Mockery\Exception $exception) {
            Toastr::error('Payment failed');
            return redirect('/');
        }
    }

}
