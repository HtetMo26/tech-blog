@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="text-center text-dark">Welcome to my blog web app!</p>
                    <h5 class="text-center"><a class="text-dark card-link" href="create-blog">Create a blog</a></h5>
                    <h5 class="text-center"><a class="text-dark card-link" href="yourblogs">View your blogs</a></h5>
                    <h5 class="text-center"><a class="text-dark card-link" href="{{route('ownprofile.view')}}">View your profile</a></h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <h5 class="mb-4 text-center">All blogs</h5>
            @foreach($allBlogs as $blog)
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <p class="card-title font-weight-bold">
                            @foreach($blogAuthors as $blogAuthor)
                                @if($blog->user_id == $blogAuthor->id)
                                    {{$blogAuthor->name}}
                                    @break
                                @endif
                            @endforeach
                        </p>
                        <p class="card-subtitle text-muted">{{$blog->created_at->format('M d, Y')}}</p>
                        <a class="card-link" href="{{route('blog.view', $blog->id)}}"><h4 class="mt-2">{{$blog->title}}</h4></a>
                        <a class="card-link" href="{{route('blog.view', $blog->id)}}"><img src="{{ asset('storage/'.$blog->image) }}" alt="" width=70" height="90"></a>
                        <p class="mt-3">
                            @foreach($blog->tags as $tag)
                                #{{$tag->tag_name}}
                            @endforeach
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
