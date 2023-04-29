<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Video::all();
        
        return view('index')->with(['videos' => $videos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('upload-video');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestValidator = $request->validate([
            'name' => 'required | max:150',
            'description' => 'max:300',
            'category' => 'required',
            'file' => 'required | mimes:mp4,mov,avi,mkv',
        ]);

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        
        $uniqueFileName = time() . "-" . Str::uuid()->toString() . "-" . $fileName;

        $file->move('uploaded-videos', $uniqueFileName);

        $video = Video::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category' => $request->input('category'),
            'file_name' => $fileName,
            'file_unique_name' => $uniqueFileName,
            'user_id' => Auth::user()->id,
        ]);

        if($video instanceof Video) {
            return redirect('dashboard')->with(['confirmationMessage' => 'Video has been uploaded successfully!']);
        }
        else {
            return redirect()->back()->withErrors($requestValidator);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        $videos = Video::where('id', '!=', $video->id)->where('category', '=', $video->category)->get();
        $video->views = $video->views + 1;
        $video->save();
        
        return view('video-player')->with(['video' => $video, 'videos' => $videos]);
    }

    public function search(Request $request)
    {
        $key = $request->input('searchField');

        $videos = Video::where('name', 'LIKE', "%{$key}%")->orWhere('category', 'LIKE', "%{$key}%")->get();

        return view('search-result')->with(['videos' => $videos, 'key' => $key]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        return view('upload-video')->with(['video' => $video]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        $requestValidator = $request->validate([
            'name' => 'required | max:150',
            'description' => 'max:300',
            'category' => 'required',
            'file' => 'mimes:mp4,mov,avi,mkv',
        ]);

        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category' => $request->input('category'),
            'user_id' => Auth::user()->id,
            'views' => 0,
        ];

        if($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            
            $uniqueFileName = time() . "-" . Str::uuid()->toString() . "-" . $fileName;

            $file->move('uploaded-videos', $uniqueFileName);

            $data['file_name'] = $fileName;
            $data['file_unique_name'] = $uniqueFileName;
        }

        $affectedVideo = Video::where('id', '=', $video->id)->update($data);

        if($affectedVideo > 0) {
            return redirect('dashboard')->with(['confirmationMessage' => 'Video has been updated successfully!']);
        }
        else {
            return redirect()->back()->withErrors($requestValidator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->back();
    }
}
