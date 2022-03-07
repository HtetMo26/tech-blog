@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white text-center">Your profile</div>
                    <div class="card-body">
                        <h2 class="card-title text-center">{{$userDetails->name}}</h1>
                        <p class="card-text text-center">No descriptions here yet.</p>
                        <p class="card-text text-muted text-center"><i class="fa-solid fa-cake-candles"></i>&nbsp;&nbsp;Joined on {{$userDetails->created_at->format('M d, Y')}}<i class="fa-solid fa-envelope ml-4"></i>&nbsp;&nbsp;{{$userDetails->email}}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h5 class="mb-4 text-center">Your blogs</h5>
                @foreach($yourBlogs as $yourBlog)
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <a class="card-link card-title" href="{{route('blog.view', $yourBlog->id)}}"><h5>{{$yourBlog->title}}</h5></a>
                            <img src="{{ asset('storage/'.$yourBlog->image) }}" alt="" width="100" height="120">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection