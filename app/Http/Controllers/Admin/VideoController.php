<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        return view('admin.videos.index', compact('videos'));
    }

    public function show(Video $video)
    {
        return view('admin.videos.show', compact('video'));
    }


    public function create()
    {
        return view('admin.videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_path' => 'nullable|string',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi,mkv|max:204800',
        ]);

        $path = $request->video_path;

        if ($request->hasFile('video_file')) {
            $file = $request->file('video_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destination = public_path('videos');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);

            $path = 'videos/' . $filename;
        }

        Video::create([
            'title' => $request->title,
            'description' => $request->description,
            'video_path' => $path,
        ]);

        return redirect()->route('videos.index')->with('success', 'Video berhasil ditambahkan.');
    }

    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_path' => 'nullable|string',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi,mkv|max:204800',
        ]);

        $path = $request->video_path ?? $video->video_path;

        if ($request->hasFile('video_file')) {
            $file = $request->file('video_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destination = public_path('videos');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $path = 'videos/' . $filename;
        }

        $video->update([
            'title' => $request->title,
            'description' => $request->description,
            'video_path' => $path,
        ]);

        return redirect()->route('videos.index')->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(Video $video)
    {
        if ($video->video_path && file_exists(public_path($video->video_path))) {
            unlink(public_path($video->video_path));
        }

        $video->delete();
        return redirect()->route('videos.index')->with('success', 'Video berhasil dihapus.');
    }
}
