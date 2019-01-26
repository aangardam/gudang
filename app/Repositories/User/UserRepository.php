<?php
namespace App\Repositories\User;
use App\Repositories\Repository;

/**
 * 
 */
class UserRepository implements Repository
{
	protected $model;
	function __construct($model)
	{
		$this->model = $model;
	}

	public function findAll(){
		return $this->model->all();
	}
	public function create(array $data){
		return $this->model->create($data);
	}
	public function findOne($id){
		return $this->model->findOrFail($id);
	}
	public function update(array $data,$id){
		$record = $this->find($id);
		return $record->update($data);
	}
	public function delete($id){
		return $this->model->destroy($id);
	}

}
?>