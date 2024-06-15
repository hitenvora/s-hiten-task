<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;



class JobSubCategory extends Model

{

    use HasFactory;

    protected $table = 'job_subcategories';

    protected $guarded = [];

    // public function subcategory()
    // {
    //     return $this->hasMany(JobSubCategory::class,'category');
    // }


}

