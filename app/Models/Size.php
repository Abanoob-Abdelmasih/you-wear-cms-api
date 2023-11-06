<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $hidden = ["created_at", "updated_at"];
    use HasFactory;
    public function color()
    {
        $this->belongsToMany(Size::class, ColorSize::class);
    }
}
