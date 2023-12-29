<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;
class Affiliate extends Model
{
    use HasFactory;

    public function seller(){
        return $this->hasOne(SellerVerification::class, 'refer_by', 'code');
    }

    public function sellers(){
        return $this->hasMany(SellerVerification::class, 'refer_by', 'code');
    }
}