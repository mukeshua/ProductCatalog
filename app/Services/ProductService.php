<?php
namespace App\Services;
use App\Http\Controllers\Controller;
use App\BusinessObjects\ProductBO;
use App\DAO\ProductDAO;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Exception;
use App\Models\Product;
class ProductService extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts(array $filters = [], int $perPage = 10)
    {
        
        $products=$this->productRepository->getProductByPaginated($filters, $perPage);
        $productDAOs = $products->getCollection()->map(function ($product) {
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
        });
        return $products->setCollection($productDAOs);
    }


    public function getProductById(int $id)
    {
        
        $product= $this->productRepository->fetchProductById($id);
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

    public function createProduct(ProductBO $ProductBO)
    {
        
        $data = [
            'name' => $ProductBO->name,
            'description' => $ProductBO->description,
            'sku' => $ProductBO->sku,
            'price' => $ProductBO->price,
            'category_id' => $ProductBO->category_id,
        ];
        $product=$this->productRepository->create($data);
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

    public function updateProduct(int $id, ProductBO $ProductBO)
    {
        $product = $this->productRepository->fetchProductById($id);
        $data = [
            'name' => $ProductBO->name,
            'description' => $ProductBO->description,
            'sku' => $ProductBO->sku,
            'price' => $ProductBO->price,
            'category_id' => $ProductBO->category_id,
        ];
        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct(int $id)
    {
        return $this->productRepository->delete($id);
    }
}