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
        $news = $data->toArray();
        $news['blogTitle'] = UserBlog::convertApostrophe($data['blogTitle']);
        $news['blogContent'] = UserBlog::convertApostrophe($data['blogContent']);
        $news['intro'] = editEmail::setContentToEllipse($data['blogContent']);
        $data = BlogComment::where('blog_id', $id)->get();
        $data->load('user');
        $comments = array();
        if ($data) {
            foreach ($data->toArray() as $key => $value) {
                $comments[$key] = $value;
                $comments[$key]['created_at'] = UserBlog::time_elapsed_string($value['created_at']);
            }
        }
        return \View::make('user.news_page.news_page')->with(['news' => $news, 'comments' => $comments]);
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
