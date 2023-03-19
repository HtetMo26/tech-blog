@extends('layouts.app')

@section('content')
    <div class="container-fluid d-flex justify-content-center mt-3">
        <div class="card shadow" style="width: 50rem;">
        <div class="card-header text-center bg-white">
            <p class="text-primary mb-0 font-weight-bold">Blog Creation</p>
        </div>
            @include('flash-message')
            <div class="card-body">
                <form action="{{route('blog.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="text-primary">Title</label>
                        <input type="text" name="title" id="title" class="form-control border-primary" placeholder="Enter blog title">
                    </div>
                    <div class="form-group">
                        <label for="body" class="text-primary">Body</label>
                        <textarea name="body" id="body" class="form-control border-primary" placeholder="Enter blog body" rows="8"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="category" class="text-primary">Category</label>
                        <select name="category" id="category" class="form-control border-primary">
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image" class="text-primary">Image</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Choose tags</label>
                        @foreach($tags as $tag)
                        <div class="form-check">
                            <input class="button form-check-input" type="checkbox" value="{{$tag->id}}" id="tags" name="tags[]">
                            <label class="form-check-label" for="tags">
                                {{$tag->tag_name}}
                            </label>
                        </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
