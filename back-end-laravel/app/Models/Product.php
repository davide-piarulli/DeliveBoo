<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function orders(){

      return $this->belongsToMany(Order::class);

    }

    public function productTypes(){

      return $this->belongsTo(ProductType::class);

    }

    public function restaurants(){

      return $this->belongsTo(Restaurant::class);

    }
}
