<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function products(){

      return $this->belongsToMany(Product::class, 'order_product')->withPivot('quantity');

    }

    protected $fillable = [
      'name',
      'lastname',
      'email',
      'amount',
      'address',
      'city',
      'state',
      'postal_code',
      'phone',
      'notes'
    ];

}
