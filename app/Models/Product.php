<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Material;
use App\Models\Style;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'category',
        'material',
        'style'
    ];

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function style()
    {
        return $this->belongsTo(Style::class);
    }
}
