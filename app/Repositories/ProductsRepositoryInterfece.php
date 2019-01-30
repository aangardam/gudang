<?php
namespace App\Repositories;

interface ProductsRepositoryInterfece {
    function create(array $data);
    function findOne($id);
    function delete($id);
}