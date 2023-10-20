<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Video::latest()->paginate(9); // Fetch latest 9 videos with pagination
    
        return view('videos.index', compact('videos'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('videos.upload');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'video' => 'required|mimes:mp4,avi,mkv|max:2048000'
        ]);

        // Handle the video upload
        $videoPath = $request->file('video')->store('videos', 'public');

        // Generate thumbnail
        $thumbnailPath = 'thumbnails/' . pathinfo($videoPath, PATHINFO_FILENAME) . '.jpg';
        FFMpeg::fromDisk('public')
            ->open($videoPath)
            ->getFrameFromSeconds(1)
            ->export()
            ->toDisk('public')
            ->save($thumbnailPath);

        // Store video details in the database
        $video = new Video();
        $video->user_id = auth()->id();
        $video->title = $validated['title'];
        $video->description = $validated['description'] ?? null;
        $video->path = $videoPath;
        $video->thumbnail = $thumbnailPath;
        $video->save();

        return redirect()->route('videos.show', $video->id)->with('success', 'Video uploaded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $video = Video::findOrFail($id);
        return view('videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // For now, this remains empty.
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // For now, this remains empty.
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // For now, this remains empty.
    }
    public function upload(Request $request)
    {
        // Handle the uploaded video here
        $video = $request->file('video');
        // ... your logic to save and process the video

        return back()->with('success', 'Video uploaded successfully!');
    }
    
}
