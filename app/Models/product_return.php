<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product_return extends Model
{
    protected $fillable = ['store_id','product_id','size','qty','code','nosurat','status'];

    public function store(){
        return $this->belongsTo(Store::class,'store_id');
    }
    public function produk(){
        return $this->belongsTo(Products::class,'product_id');
    }
}
