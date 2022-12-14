<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'branch_id',
        'position',
        'role',
        'photo',
        'login',
        'logout',


    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function access(){
        return $this->hasOne(Access::class);
    }
    public function product(){
        return $this->hasMany(Product::class);
    }
    public function sales(){
        return $this->hasMany(Sales::class);
    }
    public function report(){
        return $this->hasMany(Report::class);
    }

    public function ckd(){
        return $this->hasMany(Ckd::class);
    }
    public function ckdhistory(){
        return $this->hasMany(CkdHistory::class);
    }

    public function warehouses(){
        return $this->hasMany(Warehouse::class);
    }
}
