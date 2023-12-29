<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Addvertisement;
use App\Models\Page;
use App\Models\Notification;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddvertisementController extends Controller
{

    public function index(Request $request){
        $advertisements = Addvertisement::with("customer")->orderBy('id', 'DESC');
        if($request->title){
            $advertisements->where('ads_name', 'LIKE', '%'. $request->title .'%');
        }
        if($request->adsType && $request->adsType != 'all'){
            $advertisements->where('adsType', $request->adsType);
        }if($request->page_name && $request->page_name != 'all'){
            $advertisements->where('page', $request->page_name);
        }
        if($request->status && $request->status != 'all'){
            $advertisements->where('status', $request->status);
        }
        $perPage = 15;
        if($request->show){
            $perPage = $request->show;
        }
        $advertisements = $advertisements->paginate($perPage);
        $pages = Page::where('status', 1)->get();
        return view('admin.addvertisement.addvertisement-list')->with(compact('advertisements', 'pages'));
    }
 
    public function store(Request $request)
    {

        $request->validate([
            'position' => 'required',
            'adsType' => 'required'
        ]);

        $image_name = null;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time().$image->getClientOriginalName();
            $image->move(public_path('upload/marketing'), $image_name);
        }

        $mobile_image = null;
        if($request->hasFile('mobile_image')) {
            $image = $request->file('mobile_image');
            $mobile_image = time().$image->getClientOriginalName();
            $image->move(public_path('upload/marketing'), $mobile_image);

        }
        $created_by = Auth::guard("admin")->id();

        $data = [
            'ads_name' => $request->ads_name,
            'adsType' => $request->adsType,
            'page' => $request->page,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'position' => $request->position,
            'image' => $image_name,
            'mobile_image' => $mobile_image,
            'redirect_url' => $request->redirect_url,
            'clickBtn' => $request->clickBtn,
            'add_code' =>  $request->add_code,
            'created_by' => $created_by,
            'status' => ($request->status) ? '1' : '0',
        ];
        $insert = Addvertisement::create($data);
        Toastr::success('Addvertisement Created Successful.');
        return back();
    }

    public function edit($id)
    {  
        $data = Addvertisement::find($id);
        $pages = Page::where('status', 1)->get();

        if($data->adsType == 'linkAd'){
            return view('admin.addvertisement.addvertisement-linkAd')->with(compact('data'));
        }
        return view('admin.addvertisement.addvertisement-edit')->with(compact('data', 'pages'));
    }

    public function update(Request $request)
    {

        $data = Addvertisement::find($request->id);

        if($data->adsType == "linkAd"){

            $data->start_date = $request->start_date;
            $data->end_date = $request->end_date;
            $data->redirect_url = $request->redirect_url;
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
        }else {
            $data->ads_name = $request->ads_name;
            $data->adsType = $request->adsType;
            $data->page = $request->page;
            $data->start_date = $request->start_date;
            $data->end_date = $request->end_date;
            $data->position = $request->position;
            $data->mobile_position = $request->mobile_position;
            $data->redirect_url = $request->redirect_url;
            $data->clickBtn = $request->clickBtn;
            $data->add_code =  $request->add_code;
            $data->updated_by = Auth::guard('admin')->id();
            $data->status = ($request->status) ? '1' : '0';
            
            if($request->hasFile('image')) {
                
                //delete from store folder
                if ($data->image){
                    $image_path = public_path('upload/marketing/' . $data->image);
                    if (file_exists($image_path)) {
                        unlink($image_path);
                    } 
                }
               
                $image = $request->file('image');
                $image_name = time().$image->getClientOriginalName();
                $image->move(public_path('upload/marketing'), $image_name);

                $data->image = $image_name;
            }

            if($request->hasFile('mobile_image')) {
                
                //delete from store folder
                if ($data->mobile_image){
                    $image_path = public_path('upload/marketing/' . $data->mobile_image);
                    if (file_exists($image_path)) {
                        unlink($image_path);
                    } 
                }
               
                $image = $request->file('image');
                $image_name = time().$image->getClientOriginalName();
                $image->move(public_path('upload/marketing'), $image_name);

                $data->mobile_image = $image_name;
            }
        }

        $data->save();

        Toastr::success('Advertisement updated Successful.');
        return back();
    }

    public function delete($id)
    {
        $get_ads = Addvertisement::find($id);
        

        if($get_ads){
            //delete from store folder
            if ($get_ads->image){
                $image_path = public_path('upload/marketing/' . $get_ads->image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                } 
            }
            $get_ads->delete();
            $output = [
                'status' => true,
                'msg' => 'Ads deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Ads cannot deleted.'
            ];
        }
        return response()->json($output);
    }


    public function viewAd($id)
    {  
        $data = Addvertisement::find($id);
        return view('admin.addvertisement.addvertisement-view')->with(compact('data'));
    }

    public function status($status){
        $status = Addvertisement::find($status);
        if($status->status == 1){
            $status->update(['status' => 0]);
            $output = array( 'status' => 'unpublish',  'message'  => 'Advertisement Unpublished');
        }else{
            $status->update(['status' => 1]);
            $output = array( 'status' => 'publish',  'message'  => 'Advertisement Published');
        }

        return response()->json($output);
    }


    public function adPaymentDetails($id){

        $addvertisement = Addvertisement::where('id', $id)->first();
        if($addvertisement){
            return view('admin.addvertisement.paymentCheckModal')->with(compact('addvertisement'));
        }
    }

     // change payment Status function
    public function changePaymentStatus(Request $request){

        $user_id = Auth::guard('admin')->id();
        $addvertisement = Addvertisement::where('id', $request->id)->first();
        if($addvertisement){

            $addvertisement->status = ($request->payment_status == 'paid') ? 1 : 'pending';
            $addvertisement->payment_status = $request->payment_status;
            $addvertisement->save();

            Toastr::success('Payment status ' . str_replace('-', ' ', $request->payment_status) . ' successful.');

            //insert notification in database
            Notification::create([
                'type' => 'adPayment',
                'fromUser' => null,
                'toUser' => $addvertisement->user_id,
                'item_id' => $addvertisement->id,
                'notify' => 'Your ad payment '. $request->payment_status . 'successful.'
            ]);
        }else{
            Toastr::error('Payment status update failed.!');
        }
        return back();
    }
}
