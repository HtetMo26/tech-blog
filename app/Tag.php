<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = ['tag_name'];

    public function blogs() {
        return $this->belongsToMany(Blog::class, 'blogs_tags');
    }
}

