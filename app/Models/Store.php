<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Store extends Model
{
    protected $fillable = ['name','address','telp','email','status','user_id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
