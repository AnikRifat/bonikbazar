<?php

namespace App\Models;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Addvertisement extends Model
{
    protected $guarded = [];

    public function customer(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
