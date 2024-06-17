<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'product_type_id',
        'name',
        'slug',
        'image',
        'description',
        'price',
        'visible'
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
