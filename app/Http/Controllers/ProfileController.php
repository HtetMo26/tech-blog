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
    public function showProfile(Request $request) {
        $userDetails = User::find($request->id);

        return view('profile', compact('userDetails'));
    }
}
