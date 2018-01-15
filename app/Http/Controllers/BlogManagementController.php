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

class BlogManagementController extends Controller
{
    public function showCategoryLists()
    {
        $categories = BlogCategory::all();
        return \View::make('admin.blog_management.category_list')->with('categories', $categories);
    }

    public function addBlogCategory(Request $request)
    {
        $errors = $this->validate($request, [
            'name' => 'required|max:255|unique:blog_category,name',
        ]);

        $category = BlogCategory::create(['name' => $request->name]);

        return response()->json($category);
    }
}
