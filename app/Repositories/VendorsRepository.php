<?php
namespace App\Repositories;

use App\Repositories\VendorsRepositoyInterface;
use App\Models\Vendors;

class VendorsRepository implements VendorsRepositoyInterface
{
    
    function all(){
        return Vendors::all();
    }
    function create(array $vendor){
        return Vendors::create($vendor);
    }
    function findOne($id){
        return Vendors::find($id);
    }
    function delete($id){
        return Vendors::find($id)->delete();
    }
}