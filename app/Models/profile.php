<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id','avatar','status','location'];

    // Relasi balik ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
