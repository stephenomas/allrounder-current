<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CkdHistory extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function ckd(){
        return $this->belongsTo(Ckd::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
