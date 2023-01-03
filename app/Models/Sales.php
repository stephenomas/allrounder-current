<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function salesitem(){
        return $this->hasMany(SalesItem::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

}
