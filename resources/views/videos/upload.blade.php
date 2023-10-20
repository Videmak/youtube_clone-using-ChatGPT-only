@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Upload a Video</h2>
    <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control" name="description"></textarea>
        </div>
        <div class="mb-3">
            <label for="video" class="form-label">Select Video:</label>
            <input type="file" class="form-control" name="video" required>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </div>
    </form>
</div>
@endsection
