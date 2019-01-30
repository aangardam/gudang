<?php

namespace App\Repositories;
use App\Repositories\StoreRepositoryInterface;
use App\Models\Products;

class ProductsRepository implements ProductsRepositoryInterfece
{
    function getPO(){
        return Products::where('status','PO')->get();
    }
    function create(array $data){
        return Products::create($data);
    }
    function findOne($id){
        return Products::find($id);
    }
    function delete($id){
        return Products::find($id)->delete();
    }

    public function update(array $data,$id){
		$record = $this->findOne($id);
		return $record->update($data);
    }
    
    
}
