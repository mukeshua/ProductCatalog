<?php 
namespace App\Repositories;
use App\Models\Product;
use App\DAO\ProductDAO;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use App\Exceptions\ProductNotAvailableException;
class ProductRepository implements ProductRepositoryInterface
{
    public function getProductByPaginated($filters=[], $perPage = 10)
    {
        
        $query = Product::query(); 
        if (isset($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }
        if (isset($filters['search'])) {
            $query->where(function ($query) use ($filters) {
                $search = $filters['search'];
                $query->where('name', 'like', "%$search%")
                      ->orWhere('description', 'like', "%$search%");
            });
        }
        return $query->with('category')->paginate($perPage);
    }

    public function fetchProductById($id)
    {
        $product= Product::with('category')->find($id);
        if (!$product) {
            throw new ProductNotAvailableException();
        }
        return new ProductDAO(
            $product->id,
            $product->name,
            $product->description,
            $product->sku,
            $product->price,
            $product->category_id,
            $product->category,
            $product->created_at,
            $product->updated_at
        );
    }

    public function create(array $data)
    {
        
        return Product::create($data);
    }

    public function update($id, array $data)
    {
        
        $product = Product::find($id);
        return $product->update($data);
    }

    public function delete($id)
    {
        return Product::destroy($id);
    }
}
