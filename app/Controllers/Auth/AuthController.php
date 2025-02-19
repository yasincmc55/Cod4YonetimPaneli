<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{

    public function index()
    {
       
        echo view('admin/auth/login');
    }


    // Giriş İşlemi
    public function login()
    {

        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Kullanıcı adı ile kullanıcıyı bul
        $user = $userModel->where('username', $username)->first();


        if (!$user || !password_verify($password, $user['password'])) {
            return "Giriş bilgileri hatalı";
        }

        $sessionData = [
            'user_id'=>$user['id'],
            'username'=>$user['username'],
            'email'=>$user['email'],
            'user_group'=>$user['user_group_id'],
            'token'=>$user['token'],
            'logged_in'=>true
        ];

        session()->set($sessionData);

        return redirect()->to('admin/');
    }


    public function logout()
    {

        session()->destroy();

        return redirect()->to('admin/login');
    }

}
