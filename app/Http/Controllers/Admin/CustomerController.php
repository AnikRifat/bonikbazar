<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Transaction;
use App\Models\Notification;
use App\Models\Product;
use App\Models\SellerVerification;
use App\Traits\Sms;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

class CustomerController extends Controller
{
    use Sms;
    public function customerList(Request $request, $status= ''){
        //check role permission
        $permission = $this->checkPermission('manage-users');
        if(!$permission || !$permission['is_view']){ return back(); }

        $customers  = User::withCount('posts')->leftjoin("seller_verifications", "users.id", "seller_verifications.seller_id");
        if($status){
            if($request->status == 'verified'){
                $customers->where('seller_verifications.status', 'active');
            }elseif($request->status == 'unverified'){
                $customers->whereNull('verify');
            }else{
                $customers->where('users.status', $status);
            }
        }
        
        if(!$status && $request->status && $request->status != 'all'){
            if($request->status == 'verified'){
                $customers->where('seller_verifications.status', 'active');
            }elseif($request->status == 'unverified'){
                $customers->whereNull('verify');
            }else{
                $customers->where('status', $request->status);
            }
            
        }if($request->name && $request->name != 'all'){
            $keyword = $request->name;
            $customers->where(function ($query) use ($keyword) {
                $query->orWhere('users.name', 'like', '%' . $keyword . '%');
                $query->orWhere('users.mobile', 'like', '%' . $keyword . '%');
                $query->orWhere('users.email', 'like', '%' . $keyword . '%');
            });
        }if($request->location && $request->location != 'all'){
            $customers->where('city', $request->location);
        }
        $customers  = $customers->orderBy('users.id', 'desc')->selectRaw("users.*")->paginate(15);
        $locations = City::orderBy('name', 'asc')->get();
        return view('admin.customer.customer')->with(compact('customers', 'locations', 'permission'));
    }

    public function customerProfile($username){
        $customer  = User::where('username', $username)->first();
        $posts = Product::where('user_id', $customer->id)->orderBy('id', 'desc')->get();
        return view('admin.customer.profile')->with(compact('customer', 'posts'));
    }

    public function customerSecretLogin($id)
    {
        $user = User::findOrFail(decrypt($id));
        auth()->guard('web')->login($user, true);
        Toastr::success('Customer panel login success.');
        return redirect()->route('user.dashboard');

    }
    public function delete($id){
        $user = User::find($id);
        if($user){
            $user->delete();
            $output = [
                'status' => true,
                'msg' => 'User deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'User cannot deleted.'
            ];
        }
        return response()->json($output);
    }

    //get customer Status popup
    public function customerStatus(Request $request, $product_id){
        $data['customer'] = User::find($product_id);
        $data['verify'] = $request->verify;
        if($data['customer']){
            return view('admin.customer.customerStatus')->with($data);
        }
        return false;
    }

    //customer Status Update
    public function customerStatusUpdate(Request $request){

        $customer = User::find($request->id);

        if($request->status && $customer){
            
            if($request->status == 'verify'){
                $sellerVerification = SellerVerification::where("seller_id", $request->id)->first();
                $sellerVerification->status = "active";
                $sellerVerification->save();

                //if free membership than process
                if($sellerVerification->membershipDuration < 2){
                    $customer->verify = now();
                    $customer->membership = $sellerVerification->membership;
                    $customer->membership_date = Carbon::parse($sellerVerification->end_date)->format("Y-m-d");
                }
                
                $notify = 'Your account has been verified.';
            }elseif($request->status == 'reject'){
                $sellerVerification = SellerVerification::where("seller_id", $request->id)->first();
                $sellerVerification->status = $request->status;
                $sellerVerification->reject_reason = $request->reject_reason;
                $sellerVerification->save();
                $notify = 'Your account verify request cancel.';
            }else{
                $customer->status = $request->status;
           
                $notify = 'Your account has been '.$request->status;
            }
            //insert notification in database
            Notification::create([
                'type' => 'userStatus',
                'fromUser' => null,
                'toUser' => $customer->id,
                'item_id' => $customer->id,
                'notify' => $notify,
            ]);
            $customer->save();
        }
        
       
        Toastr::success('Customer status update success.');
        return back();
    } 


    //user verify request list
    public function verifyRequest(){
        $customers  = SellerVerification::with("user")->where('status', "pending")->withCount('posts')->paginate(25);
        return view('admin.customer.verifyRequest')->with(compact('customers'));
    }


}
