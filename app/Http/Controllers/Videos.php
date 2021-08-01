<?php

namespace App\Http\Controllers;

use App\Jobs\ConvertVideoType;
use App\Video;
// use FFMpeg;
// use FFMpeg\Format\Video\M3U;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use ProtoneMedia\LaravelFFMpeg\Support\Format\Video\M3U;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Videos extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function upload_view(){
        return view('videos.upload_video');
    }


    public function index()
    {
        $videos = Video::where('status',1)->get();

        return view('videos.index',compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'video'=> 'required|mimes:mp4,flv,m3u8,ts,3gp,mov,avi,wmv|max:1999',
        ]);

        if($request->hasFile('video')){

            $file = $request->file('video');
            $extension = $file->getClientOriginalExtension();
            $random = rand(1000, 100000);
            $generated_video_name = $random . Auth::id() . '.' . $extension;
            $path = public_path().'/uploads/';
            $file->move($path, $generated_video_name);
            $video = new Video;
            $video->video = $generated_video_name;
            $video->save();
            $this->dispatch(new ConvertVideoType($video->id));
           

            return redirect()->back()->with('status','Video Uploaded');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
    }
}
