<?php
namespace App\Repositories\Interfaces;
interface CategoryRepositoryInterface
{
    public function getAllCategoryList();
    public function fetchCategoryById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}