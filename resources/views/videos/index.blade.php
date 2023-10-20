@extends('layouts.app')

@section('content')

<style>
    .icon-spacing {
    margin-right: 15px;
}

.video-description {
    font-size: 14px;
    color: #777;
    max-height: 60px;  // to ensure long descriptions don't take up too much space
    overflow: hidden;
}


</style>
<div class="container-fluid">

    <!-- Top Header -->
    <div class="row align-items-center py-3">
        <div class="col-md-2">
            <!-- Logo -->
            <h2>YouTube</h2>
        </div>
        <div class="col-md-7">
            <!-- Search bar -->
            <form action="#" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="q">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-3 text-right">
            <!-- Icons for notification, upload, and account -->
            <a href="{{ route('videos.create') }}" title="Upload" class="icon-spacing"><i class="fas fa-upload"></i></a>
<a href="#" title="Notifications" class="icon-spacing"><i class="fas fa-bell"></i></a>
<a href="#" title="Account" class="icon-spacing"><i class="fas fa-user-circle"></i></a>

        </div>
    </div>
    
    <div class="row">

        <!-- Left Sidebar -->
        <div class="col-md-3">
            <!-- Navigation links -->
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Shorts</a></li>
                <li><a href="#">Subscriptions</a></li>
                <!-- More links can be added here -->
            </ul>

            <!-- Subscription channels -->
            <h5>Subscriptions</h5>
            <ul>
                <li><a href="#">Channel 1</a></li>
                <li><a href="#">Channel 2</a></li>
                <!-- More channels can be added here -->
            </ul>

            <!-- Explore links -->
            <h5>Explore</h5>
            <ul>
                <li><a href="#">Trending</a></li>
                <li><a href="#">Music</a></li>
                <!-- More explore links can be added here -->
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <!-- Videos -->
            <div class="row">
                @foreach($videos as $video)
                    <div class="col-md-4 mb-4">
                        <a href="{{ route('videos.show', $video->id) }}">
                            <img src="{{ Storage::url($video->thumbnail) }}" alt="{{ $video->title }}" class="img-fluid">
                            <h5 class="mt-2">{{ $video->title }}</h5>

                        </a>
                        <p class="video-description">{{ $video->description }}</p>
                        <div class="video-actions">
            <span class="likes">{{ $video->likes }} <i class="fas fa-thumbs-up"></i></span>
            <span class="dislikes">{{ $video->dislikes }} <i class="fas fa-thumbs-down"></i></span>
            <a href="#" title="Share"><i class="fas fa-share-alt"></i></a>
        </div>
                    </div>
                @endforeach
            </div>
            <!-- Pagination -->
            <div class="row">
                <div class="col-12">
                    {{ $videos->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="row">
        <div class="col-12 py-3">
            <!-- Footer content -->
            <p>&copy; 2023 YouTube, a Google company</p>
        </div>
    </div>

</div>
@endsection
