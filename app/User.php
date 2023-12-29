<?php

namespace App;

use App\Models\Area;
use App\Models\City;
use App\Models\Country;
use App\Models\Customers;
use App\Models\Product;
use App\Models\Package;
use App\Models\Membership;
use App\Models\SellerMembership;
use App\Models\State;
use App\Models\Zone;
use App\Models\SellerVerification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isOnline(){
        return Cache::has('UserOnline-'.$this->id);
    }

    public function get_country(){
        return $this->hasOne(Country::class, 'id','country');
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
    public function sellerVerify(){
        return $this->hasOne(SellerVerification::class, 'seller_id');
    }

    public function sellerMembership(){
        return $this->hasOne(SellerMembership::class, 'seller_id')->orderBy("id", "desc");
    }

    public function getMembership(){
        return $this->hasOne(Membership::class, 'slug', 'membership');
    }

    public function posts(){
        return $this->hasMany(Product::class);
    }


}
