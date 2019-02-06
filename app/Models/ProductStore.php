<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStore extends Model
{
    protected $fillable = ['store_id','product_id','size','qty','code'];

    public function store(){
        return $this->belongsTo(Store::class,'store_id');
    }
    public function produk(){
        return $this->belongsTo(Products::class,'product_id');
    }
}
