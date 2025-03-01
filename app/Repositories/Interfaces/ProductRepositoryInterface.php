<?php 
namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function getProductByPaginated($filters=[], $perPage = 10);
    public function fetchProductById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}