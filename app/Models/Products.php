<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vendors;
use App\Models\Category;
class Products extends Model
{
    protected $fillable = ['name','no_trans','price','finishing','status','total','image','vendor_id','category_id'];

    public function vendor(){
        return $this->belongsTo(Vendors::class,'vendor_id');
    }
    public function category(){ 
        return $this->belongsTo(Category::class,'category_id');
    }
}
