<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {   
        echo view('admin/templates/head');
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/dashboard');
        echo view('admin/templates/footer');
    }

}
