<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationLogs extends Model
{
    //

    protected $table = 'user_notification_logs';

    protected $fillable=[
        'notif_id',
        'notif_from',
        'notif_to',
        'notif_status',
        'notif_type',
        'notif_desc',
        'notif_date'];

    protected $dates = ['deleted_at', 'create_at', 'updated_at'];

}
