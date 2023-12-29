<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\Vendor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class Product extends Model
{

    protected $guarded = [];

    public function get_category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function get_subcategory(){
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    public function get_childcategory(){
        return $this->belongsTo(Category::class, 'childcategory_id');
    }

    public function get_brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function get_variations(){
        return $this->hasMany(ProductVariation::class, 'product_id', 'id');
    }

    public function get_promoteAd(){
        return $this->hasOne(PromoteAds::class, 'ads_id')->where('start_date', '<=', now())->where('end_date', '>=', now());
    }

    public function get_promotePackage(){
        return $this->hasMany(PromoteAds::class, 'ads_id')->orderBy('id', 'desc')->where('start_date', '<=', now())->where('end_date', '>=', now());
    }

    public function get_features(){
        return $this->hasMany(ProductFeature::class, 'product_id', 'id');
    }

    public function get_galleryImages(){
        return $this->hasMany(ProductImage::class, 'product_id', 'product_id');
    }
    
    public  function wishlist(){
        return $this->hasOne(Wishlist::class, 'product_id')->where('user_id', Auth::id());
    }

    public function messages(){
        return $this->hasMany(Conversation::class, 'product_id');
    }

    public  function reports(){
        return $this->hasMany(ReportReason::class, 'product_id');
    }

    public function reacts(){
        return $this->hasMany(Wishlist::class, 'product_id');
    }


    public  function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public  function membership(){
        return $this->hasOne(User::class, 'user_id')->whereNotNull("membership");
    }

    public  function user(){
        return $this->belongsTo(User::class, 'created_by');
    }


    public  function get_state(){
        return $this->belongsTo(State::class, 'state_id');
    }
    public  function get_city(){
        return $this->belongsTo(City::class, 'city_id');
    }


    public function reviews(){
        return $this->hasMany(Review::class)->where('status', 1);
    }

    public function videos(){
        return $this->hasMany(ProductVideo::class);
    }




}
