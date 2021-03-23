<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function show(Request $request)
    {
        $sender_id = $request->sender_id;
        $receiver_id = $request->receiver_id;
        $users = User::where('id', $sender_id)->orWhere('id', $receiver_id)->get();
        $messages = Message::where(function($query) use ($sender_id, $receiver_id) {
                            $query->where('sender_id', $sender_id)->where('receiver_id', $receiver_id);
                        })->orWhere(function($query) use ($sender_id, $receiver_id) {
                            $query->where('sender_id', $receiver_id)->where('receiver_id', $sender_id);
                        })->orderBy('created_at', 'ASC')->get();
        return [
            'data' => [
                'users' => $users,
                'messages' => $messages,
            ]
        ];
    }

    public function store(Request $request) {
        Message::create([
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);
    }
}
