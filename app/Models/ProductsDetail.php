<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Products;
class ProductsDetail extends Model
{
    protected $fillable = ['id_products','qty','size'];

    public function products(){
        return $this->belongsTo(Products::class,'id_products');
    }
}
