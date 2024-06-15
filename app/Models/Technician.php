<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Technician extends Authenticatable implements JWTSubject
{
    use HasFactory,AuthenticatableTrait;
    // $table="technician";
    //protected $table = 'technician';
    protected $table = 'technicians';
    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $guard='api';

    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }

    public function job()
    {
        return $this->hasOne(job::class);
    }

    public function attendances(){
        return $this->hasMany(Attendance::class);
    }
}
