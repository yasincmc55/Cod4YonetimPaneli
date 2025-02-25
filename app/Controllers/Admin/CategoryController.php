<?php

namespace App\Controllers\Admin;

use App\Models\CategoryModel;
use CodeIgniter\Controller;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }
    public function index()
    {
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->getCategories();

        return view('categories/index', $data);
    }

}
