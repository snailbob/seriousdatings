<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UserBlog;
use App\BlogCategory;
use App\BlogStatus;
use App\BlogType;
use Log;

class BlogManagementController extends Controller
{
    public function showCategoryLists()
    {
        $categories = BlogCategory::all();
        return \View::make('admin.blog_management.category_list')->with('categories', $categories);
    }

    public function showPostLists()
    {
        $posts = UserBlog::all();
        $posts->load('blogStatus', 'blogCategory', 'blogType');
        return \View::make('admin.blog_management.blog_list')->with('posts', $posts);
    }

    public function showPostById($id)
    {   
        $post = UserBlog::find($id);        
        $post->load('blogStatus', 'blogCategory', 'blogType');
        return \View::make('admin.blog_management.admin_timeline')->with('post', $post);
    }

    public function getPost(Request $request)
    {
        $post = UserBlog::find($request->id);
        $post->load('blogStatus', 'blogCategory', 'blogType');

        return response()->json($post);
    }

    public function deletePost(Request $request)
    {
        $post = UserBlog::find($request->id);

        $post->delete();

        return response()->json($post);
    }

    public function addBlogCategory(Request $request)
    {
        $errors = $this->validate($request, [
            'name' => 'required|max:255|unique:blog_category,name,NULL,id,deleted_at,NULL',
        ]);

        $category = BlogCategory::create(['name' => $request->name]);

        return response()->json($category);
    }

    public function editBlogCategory(Request $request)
    {
        $errors = $this->validate($request, [
            'name' => 'required|max:255|unique:blog_category,name,NULL,id,deleted_at,NULL',
            'id' => 'required|exists:blog_category,id'
        ]);

        BlogCategory::where('id', $request->id)
        ->update(['name' => $request->name]);

        $category = BlogCategory::find($request->id);
        return response()->json($category);   
    }

    public function deleteCategory(Request $request)
    {
        $category = BlogCategory::find($request->id);

        $category->delete();

        return response()->json($category);        
    }
}
