<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function transfer_destination(){
        return $this->belongsTo(Branch::class, 'destination_id');
    }

    public function spec(){
        return $this->belongsTo(Spec::class, 'ckd_type');
    }


}

