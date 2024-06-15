<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class complaint extends Model
{
    use HasFactory;

    public function customer(){
          return $this->belongsTo(User::class,'_customer_id','id');
    }
}
