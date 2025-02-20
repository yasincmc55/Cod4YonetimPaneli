<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\UserGroupModel;

class UserController extends BaseController
{
    public function index()
    {
        $user = new UserModel();
        $users = $user->get_users();

        $roles = new UserGroupModel();
        $roles = $roles->findAll();

        $data['users'] = $users;
        $data['roles'] = $roles;

        echo view('admin/templates/head');
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/users', $data);
        echo view('admin/templates/footer');
    }


    public function user_add()
    {
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $user_group = $this->request->getPost('user_group');
        $status = $this->request->getPost('status');

        if (!$username || !$email || !$password || !$user_group || !$status) {
            session()->setFlashdata('error', 'Tüm alanları doldurun.');
            return redirect()->back();
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $token = generateToken(30);

        $userData = [
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword,
            'user_group_id' => $user_group,
            'token' => $token,
            'status' => $status
        ];

        if ($userModel->insert($userData)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Kullanıcı başarıyla eklendi.'
            ]);

        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Kullanıcı eklenirken hata oluştu.'
            ]);

        }

        return redirect()->to('admin/users'); // Kullanıcı listesine yönlendir
    }


    public function user_get_single()
    {
        $user_id = $this->request->getPost('id');

        $userModel = new UserModel();
        $result = $userModel->find($user_id);

        // Veri bulunduysa JSON olarak dön
        if ($result) {
            return $this->response->setJSON([
                'status' => 'success',
                'data' => $result,
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'İzin kaydı bulunamadı.',
            ]);
        }

    }


    public function user_update()
    {
        $id = $this->request->getPost('id');
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $role = $this->request->getPost('role');
        $status = $this->request->getPost('status');

        $userModel = new UserModel();
        $updateData = [
            'username' => $username,
            'email' => $email,
            'user_group_id' => $role,
            'status' => $status,
        ];

        $result = $userModel->update($id, $updateData);

        if ($result) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Güncelleme Başarılı',
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Güncelleme Başarısız',
            ]);
        }
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $userModel = new UserModel();

        if ($userModel->find($id)) {
            $userModel->delete($id);
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Kullanıcı başarıyla silindi.',
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Hata.',
            ]);
        }
    }

}