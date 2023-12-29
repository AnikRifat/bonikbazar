<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateDiscount extends Model
{
    use HasFactory;

    public function getMembership()
    {
        return $this->hasOne(Membership::class, "slug", "membership");
    }
}
