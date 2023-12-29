<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;
class SellerVerification extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class, "seller_id");
    }

    public function posts(){
        return $this->hasMany(Product::class, "user_id", "seller_id");
    }

    public function get_state(){
        return $this->hasOne(State::class, 'id', 'region');
    }
    public function get_city(){
        return $this->hasOne(City::class, 'id', 'city');
    }
    public function get_area(){
        return $this->hasOne(Area::class, 'id','area');
    }

    public function sellerMembership(){
        return $this->hasOne(SellerMembership::class, 'seller_id', 'seller_id');
    }
}
