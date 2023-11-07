<?php

namespace App\Models;

use App\Models\Color;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Size extends Model
{
    protected $hidden = ["created_at", "updated_at"];
    use HasFactory;
    public function colors()
    {
       return $this->belongsToMany(Color::class, ColorSize::class)->withTimestamps();
    }
}
