<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->hasMany(User::class);
    }

    public function warehouses(){
        return $this->hasMany(Warehouse::class);
    }

    public function ckd(){
        return $this->hasMany(Ckd::class);
    }

    public function sales(){
        return $this->hasMany(Sales::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
