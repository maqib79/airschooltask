@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">All Videos</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container">
                        <div class="row">
                            @foreach ($videos as $video)
                                <div class="col-4">
                                    <video class="embed-responsive embed-responsive-16by9" controls>
                                        <source src="{{asset('converted_videos/'.$video->video)}}" type="video/m3u8">
                                    </video>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
{{-- <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
<video id="video" controls></video>
<script>
if(Hls.isSupported())
{
    var video = document.getElementById('video');
    var hls = new Hls();
    hls.loadSource('http://task.test/converted_videos/5384263.m3u8');
    hls.attachMedia(video);
    hls.on(Hls.Events.MANIFEST_PARSED,function()
    {
        video.play();
    });
}
else if (video.canPlayType('application/vnd.apple.mpegurl'))
{
    video.src = 'https://test-streams.mux.dev/x36xhzz/x36xhzz.m3u8';
    video.addEventListener('canplay',function()
    {
        video.play();
    });
}
</script> --}}
@endsection
