<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Events\UserOffline;
use App\User;
use Illuminate\Http\Request;
use Auth;

class UserOfflineController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();
        $user->app_status = 'offline';
        $user->save();

        broadcast(new UserOffline($user));
    }
}