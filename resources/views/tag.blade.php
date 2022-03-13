@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h4 class="text-center">#{{ $tag->tag_name }}</h4>
                @foreach($tagBlogs as $blog)
                <div class="card-div">          
                    <div class="card mx-auto shadow">
                        <div class="card-body">
                            <p class="card-title font-weight-bold">
                                <a class="card-link text-dark" href="{{route('profile.view', $blog->user->id)}}">{{$blog->user->name}}<a/><span class="card-subtitle font-weight-normal text-muted">&nbsp;&nbsp;&bull;&nbsp;&nbsp;{{$blog->created_at->format('M d, Y')}}</span>
                            </p>
                            <a href="{{route('category.view', $blog->category->id)}}"><h6><span class="badge badge-secondary">{{$blog->category->category_name}}</span></h6></a>
                            <a class="card-link" href="{{route('blog.view', $blog->id)}}"><h4 class="mt-3">{{$blog->title}}</h4></a>
                            <a class="card-link" href="{{route('blog.view', $blog->id)}}"><img src="{{ asset('storage/'.$blog->image) }}" alt="" width=115" height="95"></a>
                            <p class="mt-3 font-weight-bold mb-2">
                                @foreach($blog->tags as $tag)
                                    <a href="{{route('tag.view', $tag->id)}}"><span class="badge badge-info mr-2"><span class="text-white">#{{$tag->tag_name}}</span></span></a>
                                @endforeach
                            </p>
                        </div>
                    </div>          
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection