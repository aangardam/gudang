<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;
//class Role extends Model
class Role extends EntrustRole
{
    protected $fillable=['name','display_name'];
}
