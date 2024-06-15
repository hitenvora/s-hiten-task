<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class local_notification_user extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $table='local_notification_user';
    public $timestamps=true;
    protected $fillable=['noti_user_id','noti_type','noti_msg','noti_status'];
}
