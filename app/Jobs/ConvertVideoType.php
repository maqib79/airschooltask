<?php

namespace App\Jobs;

use App\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class ConvertVideoType implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $video_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($video_id)
    {
        $this->video_id = $video_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $video = Video::find($this->video_id);

        $name = rand(1000, 100000).$video->id.'.m3u8';
        //convert video
        FFMpeg::fromDisk('videos')
        ->open($video->video)
        ->export()
        ->toDisk('converted_videos')
        ->inFormat(new \FFMpeg\Format\Video\X264('libmp3lame', 'libx264'))
        ->save($name);
        $video->video = $name;
        $video->status = 1;

        $video->save();
    }
}
