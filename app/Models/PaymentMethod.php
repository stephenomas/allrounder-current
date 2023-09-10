<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'paymentmethods';

    public function sales(){
        return $this->belongsTo(Sales::class);
    }
}
