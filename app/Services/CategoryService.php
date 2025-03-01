<?php
namespace App\Services;
use App\Http\Controllers\Controller;
use App\BusinessObjects\CategoryBO;
use App\DAO\CategoryDAO;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryService extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories()
    {
       
        return $this->categoryRepository->getAllCategoryList();
     
    }

    public function getCategoryById(int $id)
    {

        return $this->categoryRepository->fetchCategoryById($id);

    }

    public function createCategory(CategoryBO $categoryBO)
    {
        $data = [
            'name' => $categoryBO->name,
            'parent_category_id' => $categoryBO->parent_category_id,
        ];
        $category= $this->categoryRepository->create($data);
        return new CategoryDAO(
            $category->id,
            $category->name,
            $category->parent_category_id,
            $category->created_at,
            $category->updated_at
        );
    }

    public function updateCategory(int $id, CategoryBO $categoryBO)
    {
       $this->categoryRepository->fetchCategoryById($id);

        $data = [
            'name' => $categoryBO->name,
            'parent_category_id' => $categoryBO->parent_category_id,
        ];
        return $this->categoryRepository->update($id, $data);
    }

    public function deleteCategory(int $id)
    {
        $this->categoryRepository->fetchCategoryById($id);
        return $this->categoryRepository->delete($id);
    }
}