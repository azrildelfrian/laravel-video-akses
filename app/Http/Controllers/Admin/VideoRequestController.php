<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\VideoRequest;
use App\Models\VideoAccess;
use Carbon\Carbon;

class VideoRequestController extends Controller
{
    public function index()
    {
        $requests = VideoRequest::with('user', 'video')->latest()->get();

        foreach ($requests as $req) {
            $req->access = VideoAccess::where('user_id', $req->user_id)
                ->where('video_id', $req->video_id)
                ->where('active', true)
                ->first();
        }

        return view('admin.video_requests.index', compact('requests'));
    }


    public function approve(Request $request, $id)
    {
        $request->validate([
            'hours' => 'nullable|integer|min:0',
            'minutes' => 'nullable|integer|min:0|max:59',
        ]);

        $hours = $request->input('hours', 0);
        $minutes = $request->input('minutes', 0);

        if ($hours == 0 && $minutes == 0) {
            return back()->with('error', 'Durasi tidak boleh kosong.');
        }

        $videoRequest = VideoRequest::findOrFail($id);
        $videoRequest->status = 'approved';
        $videoRequest->save();

        VideoAccess::where('user_id', $videoRequest->user_id)
            ->where('video_id', $videoRequest->video_id)
            ->update(['active' => false]);

        $endTime = Carbon::now()->addHours($hours)->addMinutes($minutes);

        VideoAccess::create([
            'user_id' => $videoRequest->user_id,
            'video_id' => $videoRequest->video_id,
            'start_time' => Carbon::now(),
            'end_time' => $endTime,
            'active' => true,
        ]);

        return redirect()->route('admin.video_requests.index')
            ->with('success', "Permintaan disetujui — akses diberikan selama {$hours} jam {$minutes} menit.");
    }

    public function reject($id)
    {
        $videoRequest = VideoRequest::findOrFail($id);
        $videoRequest->status = 'rejected';
        $videoRequest->save();

        return redirect()->route('admin.video_requests.index')
            ->with('error', 'Permintaan video ditolak.');
    }
}
