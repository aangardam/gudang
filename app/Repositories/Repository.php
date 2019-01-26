<?php
namespace App\Repositories;

interface Repository{
	public function findAll();
	public function create(array $data);
	public function update(array $data,$id);
	public function delete($id);
	public function findOne($id);
}
?>
