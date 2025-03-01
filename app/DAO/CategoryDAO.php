<?php 
namespace App\DAO;

class CategoryDAO
{
    public $id;
    public $name;
    public $parent_category_id;
    public $created_at;
    public $updated_at;
    public $children = [];
    public function __construct($id = null, $name = null, $parent_category_id = null, $created_at = null, $updated_at = null, $children = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->parent_category_id = $parent_category_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->children = $children;
    }
}
