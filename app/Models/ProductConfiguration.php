<?php

namespace App\Models;

use App\Models\Size;
use App\Models\Color;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductConfiguration extends Model
{
    use HasFactory;
    protected $table = 'product_configuration';
    protected $hidden = ["product_id", "created_at", "updated_at","color_id","size_id"];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
}
