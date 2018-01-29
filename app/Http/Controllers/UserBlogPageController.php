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
use App\BlogComment;
use  App\Http\Controllers\EditableEmailController as editEmail;

class UserBlogPageController extends Controller
{
    public function blogPageList()
    {
        return \View::make('user.blog_page.blog_list_user_page');
    }

    public function ListBlog()
    {
        $data = UserBlog::all();
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
        $blog = $data->toArray();
        $blog['blogTitle'] = UserBlog::convertApostrophe($data['blogTitle']);
        $blog['blogContent'] = UserBlog::convertApostrophe($data['blogContent']);
        $blog['intro'] = editEmail::setContentToEllipse($data['blogContent']);
        $data = BlogComment::where('blog_id', $id)->get();
        $data->load('user');
        $comments = array();
        if($data)
        {
            foreach ($data->toArray() as $key => $value) {
                $comments[$key] = $value;
                $comments[$key]['created_at'] = UserBlog::time_elapsed_string($value['created_at']);
            }
        }

        return \View::make('user.blog_page.blog_page')->with(['blog' => $blog, 'comments' => $comments]);
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
}
