<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Video;
use App\Models\VideoAccess;


class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'newUsersToday' => User::whereDate('created_at', today())->count(),
            'totalVideos' => Video::count(),
            'newVideosToday' => Video::whereDate('created_at', today())->count(),
            'activeAccess' => VideoAccess::where('end_time', '>', now())->count(),
            'expiredAccess' => VideoAccess::where('end_time', '<=', now())->count(),
            'accessGrantedToday' => VideoAccess::whereDate('created_at', today())->count(),
            'expiredToday' => VideoAccess::whereDate('end_time', today())->count(),
        ]);
    }
}
