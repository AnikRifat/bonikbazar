<?php

namespace App\Http\Controllers\User;

use App\Mail\EmailVerifyMail;
use App\Models\SiteSetting;
use App\Models\Notification;
use App\Traits\CreateSlug;
use App\Traits\Sms;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserRegController extends Controller
{
    use Sms;
    use CreateSlug;
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function RegisterForm()
    {
        return view('users.register');
    }


    // public function register(Request $request)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required',
    //         'password' => 'required|min:6'
    //     ]);

    //     if ($validator->fails()) {
    //         return handleValidationResponse($request, $validator);
    //     }

    //     $fieldType = filter_var(trim($request->emailOrMobile), FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
    //     $emailOrMobile = $request->emailOrMobile;
    //     //user account verification sms
    //     $account_activation = SiteSetting::where('type', 'customer_account_activation')->first();

    //     $user = User::where($fieldType, $emailOrMobile)->first();
    //     if ($user) {
    //         if ($request->is('api/*')) {
    //             return response()->json(['message' => 'Your ' . $fieldType . ' already used.']);
    //         } else {
    //             return back()->withInput()->with('error', 'Your ' . $fieldType . ' already used.');
    //         }
    //     }

    //     //check customer registration active
    //     $registration = SiteSetting::where('type', 'customer_registration')->first();
    //     if ($registration->status == 0) {
    //         $message = 'Registration is closed by Admin';
    //         return  handleResponse('Error', $request, $message, ['case' => 2, 'message' => $$message]);
    //     }

    //     if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
    //         $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    //         $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    //     }
    //     $client  = @$_SERVER['HTTP_CLIENT_IP'];
    //     $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    //     $remote  = $_SERVER['REMOTE_ADDR'];

    //     if (filter_var($client, FILTER_VALIDATE_IP)) {
    //         $clientIp = $client;
    //     } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
    //         $clientIp = $forward;
    //     } else {
    //         $clientIp = $remote;
    //     }
    //     //check google robot reCaptcha
    //     $reCaptcha = SiteSetting::where('type', 'google_recaptcha')->first();
    //     if ($reCaptcha->status == 1 && isset($_POST['g-recaptcha-response'])) {
    //         $secretKey = $reCaptcha->secret_key;
    //         $captcha = $_POST['g-recaptcha-response'];
    //         if (!$captcha) {
    //             return  handleResponse("Warning", $request, "Please check the robot check.");
    //         }
    //         $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $captcha . "&remoteip=" . $clientIp);
    //         $responseKeys = json_decode($response, true);
    //         if (intval($responseKeys["success"]) !== 1) {
    //             return  handleResponse('Warning', $request, "Please check the robot check.");
    //         }
    //     }


    //     $password = trim($request['password']);

    //     $username = $this->createSlug('users', $request->name, 'username');
    //     $username = trim($username, '-');
    //     $code = rand(1111, 9999);
    //     $user = new User;
    //     $user->name = $request->name;
    //     $user->seller_id = $this->uniqueOrderId('users', "seller_id", 'B');
    //     $user->country = $request->country;
    //     $user->username = $username;
    //     $user->$fieldType = $emailOrMobile;
    //     $user->mobile_verification_token = $code;
    //     $user->email_verification_token = Str::random(32);
    //     $user->password = Hash::make($password);
    //     $user->updated_at = Carbon::now()->addHours(1);
    //     $user->activation = ($account_activation->status == 1) ? 0 : 1;
    //     $user->clientIp = $clientIp;
    //     $user->status = ($account_activation->status == 1) ? 'deactive' : 'active';
    //     $success = $user->save();

    //     if ($success) {

    //         Cookie::queue('emailOrMobile', $request->emailOrMobile, time() + (86400));
    //         Cookie::queue('password', $password, time() + (86400));

    //         return handleResponse('Success',$request,'Registration in success.');

    //         if ($account_activation->status == 1) {
    //             if ($fieldType == 'mobile') {
    //                 $msg = 'Thank you for registering with ' . $_SERVER['SERVER_NAME'] . '. Account verification (OTP): ' . $code;
    //                 $this->sendSms($emailOrMobile, $msg);
    //                 $url = route('userAccountVerify') . '?mobile=' . $emailOrMobile;
    //                 $message = $user->name . ' your account is not active. Please verify your account, verification code has been sent to your ' . $fieldType . '.';
    //                 return  handleResponse('Error', $request, $message, ['case' => 3, 'url' => $url, 'message' => $message]);
    //             }
    //             if ($fieldType == 'email') {
    //                 //send notification in email
    //                 Mail::to($emailOrMobile)->send(new EmailVerifyMail($user));
    //                 if (count(Mail::failures()) > 0) {
    //                     return redirect()->back()->withErrors(['error' => 'A Network Error occurred. Please try again.']);
    //                 } else {
    //                     $url = route('userAccountVerify') . '?email=' . $emailOrMobile;
    //                     $message = $user->name . ' your account is not activated. Please verify your email, verification link has been sent to your email address.';
    //                     return  handleResponse('Error', $request, $message, ['case' => 3, 'url' => $url, 'message' => $message]);
    //                 }
    //             }
    //         }

    //         if (Auth::attempt([$fieldType => $request->emailOrMobile, 'password' => $password])) {
    //             //send registration success mobile notify
    //             if (Auth::user()->mobile) {
    //                 $customer_mobile = Auth::user()->mobile;
    //                 $msg = 'Hello ' . Auth::user()->name . ', Thank you for registering with ' . $_SERVER['SERVER_NAME'] . '.';
    //                 $this->sendSms($customer_mobile, $msg);
    //             }

    //             if ($request->is('api/*')) {
    //                 return (new UserController())->dashboard($request);
    //             }
    //             else{
    //             if (Session::has('redirectLink')) {
    //                 return redirect(Session::get('redirectLink'));
    //             }
    //             return redirect()->intended(route('user.dashboard'));
    //         }


    //         }
    //     } else {
    //         // return handleResponse('Error',$request,'Registration failed try again.');
    //         if ($request->is('api/*')) {
    //             return response()->json(["message" => 'Registration failed try again.']);
    //         } else {
    //             Toastr::error('Registration failed try again.');
    //             return back()->withInput();
    //         }
    //     }
    // }

    // public function register(Request $request) {
    //     $request->validate([
    //         'name' => 'required',
    //         'password' => 'required|min:6'
    //     ]);
    //     $fieldType = filter_var(trim($request->emailOrMobile), FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
    //     $emailOrMobile = $request->emailOrMobile;
    //     //user account verification sms
    //     $account_activation = SiteSetting::where('type', 'customer_account_activation')->first();

    //     $user = User::where($fieldType, $emailOrMobile)->first();
    //     if($user){
    //         return back()->withInput()->with('error', 'Your '.$fieldType.' already used.');
    //     }

    //     //check customer registration active
    //     $registration = SiteSetting::where('type', 'customer_registration')->first();
    //     if ($registration->status == 0) {
    //         return back()->with('error', 'Registration is closed by Admin');
    //     }

    //     if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
    //         $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    //         $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    //     }
    //     $client  = @$_SERVER['HTTP_CLIENT_IP'];
    //     $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    //     $remote  = $_SERVER['REMOTE_ADDR'];

    //     if(filter_var($client, FILTER_VALIDATE_IP)){
    //         $clientIp = $client;
    //     }
    //     elseif(filter_var($forward, FILTER_VALIDATE_IP)){
    //         $clientIp = $forward;
    //     }
    //     else{
    //         $clientIp = $remote;
    //     }
    //     //check google robot reCaptcha
    //     $reCaptcha = SiteSetting::where('type', 'google_recaptcha')->first();
    //     if($reCaptcha->status == 1 && isset($_POST['g-recaptcha-response'])){
    //         $secretKey = $reCaptcha->secret_key;
    //         $captcha = $_POST['g-recaptcha-response'];
    //         if(!$captcha){
    //             Toastr::error('Please check the robot check.');
    //             return back();
    //         }
    //         $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$clientIp);
    //         $responseKeys = json_decode($response,true);
    //         if(intval($responseKeys["success"]) !== 1) {
    //             Toastr::error('Please check the robot check.');
    //             return back();
    //         }
    //     }


    //     $password = trim($request['password']);

    //     $username = $this->createSlug('users', $request->name, 'username');
    //     $username = trim($username, '-');
    //     $code = rand(1111,9999);
    //     $user = new User;
    //     $user->name = $request->name;
    //     $user->seller_id = $this->uniqueOrderId('users', "seller_id", 'B');
    //     $user->country = $request->country;
    //     $user->username = $username;
    //     $user->$fieldType = $emailOrMobile;
    //     $user->mobile_verification_token = $code;
    //     $user->email_verification_token = Str::random(32);
    //     $user->password = Hash::make($password);
    //     $user->updated_at = Carbon::now()->addHours(1);
    //     $user->activation = ($account_activation->status == 1) ? 0 : 1;
    //     $user->clientIp = $clientIp;
    //     $user->status = ($account_activation->status == 1) ? 'deactive' : 'active';
    //     $success = $user->save();

    //     if($success) {

    //         Cookie::queue('emailOrMobile',$request->emailOrMobile, time() + (86400));
    //         Cookie::queue('password', $password, time() + (86400));

    //         Toastr::success('Registration in success.');

    //         if($account_activation->status == 1 ) {
    //             if ($fieldType == 'mobile') {
    //                 $msg = 'Thank you for registering with ' . $_SERVER['SERVER_NAME'] . '. Account verification (OTP): ' . $code;
    //                 $this->sendSms($emailOrMobile, $msg);
    //                 $url = route('userAccountVerify') . '?mobile=' . $emailOrMobile;
    //                 return redirect($url)->with('error', $user->name . ' your account is not active. Please verify your account, verification code has been sent to your ' . $fieldType . '.');
    //             }
    //             if($fieldType == 'email'){
    //                 //send notification in email
    //                 Mail::to($emailOrMobile)->send(new EmailVerifyMail($user));
    //                 if (count(Mail::failures()) > 0) {
    //                     return redirect()->back()->withErrors(['error' => 'A Network Error occurred. Please try again.']);
    //                 } else {
    //                     $url = route('userAccountVerify') . '?email=' . $emailOrMobile;
    //                     return redirect($url)->with('error', $user->name . ' your account is not activated. Please verify your email, verification link has been sent to your email address.');
    //                 }
    //             }
    //         }

    //         if (Auth::attempt([$fieldType => $request->emailOrMobile, 'password' => $password])) {
    //             //send registration success mobile notify
    //             if(Auth::user()->mobile){
    //                 $customer_mobile = Auth::user()->mobile;
    //                 $msg = 'Hello '.Auth::user()->name.', Thank you for registering with '.$_SERVER['SERVER_NAME'].'.';
    //                 $this->sendSms($customer_mobile, $msg);
    //             }

    //             if(Session::has('redirectLink')){
    //                 return redirect(Session::get('redirectLink'));
    //             }
    //             return redirect()->intended(route('user.dashboard'));
    //         }

    //     }else{
    //         Toastr::error('Registration failed try again.');
    //         return back()->withInput();
    //     }
    // }

    public function register(Request $request)
    {
            $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return handleValidationResponse($request, $validator);
        }
        $fieldType = filter_var(trim($request->emailOrMobile), FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        $emailOrMobile = $request->emailOrMobile;
        //user account verification sms
        $account_activation = SiteSetting::where('type', 'customer_account_activation')->first();

        $user = User::where($fieldType, $emailOrMobile)->first();
        if ($user) {
            if ($request->is('api/*')) {
                            return response()->json(['message' => 'Your ' . $fieldType . ' already used.']);
                        } else {
                            return back()->withInput()->with('error', 'Your ' . $fieldType . ' already used.');
                        }
        }

        //check customer registration active
        $registration = SiteSetting::where('type', 'customer_registration')->first();
        if ($registration->status == 0) {
            $message = 'Registration is closed by Admin';
            return  handleResponse('Error', $request, $message, ['case' => 2, 'message' => $$message]);
        }

        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $clientIp = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $clientIp = $forward;
        } else {
            $clientIp = $remote;
        }
        //check google robot reCaptcha
        $reCaptcha = SiteSetting::where('type', 'google_recaptcha')->first();
        if ($reCaptcha->status == 1 && isset($_POST['g-recaptcha-response'])) {
            $secretKey = $reCaptcha->secret_key;
            $captcha = $_POST['g-recaptcha-response'];
            if (!$captcha) {
                return  handleResponse('Warning', $request, "Please check the robot check.");
            }
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $captcha . "&remoteip=" . $clientIp);
            $responseKeys = json_decode($response, true);
            if (intval($responseKeys["success"]) !== 1) {
                return  handleResponse('Warning', $request, "Please check the robot check.");
            }
        }


        $password = trim($request['password']);

        $username = $this->createSlug('users', $request->name, 'username');
        $username = trim($username, '-');
        $code = rand(1111, 9999);
        $user = new User;
        $user->name = $request->name;
        $user->seller_id = $this->uniqueOrderId('users', "seller_id", 'B');
        $user->country = $request->country;
        $user->username = $username;
        $user->$fieldType = $emailOrMobile;
        $user->mobile_verification_token = $code;
        $user->email_verification_token = Str::random(32);
        $user->password = Hash::make($password);
        $user->updated_at = Carbon::now()->addHours(1);
        $user->activation = ($account_activation->status == 1) ? 0 : 1;
        $user->clientIp = $clientIp;
        $user->status = ($account_activation->status == 1) ? 'deactive' : 'active';
        $success = $user->save();

        if ($success) {

            Cookie::queue('emailOrMobile', $request->emailOrMobile, time() + (86400));
            Cookie::queue('password', $password, time() + (86400));

            return handleResponse('Success',$request,'Registration in success.');

            if ($account_activation->status == 1) {
                if ($fieldType == 'mobile') {
                    $msg = 'Thank you for registering with ' . $_SERVER['SERVER_NAME'] . '. Account verification (OTP): ' . $code;
                    $this->sendSms($emailOrMobile, $msg);
                    $url = route('userAccountVerify') . '?mobile=' . $emailOrMobile;
                    $message = $user->name . ' your account is not active. Please verify your account, verification code has been sent to your ' . $fieldType . '.';
                    return  handleResponse('Error', $request, $message, ['case' => 3, 'url' => $url, 'message' => $message]);
                }
                if ($fieldType == 'email') {
                    //send notification in email
                    Mail::to($emailOrMobile)->send(new EmailVerifyMail($user));
                    if (count(Mail::failures()) > 0) {
                        return redirect()->back()->withErrors(['error' => 'A Network Error occurred. Please try again.']);
                    } else {
                        $url = route('userAccountVerify') . '?email=' . $emailOrMobile;
                        return redirect($url)->with('error', $user->name . ' your account is not activated. Please verify your email, verification link has been sent to your email address.');
                    }
                }
            }

            if (Auth::attempt([$fieldType => $request->emailOrMobile, 'password' => $password])) {
                //send registration success mobile notify
                $guard = $request->is('api/*')? "web":"api";
                if (Auth::gurad( $guard)->user()->mobile) {
                    $customer_mobile = Auth::gurad( $guard)->user()->mobile;
                    $msg = 'Hello ' . Auth::gurad( $guard)->user()->name . ', Thank you for registering with ' . $_SERVER['SERVER_NAME'] . '.';
                    $this->sendSms($customer_mobile, $msg);
                }

                if ($request->is('api/*')) {
                    return (new UserController())->dashboard($request);
                }
                else{
                if (Session::has('redirectLink')) {
                    return redirect(Session::get('redirectLink'));
                }
                return redirect()->intended(route('user.dashboard'));
            }
        } else {
            if ($request->is('api/*')) {
                return response()->json(["message" => 'Registration failed try again.']);
            } else {
                Toastr::error('Registration failed try again.');
                return back()->withInput();
            }
        }
    }
}

    public function resendVerifyToken(Request $request)
    {

        $input = $request->all();

        $this->validate($request, [
            'token' => 'required',
        ]);
        $token = trim($input['token']);

        $fieldType = filter_var($request->token, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        $user = User::where($fieldType, $token)->first();
        if ($user) {
            if ($user->activation == 1) {
                return back()->with('error', 'Your account already verified.');
            }
            if ($fieldType == 'email') {
                $user->email_verification_token = Str::random(32);
                $user->mobile_verification_token = null;
                $user->updated_at = Carbon::now()->addHours(1);
                $user->save();
                //send notification in email
                Mail::to($user->email)->send(new EmailVerifyMail($user));
                if (count(Mail::failures()) > 0) {
                    return redirect()->back()->withErrors(['error' => trans('A Network Error occurred. Please try again.')]);
                } else {
                    return redirect()->back()->with('status', trans('Account verification link has been sent to your email address.'));
                }
            } elseif ($fieldType == 'mobile') {
                $this->validate($request, [
                    'token' => 'min:11|numeric|regex:/(01)[0-9]/',
                ]);
                $code = rand(1111, 9999);
                $user->mobile_verification_token = $code;
                $user->email_verification_token = null;
                $user->updated_at = Carbon::now()->addHours(1);
                $user->save();

                if ($user) {
                    $msg = Config::get('siteSetting.site_name') . ' Account verification (OTP): ' . $code;
                    $response = $this->sendSms($user->mobile, $msg);
                    $url = route('userAccountVerify') . '?mobile=' . $user->mobile;
                    return redirect($url)->with('status', trans('Account verification code has been sent to your mobile number.'));
                } else {
                    return redirect()->back()->withErrors(['error' => trans('A Network Error occurred. Please try again.')]);
                }
            } else {
                return redirect()->back()->withErrors(['token' => trans('User does not exist')]);
            }
        }
        return redirect()->back()->withErrors(['token' => trans('User does not exist')]);
    }

    public function userAccountVerify(Request $request)
    {

        $user = null;
        if ($request->mobile && $request->otp_code) {
            $this->validate($request, [
                'mobile' => 'min:11|numeric|regex:/(01)[0-9]/',
            ]);
            $user = User::where('mobile', $request->mobile);
            $user->where('mobile_verification_token', $request->otp_code);
            $user = $user->first();

            if ($user) {
                if ($user->activation == 1) {
                    return back()->with('error', 'Your account already verified.');
                }
                if ($user->updated_at <= Carbon::now()) {
                    return back()->with('error', 'Session token has expired.');
                }
                $user->activation = 1;
                $user->status = 'active';
                $user->mobile_verification_token = null;
                $user->mobile_verified_at = Carbon::now();
                $user->save();
                return redirect()->route('login')->with('status', 'Your account is activated, You can login now.');
            } else {
                return redirect()->back()->withErrors(['otp_code' => trans('Invalid verification code.')]);
            }
        } elseif ($request->email && $request->token) {
            $request->validate([
                'email' => 'required|email',
            ]);
            $user = User::where('email', $request->email);
            $user->where('email_verification_token', $request->token);
            $user = $user->first();

            if ($user) {
                if ($user->updated_at <= Carbon::now()) {
                    return back()->with('error', 'Session token has expired.');
                }
                $user->activation = 1;
                $user->status = 'active';
                $user->email_verification_token = null;
                $user->email_verified_at = Carbon::now();
                $user->save();
                return redirect()->route('login')->with('status', 'Your account is activated, You can login now.');
            } else {
                return redirect()->back()->withErrors(['token' => trans('Invalid email address or token.')]);
            }
        } else {
            if ($request->all()) {
                $fieldType = $request->email ? 'email' : 'mobile';
                $user = User::where($fieldType, $request->$fieldType)->first();
                if ($user && $user->activation == 1) {
                    return back()->with('error', 'Your account already verified.');
                }
                return view('users.verify-account');
            } else {
                return view('404');
            }
        }
    }
}
