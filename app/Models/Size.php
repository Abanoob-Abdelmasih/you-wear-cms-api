<?php

namespace App\Models;

use App\Models\Color;
use App\Models\ProductConfiguration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Size extends Model
{
    protected $hidden = ["created_at", "updated_at","isActive"];
    use HasFactory;
    public function colors()
    {
        return $this->belongsToMany(Color::class, ProductConfiguration::class, 'size_id', 'color_id')->withTimestamps()->as('configuration');
    }
}
