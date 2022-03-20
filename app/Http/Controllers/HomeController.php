<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Blog;
use App\Category;
use App\Tag;

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

        $allBlogs = Blog::latest()->paginate(5);
        $authUser = Auth::user();
        $categories = Category::all();
        $tags = Tag::all();
        
        return view('home', compact('allBlogs', 'authUser', 'categories', 'tags'));
    }
}
