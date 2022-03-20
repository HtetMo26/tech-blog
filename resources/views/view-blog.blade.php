@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-9 mb-3">
                <div class="card shadow">
                    <div class="card-body">
                        <a href="{{route('category.view', $category->id)}}"><h5><span class="badge badge-secondary mb-3">{{$category->category_name}}</span></h5></a>
                        <h2 class="text-center font-weight-bold mb-4">{{$blogDetails->title}}</h2>
                        <h4 class="like-status float-right" data-at="{{$blogDetails->id}}"><i class="like fa-solid fa-heart {{ $userLiked == true ? 'text-danger' : 'text-secondary' }} mr-2" data-at="{{ $userLiked }}" ></i><span id="count">{{$blogLikes->count()}}</span></h4>
                        <h5>
                        @foreach($newTags as $tag)
                            <a href="{{route('tag.view', $tag->id)}}"><span class="badge badge-info mr-2"><span class="text-white">#{{$tag->tag_name}}</span></span></a>
                        @endforeach
                        </h5>
                        <img class="blog-detail-img mt-3" src="{{ asset('storage/'.$blogDetails->image) }}" alt="">
                        <p class="card-text mt-4">{{$blogDetails->body}}</p>
                        <hr class="mt-4">
                        @include('flash-message')
                        <h4>Comments</h4>
                        <form action="{{route('comment.store', $blogDetails->id)}}" class="mt-4 mb-4" method="POST">
                            @csrf
                            <div class="form-group">
                                <textarea name="comment" id="comment" class="form-control" placeholder="Type some thoughts..." rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Post</button>
                        </form>
                        <div class="comment-div mt-4 " id="comment">
                            @foreach($blogComments as $blogComment)
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <p class="card-title font-weight-bold">
                                            @foreach($commentUsers as $commentUser)
                                                @if($blogComment->user_id == $commentUser->id)
                                                    <a class="card-link text-dark" href="{{route('profile.view', $commentUser->id)}}">{{ $commentUser->name}}</a> @if($commentUser->id == $blogDetails->user_id)<span class="badge badge-info"> Author </span> @endif&nbsp;<span class="text-muted small">&bull;&nbsp;&nbsp;{{ $blogComment->created_at->diffForHumans() }}</span>
                                                    @break                                                 
                                                @endif
                                            @endforeach
                                        </p>
                                        <p class="card-text">{{$blogComment->comment}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-header bg-white text-center">
                        <h5 class="mb-0 font-weight-bold"><i class="fa-solid fa-feather-pointed mr-2"></i>Author</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="text-muted mb-0">NAME</h6>
                        <h6 class="mb-3">{{$blogAuthor->name}}</h6>
                        <h6 class="text-muted mb-0">EMAIL</h6>
                        <h6 class="mb-0">{{$blogAuthor->email}}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.like-status').click(function () {
                let like = parseInt($('#count').text());
                if ($('.like').hasClass('text-secondary')) {
                    $('.like').removeClass('text-secondary');
                    $('.like').addClass('text-danger');
                    $('#count').text(like+1);
                }
                else {
                    $('.like').removeClass('text-danger');
                    $('.like').addClass('text-secondary');
                    $('#count').text(like-1);
                };
                postToServer($('.like').attr('data-at'), $(this).attr('data-at'))
            });
        });

        function postToServer(value, id) {
            $.ajax({
                type: "POST",
                url: "{{route('blog.like')}}",
                data: {'likestatus': value, 'blogid': id},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function() {
                    console.log('success');                
                },
                error: function() {
                    alert("failure From php side!!!");
                }
            });
        }
    </script>
@endsection