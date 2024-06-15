<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{
    use HasFactory;
    protected $table = "helper";
    protected $PrimaryKey = "id";
    public $timestamps = false;
    protected $fillable=[
        "name",
        "mobile_number",
        "aadhar_no",
        "birthdate",
        "joindate",
        "license_no",
        "address",
        "img"
    ];
}
