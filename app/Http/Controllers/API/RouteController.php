<?php

namespace App\Http\Controllers\API;

use App\Blog;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //get all blog list
    public function blogList(){
        $blogs = Blog::get();
        $users = User::all();
        $data = [
            'blogs' => $blogs,
            'users' => $users
        ];

        return response()->json($data, 200);
    }

    //get all category list
    public function categoryList(){
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    //get all user list
    public function userList(){
        $users = User::all();
        return response()->json($users, 200);
    }
}
