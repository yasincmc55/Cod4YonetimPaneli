<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Eğer kullanıcı giriş yapmışsa login sayfasına erişmesin
        if (session()->has('logged_in') && url_is('admin/login')) {
            return redirect()->to('admin/');
        }

        // Eğer giriş yapmamışsa admin paneline giremesin
        if (!session()->has('logged_in') && !url_is('admin/login')) {
            return redirect()->to('admin/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}
