<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Blog;
use App\Category;
use App\Tag;
use App\Blog_Tag;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showOwnProfile() {
        $userDetails = User::where('id', Auth::user()->id)->first();
        $yourBlogs = Auth::user()->blogs;

        return view('yourprofile', compact('userDetails','yourBlogs'));
    }
}
