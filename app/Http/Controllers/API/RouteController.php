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

    public function deleteCategory ($id){
        $data = Category::where('id', $id)->first();

        if(isset($data)) {
            Category::where('id', $id)->delete();
            return response()->json(['status' => true, 'message' => 'deleteSuccess'], 200);
        }

        return response()->json(['status' => false, 'message' => 'There is no category...'], 200);

    }

    public function categoryDetails ($id) {
        $data = Category::where('id', $id)->first();

        if(isset($data)) {
            return response()->json(['status' => true, 'category' => $data], 200);
        }

        return response()->json(['status' => false, 'category' => 'There is no category...'], 200);
    }

    public function categoryUpdate (Request $request) {
        $id = $request->id;

        $dbSource = Category::where('id', $id)->first();

        if(isset($dbSource)) {
            $data = $this->getCategoryData($request);
            Category::where('id', $id)->update($data);
            $response = Category::where('id', $id)->first();
            return response()->json(['status' => true, 'message' => 'Category update success', 'category' => $response], 200);
        }

        return response()->json(['status' => false, 'message' => 'There is no category to update'], 500);

    }

    private function getCategoryData($request) {
        return [
            'category_name' => $request->category_name,
            'updated_at' => Carbon::now()
        ];
    }
}
