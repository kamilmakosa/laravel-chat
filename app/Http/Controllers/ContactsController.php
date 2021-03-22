<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactsController extends Controller
{
    public function create() {
        return view('contacts', [
            'user' => Auth::user(),
            'users' => User::where('id', '!=', Auth::user()->id)->get(),
        ]);
    }
}
