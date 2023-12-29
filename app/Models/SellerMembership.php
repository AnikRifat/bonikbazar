<?php

namespace App\Models;
use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerMembership extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class, "seller_id");
    }

    public function sellerVerify(){
        return $this->hasOne(SellerVerification::class, 'seller_id', 'seller_id');
    }
} 
