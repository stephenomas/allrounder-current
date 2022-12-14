<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function product(){
        return $this->hasMany(Product::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function ckd(){
        return $this->hasOne(Ckd::class);
    }

    public function warehouse(){
        return $this->hasMany(Warehouse::class);
    }
}
