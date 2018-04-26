<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //获取登陆用户的所有通知
        $notifications = Auth::user()->notifications()->paginate(20);
        //标记为已度，未读数量清零
        Auth::user()->markAsRead();

        return view('notifications.index',compact('notifications'));
    }
}
