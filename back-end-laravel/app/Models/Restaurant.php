<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    public function products(){

      return $this->hasMany(Product::class);

    }

    public function types(){

      return $this->belongsToMany(Type::class);

    }

    public function user(){

      return $this->hasOne(User::class);

    }

    protected $fillable = [


        'user_id',
        'name',
        'slug',
        'address',
        'phone',
        'logo',
        'vat_number',

    ];



}
