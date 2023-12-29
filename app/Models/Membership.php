<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    public function membershipDurations()
    {
        return $this->hasMany(MembershipDuration::class);
    }
}
