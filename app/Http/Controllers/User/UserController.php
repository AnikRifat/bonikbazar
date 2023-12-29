<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use App\Models\Product;
use App\Models\Category;
use App\Models\FavoriteSeller;
use App\Models\Wishlist;

use App\Models\State;
use App\Traits\CreateSlug;
use App\Traits\Sms;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageEmail;
use Image;
use Session;
class UserController extends Controller
{
    use Sms;
    use CreateSlug;
    public function dashboard()
    {
        $user_id = Auth::id();
        $data['user'] = User::find($user_id);
        $data['follower'] = FavoriteSeller::where('follower_id', $data['user']->id)->count();
  
        $data['following'] = FavoriteSeller::where('user_id', $data['user']->id)->count();
        $data['liked'] = Wishlist::join("products", "products.id", "wishlists.product_id")->where('products.user_id', $data['user']->id)->count();

        $data['posts'] = Product::withCount(["messages", "reports", "reacts"])->where('user_id', $user_id)->where('status', 'active')->orderBy('views', 'desc')->paginate(12);
        return view('users.dashboard')->with($data);
    }


    public function profile()
    {
        $user_id = Auth::id();
        $data['user'] = User::find($user_id);
        $data['follower'] = FavoriteSeller::where('follower_id', $data['user']->id)->count();
  
        $data['following'] = FavoriteSeller::where('user_id', $data['user']->id)->count();
        $data['liked'] = Wishlist::join("products", "products.id", "wishlists.product_id")->where('products.user_id', $data['user']->id)->count();

        $data['posts'] = Product::withCount(["messages", "reports", "reacts"])->where('user_id', $user_id)->where('status', 'active')->orderBy('views', 'desc')->paginate(8);
        return view('users.profile')->with($data);
    }

    //my account form
    public function myAccount()
    {
        $data['user'] = User::find(Auth::id());
        $data['states'] = State::orderBy('position', 'desc')->where('status', 1)->get();
        $data['cities'] = City::where('state_id', $data['user']->region )->where('status', 1)->get();
        $data['areas'] = Area::where('city_id', $data['user']->city )->where('status', 1)->get();
        return view('users.my-account')->with($data);
    }

    //update user profile
    public function profileUpdate(Request $request){
        $request->validate([
            'name' => 'required',
            'mobile' => ['required','unique:users,mobile,'.Auth::id().',id,deleted_at,NULL'],
            'email' => ['required','email','max:255','unique:users,email,'.Auth::id().',id,deleted_at,NULL'],
        ]);
        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->birthday= $request->birthday;
        $user->blood = $request->blood;
        $user->gender = $request->gender;
        $user->user_dsc = $request->user_dsc;
        $update =$user->save();
        if($update){
            Toastr::success('Your profile update successful.');
        }else{
            Toastr::error('Sorry profile can\'t update.');
        }
        return back();
    }
    //change profile image
    public function changeProfileImage(Request $request){
        
        $user = User::find(Auth::id());
        //profile image
        if ($request->hasFile('profileImage')) {
            //delete image from folder
            $getimage_path = public_path('upload/users/'. $user->photo);
            if(file_exists($getimage_path) && $user->photo){
                unlink($getimage_path);
            }
            $image = $request->file('profileImage');
            $new_image_name = $this->uniqueImagePath('users', 'photo', $image->getClientOriginalName());

            //thumb image Resize
            $img = Image::make($image->getRealPath())->resize(150, null, function($constraint){
                $constraint->aspectRatio();
            })->resizeCanvas(150, 150);
            $img->save(public_path('upload/users/' . $new_image_name));

            $user->photo = $new_image_name;
            $user->save();
            Toastr::success('Your profile image update success.');
            return back();
        }

        //cover photo
        if ($request->hasFile('cover_photo')) {
            //delete image from folder
            $getimage_path = public_path('upload/users/'. $user->cover_photo);
            if(file_exists($getimage_path) && $user->cover_photo){
                unlink($getimage_path);
            }
            $image = $request->file('cover_photo');
            $new_image_name = $this->uniqueImagePath('users', 'cover_photo', $image->getClientOriginalName());

            $image->move(public_path('upload/users'), $new_image_name);

            $user->cover_photo = $new_image_name;
            $user->save();
            Toastr::success('Your cover image update success.');
            return back();
        }
        Toastr::error('Please select any image');
        return back();
    }
    //update payment address
    public function addressUpdate(Request $request){
        $request->validate([
            'region' => 'required',
            'city' => ['required'],

            'address' => ['required'],
        ]);
        $user = User::find(Auth::id());
        $user->region = $request->region;
        $user->city = $request->city;

        $user->address= $request->address;
        $update = $user->save();
        if($update){
            Toastr::success('Your address update successful.');
        }else{
            Toastr::error('Sorry address can\'t update.');
        }
        return back();
    }

    //change password form
    public function changePasswordForm(Request $request){
        return view('users.password-change');
    }
    //change password
    public function changePassword(Request $request){
        if(env('MODE') == 'demo'){
            Toastr::error('Demo mode on edit/delete not working');
            return back();
        }
        $check = User::where('id', Auth::id())->first();
        if($check) {
            $this->validate($request, [
                'old_password' => 'required',
                'password' => 'required|confirmed:min:6'
            ]);

            $old_password = $check->password;
            if (Hash::check($request->old_password, $old_password)) {
                if (!Hash::check($request->password, $old_password)) {
                    $user = User::find(Auth::id());
                    $user->password = Hash::make($request->password);
                    $user->save();
                    Toastr::success('Password change successful.', 'Success');
                    return redirect()->back();
                } else {
                    Toastr::error('New password cannot be the same as old password.', 'Error');
                    return redirect()->back();
                }
            } else {
                Toastr::error('Old password not match', 'Error');
                return redirect()->back();
            }
        }else{
            Toastr::error('Sorry your password cann\'t change.', 'Error');
            return redirect()->back();
        }
    }

    public function addNumber(Request $request){
        $otp = rand(0000, 9999);
        Session::put($request->number, $otp);
        $msg = 'Verification(OTP) code: ' . $otp;
        $this->sendSms($request->number, $msg);
        $output = '<div style="display:flex; margin: 0px 0;">
        <div>
        <p>Enter the OTP ('.$otp.') sent to '.$request->number.' <a onclick="moreMobile(\''.$request->number.'\')" href="javascript:void(0)"> Edit</a></p>
        <div style="position: relative;margin-right: 10px;width: 300px;">
        <input type="number" id="otp" minlength="4" maxlength="4" required name="otp" class="form-control" placeholder="Enter OTP Code">
        <p id="optmsg"></p>
        <span class="adjust-field" onclick="verifyNumber(\''.$request->number.'\')" id="verify"> Verify</span>
        </div>
        </div>
        </div>';

        return $output;
    }

    public function verifyNumber(Request $request){
        if($request->otp == Session::get($request->number)){
            $output = [
                'status' => true,
                'number' => '<div id="'.$request->number.'" class="addNumber">
                            <input type="hidden" class="contact_mobile" name="contact_mobile[]" value="'.$request->number.'">
                            <i class="fa fa-check-square"></i> <strong>'.$request->number.'</strong><a class="removeNumber" href="javascript:void(0)" onclick="removeNumber(\''.$request->number.'\')" title="Remove phone number">✕
                            </a>
                            </div>'
            ];
        }else{
            $output = [
                'status' => false
            ];
        }

        return $output;
    }

    public function addEmail(Request $request){
        $code = rand(0000, 9999);
        Session::put($request->email, $code);
        $msg = 'Email verification code is: ' .$code;
        Mail::to($request->email)->send(new MessageEmail('Email verification code', $msg));
        $output = '<div style="display:flex; margin: 10px 0;">
        <div>
        <p>Verification code sent to '.$request->email.' <a onclick="moreEmail(\''.$request->email.'\')" href="javascript:void(0)"> Edit</a></p>
        <div style="position: relative;margin-right: 10px;width: 300px;">
        <input type="number" id="code" minlength="4" maxlength="4" required name="code" class="form-control" placeholder="Enter verify code (4 digits)">
        <p id="codemsg"></p>
        <span class="adjust-field" onclick="verifyEmail(\''.$request->email.'\')" id="verify"> Verify</span>
        </div>
        </div>
        </div>';

        return $output;
    }

    public function verifyEmail(Request $request){
        if($request->code == Session::get($request->email)){
            $output = [
                'status' => true,
                'email' => '<div id="'.$request->code.'" class="addNumber">
                            <input type="hidden" class="contact_email" name="contact_email" value="'.$request->email.'">
                            <i class="fa fa-check-square"></i> <strong>'.$request->email.'</strong><a class="removeNumber" href="javascript:void(0)" onclick="removeEmail(\''.$request->code.'\')" title="Remove email">✕
                            </a>
                            </div>'
            ];
        }else{
            $output = [
                'status' => false
            ];
        }


        return $output;
    }
}
