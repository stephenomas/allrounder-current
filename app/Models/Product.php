<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function salesitem(){
        return $this->hasOne(SalesItem::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function spec(){
        return $this->belongsTo(Spec::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

}
