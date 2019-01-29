<?php
namespace App\Repositories;

interface StoreRepositoryInterface {
    function All();
    function create(array $data);
    function findOne($id);
    function delete($id);
}