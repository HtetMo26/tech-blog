@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white text-center">Profile details</div>
                    <div class="card-body">
                        <h2 class="card-title text-center">{{$userDetails->name}}</h1>
                        <p class="card-text text-center">No descriptions here yet.</p>
                        <p class="card-text text-muted text-center"><i class="fa-solid fa-cake-candles"></i>&nbsp;&nbsp;Joined on {{$userDetails->created_at->format('M d, Y')}}<i class="fa-solid fa-envelope ml-4"></i>&nbsp;&nbsp;{{$userDetails->email}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-9">
                <h5 class="mb-4 text-center">Blogs posted</h5>
                @foreach($userDetails->blogs as $blog)
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <p class="card-title font-weight-bold">
                            <a class="card-link text-dark" href="{{route('profile.view', $blog->user->id)}}">{{$blog->user->name}}</a><span class="card-subtitle font-weight-normal text-muted">&nbsp;&nbsp;&bull;&nbsp;&nbsp;{{$blog->created_at->format('M d, Y')}}</span>
                            </p>
                            <a href="{{route('category.view', $blog->category->id)}}"><h6><span class="badge badge-secondary">{{$blog->category->category_name}}</span></h6></a>
                            <a class="card-link card-title" href="{{route('blog.view', $blog->id)}}"><h4>{{$blog->title}}</h4></a>
                            <a class="card-link card-title" href="{{route('blog.view', $blog->id)}}"><img src="{{ asset('storage/'.$blog->image) }}" alt="" width="115" height="95"></a>
                            <p class="mt-3 font-weight-bold mb-2">
                                @foreach($blog->tags as $tag)
                                    <a href="{{route('tag.view', $tag->id)}}"><span class="badge badge-info mr-2"><span class="text-white">#{{$tag->tag_name}}</span></span></a>
                                @endforeach
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
