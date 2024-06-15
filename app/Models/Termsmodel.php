<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Termsmodel extends Model
{
    use HasFactory;
    protected $table = "terms";
    protected $Primarykey = "id";
    public $timestamps = false;
}
