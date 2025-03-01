<?php
namespace App\Repositories;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use App\Exceptions\CategoryNotAvailableException;
class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategoryList()
    {
       
        $UnqCatCacheKey = 'categories_' . md5(json_encode(['categories'=>'all']) . 10);
        $categories = Cache::remember($UnqCatCacheKey, now()->addMinutes(60), function () {
            return Category::all();
          });
          return $categories; 
    }

    public function fetchCategoryById($id)
    {
        $categorieslist = Cache::remember('categoriesById'.$id, now()->addMinutes(60), function () use ($id) {
            return Category::find($id);
        });
        if (!$categorieslist) {
            throw new CategoryNotAvailableException();
        }
        return $categorieslist; 
    }

    public function create(array $data)
    {
        Cache::forget('categories_' . md5(json_encode([]) . 10));
        return Category::create($data); 
    }

    public function update($id, array $data)
    {
        Cache::forget('categoriesById' . $id);
        Cache::forget('categories_' . md5(json_encode([]) . 10));
        $category = Category::find($id);
        return $category->update($data); 
    }

    public function delete($id)
    {
        Cache::forget('categoriesById' . $id);
        Cache::forget('categories_' . md5(json_encode([]) . 10));
        return Category::destroy($id);
    }
}
