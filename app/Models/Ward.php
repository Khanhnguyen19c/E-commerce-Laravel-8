<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    protected $table = "tbl_xaphuongthitran";
    public function provinces()
    {
        return $this->belongsTo(Province::class);
    }

}
