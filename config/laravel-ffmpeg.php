<?php

return [
    'ffmpeg' => [
        'binaries' => env('FFMPEG_BINARIES', 'D:\ffmpeg\bin\ffmpeg.exe'),
        'threads'  => 12,
    ],

    'ffprobe' => [
        'binaries' => env('FFPROBE_BINARIES', 'D:\ffmpeg\bin\ffprobe.exe'),
    ],

    'timeout' => 3600,

    'enable_logging' => true,

    'set_command_and_error_output_on_exception' => false,
];
