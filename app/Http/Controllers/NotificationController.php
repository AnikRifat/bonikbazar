<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Message;
use App\Models\Conversation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class NotificationController extends Controller
{

    public function allNotifications(Request $request)
    {


        $user_id = Auth::user()->id;
        $notifications = Notification::with('user')->where('toUser', $user_id);
        if ($request->mark && $request->mark != 'all') {
            $mark = ($request->mark == 'read') ? 1 : 0;
            $notifications->where('read', $mark);
        }
        $notifications = $notifications->orderBy('created_at', 'desc')->paginate(20);

        if ($request->is('api/*')) {
            return response()->json($notifications);
        } else {
            return view('users.notifications.notifications')->with(compact('notifications'));
        }
    }

    public function countMessageNotification()
    {
        $user_id = Auth::user()->id;
        $messages = Message::where('receiver_id', $user_id)->where('is_seen', 0)->orderBy('created_at', 'desc')->count();

        $notifications = Notification::where('toUser', $user_id)->where('read', 0)->orderBy('created_at', 'desc')->count();

        return response()->json(["messages" => $messages, "notifications" => $notifications]);
    }

    public function getNotifications(Request $request)
    {
        $user_id = Auth::user()->id;
        if ($request->type == 'message-user-list') {
            $notifications = Conversation::with(['receiver', 'last_message'])->whereIn('sender_id', [$user_id])->orWhereIn('receiver_id', [$user_id])->orderBy('updated_at', 'desc')->take(8)->get();
            //$notifications = Message::whereRaw('id IN (select MAX(id) FROM messages GROUP BY conversion_id)')->where( function($query) use ($user_id){ $query->where('receiver_id', $user_id)->orWhere('sender_id',$user_id);  } )->orderBy('created_at', 'desc')->groupBy('conversion_id')->get();
        }
        if ($request->type == 'notify-item-list') {
            $notifications = Notification::with('user')->where('toUser', $user_id)->orderBy('created_at', 'desc')->take(8)->get();
        }

        $notifications = view('users.notifications.' . $request->type)->with(compact('notifications'))->render();
        return response()->json(["notifications" => $notifications]);
    }

    public function readNotify(int $id = null, Request $request)
    {
        $user_id = Auth::user()->id;
        $notify = Notification::where('toUser', $user_id);
        if ($id) {
            $notify->where('id', $id);
        }

        $notify->update(['read' => 1]);

        if ($request->is('api/*')) {
            return response()->json(["message" => "Success"]);
        } else {
            return back();
        }
    }

    public function markAllread()
    {
        $user_id = Auth::user()->id;
        Notification::where('toUser', $user_id)->update(['read' => 1]);
        return true;
    }

    public function updateDeviceToken(Request $request)
    {

        // Auth::user()->user_device_id =  $request->token;
        // Auth::user()->save();

        // Retrieve the existing JSON string from the user_device_id column
        $existingDeviceIdsJson = Auth::user()->user_device_id;
        $existingDeviceIds = $existingDeviceIdsJson ? json_decode($existingDeviceIdsJson, true) : [];
        if (!in_array($request->token, $existingDeviceIds)) {
            $existingDeviceIds[] = $request->token;
            $newDeviceIdsJson = json_encode($existingDeviceIds);
            
            Auth::user()->user_device_id = $newDeviceIdsJson;
            Auth::user()->save();
            return response()->json(['Token successfully stored.']);
        } else {
            return response()->json(['Token already stored.']);
        }
    }

    public function removeDeviceToken(Request $request){
        // dd($request->token);
        $user = Auth::user();
        $existingDeviceTokens = $user->user_device_id;
        $deviceTokensArray = $existingDeviceTokens ? json_decode($existingDeviceTokens, true) : [];
        if (($key = array_search($request->token, $deviceTokensArray)) !== false) {
            unset($deviceTokensArray[$key]);
        }
        $updatedDeviceTokens = json_encode(array_values($deviceTokensArray));
        $user->user_device_id = $updatedDeviceTokens;
        $user->save();

        Auth::logout();
        return response()->json(['message' => 'Device token removed successfully']);
    }
}