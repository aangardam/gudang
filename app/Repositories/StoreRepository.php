<?php

namespace App\Repositories;
use App\Repositories\StoreRepositoryInterface;
use App\Models\Store;

class StoreRepository implements StoreRepositoryInterface
{
    
    function All(){
        return Store::all();
    }
    function create(array $data){
        return Store::create($data);
    }
    function findOne($id){
        return Store::find($id);
    }
    function delete($id){
        return Store::find($id)->delete();
    }

    public function update(array $data,$id){
		$record = $this->findOne($id);
		return $record->update($data);
    }
    
    
}
