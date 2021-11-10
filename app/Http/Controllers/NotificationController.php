<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notification = Auth::user()->Notifications;
        return view('notification.index',compact('notification'));
    }
}
