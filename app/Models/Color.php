<?php

namespace App\Models;

use App\Models\Size;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Color extends Model
{
    protected $hidden = ["created_at", "updated_at"];
    use HasFactory;

    public function sizes()
    {
        return $this->belongsToMany(Size::class, ColorSize::class)->withTimestamps()->as('configuration');
    }
}
