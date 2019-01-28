<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Vendors extends Model
{
    use SoftDeletes;
    protected $fillable=['name','address','notelp','email','category_id','active'];
    protected $dates = ['deleted_at'];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
