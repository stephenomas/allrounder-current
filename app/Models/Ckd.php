<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ckd extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ckdhistory(){
        return $this->hasMany(CkdHistory::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function spec(){
        return $this->belongsTo(Spec::class);
    }
}
