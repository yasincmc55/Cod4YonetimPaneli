<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index()
    {   
        // Her view'i ayrı olarak basıyoruz.
        echo view('front/templates/head');
        echo view('front/templates/header');
        echo view('front/home');
        echo view('front/templates/footer');
    }

}
