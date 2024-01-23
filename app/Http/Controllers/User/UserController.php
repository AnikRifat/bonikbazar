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
use Illuminate\Support\Facades\Validator;
use Image;
use Session;

class UserController extends Controller
{
    use Sms;
    use CreateSlug;
    public function dashboard(Request $request)
    {

        $user_id = $request->is('api/*') ? Auth::guard('api')->user()->id :  Auth::id();
        $data['user'] = User::find($user_id);
        $data['follower'] = FavoriteSeller::where('follower_id', $data['user']->id)->count();

        $data['following'] = FavoriteSeller::where('user_id', $data['user']->id)->count();
        $data['liked'] = Wishlist::join("products", "products.id", "wishlists.product_id")->where('products.user_id', $data['user']->id)->count();

        $data['posts'] = Product::withCount(["messages", "reports", "reacts"])->where('user_id', $user_id)->where('status', 'active')->orderBy('views', 'desc')->paginate(12);
        

        if($request->is('api/*')){
            return response()->json($data);
        }
        else{
            return view('users.dashboard')->with($data);
        }
        
       
    }


    public function profile(Request $request)
    {
        $user_id = $request->is('api/*') ? Auth::guard('api')->user()->id :  Auth::id();
        $data['user'] = User::find($user_id);
        $data['follower'] = FavoriteSeller::where('follower_id', $data['user']->id)->count();

        $data['following'] = FavoriteSeller::where('user_id', $data['user']->id)->count();
        $data['liked'] = Wishlist::join("products", "products.id", "wishlists.product_id")->where('products.user_id', $data['user']->id)->count();

        $data['posts'] = Product::withCount(["messages", "reports", "reacts"])->where('user_id', $user_id)->where('status', 'active')->orderBy('views', 'desc')->paginate(8);
       

        if($request->is('api/*')){
            return response()->json($data);
        }
        else{
            return view('users.profile')->with($data);
        } 
    }

    //my account form
    public function myAccount(Request $request)
    {
        $data['user'] = $request->is('api/*')? User::find(Auth::guard('api')->id())  : User::find(Auth::id());
        $data['states'] = State::orderBy('position', 'desc')->where('status', 1)->get();
        $data['cities'] = City::where('state_id', $data['user']->region)->where('status', 1)->get();
        $data['areas'] = Area::where('city_id', $data['user']->city)->where('status', 1)->get();

        if($request->is('api/*')){
            return response()->json($data);
        }
        else{
            return view('users.my-account')->with($data);
        }
    }

    //update user profile
    public function profileUpdate(Request $request)
    {

        $user = $request->is('api/*') ? Auth::guard('api')->user() : Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => ['required', 'unique:users,mobile,' . $user->id . ',id,deleted_at,NULL'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id . ',id,deleted_at,NULL'],
        ]);

        if ($validator->fails()) {
            return handleValidationResponse($request, $validator);
        }

        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->birthday = $request->birthday;
        $user->blood = $request->blood;
        $user->gender = $request->gender;
        $user->user_dsc = $request->user_dsc;
        $update = $user->save();

        if ($update) {
            return  handleResponse("Success", $request, "Your profile update successful.");
        } else {
            return handleResponse("Error", $request, "Sorry, profile can't update.");
        }
    }


    //change profile image
    public function changeProfileImage(Request $request)
    {

        $user = $request->is('api/*') ? Auth::guard('api')->user() : Auth::user();

        // Profile image
        if ($request->hasFile('profileImage')) {
            // Delete image from folder
            $getimage_path = public_path('upload/users/' . $user->photo);
            if (file_exists($getimage_path) && $user->photo) {
                unlink($getimage_path);
            }

            $image = $request->file('profileImage');
            $new_image_name = $this->uniqueImagePath('users', 'photo', $image->getClientOriginalName());

            // Thumb image Resize
            $img = Image::make($image->getRealPath())->resize(150, null, function ($constraint) {
                $constraint->aspectRatio();
            })->resizeCanvas(150, 150);
            $img->save(public_path('upload/users/' . $new_image_name));

            $user->photo = $new_image_name;
            $user->save();

            return  handleResponse("Success", $request, "Your profile image update success.");
        }

        // Cover photo
        if ($request->hasFile('cover_photo')) {
            // Delete image from folder
            $getimage_path = public_path('upload/users/' . $user->cover_photo);
            if (file_exists($getimage_path) && $user->cover_photo) {
                unlink($getimage_path);
            }

            $image = $request->file('cover_photo');
            $new_image_name = $this->uniqueImagePath('users', 'cover_photo', $image->getClientOriginalName());

            $image->move(public_path('upload/users'), $new_image_name);

            $user->cover_photo = $new_image_name;
            $user->save();

            return  handleResponse("Success", $request, "Your cover image update success.");
        }

        return  handleResponse("Error", $request, "Please select any image");
    }


    //update payment address
    public function addressUpdate(Request $request)
    {
        $user = $request->is('api/*') ? Auth::guard('api')->user() : Auth::user();

        $validator = Validator::make($request->all(), [
            'region' => 'required',
            'city' => ['required'],
            'address' => ['required'],
        ]);

        if ($validator->fails()) {
            return handleValidationResponse($request, $validator);
        }

        $user->region = $request->region;
        $user->city = $request->city;
        $user->address = $request->address;
        $update = $user->save();

        if ($update) {
            return  handleResponse("Success", $request, "Your address update successful.");
        } else {
            return  handleResponse("Error", $request, "Sorry, address can\'t update.");
        }
    }

    //change password form
    public function changePasswordForm(Request $request)
    {
        return view('users.password-change');
    }


    //change password
    public function changePassword(Request $request)
    {

        if (env('MODE') == 'demo') {
            return  handleResponse("Error", $request, "Demo mode on edit/delete not working");
        }

       $check = $request->is('api/*') ? User::where('id', Auth::guard('api')->user()->id)->first() :  User::where('id', Auth::user()->id)->first();
        
        if ($check) {
            $validator = Validator::make($request->all(), [
                'old_password' => 'required',
                'password' => 'required|confirmed:min:6'
            ]);

            if ($validator->fails()) {
                return handleValidationResponse($request, $validator);
            }

            $old_password = $check->password;
            if (Hash::check($request->old_password, $old_password)) {
                if (!Hash::check($request->password, $old_password)) {
                    $user = User::find(Auth::id());
                    $user->password = Hash::make($request->password);
                    $user->save();

                    return  handleResponse("Success", $request, "Password change successful.");
                } else {
                    return  handleResponse("Error", $request, "New password cannot be the same as old password.");
                }
            } else {
                return  handleResponse("Error", $request, "Old password not match");
            }
        } else {
            return  handleResponse("Error", $request, "Sorry your password cann\'t change.");
        }
    }


    public function addNumber(Request $request)
    {
        $otp = rand(0000, 9999);
        Session::put($request->number, $otp);
        $msg = 'Verification(OTP) code: ' . $otp;
        $this->sendSms($request->number, $msg);
        $output = '<div style="display:flex; margin: 0px 0;">
        <div>
        <p>Enter the OTP (' . $otp . ') sent to ' . $request->number . ' <a onclick="moreMobile(\'' . $request->number . '\')" href="javascript:void(0)"> Edit</a></p>
        <div style="position: relative;margin-right: 10px;width: 300px;">
        <input type="number" id="otp" minlength="4" maxlength="4" required name="otp" class="form-control" placeholder="Enter OTP Code">
        <p id="optmsg"></p>
        <span class="adjust-field" onclick="verifyNumber(\'' . $request->number . '\')" id="verify"> Verify</span>
        </div>
        </div>
        </div>';

        return $output;
    }

    public function verifyNumber(Request $request)
    {
        if ($request->otp == Session::get($request->number)) {
            $output = [
                'status' => true,
                'number' => '<div id="' . $request->number . '" class="addNumber">
                            <input type="hidden" class="contact_mobile" name="contact_mobile[]" value="' . $request->number . '">
                            <i class="fa fa-check-square"></i> <strong>' . $request->number . '</strong><a class="removeNumber" href="javascript:void(0)" onclick="removeNumber(\'' . $request->number . '\')" title="Remove phone number">✕
                            </a>
                            </div>'
            ];
        } else {
            $output = [
                'status' => false
            ];
        }

        return $output;
    }

    public function addEmail(Request $request)
    {
        $code = rand(0000, 9999);
        Session::put($request->email, $code);
        $msg = 'Email verification code is: ' . $code;
        Mail::to($request->email)->send(new MessageEmail('Email verification code', $msg));
        $output = '<div style="display:flex; margin: 10px 0;">
        <div>
        <p>Verification code sent to ' . $request->email . ' <a onclick="moreEmail(\'' . $request->email . '\')" href="javascript:void(0)"> Edit</a></p>
        <div style="position: relative;margin-right: 10px;width: 300px;">
        <input type="number" id="code" minlength="4" maxlength="4" required name="code" class="form-control" placeholder="Enter verify code (4 digits)">
        <p id="codemsg"></p>
        <span class="adjust-field" onclick="verifyEmail(\'' . $request->email . '\')" id="verify"> Verify</span>
        </div>
        </div>
        </div>';

        return $output;
    }

    public function verifyEmail(Request $request)
    {
        if ($request->code == Session::get($request->email)) {
            $output = [
                'status' => true,
                'email' => '<div id="' . $request->code . '" class="addNumber">
                            <input type="hidden" class="contact_email" name="contact_email" value="' . $request->email . '">
                            <i class="fa fa-check-square"></i> <strong>' . $request->email . '</strong><a class="removeNumber" href="javascript:void(0)" onclick="removeEmail(\'' . $request->code . '\')" title="Remove email">✕
                            </a>
                            </div>'
            ];
        } else {
            $output = [
                'status' => false
            ];
        }


        return $output;
    }
}
