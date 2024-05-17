<?php

use App\User;
use Illuminate\Http\JsonResponse;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

function handleValidationResponse($request, $validator)
{
    if ($request->is('api/*')) {
        return response()->json(['errors' => $validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    } else {
        return back()->withErrors($validator)->withInput();
    }
}


// function handleResponse($type, Request $request, $message)
// {
//     if ($request->is('api/*')) {
//         return response()->json(['message' => $message]);
//     } else {
//         Toastr::success($message, $type);
//         return redirect()->back();
//     }
// }



function handleResponse($type, Request $request, $message, $dynamicData = null)
{
    if ($request->is('api/*')) {
        return response()->json(['message' => $message]);
    } else {
        call_user_func(['Toastr', $type], $type, $message);

        // Dynamic handling based on different cases
        if ($dynamicData) {
            switch ($dynamicData['case']) {
                case 2:
                    return back()->with($type, $dynamicData['message']);
                case 3:
                    $url = $dynamicData['url'];
                    return redirect($url)->with($type, $dynamicData['message']);
                    // Add more cases as needed
                default:
                    return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }
}

//Firebase
function sendNotification($message, $user_id, $title)
{
    $url = 'https://fcm.googleapis.com/fcm/send';

    $FcmTokenString = User::where('id', $user_id)->pluck('user_device_id')->first();
    $FcmTokens = json_decode($FcmTokenString, true);
    $data = [
        "registration_ids" => $FcmTokens,
        "notification" => [
            "title" => $title,
            "body" => $message,
        ]
    ];
    // dd($data);
    $encodedData = json_encode($data);

    $serverKey1 = 'AAAAHVpRKbA:APA91bFDiVgRYszKMI5zVDMs3Lket5giFc1h8-B3Bt1tAqhhnrRcmsLZ8mPErrI5X9-AG3ursfaDuk0OAb_op55k3ZjByPEtOMiG1qXAIc5ZloMQ37ijrrgOgs-fM0j5PzllQVDb3VJE'; // ADD SERVER KEY HERE PROVIDED BY FCM
    $serverKey2 = 'AAAA3D2RNKU:APA91bHMjlHsf5FMx35CgnjCbFMqRBsc3QTRkGxjFmx45c7slZ0bPzAuXW5_nj46qkoJFU2rrlU_RfKM5PBQPZQ1zmz1dJye5iT4kZ5bOUjhyVglqsSdHO0bL410bCd1Ue_uDaU8raqK'; // ADD SERVER KEY HERE PROVIDED BY FCM
    send($url, $encodedData, $serverKey1);
    send($url, $encodedData, $serverKey2);
}

function send($url, $encodedData, $key)
{
    $headers = [
        'Authorization:key=' . $key,
        'Content-Type: application/json',
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);

    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
}
