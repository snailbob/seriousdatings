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
use App\BlogComment;

class BlogManagementController extends Controller
{
    public function showCreatePost()
    {
        $categories = BlogCategory::all();
        $statuses = BlogStatus::all();
        $types = BlogType::all();
        return \View::make('admin.blog_management.create_post')->with(['categories' => $categories, 'statuses' => $statuses, 'types' => $types]);
    }

    public function showCategoryLists()
    {
        $categories = BlogCategory::all();
        return \View::make('admin.blog_management.category_list')->with('categories', $categories);
    }

    public function showPostLists()
    {
        $posts = UserBlog::withTrashed()->get();
        $posts->load('blogStatus', 'blogCategory', 'blogType');
        $status = BlogStatus::all();
        return \View::make('admin.blog_management.blog_list')->with(['posts' => $posts, 'status' => $status]);
    }

    public function showStatusLists()
    {
        $statuses = BlogStatus::all();
        return \View::make('admin.blog_management.status_list')->with('statuses', $statuses);
    }

    public function showSpamControl()
    {
        $comments = BlogComment::all();
        $comments->load('user', 'userBlog');
        foreach ($comments as $comment) {
            $comment->userBlog->blogTitle = UserBlog::convertApostrophe($comment->userBlog->blogTitle);
        }
        return \View::make('admin.blog_management.spam_control')->with('comments', $comments);
    }

    public function showTypeLists()
    {
        $types = BlogType::all();
        return \View::make('admin.blog_management.type_list')->with('types', $types);
    }

    public function showPostById($id)
    {
        $post = UserBlog::find($id);
        $post->load('blogStatus', 'blogCategory', 'blogType');
        return \View::make('admin.blog_management.admin_timeline')->with('post', $post);
    }

    public function savePost(Request $request)
    {
        $errors = $this->validate($request, [
            'postType' => 'required|max:255|exists:blog_type,name',
            'postStatus' => 'required|max:255|exists:blog_status,name',
            'postCategory' => 'required|max:255|exists:blog_category,name',
            'postTitle' => 'required|max:255',
            'postContent' => 'required|max:255'
        ]);

        $type = BlogType::where('name', $request->postType)->first();
        $status = BlogStatus::where('name', $request->postStatus)->first();
        $category = BlogCategory::where('name', $request->postCategory)->first();

        $post = UserBlog::create([
            'blog_type_id' => $type->id,
            'blog_status_id' => $status->id,
            'blog_category_id' => $category->id,
            'blogTitle' => $request->postTitle,
            'blogContent' => $request->postContent
        ]);

        return response()->json($post);
    }

    public function getPost(Request $request)
    {
        $post = UserBlog::find($request->id);
        $post->load('blogStatus', 'blogCategory', 'blogType');

        return response()->json($post);
    }

    public function deletePost(Request $request)
    {
        $status = BlogStatus::where('name', 'Trashed')->first();
        UserBlog::where('id', $request->id)
            ->update(['blog_status_id' => $status->id]);

        $post = UserBlog::find($request->id);
        $post->load('blogStatus');
        return response()->json($post);
    }

    public function pendingPost(Request $request)
    {
        $status = BlogStatus::where('name', 'Pending')->first();
        UserBlog::where('id', $request->id)
            ->update(['blog_status_id' => $status->id]);

        $post = UserBlog::find($request->id);
        $post->load('blogStatus');
        return response()->json($post);
    }

    public function publishedPost(Request $request)
    {
        $status = BlogStatus::where('name', 'Published')->first();
        UserBlog::where('id', $request->id)
            ->update(['blog_status_id' => $status->id]);

        $post = UserBlog::find($request->id);
        $post->load('blogStatus');
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

    public function addBlogStatus(Request $request)
    {
        $errors = $this->validate($request, [
            'name' => 'required|max:255|unique:blog_status,name',
        ]);

        $status = BlogStatus::create(['name' => $request->name]);

        return response()->json($status);
    }

    public function editBlogStatus(Request $request)
    {
        $errors = $this->validate($request, [
            'name' => 'required|max:255|unique:blog_status,name',
            'id' => 'required|exists:blog_status,id'
        ]);

        BlogStatus::where('id', $request->id)
            ->update(['name' => $request->name]);

        $status = BlogStatus::find($request->id);
        return response()->json($status);
    }

    public function deleteStatus(Request $request)
    {
        $status = BlogStatus::find($request->id);

        $status->delete();

        return response()->json($status);
    }

    public function addBlogType(Request $request)
    {
        $errors = $this->validate($request, [
            'name' => 'required|max:255|unique:blog_type,name',
        ]);

        $type = BlogType::create(['name' => $request->name]);

        return response()->json($type);
    }

    public function editBlogType(Request $request)
    {
        $errors = $this->validate($request, [
            'name' => 'required|max:255|unique:blog_type,name',
            'id' => 'required|exists:blog_type,id'
        ]);

        BlogType::where('id', $request->id)
            ->update(['name' => $request->name]);

        $type = BlogType::find($request->id);
        return response()->json($type);
    }

    public function deleteType(Request $request)
    {
        $type = BlogType::find($request->id);

        $type->delete();

        return response()->json($type);
    }
}
