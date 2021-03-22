<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function create($id) {
        return view('chat', [
            'user' => Auth::user(),
            'talkUser' => User::find($id),
        ]);
    }
}
