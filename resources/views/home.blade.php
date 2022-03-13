@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h6 class="card-title font-weight-bold"><i class="fa-solid fa-folder-open mr-2"></i>Categories</h6>
                    @foreach($categories as $category)
                        <a href="{{route('category.view', $category->id)}}"><span class="badge badge-secondary">{{ $category->category_name }}</span></a>
                    @endforeach
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h6 class="card-title font-weight-bold"><i class="fa-solid fa-tags mr-2"></i>Tags</h6>
                    @foreach($tags as $tag)
                        <a href="{{route('tag.view', $tag->id)}}"><span class="badge badge-info">#{{ $tag->tag_name }}</span></a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card bg-primary border-primary shadow"> 
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h4 class="text-center text-white font-weight-bold mb-4">Welcome to my blog web app!</h4>
                    <h5 class="text-center"><a class="btn btn-outline-light" href="{{route('blog.create')}}" role="button"><i class="fa-solid fa-feather-pointed mr-2"></i>Post a blog</a></h5>
                </div>
            </div>
            <h5 class="mt-4 mb-4 text-center">Recent blogs</h5>
            @foreach($allBlogs as $blog)
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <p class="card-title font-weight-bold">
                            <a class="card-link text-dark" href="{{route('profile.view', $blog->user->id)}}">{{$blog->user->name}}<a/><span class="card-subtitle font-weight-normal text-muted">&nbsp;&nbsp;&bull;&nbsp;&nbsp;{{$blog->created_at->format('M d, Y')}}</span>
                        </p>
                        <a href="{{route('category.view', $category->id)}}"><h6><span class="badge badge-secondary">{{$blog->category->category_name}}</span></h6></a>
                        <a class="card-link" href="{{route('blog.view', $blog->id)}}"><h4 class="mt-3">{{$blog->title}}</h4></a>
                        <a class="card-link" href="{{route('blog.view', $blog->id)}}"><img src="{{ asset('storage/'.$blog->image) }}" alt="" width=115" height="95"></a>
                        <p class="mt-3 font-weight-bold mb-2">
                            @foreach($blog->tags as $tag)
                                <a href="{{route('tag.view', $tag->id)}}"><span class="badge badge-info mr-2"><span class="text-white">#{{$tag->tag_name}}</span></span></a>
                            @endforeach
                        </p>
                    </div>
                </div>
            @endforeach
            <div class="paginate d-flex justify-content-center">{{$allBlogs->links()}}</div>
        </div>
    </div>
</div>
@endsection
