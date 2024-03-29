<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Blog;
use App\Category;
use App\Tag;
use App\Blog_Tag;
use App\Comment;
use App\Like;
use App\Notifications\CommentNotification;
use App\Notifications\LikeNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Laravel\Ui\Presets\React;

class BlogController extends Controller
{
    public function showCategory(Request $request) {
        $categoryBlogs = Category::find($request->id)->blogs;
        $category = Category::find($request->id);
        return view('category', compact('categoryBlogs', 'category'));
    }

    public function showTag(Request $request) {
        $tagBlogs = Tag::find($request->id)->blogs;
        $tag = Tag::find($request->id);
        return view('tag', compact('tagBlogs', 'tag'));
    }

    public function createBlog() {
        $categories = Category::all();
        $tags = Tag::all();
        return view('create-blog', compact('categories', 'tags'));
    }

    public function storeBlog(Request $request) {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'tags' => 'required'
        ]);

        if($request->file('image')){
            $fileName = time().'_'.$request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads', $fileName, 'public');
        }

        $blog = Blog::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category,
            'image' => $path
        ]);

        foreach($request->tags as $tag){
            Blog_Tag::create([
                'blog_id' => $blog->id,
                'tag_id' => $tag
            ]);
        }

        return back()->with('success', 'Blog created successfully!');
    }

    public function showBlogDetails(Request $request) {
        $blogDetails = Blog::find($request->id);
        $userDetails = User::where('id', Auth::user()->id)->first();
        //$tags = Blog_Tag::where('blog_id', $blogDetails->id)->get();
        $newTags = $blogDetails->tags;
        $blogComments = $blogDetails->comments;
        // $newTagName = [];
        // foreach ($tags as $tag) {
        //     $tagParent = Tag::where('id', $tag->tag_id )->first();

        //     $newTagName[] = $tagParent->tag_name;
        // }

        $commentUsers = [];

        foreach ($blogComments as $blogComment) {
            $commentUsers[] = $blogComment->user;
        }

        $blogLikes = $blogDetails->likes;

        $userLiked = '';

        foreach ($blogLikes as $blogLike) {
            if ($blogLike->user_id == Auth::user()->id)
            {
                $userLiked = true;
            }
        }

        $blogAuthor = $blogDetails->user;
        $category = $blogDetails->category;

        return view('view-blog', compact('blogDetails', 'userDetails', 'newTags', 'blogComments', 'commentUsers', 'blogLikes', 'userLiked', 'blogAuthor', 'category'));
    }

    public function storeComment(Request $request) {
        $request->validate([
            'comment' => 'required'
        ]);

        Comment::create([
            'comment' => $request->comment,
            'blog_id' => $request->id,
            'user_id' => Auth::user()->id
        ]);

        $user = Blog::find($request->id)->user;

        $offerData = [
            'name' => Auth::user()->name,
            'id' => Auth::user()->id,
            'blogTitle' => Blog::find($request->id)->title,
            'offerUrl' => url('/view-blog/'.$request->id.'#comment'),
            'offer_id' => 007
        ];

        Notification::send($user, new CommentNotification($offerData));

        return back()->with('success', 'Comment posted successfully!');
    }

    public function storeLike(Request $request) {
        $id = $request->blogid;
        $likestatus = $request->likestatus;
        if ($likestatus == true) {
            Like::where('blog_id', $id)->where('user_id', Auth::user()->id)->delete();
        } else {
            Like::create([
                'blog_id' => $id,
                'user_id' => Auth::user()->id
            ]);

            $user = Blog::find($id)->user;

            $offerData = [
                'id' => Auth::user()->id,
                'name' => Auth::user()->name,
                'blogTitle' => Blog::find($id)->title,
                'offerUrl' => url('/view-blog/'.$id),
                'offer_id' => 001
            ];

            Notification::send($user, new LikeNotification($offerData));
        }
    }

    public function markComment(Request $request) {
        $noti_id = $request->notiid;

        $notification = Auth::user()->notifications->where('id', $noti_id)->first();

        if ($notification) {
            $notification->markAsRead();
        }
    }

}


