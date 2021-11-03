<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesPost extends Model
{
    use HasFactory;
    protected $table ="categories_posts";

    public function post(){
        return $this->hasMany(Post::class);
    }
}
