<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UserBlog;
use  App\Http\Controllers\EditableEmailController as editEmail;

class BlogComment extends Model
{
    protected $table = 'blog_comments';
    protected $fillable = ['comment', 'user_id', 'blog_id'];
    protected $date = ['created_at', 'updated_at', 'deleted_at'];


    public function getCreatedAtAttribute($date)
    {
        return self::time_elapsed_string($date, false);
    }

    public function userBlog()
    {
        return $this->belongsTo('App\UserBlog', 'blog_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    static function time_elapsed_string($datetime, $full = false)
    {
        $now = new \DateTime;
        $ago = new \DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }


    public static function getBlogComment($id)
    {
        $data = self::where('blog_id', $id)->get();
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

}
