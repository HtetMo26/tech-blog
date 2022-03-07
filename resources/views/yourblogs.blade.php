@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h4 class="text-center">Your blogs</h4>
                @foreach($blogs as $blog)
                <div class="card-div">          
                    <div class="card mx-auto shadow">
                        <div class="card-body">
                            <a class="card-link" href="{{route('blog.view', $blog->id)}}"><h4>{{$blog->title}}</h4></a>
                            <img src="{{ asset('storage/'.$blog->image) }}" alt="" width="100" height="120">
                        </div>
                    </div>          
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection