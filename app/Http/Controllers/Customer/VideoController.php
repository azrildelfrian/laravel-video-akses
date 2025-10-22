<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Video;
use App\Models\VideoAccess;
use App\Models\VideoRequest;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->get();
        return view('customer.videos.index', compact('videos'));
    }

    public function show(Video $video)
    {
        $access = VideoAccess::where('user_id', Auth::id())
            ->where('video_id', $video->id)
            ->where('active', true)
            ->orderByDesc('end_time')
            ->first();


        $canWatch = false;
        if ($access && now()->between($access->start_time, $access->end_time)) {
            $canWatch = true;
        }

        return view('customer.videos.show', compact('video', 'access', 'canWatch'));
    }

    public function requestTime(Video $video)
    {
        $existingRequest = VideoRequest::where('user_id', Auth::id())
            ->where('video_id', $video->id)
            ->where('status', 'pending')
            ->first();

        if ($existingRequest) {
            return back()->with('error', 'Permintaan perpanjangan waktu untuk video ini masih diproses.');
        }

        VideoRequest::create([
            'user_id' => Auth::id(),
            'video_id' => $video->id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Permintaan perpanjangan waktu telah dikirim ke admin.');
    }
}
