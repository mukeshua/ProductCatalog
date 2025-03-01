<?php
namespace App\DAO;

class ProductDAO
{
    public $id;
    public $name;
    public $description;
    public $sku;
    public $price;
    public $category_id;
    public $created_at;
    public $updated_at;

    public function __construct($id = null, $name = null, $description = null, $sku = null, $price = null, $category_id = null,$category, $created_at = null, $updated_at = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->sku = $sku;
        $this->price = $price;
        $this->category_id = $category_id;
        $this->category = $category;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
}
