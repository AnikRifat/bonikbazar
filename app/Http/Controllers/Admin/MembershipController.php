<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\MembershipDuration;
use App\Models\SellerMembership;
use App\Models\Notification;
use App\User;
use App\Traits\CreateSlug;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class MembershipController extends Controller
{
    use CreateSlug;

    public function membership_create()
    {
        $data['permission'] = $this->checkPermission('membership');
        if(!$data['permission'] || !$data['permission']['is_view']){ return back(); }
        
        $data['get_data'] = Membership::orderBy('position', 'asc')->get();

        return view('admin.membership.index')->with($data);
    }

    public function membership_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = new Membership();
        $data->name = $request->name;
        $data->slug = $this->createSlug('memberships', $request->name);
        $data->ribbon_position = ($request->ribbon_position ? $request->ribbon_position : 'right');
        $data->details = ($request->details ? $request->details : null);
        $data->status = ($request->status ? 1 : 0);
        if ($request->hasFile('ribbon')) {
            $image = $request->file('ribbon');
            $new_image_name = $this->uniqueImagePath('memberships', 'ribbon', $image->getClientOriginalName());
            $image->move(public_path('upload/images/membership'), $new_image_name);
            $data->ribbon = $new_image_name;
        }
        $store = $data->save();
        if($store){
            Toastr::success('membership Create Successfully.');
        }else{
            Toastr::error('membership Cannot Create.!');
        }
        Session::put('autoSelectId', $request->category_id);
        return back();
    }

    public function membership_edit($id)
    {
        $data['data'] = Membership::find($id);
        echo view('admin.membership.edit.membership')->with($data);
    }

    public function membership_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $data = Membership::find($request->id);
        $data->name = $request->name;
        $data->ribbon_position = ($request->ribbon_position ? $request->ribbon_position : 'right');
        $data->details = ($request->details ? $request->details : null);

        if ($request->hasFile('ribbon')) {
            //delete previous ribbon
            $get_ribbon = public_path('upload/images/membership/'.$data->ribbon);
            if($data->ribbon && file_exists($get_ribbon) ){
                unlink($get_ribbon);
            }
            $image = $request->file('ribbon');
            $new_image_name = $this->uniqueImagePath('memberships', 'ribbon', $image->getClientOriginalName());
            $image->move(public_path('upload/images/membership'), $new_image_name);
            $data->ribbon = $new_image_name;
        }
        $store = $data->save();
        if($store){
            Toastr::success('membership Update Successfully.');
        }else{
            Toastr::error('membership Cannot Update.!');
        }

        return back();
    }

    public function membership_delete($id)
    {
        $delete = Membership::where('id', $id)->delete();

        if($delete){
            //delete previous ribbon
            $get_ribbon = public_path('upload/images/membership/'.$delete->ribbon);
            if($delete->ribbon && file_exists($get_ribbon) ){
                unlink($get_ribbon);
            }
            MembershipDuration::where('membership_id', $id)->delete();
            $output = [
                'status' => true,
                'msg' => 'Membership deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Membership delete failed.'
            ];
        }
        return response()->json($output);
    }

    public function membershipDuration(Request $request, $slug)
    {
        $data['permission'] = $this->checkPermission('membership');
        if(!$data['permission'] || !$data['permission']['is_view']){ return back(); }
        
        $data['membership'] = Membership::where('slug', $slug)->first();
        if( $data['membership']) {
            $get_data = MembershipDuration::where('membership_id', $data['membership']->id);
            $perPage = 15;
            if($request->show){
                $perPage = $request->show;
            }
            $data['get_data'] = $get_data->get();
        }else{
            Toastr::error('membership not found.!');
            return back();
        }
        return view('admin.membership.membershipDuration')->with($data);
    }

    public function membershipDuration_store(Request $request)
    {
        $request->validate([
            'membership_id' => 'required'
        ]);
        $data = new MembershipDuration();
        $data->membership_id = $request->membership_id;
        $data->price = $request->price;
        $data->discount = $request->discount;
        $data->duration = $request->duration;
        $data->type = "month";
        $data->details = $request->details;
        $data->position = 9999;
        $data->status = ($request->status ? 1 : 0);
        $store = $data->save();
        if($store){
            Toastr::success('membership value set successfully.');
        }else{
            Toastr::error('membership value cannot create.!');
        }
        return back();
    }

    public function membershipDuration_edit($id)
    {
        $data['data'] = MembershipDuration::find($id);
        echo view('admin.membership.edit.membershipDuration')->with($data);
    }

    public function membershipDuration_update(Request $request)
    {
        $request->validate([
            'price' => 'required'
        ]);
        $data = MembershipDuration::find($request->id);
        $data->price = $request->price;
        $data->discount = $request->discount;
        $data->duration = $request->duration;
        $data->details = $request->details;
        $data->status = ($request->status ? 1 : 0);
        $store = $data->save();
        if($store){
            Toastr::success('membership value update successfully.');
        }else{
            Toastr::error('membership value cannot update.!');
        }

        return back();
    }

    public function membershipDuration_delete($id)
    {
        $delete = MembershipDuration::where('id', $id)->delete();

        if($delete){
            $output = [
                'status' => true,
                'msg' => 'membership deleted successful.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'membership delete failed.'
            ];
        }
        return response()->json($output);
    }

    //show membership request list
    public function membershipRequests(){
        $sellerMemberships = SellerMembership::with(["user", "sellerVerify"])->where('payment_method', '!=', 'pending')->where("status", "pending")->orderBy("id", "desc")->paginate(25);

        return view("admin.membership.membershipRequest")->with(compact("sellerMemberships"));
    }    


    //show membership request list
    public function allMembership(){
        $allMemberships = SellerMembership::with(["user", "sellerVerify"])->where('payment_method', '!=', 'pending')->orderBy("id", "desc")->paginate(25);

        return view("admin.membership.allMemberships")->with(compact("allMemberships"));
    } 


    //show membership invoice
    public function membershipInvoice($id){
        $membership = SellerMembership::with("user")->where("id", $id)->orderBy("id", "desc")->first();

        return view("admin.membership.invoice")->with(compact("membership"));
    }

    //membership request accept/reject 
    public function membershipRequestUpdate(Request $request){
  
        $sellerMembership = SellerMembership::where('id', $request->id)->first();

        if($sellerMembership){
            $customer = User::find($sellerMembership->seller_id);

            if($customer){
                if($request->status == 'active'){
                    $sellerMembership->status = "active";
                    $sellerMembership->payment_status = "paid";
                    $sellerMembership->reject_reason = null;
                    $sellerMembership->save(); 

                    $customer->verify = now();
                    $customer->membership_date = Carbon::parse($sellerMembership->end_date)->format("Y-m-d");
                    $customer->membership = $sellerMembership->membership;
                    $customer->save(); 
                    $notify = 'Your membership request has been accept.';
                }elseif($request->status == 'reject'){
                    $sellerMembership->status = $request->status;
                    $sellerMembership->reject_reason = $request->reject_reason;
                    $sellerMembership->save();

                    $customer->membership = null;
                     $customer->verify = null;
                    $customer->save();

                    $notify = 'Your membership request cancel.';
                }else{
                    $sellerMembership->status = $request->status;
                    $sellerMembership->save();
                    $notify = 'Your account has been '.$request->status;
                }
                //insert notification in database
                Notification::create([
                    'type' => 'membershipRequest',
                    'fromUser' => null,
                    'toUser' => $customer->id,
                    'item_id' => $sellerMembership->id,
                    'notify' => $notify,
                ]);
            }
        }
        Toastr::success($notify);
        return back();
    }

}
