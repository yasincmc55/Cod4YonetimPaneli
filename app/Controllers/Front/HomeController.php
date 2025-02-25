<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\MenuModel;

class HomeController extends BaseController
{
    public function index()
    {
        $menuModel = new MenuModel();
        $data['main_menu'] = $menuModel->getMenuItems(0);

        foreach ($data['main_menu'] as &$menu) {
            $menu['sub_menu'] = $menuModel->getSubMenuItems($menu['id']);
        }

        $this->renderView('front/home', $data);
    }

}
