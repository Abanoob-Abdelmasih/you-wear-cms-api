<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $hidden = ["created_at", "updated_at", "isActive"];
    use HasFactory;

    public function configuration()
    {
        return $this->hasMany(ProductConfiguration::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }
}
