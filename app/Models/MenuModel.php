<?php
namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'menu_items';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'url', 'parent_id', 'order', 'status'];

    public function getMenuItems($parent_id = 0)
    {
        return $this->where('parent_id', $parent_id)
            ->where('status', 1)
            ->orderBy('order', 'ASC')
            ->findAll();
    }

    public function getSubMenuItems($parent_id)
    {
        return $this->where('parent_id', $parent_id)
            ->where('status', 1)
            ->orderBy('order', 'ASC')
            ->findAll();
    }
}