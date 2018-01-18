<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable;
    use CanResetPassword;
    use EntrustUserTrait;
    use SoftDeletes;


    protected $table = 'templates';

    protected $fillable = ['template_name', 'template_subject', 'template_content'];

    protected $date = ['created_at', 'updated_at', 'deleted_at'];

    public function setTemplateNameAttribute($value)
    {
        $this->attributes['template_name'] = trim($value);
    }

    public function setTemplateSubjectAttribute($value)
    {
        $this->attributes['template_subject'] = trim($value);
    }

}
