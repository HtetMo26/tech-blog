<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['comment', 'blog_id', 'user_id'];

    public function blog() {
        return $this->belongsTo(Blog::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}


