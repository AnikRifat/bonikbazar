<?php

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
