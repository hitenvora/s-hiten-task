<?php



namespace App\Models;



use App\Models\User;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;



class job extends Model

{

    use HasFactory;

    protected $guarded = [];



    public function customer()

    {

        return $this->belongsTo(User::class,'customer_id','id');

    }



    public function technician(){

        return $this->belongsTo(Technician::class,'technician_id','id');

    }

    public function helpers()
    {
        return $this->belongsTo(Helper::class,'helper_id');
    }


}

