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
use createch\PaycorpSampathVault\PaycorpSampathVault;

class PaycorpController extends Controller
{
    public function paycorpPayment(){
        $payment_data = Session::get('payment_data');
        
        $order = PackagePurchase::where('order_id', $payment_data['order_id'])->selectRaw('sum(price) as price, post_fee')->first();
        if(!Session::has('payment_data') && !$order){
            return redirect()->back();
        }

        $total_price = ($order->price + $order->post_fee) * 100;
        
        $order_id = $payment_data['order_id'];
    
        $paymentInit = new PaycorpSampathVault();
        $data['clientRef'] = $order_id;
        $data['comment'] = "Your comment";
        $total_amount = $total_price;
        // $data['total_amount'] = (int) number_format($total_price . 00);
        
        $data['total_amount'] = (int) $total_amount;
        $data['total_amount'] = 2000;
        $data['service_fee_amount'] = 0;
        $data['payment_amount'] = (int) $total_amount;
        $res = $paymentInit->initRequest($data);
        
        return redirect($res['payment_page_url']);
    }

    public function paymentSuccess(Request $request)
    {

        $data['reqid'] = $request->reqid;
        $data['clientRef'] = $request->clientRef;
        $paymentComplete = new PaycorpSampathVault();
        $response = $paymentComplete->completeRequest($data);
        
        try{
       
            if ($response && $request->responseCode == 00) {
                $orderid = $data['clientRef'];
                //after payment success update payment status
                Session::forget('payment_data');
                $data = [
                    'order_id' => $orderid,
                    'trnx_id' => $orderid,
                    'payment_status' => 'paid',
                    'payment_info' => $request->cardType . ' ,txId:' . $request->cardNumber,
                    'payment_method' => 'paycorp',
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
