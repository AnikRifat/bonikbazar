<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\AffiliateDiscount;
use App\Models\SellerVerification;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Traits\CreateSlug;
use Carbon\Carbon;
class AffiliateController extends Controller
{
    use CreateSlug;

    public function affiliateList()
    {
        $affiliates = Affiliate::withCount("sellers")->orderBy("id", 'desc')->paginate(25);

        return view("admin.affiliate.affiliate-codes")->with(compact('affiliates'));
    }


    public function affiliateCodeGenerate(Request $request)
    {
        $affiliate = new Affiliate();

        $code = ($request->code) ? $request->code : $this->uniqueOrderId("affiliates", "code", "B");

        $affiliate->name = $request->name;
        $affiliate->mobile = $request->mobile;
        $affiliate->email = $request->email;
        $affiliate->code = $code;
        $affiliate->status = 1;
        $affiliate->save();
        Toastr::success("Affiliate code generate success.");
        return back();
    }

    public function affiliateCodeEdit($id)
    {
        $affiliate = Affiliate::find($id);

        return view("admin.affiliate.affiliate-edit")->with(compact("affiliate"));
    }

    public function affiliateCodeUpdate(Request $request)
    {
        $affiliate = Affiliate::find($request->id);
        $affiliate->name = $request->name;
        $affiliate->mobile = $request->mobile;
        $affiliate->code = ($request->code) ? $request->code : $this->uniqueOrderId("affiliates", "code", "B");
        $affiliate->status = 1;
        $affiliate->save();
        Toastr::success("Affiliate user update success.");
        return back();
    }

    public function affiliateCodeDelete($id)
    {
        $affiliate = Affiliate::where("id", $id)->delete();

        return response()->json(["status" => true, "msg" => "Affiliate code delete success."]);
    }
 
    public function affiliateSellers(Request $request, $code){

        $customers = SellerVerification::with(["sellerMembership"])->where("refer_by", $code)->leftJoin('users', 'seller_verifications.seller_id', 'users.id');

        if($request->user){
            $keyword = $request->user;
                $customers->where(function ($query) use ($keyword) {
                $query->orWhere('users.name', 'like', '%' . $keyword . '%');
                $query->orWhere('users.mobile', 'like', '%' . $keyword . '%');
                $query->orWhere('users.email', 'like', '%' . $keyword . '%');
                $query->orWhere('users.seller_id', 'like', '%' . $keyword . '%');
            });
        }

        if($request->from_date){
            $from_date = Carbon::parse($request->from_date)->format('Y-m-d')." 00:00:00";
            $customers->whereDate('seller_verifications.created_at', '>=', $from_date);
        }if($request->end_date){
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d')." 23:59:59";
            $customers->whereDate('seller_verifications.created_at', '<=', $request->end_date);
        }

        $customers = $customers->selectRaw("seller_verifications.*,users.username,users.seller_id as user_id")->paginate(25); 
        return view("admin.affiliate.affiliate-sellers")->with(compact("customers"));
    }


}
