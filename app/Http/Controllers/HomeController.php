<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $allBlogs = Blog::all();
        $blogAuthors = [];
        $blogTags = [];

        foreach ($allBlogs as $blog) {
            $blogAuthors[] = $blog->user;
            $blogTags[] = $blog->tags;
        }

        return view('home', compact('allBlogs', 'blogAuthors', 'blogTags'));
    }
}
