<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $hidden = ["created_at", "updated_at"];
    use HasFactory;

    public function productconfigurations()
    {
        return $this->hasMany(ProductConfiguration::class);
    }
}
