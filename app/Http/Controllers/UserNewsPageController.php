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
use App\BlogSubscription;
use  App\Http\Controllers\EditableEmailController as editEmail;

class UserNewsPageController extends Controller
{
    public function ListNews()
    {
        $data = UserBlog::where('blog_type_id', 2)->get();
        $data->load('blogStatus', 'blogCategory', 'blogType');
        foreach ($data->toArray() as $key => $value) {
            $news[$key] = $value;
            $news[$key]['blogTitle'] = UserBlog::convertApostrophe($value['blogTitle']);
            $news[$key]['blogContent'] = UserBlog::convertApostrophe($value['blogContent']);
            $news[$key]['intro'] = editEmail::setContentToEllipse($value['blogContent']);
        }

        return \View::make('user.news_page.news_list_user_page')->with('news', $news);
    }

    public function newsPageView($id)
    {
        $data = UserBlog::find($id);
        $data->load('blogStatus');
        $news = $data->toArray();
        if (Auth::check()) {
            if ($news['blog_status']['name'] == "Published" || (Auth::user()->role == "admin" || Auth::id() == $news->user_id)) {
                $news = UserBlog::getBlogData($id);
                $comments = BlogComment::getBlogComment($id);
                return \View::make('user.blog_page.blog_page')->with(['blog' => $news, 'comments' => $comments]);
            } else {
                return \Redirect::to('bloglist');
            }
        } else {
            if ($news['blog_status']['name'] == "Published") {
                $news = UserBlog::getBlogData($id);
                $comments = BlogComment::getBlogComment($id);
                return \View::make('user.blog_page.blog_page')->with(['blog' => $news, 'comments' => $comments]);
            } else {
                return \Redirect::to('bloglist');
            }
        }
    }



    public function commentInNews(Request $request)
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

    public function subscribeEmail(Request $request)
    {
        $errors = $this->validate($request, [
            'email' => 'required|max:1000|email|unique:blog_subscription,email',
        ]);
        $subscribe = BlogSubscription::create([
            'email' => $request->email
        ]);

        return response()->json($subscribe);
    }

}
