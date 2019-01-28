<?php
namespace App\Repositories;

interface VendorsRepositoyInterface {
    function All();
    function create($data);
    function findOne($id);
    function delete($id);
	// public function update(array $data,$id);
	// public function delete($id);
	// public function findOne($id);
}