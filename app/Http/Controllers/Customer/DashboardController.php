<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Video;
use App\Models\VideoAccess;
use App\Models\VideoRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        return view('customer.dashboard', [
            'totalVideos' => Video::count(),
            'newVideosToday' => Video::whereDate('created_at', today())->count(),
            'activeAccess' => VideoAccess::where('user_id', $userId)->where('end_time', '>', now())->count(),
            'accessEndingSoon' => VideoAccess::where('user_id', $userId)
                ->where('end_time', '<=', now()->addDay())
                ->where('end_time', '>', now())
                ->count(),
            'pendingRequests' => VideoRequest::where('user_id', $userId)->where('status', 'pending')->count(),
            'latestVideoTitle' => optional(Video::latest()->first())->title,
            'latestVideoDate' => optional(Video::latest()->first())->created_at?->format('d M Y'),
        ]);
    }
}
