<?php

namespace App\Http\Controllers;

use App\Models\AffiliateDiscount;
use App\Models\Membership;
use Illuminate\Http\Request;

class AffiliateDiscountController extends Controller
{
    
    public function index()
    {
          
        $affiliates = AffiliateDiscount::orderBy("month", 'asc')->get();
        $memberships = Membership::where('status', 1)->get();
        return view("admin.affiliate.affiliate-discount")->with(compact('affiliates','memberships'));
    }

    
    public function store(Request $request)
    {
        $affiliate = new AffiliateDiscount();
        $affiliate->membership = $request->membership;
        $affiliate->month = $request->month;
        $affiliate->discount = $request->discount;
        $affiliate->save();

        return back();
    }

 
    public function edit($id)
    {
        $affiliate = AffiliateDiscount::find($id);
        $memberships = Membership::where('status', 1)->get();
        return view("admin.affiliate.affiliate-discount-edit")->with(compact("affiliate", "memberships"));
    }


    public function update(Request $request)
    {
        $affiliate = AffiliateDiscount::find($request->id);
        $affiliate->membership = $request->membership;
        $affiliate->month = $request->month;
        $affiliate->discount = $request->discount;
        $affiliate->save();

        return back();
    }

    public function delete($id)
    {
        $affiliate = AffiliateDiscount::where("id", $id)->delete();

        return response()->json(["status" => true, "msg" => "Affiliate discount delete success."]);
    }
}
