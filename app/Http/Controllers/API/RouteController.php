<?php

namespace App\Http\Controllers\API;

use App\Tag;
use App\Blog;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class RouteController extends Controller
{
    //get all blog list
    public function blogList(){
        $blogs = Blog::get();
        $users = User::get();
        $categories = Category::get();
        $tags = Tag::get();
        $data = [
            'blogs' => $blogs,
            'users' => $users,
            'categories' => $categories,
            'tags' => $tags
        ];

        return response()->json($data, 200);
    }

    //get all category list
    public function categoryList(){
        $categories = Category::orderBy('id','desc')->get();
        return response()->json($categories, 200);
    }

    //get all user list
    public function userList(){
        $users = User::all();
        return response()->json($users, 200);
    }

    public function tagList(){
        $tags = Tag::get();
        return response()->json($tags, 200);
    }

    public function createCategory(Request $request){
        // $request->validate([
        //     'category_name' => 'required'
        // ]);
        // dd($request->all());
        // Category::create([
        //     'category_name' => $request->category_name
        // ]);
        $data = [
            'category_name' => $request->category_name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $response = Category::create($data);
        return response()->json($response, 200);
    }

    public function createTag(Request $request){
        $data = [
            'tag_name' => $request->tag_name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $response = Tag::create($data);
        return response()->json($response, 200);
    }

    public function deleteCategory (Request $request){
        Category::where('id', $request->id)->delete();
        return response()->json(['message' => 'Delete success'], 200);
    }
}
