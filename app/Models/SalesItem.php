<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sales(){
        return $this->belongsTo(Sales::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
