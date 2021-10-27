<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = "profiles";

    public function city(){
        return $this->belongsTo(City::class);
    }
    public function province(){
        return $this->belongsTo(Province::class);
    }
    public function ward(){
        return $this->belongsTo(Ward::class);
    }
}
