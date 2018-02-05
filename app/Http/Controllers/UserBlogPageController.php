<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Auth;
use DB;
use Redirect;
use Input;
use View;
use App\UserBlog;
use App\BlogCategory;
use App\BlogStatus;
use App\BlogType;
use App\BlogComment;
use App\Http\Controllers\EditableEmailController as editEmail;

class UserBlogPageController extends Controller
{
    public function ListBlog()
    {
        $data = UserBlog::where('blog_type_id', 1)->get();
        $data->load('blogStatus', 'blogCategory', 'blogType');
        foreach ($data->toArray() as $key => $value) {
            $blogs[$key] = $value;
            $blogs[$key]['blogTitle'] = UserBlog::convertApostrophe($value['blogTitle']);
            $blogs[$key]['blogContent'] = UserBlog::convertApostrophe($value['blogContent']);
            $blogs[$key]['intro'] = editEmail::setContentToEllipse($value['blogContent']);
        }

        return \View::make('user.blog_page.blog_list_user_page')->with('blogs', $blogs);
    }

    public function blogPageView($id)
    {
        $data = UserBlog::find($id);
        $data->load('blogStatus');
        $blog = $data->toArray();
        $blog = UserBlog::getBlogData($id);
        $comments = BlogComment::getBlogComment($id);
        if (Auth::check()) {
            if ($blog['blog_status']['name'] == "Published" || (Auth::user()->role == "admin" || Auth::id() == $blog['user_id'])) {
                return \View::make('user.blog_page.blog_page')->with(['blog' => $blog, 'comments' => $comments]);
            }
        } else {
            if ($blog['blog_status']['name'] == "Published") {
                return \View::make('user.blog_page.blog_page')->with(['blog' => $blog, 'comments' => $comments]);
            }
        }
        return \Redirect::to('bloglist');
    }

    static function getBlogData($id)
    {
        $data = UserBlog::find($id);
        $data->load('blogStatus');
        $blog = $data->toArray();
        $blog['blogTitle'] = UserBlog::convertApostrophe($data['blogTitle']);
        $blog['blogContent'] = UserBlog::convertApostrophe($data['blogContent']);
        $blog['intro'] = editEmail::setContentToEllipse($data['blogContent']);
        return $blog;
    }

    static function getBlogComment($id)
    {
        $data = BlogComment::where('blog_id', $id)->get();
        $data->load('user');
        $comments = array();
        if ($data) {
            foreach ($data->toArray() as $key => $value) {
                $comments[$key] = $value;
                $comments[$key]['created_at'] = UserBlog::time_elapsed_string($value['created_at']);
            }
        }
        return $comments;
    }

    public function commentInBlog(Request $request)
    {
        $errors = $this->validate($request, [
            'comment' => 'required|max:1000',
            'id' => 'required|exists:user_blogs,id',
        ]);

        $comment = BlogComment::create([
            'blog_id' => $request->id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);
        $comment->load('user');
        return response()->json($comment);
    }

    public function deleteComment(Request $request)
    {
        $errors = $this->validate($request, [
            'comment_id' => 'required|exists:blog_comments,id'
        ]);

        $comment = BlogComment::find($request->comment_id);
        $comment->load('user');
        $comment->delete();

        return response()->json($comment);
    }

    public function createBlog()
    {
        $categories = BlogCategory::all();
        $statuses = BlogStatus::all();
        $types = BlogType::all();

        return \View::make('user.blog_page.user_create_blog')->with(['categories' => $categories, 'statuses' => $statuses, 'types' => $types]);
    }

    public function saveBlog(Request $request)
    {
        $filname = \Input::file('uploadpicture')->getClientOriginalName();
        \Input::file('uploadpicture')->move(base_path() . '/public/assets/', $filname);

        $admin = (Auth::user()->role == "admin") ? Auth::id() : null;
        $user = (Auth::user()->role == "user") ? Auth::id() : null;
        $blog_type = BlogType::where('name', \Input::get('postType'))->first();
        $blog_category = BlogCategory::where('name', \Input::get('postCategory'))->first();

        $data = UserBlog::create([
            'admin_id' => $admin,
            'user_id' => $user,
            'blog_type_id' => $blog_type->id,
            'blog_status_id' => 2,
            'blog_category_id' => $blog_category->id,
            'blogTitle' => \Input::get('postTitle'),
            'blogContent' => \Input::get('editor1'),
            'blogImage' => $filname,
            'blogby' => Auth::user()->firstName
        ]);
        $data->load('blogStatus', 'blogType');
        $blog = $data->toArray();
        $blog['blogTitle'] = UserBlog::convertApostrophe($data['blogTitle']);
        $blog['blogContent'] = UserBlog::convertApostrophe($data['blogContent']);
        $blog['intro'] = editEmail::setContentToEllipse($data['blogContent']);

        $data = BlogComment::where('blog_id', $blog['id'])->get();
        $data->load('user');
        $comments = array();
        if ($data) {
            foreach ($data->toArray() as $key => $value) {
                $comments[$key] = $value;
                $comments[$key]['created_at'] = UserBlog::time_elapsed_string($value['created_at']);
            }
        }

        $type_link = strtolower($blog['blog_type']['name']) . "_page/";

        return redirect('user/' . $type_link . $blog['id'])->with(['blog' => $blog, 'comments' => $comments]);
    }


}
