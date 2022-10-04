<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use App\Events\UserOnline;
use Illuminate\Http\Request;
use Auth;

class UserOnlineController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();
        $user->app_status = 'online';
        $user->save();

        broadcast(new UserOnline($user));
    }
}