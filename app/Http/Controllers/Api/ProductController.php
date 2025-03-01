<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\BusinessObjects\ProductBO;
use App\DAO\ProductDAO;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $filters = $request->all();
        $products = $this->productService->getAllProducts($filters);
        return response()->json($products);
    }

    public function show($id)
    {
       
        $product = $this->productService->getProductById($id);
        return response()->json($product);
      
    }


    public function store(ProductRequest $request)
    {
        $ProductBO = new ProductBO(
            null,
            $request->name,
            $request->description,
            $request->sku,
            $request->price,
            $request->category_id,
            null,  
            now(), 
            now()  
        );
    
        $product = $this->productService->createProduct($ProductBO);
    
        return response()->json([
            'message' => 'Product created successfully',
            'product' => $product,
        ], 201);
    }
    
    public function update(ProductRequest $request, $id)
    {
        $this->productService->getProductById($id);
        $validatedData = $request->validated(); 
        $ProductBO = new ProductBO(
            $id, 
            $validatedData['name'],
            $validatedData['description'],
            $validatedData['sku'],
            $validatedData['price'],
            $validatedData['category_id'],
            null, 
            now(), 
            now() 
        );
    
        $product = $this->productService->updateProduct($id, $ProductBO);
    
        return response()->json([
            'message' => 'Product updated successfully',
            'product' => $product,
        ], 200);
    }
    

    public function destroy($id)
    {
        $this->productService->getProductById($id);
        
        $this->productService->deleteProduct($id);
        return response()->json(null, 204);
    }
}