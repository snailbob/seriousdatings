<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use  App\Http\Controllers\EditableEmailController as editEmail;

class UserBlog extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'admin_id',
        'user_id',
        'blog_type_id',
        'blog_status_id',
        'blog_category_id',
        'blogTitle',
        'blogContent',
        'blogImage',
        'blogby',
    ];

    protected $date = ['created_at', 'updated_at', 'deleted_at'];

    public function getCreatedAtAttribute($date)
    {
        return self::time_elapsed_string($date, false);
    }

    public function getBlogContentAttribute($content)
    {
        return self::convertApostrophe($content);
    }

    public function getBlogTitleAttribute($title)
    {
        return self::convertApostrophe($title);
    }

    public function blogStatus()
    {
        return $this->belongsTo('App\BlogStatus');
    }

    public function blogCategory()
    {
        return $this->belongsTo('App\BlogCategory');
    }

    public function blogType()
    {
        return $this->belongsTo('App\BlogType');
    }

    public function blogComment()
    {
        return $this->hasMany('App\BlogComment', 'blog_id');
    }

    public static function convertApostrophe($text)
    {
        return str_replace("â€™", "'", $text);
    }

    public static function time_elapsed_string($datetime, $full = false)
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

    public static function getBlogData($id)
    {
        $data = self::find($id);
        $data->load('blogStatus');
        $blog = $data->toArray();
        $blog['blogTitle'] = UserBlog::convertApostrophe($data['blogTitle']);
        $blog['blogContent'] = UserBlog::convertApostrophe($data['blogContent']);
        $blog['intro'] = editEmail::setContentToEllipse($data['blogContent']);
        return $blog;
    }
}
