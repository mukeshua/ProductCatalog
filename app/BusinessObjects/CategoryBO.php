<?php
namespace App\BusinessObjects;
class CategoryBO
{
    public $id;
    public $name;
    public $parent_category_id;

    public function __construct($id = null, $name = null, $parent_category_id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->parent_category_id = $parent_category_id;
    }
}
