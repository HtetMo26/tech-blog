<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    protected $fillable = ['blog_id', 'user_id'];

    public function blog() {
        return $this->belongsTo(Blog::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
