<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\BusinessObjects\CategoryBO;
use App\DAO\CategoryDAO;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
  
    private function buildCategoryTree($categories)
{
    $categoryTree = [];

    foreach ($categories as $category) {
        $categoryData = new CategoryDAO(
            $category->id,
            $category->name,
            $category->parent_category_id,
            $category->created_at,
            $category->updated_at,
            $this->buildCategoryTree($category->children) // Recursive call for children
        );
        $categoryTree[] = $categoryData;
    }

    return $categoryTree;
}

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return response()->json([
            'message' => 'Category fetched successfully',
            'category' => $this->buildCategoryTree($categories)
        ], 200);
    }

    public function show($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }
        return response()->json([
            'message' => 'Category fetched successfully',
            'category' => $this->buildCategoryTree([$category])
        ], 200);
    }

    public function store(CategoryRequest $request)
    {
        
        $validated = $request->validated();
        $categoryBO = new CategoryBO(null,$validated['name'], $validated['parent_category_id'],  
        );
        $category = $this->categoryService->createCategory($categoryBO);
        return response()->json([
            'status'=>true,
            'message' => 'Category created successfully',
            'category' => $category,
        ], 201);
    }

    public function update(CategoryRequest $request, $id)
    {
        
        $category = $this->categoryService->getCategoryById($id);
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }
        $validated = $request->validated();
        $categoryBO = new CategoryBO($id,$validated['name'], $validated['parent_category_id'],  
    );
        $category = $this->categoryService->updateCategory($id, $categoryBO);
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }
        return response()->json([
            'status'=>true,
            'message' => 'Category Updated successfully',
        ], 201);
    }

    public function destroy($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }
        $this->categoryService->deleteCategory($id);
        return response()->json([
            'message' => 'Category Deleted successfully',
        ], 204);
    }
}