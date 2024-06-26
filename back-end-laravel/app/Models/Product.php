<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
  use HasFactory;
  use SoftDeletes;


  protected $fillable = [
    'restaurant_id',
    'product_type_id',
    'name',
    'slug',
    'image',
    'image_original_name',
    'description',
    'price',
    'visible',
    'deleted_at'
  ];

  public function orders()
  {
    return $this->belongsToMany(Order::class, 'order_product')->withPivot('quantity');
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
