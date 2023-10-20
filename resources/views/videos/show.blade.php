@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $video->title }}</h2>
    <p>{{ $video->description }}</p>

   

    <!-- Video player -->
    <video width="320" height="240" controls>
        <source src="{{ Storage::url($video->path) }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>
@endsection
