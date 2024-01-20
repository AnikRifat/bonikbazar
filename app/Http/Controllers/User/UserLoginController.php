<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {

        $user = $request->is('api/*') ? Auth::guard('api')->user() : Auth::user();

        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'emailOrMobile' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return handleValidationResponse($request, $validator);
        }



        $emailOrMobile = trim($input['emailOrMobile']);
        $password = trim($input['password']);
        $fieldType = filter_var($emailOrMobile, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';

        $user = User::where($fieldType, $emailOrMobile)->first();

        $credentials = [$fieldType => $emailOrMobile, 'password' => $password];
        if ($user) {
            if ($user->activation != '1') {
                $url = route('userAccountVerify') . '?' . $fieldType . '=' . $emailOrMobile;
                $message = $user->name . ' your account is not activated. Please verify ' . $fieldType . ', verification code has been sent to your ' . $fieldType . '.';
                return  handleResponse('Error', $request, $message, ['case' => 3, 'url' => $url, 'message' => $$message]);
            }

            if ($user->status != 'active') {
                Auth::logout();

                $message = $user->name . ' your account is ' . $user->status . '. Please contact with administrator.';
                return handleResponse('Error', $request, $message, ['case' => 2, 'message' => $message]);
            }

            if ($token = auth()->attempt($credentials)) {
                if ($request->is('api/*')) {
                    $token = JWTAuth::attempt($credentials);
                    return response()->json($this->respondWithToken($token));
                } elseif (Session::has('redirectLink')) {
                    return redirect(Session::get('redirectLink'));
                } else {
                    Toastr::success('Logged in success.');
                    return redirect()->intended(route('user.dashboard'));
                }
            }
        }

        $message = $fieldType . ' or password is invalid.';
        return handleResponse('Error', $request, $message, ['case' => 2, 'message' => $message]);
    }


    protected function respondWithToken($token)
    {
        // return auth()->user()->load('images');
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 60 * 60,
            'user' => auth()->user()
        ]);
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $url = route('login');
        $message = "Just Logged Out!";
        return  handleResponse('Success', $request, $message, ['case' => 3, 'url' => $url, 'message' => $message]);  
    }
}
