<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image',
        'tags',
        'category',
        'is_private',
        'allow_download',
        'allow_comment',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | LIKE
    |--------------------------------------------------------------------------
    */

    public function likes()
    {
        return $this->belongsToMany(
            User::class,
            'likes',
            'post_id',
            'user_id'
        )->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | COMMENT
    |--------------------------------------------------------------------------
    */

    public function comments()
    {
        return DB::table('comments')
            ->where('post_id', $this->id)
            ->get();
    }
}
